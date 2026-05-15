<?php

namespace App\Admin\Controllers;

use App\Models\MiseEnStage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MiseEnStageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MiseEnStage';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MiseEnStage());

        $grid->column('id', __('Id'));
        $grid->column('filieres_id', __('Filieres id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('nombre_stagiaire', __('Nombre stagiaire'));
        $grid->column('nombre_mis_en_stage', __('Nombre mis en stage'));
        $grid->column('taux', __('Taux'));
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
        $show = new Show(MiseEnStage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('filieres_id', __('Filieres id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('nombre_stagiaire', __('Nombre stagiaire'));
        $show->field('nombre_mis_en_stage', __('Nombre mis en stage'));
        $show->field('taux', __('Taux'));
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
        $form = new Form(new MiseEnStage());

        $form->number('filieres_id', __('Filieres id'));
        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->number('nombre_stagiaire', __('Nombre stagiaire'));
        $form->number('nombre_mis_en_stage', __('Nombre mis en stage'));
        $form->decimal('taux', __('Taux'));

        return $form;
    }
}
