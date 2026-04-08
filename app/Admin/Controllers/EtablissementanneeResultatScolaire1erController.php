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

class EtablissementanneeResultatScolaire1erController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Résultats Scolaires - 1er Semestre';

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
        $grid->column('taux_reussite', __('Taux de réussite (%)'))->editable();
        $grid->column('moyenne_generale', __('Moyenne générale'))->editable();
        $grid->column('nombre_admis', __('Nombre d\'admis'))->editable();
        $grid->column('nombre_redoublants', __('Nombre de redoublants'))->editable();
        $grid->column('observations', __('Observations'))->editable('textarea');
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
        $show->field('taux_reussite', __('Taux de réussite (%)'));
        $show->field('moyenne_generale', __('Moyenne générale'));
        $show->field('nombre_admis', __('Nombre d\'admis'));
        $show->field('nombre_redoublants', __('Nombre de redoublants'));
        $show->field('observations', __('Observations'));
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
                <h1 style="text-align:center; text-transform:uppercase;">Résultats Scolaires</h1>
                <span style="font-size: 14px;"><a href="/admin/etablissementdetails1er/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneepersonnel1er">Personnels</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeapprenant1er">Apprenants</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeexecutionprogramme1er/' . $EtabAnnee->id . '/edit">Exécution Programme</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinpersonnelens1er/' . $EtabAnnee->id . '/edit">Besoin en Personnels Enseignants</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneeresultatscolaire1er/' . $EtabAnnee->id . '/edit">Résultats Scolaires</a></span>
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

        $form->decimal('taux_reussite', __('Taux de réussite (%)'))->min(0)->max(100);
        $form->decimal('moyenne_generale', __('Moyenne générale'))->min(0)->max(20);
        $form->number('nombre_admis', __('Nombre d\'admis'))->min(0);
        $form->number('nombre_redoublants', __('Nombre de redoublants'))->min(0);
        $form->textarea('observations', __('Observations'))->rows(4);

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
            return redirect('admin/etabanneeinfrastructure1er/' . $form->model()->id . '/edit');
        });

        return $form;
    }
}
