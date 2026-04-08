<?php

namespace App\Admin\Controllers;

use App\Models\Structure;
use App\Models\Superviseur;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AjouterSuperviseurController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Superviseur';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Superviseur());

        $grid->column('id', __('Id'));
        $grid->column('matricule', __('Matricule'));
        $grid->column('nom', __('Nom'));
        $grid->column('prenoms', __('Prénoms'));
        $grid->column('telephone', __('Téléphone'));
        $grid->column('email', __('Email'));
        // $grid->column('structure_id', __('Structure id'));
        $grid->structure_id("Structure")->display(function ($id) {
            $query = Structure::find($id);
            return $query ? $query->libellestructure : 'Pas défini';
        });
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Superviseur::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('matricule', __('Matricule'));
        $show->field('nom', __('Nom'));
        $show->field('prenoms', __('Prenoms'));
        $show->field('telephone', __('Téléphone'));
        $show->field('email', __('Email'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('structure_id', __('Structure id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Superviseur());

        $form->text('matricule', __('Matricule'));
        $form->text('nom', __('Nom'));
        $form->text('prenoms', __('Prénoms'));
        $form->text('telephone', __('Téléphone'));
        $form->email('email', __('Email'));
        // $form->number('structure_id', __('Structure id'));
        $lesstructures = array();
        $structures = Structure::all();
        foreach ($structures as $structure) {
            $lesstructures[$structure->id] = $structure->libellestructure;
        }
        $form->select('structure_id', __('Structure'))->options($lesstructures);

        $form->saved(function (Form $form) {
            return redirect('admin/suivimission/create');
        });

        return $form;
    }
}
