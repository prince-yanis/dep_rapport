<?php

namespace App\Admin\Controllers;

use App\Models\Indicateur;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class IndicateurController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Indicateur';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Indicateur());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('tauxobtenu_n1', __('Tauxobtenu n1'));
        $grid->column('tauxcible', __('Tauxcible'));
        $grid->column('itemsindicateurs_id', __('Itemsindicateurs id'));

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
        $show = new Show(Indicateur::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('tauxobtenu_n1', __('Tauxobtenu n1'));
        $show->field('tauxcible', __('Tauxcible'));
        $show->field('itemsindicateurs_id', __('Itemsindicateurs id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Indicateur());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->number('tauxobtenu_n1', __('Tauxobtenu n1'));
        $form->number('tauxcible', __('Tauxcible'));
        $form->number('itemsindicateurs_id', __('Itemsindicateurs id'));

        return $form;
    }
}
