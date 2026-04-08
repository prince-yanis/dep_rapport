<?php

namespace App\Admin\Controllers;


use App\Models\Serie;
use App\Models\Classe;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Models\Filiere;
use App\Models\AdminRole;
use App\Models\AdminUser;
use App\Models\Apprenant;
use App\Models\Personnel;
use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Apprenantannee;
use App\Models\Diplomeprepare;
use App\Models\Parametreglobaux;
use App\Models\Personnelmatiere;
use Encore\Admin\Layout\Content;
use App\Models\Groupepedagogique;
use App\Models\Positionpersonnel;
use App\Models\Etablissementannee;
use App\Models\Niveau;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\MessageBag;
use Encore\Admin\Controllers\AdminController;


class InsertionserieController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Admission controller';
    protected $current_year = 0;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * G�n�rer les salaires.
     *
     * @param Content $content
     * @return Content
     */
    public function insertions(Content $content)
    {
        return $content
            ->header('Insertion')
            ->description('Insertion des établissements dans la base')
            ->body($this->form_2());
    }

    /**
     * Formulaire de g�n�ration des salaires.
     *0.
     * @return Form
     */
    protected function form_2()
    {
        $form = new Form(new Etablissement);
        $form->file('insertion_file', __('Fichier a importer'));
        $form->setAction('insertion');
        return $form;
    }

    public function insertion(Request $request)
    {
        if ($request->hasFile('insertion_file') && $request->file('insertion_file')->isValid()) {
            $fichier = $request->file('insertion_file')->getRealPath();
            $separateur = ';';

            try {
                if (!file_exists($fichier)) {
                    throw new \Exception("Le fichier n'existe pas.");
                }

                $file = new \SplFileObject($fichier);
                $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
                $file->setCsvControl($separateur);

                $tab_champs = $file->current();
                $champs_insert = array_fill(0, count($tab_champs), '?');
                $champs_insert = implode(',', $champs_insert);

                $file->next();

            while ($row = $file->current()) {

                $EtabAnnee = $row[0];
                $matricule = $row[1];
                $nom = utf8_encode($row[2]);
                $prenoms = utf8_encode($row[3]);
                $genre = $row[4];
                $datenaissance = $row[5];
                $lieunaissance = utf8_encode($row[6]);
                $diplome = $row[7];
                $filiere = $row[8];
                $niveau = $row[9];
                $statut = $row[10];

                $existingApprenants = Apprenant::where('matriculeap', $matricule)->first();
                if (!$existingApprenants) {
                    $apprenant = Apprenant::create([
                        'matriculeap' => $matricule,
                        'nom' => $nom,
                        'prenoms' => $prenoms,
                        'datenaissance' => $datenaissance,
                        'lieunaissance' => $lieunaissance,
                        'sexe' => $genre,
                    ]);
                    $apprenant_id = $apprenant->id;
                } else {
                    $apprenant_id = $existingApprenants->id;
                }

                // Récupérer les libellés des tables filiere et diplomeprepare
                $filiereLibelle = Filiere::find($filiere)->libellefiliere; // Assurez-vous que le modèle Filiere et le champ libelle existent
                $diplomeLibelle = Diplomeprepare::find($diplome)->libellediplome; // Assurez-vous que le modèle Diplomeprepare et le champ libelle existent
                $niveauLibelle = Niveau::find($niveau)->libelleniveau; // Assurez-vous que le modèle Diplomeprepare et le champ libelle existent

                $existingGroup = Groupepedagogique::where('niveau_id', $niveau)
                    ->where('filieres_id', $filiere)
                    ->where('diplomeprepares_id', $diplome)
                    ->first();

                $libelleGroupe = $niveauLibelle . ' - ' . $filiereLibelle; // Créer le libelle du groupe pédagogique
                if (!$existingGroup) {
                    $GP = Groupepedagogique::create([
                        'niveau_id' => $niveau,
                        'filieres_id' => $filiere,
                        'diplomeprepares_id' => $diplome,
                        'libellegp' => $libelleGroupe
                    ]);
                    $GP_id = $GP->id;
                } else {
                    $GP_id = $existingGroup->id;
                    
                    $existingGroup->update([
                        'libellegp' => $libelleGroupe
                    ]);
                }

                $existingClasse = Classe::where('groupepedagogiques_id', $GP_id)
                    ->where('etablissementannees_id', $EtabAnnee)
                    ->first();

                if (!$existingClasse) {
                    $classe = Classe::create([
                        'groupepedagogiques_id' => $GP_id,
                        'etablissementannees_id' => $EtabAnnee
                    ]);
                    $classe_id = $classe->id;
                } else {
                    $classe_id = $existingClasse->id;
                }

                $existingApprenantAnnee = Apprenantannee::where('etablissementannees_id', $EtabAnnee)
                    ->where('apprenants_id', $apprenant_id)
                    ->where('classes_id', $classe_id)
                    ->first();

                if (!$existingApprenantAnnee) {
                    $apprenantAnnee = Apprenantannee::create([
                        'etablissementannees_id' => $EtabAnnee,
                        'apprenants_id' => $apprenant_id,
                        'classes_id' => $classe_id,
                        'statutapprenants_id' => $statut
                    ]);
                }

                $file->next();
            }

            $message = 'Insertion réussie.';
                $success = new MessageBag([
                    'title'   => 'Succès',
                    'message' => $message,
                ]);
                return back()->with(compact('success'));
            } catch (\Exception $e) {
                $message = 'Erreur lors de la lecture du fichier : ' . $e->getMessage();
                $error = new MessageBag([
                    'title'   => 'Erreur',
                    'message' => $message,
                ]);
                return back()->with(compact('error'));
            }
        } else {
            $message = 'Erreur lors de l\'upload du fichier.';
            $error = new MessageBag([
                'title'   => 'Erreur',
                'message' => $message,
            ]);
            return back()->with(compact('error'));
        }

    }
}
