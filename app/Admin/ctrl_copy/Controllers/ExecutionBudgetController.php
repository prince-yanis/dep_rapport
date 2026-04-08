<?php

namespace App\Admin\Controllers;

use App\Models\ExecutionBudget;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExecutionBudgetController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ExecutionBudget';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ExecutionBudget());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('ligne_budgetaire', __('Ligne budgetaire'));
        $grid->column('designation', __('Designation'));
        $grid->column('dotation', __('Dotation'));
        $grid->column('engagement', __('Engagement'));
        $grid->column('solde', __('Solde'));
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
        $show = new Show(ExecutionBudget::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('ligne_budgetaire', __('Ligne budgetaire'));
        $show->field('designation', __('Designation'));
        $show->field('dotation', __('Dotation'));
        $show->field('engagement', __('Engagement'));
        $show->field('solde', __('Solde'));
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
        $form = new Form(new ExecutionBudget());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->text('ligne_budgetaire', __('Ligne budgetaire'));
        $form->text('designation', __('Designation'));
        $form->number('dotation', __('Dotation'));
        $form->number('engagement', __('Engagement'));
        $form->number('solde', __('Solde'));

        return $form;
    }
}
