<?php

namespace App\Admin\Controllers;

use App\Models\Jour;
use App\Models\Heure;
use App\Models\Sport;
use App\Models\Classe;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Filiere;
use App\Models\Periode;
use App\Models\Materiel;
use App\Models\Apprenant;
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
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\Designationinfrastructure;
use App\Models\Diplomeprepare;
use Encore\Admin\Controllers\AdminController;

class EtablissementanneeFiliereEnseigne2emeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rapport de 2ème semestre';

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
                <h1 style="text-align:center; text-transform:uppercase;">Filières de Formation</h1>
                <span style="font-size: 14px;"><a href="/admin/etablissementdetails2eme/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneefiliereenseigne2eme/' . $EtabAnnee->id . '/edit">Filières de Formation</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneepersonnel2eme">Personnels</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinpersonneladmin/' . $EtabAnnee->id . '/edit">Besoin en Personnel Administratif</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinpersonnelens/' . $EtabAnnee->id . '/edit">Besoin en Personnel Enseignant</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeclasse2eme/' . $EtabAnnee->id . '/edit">Classe</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeresultat2eme/' . $EtabAnnee->id . '/edit">Resultats aux Examens</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure2eme/' . $EtabAnnee->id . '/edit">Infrastructure et Locaux</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinmateriel/' . $EtabAnnee->id . '/edit">Besoin en Matériels et Divers</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeprevision2eme/' . $EtabAnnee->id . '/edit">Prévision</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeetat2eme/' . $EtabAnnee->id . '/edit">Etat des difficultés gestion et suggestion</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeconclusion2eme/' . $EtabAnnee->id . '/edit">Conclusion</a></span>
				<span >|</span>
        <span style="font-size: 14px";><a href="/admin/apprenantannees_2eme">Apprenants</a></span>
            </div>
            ');

        $form->hasMany('filiereenseignes', __(''), function (Form\NestedForm $form) use ($EtabAnnee) {
    // On cache l’ID parent pour le sous-formulaire
    $form->hidden('etablissementannees_id')->default($EtabAnnee->id);
		// Initialisation vide
    $filiereOptions = [];

    // On a l’ID parent directement, pas besoin de passer par $form->model()
    if ($EtabAnnee) {
        $etabAnnee = \App\Models\Etablissementannee::with('etablissement')->find($EtabAnnee->id);

        if ($etabAnnee && $etabAnnee->etablissement) {
            $ordre = $etabAnnee->etablissement->ordre_enseignement_id;

            $filiereOptions = \App\Models\Filiere::where('ordre_enseignement_id', $ordre)
                ->pluck('libellefiliere', 'id')
                ->toArray();
        }
    }

    $form->select('filieres_id', __('Filière'))->options($filiereOptions);
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
        });

        // Activité Sportive

        // $current_user = Auth::guard('admin')->user();
        // $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        // $current_school = Etablissement::where('id', $current_user->idEtab)->first();
        /*
        $lesetabannees = array();
        $etabannees = DB::table('etablissementannees')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
            ->get();
        foreach ($etabannees as $etabannee) {
            $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
        }
        $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees)->default($current_school->id);
        */
        //         $form->hidden('etablissementannees_id', 'Etablissement Annee ID')->default($current_school->id);
        // $lessports = array();
        // $sports = Sport::all();
        // foreach ($sports as $sport) {
        //     $lessports[$sport->id] = $sport->libellesport;
        // }
        //         $form->multipleSelect('activitesportive')->options($lessports);
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

            return redirect('admin/etabanneepersonnel2eme');
        });
        return $form;
    }
}
