<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Personnel;
use App\Models\Typepersonnel;
use App\Models\Diplomepersonnel;
use Encore\Admin\Controllers\AdminController;

class PersonnelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Personnel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new personnel());

        $grid->quickSearch('matricule', 'nom', 'prenoms');
        $grid->filter(function ($filter) {

            // Remove the default id filter
            $filter->disableIdFilter();

            $lestypepersonnels = array();
            $typepersonnels = Typepersonnel::all();
            foreach ($typepersonnels as $typepersonnel) {
                $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
            }
            $filter->in('typepersonnels_id', "Type de personnel")->multipleSelect($lestypepersonnels);

            $lesdiplomes = array();
            $diplomes = Diplomepersonnel::all();
            foreach ($diplomes as $diplome) {
                $lesdiplomes[$diplome->id] = $diplome->libellediplome;
            }
            $filter->in('diplomepersonnels_id', "Diplome du personnel")->multipleSelect($lesdiplomes);

        });
        $grid->column('id', __('Id'));
        // $grid->column('typepersonnels_id', __('Typepersonnels id'));
        $grid->typepersonnels_id("Type de personnel")->display(function ($id) {
            $query = Typepersonnel::find($id);
            return $query ? $query->libelletypepersonnel : 'Pas défini';
        });
        $grid->column('matricule', __('Matricule'));
        $grid->column('nom', __('Nom'));
        $grid->column('prenoms', __('Prenoms'));
        $grid->column('datenaissance', __('Date de naissance'));
        $grid->column('lieunaissance', __('Lieu de naissance'));
        $grid->column('sexe', __('Sexe'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('email', __('Email'));
        $grid->column('numeroautorisation', __("N° d'autorisation"));
        $grid->column('dateautorisation', __("Date d'autorisation"));
        // $grid->column('diplomepersonnels_id', __('Diplomepersonnels id'));
        $grid->diplomepersonnels_id("Diplome du personnel")->display(function ($id) {
            $query = Diplomepersonnel::find($id);
            return $query ? $query->libellediplome : 'Pas défini';
        });
		 $grid->column('Emploi du temps')->display(function () {
			return '<a href="/admin/plannings"class="btn btn-success">VOIR</a>';
           // return '<a href="/admin/etablissementdetails/'.$this->id.'/edit"class="btn btn-success">Emploi du temps</a>';
        });
        // $grid->column('created_at', __('Created at'))->date('Y-m-d');
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
        $show = new Show(personnel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('matricule', __('Matricule'));
        $show->field('nom', __('Nom'));
        $show->field('prenoms', __('Prenoms'));
        $show->field('datenaissance', __('Datenaissance'));
        $show->field('lieunaissance', __('Lieunaissance'));
        $show->field('sexe', __('Sexe'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('numeroautorisation', __('Numeroautorisation'));
        $show->field('dateautorisation', __('Dateautorisation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('typepersonnels_id', __('Typepersonnels id'));
        $show->field('diplomepersonnels_id', __('Diplomepersonnels id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new personnel());

        $form->text('nom', __('Nom'));
        $form->text('prenoms', __('Prenoms'));
        $form->text('matricule', __('Matricule'));
        // $form->number('typepersonnels_id', __('Typepersonnels id'));
        $lestypepersonnels = array();
        $typepersonnels = Typepersonnel::all();
        foreach ($typepersonnels as $typepersonnel) {
            $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
        }
        $form->select('typepersonnels_id', __('Type personnel'))->options($lestypepersonnels);
        // $form->number('diplomepersonnels_id', __('Diplomepersonnels id'));
        $lesdiplomes = array();
        $diplomes = Diplomepersonnel::all();
        foreach ($diplomes as $diplome) {
            $lesdiplomes[$diplome->id] = $diplome->libellediplome;
        }
        $form->select('diplomepersonnels_id', __('Diplome personnel'))->options($lesdiplomes);
        // $form->number('diplomepersonnels_id', __('Diplomepersonnels id'));

        $form->date('datenaissance', __('Datenaissance'))->default(date('Y-m-d'));
        $form->text('lieunaissance', __('Lieunaissance'));
        $form->text('sexe', __('Sexe'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        $form->text('numeroautorisation', __('Numeroautorisation'));
        $form->text('dateautorisation', __('Dateautorisation'));
        $form->file('documentautorisation', "Uploader le document d'autorisation");
        $form->file('cv', "Uploader votre Curriculum Vitae");

        return $form;
    }
}
