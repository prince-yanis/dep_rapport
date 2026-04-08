<?php

namespace App\Admin\Controllers;

use App\Models\Filiereautorise;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FiliereautoriseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Filiere autorise';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Filiereautorise());

        $grid->column('id', __('Id'));
        $grid->column('observation', __('Observation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('resultatsmission_id', __('Resultatsmission id'));
        $grid->column('filieres_id', __('Filieres id'));
        $grid->column('diplomeprepares_id', __('Diplomeprepares id'));
        $grid->column('ordre_enseignement_id', __('Ordre enseignement id'));

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
        $show = new Show(Filiereautorise::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observation', __('Observation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('resultatsmission_id', __('Resultatsmission id'));
        $show->field('filieres_id', __('Filieres id'));
        $show->field('diplomeprepares_id', __('Diplomeprepares id'));
        $show->field('ordre_enseignement_id', __('Ordre enseignement id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Filiereautorise());

        $form->textarea('observation', __('Observation'));
        $form->number('resultatsmission_id', __('Resultatsmission id'));
        $form->number('filieres_id', __('Filieres id'));
        $form->number('diplomeprepares_id', __('Diplomeprepares id'));
        $form->number('ordre_enseignement_id', __('Ordre enseignement id'));

        return $form;
    }
}
