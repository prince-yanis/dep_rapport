<?php

namespace App\Admin\Controllers;

use App\Models\Detailsresultatsscolaire;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DetailsresultatsscolaireController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Detailsresultatsscolaire';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Detailsresultatsscolaire());

        $grid->column('id', __('Id'));
        $grid->column('present', __('Present'));
        $grid->column('admis', __('Admis'));
        $grid->column('taux', __('Taux'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('anneescolaires_id', __('Anneescolaires id'));
        $grid->column('resultatsscolaire_id', __('Resultatsscolaire id'));

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
        $show = new Show(Detailsresultatsscolaire::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('present', __('Present'));
        $show->field('admis', __('Admis'));
        $show->field('taux', __('Taux'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('anneescolaires_id', __('Anneescolaires id'));
        $show->field('resultatsscolaire_id', __('Resultatsscolaire id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Detailsresultatsscolaire());

        $form->number('present', __('Present'));
        $form->number('admis', __('Admis'));
        $form->decimal('taux', __('Taux'));
        $form->number('anneescolaires_id', __('Anneescolaires id'));
        $form->number('resultatsscolaire_id', __('Resultatsscolaire id'));

        return $form;
    }
}
