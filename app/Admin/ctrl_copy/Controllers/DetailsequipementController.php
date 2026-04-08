<?php

namespace App\Admin\Controllers;

use App\Models\Detailsequipement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DetailsequipementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Detailsequipement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Detailsequipement());

        $grid->column('id', __('Id'));
        $grid->column('nbrefonctionnel', __('Fonctionnel'));
        $grid->column('nbrenonfonctionnel', __('Non fonctionnel'));
		$grid->column('nombre', __('Total'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('equipements_id', __('Equipements id'));
        $grid->column('rubriquecontrole_id', __('Rubriquecontrole id'));

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
        $show = new Show(Detailsequipement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nbrefonctionnel', __('Fonctionnel'));
        $show->field('nbrenonfonctionnel', __('Non fonctionnel'));
		$show->field('nombre', __('Total'));
        $show->field('equipements_id', __('Equipements id'));
        $show->field('rubriquecontrole_id', __('Rubrique id'));
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
        $form = new Form(new Detailsequipement());

        $form->number('nbrefonctionnel', __('Nbrefonctionnel'));
        $form->number('nbrenonfonctionnel', __('Nbrenonfonctionnel'));
		$form->number('nombre', __('Total'));
        $form->number('equipements_id', __('Equipements id'));
        $form->number('rubriquecontrole_id', __('Rubriquecontrole id'));

        return $form;
    }
}
