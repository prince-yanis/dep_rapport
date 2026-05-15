<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Etablissementannee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\Parametresglobaux;
use App\Models\Discipline;
use App\Models\Niveauenseignant;
use Encore\Admin\Controllers\AdminController;


class EtablissementanneeBesoinPersonnelEns1erController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Besoin en Personnels Enseignants - 1er Semestre';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Etablissementannee());

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();

        if (in_array($current_role->role_id, array(2))) {
            $grid->model()->where('etablissements_id', '=', $etablissement->id)
                        ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id);
        }

        $grid->column('id', __('Id'));
        $grid->column('nombre', __('Nombre'));
        $grid->column('nombre_existant', __('Nombre existant'));
        $grid->column('nombre_necessaire', __('Nombre nécessaire'));
        $grid->column('disciplines_id', __('Disciplines id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('niveauenseignant_id', __('Niveauenseignant id'));
        $grid->column('observation', __('Observation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        

        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();

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
        $show = new Show(Etablissementannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nombre', __('Nombre'));
        $show->field('nombre_existant', __('Nombre existant'));
        $show->field('nombre_necessaire', __('Nombre nécessaire'));
        $show->field('disciplines_id', __('Disciplines id'));
        $show->field('niveauenseignant_id', __('Niveauenseignant id'));
        $show->field('observation', __('Observation'));
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
        $form = new Form(new Etablissementannee());

        $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

        $form->html('
		<style>
		.span {
            line-height: 1;
            background: #1ABB9C;
            color: #fff !important;
		}
		</style>

		<div>
                <h1 style="text-align:center; text-transform:uppercase;">Besoin en Personnels Enseignants</h1>
                <span style="font-size: 14px;"><a href="/admin/etablissementdetails1er/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne1er/'. $EtabAnnee->id .'/edit">Filières de Formation</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneepersonnel1er">Personnels</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeexecutionprogramme1er/'. $EtabAnnee->id .'/edit">Exécution Programme</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure1er/'. $EtabAnnee->id .'/edit">Infrastructure et Locaux</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinventaire1er/'. $EtabAnnee->id .'/edit">Equipement</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneebesoinpersonnelens1er/'. $EtabAnnee->id .'/edit">Besoin en Personnels Enseignants</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinformation1er/'. $EtabAnnee->id .'/edit">Besoin en Formation</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeprobleme1er/'. $EtabAnnee->id .'/edit">Problèmes Urgents</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeconclusion1er/'. $EtabAnnee->id .'/edit">Conclusion</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/plannings2">Planning</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeapprenant1er">Apprenants</a></span>
            </div>
            ');

        $form->number('nombre', __('Nombre'))->min(0);
        $form->number('nombre_existant', __('Nombre existant'))->min(0);
        $form->number('nombre_necessaire', __('Nombre nécessaire'))->min(0);
        $form->select('disciplines_id', __('Disciplines'))->options(Discipline::all()->pluck('libellediscipline', 'id'));
        $form->select('niveauenseignant_id', __('Niveauenseignant'))->options(Niveauenseignant::all()->pluck('libelleniveau', 'id'));
        $form->textarea('observation', __('Observation'))->rows(4);

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        $form->saved(function (Form $form) {
            return redirect('admin/etabanneebesoinformation1er/' . $form->model()->id . '/edit');
        });

        return $form;
    }
}
