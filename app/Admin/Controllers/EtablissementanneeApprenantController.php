<?php

namespace App\Admin\Controllers;

use App\Models\Jour;
use App\Models\Heure;
use App\Models\Sport;
use App\Models\Bourse;
use App\Models\Classe;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Materiel;
use App\Models\Apprenant;
use App\Models\Personnel;
use App\Models\Discipline;
use App\Models\Association;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Typepersonnel;
use App\Models\Statutapprenant;
use App\Models\Statutpersonnel;
use Encore\Admin\Widgets\Table;
use App\Models\Activitesportive;
use App\Models\Apprenantannee;
use App\Models\Diplomepersonnel;
use App\Models\Niveauenseignant;
use App\Models\Fonctionpersonnel;
use App\Models\Parametresglobaux;
use App\Models\Etablissementannee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\Designationinfrastructure;
use Encore\Admin\Controllers\AdminController;


class EtablissementanneeApprenantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Etablissementannee';

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
        // dd(session('etablissementchoisi'));

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
        <h1 style="text-align:center; text-transform:uppercase;">Apprenants</h1>
        <span style="font-size: 14px;"><a href="/admin/etablissementdetails/' . session('etablissementchoisi') . '/edit">Identification</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne/' . $EtabAnnee->id . '/edit">Filières de Formation</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneepersonnel/' . $EtabAnnee->id . '/edit">Personnels</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneeclasse/' . $EtabAnnee->id . '/edit">Classe</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneeapprenant/' . $EtabAnnee->id . '/edit">Apprenants</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure/' . $EtabAnnee->id . '/edit">Infrastructure et Locaux</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneeinventaire/' . $EtabAnnee->id . '/edit">Equipement</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneesocio/' . $EtabAnnee->id . '/edit">Activités Socio-Educative</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneeprobleme/' . $EtabAnnee->id . '/edit">Problèmes Urgents</a></span>
        <span >|</span>
                <span style="font-size: 14px";><a href="/admin/plannings">Planning</a></span>
    </div>
            ');

      $form->html('<a href="/admin/apprenantetab/create">Ajouter un Nouvel Apprenant</a>');
        // Personnel Année
        $form->hasMany('apprenantannees', __(''), function (Form\NestedForm $form) {

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

            $current_user = Auth::guard('admin')->user();
            $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
            $current_school = Etablissement::where('id', $current_user->idEtab)->first();

            // $form->number('apprenants_id', __('Apprenants id'));
            $lesapprenants = array();
            $apprenants = Apprenantannee::select('apprenants.*')->join('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')->where('etablissementannees_id', $EtabAnnee->id)->get();
            foreach ($apprenants as $apprenant) {
                $lesapprenants[$apprenant->id] = $apprenant->matriculeap . ' | ' . $apprenant->nom . ' ' . $apprenant->prenoms;
            }
            $form->select('apprenants_id', __('Apprenants'))->options($lesapprenants);
			/////////////////////////////////////////////////////////////////////////////////
            //$form->html('<a href="/admin/apprenantetab/create">Ajouter un Nouvel Apprenant</a>');
             //////////////////////////////////////////////////////////////////////////
            // $form->number('classes_id', __('Classes id'));
            $lesclasses = array();
            $classes = Classe::where('etablissementannees_id','=',$EtabAnnee->id)->get();
            foreach ($classes as $classe) {
                $lesclasses[$classe->id] = $classe->denominationclasse;
            }
            $form->select('classes_id', __('Classes'))->options($lesclasses);

            // $form->number('statutapprenants_id', __('Statutapprenants id'));
            $lesstatuts = array();
            $statuts = Statutapprenant::all();
            foreach ($statuts as $statut) {
                $lesstatuts[$statut->id] = $statut->libellestatutap;
            }
            $form->select('statutapprenants_id', __('Statut'))->options($lesstatuts);

            // $form->number('bourses_id', __('Bourses id'));
            $lesbourses = array();
            $bourses = Bourse::all();
            foreach ($bourses as $bourse) {
                $lesbourses[$bourse->id] = $bourse->libellebourse;
            }
            $form->select('bourses_id', __('Bourse'))->options($lesbourses);

            // $form->text('decisionfinannee', __('Decisionfinannee'));
            // $form->textarea('observation', __('Observation'))->default('Néant');

            // $form->text('moyenne1er', __('Moyenne1er'));
            // $form->text('moyenne2eme', __('Moyenne2eme'));
            // $form->text('moyenneannee', __('Moyenneannee'));

            // $lesdecisions = array();
            // $decisions = Bourse::all();
            // foreach ($decisions as $decision) {
            //     $lesdecisions[$decision->id] = $decision->libelledecision;
            // }
            // $form->select('decision_id', __('Decision de fin d année'))->options($lesdecisions);
            // $lesgroupes = array();
            // $groupes = DB::table('groupepedagogiques')
            //     ->leftJoin('filieres', 'groupepedagogiques.filieres_id', '=', 'filieres.id')
            //     ->leftJoin('serie', 'groupepedagogiques.serie_id', '=', 'serie.id')
            //     ->select('groupepedagogiques.*', 'filieres.libellefiliere', 'serie.libelleserie')
            //     ->get();
            // foreach ($groupes as $groupe) {
            //     $lesgroupes[$groupe->id] = $groupe->libellegp . ' - ' . $groupe->libellefiliere . ' - ' . $groupe->libelleserie;
            // }
            // $form->select('groupepedagogiques_id', __('Groupe pedagogiques'))->options($lesgroupes);
        })->useTable();
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

            return redirect('admin/etabanneeinfrastructure/' . $EtabAnnee->id . '/edit');
        });
        return $form;
    }
}
