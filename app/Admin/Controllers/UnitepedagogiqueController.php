<?php

namespace App\Admin\Controllers;

use App\Models\Discipline;
use App\Models\Unitepedagogique;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UnitepedagogiqueController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Unitepedagogique';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Unitepedagogique());

        $grid->column('id', __('Id'));
        $grid->column('designationup', __('Designationup'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('disciplines_id', __('Disciplines id'));

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
        $show = new Show(Unitepedagogique::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('designationup', __('Designationup'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('disciplines_id', __('Disciplines id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Unitepedagogique());

        $form->text('designationup', __('Designationup'));
        // $form->number('disciplines_id', __('Disciplines id'));
        $lesdisciplines=array();
        $disciplines=Discipline::all();
        foreach ($disciplines as $discipline) {
            $lesdisciplines[$discipline->id]=$discipline->libellediscipline;
        }
        $form->select('disciplines_id', __('Disciplines'))->options($lesdisciplines);

        return $form;
    }
}
