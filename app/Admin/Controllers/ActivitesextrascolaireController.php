<?php

namespace App\Admin\Controllers;

use App\Models\Activitesextrascolaire;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ActivitesextrascolaireController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Activitesextrascolaire';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Activitesextrascolaire());

        $grid->column('id', __('Id'));
        $grid->column('nature', __('Nature'));
        $grid->column('objectif', __('Objectif'));
        $grid->column('observation', __('Observation'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
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
        $show = new Show(Activitesextrascolaire::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nature', __('Nature'));
        $show->field('objectif', __('Objectif'));
        $show->field('observation', __('Observation'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
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
        $form = new Form(new Activitesextrascolaire());

        $form->text('nature', __('Nature'));
        $form->textarea('objectif', __('Objectif'));
        $form->textarea('observation', __('Observation'));
        $form->number('etablissementannees_id', __('Etablissementannees id'));

        return $form;
    }
}
