<?php

namespace App\Admin\Controllers;

use App\Exports\VFiliereEnseigneExport;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\VFiliereEnseigne;
use Maatwebsite\Excel\Facades\Excel;
use Encore\Admin\Controllers\AdminController;

class VFiliereEnseigneExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'VFiliereEnseigne';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VFiliereEnseigne());

        $grid->column('id', __('ID'));
        $grid->column('observation', __('Observation'));
        $grid->column('numautorisationouverture', __('Numéro Autorisation d\'Ouverture'));
        $grid->column('filieres_id', __('Filière ID'));
        $grid->column('libellefiliere', __('Libellé Filière'));
        $grid->column('ordre_id', __('Ordre ID'));
        $grid->column('libelleenseignement', __('Libellé Enseignement'));
        $grid->column('etablissementannees_id', __('Établissement Années ID'));
        $grid->column('etablissements_id', __('Établissements ID'));
        $grid->column('anneescolaires_id', __('Années Scolaires ID'));
        $grid->column('denominationetab', __('Dénomination Établissement'));
        $grid->column('libelleanneescolaire', __('Libellé Année Scolaire'));

        $grid->tools(function ($tools) {
            $tools->append("<a href='vfiliereenseignes/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
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
    protected function detail($id)
    {
        $show = new Show(VFiliereEnseigne::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VFiliereEnseigne());



        return $form;
    }

    public function export() 
    {
        return Excel::download(new VFiliereEnseigneExport, 'V_Filiere.xlsx');
    }
}
