<?php

namespace App\Admin\Controllers;

use App\Models\Conclusion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConclusionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Conclusion';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new conclusion());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissement année '));
        $grid->column('libelleconclusion', __('Libelle de la conclusion'));
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
        $show = new Show(conclusion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('libelleconclusion', __('Libelleconclusion'));
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
        $form = new Form(new conclusion());

        $form->number('etablissementannees_id', __('Etablissement année'));
        $form->text('libelleconclusion', __('Libelleconclusion'));

        return $form;
    }
}
