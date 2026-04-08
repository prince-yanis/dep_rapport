<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Itemscontrole;
use App\Models\Resultatsmission;
use App\Models\Resultatscontrole;
use App\Models\Sousrubriquecontrole;
use Encore\Admin\Controllers\AdminController;

class ResultatscontroleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resultatscontrole';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Resultatscontrole());

        $grid->column('id', __('Id'));
        $grid->column('observationpartielles', __('Observationpartielles'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('resultatsmission_id', __('Resultatsmission id'));
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
        $show = new Show(Resultatscontrole::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observationpartielles', __('Observationpartielles'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('resultatsmission_id', __('Resultatsmission id'));
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
        $form = new Form(new Resultatscontrole());

        // $form->number('resultatsmission_id', __('Resultatsmission id'));
        $query2 = Resultatsmission::orderBy('id', 'ASC')
            ->get(['id'])
            ->pluck('id');

        $form->select('resultatsmission_id', "Resultats de la mission")
            ->options($query2);

        // $form->number('sousrubriquecontrole_id', __('Sousrubriquecontrole id'));
        $query3 = Sousrubriquecontrole::get(['id', 'libellesousrubrique'])
            ->pluck('libellesousrubrique', 'id');

        $form->select('sousrubriquecontrole_id', "Sous rubrique")
            ->options($query3);

        $form->hasMany('detailsresultatscontroles', __('Détails'), function (Form\NestedForm $form) {

            // $lesitems = array();
            // $items = Itemscontrole::all();
            // foreach ($items as $item) {
            //     $lesitems[$item->id] = $item->libelleitems;
            // }
            // $form->select('itemscontrole_id', __('Items controle'))->options($lesitems);
            $lesitems = array();
            $items = Itemscontrole::all();
            foreach ($items as $item) {
                $lesitems[$item->id] = $item->libelleitems;
            }
            $form->select('itemscontrole_id', __('Items controle'))->options($lesitems);
            // $form->number('itemscontrole_id', __('Itemscontrole id'));
            // $form->radio('existence', __('Existence'))->options(['0' => 'Oui', '1'=> 'Non'])->attribute('class', 'form-control no-spin');
            $form->textarea('observations', __('Observations'));
            // $form->number('resultatscontrole_id', __('Resultatscontrole id')); 
        })->useTable();
        $form->textarea('observationpartielles', __('Observationpartielles'));

        return $form;
    }
}
