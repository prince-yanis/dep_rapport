<?php

namespace App\Admin\Controllers;

use App\Models\Itemscontrole;
use App\Models\Sousrubriquecontrole;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ItemscontroleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Itemscontrole';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new itemscontrole());

        $grid->column('id', __('Id'));
        $grid->column('libelleitems', __('Libelleitems'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('sousrubriquecontrole_id', __('Sousrubriquecontrole id'));

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
        $show = new Show(itemscontrole::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libelleitems', __('Libelleitems'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('sousrubriquecontrole_id', __('Sousrubriquecontrole id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new itemscontrole());

        $query3 = Sousrubriquecontrole::get(['id', 'libellesousrubrique'])
                ->pluck('libellesousrubrique', 'id');

            $form->select('sousrubriquecontrole_id', "Sous rubrique")
                ->options($query3);
        $form->text('libelleitems', __('Libelle'));

        return $form;
    }
}
