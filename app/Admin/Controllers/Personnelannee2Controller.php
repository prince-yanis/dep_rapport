<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Typepersonnel;
use App\Models\Diplomepersonnel;
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

class Personnelannee2Controller extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Personnels';

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


        if (in_array($current_role->role_id, array(2))) {
            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', $etablissement->id)
                ->first();

            session(['etablissementannees_id' => $EtabAnnee->id]);

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', $etablissement->id)
                ->first();
            $grid->model()->where('personnelannees.etablissementannees_id', '=', $EtabAnnee->id);
            $grid->disableColumnSelector();
            $grid->disableExport();
            $grid->disableFilter();
            $grid->disableRowSelector();
            $grid->disableActions();
            /* $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
				$actions->disableDelete();
            });*/
            $grid->quickSearch(function ($model, $search) {
                $model->whereHas('personnel', function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenoms', 'like', "%{$search}%");
                });
            });
            $grid->tools(function ($tools) {

                $tools->append('<a href="/admin/etabanneeclasse/' . session('etablissementannees_id') . '/edit" class="btn btn-sm btn-success" >Suivant</a>');
            });
            $grid->column('id', __('Id'));
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


            $grid->personnels_id('Personnel')->display(function ($id) {
                $query = Personnel::find($id);

                if ($query && $query->nom && $query->prenoms) {
                    return $query->nom . ' ' . $query->prenoms;
                }

                return 'non renseigné';
            })->sortable();
            $grid->disciplines_id('Discipline')->display(function ($id) {
                $query = Discipline::find($id);
                return $query->libellediscipline ?? 'Néant';
            })->sortable();
            // $grid->column('statutpersonnel_id', __('Statutpersonnel id'))->default('Néant');
            // $grid->statutpersonnel_id('Statut')->display(function ($id) {
            //     $query = Statutpersonnel::find($id);
            //     return $query->libellestatutpers ?? 'Néant';
            // });
            // $grid->column('fonctionpersonnels_id', __('Fonctionpersonnels id'))->default('Néant');
            $grid->fonctionpersonnels_id('Fonction')->display(function ($id) {
                $query = Fonctionpersonnel::find($id);
                return $query->libellefonction  ?? 'Néant';
            })->sortable();
            // $grid->column('niveauenseignant_id', __('Niveauenseignant id'))->default('Néant');
            $grid->niveauenseignant_id('Niveau')->display(function ($id) {
                $query = Niveauenseignant::find($id);
                return $query->libelleniveau ?? 'Néant';
            });
            $grid->column('quotahoraire', __('Quota horaire'));
            $grid->column('nbreheureeffectuee', __('Nbre heure éffectuées'));
            $grid->column('nbreheureresponsabilite', __('Nbre heures responsabilité'));
            $grid->column('Action')->display(function () {
                return '<a href="/admin/personnelannees2/' . $this->id . '/edit" class= "btn btn-sm btn-primary" >Modifier</a>';
            });
        } else {

            $anneescolaireActuelle = session('anneescolaireactuelle');

            $grid->model()
                ->join('etablissementannees', 'etablissementannees.id', '=', 'personnelannees.etablissementannees_id') // remplacez "table_principale" par le nom de votre table principale
                ->where('etablissementannees.anneescolaires_id', $anneescolaireActuelle);

            $grid->quickSearch(function ($model, $search) {
                $model->whereHas('personnel', function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenoms', 'like', "%{$search}%");
                });
            });
            $grid->tools(function ($tools) {

                $tools->append('<a href="/admin/etabanneeclasse/' . session('etablissementannees_id') . '/edit" class="btn btn-sm btn-success" >Suivant</a>');
            });
            $grid->column('id', __('Id'));
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


            $grid->personnels_id('Personnel')->display(function ($id) {
                $query = Personnel::find($id);

                if ($query && $query->nom && $query->prenoms) {
                    return $query->nom . ' ' . $query->prenoms;
                }

                return 'non renseigné';
            })->sortable();
            $grid->disciplines_id('Discipline')->display(function ($id) {
                $query = Discipline::find($id);
                return $query->libellediscipline ?? 'Néant';
            })->sortable();
            $grid->cons_ens('Membre du conseil d\'enseignement')->display(function ($cons_ens) {
                return $cons_ens ? 'Oui' : 'Non';
            });
            // $grid->column('statutpersonnel_id', __('Statutpersonnel id'))->default('Néant');
            // $grid->statutpersonnel_id('Statut')->display(function ($id) {
            //     $query = Statutpersonnel::find($id);
            //     return $query->libellestatutpers ?? 'Néant';
            // });
            // $grid->column('fonctionpersonnels_id', __('Fonctionpersonnels id'))->default('Néant');
            $grid->fonctionpersonnels_id('Fonction')->display(function ($id) {
                $query = Fonctionpersonnel::find($id);
                return $query->libellefonction  ?? 'Néant';
            })->sortable();
            // $grid->column('niveauenseignant_id', __('Niveauenseignant id'))->default('Néant');
            $grid->niveauenseignant_id('Niveau')->display(function ($id) {
                $query = Niveauenseignant::find($id);
                return $query->libelleniveau ?? 'Néant';
            });
            $grid->column('quotahoraire', __('Quota horaire'));
            $grid->column('nbreheureeffectuee', __('Nbre heure éffectuées'));
            $grid->column('nbreheureresponsabilite', __('Nbre heures responsabilité'));
            $grid->column('Action')->display(function () {
                return '<a href="/admin/personnelannees2/' . $this->id . '/edit" class= "btn btn-sm btn-primary" >Modifier</a>';
            });
        }



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
        $show->field('cons_ens', __('Membre du conseil d\'enseignement'));
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

        /*  $lespersonnels = array();
        $personnels = Personnel::all();
        foreach ($personnels as $personnel) {
            $lespersonnels[$personnel->id] = $personnel->nom . ' ' . $personnel->prenoms;
        }
        $form->select('personnels_id', __('Personnel'))->options($lespersonnels);*/
        ////////////////////////////////////////////////////////////////////////////
        $form->text('personnel.nom', __('Nom'));
        $form->text('personnel.prenoms', __('Prenoms'));
        $form->text('personnel.matricule', __('Matricule'));
        $lestypepersonnels = array();
        $typepersonnels = Typepersonnel::all();
        foreach ($typepersonnels as $typepersonnel) {
            $lestypepersonnels[$typepersonnel->id] = $typepersonnel->libelletypepersonnel;
        }
        $form->select('personnel.typepersonnels_id', __('Type personnel'))->options($lestypepersonnels);
        $lesdiplomes = array();
        $diplomes = Diplomepersonnel::all();
        foreach ($diplomes as $diplome) {
            $lesdiplomes[$diplome->id] = $diplome->libellediplome;
        }
        $form->select('personnel.diplomepersonnels_id', __('Diplome personnel'))->options($lesdiplomes);
        $form->date('personnel.datenaissance', __('Datenaissance'))->default(date('Y-m-d'));
        $form->text('personnel.lieunaissance', __('Lieunaissance'));
        //$form->text('personnel.sexe', __('Sexe'));
        $form->radio('personnel.sexe', __('Sexe'))->options(['Feminin' => 'Feminin', 'Masculin' => 'Masculin']);
        //$form->radio('apprenant.nationalite', __('Nationalité'))->options(['IVOIRIENNE' => 'IVOIRIENNE', 'ETRANGER' => 'ETRANGER']);		
        $form->text('personnel.telephone', __('Telephone'))->required();
        $form->email('personnel.email', __('Email'));
        $form->date('personnel.date_fonction_public', __('Date 1ère prise de service Fonction publique'));
        $form->date('date_fonction_etab', __('Date 1ère prise de service Fonction établissement'));

        //////////////////////////////////////////////////////////////////////////////////
        $lesdisciplines = array();
        $disciplines = Discipline::all();
        foreach ($disciplines as $discipline) {
            $lesdisciplines[$discipline->id] = $discipline->libellediscipline;
        }
        $form->select('disciplines_id', __('Disciplines'))->options($lesdisciplines);
        $form->switch('cons_ens', __('Membre du conseil d\'enseignement'))->options(['on' => 'Oui', 'off' => 'Non']);
        

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
        $form->select('niveauenseignant_id', __('Emploi'))->options($lesniveaux);
        $form->text('quotahoraire', __('Quotahoraire'));
        $form->text('nbreheureeffectuee', __('Nbreheureeffectuee'));
        $form->text('nbreheureresponsabilite', __('Nbreheureresponsabilite'));

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


        $form->saving(function (Form $form) {
            if ($form->personnel) {
                // Vérifier si le personnel existe déjà
                //$personnel = Personnel::where('email', $form->personnel['email'])->first();
                $personnel = Personnel::where('matricule', $form->personnel['matricule'])->first();


                if (!$personnel) {
                    $personnel = new Personnel();

                    // Utilisation d'un raccourci pour vérifier si une clé existe et n'est pas vide, sinon mettre à null.
                    $personnel->nom = !empty($form->personnel['nom']) ? $form->personnel['nom'] : null;
                    $personnel->prenoms = !empty($form->personnel['prenoms']) ? $form->personnel['prenoms'] : null;
                    $personnel->matricule = !empty($form->personnel['matricule']) ? $form->personnel['matricule'] : null;
                    $personnel->typepersonnels_id = !empty($form->personnel['typepersonnels_id']) ? $form->personnel['typepersonnels_id'] : null;
                    $personnel->diplomepersonnels_id = !empty($form->personnel['diplomepersonnels_id']) ? $form->personnel['diplomepersonnels_id'] : null;
                    $personnel->date_fonction_public = !empty($form->personnel['date_fonction_public']) ? $form->personnel['date_fonction_public'] : null;
                    $personnel->datenaissance = !empty($form->personnel['datenaissance']) ? $form->personnel['datenaissance'] : null;
                    $personnel->lieunaissance = !empty($form->personnel['lieunaissance']) ? $form->personnel['lieunaissance'] : null;
                    $personnel->sexe = !empty($form->personnel['sexe']) ? $form->personnel['sexe'] : null;
                    $personnel->telephone = !empty($form->personnel['telephone']) ? $form->personnel['telephone'] : null;
                    $personnel->email = !empty($form->personnel['email']) ? $form->personnel['email'] : null;

                    // Sauvegarde des données
                    $personnel->save();
                }

                // Associer le personnel  nouvellement créé ou existant au personnelannee
                $form->model()->personnels_id = $personnel->id;
            }
        });
        return $form;
    }
}
