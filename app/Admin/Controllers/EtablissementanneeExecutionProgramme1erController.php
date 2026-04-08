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
use Encore\Admin\Controllers\AdminController;

class EtablissementanneeExecutionProgramme1erController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Exécution du Programme - 1er Semestre';

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
        $grid->column('etablissements.denominationetab', __('Etablissement'));
        $grid->column('anneescolaires.annee', __('Année scolaire'));
        $grid->column('execution_programme', __('Exécution du programme'))->editable('textarea');
        $grid->column('taux_execution', __('Taux d\'exécution (%)'))->editable();
        $grid->column('difficultes_rencontrees', __('Difficultés rencontrées'))->editable('textarea');
        $grid->column('mesures_correctives', __('Mesures correctives'))->editable('textarea');
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
        $show->field('etablissements.denominationetab', __('Etablissement'));
        $show->field('anneescolaires.annee', __('Année scolaire'));
        $show->field('execution_programme', __('Exécution du programme'));
        $show->field('taux_execution', __('Taux d\'exécution (%)'));
        $show->field('difficultes_rencontrees', __('Difficultés rencontrées'));
        $show->field('mesures_correctives', __('Mesures correctives'));
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
                <h1 style="text-align:center; text-transform:uppercase;">Exécution du Programme</h1>
                <span style="font-size: 14px;"><a href="/admin/etablissementdetails1er/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneepersonnel1er">Personnels</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeapprenant1er">Apprenants</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneeexecutionprogramme1er/' . $EtabAnnee->id . '/edit">Exécution Programme</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinpersonnelens1er/' . $EtabAnnee->id . '/edit">Besoin en Personnels Enseignants</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeresultatscolaire1er/' . $EtabAnnee->id . '/edit">Résultats Scolaires</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure1er/' . $EtabAnnee->id . '/edit">Infrastructure et Locaux</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinventaire1er/' . $EtabAnnee->id . '/edit">Equipement</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeprobleme1er/' . $EtabAnnee->id . '/edit">Problèmes Urgents</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeconclusion1er/' . $EtabAnnee->id . '/edit">Conclusion</a></span>
            </div>
            ');

        $form->textarea('execution_programme', __('Exécution du programme'))->rows(6);
        $form->number('taux_execution', __('Taux d\'exécution (%)'))->min(0)->max(100);
        $form->textarea('difficultes_rencontrees', __('Difficultés rencontrées'))->rows(4);
        $form->textarea('mesures_correctives', __('Mesures correctives'))->rows(4);

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
            return redirect('admin/etabanneebesoinpersonnelens1er/' . $form->model()->id . '/edit');
        });

        return $form;
    }
}
