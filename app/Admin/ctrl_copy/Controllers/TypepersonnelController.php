<?php

namespace App\Admin\Controllers;

use App\Models\Typepersonnel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TypepersonnelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Typepersonnel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new typepersonnel());

        $grid->column('id', __('Id'));
        $grid->column('libelletypepersonnel', __('Libelletypepersonnel'));
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
        $show = new Show(typepersonnel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libelletypepersonnel', __('Libelletypepersonnel'));
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
        $form = new Form(new typepersonnel());

        $form->text('libelletypepersonnel', __('Libelletypepersonnel'));

        return $form;
    }
}
