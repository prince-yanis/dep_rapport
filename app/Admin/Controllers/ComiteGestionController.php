<?php

namespace App\Admin\Controllers;

use App\Models\ComiteGestion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ComiteGestionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ComiteGestion';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ComiteGestion());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('nomprenoms', __('Nomprenoms'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('membre_comites_id', __('Membre comites id'));

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
        $show = new Show(ComiteGestion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('nomprenoms', __('Nomprenoms'));
        $show->field('updated_at', __('Updated at'));
        $show->field('created_at', __('Created at'));
        $show->field('membre_comites_id', __('Membre comites id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ComiteGestion());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->text('nomprenoms', __('Nomprenoms'));
        $form->number('membre_comites_id', __('Membre comites id'));

        return $form;
    }
}
