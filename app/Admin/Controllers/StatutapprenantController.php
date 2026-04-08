<?php

namespace App\Admin\Controllers;

use App\Models\Statutapprenant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StatutapprenantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Statutapprenant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new statutapprenant());

        $grid->column('id', __('Id'));
        $grid->column('libellestatutap', __('Libellestatutap'));
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
        $show = new Show(statutapprenant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libellestatutap', __('Libellestatutap'));
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
        $form = new Form(new statutapprenant());

        $form->text('libellestatutap', __('Libellestatutap'));

        return $form;
    }
}
