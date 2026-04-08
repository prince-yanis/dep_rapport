<?php

namespace App\Admin\Controllers;

use App\Models\Planning;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PlanningController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Planning';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new planning());

        $grid->column('id', __('Id'));
        
        $grid->column('etablissementannees_id', __('Etablissementannees '));
		$grid->column('datedebut', __('Début '));
        $grid->column('datefin', __('Fin'));
      //  $grid->column('jours_id', __('Jours id'));
       // $grid->column('heures_id', __('Heures id'));
        $grid->column('personnels_id', __('Personnels id'));
        $grid->column('classes_id', __('Classes id'));
        $grid->column('disciplines_id', __('Disciplines id'));
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
        $show = new Show(planning::findOrFail($id));

        $show->field('id', __('Id'));        
        $show->field('etablissementannees_id', __('Etablissementannees id'));
		$show->field('datedebut', __('Début'));
        $show->field('datefin', __('Fin'));
       // $show->field('jours_id', __('Jours id'));
       // $show->field('heures_id', __('Heures id'));
        $show->field('personnels_id', __('Personnels id'));
        $show->field('classes_id', __('Classes id'));
        $show->field('disciplines_id', __('Disciplines id'));
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
        $form = new Form(new planning());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
       // $form->number('jours_id', __('Jours id'));
       // $form->number('heures_id', __('Heures id'));
		$form->number('datedebut', __('Début'));
        $form->number('datefin', __('Fin'));
        $form->number('personnels_id', __('Personnels id'));
        $form->number('classes_id', __('Classes id'));
        $form->number('disciplines_id', __('Disciplines id'));

        return $form;
    }
}
