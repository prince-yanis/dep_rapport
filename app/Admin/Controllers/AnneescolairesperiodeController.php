<?php

namespace App\Admin\Controllers;

use App\Models\Anneescolaire;
use App\Models\Anneescolairesperiode;
use App\Models\Periode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AnneescolairesperiodeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Année scolaires période';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new anneescolairesperiode());

        $grid->column('id', __('Id'));
        $grid->column('periodes_id', __('Périodes'));
        $grid->column('anneescolaires_id', __('Année scolaire '));
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
        $show = new Show(anneescolairesperiode::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('periodes_id', __('Périodes'));
        $show->field('anneescolaires_id', __('Année scolaire'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new anneescolairesperiode());

        // $form->number('periodes_id', __('Periodes id'));
        $lesperiodes=array();
        $periodes=Periode::all();
        foreach ($periodes as $periode) {
            $lesperiodes[$periode->id]=$periode->libelleperiode;
        }
        $form->select('periodes_id', __('Période'))->options($lesperiodes);
        // $form->number('anneescolaires_id', __('Anneescolaires id'));
        $lesannees=array();
        $annees=Anneescolaire::all();
        foreach ($annees as $annee) {
            $lesannees[$annee->id]=$annee->libelleanneescolaire;
        }
        $form->select('anneescolaires_id', __('Année scolaire'))->options($lesannees);

        return $form;
    }
}
