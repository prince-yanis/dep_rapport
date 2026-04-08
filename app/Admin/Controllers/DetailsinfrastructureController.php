<?php

namespace App\Admin\Controllers;

use App\Models\Detailsinfrastructure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DetailsinfrastructureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Detailsinfrastructure';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Detailsinfrastructure());

        $grid->column('id', __('Id'));
        $grid->column('nbrefonctionnel', __('Nbrefonctionnel'));
        $grid->column('nbrenonfonctionnel', __('Nbrenonfonctionnel'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('infrastructures_id', __('Infrastructures id'));
        $grid->column('rubriquecontrole_id', __('Rubriquecontrole id'));
        $grid->column('resultatstypesequipement_id', __('Resultatstypesequipement id'));


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
        $show = new Show(Detailsinfrastructure::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nbrefonctionnel', __('Nbrefonctionnel'));
        $show->field('nbrenonfonctionnel', __('Nbrenonfonctionnel'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('infrastructures_id', __('Infrastructures id'));
        $show->field('rubriquecontrole_id', __('Rubriquecontrole id'));
        $show->field('resultatstypesequipement_id', __('Resultatstypesequipement id'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Detailsinfrastructure());

        $form->number('nbrefonctionnel', __('Nbrefonctionnel'));
        $form->number('nbrenonfonctionnel', __('Nbrenonfonctionnel'));
        $form->number('infrastructures_id', __('Infrastructures id'));
        $form->number('rubriquecontrole_id', __('Rubriquecontrole id'));
        $form->number('resultatstypesequipement_id', __('Resultatstypesequipement id'));

        return $form;
    }
}
