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

class PersonnelEtabController extends AdminController
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
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableActions();


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

        // $route = \URL::current();
        //  $data = explode("/", $route);
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
        <h1 style="text-align:center; text-transform:uppercase;">Insérer un personnel</h1>
		
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
        
        $form->date('datenaissance', __('Datenaissance'))->default(date('Y-m-d'));
        $form->text('lieunaissance', __('Lieunaissance'));
        $form->text('sexe', __('Sexe'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        $form->text('numeroautorisation', __('Numeroautorisation'));
        $form->text('dateautorisation', __('Dateautorisation'));
        $form->file('documentautorisation', "Uploader le document d'autorisation");
        $form->file('cv', "Uploader votre Curriculum Vitae");

        $form->tools(function (Form\Tools $tools) {

            // Disable `List` btn.
            $tools->disableList();
        
            // Disable `Delete` btn.
            $tools->disableDelete();
        
            // Disable `Veiw` btn.
            $tools->disableView();
        
        });

        $form->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();
        
        
            // disable `View` checkbox
            $footer->disableViewCheck();
        
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
        
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        
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

            return redirect('admin/etabanneepersonnel/' . $EtabAnnee->id . '/edit');
        });


        return $form;
    }
}
