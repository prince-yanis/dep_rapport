<?php

namespace App\Admin\Controllers;

use App\Models\Bourse;
use App\Models\Classe;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Apprenant;
use App\Models\Decision;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Apprenantannee;
use App\Models\Etablissementannee;
use App\Models\Handicap;
use App\Models\Statutapprenant;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Observers\DecisionAutoObserver;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class Apprenantannee_2emeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Apprenant annee 2eme semestre';

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
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();
        $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

        if (in_array($current_role->role_id, [2])) {
            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', $etablissement->id)
                ->first();

            $grid->model()->where('etablissementannees_id', function ($query) use ($etablissement, $anneescolaires_id) {
                $query->select('id')
                    ->from('etablissementannees')
                    ->where('etablissements_id', $etablissement->id)
                    ->where('anneescolaires_id', session('anneescolaireactuelle'));
            });
			//$grid->expandFilter();
			$grid->filter(function ($filter) use ($EtabAnnee) {
				$filter->expand();
    $anneescolaireActuelle = session('anneescolaireactuelle');

    // Remove the default id filter
    $filter->disableIdFilter();

    // ✅ Filtre sur la classe pour l'établissement courant
    if ($EtabAnnee) {
        $classesOptions = Classe::where('etablissementannees_id', $EtabAnnee->id)
            ->pluck('denominationclasse', 'id')
            ->toArray();

        $filter->equal('classes_id', 'Classe')->select($classesOptions);
    }
});


            $grid->disableExport();
            $grid->disableColumnSelector();
            // $grid->disableFilter();
            $grid->disableActions();
            $grid->disableCreateButton();
            // $grid->disableRowSelector();
            /* $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
            });*/
            $grid->quickSearch(function ($model, $search) {
                $model->whereHas('apprenant', function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenoms', 'like', "%{$search}%")
                        ->orWhere('matriculeap', 'like', "%{$search}%");
                });
            });
            $grid->tools(function ($tools) {
                $tools->append('<a href="/admin/remplissage2emesemestre" class="btn btn-sm btn-success" 
                onclick="return confirm(\'Avez-vous saisir les données du 2eme semestre des apprenants ?\')">J\'ai terminé mon rapport</a>');
            });
            // $grid->column('id', __('Id'));
            // $grid->column('etablissementannees_id', __('Etablissementannees id'));
            
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
			
            // $grid->column('apprenants_id', __('Apprenants id'));
            $grid->apprenants_id("Nom & Prénoms")->display(function ($id) {
                $query = Apprenant::find($id);
                if (!$query) {
                    return '<i>Non renseigné</i>';
                }
                return '<b>' . $query->matriculeap . ' | </b> ' . $query->nom . ' ' . $query->prenoms;
            })->sortable();;
            // $grid->column('classes_id', __('Classes id'));
            $grid->classes_id("Classes")->display(function ($id) {
    $query = Classe::find($id);
    return $query ? $query->denominationclasse : 'Non renseignée';
});
            // $grid->column('statutapprenants_id', __('Statutapprenants id'));
            $grid->statutapprenants_id("Statuts")->display(function ($id) {
                $query = Statutapprenant::find($id);
                return $query ? $query->libellestatutap : 'Non renseigné';
            });
            // $grid->column('moyenne1er', __('Moyenne du 1er semestre'));
            $grid->bourses_id("Bourses")->display(function ($id) {
                $query = Bourse::find($id);
                return $query ? $query->libellebourse : 'Non renseigné';
            });
            // Ajout sur le rapport de 1er semestre
            $grid->column('moyenne1er', __('Moyenne du 1er semestre'));
            $grid->column('moyenne2eme', __('Moyenne du 2 ème semestre'))->editable();
            $grid->column('moyenneannee', __('Moyenne annuelle'))->editable();
            // $grid->column('bourses_id', __('Bourses id'));
            $grid->column('observation', __('Observation'))->editable('textarea');
            
            $decisionsvalues = array();
            $decisions = Decision::all();
            foreach ($decisions as $val) {
                $decisionsvalues[$val->id] = $val->libelledecision;
            }
            $grid->column('decision_id', __("Décision de fin d'année"))->editable('select', $decisionsvalues);



            $grid->column('candidat', __("Candidat aux examens"))
                ->editable('select', ['' => '','Oui' => 'Oui', 'Non' => 'Non']);

            $grid->column('resultat', __('Résultat aux examens'))
                ->editable('select', ['' => '','Admis' => 'Admis', 'Refusé' => 'Refusé', 'Absent' => 'Absent']);
            
        } else {
            $anneescolaireActuelle = session('anneescolaireactuelle');

            $grid->model()
                ->join('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
                ->join('etablissementannees', 'etablissementannees.id', '=', 'apprenantannees.etablissementannees_id') // remplacez "table_principale" par le nom de votre table principale
                ->select('apprenants.*', 'etablissementannees.*', 'apprenantannees.*')
                ->orderBy('apprenants.nom', 'ASC')
                ->where('etablissementannees.etablissements_id', session('etablissementchoisi'))
                ->where('etablissementannees.anneescolaires_id', $anneescolaireActuelle);

            // $grid->model()->where('etablissementannees_id', 904);

            $grid->quickSearch(function ($model, $search) {
                $model->whereHas('apprenant', function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenoms', 'like', "%{$search}%")
                        ->orWhere('matriculeap', 'like', "%{$search}%");
                });
            });

            $grid->tools(function ($tools) {
                // $tools->append('<a href="/admin/remplissage2emesemestre" class="btn btn-sm btn-success">J ai terminé mon rapport</a>');
                $tools->append('<a href="/admin/remplissage2emesemestre" class="btn btn-sm btn-success" 
                onclick="return confirm(\'Avez-vous saisir les données du 2eme semestre des apprenants ?\')">J\'ai terminé mon rapport</a>');
            });

            $grid->filter(function ($filter) {
                $anneescolaireActuelle = session('anneescolaireactuelle');
                // Remove the default id filter
                $filter->disableIdFilter();
                $etablissementanneesOptions = array();
                $etablissementannees = DB::table('etablissementannees')
                    ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                    ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                    ->select('etablissementannees.id', 'anneescolaires.libelleanneescolaire', 'etablissementannees.anneescolaires_id', 'etablissements.denominationetab')
                    ->where('etablissementannees.anneescolaires_id', $anneescolaireActuelle)
                    ->get();
                foreach ($etablissementannees as $etablissementannee) {
                    $etablissementanneesOptions[$etablissementannee->id] = $etablissementannee->libelleanneescolaire . ' - ' . $etablissementannee->denominationetab;
                }
                $filter->in('etablissementannees_id', "Année scolaire - Etablissement")->select($etablissementanneesOptions);
            });

            $grid->column('id', __('Id'));
            // $grid->column('etablissementannees_id', __('Etablissementannees id'));
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
            // $grid->column('apprenants_id', __('Apprenants id'));
            $grid->apprenants_id("Nom & Prénoms")->display(function ($id) {
                $query = Apprenant::find($id);
                return '<b>' . $query->matriculeap . ' | </b> ' . $query->nom . ' ' . $query->prenoms;
            });
            // $grid->column('classes_id', __('Classes id'));
            $grid->classes_id("Classes")->display(function ($id) {
    $query = Classe::find($id);
    return $query ? $query->denominationclasse : 'Non renseignée';
});
            $grid->bourses_id("Bourses")->display(function ($id) {
                $query = Bourse::find($id);
                return $query ? $query->libellebourse : 'Non renseigné';
            });
            // Ajout sur le rapport de 1er semestre
            $grid->column('moyenne1er', __('Moyenne du 1er semestre'));

            $grid->column('moyenne2eme', __('Moyenne du 2 ème semestre'))->editable();
            $grid->column('moyenneannee', __('Moyenne annuelle'))->editable();
            // $grid->column('bourses_id', __('Bourses id'));
            $grid->column('observation', __('Observation'))->editable('textarea');
            
            $decisionsvalues = array();
            $decisions = Decision::all();
            foreach ($decisions as $val) {
                $decisionsvalues[$val->id] = $val->libelledecision;
            }
            $grid->column('decision_id', __("Décision de fin d'année"))->editable('select', $decisionsvalues);



            $grid->column('candidat', __("Candidat aux examens"))
                ->editable('select', ['' => '','Oui' => 'Oui', 'Non' => 'Non']);

            $grid->column('resultat', __('Résultat aux examens'))
                ->editable('select', ['' => '','Admis' => 'Admis', 'Refusé' => 'Refusé', 'Absent' => 'Absent']);

            //$grid->disableActions();

        }
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
        $form->text('apprenant.matriculeap', __('Matricule'));
        $form->text('apprenant.nom', __('Nom'));
        $form->text('apprenant.prenoms', __('Prénoms'));
        $form->text('apprenant.datenaissance', __('Date de naissance'));
        $form->text('apprenant.lieunaissance', __('Lieu de naissance'));
        $form->text('apprenant.telephone', __('Téléphone'));
        $form->email('apprenant.email', __('Email'));
        $form->radio('apprenant.sexe', __('Sexe'))->options(['F' => 'Feminin', 'M' => 'Masculin']);
        $form->radio('apprenant.nationalite', __('Nationalité'))->options(['Ivoirienne' => 'IVOIRIENNE', 'Etranger' => 'ETRANGER']);
        $leshandicaps = array();
        $handicaps = Handicap::all();
        foreach ($handicaps as $handicap) {
            $leshandicaps[$handicap->id] = $handicap->libelle_handicap;
        }
        $form->select('apprenant.handicaps_id', __('Handicap'))->options($leshandicaps);
        $lesclasses = array();
        $classes = DB::table('classes')
            ->where('etablissementannees_id', $EtabAnnee->id)
            ->select('id', 'denominationclasse')
            ->get();
        foreach ($classes as $classe) {
            $lesclasses[$classe->id] = $classe->denominationclasse;
        }
        $form->select('classes_id', __('Classes'))->options($lesclasses);
        $lesstatuts = array();
        $statuts = Statutapprenant::all();
        foreach ($statuts as $statut) {
            $lesstatuts[$statut->id] = $statut->libellestatutap;
        }
        $form->select('statutapprenants_id', __('Statut'))->options($lesstatuts);
        $lesbourses = array();
        $bourses = Bourse::all();
        foreach ($bourses as $bourse) {
            $lesbourses[$bourse->id] = $bourse->libellebourse;
        }
        $form->select('bourses_id', __('Bourse'))->options($lesbourses);
        $form->number('moyenne1er', __('La moyenne du 1er semestre'))->attribute('class', 'form-control no-spin');
		$form->number('moyenne2eme', __('La moyenne du 2eme semestre'))->attribute('class', 'form-control no-spin');
		$form->number('moyenneannee', __('La moyenne de fin d année'))->attribute('class', 'form-control no-spin');
		$form->textarea('observation', __('Observation'));
		$lesdecisions = array();
            $decisions = Decision::all();
            foreach ($decisions as $decision) {
                $lesdecisions[$decision->id] = $decision->libelledecision;
            }
        $form->select('decision_id', __("D F A"))->options($lesdecisions);
		$form->radio('candidat', __('Candidat aux examens'))->options(['Oui' => 'Oui', 'Non' => 'Non']);
        $form->radio('resultat', __('Résultat aux examens'))->options(['Admis' => 'Admis', 'Refusé' => 'Refusé', 'Absent' => 'Absent']);


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

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });
        /*
        $form->text('moyenneannee', __('Moyenneannee'));
        $form->radio('decisionfinannee', __('Decisionfinannee'))->options(['Admis' => 'Admis', 'Réfusé' => 'Réfusé']);
        $form->textarea('observation', __('Observation'))->default('Néant');*/
        $form->saved(function (Form $form) {
        $apprenantannee = $form->model();

        if ($apprenantannee->isDirty('moyenneannee')) {
            app(DecisionAutoObserver::class)->updated($apprenantannee);
        }
    });

        return $form;
    }
	
	public function remplissage2emesemestre(Request $request)
{
    $paramGlobaux = Parametresglobaux::findOrFail(1);

    $EtabAnnee = Etablissementannee::where('anneescolaires_id', $paramGlobaux->anneescolaires_id)
        ->where('etablissements_id', session('etablissementchoisi'))
        ->first();

    if (!$EtabAnnee) {
        return back()->withErrors(['message' => "Établissement ou année scolaire introuvable."]);
    }

    $apprenantsSansMoyenne = Apprenantannee::where('etablissementannees_id', $EtabAnnee->id)
        ->whereNotNull('classes_id')
        ->whereNull('moyenne2eme')
        ->exists();

    if ($apprenantsSansMoyenne) {
        return back()->withErrors(new MessageBag([
            'title' => 'Erreur',
            'message' => "Veuillez attribuer une moyenne à tous vos apprenants."
        ]));
    }

    $EtabAnnee->update([
        'niveau2semestre' => 1,
    ]);

    admin_toastr('Remplissage du rapport effectué avec succès', 'success');
    return redirect('/admin/etablissementannees');
}

}
