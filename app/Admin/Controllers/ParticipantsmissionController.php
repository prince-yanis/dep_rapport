<?php

namespace App\Admin\Controllers;

use App\Models\Fonctionparticipant;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Superviseur;
use App\Models\Participantsmission;
use Encore\Admin\Controllers\AdminController;

class ParticipantsmissionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Participantsmission';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Participantsmission());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('mission_id', __('Mission id'));
        $grid->column('superviseur_id', __('Superviseur id'));
        $grid->column('fonctionparticipants_id', __('Fonctionparticipants id'));

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
        $show = new Show(Participantsmission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('mission_id', __('Mission id'));
        $show->field('superviseur_id', __('Superviseur id'));
        $show->field('fonctionparticipants_id', __('Fonctionparticipants id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Participantsmission());

        $form->number('mission_id', __('Mission id'));
        // $form->number('superviseur_id', __('Superviseur id'));
        $lessuperviseurs = array();
        $superviseurs = Superviseur::all();
        foreach ($superviseurs as $superviseur) {
            $lessuperviseurs[$superviseur->id] = $superviseur->matricule . ' ' . $superviseur->nom . ' ' . $superviseur->prenoms;
        }
        $form->select('superviseur_id', __('Superviseur'))->options($lessuperviseurs);
        // $form->number('fonctionparticipants_id', __('Fonctionparticipants id'));
        $lesfonctions = array();
        $fonctions = Fonctionparticipant::all();
        foreach ($fonctions as $fonction) {
            $lesfonctions[$fonction->id] = $fonction->libellefonction;
        }
        $form->select('fonctionparticipants_id', __('Fonction'))->options($lesfonctions);

        return $form;
    }
}
