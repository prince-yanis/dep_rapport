<?php

namespace App\Admin\Controllers;

use App\Models\Activitesportive;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\Association;
use App\Models\Classe;
use App\Models\Demarrageannee;
use App\Models\Equipement;
use App\Models\Filiereenseigne;
use App\Models\Parametresglobaux;

use App\Models\Etablissementannee;
use App\Models\Infrastructure;
use App\Models\Personnelannee;
use App\Models\ProblemeUrgent;
use App\Models\SportEtab;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Encore\Admin\Controllers\AdminController;

class DemarrageanneeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Demarrageannee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Demarrageannee());

        $grid->column('id', __('Id'));
        $grid->column('nouvelan', __('Nouvelan'));
        $grid->column('anpreccedent', __('Anpreccedent'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Demarrageannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nouvelan', __('Nouvelan'));
        $show->field('anpreccedent', __('Anpreccedent'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    /*protected function form()
    {
        $form = new Form(new Demarrageannee());

        // $form->date('nouvelan', __('Nouvelan'))->default(date('Y-m-d'));
        // $form->date('anpreccedent', __('Anpreccedent'))->default(date('Y-m-d'));

        $anneescolaires_id = Parametresglobaux::find(1)->anneescolaires_id; // Récupérer uniquement anneescolaires_id

        $form->select('anpreccedent', __('Année scolaire précédente'))
            ->options(Anneescolaire::all()->pluck('libelleanneescolaire', 'id'))
            ->default($anneescolaires_id)
            ->readonly();

        $form->select('nouvelan', __('Année scolaire en cours'))
            ->options(Anneescolaire::all()->pluck('libelleanneescolaire', 'id'));

        $form->setAction('demaragenouvelannee');
        return $form;
    } */

    // public function valider(Request $request)
    // {
    //     $anneescolaire = Parametresglobaux::find(1)->anneescolaires_id;

    //     $donnees = $request->all();

    //     if ($donnees) {

    //         $nouvelan = $donnees['nouvelan'];
    //         $anpreccedent = $donnees['anpreccedent'];
    //         $etablissements = Etablissementannee::where('anneescolaires_id', '=', $anpreccedent)->->get();
    //         foreach ($etablissements as $etab) {
    //             $donneesetab = [
    //                 'exixtecloture' => $etab->existecloture,
    //                 'problemeequipement' => $etab->problemeequipement,
    //                 'anneescolaires_id' => $nouvelan,
    //                 'etablissements_id' => $etab->etablissements_id,
    //                 'periodesannuelle_id' => $etab->periodesannuelle_id
    //             ];
    //             $idInsere = Etablissementannee::create($donneesetab);
    //             // if($idInsere){
    //             //insertion dans filieres enseignés	
    //             /* $filieresenseignes=Filiereenseigne::where('etablissementannees_id','=',$etab->id)->get();
    // 				foreach($filieresenseignes as $filiere){
    // 					$donneesfiliere=[
    // 						'numautorisationouverture'=>$filiere->existecloture,
    // 						'dureeformation'=>$filiere->problemeequipement,
    // 						'observation'=>$filiere->observation,
    // 						'filieres_id'=>$filiere->filieres_id,
    // 						'diplomeprepares_id'=>$filiere->diplomeprepares_id,
    // 						'etablissementannees_id'=>$idInsere													
    // 					];
    // 					$idfilieree=Filiereenseigne::create($donneesfiliere);
    // 				}*/
    //             //insertion dans infrastructure
    //             //insertion dans equipement
    //             //insertion dans sportetab
    //             //insertion dans personnelannee
    //             //insertion dans association

    //             // }
    //         }
    //     }
    //     $success = new MessageBag([
    //         'title'   => 'Configuration d\'une nouvelle année scolaire',
    //         'message' => "La nouvelle année a été configurée avec succès.",
    //     ]);
    //     return back()->with(compact('success'));
    // }
    protected function form()
    {
        $form = new Form(new Demarrageannee());

        // Retrieve the current 'anneescolaires_id' for setting the default value
        $anneescolaires_id = Parametresglobaux::find(1)->anneescolaires_id;

        // Fetch all options for school years only once
        $anneesOptions = Anneescolaire::all()->pluck('libelleanneescolaire', 'id');

        // Populate previous and current school year selectors
        $form->select('anpreccedent', __('Année scolaire précédente'))
            ->options($anneesOptions)
            ->default($anneescolaires_id);
        // ->readonly();

        $form->select('nouvelan', __('Année scolaire en cours'))
            ->options($anneesOptions);

        // $form->setAction('demaragenouvelannee');
        $form->saved(function (Form $form) {
            $donnees = $form->model()->toArray();
            if ($donnees) {
                // Définir les options pour une lecture efficace des fichiers volumineux
                set_time_limit(0); // Supprime la limite de temps d'exécution
                ini_set('memory_limit', '512M'); // Augmente la limite de mémoire

                $nouvelan = $donnees['nouvelan'];
                $anpreccedent = $donnees['anpreccedent'];
                $etablissements = Etablissementannee::where('anneescolaires_id', '=', $anpreccedent)->where('etablissements_id', '=', 907)->get();
                // $etablissements = Etablissementannee::where('anneescolaires_id', '=', $anpreccedent)->get();
                foreach ($etablissements as $etab) {
                    $donneesetab = [
                        'existecloture' => $etab->existecloture,
                        'problemeequipement' => $etab->problemeequipement,
                        'anneescolaires_id' => $nouvelan,
                        'etablissements_id' => $etab->etablissements_id,
                        'periodesannuelle_id' => $etab->periodesannuelle_id
                    ];
                    $idInsere = Etablissementannee::updateOrCreate($donneesetab);
                    if ($idInsere) {
                        //insertion dans filieres enseignés	/ année
                        $filieresenseignes = Filiereenseigne::where('etablissementannees_id', '=', $etab->id)->get();
                        foreach ($filieresenseignes as $filiere) {
                            $donneesfiliere = [
                                'numautorisationouverture' => $filiere->numautorisationouverture,
                                'dureeformation' => $filiere->dureeformation,
                                'observation' => $filiere->observation,
                                'filieres_id' => $filiere->filieres_id,
                                'diplomeprepares_id' => $filiere->diplomeprepares_id,
                                'etablissementannees_id' => $idInsere->id
                            ];
                            $idfilieree = Filiereenseigne::updateOrCreate($donneesfiliere);
                        }
                        //insertion dans personnel année
                        $personnelannees = Personnelannee::where('etablissementannees_id', '=', $etab->id)->get();
                        foreach ($personnelannees as $personnel) {
                            $donneespersonnels = [
                                'quotahoraire' => $personnel->quotahoraire,
                                'nbreheureeffectuee' => $personnel->nbreheureeffectuee,
                                'nbreheureresponsabilite' => $personnel->nbreheureresponsabilite,
                                'disciplines_id' => $personnel->disciplines_id,
                                'niveauenseignant_id' => $personnel->niveauenseignant_id,
                                'fonctionpersonnels_id' => $personnel->fonctionpersonnels_id,
                                'statutpersonnel_id' => $personnel->statutpersonnel_id,
                                'personnels_id' => $personnel->personnels_id,
                                'etablissementannees_id' => $idInsere->id
                            ];
                            $idpersonnel = Personnelannee::updateOrCreate($donneespersonnels);
                        }
                        //insertion dans classe / année
                        $classeannees = Classe::where('etablissementannees_id', '=', $etab->id)->get();
                        foreach ($classeannees as $classe) {
                            $donneesclasses = [
                                'denominationclasse' => $classe->denominationclasse,
                                'effectif_total' => $classe->effectif_total,
                                'effectif_gar' => $classe->effectif_gar,
                                'effectif_fil' => $classe->effectif_fil,
                                'effectif_boursier' => $classe->effectif_boursier,
                                'effectif_nonboursier' => $classe->effectif_nonboursier,
                                'effectif_affecte' => $classe->effectif_affecte,
                                'effectif_nonaffecte' => $classe->effectif_nonaffecte,
                                'groupepedagogiques_id' => $classe->groupepedagogiques_id,
                                'etablissementannees_id' => $idInsere->id
                            ];
                            $idclasse = Classe::updateOrCreate($donneesclasses);
                        }

                        //insertion dans infrastructure / année
                        $infrastructureannees = Infrastructure::where('etablissementannees_id', '=', $etab->id)->get();
                        foreach ($infrastructureannees as $infrastructure) {
                            $donneesinsfrastructures = [
                                'nbrefonctionnel' => $infrastructure->nbrefonctionnel,
                                'nbrenonfonctionel' => $infrastructure->nbrenonfonctionel,
                                'nombre' => $infrastructure->nombre,
                                'nombrebureaux' => $infrastructure->nombrebureaux,
                                'capacite' => $infrastructure->capacite,
                                'observation' => $infrastructure->observation,
                                'designationinfrastructures_id' => $infrastructure->designationinfrastructures_id,
                                'etablissementannees_id' => $idInsere->id
                            ];


                            // Define a unique condition to check if the record exists
                            // $uniqueCondition = [
                            //     'designationinfrastructures_id' => $infrastructure->designationinfrastructures_id,
                            //     'etablissementannees_id' => $idInsere->id
                            // ];

                            // // Update or create record based on the unique condition
                            // $idinfrastructure = Infrastructure::updateOrCreate($uniqueCondition, $donneesinsfrastructures);
                            $idinfrastructure = Infrastructure::updateOrCreate($donneesinsfrastructures);
                        }

                        //insertion dans equipements / année
                        $equipementsannees = Equipement::where('etablissementannees_id', '=', $etab->id)->get();
                        foreach ($equipementsannees as $equipement) {
                            $donneesequipements = [
                                'nombre' => $equipement->nombre,
                                'nbrenonfonctionel' => $equipement->nbrenonfonctionel,
                                'nbrefonctionnel' => $equipement->nbrefonctionnel,
                                'materiels_id' => $equipement->materiels_id,
                                'etablissementannees_id' => $idInsere->id
                            ];
                            $idequipement = Equipement::updateOrCreate($donneesequipements);
                        }

                        //insertion dans sport / année
                        $sportsannees = Activitesportive::where('etablissementannees_id', '=', $etab->id)->get();
                        foreach ($sportsannees as $sport) {
                            $donneessports = [
                                'sport_id' => $sport->sport_id,
                                'etablissementannees_id' => $idInsere->id
                            ];
                            $idsport = Activitesportive::updateOrCreate($donneessports);
                        }

                        //insertion dans association / club /année
                        $associationsannees = Association::where('etablissementannees_id', '=', $etab->id)->get();
                        foreach ($associationsannees as $association) {
                            $donneesassociations = [
                                'nomresponsable' => $association->nomresponsable,
                                'objet' => $association->objet,
                                'designation' => $association->designation,
                                'etablissementannees_id' => $idInsere->id
                            ];
                            $idassociation = Association::updateOrCreate($donneesassociations);
                        }

                        //insertion dans problème urgents / année
                        // $problemesannees = ProblemeUrgent::where('etablissementannees_id', '=', $etab->id)->get();
                        // foreach ($problemesannees as $probleme) {
                        //     $donneesproblemes = [
                        //         'libelleprobleme' => $probleme->libelleprobleme,
                        //         'etablissementannees_id' => $idInsere->id
                        //     ];
                        //     $idprobleme = ProblemeUrgent::updateOrCreate($donneesproblemes);
                        // }

                    }
                }
                // $parametres = Parametresglobaux::find(1);
                // // Vérifier si l'enregistrement existe
                // if ($parametres) {
                //     // Mettre à jour la colonne `anneescolaires_id` avec `$nouvelan`
                //     $parametres->anneescolaires_id = $nouvelan;

                //     // Sauvegarder les modifications dans la base de données
                //     $parametres->save();
                // }
                $parametres = Parametresglobaux::find(1);
                if ($parametres) {
                    $parametres->update(['anneescolaires_id' => $nouvelan]);
                }

                // $anneescolairesupdate = Parametresglobaux::find(1)->udpate(['anneescolaires_id' => $nouvelan]);
            }
            $success = new MessageBag([
                'title'   => 'Configuration d\'une nouvelle année scolaire',
                'message' => "La nouvelle année a été configurée avec succès.",
            ]);
            return back()->with(compact('success'));
        });
        return $form;
    }

    // public function valider(Request $request)
    // {
    //     $donnees = $request->all();

    //     if ($donnees) {
    //         $nouvelan = $donnees['nouvelan'];
    //         $anpreccedent = $donnees['anpreccedent'];

    //         // Begin a transaction to ensure data consistency
    //         DB::beginTransaction();

    //         try {
    //             // Fetch establishments from the previous school year
    //             $etablissements = Etablissementannee::where('anneescolaires_id', '=', $anpreccedent)
    //                 ->where('etablissements_id', '=', 1)
    //                 ->get();

    //             foreach ($etablissements as $etab) {
    //                 $donneesetab = [
    //                     'exixtecloture' => $etab->existecloture,
    //                     'problemeequipement' => $etab->problemeequipement,
    //                     'anneescolaires_id' => $nouvelan,
    //                     'etablissements_id' => $etab->etablissements_id,
    //                     'periodesannuelle_id' => $etab->periodesannuelle_id
    //                 ];

    //                 // Insert new etablissement data
    //                 $idInsere = Etablissementannee::create($donneesetab)->id;

    //                 // Optionally replicate additional related data
    //                 // $this->replicateRelatedData($etab, $idInsere);
    //             }

    //             // Commit transaction if all operations are successful
    //             DB::commit();

    //             $success = new MessageBag([
    //                 'title'   => 'Configuration d\'une nouvelle année scolaire',
    //                 'message' => "La nouvelle année a été configurée avec succès.",
    //             ]);
    //             return back()->with(compact('success'));

    //         } catch (\Exception $e) {
    //             // Rollback transaction on error
    //             DB::rollback();

    //             // Return error message to the user
    //             return back()->withErrors(new MessageBag([
    //                 'title'   => 'Erreur lors de la configuration de la nouvelle année',
    //                 'message' => "Une erreur est survenue: " . $e->getMessage(),
    //             ]));
    //         }
    //     }
    // }

    /**
     * Helper method to replicate related data from previous establishment year
     */
    // protected function replicateRelatedData($etab, $newEtabId)
    // {
    //     // Replicate 'Filiereenseigne' data if needed
    //     $filieresenseignes = Filiereenseigne::where('etablissementannees_id', '=', $etab->id)->get();
    //     foreach ($filieresenseignes as $filiere) {
    //         $donneesfiliere = [
    //             'numautorisationouverture' => $filiere->existecloture,
    //             'dureeformation'           => $filiere->problemeequipement,
    //             'observation'              => $filiere->observation,
    //             'filieres_id'              => $filiere->filieres_id,
    //             'diplomeprepares_id'       => $filiere->diplomeprepares_id,
    //             'etablissementannees_id'    => $newEtabId
    //         ];
    //         Filiereenseigne::create($donneesfiliere);
    //     }
    // }

}
