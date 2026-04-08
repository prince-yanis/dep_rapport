<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Mission;
use App\Models\Superviseur;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\Filiereautorise;
use App\Models\Filiereenseigne;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Rubriquecontrole;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use App\Models\Fonctionparticipant;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;


class SuiviMissionEditController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = ' ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Mission());
        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();

        $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();

        if (in_array($current_role->role_id, array(2))) {
            $grid->model()->where('etablissementannees_id', '=', $EtabAnnee->id);
            $grid->disableCreateButton();
        }

        $grid->quickSearch(function ($model, $search) {
            $model->whereHas('etablissementannee.etablissement', function ($query) use ($search) {
                $query->where('denominationetab', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");
            })->orWhereHas('etablissementannee.anneescolaire', function ($query) use ($search) {
                $query->where('libelleanneescolaire', 'like', "%{$search}%");
            });
        });

        $grid->column('id', __('Id'));
        // $grid->column('etablissementannees_id', __('Etablissement / annees'));
        $grid->etablissementannees_id("Anneé scolaire - Etablissement")->display(function ($etablissementannees_id) {
            $query = DB::table('etablissementannees')
                // $query = Etablissementannee::find($id)
                ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                ->where('etablissementannees.id', '=', $etablissementannees_id)
                ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab', 'etablissements.code')
                ->first();
            // return $query->libellestatutpers;
            return $query->libelleanneescolaire . ' - ' . $query->denominationetab . ' - Code: ' .  $query->code;
        });
        $grid->column('date', __('Date de debut mission'))->display(function ($value) {
            return \Carbon\Carbon::parse($value)->format('d M Y');
        });
        $grid->column('responsableetab', __('Nom & prénom du Responsable'));
        $grid->column('contactresponsableetab', __('Contact du responsable'));
        $grid->column('emailresponsableetab', __('Email du responsable'));
        $grid->disableCreateButton();

        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->column('Editer')->display(function () {
            session(['mission' => $this->id]);
            return '<a href="/admin/suivimissionedit/' . $this->id . '/edit"class="btn btn-success">Editer la mission</a>';
        });
        $grid->column('Imprimer')->display(function () {
            session(['mission' => $this->id]);
            return '<a href="/missionpdf/' . $this->id . '"class="btn btn-primary" target="_blank">Imprimer la fiche</a>';
        });

        $grid->column("Fiche d'observation")->display(function () {
            session(['mission' => $this->id]);
            return '<a href="/ficheobservation/' . $this->id . '"class="btn btn-primary" target="_blank">Imprimer</a>';
        });

        $grid->disableActions();
        // $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();
        //$grid->disableRowSelector();
        $grid->disableColumnSelector();

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
        $show = new Show(Mission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('responsableetab', __('Nom & prénom du Responsable'));
        $show->field('contactresponsableetab', __('Contact du responsable'));
        $show->field('emailresponsableetab', __('Email du responsable'));
        $show->field('etablissementannees_id', __('Etablissement / année'));
        $show->field('date', __('Date'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Mission());
        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $role_id = $current_role->role_id;
        // filiere autorisé id
        $resultatMissionFiliere = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 6)
            ->where('mission_id', session('mission'))
            ->first();
        // Gestion administrative id

        $resultatMission_6 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 6)
            ->where('mission_id', session('mission'))
            ->first();
        $typepersonnel = DB::table('resultatstypepersonnel')
            ->where('resultatsmission_id', $resultatMission_6->id)
            ->where('typepersonnels_id', 3)
            ->first();

        // Infrastructure et equipement

        $resultatsmission_5 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 5)
            ->where('mission_id', session('mission'))
            ->first();
        $typeequipement = DB::table('resultatstypesequipement')
            ->where('resultatsmission_id', $resultatsmission_5->id)
            ->first();
        // Gestion administrative

        $resultatsmission_1 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 1)
            ->where('mission_id', session('mission'))
            ->first();
        $resultatscontrole_1 = DB::table('resultatscontrole')
            ->where('resultatsmission_id', $resultatsmission_1->id)
            ->where('sousrubriquecontrole_id', 1)
            ->first();
        // Resultat scolaire

        // $resultatsscolaire = DB::table('resultatsscolaire')
        //     ->where('resultatsmission_id', $resultatsmission_1->id)
        //     ->first();

        // Effectif et statut

        $resultatsscolaire = DB::table('resultatsscolaire')
            ->where('resultatsmission_id', $resultatsmission_1->id)
            ->first();
        // Gestion financière et juridique
        $resultatsmission_2 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 2)
            ->where('mission_id', session('mission'))
            ->first();
        $resultatscontrole_4 = DB::table('resultatscontrole')
            ->where('resultatsmission_id', $resultatsmission_2->id)
            ->where('sousrubriquecontrole_id', 4)
            ->first();
        // Relation avec le milieu professionnel
        $resultatsmission_3 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 3)
            ->where('mission_id', session('mission'))
            ->first();
        $resultatscontrole_5 = DB::table('resultatscontrole')
            ->where('resultatsmission_id', $resultatsmission_3->id)
            ->where('sousrubriquecontrole_id', 5)
            ->first();

        // Environnement Sécurité
        $resultatsmission_4 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 4)
            ->where('mission_id', session('mission'))
            ->first();
        $resultatscontrole_6 = DB::table('resultatscontrole')
            ->where('resultatsmission_id', $resultatsmission_4->id)
            ->where('sousrubriquecontrole_id', 6)
            ->first();

        $form->html('
    <style>
        .numberCircle {
            display: inline-block;
            width: 30px;
            line-height: 30px;
            border-radius: 50%;
            text-align: center;
            font-size: 14px;
            border: 2px solid #666;
        }
        p {
            margin-bottom: 10px;
        }
        .menu-links span {
            text-transform: uppercase;
            font-size: 14px;
            margin-right: 5px;
        }
        .menu-links a {
            text-decoration: none;
        }
    </style>

<h1 style="text-align:center; text-transform:uppercase;">Saisir de la mission</h1>
    <div class="menu-links">
        <span>Mission</span> |
        <span><a href="/admin/suivifiliere/' . $resultatMissionFiliere->id . '/edit">Filières autorisés</a></span> |
        <span><a href="/admin/suivipersonnel/' . $typepersonnel->id . '/edit">Gestion administrative</a></span> |
        <span><a href="/admin/suiviequipement/' . $typeequipement->id . '/edit">Infrastructures et Equipements</a></span> |
        <span><a href="/admin/suivicontrole_1/' . $resultatscontrole_1->id . '/edit">Gestion pédagogique</a></span> |
        <span><a href="/admin/suiviscolaires/' . $resultatsscolaire->id . '/edit">Résultats scolaires</a></span> |
        <span><a href="/admin/suivieffectifs/' . $resultatsscolaire->id . '/edit">Effectifs et statut des élèves de l année en cours</a></span> |
        <span><a href="/admin/suivicontrole_4/' . $resultatscontrole_4->id . '/edit">Gestion financière et juridique</a></span> |
        <span><a href="/admin/suivicontrole_5/' . $resultatscontrole_5->id . '/edit">Relation avec le milieu professionnel</a></span> |
        <span><a href="/admin/suivicontrole_6/' . $resultatscontrole_6->id . '/edit">Environnement Sécurité Hygiene et Santé</a></span>

    </div>
');

        switch ($role_id) {
            case 2:
                // $form->number('etablissementannees_id', __('Etablissement / année'));
                $lesetabannees = array();
                $etabannees = DB::table('etablissementannees')
                    ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                    ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                    ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
                    ->get();
                foreach ($etabannees as $etabannee) {
                    $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
                }
                $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees)->readOnly();
                $form->text('responsableetab', __('Nom & prénom du Responsable'));
                $form->text('contactresponsableetab', __('Contact du responsable'));
                $form->text('emailresponsableetab', __('Email du responsable'));
                $form->datetime('date', __('Date de debut mission'))->default(date('d-m-Y'))->readonly();
                $form->datetime('date_fin', __('Date de fin mission'))->default(date('Y-m-d H:i:s'));
                $form->datetime('date_visite', __('Date de visite mission'))->default(date('Y-m-d H:i:s'));
                $form->text('date_derniere_visite', __('Date de dernière visite'));

                $form->hasMany('participantsmissions', __('Participants de la mission'), function (Form\NestedForm $form) {

                    $lessuperviseurs = array();
                    $superviseurs = Superviseur::all();
                    foreach ($superviseurs as $superviseur) {
                        $lessuperviseurs[$superviseur->id] = $superviseur->matricule . ' ' . $superviseur->nom . ' ' . $superviseur->prenoms;
                    }
                    $form->select('superviseur_id', __('Participant'))->options($lessuperviseurs)->readOnly();
                    // $form->number('fonctionparticipants_id', __('Fonctionparticipants id'));
                    $lesfonctions = array();
                    $fonctions = Fonctionparticipant::all();
                    foreach ($fonctions as $fonction) {
                        $lesfonctions[$fonction->id] = $fonction->libellefonction;
                    }
                    $form->select('fonctionparticipants_id', __('Fonction'))->options($lesfonctions)->ReadOnly();
                })->useTable()
                    ->disableCreate() // Désactiver le bouton "Nouveau"
                    ->disableDelete();
                $form->footer(function ($footer) {

                    // disable reset btn
                    $footer->disableReset();

                    // disable `View` checkbox
                    $footer->disableViewCheck();

                    // disable `Continue editing` checkbox
                    $footer->disableEditingCheck();

                    // disable `Continue Creating` checkbox
                    $footer->disableCreatingCheck();
                });

                $form->tools(function (Form\Tools $tools) {

                    // Disable `List` btn.
                    $tools->disableList();

                    // Disable `Delete` btn.
                    $tools->disableDelete();

                    // Disable `Veiw` btn.
                    $tools->disableView();
                });

                // Get the current mission ID
                $form->saved(function (Form $form) {
                    $mission_id = $form->model()->id;
                    // Récupérer l'objet de la mission associée après la sauvegarde
                    $etablissementAnneeId = $form->model()->etablissementannees_id;

                    // Récupérer l'identifiant etablissementannees_id à partir de la mission
                    if ($etablissementAnneeId) {

                        // Récupérer les filières enseignées pour cet etablissementannees_id
                        $filiereEnseignees = Filiereenseigne::where('etablissementannees_id', $etablissementAnneeId)->get();

                        // Boucler sur les filières enseignées pour les mettre à jour ou créer des filières autorisées
                        foreach ($filiereEnseignees as $filiereEnseignee) {
                            $query1 = DB::table('etablissementannees')
                                ->select('ordre_enseignement.id as ordre_enseignement_id')
                                ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                                ->leftJoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
                                ->where('etablissementannees.id', $etablissementAnneeId)
                                ->first();

                            $resultatMissionFiliere = DB::table('resultatsmission')
                                ->where('rubriquecontrole_id', 6)
                                ->where('mission_id', $mission_id)
                                ->first();
                            // Vérifier si la filière autorisée existe déjà pour cet établissement et année
                            $filiereAutorisee = Filiereautorise::where('resultatsmission_id', $resultatMissionFiliere->id)
                                ->where('filieres_id', $filiereEnseignee->filieres_id)  // Supposons qu'il y a un champ filiere_id
                                ->first();
                            // Si la filière n'est pas encore autorisée, on la crée
                            if (!$filiereAutorisee) {
                                Filiereautorise::create([
                                    'resultatsmission_id' => $resultatMissionFiliere->id,
                                    'filieres_id' => $filiereEnseignee->filieres_id,
                                    'diplomeprepares_id' => $filiereEnseignee->diplomeprepares_id,
                                    'capaciteacceuil' => $filiereEnseignee->capaciteacceuil,
                                    'ordre_enseignement_id' => $query1->ordre_enseignement_id,
                                ]);
                            }
                        }
                    }
                    // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
                    $resultatMissionFiliere = DB::table('resultatsmission')
                        ->where('rubriquecontrole_id', 6)
                        ->where('mission_id', $mission_id)
                        ->first();
                    return redirect('admin/suivifiliere/' . $resultatMissionFiliere->id . '/edit');
                });
                break;

            default:
                // $form->number('etablissementannees_id', __('Etablissement / année'));
                $lesetabannees = array();
                $etabannees = DB::table('etablissementannees')
                    ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                    ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                    ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
                    ->get();
                foreach ($etabannees as $etabannee) {
                    $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
                }
                $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees);
                $form->text('responsableetab', __('Nom & prénom du Responsable'));
                $form->text('contactresponsableetab', __('Contact du responsable'));
                $form->text('emailresponsableetab', __('Email du responsable'));
                
                $form->datetime('date', __('Date de debut mission'))->default(date('Y-m-d H:i:s'));
                $form->datetime('date_fin', __('Date de fin mission'))->default(date('Y-m-d H:i:s'));
                $form->datetime('date_visite', __('Date de visite mission'))->default(date('Y-m-d H:i:s'));
                $form->text('date_derniere_visite', __('Date de dernière visite'));

                $visite = ['1' => 'Oui', '0' => 'Non'];
                $form->select('visite', __("L'établissement a été visité"))->options($visite);

                $form->hasMany('participantsmissions', __('Participants de la mission'), function (Form\NestedForm $form) {

                    $lessuperviseurs = array();
                    $superviseurs = Superviseur::all();
                    foreach ($superviseurs as $superviseur) {
                        $lessuperviseurs[$superviseur->id] = $superviseur->matricule . ' ' . $superviseur->nom . ' ' . $superviseur->prenoms;
                    }
                    $form->select('superviseur_id', __('Participant'))->options($lessuperviseurs);
                    // $form->number('fonctionparticipants_id', __('Fonctionparticipants id'));
                    $lesfonctions = array();
                    $fonctions = Fonctionparticipant::all();
                    foreach ($fonctions as $fonction) {
                        $lesfonctions[$fonction->id] = $fonction->libellefonction;
                    }
                    $form->select('fonctionparticipants_id', __('Fonction'))->options($lesfonctions);
                })->useTable();
                $form->hasMany('resultatsmissions', __('Fiche d’observations et de recommandations'), function (Form\NestedForm $form) {
                    $query2 = Rubriquecontrole::orderBy('libellerubrique', 'ASC')
                        ->get(['id', 'libellerubrique'])
                        ->pluck('libellerubrique', 'id');

                    $form->select('rubriquecontrole_id', "Rubrique controle")
                        ->options($query2);

                    // $form->number('rubriquecontrole_id', __('Rubriquecontrole id'));
                    $form->textarea('observation', __('Observation'));
                    $form->textarea('recommandation', __('Recommandation'));
                    $form->textarea('periode_execution', __('Période d\'éxécution'));
                })->useTable();

                $form->tools(function (Form\Tools $tools) {

                    // Disable `List` btn.
                    $tools->disableList();

                    // Disable `Delete` btn.
                    $tools->disableDelete();

                    // Disable `Veiw` btn.
                    $tools->disableView();
                });
                $form->footer(function ($footer) {

                    // disable reset btn
                    $footer->disableReset();

                    // disable `View` checkbox
                    $footer->disableViewCheck();

                    // disable `Continue editing` checkbox
                    $footer->disableEditingCheck();

                    // disable `Continue Creating` checkbox
                    $footer->disableCreatingCheck();
                });

                // Get the current mission ID
                $form->saved(function (Form $form) {
                    $mission_id = $form->model()->id;
                    // Récupérer l'objet de la mission associée après la sauvegarde
                    $etablissementAnneeId = $form->model()->etablissementannees_id;

                    // Récupérer l'identifiant etablissementannees_id à partir de la mission
                    if ($etablissementAnneeId) {

                        // Récupérer les filières enseignées pour cet etablissementannees_id
                        $filiereEnseignees = Filiereenseigne::where('etablissementannees_id', $etablissementAnneeId)->get();

                        // Boucler sur les filières enseignées pour les mettre à jour ou créer des filières autorisées
                        foreach ($filiereEnseignees as $filiereEnseignee) {
                            $query1 = DB::table('etablissementannees')
                                ->select('ordre_enseignement.id as ordre_enseignement_id')
                                ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                                ->leftJoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
                                ->where('etablissementannees.id', $etablissementAnneeId)
                                ->first();

                            $resultatMissionFiliere = DB::table('resultatsmission')
                                ->where('rubriquecontrole_id', 6)
                                ->where('mission_id', $mission_id)
                                ->first();
                            // Vérifier si la filière autorisée existe déjà pour cet établissement et année
                            $filiereAutorisee = Filiereautorise::where('resultatsmission_id', $resultatMissionFiliere->id)
                                ->where('filieres_id', $filiereEnseignee->filieres_id)  // Supposons qu'il y a un champ filiere_id
                                ->first();
                            // Si la filière n'est pas encore autorisée, on la crée
                            if (!$filiereAutorisee) {
                                Filiereautorise::create([
                                    'resultatsmission_id' => $resultatMissionFiliere->id,
                                    'filieres_id' => $filiereEnseignee->filieres_id,
                                    'diplomeprepares_id' => $filiereEnseignee->diplomeprepares_id,
                                    'capaciteacceuil' => $filiereEnseignee->capaciteacceuil,
                                    'ordre_enseignement_id' => $query1->ordre_enseignement_id,
                                ]);
                            }
                        }
                    }
                    // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
                    $resultatMissionFiliere = DB::table('resultatsmission')
                        ->where('rubriquecontrole_id', 6)
                        ->where('mission_id', $mission_id)
                        ->first();
                    return redirect('admin/suivifiliere/' . $resultatMissionFiliere->id . '/edit');
                });
                break;
        }


        return $form;
    }
}
