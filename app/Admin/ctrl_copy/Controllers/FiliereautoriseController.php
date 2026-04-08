<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Filiere;
use App\Models\Diplomeprepare;
use App\Models\Filiereautorise;
use App\Models\OrdreEnseignement;
use Encore\Admin\Controllers\AdminController;

class FiliereautoriseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Filiereautorise';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Filiereautorise());

        $grid->column('id', __('Id'));
        $grid->column('observation', __('Observation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('resultatsmission_id', __('Resultatsmission id'));
        $grid->column('filieres_id', __('Filieres id'));
        $grid->column('diplomeprepares_id', __('Diplomeprepares id'));
        $grid->column('ordre_enseignement_id', __('Ordre enseignement id'));
        $grid->column('capaciteacceuil', __('Capaciteacceuil'));

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
        $show = new Show(Filiereautorise::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observation', __('Observation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('resultatsmission_id', __('Resultatsmission id'));
        $show->field('filieres_id', __('Filieres id'));
        $show->field('diplomeprepares_id', __('Diplomeprepares id'));
        $show->field('ordre_enseignement_id', __('Ordre enseignement id'));
        $show->field('capaciteacceuil', __('Capaciteacceuil'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Filiereautorise());

        $form->number('resultatsmission_id', __('Resultatsmission id'));
        // $form->number('ordre_enseignement_id', __('Ordre enseignement id'));
        $lesordres = array();
        $ordres = OrdreEnseignement::all();
        foreach ($ordres as $ordre) {
            $lesordres[$ordre->id] = $ordre->libelleenseignement;
        }
        $form->select('ordre_enseignement_id', __('Ordre enseignement'))->options($lesordres);
        // $form->number('filieres_id', __('Filieres id'));
        $lesfilieres = array();
        $filieres = Filiere::all();
        foreach ($filieres as $filiere) {
            $lesfilieres[$filiere->id] = $filiere->libellefiliere;
        }
        $form->select('filieres_id', __('Filieres'))->options($lesfilieres);
        // $form->number('diplomeprepares_id', __('Diplomeprepares id'));
        $lesdiplomes = array();
        $diplomes = Diplomeprepare::all();
        foreach ($diplomes as $diplome) {
            $lesdiplomes[$diplome->id] = $diplome->libellediplome;
        }
        $form->select('diplomeprepares_id', __('Diplome préparé'))->options($lesdiplomes);
        $form->number('capaciteacceuil', __("Capacité d'acceuil"))->attribute('class', 'form-control no-spin');;
        $form->text('observation', __('Observation'));

        return $form;
    }
}
