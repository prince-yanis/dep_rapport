<?php

namespace App\Admin\Controllers;

use App\Models\Apprenantannee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ApprenantanneeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Apprenantannee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Apprenantannee());

        $grid->column('id', __('Id'));
        $grid->column('candidat', __('Candidat'));
        $grid->column('resultat', __('Resultat'));
        $grid->column('moyenne1er', __('Moyenne1er'));
        $grid->column('moyenne2eme', __('Moyenne2eme'));
        $grid->column('moyenneannee', __('Moyenneannee'));
        $grid->column('observation', __('Observation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('classes_id', __('Classes id'));
        $grid->column('apprenants_id', __('Apprenants id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('statutapprenants_id', __('Statutapprenants id'));
        $grid->column('bourses_id', __('Bourses id'));
        $grid->column('decision_id', __('Decision id'));

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
        $show = new Show(Apprenantannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('candidat', __('Candidat'));
        $show->field('resultat', __('Resultat'));
        $show->field('moyenne1er', __('Moyenne1er'));
        $show->field('moyenne2eme', __('Moyenne2eme'));
        $show->field('moyenneannee', __('Moyenneannee'));
        $show->field('observation', __('Observation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('classes_id', __('Classes id'));
        $show->field('apprenants_id', __('Apprenants id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('statutapprenants_id', __('Statutapprenants id'));
        $show->field('bourses_id', __('Bourses id'));
        $show->field('decision_id', __('Decision id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Apprenantannee());

        $form->text('candidat', __('Candidat'));
        $form->text('resultat', __('Resultat'));
        $form->decimal('moyenne1er', __('Moyenne1er'));
        $form->decimal('moyenne2eme', __('Moyenne2eme'));
        $form->decimal('moyenneannee', __('Moyenneannee'));
        $form->textarea('observation', __('Observation'));
        $form->number('classes_id', __('Classes id'));
        $form->number('apprenants_id', __('Apprenants id'));
        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->number('statutapprenants_id', __('Statutapprenants id'));
        $form->number('bourses_id', __('Bourses id'));
        $form->number('decision_id', __('Decision id'));

        return $form;
    }
}
