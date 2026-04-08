<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Filiere;
use App\Models\Diplomeprepare;
use App\Models\Filiereenseigne;
use Encore\Admin\Controllers\AdminController;

class FiliereenseigneController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Filiereenseigne';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Filiereenseigne());

        $grid->column('id', __('Id'));
        $grid->column('numautorisationouverture', __('Numautorisationouverture'));
        $grid->column('dureeformation', __('Dureeformation'));
        $grid->column('observation', __('Observation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('filieres_id', __('Filieres id'));
        $grid->column('diplomeprepares_id', __('Diplomeprepares id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
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
        $show = new Show(Filiereenseigne::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('numautorisationouverture', __('Numautorisationouverture'));
        $show->field('dureeformation', __('Dureeformation'));
        $show->field('observation', __('Observation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('filieres_id', __('Filieres id'));
        $show->field('diplomeprepares_id', __('Diplomeprepares id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
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
        $form = new Form(new Filiereenseigne());

        $form->number('etablissementannees_id', __('Etablissement/annees'));
        // $form->number('filieres_id', __('Filieres'));
        $lesfilieres = array();
        $filieres = Filiere::all();
        foreach ($filieres as $filiere) {
            $lesfilieres[$filiere->id] = $filiere->libellefiliere;
        }
        $form->select('filieres_id', __('Filieres'))->options($lesfilieres);
        // $form->number('diplomeprepares_id', __('Diplome préparé'));
        $lesdiplomes = array();
        $diplomes = Diplomeprepare::all();
        foreach ($diplomes as $diplome) {
            $lesdiplomes[$diplome->id] = $diplome->libellediplome;
        }
        $form->select('diplomeprepares_id', __('Diplome préparé'))->options($lesdiplomes);
        $form->text('numautorisationouverture', __("N° d'autorisation d'ouverture"));
        $form->number('capaciteacceuil', __("Capacite d'acceuil"))->attribute('class', 'form-control no-spin');;
        $form->text('dureeformation', __('Duree de la formation'));
        // $form->text('observation', __('Observation'));
        $observations = [
            'FONCTIONNELLE'  => 'FONCTIONNELLE',
            'NON FONCTIONNELLE' => 'NON FONCTIONNELLE',
        ];
        $form->select('observation', 'Observation')->options($observations);

        return $form;
    }
}
