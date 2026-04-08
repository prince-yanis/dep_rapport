<?php

namespace App\Admin\Controllers;

use App\Models\TravauxExterieur;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TravauxExterieurController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TravauxExterieur';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TravauxExterieur());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('nature', __('Nature'));
        $grid->column('client', __('Client'));
        $grid->column('montant_previsionnel', __('Montant previsionnel'));
        $grid->column('part_etab', __('Part etab'));
        $grid->column('part_fonds', __('Part fonds'));
        $grid->column('observations', __('Observations'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(TravauxExterieur::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('nature', __('Nature'));
        $show->field('client', __('Client'));
        $show->field('montant_previsionnel', __('Montant previsionnel'));
        $show->field('part_etab', __('Part etab'));
        $show->field('part_fonds', __('Part fonds'));
        $show->field('observations', __('Observations'));
        $show->field('updated_at', __('Updated at'));
        $show->field('created_at', __('Created at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TravauxExterieur());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->text('nature', __('Nature'));
        $form->text('client', __('Client'));
        $form->number('montant_previsionnel', __('Montant previsionnel'));
        $form->number('part_etab', __('Part etab'));
        $form->number('part_fonds', __('Part fonds'));
        $form->text('observations', __('Observations'));

        return $form;
    }
}
