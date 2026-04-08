<?php

namespace App\Admin\Controllers;

use App\Models\Etatgestion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EtatgestionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Etatgestion';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new etatgestion());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('nature', __('Nature'));
        $grid->column('difficultes', __('Difficultes'));
        $grid->column('causes', __('Causes'));
        $grid->column('suggestions', __('Suggestions'));
        $grid->column('observations', __('Observations'));

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
        $show = new Show(etatgestion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('nature', __('Nature'));
        $show->field('difficultes', __('Difficultes'));
        $show->field('causes', __('Causes'));
        $show->field('suggestions', __('Suggestions'));
        $show->field('observations', __('Observations'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new etatgestion());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->text('nature', __('Nature'));
        $form->text('difficultes', __('Difficultes'));
        $form->text('causes', __('Causes'));
        $form->text('suggestions', __('Suggestions'));
        $form->textarea('observations', __('Observations'));

        return $form;
    }
}
