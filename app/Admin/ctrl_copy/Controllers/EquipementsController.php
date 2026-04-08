<?php

namespace App\Admin\Controllers;

use App\Models\Equipement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EquipementsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Equipement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new equipement());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('materiels_id', __('Materiels id'));
		$grid->column('nbrefonction', __('Fonctionnel'));
		$grid->column('nbrenonfonctionnel', __('Non fonctionnel'));
        $grid->text('nombre', __('Total'));
        //$grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));

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
        $show = new Show(equipement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('materiels_id', __('Materiels id'));
		$show->field('nbrefonctionnel', __('Fonctionnel'));
		$show->field('nbrenonfonctionnel', __('Non fonctionnel'));
        $show->text('nombre', __('Total'));
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
        $form = new Form(new equipement());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->number('materiels_id', __('Materiels id'));
		$form->number('nbrefonctionnel', __('Fonctionnel'));
		$form->number('nbrenonfonctionnel', __('Non fonctionnel'));
        $form->text('nombre', __('Total'));

        return $form;
    }
}
