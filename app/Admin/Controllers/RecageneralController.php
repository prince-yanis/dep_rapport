<?php

namespace App\Admin\Controllers;

use App\Models\Recapgeneral;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RecageneralController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Recapgeneral';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Recapgeneral());

        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('etablissement_ordre_id', __('Etablissement ordre id'));
        $grid->column('etablissement_ordre', __('Etablissement ordre'));
        $grid->column('anneescolaires_id', __('Anneescolaires id'));
        $grid->column('etablissements_id', __('Etablissements id'));
        $grid->column('libelleniveau', __('Libelleniveau'));
        $grid->column('CAP', __('CAP'));
        $grid->column('BEP', __('BEP'));
        $grid->column('BT', __('BT'));
        $grid->column('BAC', __('BAC'));

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
        $show = new Show(Recapgeneral::findOrFail($id));

        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('etablissement_ordre_id', __('Etablissement ordre id'));
        $show->field('etablissement_ordre', __('Etablissement ordre'));
        $show->field('anneescolaires_id', __('Anneescolaires id'));
        $show->field('etablissements_id', __('Etablissements id'));
        $show->field('libelleniveau', __('Libelleniveau'));
        $show->field('CAP', __('CAP'));
        $show->field('BEP', __('BEP'));
        $show->field('BT', __('BT'));
        $show->field('BAC', __('BAC'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Recapgeneral());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->number('etablissement_ordre_id', __('Etablissement ordre id'));
        $form->text('etablissement_ordre', __('Etablissement ordre'));
        $form->number('anneescolaires_id', __('Anneescolaires id'));
        $form->number('etablissements_id', __('Etablissements id'));
        $form->text('libelleniveau', __('Libelleniveau'));
        $form->decimal('CAP', __('CAP'));
        $form->decimal('BEP', __('BEP'));
        $form->decimal('BT', __('BT'));
        $form->decimal('BAC', __('BAC'));

        return $form;
    }
}
