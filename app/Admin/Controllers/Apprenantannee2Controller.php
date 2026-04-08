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
use App\Models\Etablissementannee;
use App\Models\Handicap;
use App\Models\Statutapprenant;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class Apprenantannee2Controller extends AdminController
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
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();
        $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

        if (in_array($current_role->role_id, [2])) {
            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', $etablissement->id)
                ->first();
            /* $grid->filter(function ($filter) use ($EtabAnnee) {
                 // Remove the default id filter
                 $filter->disableIdFilter();
                 // $filter->expand();
                 $lesclasses = array();
                 $classes = DB::table('classes')
                     ->where('etablissementannees_id', $EtabAnnee->id)
                     ->select('id', 'denominationclasse')
                     ->get();
                 foreach ($classes as $classe) {
                     $lesclasses[$classe->id] = $classe->denominationclasse;
                 }
                 $filter->in('classes_id', "Filtrer par classe")->multipleSelect($lesclasses);
             });*/

            $grid->model()
                ->join('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
                ->select('apprenants.*', 'apprenantannees.*')
                ->orderBy('apprenants.nom', 'ASC')
                ->where('apprenantannees.etablissementannees_id', '=', $EtabAnnee->id);

            // $grid->model()
            //     ->with('apprenant')                              // Charge la relation apprenant
            //     ->orderBy(Apprenant::select('nom')               // Utilise une sous-requête pour trier
            //         ->whereColumn('apprenants.id', '=', 'apprenantannees.apprenants_id'));

            $grid->disableExport();
            $grid->disableColumnSelector();
            // $grid->disableFilter();
            $grid->disableActions();
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
                $tools->append('<a href="/admin/remplissagerentree" class="btn btn-sm btn-success" 
                onclick="return confirm(\'Avez-vous verifier les classes de rentrée des apprenants ?\')">J\'ai terminé mon rapport</a>');
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
            });
            // $grid->column('classes_id', __('Classes id'));
            $grid->column('classes_id', __("Classes"))
                ->editable('select', function ($row) {
                    $etablissementannees_id = $row->etablissementannees_id; // Capture the current row's etablissementannees_id
                    $classesvalues = [];

                    if ($etablissementannees_id) {
                        $classes = DB::table('classes')
                            ->where('etablissementannees_id', $etablissementannees_id)
                            ->select('id', 'denominationclasse')
                            ->get();
                    } else {
                        // Fetch all classes if no etablissementannees_id is found
                        $classes = DB::table('classes')
                            ->select('id', 'denominationclasse')
                            ->get();
                    }

                    foreach ($classes as $val) {
                        $classesvalues[$val->id] = $val->denominationclasse;
                    }

                    return $classesvalues;
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
            $grid->column('Action')->display(function () {
                return '<a href="/admin/apprenantannees2/' . $this->id . '/edit" class= "btn btn-sm btn-primary" >Modifier</a>';
            });
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
                // $tools->append('<a href="/admin/remplissagerentree" class="btn btn-sm btn-success">J ai terminé mon rapport</a>');
                $tools->append('<a href="/admin/remplissagerentree" class="btn btn-sm btn-success" 
                onclick="return confirm(\'Avez-vous verifier les classes de rentrée des apprenants ?\')">J\'ai terminé mon rapport</a>');
                // $tools->confirm('Êtes vous sure de valider votre remplissage ?');
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
            $grid->column('classes_id', __("Classes"))->editable('select', function ($row) {
                $etablissementannees_id = $row->etablissementannees_id; // Capture the current row's etablissementannees_id
                $classesvalues = [];

                if ($etablissementannees_id) {
                    $classes = DB::table('classes')
                        ->where('etablissementannees_id', $etablissementannees_id)
                        ->select('id', 'denominationclasse')
                        ->get();
                } else {
                    // Fetch all classes if no etablissementannees_id is found
                    $classes = DB::table('classes')
                        ->select('id', 'denominationclasse')
                        ->get();
                }

                foreach ($classes as $val) {
                    $classesvalues[$val->id] = $val->denominationclasse;
                }

                return $classesvalues;
            });
            $grid->bourses_id("Bourses")->display(function ($id) {
                $query = Bourse::find($id);
                return $query ? $query->libellebourse : 'Non renseigné';
            });
            $grid->column('Action')->display(function () {
                return '<a href="/admin/apprenantannees2/' . $this->id . '/edit" class= "btn btn-sm btn-primary" >Modifier</a>';
            });
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
        $form->date('apprenant.datenaissance', __('Date de naissance'));
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
        $form->saving(function (Form $form) {
            if (isset($form->apprenant) && is_array($form->apprenant)) {
                $matricule = $form->apprenant['matriculeap'] ?? null;

                if ($matricule) {
                    $apprenant = Apprenant::where('matriculeap', $matricule)->first();

                    if (!$apprenant) {
                        // Créer un nouvel apprenant si aucun n'existe
                        $apprenant = new Apprenant();
                        $apprenant->nom = $form->apprenant['nom'] ?? '';
                        $apprenant->prenoms = $form->apprenant['prenoms'] ?? '';
                        $apprenant->matriculeap = $matricule;
                        $apprenant->datenaissance = $form->apprenant['datenaissance'] ?? null;
                        $apprenant->lieunaissance = $form->apprenant['lieunaissance'] ?? '';
                        $apprenant->sexe = $form->apprenant['sexe'] ?? 'M';
                        $apprenant->telephone = $form->apprenant['telephone'] ?? '';
                        $apprenant->email = $form->apprenant['email'] ?? '';
                        $apprenant->nationalite = $form->apprenant['nationalite'] ?? 'Ivoirienne';
                        $apprenant->nationalite = $form->apprenant['handicaps_id'] ?? null;
                        $apprenant->save();
                    }

                    // Associez l'apprenant existant ou nouvellement créé
                    $form->model()->apprenants_id = $apprenant->id;
                }
            }
        });

        return $form;
    }
}
