<?php

namespace App\Admin\Controllers;

use App\Exports\VEtablissementExport;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\VEtablissement;
use Maatwebsite\Excel\Facades\Excel;
use Encore\Admin\Controllers\AdminController;

class VEtablissementExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'VEtablissement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VEtablissement());

        $grid->column('id', __('ID'));
        $grid->column('denominationetab', __('Dénomination Établissement'));
        $grid->column('code', __('Code'));
        $grid->column('numautorisationouverture', __('N° Autorisation Ouverture'));
        $grid->column('numautorisationcreation', __('N° Autorisation Création'));
        $grid->column('telephone', __('Téléphone'));
        $grid->column('ordre_id', __('Ordre ID'));
        $grid->column('ordre_libelle', __('Libellé Ordre'));
        $grid->column('direction_id', __('Direction ID'));
        $grid->column('direction_libelle', __('Libellé Direction'));

        $grid->tools(function ($tools) {
            $tools->append("<a href='vetablissements/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
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
        $show = new Show(VEtablissement::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VEtablissement());



        return $form;
    }

    public function export() 
    {
        return Excel::download(new VEtablissementExport, 'V_Etablissement.xlsx');
    }
}
