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
use App\Models\Typepersonnel;
use App\Models\Statutpersonnel;
use App\Models\Activitesportive;
use App\Models\Diplomepersonnel;
use App\Models\Niveauenseignant;
use App\Models\Fonctionpersonnel;
use App\Models\Parametresglobaux;
use App\Models\Etablissementannee;
use App\Models\EtablissementanneePersonnel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\Designationinfrastructure;
use App\Models\Personnelannee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class EtablissementanneePersonnel1erController extends AdminController
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
        set_time_limit(0);

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
		set_time_limit(0);

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
        set_time_limit(0);

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
        <h1 style="text-align:center; text-transform:uppercase;">Personnels</h1>
        <span style="font-size: 14px;"><a href="/admin/etablissementdetails1er/' . session('etablissementchoisi') . '/edit">Identification</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne1er/' . $EtabAnnee->id . '/edit">Filières de Formation</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneepersonnel1er/' . $EtabAnnee->id . '/edit">Personnels</a></span>
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
        <span style="font-size: 14px";><a href="/admin/etabanneeprobleme1er/' . $EtabAnnee->id . '/edit">Problèmes Urgents</a></span>
        <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeconclusion1er/' . $EtabAnnee->id . '/edit">Conclusion</a></span>
        <span >|</span>
                <span style="font-size: 14px";><a href="/admin/plannings2">Planning</a></span>
    </div>
            ');

            // $form->text('problemeequipement', __('Problemeequipement'))->default(10);

        // Personnel Année
        $form->hasMany('personnelannees', __(''), function (Form\NestedForm $form) {

            $current_user = Auth::guard('admin')->user();
            $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
            $current_school = Etablissement::where('id', $current_user->idEtab)->first();

            // $lesetabannees = array();
            // $etabannees = DB::table('etablissementannees')
            //     ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            //     ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            //     ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
            //     ->get();
            // foreach ($etabannees as $etabannee) {
            //     $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
            // }
            // $form->select('etablissementannees_id', __('Etablissement annees'))->options($lesetabannees)->default($current_school->id);
            // $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees);

            $lespersonnels = array();
            $personnels = Personnel::all();
            foreach ($personnels as $personnel) {
                $lespersonnels[$personnel->id] = $personnel->nom . ' ' . $personnel->prenoms;
            }
            $form->select('personnels_id', __('Personnel'))->options($lespersonnels);

            $lestypepersonnels = array();
            $typepersonnels = Typepersonnel::all();
            foreach ($typepersonnels as $typepersonnel) {
                $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
            }

            $form->html('<a href="/admin/personneletab/create">Ajouter un Nouveau Personnel</a>');
            $lesdisciplines = array();
            $disciplines = Discipline::all();
            foreach ($disciplines as $discipline) {
                $lesdisciplines[$discipline->id] = $discipline->libellediscipline;
            }
            $form->select('disciplines_id', __('Disciplines'))->options($lesdisciplines);

            $lesstatuts = array();
            $statuts = Statutpersonnel::all();
            foreach ($statuts as $statut) {
                $lesstatuts[$statut->id] = $statut->libellestatutpers;
            }
            $form->select('statutpersonnel_id', __('Statut'))->options($lesstatuts);

            $lesfonctions = array();
            $fonctions = Fonctionpersonnel::all();
            foreach ($fonctions as $fonction) {
                $lesfonctions[$fonction->id] = $fonction->libellefonction;
            }
            $form->select('fonctionpersonnels_id', __('Fonction'))->options($lesfonctions);

            $lesniveaux = array();
            $niveaux = Niveauenseignant::all();
            foreach ($niveaux as $niveau) {
                $lesniveaux[$niveau->id] = $niveau->libelleniveau;
            }
            $form->select('niveauenseignant_id', __('Niveau'))->options($lesniveaux);

            $form->text('quotahoraire', __('Quota horaire'));
            $form->text('nbreheureeffectuee', __("Nombre d'heure effectuée"));
            $form->text('nbreheureresponsabilite', __("Nombre d'heure de responsabilité"));
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

        // $form->submitted(function (Form $form) {
        //     // $count = count($form->personnelannees);
        //     // // $indice = $count;
        //     // $indice = $count - 1;

        //     // $personnel_id = $form->personnelannees[$indice]['personnels_id'];
        //     // $etablissementannee_id = $form->personnelannees[$indice]['etablissementannees_id'];
        //     // $personnel_id = $indice ? $form->personnelannees[$indice]['personnels_id'] : null;
        //     // $etablissementannee_id = $indice ? $form->personnelannees[$indice]['etablissementannees_id'] : null;
        //     // $personnel_id = $form->personnelannees['personnels_id'];
        //     // $etablissementannee_id = $form->personnelannees['etablissementannees_id'];
        //     $personnel_id = $form->personnels_id;
        //     $etablissementannee_id = $form->etablissementannees_id;

        //     $query = Personnelannee::where([
        //         ['personnels_id', $personnel_id],
        //         ['etablissementannees_id', $etablissementannee_id],
        //     ])->first();

        //     if ($query) {
        //         $error = new MessageBag([
        //             'title' => 'Erreur!',
        //             'message' => "Cet enregistrement existe déjà ! $personnel_id et $etablissementannee_id",
        //         ]);
        //         return back()->with(compact('error'));
        //     }
        // });

        $form->saved(function (Form $form) {
            // $idDonneeEtab=session('idDonneesEtab');
            // $idEtab=session('etablissementchoisi');
            //   return redirect('admin/personnels/create');
            //   return redirect('admin/personnels/create');

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

            return redirect('admin/etabanneeclasse1er/' . $EtabAnnee->id . '/edit');
        });
        return $form;
    }
}
