<?php

namespace App\Admin\Controllers;


use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRole;
use App\Models\AdminUser;

use App\Models\Personnel;
use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Filiereenseigne;
use App\Models\Parametreglobaux;

use App\Models\Personnelmatiere;
use Encore\Admin\Layout\Content;
use App\Models\Positionpersonnel;
use App\Models\Etablissementannee;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\MessageBag;
use Encore\Admin\Controllers\AdminController;


class InsertionetablissementController extends AdminController
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
    public function __construct() {}

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
        //        if ($request->get('type_file') == 'csv') {

        $message = '';

        try {
            // $anneescolaire = Parametreglobaux::find(1)->anneescolaires_id;

            $fichier = $_FILES['insertion_file']['tmp_name'];

            $separateur = ';';

            $file = new \SplFileObject($fichier);
            $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
            $file->setCsvControl($separateur);
            // $anneescolaires_id = 1;
            $tab_champs = $file->current();
            $champs_insert = array_fill(0, count($tab_champs), '?');
            $champs_insert = implode(',', $champs_insert);

            $file->next();

            while ($row = $file->current()) {

                $DR = (int) $row[0]; // Conversion en entier
                $ordre_enseignement =  1;
                $diplomeprepares =  1;
                $code = (int)  $row[3];
                // $libelle = utf8_encode($row[4]);
                $libelle = utf8_encode($row[4]);
                // $localisation =  $row[5];
                $localisation = utf8_encode($row[5]);
                // $serie =  $row[6];
                $serie = (int) $row[6]; // Vérifier que la série est présente et convertir en entier
                $contact_se =  utf8_encode($row[7]);
                $contact_de =  utf8_encode($row[8]);
                $contact_cf =  utf8_encode($row[9]);
                // $contact_serfe =  utf8_encode($row[10]);
                $contact_fond =  utf8_encode($row[10]);
                $courriel_1 =   utf8_encode($row[11]);
                $courriel_2 =  utf8_encode($row[12]);
                $anneescolaires_id = session('anneescolaireactuelle');

                $etablissement = Etablissement::where('code', '=', $code)->first();

                if (!$etablissement) {
                    $etablissement = Etablissement::create([
                        'denominationetab' => $libelle,
                        'code' => $code,
                        'directiondepartementales_id' => $DR,
                        'ordre_enseignement_id' => $ordre_enseignement,
                        'contact_se' => $contact_se,
                        'contact_de' => $contact_de,
                        'contact_cf' => $contact_cf,
                        'contact' => $contact_fond,
                        'email' => $courriel_1,
                    ]);
                    $etablissement_id = $etablissement->id;

                    // Create an validateur account
                    if (!AdminUser::where([
                        ['username', '=', $code],
                    ])->exists()) {
                        $rubric = new AdminUser([
                            'username' => $code,
                            'name' => $code,
                            'idEtab' => $etablissement_id,
                            'password' => \Hash::make('00000000'),
                        ]);
                        if ($rubric->save()) {
                            $query = new AdminRoleUser([
                                'user_id' => $rubric->id,
                                'role_id' => AdminRole::where('slug', 'etablissements')->firstOrFail()->id,
                            ]);
                            $query->save();
                        }
                    }
                } else {
                    $etablissement_id = $etablissement->id;
                    $etablissement->update([
                        'denominationetab' => $libelle,
                        'localisation' => $localisation,
                        'contact_se' => $contact_se,
                        'contact_de' => $contact_de,
                        'contact_cf' => $contact_cf,
                        'contact' => $contact_fond,
                        'email' => $courriel_1,
                        'email_2' => $courriel_2,
                    ]);
                }

                $etablissementinsere = Etablissement::find($etablissement_id);
                $existingAnnee = Etablissementannee::where('anneescolaires_id', $anneescolaires_id)
                    ->where('etablissements_id', $etablissement_id)
                    ->first();
                if ($existingAnnee) {
                    $existingAnnee->update([
                        'anneescolaires_id' => $anneescolaires_id,
                        'etablissements_id' => $etablissement_id

                    ]);
                } else {
                    // Vérifiez si Etablissement-Année n'existe pas
                    $existingAnnee = Etablissementannee::create([
                        'anneescolaires_id' => $anneescolaires_id,
                        'etablissements_id' => $etablissement_id
                    ]);
                }

                $etablissementannee_id = $existingAnnee->id;
                $existingFiliere = Filiereenseigne::where('filieres_id', $serie)
                    ->where('etablissementannees_id', $etablissementannee_id)
                    ->first();
                if (!$existingFiliere) {
                    Filiereenseigne::create([
                        'etablissementannees_id' => $etablissementannee_id,
                        'filieres_id' => $serie,
                        'diplomeprepares_id' => $diplomeprepares
                    ]);
                }
                // if (!is_null($serie)) {
                //     $existingFiliere = Filiereenseigne::where('filieres_id', $serie)
                //         ->where('etablissementannees_id', $etablissementannee_id)
                //         ->first();

                //     if (!$existingFiliere) {
                //         Filiereenseigne::create([
                //             'etablissementannees_id' => $etablissementannee_id,
                //             'filieres_id' => $serie, // Assurez-vous que cette valeur est non vide
                //             'diplomeprepares_id' => $diplomeprepares
                //         ]);
                //     }
                // } else {
                //     $message .= "La filière est manquante ou incorrecte pour l'établissement avec le code: {$code}.";
                // }

                $file->next();
            }

            $message .= 'Insertion réussie.';
            $success = new MessageBag([
                'title' => "",
                'message' => $message,
            ]);
            return back()->with(compact('success'));
        } catch (Exception $e) {
            $message .= 'Mise &acute; jour réussie.';
            $message .= $e->getMessage();
            $error = new MessageBag([
                'title' => "",
                'message' => $message,
            ]);
            return back()->with(compact('error'));
        }
    }
}
