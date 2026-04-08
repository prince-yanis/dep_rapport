<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Mission;
use App\Models\Superviseur;
use App\Models\Filiereautorise;
use App\Models\Filiereenseigne;
use App\Models\Resultatsmission;
use App\Models\Rubriquecontrole;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Controllers\AdminController;

class SuiviMissionController extends AdminController
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
        // $grid->column('etablissementannees_id', __('Etablissement / annees'));
        $grid->etablissementannees_id("Anneé scolaire - Etablissement")->display(function ($etablissementannees_id) {
            $query = DB::table('etablissementannees')
                // $query = Etablissementannee::find($id)
                ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                ->where('etablissementannees.id', '=', $etablissementannees_id)
                ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab', 'etablissements.code')
                ->first();
            // return $query->libellestatutpers;
            return $query->libelleanneescolaire . ' - ' . $query->denominationetab . ' - Code: ' .  $query->code;
        });
        $grid->column('date', __('Date de debut mission'));
        $grid->column('responsableetab', __('Nom & prénom du Responsable'));
        $grid->column('contactresponsableetab', __('Contact du responsable'));
        $grid->column('emailresponsableetab', __('Email du responsable'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->column('Action')->display(function () {
            session(['mission' => $this->id]);
            return '<a href="/admin/suivimissionedit/' . $this->id . '/edit"class="btn btn-success">Editer la mission</a>';
        });
        $grid->disableActions();
        // $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();
        //$grid->disableRowSelector();
        $grid->disableColumnSelector();

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
        $show->field('etablissementannees_id', __('Etablissement / année'));
        $show->field('responsableetab', __('Nom & prénom du Responsable'));
        $show->field('contactresponsableetab', __('Contact du responsable'));
        $show->field('emailresponsableetab', __('Email du responsable'));
        $show->field('date', __('Date'));
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

        // session(['mission' => $this->_get_id()]);

        $form = new Form(new Mission());

        $form->html('
    <style>
        .numberCircle {
            display: inline-block;
            width: 30px;
            line-height: 30px;
            border-radius: 50%;
            text-align: center;
            font-size: 14px;
            border: 2px solid #666;
        }
        p {
            margin-bottom: 10px;
        }
        .menu-links span {
            text-transform: uppercase;
            font-size: 14px;
            margin-right: 5px;
        }
        .menu-links a {
            text-decoration: none;
        }
    </style>

<h1 style="text-align:center; text-transform:uppercase;">Création de la mission</h1>
    
');


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
        $form->datetime('date_fin', __('Date de fin mission'))->default(date('Y-m-d H:i:s'));
        $form->datetime('date_visite', __('Date de visite mission'))->default(date('Y-m-d H:i:s'));
        $form->text('date_derniere_visite', __('Date de dernière visite'));

        // $form->hasMany('participantsmissions', __('Participants de la mission'), function (Form\NestedForm $form) {
        //     $lessuperviseurs = array();
        //     $superviseurs = Superviseur::all();
        //     // $personnels = Personnel::orderBy('nom', 'ASC')->get();
        //     foreach ($superviseurs as $superviseur) {
        //         $lessuperviseurs[$superviseur->id] = $superviseur->matricule . ' ' . $superviseur->nom . ' ' . $superviseur->prenoms;
        //     }
        //     $form->select('superviseur_id', __('Superviseur'))->options($lessuperviseurs);
        // })->useTable();
        $form->hasMany('participantsmissions', __('Participants de la mission'), function (Form\NestedForm $form) {
            $lessuperviseurs = array();
            $superviseurs = Superviseur::all();

            foreach ($superviseurs as $superviseur) {
                $lessuperviseurs[$superviseur->id] = $superviseur->matricule . ' ' . $superviseur->nom . ' ' . $superviseur->prenoms;
            }

            // Ajouter un select pour les superviseurs
            $form->select('superviseur_id', __('Participant'))->options($lessuperviseurs);

            // Ajouter un espace pour le lien et le bouton à part
            $form->html('<div style="margin-top: 10px;"><a href="/admin/ajoutersuperviseurs/create">Ajouter un nouveau participant</a></div>');
            // Ajouter un lien avec un bouton
        });
        $form->hasMany('resultatsmissions', __('Fiche d’observations et de recommandations'), function (Form\NestedForm $form) {
            $query2 = Rubriquecontrole::orderBy('libellerubrique', 'ASC')
                ->get(['id', 'libellerubrique'])
                ->pluck('libellerubrique', 'id');

            $form->select('rubriquecontrole_id', "Rubrique controle")
                ->options($query2);

            // $form->number('rubriquecontrole_id', __('Rubriquecontrole id'));
            $form->textarea('observation', __('Observation'));
            $form->text('recommandation', __('Recommandation'));
        })->useTable();
        $form->saved(function (Form $form) {

            return redirect('admin/suivimissionedit');
        });

        return $form;
    }

    public function _get_id()
    {
        $route = \URL::current();
        $data = explode("/", $route);
        // dd($data);
        return $data[5];
    }
}
