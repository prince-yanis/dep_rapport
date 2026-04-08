<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Apprenant;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Handicap;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Encore\Admin\Controllers\AdminController;

class ApprenantController extends AdminController
{
  /**
   * Title for current resource.
   *
   * @var string
   */
  protected $title = 'Apprenant';

  /**
   * Make a grid builder.
   *
   * @return Grid
   */
  protected function grid()
  {
    $grid = new Grid(new apprenant());

    $grid->quickSearch('matriculeap', 'nom', 'prenoms');
    $grid->column('id', __('Id'));
    $grid->column('matriculeap', __('Matriculeap'));
    $grid->column('nom', __('Nom'));
    $grid->column('prenoms', __('Prénoms'));
    $grid->column('datenaissance', __('Date de naissance'));
    $grid->column('lieunaissance', __('Lieu de naissance'));
    $grid->column('telephone', __('Téléphone'))->default('Néant');
    $grid->column('email', __('Email'))->default('Néant');
    $grid->column('sexe', __('Sexe'));
    $grid->column('nationalite', __('Nationalité'));
    $grid->column('handicaps_id', __('Handicap'));
    $grid->column('created_at', __('Created at'));
    $grid->column('updated_at', __('Updated at'));

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
    $show = new Show(apprenant::findOrFail($id));

    $show->field('id', __('Id'));
    $show->field('matriculeap', __('Matriculeap'));
    $show->field('nom', __('Nom'));
    $show->field('prenoms', __('Prénoms'));
    $show->field('datenaissance', __('Date de naissance'));
    $show->field('lieunaissance', __('Lieu de naissance'));
    $show->field('telephone', __('Téléphone'))->default('Néant');
    $show->field('email', __('Email'))->default('Néant');
    $show->field('sexe', __('Sexe'));
    $show->field('nationalite', __('Nationalité'));
    $show->field('handicaps_id', __('Handicap'));
    $show->field('created_at', __('Created at'));
    $show->field('updated_at', __('Updated at'));
    // $show->field('etablissementannees_id', __('Etablissementannees id'));

    return $show;
  }

  /**
   * Make a form builder.
   *
   * @return Form
   */
  protected function form()
  {
    $form = new Form(new apprenant());

    // $route = \URL::current();
    // $data = explode("/", $route);
    // //dd($data);
    // $etablissements_id = $data[5];
    // session(['etablissementchoisi' => $data[5]]);
    // $parametresglobaux = Parametresglobaux::findOrFail(1);
    // $anneescolaires_id = $parametresglobaux->anneescolaires_id;
    // $EtabAnnee = DB::table('etablissementannees')
    //   ->where('anneescolaires_id', '=', $anneescolaires_id)
    //   ->where('etablissements_id', '=', $etablissements_id)
    //   ->first();
    // $mesDonnees = $EtabAnnee->id;
    // //dd($DonneeEtab);
    // $libelleanneescolaire = Anneescolaire::find($anneescolaires_id)->libelleanneescolaire;
    // $denominationetab = Etablissement::find($etablissements_id)->denominationetab;
    // session(['libelleanneescolaire' => $libelleanneescolaire]);
    // session(['denominationetab' => $denominationetab]);

    // session(['id' => $mesDonnees]);

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
			<span style=" display: inline-block; width: 12px; border: 5px solid gray;border-radius: 0px; margin: 0px 0px 0px 0px;" ></span>
			<span class="numberCircle" style="background-color: gray;font-weight: bold;">11 </span>
			<span style=" display: inline-block; width: 13px;border: 5px solid gray;border-radius: 0px; margin: 0px 0px 0px 0px;"></span>
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

    $form->text('matriculeap', __('Matricule'));
    $form->text('nom', __('Nom'));
    $form->text('prenoms', __('Prénoms'));
    $form->text('datenaissance', __('Date de naissance'));
    $form->text('lieunaissance', __('Lieu de naissance'));
    $form->text('telephone', __('Téléphone'));
    $form->email('email', __('Email'));
    // $form->text('sexe', __('Sexe'));
    // $form->checkbox('sexe', __('Sexe'))->options(['Feminin' => 'Feminin', 'Masculin' => 'Masculin']);
    $form->radio('sexe', __('Sexe'))->options(['F' => 'Feminin', 'M' => 'Masculin']);
    // $form->text('nationalite', __('Nationalite'));
    $form->radio('nationalite', __('Nationalité'))->options(['Ivoirienne' => 'IVOIRIENNE', 'Etranger' => 'ETRANGER']);

    $leshandicaps = array();
    $handicaps = Handicap::all();
    foreach ($handicaps as $handicap) {
      $leshandicaps[$handicap->id] = $handicap->libelle_handicap;
    }
    $form->select('handicaps_id', __('Handicap'))->options($leshandicaps);
    // $form->number('etablissementannees_id', __('Etablissementannees id'));

    $form->saved(function (Form $form) {
      // $idDonneeEtab=session('idDonneesEtab');
      // $idEtab=session('etablissementchoisi');
      //   return redirect('admin/personnels/create');
      return redirect('/admin/apprenantannees/create');
    });

    return $form;
  }
}
