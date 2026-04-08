<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\personnel;
use App\Models\Discipline;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Typepersonnel;
use App\Models\Statutpersonnel;
use App\Models\Diplomepersonnel;
use App\Models\Niveauenseignant;
use App\Models\Fonctionpersonnel;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class PersonnelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Personnel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new personnel());

        $grid->column('id', __('Id'));
        $grid->column('nom', __('Nom'));
        $grid->column('prenoms', __('Prenoms'));
        $grid->column('matricule', __('Matricule'))->default('Néant')->label(['Néant' => 'danger',]);
        // $grid->column('typepersonnels_id', __('Typepersonnels id'));
        $grid->typepersonnels_id()->display(function ($id) {
            $query = Typepersonnel::find($id);
            return $query ? $query->libelletypepersonnel : 'Néant';
        })->label(['Néant' => 'danger',]);
        // $grid->column('diplomepersonnels_id', __('Diplomepersonnels id'));
        $grid->diplomepersonnels_id()->display(function ($id) {
            $query = Diplomepersonnel::find($id);
            return $query ? $query->libellediplome : 'Néant';
        })->default('Néant')->label(['Néant' => 'danger',]);
        // $grid->column('fonctionpersonnels_id', __('Fonctionpersonnels id'));
        $grid->fonctionpersonnels_id()->display(function ($id) {
            $query = Fonctionpersonnel::find($id);
            return $query ? $query->libellefonction : 'Néant';
        })->label(['Néant' => 'danger']);
        $grid->column('datenaissance', __('Datenaissance'))->default('Néant')->label(['Néant' => 'danger',]);
        $grid->column('lieunaissance', __('Lieunaissance'))->default('Néant')->label(['Néant' => 'danger',]);
        $grid->column('sexe', __('Sexe'))->default('Néant')->label(['Néant' => 'danger',]);
        $grid->column('telephone', __('Telephone'))->default('Néant')->label(['Néant' => 'danger',]);
        $grid->column('email', __('Email'))->default('Néant')->label(['Néant' => 'danger',]);
        $grid->column('numeroautorisation', __('Numeroautorisation'))->default('Néant')->label(['Néant' => 'danger',]);
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
        $show = new Show(personnel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('matricule', __('Matricule'));
        $show->field('nom', __('Nom'));
        $show->field('prenoms', __('Prenoms'));
        $show->field('typepersonnels_id', __('Typepersonnels id'));
        $show->field('diplomepersonnels_id', __('Diplomepersonnels id'));
        $show->field('datenaissance', __('Datenaissance'));
        $show->field('lieunaissance', __('Lieunaissance'));
        $show->field('sexe', __('Sexe'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('numeroautorisation', __('Numeroautorisation'));
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
        $form = new Form(new personnel());

            $route = \URL::current();
             $data = explode("/", $route);
             $etablissements_id=$data[5];
            session(['etablissementchoisi'=> $data[5]]);
        // $parametresglobaux = Parametresglobaux::findOrFail(1);
        // 	$anneescolaires_id = $parametresglobaux->anneescolaires_id;	            			
        // 	$EtabAnnee = DB::table('etablissementannees')
        // 	    ->where('anneescolaires_id', '=', $anneescolaires_id)	
        //         ->where('etablissements_id', '=', $etablissements_id)				
        //         ->first();
        // 	$mesDonnees = $EtabAnnee->id;
        // 		//dd($DonneeEtab);
        // 	$libelleanneescolaire=Anneescolaire::find($anneescolaires_id)->libelleanneescolaire;
        // 	$denominationetab=Etablissement::find($etablissements_id)->denominationetab;
        // 	session(['libelleanneescolaire' =>$libelleanneescolaire]);
        // 	session(['denominationetab' =>$denominationetab]);

        //     session(['id' =>$mesDonnees ]);

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
		<p>Nos choix: Code Etablissement: ' . session('etablissementchoisi') . '|  Etablissement: ' . session('denominationetab') . '|  Année Scolaire: ' . session('libelleanneescolaire') . '</p>
		
		<div>
                <span style="font-size: 14px";><a href="/admin/etablissements2/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                
                <span style="font-size: 14px";><a href="/admin/personnels/create">Personnel</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/personnelannees/create">Personnel-Année</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/besoinpersonneladms/create">Besoin personnel Administratif</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/besoinpersonnelens/create">Besoin personnel enseignant</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/infrastructures/create">Infrastructure</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/besoininfrastructures/create">Besoin infrastructure</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/classes/create">Classe</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/activitesportives/create">Activités sportives</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/associations/create">Association/Club</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/apprenants/create">Apprenants</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/apprenantannees/create">Apprenant-Année</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/besoins/create">Besoin</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/plannings/create">Planning</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/resultats/create">Resultats</a></span>
            </div>
		
	<style>
		.numberCircle {
    width: 30px;
    line-height: 30px;
    border-radius: 50%;
    text-align: center;
    font-size: 14px;
    border: 2px solid #666;
}

</style>

');

        $form->text('nom', __('Nom'));
        $form->text('prenoms', __('Prenoms'));
        $form->text('matricule', __('Matricule'));
        // $form->number('typepersonnels_id', __('Typepersonnels id'));
        $lestypepersonnels = array();
        $typepersonnels = Typepersonnel::all();
        foreach ($typepersonnels as $typepersonnel) {
            $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
        }
        $form->select('typepersonnels_id', __('Type personnel'))->options($lestypepersonnels);
        // $form->number('diplomepersonnels_id', __('Diplomepersonnels id'));
        $lesdiplomes = array();
        $diplomes = Diplomepersonnel::all();
        foreach ($diplomes as $diplome) {
            $lesdiplomes[$diplome->id] = $diplome->libellediplome;
        }
        $form->select('diplomepersonnels_id', __('Diplome personnel'))->options($lesdiplomes);
        // $form->number('diplomepersonnels_id', __('Diplomepersonnels id'));
        $lesfonctions = array();
        $fonctions = Fonctionpersonnel::all();
        foreach ($fonctions as $fonction) {
            $lesfonctions[$fonction->id] = $fonction->libellefonction;
        }
        $form->select('fonctionpersonnels_id', __('Fonction personnel'))->options($lesfonctions);
        $form->date('datenaissance', __('Datenaissance'))->default(date('Y-m-d'));
        $form->text('lieunaissance', __('Lieunaissance'));
        $form->text('sexe', __('Sexe'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        $form->text('numeroautorisation', __('Numeroautorisation'));

        // $form->saved(function (Form $form) {
        //     // $idDonneeEtab=session('idDonneesEtab');
        //     // $idEtab=session('etablissementchoisi'); 
        //       return redirect('/admin/personnelannees/create');

        //   });

        $form->hasMany('personnelannees', __('I- Informations en plus'), function (Form\NestedForm $form) {
            $current_user = Auth::guard('admin')->user();
            $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
            $current_school = Etablissement::where('id', $current_user->idEtab)->first();

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
            $form->text('quotahoraire', __('Quotahoraire'));
            $form->text('nbreheureeffectuee', __('Nbreheureeffectuee'));
            $form->text('nbreheureresponsabilite', __('Nbreheureresponsabilite'));
        });


        return $form;
    }
}
