<?php

namespace App\Admin\Controllers;

use App\Models\Rubriquecontrole;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RubriquecontroleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rubriquecontrole';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Rubriquecontrole());

        $grid->column('id', __('Id'));
        $grid->column('libellerubrique', __('Libellerubrique'));
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
        $show = new Show(Rubriquecontrole::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libellerubrique', __('Libellerubrique'));
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
        $form = new Form(new Rubriquecontrole());

        $form->text('libellerubrique', __('Rubrique'));
        return $form;
    }
}
