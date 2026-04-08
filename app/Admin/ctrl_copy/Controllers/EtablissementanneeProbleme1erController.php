<?php

namespace App\Admin\Controllers;

use App\Models\Jour;
use App\Models\Heure;
use App\Models\Sport;
use App\Models\Classe;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Materiel;
use App\Models\Personnel;
use App\Models\Discipline;
use App\Models\Association;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Statutpersonnel;
use App\Models\Activitesportive;
use App\Models\Niveauenseignant;
use App\Models\Fonctionpersonnel;
use App\Models\Parametresglobaux;
use App\Models\Etablissementannee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Designationinfrastructure;
use Encore\Admin\Controllers\AdminController;

class EtablissementanneeProbleme1erController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rapport de 1er semestre';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new etablissementannee());

        $grid->column('id', __('Id'));
        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();

        if (in_array($current_role->role_id, array(2))) {
            $grid->model()->where('etablissements_id', '=', $etablissement->id);
        }
        $grid->column('existecloture', __('Existecloture'));
        $grid->column('problemeequipement', __('Problemeequipement'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('anneescolaires_id', __('Anneescolaires id'));
        $grid->column('etablissements_id', __('Etablissements id'));
        // $grid->column('associations_id', __('Associations id'));

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
        $show = new Show(etablissementannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('existecloture', __('Existecloture'));
        $show->field('problemeequipement', __('Problemeequipement'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('anneescolaires_id', __('Anneescolaires id'));
        $show->field('etablissements_id', __('Etablissements id'));
        // $show->field('associations_id', __('Associations id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new etablissementannee());

        $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

        $form->html('
		<style>
		.numberCircle {
  display: inline-block;
  border-radius: 100%;
  border: 2px solid;
  font-size: 15px;
}

.numberCircle:before,
.numberCircle:after {

  display: inline-block;
  line-height: 0px;
  padding-top: 50%;
  padding-bottom: 50%;
}

.numberCircle:before {
  padding-left: 8px;
}

.numberCircle:after {
  padding-right: 8px;
}
		</style>

		<div>
        <h1 style="text-align:center; text-transform:uppercase;">Problèmes Urgents</h1>
        <span style="font-size: 14px;"><a href="/admin/etablissementdetails1er/' . session('etablissementchoisi') . '/edit">Identification</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne1er/' . $EtabAnnee->id . '/edit">Filières de Formation</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneepersonnel1er">Personnels</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneeclasse1er/' . $EtabAnnee->id . '/edit">Classe</a></span>
        <span >|</span>

        <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure1er/' . $EtabAnnee->id . '/edit">Infrastructure et Locaux</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneeinventaire1er/' . $EtabAnnee->id . '/edit">Equipement</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneesocio1er/' . $EtabAnnee->id . '/edit">Activités Socio-Educative</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneebesoinformation1er/'. $EtabAnnee->id .'/edit">Besoin en Formation</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneeprobleme1er/' . $EtabAnnee->id . '/edit">Problèmes Urgents</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneeconclusion1er/' . $EtabAnnee->id . '/edit">Conclusion</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/plannings2">Planning</a></span>
        <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeapprenant1er">Apprenants</a></span>
    </div>
            ');

        $form->hasMany('problemes', __(''), function (Form\NestedForm $form) {
            $form->textarea('libelleprobleme', __('Libelle'));
        });
        $form->confirm('Vérfiez les informations');

        $form->tools(function (Form\Tools $tools) {

            // Disable `List` btn.
            $tools->disableList();

            // Disable `Delete` btn.
            $tools->disableDelete();

            // Disable `Veiw` btn.
            $tools->disableView();

            // Add a button, the argument can be a string, or an instance of the object that implements the Renderable or Htmlable interface
            //$tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        $form->saved(function (Form $form) {
            // $idDonneeEtab=session('idDonneesEtab');
            // $idEtab=session('etablissementchoisi');
            //   return redirect('admin/personnels/create');
            //   return redirect('admin/personnels/create');

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

            return redirect('admin/etabanneeconclusion1er/' . $EtabAnnee->id . '/edit');
        });
        return $form;
    }
}
