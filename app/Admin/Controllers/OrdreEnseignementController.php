<?php

namespace App\Admin\Controllers;

use App\Models\OrdreEnseignement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrdreEnseignementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'OrdreEnseignement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ordreenseignement());

        $grid->column('id', __('Id'));
        $grid->column('libelleenseignement', __('Libelleenseignement'));
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
        $show = new Show(ordreenseignement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libelleenseignement', __('Libelleenseignement'));
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
        $form = new Form(new ordreenseignement());

        $form->text('libelleenseignement', __('Libelleenseignement'));

        return $form;
    }
}
