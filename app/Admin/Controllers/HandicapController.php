<?php

namespace App\Admin\Controllers;

use App\Models\Handicap;
use App\Models\Typeshandicap;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HandicapController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Handicap';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Handicap());

        $grid->column('id', __('Id'));
        $grid->column('libelle_handicap', __('Libelle handicap'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('created_by', __('Created by'));
        $grid->column('updated_by', __('Updated by'));
        $grid->column('typeshandicaps_id', __('Typeshandicaps id'));

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
        $show = new Show(Handicap::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libelle_handicap', __('Libelle handicap'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('created_by', __('Created by'));
        $show->field('updated_by', __('Updated by'));
        $show->field('typeshandicaps_id', __('Typeshandicaps id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Handicap());

        // $form->number('typeshandicaps_id', __('Typeshandicaps id'));
        $leshandicaps = array();
        $handicaps = Typeshandicap::all();
        foreach ($handicaps as $handicap) {
            $leshandicaps[$handicap->id] = $handicap->libelle_typeshandicap;
        }
        $form->select('typeshandicaps_id', __('Type d handicap'))->options($leshandicaps);
        $form->text('libelle_handicap', __('Libelle handicap'));
        $form->text('created_by', __('Created by'));
        $form->text('updated_by', __('Updated by'));

        return $form;
    }
}
