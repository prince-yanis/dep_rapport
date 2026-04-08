<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Apprenant;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Encore\Admin\Controllers\AdminController;

class EtabApprenantController extends AdminController
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

    $grid->column('id', __('Id'));
    $grid->column('matriculeap', __('Matriculeap'));
    $grid->column('nom', __('Nom'));
    $grid->column('prenoms', __('Prenoms'));
    $grid->column('datenaissance', __('Datenaissance'));
    $grid->column('lieunaissance', __('Lieunaissance'));
    $grid->column('telephone', __('Telephone'))->default('Néant');
    $grid->column('email', __('Email'))->default('Néant');
    $grid->column('sexe', __('Sexe'));
    $grid->column('nationalite', __('Nationalite'));
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
    $show->field('prenoms', __('Prenoms'));
    $show->field('datenaissance', __('Datenaissance'));
    $show->field('lieunaissance', __('Lieunaissance'));
    $show->field('telephone', __('Telephone'))->default('Néant');
    $show->field('email', __('Email'))->default('Néant');
    $show->field('sexe', __('Sexe'));
    $show->field('nationalite', __('Nationalite'));
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

');

    $form->text('matriculeap', __('Matricule'));
    $form->text('nom', __('Nom'));
    $form->text('prenoms', __('Prenoms'));
    $form->text('datenaissance', __('Date de naissance'));
    $form->text('lieunaissance', __('Lieu de naissance'));
    $form->text('telephone', __('Telephone'));
    $form->email('email', __('Email'));
    // $form->text('sexe', __('Sexe'));
    // $form->checkbox('sexe', __('Sexe'))->options(['Feminin' => 'Feminin', 'Masculin' => 'Masculin']);
    $form->radio('sexe', __('Sexe'))->options(['Feminin' => 'Feminin', 'Masculin' => 'Masculin']);
    // $form->text('nationalite', __('Nationalite'));
    $form->radio('nationalite', __('Nationalite'))->options(['IVOIRIENNE' => 'IVOIRIENNE', 'ETRANGER' => 'ETRANGER']);
    $form->radio('handicap', __('Handicap'))->options(['Oui' => 'Oui', 'Non' => 'Non']);
    $form->text('typehandicap', __("Type d'Handicap"));
    // $form->number('etablissementannees_id', __('Etablissementannees id'));

    $form->saved(function (Form $form) {
      // $idDonneeEtab=session('idDonneesEtab');
      // $idEtab=session('etablissementchoisi'); 
        return redirect('/admin');
        // return back();

    });

    return $form;
  }
}
