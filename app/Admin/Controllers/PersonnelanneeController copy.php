<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Personnel;
use App\Models\Discipline;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Etablissementannee;
use App\Models\Personnelannee;
use App\Models\Statutpersonnel;
use App\Models\Niveauenseignant;
use App\Models\Fonctionpersonnel;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class PersonnelanneeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Personnelannee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new personnelannee());

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $current_school = Etablissement::where('id', $current_user->idEtab)->first();

        if (in_array($current_role->role_id, array(2))) {
            $grid->model()
                ->leftJoin('etablissementannees', 'personnelannees.etablissementannees_id', '=' ,'etablissementannees.id')
                ->where('etablissementannees.etablissements_id', '=', $current_school->id);
        }

        $grid->column('id', __('Id'));
        $grid->column('personnels_id', __('Personnels id'));
        $grid->column('disciplines_id', __('Disciplines id'))->default('Néant');
        $grid->column('cons_ens', __('Conseiller enseignant'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('statutpersonnel_id', __('Statutpersonnel id'))->default('Néant');
        $grid->column('fonctionpersonnels_id', __('Fonctionpersonnels id'))->default('Néant');
        $grid->column('niveauenseignant_id', __('Niveauenseignant id'))->default('Néant');
        $grid->column('quotahoraire', __('Quotahoraire'));
        $grid->column('nbreheureeffectuee', __('Nbreheureeffectuee'));
        $grid->column('nbreheureresponsabilite', __('Nbreheureresponsabilite'));
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
        $show = new Show(personnelannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('personnels_id', __('Personnels id'));
        $show->field('disciplines_id', __('Disciplines id'));
        $show->field('cons_ens', __('Conseiller enseignant'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('statutpersonnel_id', __('Statutpersonnel id'));
        $show->field('fonctionpersonnels_id', __('Fonctionpersonnels id'));
        $show->field('niveauenseignant_id', __('Niveauenseignant id'));
        $show->field('quotahoraire', __('Quotahoraire'));
        $show->field('nbreheureeffectuee', __('Nbreheureeffectuee'));
        $show->field('nbreheureresponsabilite', __('Nbreheureresponsabilite'));
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
        $form = new Form(new personnelannee());

        // $route = \URL::current();
		//  $data = explode("/", $route);
		//  //dd($data);
		//  $etablissements_id=$data[5];
		// // session(['etablissementchoisi'=> $data[5]]);	
		// $parametresglobaux = Parametresglobaux::findOrFail($id);
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
		//  session(['id' =>$mesDonnees ]);

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
		<p>Nos choix: Code Etablissement: '.session('etablissementchoisi').'|  Etablissement: '.session('denominationetab').'|  Année Scolaire: '.session('libelleanneescolaire').'</p>
		<div>
			<span style=" display: inline-block; width: 15px; margin:0";></span>
			<span class="numberCircle" style="background-color: silver; color: white;font-weight: bold;">1</span>
			<span style=" display: inline-block; width: 25px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
            <span style=" display: inline-block; width: 25px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">2</span>
			<span style=" display: inline-block; width: 20px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 20px; border: 5px solid gray;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: gray;font-weight: bold;">3</span>
			<span style=" display: inline-block; width: 25px;border: 5px solid gray;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 25px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver; font-weight: bold;">4</span>
			<span style=" display: inline-block; width: 20px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 20px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">5</span>
			<span style=" display: inline-block; width: 12px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 12px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">6</span>
			<span style=" display: inline-block; width: 15px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 15px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">7</span>
			<span style=" display: inline-block; width: 20px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 20px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">8</span>
			<span style=" display: inline-block; width: 12px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 12px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">9</span>
			<span style=" display: inline-block; width: 15px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 15px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">10</span>
			<span style=" display: inline-block; width: 12px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 12px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">11 </span>
			<span style=" display: inline-block; width: 13px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 13px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">12</span>
			<span style=" display: inline-block; width: 13px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 13px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">13</span>
			<span style=" display: inline-block; width: 13px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 13px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">14</span>
			<span style=" display: inline-block; width: 13px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 13px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">15</span>
		</div>
		<div>
                <span style="font-size: 14px";><a href="/admin/etablissements2/'.session('etablissementchoisi').'/edit">Identification</a></span>
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

// $form->hasMany('personnelannees',__(' '), function (Form\NestedForm $form) { 
//     $lesetabannees=array();
//         $etabannees = DB::table('etablissementannees')
//         ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=' ,'etablissements.id')
//         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=' ,'anneescolaires.id')
//         ->select('etablissementannees.*','anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
//         ->get();
        
//         foreach ($etabannees as $etabannee) {
//             $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
//         }
//     $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees);
//     $lespersonnels=array();
//         $personnels=Personnel::all();
//         foreach ($personnels as $personnel) {
//             $lespersonnels[$personnel->id]=$personnel->nom .' '. $personnel->prenoms;
//         }
//     $form->select('personnels_id', __('Personnel'))->options($lespersonnels);
//     $lesdisciplines=array();
//         $disciplines=Discipline::all();
//         foreach ($disciplines as $discipline) {
//             $lesdisciplines[$discipline->id]=$discipline->libellediscipline;
//         }
//     $form->select('disciplines_id', __('Disciplines'))->options($lesdisciplines);
//     $lesstatuts=array();
//         $statuts=Statutpersonnel::all();
//         foreach ($statuts as $statut) {
//             $lesstatuts[$statut->id]=$statut->libellestatutpers;
//         }
//     $form->select('statutpersonnel_id', __('Statut'))->options($lesstatuts);
//     $lesfonctions=array();
//         $fonctions=Fonctionpersonnel::all();
//         foreach ($fonctions as $fonction) {
//             $lesfonctions[$fonction->id]=$fonction->libellefonction;
//         }
//     $form->select('fonctionpersonnels_id', __('Fonction'))->options($lesfonctions);
//     $lesniveaux=array();
//         $niveaux=Niveauenseignant::all();
//         foreach ($niveaux as $niveau) {
//             $lesniveaux[$niveau->id]=$niveau->libelleniveau;
//         }
//     $form->select('niveauenseignant_id', __('Niveau'))->options($lesniveaux);
//     $form->text('quotahoraire', __('Quotahoraire'));
//     $form->text('nbreheureeffectuee', __('Nbreheureeffectuee'));
//     $form->text('nbreheureresponsabilite', __('Nbreheureresponsabilite'));

// });
        
    $current_user = Auth::guard('admin')->user();
    $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
    $current_school = Etablissement::where('id', $current_user->idEtab)->first();

        $lesetabannees=array();
        if (in_array($current_role->role_id, array(2))) {
            $etabannees = DB::table('etablissementannees')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=' ,'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=' ,'anneescolaires.id')
            ->select('etablissementannees.*','anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
            ->where('etablissements.id', $current_school->id)
            ->get();
        } else {
            $etabannees = DB::table('etablissementannees')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=' ,'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=' ,'anneescolaires.id')
            ->select('etablissementannees.*','anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
            ->get();    
        }
        
        foreach ($etabannees as $etabannee) {
            $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
        }
        // $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees)->default($current_school->id);
        $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees)->default($current_school->id);

        $lespersonnels=array();
        $personnels=Personnel::all();
        foreach ($personnels as $personnel) {
            $lespersonnels[$personnel->id]=$personnel->nom .' '. $personnel->prenoms;
        }
        $form->select('personnels_id', __('Personnel'))->options($lespersonnels);

        $lesdisciplines=array();
        $disciplines=Discipline::all();
        foreach ($disciplines as $discipline) {
            $lesdisciplines[$discipline->id]=$discipline->libellediscipline;
        }
        $form->select('disciplines_id', __('Disciplines'))->options($lesdisciplines);
        $form->switch('cons_ens', __('Conseiller enseignant'));
        
        $lesstatuts=array();
        $statuts=Statutpersonnel::all();
        foreach ($statuts as $statut) {
            $lesstatuts[$statut->id]=$statut->libellestatutpers;
        }
        $form->select('statutpersonnel_id', __('Statut'))->options($lesstatuts);

        $lesfonctions=array();
        $fonctions=Fonctionpersonnel::all();
        foreach ($fonctions as $fonction) {
            $lesfonctions[$fonction->id]=$fonction->libellefonction;
        }
        $form->select('fonctionpersonnels_id', __('Fonction'))->options($lesfonctions);

        $lesniveaux=array();
        $niveaux=Niveauenseignant::all();
        foreach ($niveaux as $niveau) {
            $lesniveaux[$niveau->id]=$niveau->libelleniveau;
        }
        $form->select('niveauenseignant_id', __('Niveau'))->options($lesniveaux);
        $form->text('quotahoraire', __('Quotahoraire'));
        $form->text('nbreheureeffectuee', __('Nbreheureeffectuee'));
        $form->text('nbreheureresponsabilite', __('Nbreheureresponsabilite'));

        return $form;
    }
}
