<?php

namespace App\Admin\Controllers;

use App\Models\Rubriquecontrole;
use App\Models\Sousrubriquecontrole;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SousrubriquecontroleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sousrubriquecontrole';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Sousrubriquecontrole());

        $grid->column('id', __('Id'));
        $grid->column('rubriquecontrole_id', __('Rubrique controle'));
        $grid->column('libellesousrubrique', __('Libelle sous rubrique'));
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
        $show = new Show(Sousrubriquecontrole::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libellesousrubrique', __('Libellesousrubrique'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('rubriquecontrole_id', __('Rubriquecontrole id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Sousrubriquecontrole());

        $query3 = Rubriquecontrole::get(['id', 'libellerubrique'])
            ->pluck('libellerubrique', 'id');
        $form->select('rubriquecontrole_id', "Rubrique controle")
            ->options($query3);
        // $form->number('rubriquecontrole_id', __('Rubrique controle'));
        $form->text('libellesousrubrique', __('Libelle sous rubrique'));
        $form->hasMany('itemscontroles', 'Déclinaisons', function (Form\NestedForm $form) {
            $form->text('libelleitems', __(''));
        })->useTable();

        return $form;
    }
}
