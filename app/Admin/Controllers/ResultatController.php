<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Periode;
use App\Models\Resultat;
use App\Models\Apprenant;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class ResultatController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resultat';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new resultat());

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $current_school = Etablissement::where('id', $current_user->idEtab)->first();

        // if (!(Auth::guard('admin')->user()->id == 0)) {
        //     $grid->model()->where('personnelannees.etablissementannees_id', Auth::guard('admin')->user()->idEtab);
        // }

        $grid->column('id', __('Id'));
        $grid->column('moyenneperiode', __('Moyenneperiode'));
        $grid->column('rangperiode', __('Rangperiode'));
        $grid->column('mentionperiode', __('Mentionperiode'));
        $grid->column('observation', __('Observation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('periodes_id', __('Periodes id'));
        $grid->column('apprenants_id', __('Apprenants id'));

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
        $show = new Show(resultat::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('moyenneperiode', __('Moyenneperiode'));
        $show->field('rangperiode', __('Rangperiode'));
        $show->field('mentionperiode', __('Mentionperiode'));
        $show->field('observation', __('Observation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('periodes_id', __('Periodes id'));
        $show->field('apprenants_id', __('Apprenants id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new resultat());

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
			<span style=" display: inline-block; width: 13px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">12</span>
			<span style=" display: inline-block; width: 13px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 13px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">13</span>
			<span style=" display: inline-block; width: 13px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 13px; border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: Silver;font-weight: bold;">14</span>
			<span style=" display: inline-block; width: 13px;border: 5px solid silver;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
			<span style=" display: inline-block; width: 13px; border: 5px solid gray;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: gray;font-weight: bold;">15</span>
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

        $lesapprenants = array();
        $apprenants = Apprenant::all();
        foreach ($apprenants as $apprenant) {
            $lesapprenants[$apprenant->id] = $apprenant->nom . ' ' . $apprenant->prenoms;
        }
        $form->select('apprenants_id', __('Apprenants'))->options($lesapprenants);

        $form->text('moyenneperiode', __('Moyenneperiode'));
        $form->text('rangperiode', __('Rangperiode'));
        $form->text('mentionperiode', __('Mentionperiode'));
        $form->textarea('observation', __('Observation'));
        // $form->number('etablissementannees_id', __('Etablissementannees id'));
        // $form->number('periodes_id', __('Periodes id'));
        // $form->number('apprenants_id', __('Apprenants id'));

        return $form;
    }
}
