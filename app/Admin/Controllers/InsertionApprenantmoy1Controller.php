<?php

namespace App\Admin\Controllers;

use App\Models\{
    Classe,
    Etablissement,
    Apprenant,
    Apprenantannee,
    Etablissementannee,
    Statutapprenant
};
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Encore\Admin\Controllers\AdminController;

class InsertionApprenantmoy1Controller extends AdminController
{
    protected $title = 'Insertion des moyennes du 1er semestre';

    public function insertions(Content $content)
    {
        return $content
            ->header('Insertion des moyennes du 1er semestre')
            ->description('Insertion des moyennes du 1er semestre')
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

        $filePath_moyenne1er = asset('uploads/modele/MODELE_DE_REMPLISSAGE_MOYENNE_SEM1.xlsx');
        // $filePath_modele = asset('uploads/modele/DEEP_DONNEES.xlsx');
        // $filePath_param = asset('uploads/modele/parametre_importation.pdf');

        $form->html('<a href="' . $filePath_moyenne1er . '" class="btn btn-success" target="_blank">Télécharger le modèle Excel</a>', 'Téléchargement du modèle');
        // $form->html('<a href="' . $filePath_param . '" class="btn btn-primary" target="_blank">Télécharger le paramètrage</a>', 'Téléchargement des paramètres');


        $form->file('insertion_file', __('Importer le fichier'))->rules('required|mimes:xls,xlsx');
        $form->hidden('etablissements_id', __('Etablissement'))->default($etablissement->id);
        $form->setAction('moyenne1');

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
            'etablissements_id' => 'required|integer',
            'insertion_file' => 'required|file|mimes:xls,xlsx',
        ]);

        $file = $request->file('insertion_file');
        $extension = $file->getClientOriginalExtension();

        try {
            set_time_limit(0);
            $spreadsheet = IOFactory::load($file->getRealPath());
            $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            $etablissement = Etablissement::findOrFail($request->etablissements_id);
            $anneescolaires_id = session('anneescolaireactuelle');

            $etablissementannees = Etablissementannee::where('etablissements_id', $etablissement->id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->firstOrFail();

            if (! $etablissementannees) {
                return back()->with('error', new MessageBag(['title' => 'Erreur', 'message' => 'Etablissement année inconnue']));
            }

            // dd($etablissementannees);

            $successCount = 0;
            foreach ($rows as $index => $row) {
                if ($index === 1) continue; // Skip header row

                // Map columns to variables
                $matricule = $row['A'];
                // $nom = $row['B'];
                // $prenoms = $row['C'];
                // $datenaissance = $row['D'];
                // $lieunaissance = $row['E'];
                // $genre = $row['F'];
                // $statut = $row['G'];
                // $handicap = $row['H'];
                // $nationalite = $row['I'];
                $moy_semestre_1 = $row['H'];

                // Rechercher l'apprenant par matricule
                $apprenant = Apprenant::where('matriculeap', $matricule)->first();

                // $apprenant = Apprenant::updateOrCreate([
                //     'matriculeap' => $matricule,
                //     'nom' => $nom,
                //     'prenoms' => $prenoms,
                // ]);

                if ($apprenant) {
                    // Mettre à jour uniquement la moyenne du semestre 1
                    Apprenantannee::where([
                        'etablissementannees_id' => $etablissementannees->id,
                        'apprenants_id' => $apprenant->id
                    ])->update(['moyenne1er' => $moy_semestre_1]);
        
                    $successCount++;
                }

                // Apprenantannee::update([
                //     'etablissementannees_id' => $etablissementannees->id,
                //     'apprenants_id' => $apprenant->id,
                //     // 'classes_id' => $request->classes_id,
                //     'moyenne1er' => $moy_semestre_1,
                //     // 'bourses_id' => $bourse ? : null,
                //     // 'statutapprenants_id' => $statut ? : null,
                // ]);

                // $successCount++;
            }

            $message = "Nombre d'enregistrements : $successCount.";
            return back()->with('success', new MessageBag(['title' => 'Succès', 'message' => $message]));
        } catch (\Exception $e) {
            $message = 'Erreur : ' . $e->getMessage();
            return back()->with('error', new MessageBag(['title' => 'Erreur', 'message' => $message]));
        }
    }
}
