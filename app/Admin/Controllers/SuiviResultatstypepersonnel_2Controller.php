<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRoleUser;
use App\Models\Typepersonnel;
use App\Models\Resultatsmission;
use App\Models\Fonctionpersonnel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Resultatstypepersonnel;
use Encore\Admin\Controllers\AdminController;

class SuiviResultatstypepersonnel_2Controller extends AdminController
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
        $grid = new Grid(new Resultatstypepersonnel());

        $grid->column('id', __('Id'));
        $grid->column('resultatsmission_id', __('Resultats de la mission'));
        $grid->column('typepersonnels_id', __('Type du personnels'));
        $grid->column('observationpartielles', __('Observation partielles'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Resultatstypepersonnel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observationpartielles', __('Observationpartielles'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('typepersonnels_id', __('Typepersonnels id'));
        $show->field('resultatsmission_id', __('Resultatsmission id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Resultatstypepersonnel());

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
    
    <h1 style="text-align:center; text-transform:uppercase;">Personnel enseignant</h1>
        <div class="menu-links">
            <span><a href="/admin/suivimissionedit/' . session('mission') . '/edit">Mission</a></span> |
            <span><a href="/admin/suivifiliere/' . $resultatMissionFiliere->id . '/edit">Filières autorisés</a></span> |
        <span>Gestion administrative</span> |
        <span><a href="/admin/suiviequipement/' . $typeequipement->id . '/edit">Infrastructures et Equipements</a></span> |
        <span><a href="/admin/suivicontrole_1/' . $resultatscontrole_1->id . '/edit">Gestion pédagogique</a></span> |
        <span><a href="/admin/suiviscolaires/' . $resultatsscolaire->id . '/edit">Résultats scolaires</a></span> |
        <span><a href="/admin/suivieffectifs/' . $resultatsscolaire->id . '/edit">Effectifs et statut des élèves de l année en cours</a></span> |
        <span><a href="/admin/suivicontrole_4/' . $resultatscontrole_4->id . '/edit">Gestion financière et juridique</a></span> |
        <span><a href="/admin/suivicontrole_5/' . $resultatscontrole_5->id . '/edit">Relation avec le milieu professionnel</a></span> |
        <span><a href="/admin/suivicontrole_6/' . $resultatscontrole_6->id . '/edit">Environnement Sécurité Hygiene et Santé</a></span>

        </div>
    ');

        // $query2 = Resultatsmission::orderBy('id', 'ASC')
        //     ->get(['id'])
        //     ->pluck('id');

        // $form->select('resultatsmission_id', "Resultats de la mission")
        //     ->options($query2);

        switch ($role_id) {
            case 2:
                $query3 = Typepersonnel::orderBy('id', 'ASC')
            ->get(['id', 'libelletypepersonnel'])
            ->pluck('libelletypepersonnel', 'id');

        $form->select('typepersonnels_id', "Type du personnels")
            ->options($query3)->readOnly();

        // $form->number('resultatsmission_id', __('Resultats de la mission'));
        // $form->number('typepersonnels_id', __('Type du personnels'));

        $form->hasMany('detailsresultatspersonnels', __('Personnels'), function (Form\NestedForm $form) {

            $lespersonnels = array();
            $personnels = Fonctionpersonnel::all();
            // $personnels = Personnel::orderBy('nom', 'ASC')->get();
            foreach ($personnels as $personnel) {
                $lespersonnels[$personnel->id] = $personnel->libellefonction;
            }
            $form->select('fonctionpersonnels_id', __('Fonction personnels'))->options($lespersonnels)->readOnly();

            // $form->number('fonctionpersonnels_id', __('Fonctionpersonnels id'));
            $form->number('effectif', __('Effectif'))->attribute('class', 'form-control no-spin');
            $form->number('autorise', __('Nombre Autorisé'))->attribute('class', 'form-control no-spin');
            $form->number('nbredossierphysique', __('Nombre de dossier physique'))->attribute('class', 'form-control no-spin');
            // $form->number('resultatstypepersonnel_id', __('Resultatstypepersonnel id'));
        })->useTable()
        ->disableCreate() // Désactiver le bouton "Nouveau"
        ->disableDelete();
        // $form->textarea('observationpartielles', __('Observation partielles'));

        $form->saved(function (Form $form) {
            // Get the current mission ID
            // $mission_id = $form->model()->mission_id;
            $resultatsmission_id = $form->model()->resultatsmission_id;
            // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
            // $resultatMission = DB::table('resultatsmission')
            //     ->where('rubriquecontrole_id', 6)
            //     ->where('mission_id', $mission_id)
            //     ->first();
            $typepersonnel = DB::table('resultatstypepersonnel')
                ->where('resultatsmission_id', $resultatsmission_id)
                ->where('typepersonnels_id', 2)
                ->first();
            return redirect('admin/suivipersonnel_3/' . $typepersonnel->id . '/edit');
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
            $query3 = Typepersonnel::orderBy('id', 'ASC')
            ->get(['id', 'libelletypepersonnel'])
            ->pluck('libelletypepersonnel', 'id');

        $form->select('typepersonnels_id', "Type du personnels")
            ->options($query3)->readOnly();

        // $form->number('resultatsmission_id', __('Resultats de la mission'));
        // $form->number('typepersonnels_id', __('Type du personnels'));

        $form->hasMany('detailsresultatspersonnels', __('Personnels'), function (Form\NestedForm $form) {

            $lespersonnels = array();
            $personnels = Fonctionpersonnel::all();
            // $personnels = Personnel::orderBy('nom', 'ASC')->get();
            foreach ($personnels as $personnel) {
                $lespersonnels[$personnel->id] = $personnel->libellefonction;
            }
            $form->select('fonctionpersonnels_id', __('Fonction personnels'))->options($lespersonnels)->readOnly();

            // $form->number('fonctionpersonnels_id', __('Fonctionpersonnels id'));
            $form->number('effectif', __('Effectif'))->attribute('class', 'form-control no-spin');
            $form->number('autorise', __('Nombre Autorisé'))->attribute('class', 'form-control no-spin');
            // $form->number('nbredossierphysique', __('Nombre de dossier physique'))->attribute('class', 'form-control no-spin');
            // $form->number('resultatstypepersonnel_id', __('Resultatstypepersonnel id'));
        })->useTable();
        $form->textarea('observationpartielles', __('Observation partielles'));

        $form->saved(function (Form $form) {
            // Get the current mission ID
            // $mission_id = $form->model()->mission_id;
            $resultatsmission_id = $form->model()->resultatsmission_id;
            // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
            // $resultatMission = DB::table('resultatsmission')
            //     ->where('rubriquecontrole_id', 6)
            //     ->where('mission_id', $mission_id)
            //     ->first();
            $typepersonnel = DB::table('resultatstypepersonnel')
                ->where('resultatsmission_id', $resultatsmission_id)
                ->where('typepersonnels_id', 2)
                ->first();
            return redirect('admin/suivipersonnel_3/' . $typepersonnel->id . '/edit');
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
