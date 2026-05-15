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
use App\Models\Filiere;
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

class EtablissementanneeActivitesextrascolaireController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rapport de la rentrée';

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
        $grid->column('nature', __('Nature'));
        $grid->column('objectif', __('Objectif'));
        $grid->column('observation', __('Observation'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
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
        $show = new Show(etablissementannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nature', __('Nature'));
        $show->field('objectif', __('Objectif'));
        $show->field('observation', __('Observation'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
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
                <h1 style="text-align:center; text-transform:uppercase;">Identification</h1>
                <span style="font-size: 14px;"><a href="/admin/etablissementdetails2eme/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne2eme/'. $EtabAnnee->id .'/edit">Filières de Formation</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneepersonnel2eme">Personnels</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinpersonneladmin/'. $EtabAnnee->id .'/edit">Besoin en Personnel Administratif</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinpersonnelens/'. $EtabAnnee->id .'/edit">Besoin en Personnel Enseignant</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeclasse2eme/'. $EtabAnnee->id .'/edit">Classe</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeresultat2eme/'. $EtabAnnee->id .'/edit">Resultats aux Examens</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure2eme/'. $EtabAnnee->id .'/edit">Infrastructure et Locaux</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneeactivitesextrascolaire/'. $EtabAnnee->id .'/edit">Infrastructure et Locaux</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinmateriel/'. $EtabAnnee->id .'/edit">Besoin en Matériels et Divers</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeprevision2eme/'. $EtabAnnee->id .'/edit">Prévision</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeetat2eme/'. $EtabAnnee->id .'/edit">Etat des difficultés gestion et suggestion</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeconclusion2eme/'. $EtabAnnee->id .'/edit">Conclusion</a></span>
				<span >|</span>
                <span style="font-size: 14px";><a href="/admin/apprenantannees_2eme">Apprenants</a></span>
        </div>
            ');
// Ajoutez ces champs juste après le hasMany
       
        $form->hasMany('activitesextrascolaires', __(''), function (Form\NestedForm $form) {
           $form->text('nature', __('Nature'));
            $form->textarea('objectif', __('Objectif'));
            $form->textarea('observation', __('Observation'));
        });
        

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

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

            return redirect('admin/etabanneebesoinmateriel/' . $EtabAnnee->id . '/edit');
        });
        return $form;
    }
}
