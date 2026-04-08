<?php

namespace App\Admin\Controllers;

use App\Models\Equipement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EquipementController extends AdminController
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
        $grid = new Grid(new Equipement());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('existe_materiel', __('Existe materiel'));
        $grid->column('date_materiel', __('Date materiel'));
        $grid->column('programme', __('Programme'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('existe_equipement', __('Existe equipement'));
        $grid->column('date_equipement', __('Date equipement'));

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
        $show = new Show(Equipement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('existe_materiel', __('Existe materiel'));
        $show->field('date_materiel', __('Date materiel'));
        $show->field('programme', __('Programme'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('existe_equipement', __('Existe equipement'));
        $show->field('date_equipement', __('Date equipement'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Equipement());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->text('existe_materiel', __('Existe materiel'));
        $form->date('date_materiel', __('Date materiel'))->default(date('Y-m-d'));
        $form->text('programme', __('Programme'));
        $form->text('existe_equipement', __('Existe equipement'));
        $form->date('date_equipement', __('Date equipement'))->default(date('Y-m-d'));

        return $form;
    }
}
