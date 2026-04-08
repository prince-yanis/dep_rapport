<?php

namespace App\Admin\Controllers;

use App\Models\Niveau;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRoleUser;
use App\Models\Resultatsmission;
use App\Models\Effectifsetstatut;
use App\Models\OrdreEnseignement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class SuiviEffectifsetstatutController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Effectifsetstatut';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Effectifsetstatut());

        $grid->column('id', __('Id'));
        $grid->column('resultatsmission_id', __('Resultats mission'));
        $grid->column('nbretotal', __('Nombre total'));
        $grid->column('observations', __('Observations'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        // $grid->column('ordre_enseignement_id', __('Ordre enseignement id'));

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
        $show = new Show(Effectifsetstatut::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nbretotal', __('Nombre total'));
        $show->field('observations', __('Observations'));
        $show->field('resultatsmission_id', __('Resultats mission'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        // $show->field('ordre_enseignement_id', __('Ordre enseignement id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Effectifsetstatut());

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
    
    <h1 style="text-align:center; text-transform:uppercase;">Effectifs et statut des élèves de l année en cours</h1>
        <div class="menu-links">
        <span><a href="/admin/suivimissionedit/' . session('mission') . '/edit">Mission</a></span> |
        <span><a href="/admin/suivifiliere/' . $resultatMissionFiliere->id . '/edit">Filières autorisés</a></span> |
        <span><a href="/admin/suivipersonnel/' . $typepersonnel->id . '/edit">Gestion administrative</a></span> |
        <span><a href="/admin/suiviequipement/' . $typeequipement->id . '/edit">Infrastructures et Equipements</a></span> |
        <span><a href="/admin/suivicontrole_1/' . $resultatscontrole_1->id . '/edit">Gestion pédagogique</a></span> |
        <span><a href="/admin/suiviscolaires/' . $resultatsscolaire->id . '/edit">Résultats scolaires</a></span> |
        <span>Effectifs et statut des élèves de l année en cours</span> |
        <span><a href="/admin/suivicontrole_4/' . $resultatscontrole_4->id . '/edit">Gestion financière et juridique</a></span> |
        <span><a href="/admin/suivicontrole_5/' . $resultatscontrole_5->id . '/edit">Relation avec le milieu professionnel</a></span> |
        <span><a href="/admin/suivicontrole_6/' . $resultatscontrole_6->id . '/edit">Environnement Sécurité Hygiene et Santé</a></span>
    
        </div>
    ');

        // $form->number('resultatsmission_id', __('Resultatsmission id'));
        // $query1 = Resultatsmission::get(['id'])->pluck('id');
        // $form->select('resultatsmission_id', "Resultats de la mission")->options($query1);

        // $form->number('nbretotal', __('Nombre total'))->attribute('class', 'form-control no-spin');
        // $form->number('ordre_enseignement_id', __('Ordre enseignement id'));
        switch ($role_id) {
            case 2:
                $form->hasMany('detailseffectifsetstatut', __("Détails sur l'éffectif"), function (Form\NestedForm $form) {

                    $query2 = OrdreEnseignement::get(['id', 'libelleenseignement'])->pluck('libelleenseignement', 'id');
                    $form->select('ordre_enseignement_id', "Ordre enseignement")->options($query2)->readOnly();

                    $query2 = Niveau::get(['id', 'libelleniveau'])->pluck('libelleniveau', 'id');
                    $form->select('niveau_id', "Niveau")->options($query2)->readOnly();

                    // $form->number('ordre_enseignement_id', __('Ordre enseignement'));
                    // $form->number('niveau_id', __('Niveau'));
                    $form->number('nbreaffecte', __("Nombre d'affecté"))->attribute('class', 'form-control no-spin');
                    $form->number('nbrenonaffecte', __("Nombre non affecté"))->attribute('class', 'form-control no-spin');
                    $form->number('total', __("Nombre total"))->attribute('class', 'form-control no-spin');
                })->useTable()
                ->disableCreate() // Désactiver le bouton "Nouveau"
                ->disableDelete();
                // $form->textarea('observations', __('Observations'));

                $form->saved(function (Form $form) {
                    // Get the current mission ID
                    // $mission_id = $form->model()->mission_id;
                    $resultatsmission_id = $form->model()->resultatsmission_id;
                    // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
                    // Query the `resultatsmissions` table to get the related `mission_id`
                    $resultatMission = DB::table('resultatsmission')
                        ->where('id', $resultatsmission_id)
                        ->first();

                    $mission_id = $resultatMission->mission_id;

                    $resultatsmission = DB::table('resultatsmission')
                        ->where('rubriquecontrole_id', 2)
                        ->where('mission_id', $mission_id)
                        ->first();
                    $resultatscontrole = DB::table('resultatscontrole')
                        ->where('resultatsmission_id', $resultatsmission->id)
                        ->where('sousrubriquecontrole_id', 4)
                        ->first();

                    // $resultatsmission_id = $form->model()->resultatsmission_id;
                    // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission

                    return redirect('admin/suivicontrole_4/' . $resultatscontrole->id . '/edit');
                });
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
                break;
            default:
                $form->hasMany('detailseffectifsetstatut', __("Détails sur l'éffectif"), function (Form\NestedForm $form) {

                    $query2 = OrdreEnseignement::get(['id', 'libelleenseignement'])->pluck('libelleenseignement', 'id');
                    $form->select('ordre_enseignement_id', "Ordre enseignement")->options($query2);

                    $query2 = Niveau::get(['id', 'libelleniveau'])->pluck('libelleniveau', 'id');
                    $form->select('niveau_id', "Niveau")->options($query2);

                    // $form->number('ordre_enseignement_id', __('Ordre enseignement'));
                    // $form->number('niveau_id', __('Niveau'));
                    $form->number('nbreaffecte', __("Nombre d'affecté"))->attribute('class', 'form-control no-spin');
                    $form->number('nbrenonaffecte', __("Nombre non affecté"))->attribute('class', 'form-control no-spin');
                    $form->number('total', __("Nombre total"))->attribute('class', 'form-control no-spin');
                })->useTable();
                $form->textarea('observations', __('Observations'));

                $form->saved(function (Form $form) {
                    // Get the current mission ID
                    // $mission_id = $form->model()->mission_id;
                    $resultatsmission_id = $form->model()->resultatsmission_id;
                    // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
                    // Query the `resultatsmissions` table to get the related `mission_id`
                    $resultatMission = DB::table('resultatsmission')
                        ->where('id', $resultatsmission_id)
                        ->first();

                    $mission_id = $resultatMission->mission_id;

                    $resultatsmission = DB::table('resultatsmission')
                        ->where('rubriquecontrole_id', 2)
                        ->where('mission_id', $mission_id)
                        ->first();
                    $resultatscontrole = DB::table('resultatscontrole')
                        ->where('resultatsmission_id', $resultatsmission->id)
                        ->where('sousrubriquecontrole_id', 4)
                        ->first();

                    // $resultatsmission_id = $form->model()->resultatsmission_id;
                    // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission

                    return redirect('admin/suivicontrole_4/' . $resultatscontrole->id . '/edit');
                });
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
                break;
        }

        return $form;
    }
}
