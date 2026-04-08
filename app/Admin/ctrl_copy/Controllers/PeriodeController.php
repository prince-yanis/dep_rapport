<?php

namespace App\Admin\Controllers;

use App\Models\Periode;
use App\Models\Typeperiode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PeriodeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Periode';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new periode());

        $grid->column('id', __('Id'));
        $grid->column('libelleperiode', __('Libelleperiode'));
        $grid->column('coefficientperiode', __('Coefficientperiode'));
        $grid->column('typeperiodes_id', __('Typeperiodes id'));
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
        $show = new Show(periode::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libelleperiode', __('Libelleperiode'));
        $show->field('coefficientperiode', __('Coefficientperiode'));
        $show->field('typeperiodes_id', __('Typeperiodes id'));
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
        $form = new Form(new periode());

        $form->text('libelleperiode', __('Libelleperiode'));
        $form->text('coefficientperiode', __('Coefficientperiode'));
        // $form->number('typeperiodes_id', __('Typeperiodes id'));
        $lestypesperiodes=array();
        $typesperiodes=Typeperiode::all();
        foreach ($typesperiodes as $typesperiode) {
            $lestypesperiodes[$typesperiode->id]=$typesperiode->libelletypeperiode;
        }
        $form->select('typeperiodes_id', __('Type periodes'))->options($lestypesperiodes);

        return $form;
    }
}
