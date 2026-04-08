<?php

namespace App\Admin\Controllers;

use App\Models\PointExecution;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PointExecutionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PointExecution';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PointExecution());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('total_chapitre', __('Total chapitre'));
        $grid->column('chapitres_execute', __('Chapitres execute'));
        $grid->column('total_lecon', __('Total lecon'));
        $grid->column('lecons_execute', __('Lecons execute'));
        $grid->column('disciplines_id', __('Disciplines id'));
        $grid->column('pourcentage_chapitre', __('Pourcentage chapitre'));
        $grid->column('pourcentage_lecon', __('Pourcentage lecon'));
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
        $show = new Show(PointExecution::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('total_chapitre', __('Total chapitre'));
        $show->field('chapitres_execute', __('Chapitres execute'));
        $show->field('total_lecon', __('Total lecon'));
        $show->field('lecons_execute', __('Lecons execute'));
        $show->field('disciplines_id', __('Disciplines id'));
        $show->field('pourcentage_chapitre', __('Pourcentage chapitre'));
        $show->field('pourcentage_lecon', __('Pourcentage lecon'));
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
        $form = new Form(new PointExecution());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->number('total_chapitre', __('Total chapitre'));
        $form->number('chapitres_execute', __('Chapitres execute'));
        $form->number('total_lecon', __('Total lecon'));
        $form->number('lecons_execute', __('Lecons execute'));
        $form->number('disciplines_id', __('Disciplines id'));
        $form->decimal('pourcentage_chapitre', __('Pourcentage chapitre'));
        $form->decimal('pourcentage_lecon', __('Pourcentage lecon'));
        $form->text('observations', __('Observations'));

        return $form;
    }
}
