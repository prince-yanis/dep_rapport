<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Filiere;
use App\Models\Mission;
use App\Models\Diplomeprepare;
use App\Models\Resultatsmission;
use App\Models\Rubriquecontrole;
use App\Models\OrdreEnseignement;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Controllers\AdminController;

class SuiviResultatsmissionController extends AdminController
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
        $grid = new Grid(new Resultatsmission());

        $grid->column('id', __('Id'));
        $grid->column('mission_id', __('Mission id'));
        $grid->column('rubriquecontrole_id', __('Rubriquecontrole id'));
        $grid->column('observation', __('Observation'));
        $grid->column('recommandation', __('Recommandation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Resultatsmission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observation', __('Observation'));
        $show->field('recommandation', __('Recommandation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('mission_id', __('Mission id'));
        $show->field('rubriquecontrole_id', __('Rubriquecontrole id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Resultatsmission());

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
        <span><a href="/admin/suivimissionedit/' . session('mission') . '/edit">Mission</a></span> |
        <span>Filières autorisés</span> |
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

        // $form->number('mission_id', __('Mission id'));

        // $form->number('rubriquecontrole_id', __('Rubriquecontrole id'));
        // $query2 = Rubriquecontrole::orderBy('libellerubrique', 'ASC')
        //     ->get(['id', 'libellerubrique'])
        //     ->pluck('libellerubrique', 'id');

        // $form->select('rubriquecontrole_id', "Rubrique controle")
        //     ->options($query2);
        $form->hasMany('filiereautorises', __('Filieres autorisés'), function (Form\NestedForm $form) {
            $lesordres = array();
            $ordres = OrdreEnseignement::all();
            foreach ($ordres as $ordre) {
                $lesordres[$ordre->id] = $ordre->libelleenseignement;
            }
            $form->select('ordre_enseignement_id', __('Ordre enseignement'))->options($lesordres);
            // $form->number('filieres_id', __('Filieres id'));
            $lesfilieres = array();
            $filieres = Filiere::all();
            foreach ($filieres as $filiere) {
                $lesfilieres[$filiere->id] = $filiere->libellefiliere;
            }
            $form->select('filieres_id', __('Filieres'))->options($lesfilieres);
            // $form->number('diplomeprepares_id', __('Diplomeprepares id'));
            $lesdiplomes = array();
            $diplomes = Diplomeprepare::all();
            foreach ($diplomes as $diplome) {
                $lesdiplomes[$diplome->id] = $diplome->libellediplome;
            }
            $form->select('diplomeprepares_id', __('Diplome préparé'))->options($lesdiplomes);
            $form->number('capaciteacceuil', __("Capacité d'acceuil"))->attribute('class', 'form-control no-spin');;
            $form->text('observation', __('Observation'));
            $form->textarea('observation', __('Observation'));
        })->useTable();
        $form->textarea('observation', __('Observation'));
        $form->text('recommandation', __('Recommandation'));

        $form->saved(function (Form $form) {
            // Get the current mission ID
            $mission_id = $form->model()->mission_id;
            // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
            $resultatMission = DB::table('resultatsmission')
                ->where('rubriquecontrole_id', 6)
                ->where('mission_id', $mission_id)
                ->first();
            $typepersonnel = DB::table('resultatstypepersonnel')
                ->where('resultatsmission_id', $resultatMission->id)
                ->where('typepersonnels_id', 3)
                ->first();
            return redirect('admin/suivipersonnel/' . $typepersonnel->id . '/edit');
        });
        $form->tools(function (Form\Tools $tools) {

            // Disable `List` btn.
            $tools->disableList();

            // Disable `Delete` btn.
            $tools->disableDelete();

            // Disable `Veiw` btn.
            $tools->disableView();
        });

        return $form;
    }
}
