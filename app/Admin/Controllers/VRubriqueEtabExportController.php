<?php

namespace App\Admin\Controllers;

use App\Exports\VRubriqueEtabExport;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\VRubriqueEtab;
use Maatwebsite\Excel\Facades\Excel;
use Encore\Admin\Controllers\AdminController;

class VRubriqueEtabExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'VRubriqueEtab';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VRubriqueEtab());

        $grid->column('id', __('ID'));
        $grid->column('rubriquecontrole_id', __('Rubrique Contrôle ID'));
        $grid->column('mission_id', __('Mission ID'));
        $grid->column('recommandation', __('Recommandation'));
        $grid->column('observation', __('Observation'));
        $grid->column('periode_execution', __('Période d\'exécution'));
        $grid->column('rubriquecontroles_id', __('Rubrique Contrôles ID'));
        $grid->column('libellerubrique', __('Libellé Rubrique'));
        $grid->column('missions_id', __('Missions ID'));
        $grid->column('etablissementannees_id', __('Établissement Années ID'));
        $grid->column('etabannee_id', __('Étab Année ID'));
        $grid->column('etablissements_id', __('Établissements ID'));
        $grid->column('anneescolaires_id', __('Années Scolaires ID'));
        $grid->column('denominationetab', __('Dénomination Établissement'));
        $grid->column('libelleanneescolaire', __('Libellé Année Scolaire'));

        $grid->tools(function ($tools) {
            $tools->append("<a href='vrubriqueetabs/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
        });

        $grid->disableActions();
        $grid->disableCreateButton();
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
    public function detail($id)
    {
        $show = new Show(VRubriqueEtab::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VRubriqueEtab());



        return $form;
    }

    public function export() 
    {
        return Excel::download(new VRubriqueEtabExport, 'V_Rubrique_Controle.xlsx');
    }
}
