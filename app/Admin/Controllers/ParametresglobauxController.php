<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Anneescolaire;
use App\Models\Periodesannuelle;
use App\Models\Parametresglobaux;
use Encore\Admin\Controllers\AdminController;

class ParametresglobauxController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Parametresglobaux';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new parametresglobaux());

        $grid->column('id', __('Id'));
        $grid->column('anneescolaires_id', __('Anneescolaires id'));
        $grid->column('periodesannuelle_id', __('Periodes id'));
        $grid->column('nompays', __('Nompays'));
        $grid->column('ministere', __('Ministere'));
        $grid->column('nomDirection', __('NomDirection'));
        $grid->column('email', __('Email'));
        $grid->column('adresse', __('Adresse'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('fax', __('Fax'));

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
        $show = new Show(parametresglobaux::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('anneescolaires_id', __('Anneescolaires id'));
        $show->field('nompays', __('Nompays'));
        $show->field('ministere', __('Ministere'));
        $show->field('nomDirection', __('NomDirection'));
        $show->field('email', __('Email'));
        $show->field('adresse', __('Adresse'));
        $show->field('telephone', __('Telephone'));
        $show->field('fax', __('Fax'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new parametresglobaux());

        // $form->number('anneescolaires_id', __('Anneescolaires id'));
        $form->select('anneescolaires_id', __('Année scolaire'))->options(Anneescolaire::all()->pluck('libelleanneescolaire','id'));
        $form->select('periodesannuelle_id', __('Periodes'))->options(Periodesannuelle::all()->pluck('libelleperiode','id'));
        $form->textarea('nompays', __('Nompays'));
        $form->textarea('ministere', __('Ministere'));
        $form->textarea('nomDirection', __('NomDirection'));
        $form->email('email', __('Email'));
        $form->text('adresse', __('Adresse'));
        $form->text('telephone', __('Telephone'));
        $form->text('fax', __('Fax'));

        return $form;
    }
}
