<?php

namespace App\Admin\Controllers;

use App\Models\Detailsresultatspersonnel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DetailsresultatspersonnelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Detailsresultatspersonnel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Detailsresultatspersonnel());

        $grid->column('id', __('Id'));
        $grid->column('effectif', __('Effectif'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('autorise', __('Autorise'));
        $grid->column('nbredossierphysique', __('Nbredossierphysique'));
        $grid->column('fonctionpersonnels_id', __('Fonctionpersonnels id'));
        $grid->column('resultatstypepersonnel_id', __('Resultatstypepersonnel id'));

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
        $show = new Show(Detailsresultatspersonnel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('effectif', __('Effectif'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('autorise', __('Autorise'));
        $show->field('nbredossierphysique', __('Nbredossierphysique'));
        $show->field('fonctionpersonnels_id', __('Fonctionpersonnels id'));
        $show->field('resultatstypepersonnel_id', __('Resultatstypepersonnel id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Detailsresultatspersonnel());

        $form->number('effectif', __('Effectif'));
        $form->number('autorise', __('Autorise'));
        $form->number('nbredossierphysique', __('Nbredossierphysique'));
        $form->number('fonctionpersonnels_id', __('Fonctionpersonnels id'));
        $form->number('resultatstypepersonnel_id', __('Resultatstypepersonnel id'));

        return $form;
    }
}
