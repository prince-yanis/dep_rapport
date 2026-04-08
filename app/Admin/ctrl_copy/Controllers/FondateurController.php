<?php

namespace App\Admin\Controllers;

use App\Models\Fondateur;
use App\Models\Fonctionpersonnel;
use App\Models\Etablissement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FondateurController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fondateur';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fondateur());

        $grid->column('id', __('Id'));
        $grid->column('nom', __('Nom'));
        $grid->column('prenom', __('Prenom'));
        $grid->column('email', __('Email'));
        $grid->column('contact', __('Contact'));
		$grid->fonctionpersonnels_id("Fonction")->display(function ($id) {
                    $query = Fonctionpersonnel::find($id);
                    return $query ? $query->libellefonction : 'Pas défini';
                });
        $grid->column('contact_2', __('Contact 2'));
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
        $show = new Show(Fondateur::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nom', __('Nom'));
        $show->field('prenom', __('Prenom'));
        $show->field('email', __('Email'));
        $show->field('contact', __('Contact'));
        $show->field('contact_2', __('Contact 2'));
		$show->field('fonctionpersonnels_id', __('Fonction'));
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
        $form = new Form(new Fondateur());

        $form->text('nom', __('Nom'));
        $form->text('prenom', __('Prenom'));
        $form->email('email', __('Email'));
        $form->text('contact', __('Contact'));
        $form->text('contact_2', __('Contact 2'));
		$lesfonctions = Fonctionpersonnel::pluck('libellefonction','id')->toArray();
		$form->select('fonctionpersonnels_id', 'Fonction')->options($lesfonctions);
		
		$form->hasMany('fondateuretablissements', __('Mes établissements'), function (Form\NestedForm $form) {
		$query = Etablissement::get(['id', 'denominationetab'])->pluck('denominationetab', 'id');
		$form->select('etablissements_id', 'Etablissement')->options($query);
		});

        return $form;
    }
}
