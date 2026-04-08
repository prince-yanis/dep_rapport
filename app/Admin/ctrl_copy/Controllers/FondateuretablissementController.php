<?php

namespace App\Admin\Controllers;

use App\Models\Fondateuretablissement;
use App\Models\Fondateur;
use App\Models\Etablissement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FondateuretablissementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fondateur etablissement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fondateuretablissement());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('etablissements_id', __('Etablissements id'));
        $grid->column('fondateurs_id', __('Fondateurs id'));

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
        $show = new Show(Fondateuretablissement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('etablissements_id', __('Etablissements id'));
        $show->field('fondateurs_id', __('Fondateurs id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Fondateuretablissement());

        //$form->number('etablissements_id', __('Etablissements id'));
		$lesetabs = Etablissement::pluck('denominationetab','id')->toArray();
		$form->select('etablissements_id', 'Etablissement')->options($lesetabs);
		
		$lesfonds = Fondateur::all()->mapWithKeys(function ($item) {
    return [$item->id => $item->nom . ' ' . $item->prenom];
})->toArray();

$form->select('fondateurs_id', 'Fondateur')->options($lesfonds);
        //$form->number('fondateurs_id', __('Fondateurs id'));

        return $form;
    }
}
