<?php

namespace App\Admin\Controllers;

use App\Models\{
    Classe, Etablissement, Apprenant, Apprenantannee, Etablissementannee, Parametresglobaux, Statutapprenant
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
            ->description('Insertion des apprenants dans la base par classe')
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

        $filePath_modele = asset('uploads/modele/DEP_DONNEES.xlsx');
        $filePath_param = asset('uploads/modele/parametre_importation.pdf');

        $form->html('<a href="' . $filePath_modele . '" class="btn btn-success" target="_blank">Télécharger le modèle Excel</a>', 'Téléchargement du modèle');
        $form->html('<a href="' . $filePath_param . '" class="btn btn-primary" target="_blank">Télécharger le paramètrage</a>', 'Téléchargement des paramètres');

        $parametresglobaux = Parametresglobaux::findorFail(1);
        $idAnneeScolaire = $parametresglobaux->anneescolaires_id;

        // Récupérer les classes associées à l'établissement
        $classes = Classe::join('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->join('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->where('etablissements.id', '=', $etablissement->id)
            ->where('etablissementannees.anneescolaires_id', '=', $idAnneeScolaire)
            ->select('classes.id', 'classes.denominationclasse')
            ->get();

        $lesclasses = $classes->pluck('denominationclasse', 'id')->toArray();

        $form->select('classes_id', __('Selectionner la Classe'))->options($lesclasses);
        $form->file('insertion_file', __('Importer le fichier'))->rules('required|mimes:xls,xlsx');
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
                $bourse = $row['J'];

                $apprenant = Apprenant::updateOrCreate([
                    'matriculeap' => $matricule,
                ], [
                    'nom' => $nom,
                    'prenoms' => $prenoms,
                    'datenaissance' => $datenaissance,
                    'lieunaissance' => $lieunaissance,
                    'nationalite' => $nationalite,
                    'sexe' => $genre,
                    'handicap_id' => $handicap ? : null,
                ]);

                Apprenantannee::updateOrCreate([
                    'etablissementannees_id' => $etablissementannees->id,
                    'apprenants_id' => $apprenant->id,
                    'classes_id' => $request->classes_id,
                    'bourses_id' => $bourse ? : null,
                    'statutapprenants_id' => $statut ? : null,
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
