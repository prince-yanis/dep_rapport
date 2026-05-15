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

class EtablissementanneeInfrastructure2emeController extends AdminController
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
        $grid->column('existecloture', __('Existe-t-il une cloture'));
        $grid->column('problemeequipement', __('Probleme d equipement'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('anneescolaires_id', __('Annee scolaires id'));
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
        <h1 style="text-align:center; text-transform:uppercase;">Etat des Infrastructures</h1>
        <span style="font-size: 14px;"><a href="/admin/etablissementdetails2eme/' . session('etablissementchoisi') . '/edit">Identification</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne2eme/' . $EtabAnnee->id . '/edit">Filières de Formation</a></span>
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
        <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneeinfrastructure2eme/' . $EtabAnnee->id . '/edit">Infrastructure et Locaux</a></span>
        <span >|</span>
        <span style="font-size: 14px";><a href="/admin/etabanneeactivitesextrascolaire/'. $EtabAnnee->id .'/edit">Infrastructure et Locaux</a></span>
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

                $form->hasMany('infrastructures', __(''), function (Form\NestedForm $form) {
                    // $form->number('designationinfrastructures_id', __('Designationinfrastructures id'));
                    $lesinfrastructures = array();
                    $infrastructures = Designationinfrastructure::all();
                    foreach ($infrastructures as $infrastructure) {
                        $lesinfrastructures[$infrastructure->id] = $infrastructure->libelleinfrastructure;
                    }
                    $form->select('designationinfrastructures_id', __('Designation infrastructure'))->options($lesinfrastructures);
                    $form->text('nombre', __('Nombre'));
                    $form->text('nombrebureaux', __('Nombre de bureaux'));
                    $form->text('capacite', __('Capacite par salle'));
                    $form->textarea('observation', __('Observation'));
                });
                $form->confirm('Vérfiez les informations');
            // ->tab('Besoin en Infrastructure', function ($form) {

            //     $form->hasMany('besoininfrastructures', __(''), function (Form\NestedForm $form) {
            //         $lesdesignations = array();
            //         $designations = Designationinfrastructure::all();
            //         foreach ($designations as $designation) {
            //             $lesdesignations[$designation->id] = $designation->libelleinfrastructure;
            //         }
            //         $form->select('designationinfrastructures_id', __('Designation infrastructures'))->options($lesdesignations);

            //         $form->text('quantite', __('Quantite'));
            //     });
            // })

            // ->tab('Classe', function ($form) {

            //     $form->hasMany('classes', __(''), function (Form\NestedForm $form) {
            //         $form->text('denominationclasse', __('Denominationclasse'));
            //         $form->text('effectif', __('Effectif'));
            //         $lesgroupes = array();
            //         $groupes = DB::table('groupepedagogiques')
            //             ->leftJoin('filieres', 'groupepedagogiques.filieres_id', '=', 'filieres.id')
            //             ->leftJoin('serie', 'groupepedagogiques.serie_id', '=', 'serie.id')
            //             ->select('groupepedagogiques.*', 'filieres.libellefiliere', 'serie.libelleserie')
            //             ->get();
            //         foreach ($groupes as $groupe) {
            //             $lesgroupes[$groupe->id] = $groupe->libellegp . ' - ' . $groupe->libellefiliere . ' - ' . $groupe->libelleserie;
            //         }
            //         $form->select('groupepedagogiques_id', __('Groupepedagogiques'))->options($lesgroupes);
            //     });
            // })

            // ->tab('Activité Sportive', function ($form) {

            //     $form->hasMany('activitesportive', __(''), function (Form\NestedForm $form) {
            //         $lessports = array();
            //         $sports = Sport::all();
            //         foreach ($sports as $sport) {
            //             $lessports[$sport->id] = $sport->libellesport;
            //         }
            //         $form->select('sport_id', __('Sport'))->options($lessports);
            //     });
            // })

            // ->tab('Association / Club', function ($form) {

            //     $form->hasMany('association', __(''), function (Form\NestedForm $form) {
            //         $form->text('designation', __('Designation'));
            //         $form->text('objet', __('Objet'));
            //         $form->text('nomresponsable', __('Nomresponsable'));
            //     });
            // })

            // ->tab('Besoin', function ($form) {

            //     $form->hasMany('besoins', __(''), function (Form\NestedForm $form) {
            //         $form->text('quantite', __('Quantite'));
            //         $lesmateriels = array();
            //         $materiels = Materiel::all();
            //         foreach ($materiels as $materiel) {
            //             $lesmateriels[$materiel->id] = $materiel->libellemateriel;
            //         }
            //         $form->select('materiels_id', __('Materiels'))->options($lesmateriels);
            //     });
            // })

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

              return redirect('admin/etabanneeactivitesextrascolaire/'.$EtabAnnee->id.'/edit');
  
          });
        return $form;
    }
}
