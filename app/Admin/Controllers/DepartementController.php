<?php

namespace App\Admin\Controllers;

use App\Models\Departement;
use App\Models\Region;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DepartementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Departement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Departement());

        $grid->column('id', __('Id'));
        // $grid->column('regions_id', __('Regions id'));
        $grid->regions_id()->display(function ($id) {
            $query = Region::find($id);
            return $query ? $query->denominationregion : 'Pas défini';
        });
        $grid->column('denominationdepartement', __('Denominationdepartement'));
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
        $show = new Show(Departement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('regions_id', __('Regions id'));
        $show->field('denominationdepartement', __('Denominationdepartement'));
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
        $form = new Form(new Departement());

        $lesregions=array();
        $regions=Region::all();
        foreach ($regions as $region) {
            $lesregions[$region->id]=$region->denominationregion;
        }
        $form->select('regions_id', __('Region'))->options($lesregions);


        // $form->number('regions_id', __('Regions id'));
        $form->text('denominationdepartement', __('Denominationdepartement'));

        return $form;
    }
}
