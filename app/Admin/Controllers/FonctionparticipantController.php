<?php

namespace App\Admin\Controllers;

use App\Models\Fonctionparticipant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FonctionparticipantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fonctionparticipant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fonctionparticipant());

        $grid->column('id', __('Id'));
        $grid->column('libellefonction', __('Libelle fonction'));
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
        $show = new Show(Fonctionparticipant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libellefonction', __('Libellefonction'));
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
        $form = new Form(new Fonctionparticipant());

        $form->text('libellefonction', __('Libelle fonction'));

        return $form;
    }
}
