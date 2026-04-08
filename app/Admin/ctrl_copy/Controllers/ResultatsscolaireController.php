<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Anneescolaire;
use App\Models\Resultatsmission;
use App\Models\Resultatsscolaire;
use Encore\Admin\Controllers\AdminController;

class ResultatsscolaireController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resultats scolaire';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Resultatsscolaire());

        $grid->column('id', __('Id'));
        $grid->column('observationpartielles', __('Observation partielles'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->column('resultatsmission_id', __('Resultats mission'));
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(Resultatsscolaire::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observationpartielles', __('Observation partielles'));
        $show->field('resultatsmission_id', __('Resultats mission'));
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
        $form = new Form(new Resultatsscolaire());

        $query2 = Resultatsmission::orderBy('id', 'ASC')
            ->get(['id'])
            ->pluck('id');

        $form->select('resultatsmission_id', "Resultats de la mission")
            ->options($query2);
        // $form->number('resultatsmission_id', __('Resultatsmission id'));

        $form->hasMany('detailsresultatsscolaires', __('Détails'), function (Form\NestedForm $form) {

            $query3 = Anneescolaire::orderBy('id', 'ASC')
                ->get(['id', 'libelleanneescolaire'])
                ->pluck('libelleanneescolaire', 'id');

            $form->select('anneescolaires_id', "Année scolaire")
                ->options($query3);

            // $form->number('anneescolaires_id', __('Anneescolaires id'));
            // $form->number('resultatsscolaire_id', __('Resultatsscolaire id'));
            $form->number('present', __('Nombre de candidat présents'))->attribute('class', 'form-control no-spin');
            $form->number('admis', __('Admis'))->attribute('class', 'form-control no-spin');
            $form->decimal('taux', __('Taux de reussite'));
        })->useTable();
        $form->textarea('observationpartielles', __('Observation partielles'));

        return $form;
    }
}
