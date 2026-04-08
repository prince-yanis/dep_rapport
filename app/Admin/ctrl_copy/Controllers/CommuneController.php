<?php

namespace App\Admin\Controllers;

use App\Models\Commune;
use App\Models\Departement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CommuneController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Commune';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Commune());

        // $grid->column('id', __('Id'));
        // $grid->column('departements_id', __('Departements id'));
        $grid->departements_id()->display(function ($id) {
            $query = Departement::find($id);
            return $query ? $query->denominationdepartement : 'Pas défini';
        });
        $grid->column('denominationcommune', __('Commune'))->style('max-width:500px;word-break:break-all;')->sortable();
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Commune::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('departements_id', __('Departements id'));
        $show->field('denominationcommune', __('Denominationcommune'));
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
        $form = new Form(new Commune());

        // $form->number('departements_id', __('Departements id'));

        $lesdepartements=array();
        $departements=Departement::all();
        foreach ($departements as $departement) {
            $lesdepartements[$departement->id]=$departement->denominationdepartement;
        }
        $form->select('departements_id', __('Départements'))->options($lesdepartements);

        $form->text('denominationcommune', __('Dénomination de la commune'));

        return $form;
    }
}
