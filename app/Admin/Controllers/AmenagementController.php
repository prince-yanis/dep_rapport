<?php

namespace App\Admin\Controllers;

use App\Models\Amenagement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AmenagementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Amenagement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Amenagement());

        $grid->column('id', __('Id'));
        $grid->column('designation', __('Designation'));
        $grid->column('existant', __('Existant'));
        $grid->column('besoin', __('Besoin'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('besoin_urgents_id', __('Besoin urgents id'));

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
        $show = new Show(Amenagement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('designation', __('Designation'));
        $show->field('existant', __('Existant'));
        $show->field('besoin', __('Besoin'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('besoin_urgents_id', __('Besoin urgents id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Amenagement());

        $form->text('designation', __('Designation'));
        $form->number('existant', __('Existant'));
        $form->number('besoin', __('Besoin'));
        $form->number('besoin_urgents_id', __('Besoin urgents id'));

        return $form;
    }
}
