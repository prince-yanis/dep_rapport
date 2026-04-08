<?php

namespace App\Admin\Controllers;

use App\Models\FraisScolarite;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FraisScolariteController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FraisScolarite';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FraisScolarite());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('nature', __('Nature'));
        $grid->column('nombre_eleve', __('Nombre eleve'));
        $grid->column('total_percus', __('Total percus'));
        $grid->column('part_etab', __('Part etab'));
        $grid->column('part_fonds', __('Part fonds'));
        $grid->column('observations', __('Observations'));
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
        $show = new Show(FraisScolarite::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('nature', __('Nature'));
        $show->field('nombre_eleve', __('Nombre eleve'));
        $show->field('total_percus', __('Total percus'));
        $show->field('part_etab', __('Part etab'));
        $show->field('part_fonds', __('Part fonds'));
        $show->field('observations', __('Observations'));
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
        $form = new Form(new FraisScolarite());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->text('nature', __('Nature'));
        $form->text('nombre_eleve', __('Nombre eleve'));
        $form->number('total_percus', __('Total percus'));
        $form->number('part_etab', __('Part etab'));
        $form->number('part_fonds', __('Part fonds'));
        $form->text('observations', __('Observations'));

        return $form;
    }
}
