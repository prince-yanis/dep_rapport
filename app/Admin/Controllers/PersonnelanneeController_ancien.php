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
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();
        $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;
        $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();

        $grid->model()
            ->join('etablissementannees', 'etablissementannees.id', '=', 'personnelannees.etablissementannees_id') // remplacez "table_principale" par le nom de votre table principale
            ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'));

        if (in_array($current_role->role_id, array(2))) {
            $grid->model()->where('personnelannees.etablissementannees_id', '=', $EtabAnnee->id);

            $grid->disableExport();
            $grid->disableFilter();
            $grid->disableRowSelector();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
                $actions->disableDelete();
            });
        }

        // $grid->column('id', __('Id'));
        // $grid->column('personnels_id', __('Personnels id'));
        $grid->etablissementannees_id("Année scolaire - Etablissement")->display(function ($etablissementannees_id) {
            $query = Etablissementannee::with(['etablissement', 'anneescolaire'])
                ->where('id', $etablissementannees_id) // Filtrer par ID spécifique
                ->where('anneescolaires_id', Parametresglobaux::findOrFail(1)->anneescolaires_id) // Filtrer par l'année scolaire actuelle
                ->first(); // Récupérer le premier résultat correspondant

            if ($query) {
                return $query->anneescolaire->libelleanneescolaire . ' - ' .
                    ($query->etablissement->sigle ?? $query->etablissement->denominationetab);
            }

            return 'Données non disponibles';
        });

        // $grid->column('disciplines_id', __('Disciplines id'))->default('Néant');


        $grid->personnels_id()->display(function ($id) {
            $query = Personnel::find($id);

            if ($query && $query->nom && $query->prenoms) {
                return $query->nom . ' ' . $query->prenoms;
            }

            return 'non renseigné';
        });
        $grid->disciplines_id()->display(function ($id) {
            $query = Discipline::find($id);
            return $query->libellediscipline ?? 'Néant';
        });
        $grid->cons_ens()->display(function ($value) {
            return $value ? 'Oui' : 'Non';
        });
        // $grid->column('statutpersonnel_id', __('Statutpersonnel id'))->default('Néant');
        $grid->statutpersonnel_id()->display(function ($id) {
            $query = Statutpersonnel::find($id);
            return $query->libellestatutpers ?? 'Néant';
        });
        // $grid->column('fonctionpersonnels_id', __('Fonctionpersonnels id'))->default('Néant');
        $grid->fonctionpersonnels_id()->display(function ($id) {
            $query = Fonctionpersonnel::find($id);
            return $query->libellefonction  ?? 'Néant';
        });
        // $grid->column('niveauenseignant_id', __('Niveauenseignant id'))->default('Néant');
        $grid->niveauenseignant_id()->display(function ($id) {
            $query = Niveauenseignant::find($id);
            return $query->libelleniveau ?? 'Néant';
        });
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
		<p>Nos choix: Code Etablissement: ' . session('etablissementchoisi') . '|  Etablissement: ' . session('denominationetab') . '|  Année Scolaire: ' . session('libelleanneescolaire') . '</p>
		
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
        $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();
        $lesetabannees = array();
        $etabannees = DB::table('etablissementannees')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
            ->get();
        foreach ($etabannees as $etabannee) {
            $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
        }
        $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees)->default($EtabAnnee ? $EtabAnnee->id : null)->readOnly();
        // $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees);

        $lespersonnels = array();
        $personnels = Personnel::all();
        foreach ($personnels as $personnel) {
            $lespersonnels[$personnel->id] = $personnel->nom . ' ' . $personnel->prenoms;
        }
        $form->select('personnels_id', __('Personnel'))->options($lespersonnels);

        $lesdisciplines = array();
        $disciplines = Discipline::all();
        foreach ($disciplines as $discipline) {
            $lesdisciplines[$discipline->id] = $discipline->libellediscipline;
        }
        $form->select('disciplines_id', __('Disciplines'))->options($lesdisciplines);
        $form->switch('cons_ens', __('Conseiller enseignant'));

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

        return $form;
    }
}
