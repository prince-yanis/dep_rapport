<?php

namespace App\Admin\Controllers;

use App\Models\District;
use App\Models\Region;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RegionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Region';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Region());

        $grid->column('id', __('Id'));
        // $grid->column('districts_id', __('Districts id'));
        $grid->districts_id()->display(function ($id) {
            $query = District::find($id);
            return $query ? $query->denominationdistrict : 'Pas défini';
        });
        $grid->column('denominationregion', __('Denominationregion'));
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
        $show = new Show(Region::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('districts_id', __('Districts id'));
        $show->field('denominationregion', __('Denominationregion'));
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
        $form = new Form(new Region());

        // $form->number('districts_id', __('Districts id'));

        $lesdistricts=array();
        $districts=District::all();
        foreach ($districts as $district) {
            $lesdistricts[$district->id]=$district->denominationdistrict;
        }
        $form->select('districts_id', __('Districts'))->options($lesdistricts);

        $form->text('denominationregion', __('Denominationregion'));

        return $form;
    }
}
