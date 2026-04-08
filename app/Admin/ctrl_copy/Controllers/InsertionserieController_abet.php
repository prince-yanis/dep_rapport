<?php

namespace App\Admin\Controllers;

use App\Models\{
    Classe, Etablissement, Apprenant, Apprenantannee, Etablissementannee, Statutapprenant
};
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Encore\Admin\Controllers\AdminController;

class InsertionserieController extends AdminController
{
    protected $title = 'Admission controller';

    public function insertions(Content $content)
    {
        return $content
            ->header('Insertion')
            ->description('Insertion des établissements dans la base')
            ->body($this->form_2());
    }

    protected function form_2()
    {
        $form = new Form(new Etablissement);
        $current_user = Auth::guard('admin')->user();
        $etablissement = $this->getEtablissement($current_user);

        if (!$etablissement) {
            throw new \Exception("Aucun établissement choisi");
        }

        // Récupérer les classes associées à l'établissement
        $classes = Classe::join('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->join('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->where('etablissements.id', '=', $etablissement->id)
            ->select('classes.id', 'classes.denominationclasse')
            ->get();

        $lesclasses = $classes->pluck('denominationclasse', 'id')->toArray();

        $form->select('classes_id', __('Classe'))->options($lesclasses);
        $form->file('insertion_file', __('Fichier à importer'))->rules('required|mimes:xls,xlsx');
        $form->hidden('etablissements_id', __('Etablissement'))->default($etablissement->id);
        $form->setAction('insertion');

        return $form;
    }

    private function getEtablissement($current_user)
    {
        $role_id = $current_user->roles()->first()->id ?? null;
        if ($role_id === 2) {
            return Etablissement::where('code', $current_user->username)->first();
        }
        $etablissement_id = session('etablissementchoisi');
        return Etablissement::find($etablissement_id);
    }

    public function insertion(Request $request)
    {
        $request->validate([
            'classes_id' => 'required|integer',
            'etablissements_id' => 'required|integer',
            'insertion_file' => 'required|file|mimes:xls,xlsx',
        ]);

        $file = $request->file('insertion_file');
        $extension = $file->getClientOriginalExtension();

        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $etablissement = Etablissement::findOrFail($request->etablissements_id);
            $anneescolaires_id = session('anneescolaireactuelle');

            $etablissementannees = Etablissementannee::where('etablissements_id', $etablissement->id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->firstOrFail();
			
			if(! $etablissementannees) {
				return back()->with('error', new MessageBag(['title' => 'Erreur', 'message' => 'Etablissement année inconnue']));
			}
			
			// dd($etablissementannees);

            $successCount = 0;
            foreach ($rows as $index => $row) {
                if ($index === 1) continue; // Skip header row

                // Map columns to variables
                $matricule = $row['A'];
                $nom = $row['B'];
                $prenoms = $row['C'];
                $datenaissance = $row['D'];
                $lieunaissance = $row['E'];
                $genre = $row['F'];
                $statut = $row['G'];
                $handicap = $row['H'];
                $nationalite = $row['I'];
                $bourse = strtolower($row['J']);

                $apprenant = Apprenant::firstOrCreate([
                    'matriculeap' => $matricule,
                ], [
                    'nom' => $nom,
                    'prenoms' => $prenoms,
                    'datenaissance' => $datenaissance,
                    'lieunaissance' => $lieunaissance,
                    'nationalite' => $nationalite,
                    'sexe' => $genre,
                ]);

				$status = Statutapprenant::firstOrCreate([
                    'libellestatutap' => $statut,
                ]);

                Apprenantannee::firstOrCreate([
                    'etablissementannees_id' => $etablissementannees->id,
                    'apprenants_id' => $apprenant->id,
                    'classes_id' => $request->classes_id,
                    'bourses_id' => in_array($bourse, ['oui', 'Oui', 'OUI']) ? 1 : 2,
                    'statutapprenants_id' => $status ? $status->id : null,
                ]);

                $successCount++;
            }

            $message = "Nombre d'enregistrements : $successCount.";
            return back()->with('success', new MessageBag(['title' => 'Succès', 'message' => $message]));
        } catch (\Exception $e) {
            $message = 'Erreur : ' . $e->getMessage();
            return back()->with('error', new MessageBag(['title' => 'Erreur', 'message' => $message]));
        }
    }
}
