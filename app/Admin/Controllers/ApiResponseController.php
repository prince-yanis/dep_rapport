<?php

namespace App\Admin\Controllers;

use App\Models\ApiResponse;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ApiResponseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ApiResponse';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ApiResponse());

        $grid->column('id', __('Id'));
        $grid->column('sender', __('Sender'));
        $grid->column('code', __('Code'));
        $grid->column('data', __('Data'));
        $grid->column('date', __('Date'));
        $grid->column('time', __('Time'));

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
        $show = new Show(ApiResponse::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sender', __('Sender'));
        $show->field('code', __('Code'));
        $show->field('data', __('Data'));
        $show->field('date', __('Date'));
        $show->field('time', __('Time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ApiResponse());

        $form->text('sender', __('Sender'));
        $form->text('code', __('Code'));
        $form->textarea('data', __('Data'));
        $form->text('date', __('Date'));
        $form->text('time', __('Time'));

        return $form;
    }
}
