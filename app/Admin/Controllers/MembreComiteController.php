<?php

namespace App\Admin\Controllers;

use App\Models\MembreComite;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MembreComiteController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MembreComite';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MembreComite());

        $grid->column('id', __('Id'));
        $grid->column('libellemembre', __('Libellemembre'));
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
        $show = new Show(MembreComite::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libellemembre', __('Libellemembre'));
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
        $form = new Form(new MembreComite());

        $form->text('libellemembre', __('Libellemembre'));

        return $form;
    }
}
