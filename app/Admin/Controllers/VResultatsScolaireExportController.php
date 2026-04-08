<?php

namespace App\Admin\Controllers;

use App\Exports\VResultatsScolaireExport;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\VResultatsScolaire;
use Maatwebsite\Excel\Facades\Excel;
use Encore\Admin\Controllers\AdminController;

class VResultatsScolaireExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'VResultatsScolaire';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VResultatsScolaire());

        $grid->column('id', __('ID'));
        $grid->column('total_admis', __('Total Admis'));
        $grid->column('taux', __('Taux'));
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
            $tools->append("<a href='vresultatsscolaires/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
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
        $show = new Show(VResultatsScolaire::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VResultatsScolaire());



        return $form;
    }

    public function export() 
    {
        return Excel::download(new VResultatsScolaireExport, 'V_Resultats_Scolaire.xlsx');
    }
}
