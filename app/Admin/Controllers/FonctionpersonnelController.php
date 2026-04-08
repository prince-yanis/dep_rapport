<?php

namespace App\Admin\Controllers;

use App\Models\Fonctionpersonnel;
use App\Models\Typepersonnel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FonctionpersonnelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fonctionpersonnel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fonctionpersonnel());

        $grid->column('id', __('Id'));
        $grid->column('typepersonnels_id', __('Typepersonnels id'));
        $grid->column('libellefonction', __('Libellefonction'));
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
        $show = new Show(Fonctionpersonnel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('typepersonnels_id', __('Typepersonnels id'));
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
        $form = new Form(new Fonctionpersonnel());

        // $form->number('typepersonnels_id', __('Typepersonnels id'));
        $lestypepersonnels = array();
        $typepersonnels = Typepersonnel::all();
        foreach ($typepersonnels as $typepersonnel) {
            $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
        }
        $form->select('typepersonnels_id', __('Type personnels'))->options($lestypepersonnels);
        $form->text('libellefonction', __('Libelle fonction'));

        return $form;
    }
}
