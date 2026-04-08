<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Equipement;
use App\Models\Resultatsmission;
use App\Models\Rubriquecontrole;
use Illuminate\Support\Facades\DB;
use App\Models\Resultatstypesequipement;
use Encore\Admin\Controllers\AdminController;

class ResultatstypesequipementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resultatstypesequipement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Resultatstypesequipement());

        $grid->column('id', __('Id'));
        $grid->column('observationpartielles', __('Observationpartielles'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('resultatsmission_id', __('Resultatsmission id'));

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
        $show = new Show(Resultatstypesequipement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observationpartielles', __('Observationpartielles'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
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
        $form = new Form(new Resultatstypesequipement());

        // $form->number('resultatsmission_id', __('Resultatsmission id'));
        $query2 = Resultatsmission::get(['id'])->pluck('id');
        $form->select('resultatsmission_id', "Resultats de la mission")->options($query2);
        // $form->number('detailsequipement_id', __('Detailsequipement id'));
        // $form->number('detailsinfrastructure_id', __('Detailsinfrastructure id'));

        $form->hasMany('detailsequipements', __('Equipement'), function (Form\NestedForm $form) {

            $query2 = Rubriquecontrole::get(['id', 'libellerubrique'])->pluck('libellerubrique', 'id');
            $form->select('rubriquecontrole_id', "Rubrique controle")->options($query2);

            $lesequipements = array();
            $equipements = DB::table('equipements')
                ->leftJoin('materiels', 'equipements.materiels_id', '=', 'materiels.id')
                ->select('equipements.*', 'materiels.libellemateriel')
                ->get();
            foreach ($equipements as $equipement) {
                $lesequipements[$equipement->id] = $equipement->libellemateriel;
            }
            $form->select('equipements_id', __('Equipements'))->options($lesequipements);

            // $form->number('equipements_id', __('Equipements id'));
            $form->number('nbrefonctionnel', __('Nombre fonctionnel'))->attribute('class', 'form-control no-spin');
            $form->number('nbrenonfonctionnel', __('Nombre non fonctionnel'))->attribute('class', 'form-control no-spin');
        })->useTable();
        $form->hasMany('detailsinfrastructures', __('Infrastructure'), function (Form\NestedForm $form) {

            // $lespersonnels = array();
            // $personnels = Fonctionpersonnel::all();
            // // $personnels = Personnel::orderBy('nom', 'ASC')->get();
            // foreach ($personnels as $personnel) {
            //     $lespersonnels[$personnel->id] = $personnel->libellefonction;
            // }
            // $form->select('fonctionpersonnels_id', __('Fonction personnels'))->options($lespersonnels);
            // $form->number('rubriquecontrole_id', __('Rubrique controle'));
            $query2 = Rubriquecontrole::get(['id', 'libellerubrique'])->pluck('libellerubrique', 'id');
            $form->select('rubriquecontrole_id', "Rubrique controle")->options($query2);
            // $form->number('infrastructures_id', __('Infrastructures id'));
            $lesinfrastructure = array();
            $infrastructures = DB::table('infrastructures')
                ->leftJoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
                ->select('infrastructures.*', 'designationinfrastructures.libelleinfrastructure')
                ->get();
            foreach ($infrastructures as $infrastructure) {
                $lesinfrastructure[$infrastructure->id] = $infrastructure->libelleinfrastructure;
            }
            $form->select('infrastructures_id', __('Infrastructures'))->options($lesinfrastructure);

            $form->number('nbrefonctionnel', __('Nombre fonctionnel'))->attribute('class', 'form-control no-spin');
            $form->number('nbrenonfonctionnel', __('Nombre non fonctionnel'))->attribute('class', 'form-control no-spin');
        })->useTable();
        $form->textarea('observationpartielles', __('Observation partielles'));

        return $form;
    }
}
