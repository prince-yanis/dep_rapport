<?php

namespace App\Admin\Controllers;

use App\Models\Typeshandicap;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TypeshandicapController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Typeshandicap';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Typeshandicap());

        $grid->column('id', __('Id'));
        $grid->column('libelle_typeshandicap', __('Libelle typeshandicap'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('created_by', __('Created by'));
        $grid->column('updated_by', __('Updated by'));

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
        $show = new Show(Typeshandicap::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libelle_typeshandicap', __('Libelle typeshandicap'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('created_by', __('Created by'));
        $show->field('updated_by', __('Updated by'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Typeshandicap());

        $form->text('libelle_typeshandicap', __('Libelle typeshandicap'));
        $form->hidden('created_by', __('Created by'))->default(1);
        $form->hidden('updated_by', __('Updated by'))->default(1);

        return $form;
    }
}
