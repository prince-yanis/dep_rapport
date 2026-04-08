<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Mission;
use App\Models\Rubriquecontrole;
use App\Models\Superviseur;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Controllers\AdminController;

class MissionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Mission';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Mission());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissement / annees'));
        $grid->column('date', __('Date de debut mission'));
        $grid->column('responsableetab', __('Nom & prénom du Responsable'));
        $grid->column('contactresponsableetab', __('Contact du responsable'));
        $grid->column('emailresponsableetab', __('Email du responsable'));
        $grid->column('visite', __('Visité'));
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
        $show = new Show(Mission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('responsableetab', __('Nom & prénom du Responsable'));
        $show->field('contactresponsableetab', __('Contact du responsable'));
        $show->field('emailresponsableetab', __('Email du responsable'));
        $show->field('etablissementannees_id', __('Etablissement / année'));
        $show->field('date', __('Date'));
        $show->field('visite', __('Visité'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Mission());

        // $form->number('etablissementannees_id', __('Etablissement / année'));
        $lesetabannees = array();
        $etabannees = DB::table('etablissementannees')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
            ->get();
        foreach ($etabannees as $etabannee) {
            $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
        }
        $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees);
        $form->text('responsableetab', __('Nom & prénom du Responsable'));
        $form->text('contactresponsableetab', __('Contact du responsable'));
        $form->text('emailresponsableetab', __('Email du responsable'));
        $form->datetime('date', __('Date de debut mission'))->default(date('Y-m-d H:i:s'));

        $form->hasMany('participantsmissions', __('Participants de la mission'), function (Form\NestedForm $form) {

            $lessuperviseurs = array();
            $superviseurs = Superviseur::all();
            // $personnels = Personnel::orderBy('nom', 'ASC')->get();
            foreach ($superviseurs as $superviseur) {
                $lessuperviseurs[$superviseur->id] = $superviseur->matricule . ' ' . $superviseur->nom . ' ' . $superviseur->prenoms;
            }
            $form->select('superviseur_id', __('Participant'))->options($lessuperviseurs);
 
        })->useTable();
        $form->hasMany('resultatsmissions', __('Résultat de la mission'), function (Form\NestedForm $form) {
            $query2 = Rubriquecontrole::orderBy('libellerubrique', 'ASC')
                ->get(['id', 'libellerubrique'])
                ->pluck('libellerubrique', 'id');

            $form->select('rubriquecontrole_id', "Rubrique controle")
                ->options($query2);

            // $form->number('rubriquecontrole_id', __('Rubriquecontrole id'));
            $form->textarea('observation', __('Observation'));
            $form->text('recommandation', __('Recommandation'));
        })->useTable();

        return $form;
    }
}
