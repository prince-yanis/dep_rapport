<?php

namespace App\Admin\Controllers;

use App\Models\Bourse;
use App\Models\Classe;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Apprenant;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Apprenantannee;
use App\Models\Statutapprenant;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class ApprenantanneeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Apprenantannee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new apprenantannee());

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $current_school = Etablissement::where('id', $current_user->idEtab)->first();

        if (!(Auth::guard('admin')->user()->id == 0)) {
            $grid->model()->where('apprenantannees.etablissementannees_id', Auth::guard('admin')->user()->idEtab);
        }

        $grid->column('id', __('Id'));
        // $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->etablissementannees_id()->display(function ($id) {
            $lesetabannees=array();
            $query = DB::table('etablissementannees')
            // $query = Etablissementannee::find($id)
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=' ,'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=' ,'anneescolaires.id')
            ->select('etablissementannees.*','anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
            ->get();
            // return $query->libellestatutpers;
            foreach ($query as $q) {
            return $lesetabannees[$q->id] = $q->libelleanneescolaire . ' - ' . $q->denominationetab;
        }
        });
        // $grid->column('apprenants_id', __('Apprenants id'));
        $grid->apprenants_id()->display(function ($id) {
            $query = Apprenant::find($id);
            return $query->nom . '' . $query->prenoms;
        });
        // $grid->column('classes_id', __('Classes id'));
        $grid->classes_id()->display(function ($id) {
            $query = Classe::find($id);
            return $query->denominationclasse;
        });
        // $grid->column('statutapprenants_id', __('Statutapprenants id'));
        $grid->statutapprenants_id()->display(function ($id) {
            $query = Statutapprenant::find($id);
            return $query->libellestatutap;
        });
        // $grid->column('bourses_id', __('Bourses id'));
        $grid->bourses_id()->display(function ($id) {
            $query = Bourse::find($id);
            return $query->libellebourse;
        });
        $grid->column('decisionfinannee', __("Décision de fin d'année"));
        $grid->column('moyenneannee', __('Moyenne année'));
        $grid->column('observation', __('Observation'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('groupepedagogiques_id', __('Groupepedagogiques id'));

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
        $show = new Show(apprenantannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('classes_id', __('Classes id'));
        $show->field('apprenants_id', __('Apprenants id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('statutapprenants_id', __('Statutapprenants id'));
        $show->field('bourses_id', __('Bourses id'));
        $show->field('decisionfinannee', __('Decisionfinannee'));
        $show->field('moyenneannee', __('Moyenneannee'));
        $show->field('observation', __('Observation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        // $show->field('groupepedagogiques_id', __('Groupepedagogiques id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new apprenantannee());

        // $route = \URL::current();
        //  $data = explode("/", $route);
        //  //dd($data);
        //  $etablissements_id=$data[5];
        // session(['etablissementchoisi'=> $data[5]]);
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
			<span style=" display: inline-block; width: 15px; margin:0";></span>
			<span class="numberCircle" style="background-color: silver; color: white;font-weight: bold;">1</span>
			<span style=" display: inline-block; width: 25px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
            <span style=" display: inline-block; width: 25px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">2</span>
			<span style=" display: inline-block; width: 20px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 20px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">3</span>
			<span style=" display: inline-block; width: 25px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
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
			<span style=" display: inline-block; width: 13px; border: 5px solid gray;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: gray;font-weight: bold;">12</span>
			<span style=" display: inline-block; width: 13px;border: 5px solid gray;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
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

        // $form->number('classes_id', __('Classes id'));
        $lesclasses = array();
        $classes = Classe::all();
        foreach ($classes as $classe) {
            $lesclasses[$classe->id] = $classe->denominationclasse;
        }
        $form->select('classes_id', __('Classes'))->options($lesclasses);

        // $form->number('groupepedagogiques_id', __('Groupepedagogiques id'));

        // $form->number('apprenants_id', __('Apprenants id'));
        $lesapprenants = array();
        $apprenants = Apprenant::all();
        foreach ($apprenants as $apprenant) {
            $lesapprenants[$apprenant->id] = $apprenant->nom . ' ' . $apprenant->prenoms;
        }
        $form->select('apprenants_id', __('Apprenants'))->options($lesapprenants);

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
        $form->text('moyenneannee', __('Moyenneannee'));
        $form->radio('decisionfinannee', __('Decisionfinannee'))->options(['Admis' => 'Admis', 'Réfusé' => 'Réfusé']);
        $form->textarea('observation', __('Observation'))->default('Néant');

        $form->saved(function (Form $form) {
            // $idDonneeEtab=session('idDonneesEtab');
            // $idEtab=session('etablissementchoisi');
            //   return redirect('admin/personnels/create');
              return redirect('/admin/besoins/create');

          });

        return $form;
    }
}
