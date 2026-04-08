<?php

namespace App\Admin\Controllers;

use App\Models\Besoinformation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BesoinformationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Besoin en formation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Besoinformation());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissement annees'));
        $grid->column('personnelannees_id', __('Personnel annees'));
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
        $show = new Show(Besoinformation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissement annees'));
        $show->field('personnelannees_id', __('Personnel annees'));
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
        $form = new Form(new Besoinformation());

        $form->number('etablissementannees_id', __('Etablissement annees'));
        $form->number('personnelannees_id', __('Personnel annees'));

        return $form;
    }
}
