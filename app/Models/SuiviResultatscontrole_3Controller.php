<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Itemscontrole;
use App\Models\Resultatsmission;
use App\Models\Resultatscontrole;
use Illuminate\Support\Facades\DB;
use App\Models\Sousrubriquecontrole;
use Encore\Admin\Controllers\AdminController;

class SuiviResultatscontrole_3Controller extends AdminController
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
        $grid = new Grid(new Resultatscontrole());

        $grid->column('id', __('Id'));
        $grid->column('observationpartielles', __('Observationpartielles'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('resultatsmission_id', __('Resultatsmission id'));
        $grid->column('sousrubriquecontrole_id', __('Sousrubriquecontrole id'));

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
        $show = new Show(Resultatscontrole::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observationpartielles', __('Observationpartielles'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('resultatsmission_id', __('Resultatsmission id'));
        $show->field('sousrubriquecontrole_id', __('Sousrubriquecontrole id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Resultatscontrole());
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
    
    <h1 style="text-align:center; text-transform:uppercase;">Gestion pédagogique (Suivi des apprenants et Assistance)</h1>
        <div class="menu-links">
        <span><a href="/admin/suivimissionedit/' . session('mission') . '/edit">Mission</a></span> |
        <span><a href="/admin/suivifiliere/' . $resultatMissionFiliere->id . '/edit">Filières autorisés</a></span> |
        <span><a href="/admin/suivipersonnel/' . $typepersonnel->id . '/edit">Gestion administrative</a></span> |
        <span><a href="/admin/suiviequipement/' . $typeequipement->id . '/edit">Infrastructures et Equipements</a></span> |
        <span>Gestion pédagogique</span> |
        <span><a href="/admin/suiviscolaires/' . $resultatsscolaire->id . '/edit">Résultats scolaires</a></span> |
        <span><a href="/admin/suivieffectifs/' . $resultatsscolaire->id . '/edit">Effectifs et statut des élèves de l année en cours</a></span> |
        <span><a href="/admin/suivicontrole_4/' . $resultatscontrole_4->id . '/edit">Gestion financière et juridique</a></span> |
        <span><a href="/admin/suivicontrole_5/' . $resultatscontrole_5->id . '/edit">Relation avec le milieu professionnel</a></span> |
        <span><a href="/admin/suivicontrole_6/' . $resultatscontrole_6->id . '/edit">Environnement Sécurité Hygiene et Santé</a></span> 
    
        </div>
    ');

        // $form->number('resultatsmission_id', __('Resultatsmission id'));
        // $query2 = Resultatsmission::orderBy('id', 'ASC')
        //     ->get(['id'])
        //     ->pluck('id');

        // $form->select('resultatsmission_id', "Resultats de la mission")
        //     ->options($query2);

        // $form->number('sousrubriquecontrole_id', __('Sousrubriquecontrole id'));
        $query3 = Sousrubriquecontrole::get(['id', 'libellesousrubrique'])
            ->pluck('libellesousrubrique', 'id');

        $form->select('sousrubriquecontrole_id', "Sous rubrique")
            ->options($query3);

        $form->hasMany('detailsresultatscontroles', __('Détails'), function (Form\NestedForm $form) {

            $lesitems = array();
            $items = Itemscontrole::all();
            foreach ($items as $item) {
                $lesitems[$item->id] = $item->libelleitems;
            }
            $form->select('itemscontrole_id', __('Items controle'))->options($lesitems);
            // $form->select('itemscontrole_id', __('Items controle'))->options('detailsresultatscontroles.itemscontrole_id');

            // $form->number('itemscontrole_id', __('Itemscontrole id'));
            $form->radio('existence', __('Existence'))->options(['0' => 'Oui', '1'=> 'Non'])->attribute('class', 'form-control no-spin');
            $form->textarea('observations', __('Observations'));
            // $form->number('resultatscontrole_id', __('Resultatscontrole id')); 
        })->useTable();
        $form->textarea('observationpartielles', __('Observationpartielles'));

        $form->saved(function (Form $form) {
            // Get the current mission ID
            // $mission_id = $form->model()->mission_id;
            $resultatsmission_id = $form->model()->resultatsmission_id;
            // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
            $resultatMission = DB::table('resultatsmission')
                ->where('id', $resultatsmission_id)
                ->first();
            $mission_id = $resultatMission->mission_id;
            $resultatsmission = DB::table('resultatsmission')
                ->where('rubriquecontrole_id', 1)
                ->where('mission_id', $mission_id)
                ->first();

            $resultatsscolaire = DB::table('resultatsscolaire')
                ->where('resultatsmission_id', $resultatsmission_id)
                ->first();
            return redirect('admin/suiviscolaires/' . $resultatsscolaire->id . '/edit');
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
