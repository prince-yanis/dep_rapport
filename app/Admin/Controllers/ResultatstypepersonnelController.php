<?php

namespace App\Admin\Controllers;

use App\Models\Fonctionpersonnel;
use App\Models\Resultatsmission;
use App\Models\Resultatstypepersonnel;
use App\Models\Typepersonnel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ResultatstypepersonnelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resultats du type de personnel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Resultatstypepersonnel());

        $grid->column('id', __('Id'));
        $grid->column('resultatsmission_id', __('Resultats de la mission'));
        $grid->column('typepersonnels_id', __('Type du personnels'));
        $grid->column('observationpartielles', __('Observation partielles'));
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
        $show = new Show(Resultatstypepersonnel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observationpartielles', __('Observationpartielles'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('typepersonnels_id', __('Typepersonnels id'));
        $show->field('resultatsmission_id', __('Resultatsmission id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Resultatstypepersonnel());

        $query2 = Resultatsmission::orderBy('id', 'ASC')
            ->get(['id'])
            ->pluck('id');

        $form->select('resultatsmission_id', "Resultats de la mission")
            ->options($query2);

        $query3 = Typepersonnel::orderBy('id', 'ASC')
            ->get(['id', 'libelletypepersonnel'])
            ->pluck('libelletypepersonnel','id');

        $form->select('typepersonnels_id', "Type du personnels")
            ->options($query3);

        // $form->number('resultatsmission_id', __('Resultats de la mission'));
        // $form->number('typepersonnels_id', __('Type du personnels'));

        $form->hasMany('detailsresultatspersonnels', __('Personnels'), function (Form\NestedForm $form) {

            $lespersonnels = array();
            $personnels = Fonctionpersonnel::all();
            // $personnels = Personnel::orderBy('nom', 'ASC')->get();
            foreach ($personnels as $personnel) {
                $lespersonnels[$personnel->id] = $personnel->libellefonction;
            }
            $form->select('fonctionpersonnels_id', __('Fonction personnels'))->options($lespersonnels);

            // $form->number('fonctionpersonnels_id', __('Fonctionpersonnels id'));
            $form->number('effectif', __('Effectif'))->attribute('class', 'form-control no-spin');
            $form->number('autorise', __('Nombre Autorisé'))->attribute('class', 'form-control no-spin');
            $form->number('nbredossierphysique', __('Nombre de dossier physique'))->attribute('class', 'form-control no-spin');
            // $form->number('resultatstypepersonnel_id', __('Resultatstypepersonnel id'));
        })->useTable();
        $form->textarea('observationpartielles', __('Observation partielles'));

        return $form;
    }
}
