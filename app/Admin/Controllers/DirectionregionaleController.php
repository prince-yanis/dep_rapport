<?php

namespace App\Admin\Controllers;

use App\Models\Directionregionale;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DirectionregionaleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Directionregionale';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Directionregionale());

        $grid->column('id', __('Id'));
        $grid->column('denominationdr', __('Denominationdr'));
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
        $show = new Show(Directionregionale::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('denominationdr', __('Denominationdr'));
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
        $form = new Form(new Directionregionale());

        $form->text('denominationdr', __('Denominationdr'));

        return $form;
    }
}
