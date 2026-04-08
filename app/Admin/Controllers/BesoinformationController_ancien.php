<?php

namespace App\Admin\Controllers;

use App\Models\Besoinformation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BesoinformationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Besoin de formation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new besoinformation());

        $grid->column('id', __('Id'));
        $grid->column('typeautorisation', __("Type d'autorisation"));
        $grid->column('nombre', __('Nombre'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));

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
        $show = new Show(besoinformation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('typeautorisation', __('Typeautorisation'));
        $show->field('nombre', __('Nombre'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new besoinformation());

        $form->text('typeautorisation', __("Type d'autorisation"));
        $form->text('nombre', __('Nombre'));
        $form->number('etablissementannees_id', __('Etablissement annees '));

        return $form;
    }
}
