<?php

namespace App\Admin\Controllers;

use App\Models\Bourse;
use App\Models\Classe;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Decision;
use App\Models\Apprenant;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Apprenantannee;
use App\Models\Statutapprenant;
use App\Models\Parametresglobaux;
use App\Models\Etablissementannee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class ApprenantanneeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Listes des Apprenants / Année';

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
            // $grid->model()
            //     ->leftJoin('etablissementannees', 'etablissementannees.id', '=', 'apprenantannees.etablissementannees_id')
            //     ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            //     ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            //     ->where('etablissementannees.etablissements_id', '=', $etablissement->id);
            // $grid->model()
            //     ->leftJoin('etablissementannees', 'etablissementannees.id', '=', 'apprenantannees.etablissementannees_id')
            //     ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            //     ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            //     ->where('etablissements.id', '=', $etablissement->id)
            //     ->where('anneescolaires.id', '=', $anneescolaires_id);
            // $grid->model()->where('apprenantannees.etablissementannees_id', '=', $etablissement->id);

            // Filter the grid model based on etablissementannees_id
            $grid->model()->where('etablissementannees_id', function ($query) use ($etablissement, $anneescolaires_id) {
                $query->select('id')
                    ->from('etablissementannees')
                    ->where('etablissements_id', $etablissement->id)
                    ->where('anneescolaires_id', $anneescolaires_id);
            });


            $grid->disableExport();
            $grid->disableCreateButton();

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
                $actions->disableDelete();
            });

            $grid->quickSearch(function ($model, $search) {
                $model->whereHas('apprenants', function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenoms', 'like', "%{$search}%");
                });
            });
            $grid->column('id', __('Id'));
            // $grid->column('etablissementannees_id', __('Etablissementannees id'));
            $grid->etablissementannees_id("Anneé scolaire - Etablissement")->display(function ($etablissementannees_id) {
                $query = DB::table('etablissementannees')
                    // $query = Etablissementannee::find($id)
                    ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                    ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                    ->where('etablissementannees.id', '=', $etablissementannees_id)
                    ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
                    ->first();
                // return $query->libellestatutpers;
                return $query->libelleanneescolaire . ' - ' . $query->denominationetab;
            });
            // $grid->column('apprenants_id', __('Apprenants id'));
            $grid->apprenants_id("Nom & Prénoms")->display(function ($id) {
                $query = Apprenant::find($id);
                return '<b>' . $query->nom . '</b>' . ' ' . $query->prenoms;
            });
            // $grid->column('classes_id', __('Classes id'));
            $grid->classes_id("Classes")->display(function ($id) {
                $query = Classe::find($id);
                return $query->denominationclasse;
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
            // $grid->column('moyenne2eme', __('Moyenne du 2eme semestre'));
            // $grid->column('moyenneannee', __('Moyenne annuelle'));
            // $grid->column('bourses_id', __('Bourses id'));
            // $grid->column('observation', __('Observation'));
            // $grid->column('decision_id', __('Decision id'));
            // $grid->decision_id("Décision de fin d'année")->display(function ($id) {
            //     $query = Decision::find($id);
            //     return $query ? $query->libelledecision : 'Non renseigné';
            // });
        } else {

            $grid->quickSearch(function ($model, $search) {
                $model->whereHas('apprenants', function ($query) use ($search) {
                    $query->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenoms', 'like', "%{$search}%");
                });
            });
            $grid->filter(function ($filter) {

                // Remove the default id filter
                $filter->disableIdFilter();

                $etablissementanneesOptions = array();
                $etablissementannees = DB::table('etablissementannees')
                    ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                    ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                    ->select('etablissementannees.id', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
                    ->get();

                foreach ($etablissementannees as $etablissementannee) {
                    $etablissementanneesOptions[$etablissementannee->id] = $etablissementannee->libelleanneescolaire . ' - ' . $etablissementannee->denominationetab;
                }

                $filter->in('etablissementannees_id', "Année scolaire - Etablissement")->select($etablissementanneesOptions);
            });

            $grid->column('id', __('Id'));
            // $grid->column('etablissementannees_id', __('Etablissementannees id'));
            $grid->etablissementannees_id("Anneé scolaire - Etablissement")->display(function ($etablissementannees_id) {
                $query = DB::table('etablissementannees')
                    // $query = Etablissementannee::find($id)
                    ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                    ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                    ->where('etablissementannees.id', '=', $etablissementannees_id)
                    ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
                    ->first();
                // return $query->libellestatutpers;
                return $query->libelleanneescolaire . ' - ' . $query->denominationetab;
            });
            // $grid->column('apprenants_id', __('Apprenants id'));
            $grid->apprenants_id("Nom & Prénoms")->display(function ($id) {
                $query = Apprenant::find($id);
                return '<b>' . $query->nom . '</b>' . ' ' . $query->prenoms;
            });
            // $grid->column('classes_id', __('Classes id'));
            // $grid->classes_id("Classes")->display(function ($id) {
            //     $query = Classe::find($id);
            //     return $query->denominationclasse;
            // });
            /* 
            $classesvalues = array();
            $classes = Classe::all();
            foreach ($classes as $val) {
                $classesvalues[$val->id] = $val->denominationclasse;
            }
           $grid->column('classes_id', __("Classes"))->editable('select', $classesvalues);
            // $grid->column('statutapprenants_id', __('Statutapprenants id'));
            $grid->statutapprenants_id("Statuts")->display(function ($id) {
                $query = Statutapprenant::find($id);
                return $query ? $query->libellestatutap : 'Non renseigné';
            });
            */
            // Update the Classes column with dynamic filtering based on etablissementannees_id
            // $grid->column('classes_id', __("Classes"))->editable('select')->display(function ($classes_id) {
            //     $etablissementannees_id = $this->etablissementannees_id; // Capture the current row's etablissementannees_id
            //     $classesvalues = ;

            //     if ($etablissementannees_id) {
            //         $classes = DB::table('classes')
            //             ->join('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            //             ->where('etablissementannees.id', '=', $etablissementannees_id)
            //             ->select('classes.id', 'classes.denominationclasse')
            //             ->get();

            //         foreach ($classes as $val) {
            //             $classesvalues[$val->id] = $val->denominationclasse;
            //         }
            //     } else {
            //         // Fetch all classes if no etablissementannees_id is found
            //         $classes = Classe::all();
            //         foreach ($classes as $val) {
            //             $classesvalues[$val->id] = $val->denominationclasse;
            //         }
            //     }
            //     return $classesvalues;
            //     // return isset($classesvalues[$classes_id]) ? $classesvalues[$classes_id] : '';
            // });

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
            

            $grid->bourses_id("Bourses")->display(function ($id) {
                $query = Bourse::find($id);
                return $query ? $query->libellebourse : 'Non renseigné';
            });
            // $grid->column('moyenne1er', __('Moyenne du 1er semestre'));
            // $grid->column('moyenne2eme', __('Moyenne du 2eme semestre'));
            // $grid->column('moyenneannee', __('Moyenne annuelle'));
            // $grid->column('bourses_id', __('Bourses id'));
            // $grid->column('observation', __('Observation'));
            // $grid->column('decision_id', __('Decision id'));
            // $grid->decision_id("Décision de fin d'année")->display(function ($id) {
            //     $query = Decision::find($id);
            //     return $query ? $query->libelledecision : 'Non renseigné';
            // });
            // $grid->column('created_at', __('Created at'));
            // $grid->column('updated_at', __('Updated at'));
            // $grid->column('groupepedagogiques_id', __('Groupepedagogiques id'));
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
        $show->field('moyenne1er', __('Moyenne1er'));
        $show->field('moyenne2eme', __('Moyenne2eme'));
        $show->field('moyenneannee', __('Moyenneannee'));
        $show->field('observation', __('Observation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('classes_id', __('Classes id'));
        $show->field('apprenants_id', __('Apprenants id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('statutapprenants_id', __('Statutapprenants id'));
        $show->field('bourses_id', __('Bourses id'));
        $show->field('groupepedagogiques_id', __('Groupepedagogiques id'));
        $show->field('decision_id', __('Decision id'));

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

        $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $current_school = Etablissement::where('id', $current_user->idEtab)->first();

        if (in_array($current_role->role_id, [2])) {
            // $form->number('apprenants_id', __('Apprenants id'));
            $lesapprenants = array();
            $apprenants = Apprenantannee::select('apprenants.*')->join('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')->where('etablissementannees_id', $EtabAnnee->id)->get();
            foreach ($apprenants as $apprenant) {
                $lesapprenants[$apprenant->id] = $apprenant->matriculeap . ' | ' . $apprenant->nom . ' ' . $apprenant->prenoms;
            }
            $form->select('apprenants_id', __('Apprenants'))->options($lesapprenants);

            //     $form->html(' <a href="/admin/apprenantetab/create">Ajouter un Nouvel Apprenant</a>
            // ');

            // $form->number('classes_id', __('Classes id'));
            $lesclasses = array();
            $classes = Classe::where('etablissementannees_id', $EtabAnnee->id)->get();
            foreach ($classes as $classe) {
                $lesclasses[$classe->id] = $classe->denominationclasse;
            }
            $form->select('classes_id', __('Classes'))->options($lesclasses);

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

            /* $form->text('moyenne1er', __('Moyenne1er'));
$form->text('moyenne2eme', __('Moyenne2eme'));
$form->text('moyenneannee', __('Moyenneannee'));
$form->textarea('observation', __('Observation'));
$form->number('classes_id', __('Classes id'));
$form->number('apprenants_id', __('Apprenants id'));
$form->number('etablissementannees_id', __('Etablissementannees id'));
$form->number('statutapprenants_id', __('Statutapprenants id'));
$form->number('bourses_id', __('Bourses id'));
$form->number('groupepedagogiques_id', __('Groupepedagogiques id'));
$form->number('decision_id', __('Decision id'));
*/
        } else {

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

            $current_user = Auth::guard('admin')->user();
            $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
            $current_school = Etablissement::where('id', $current_user->idEtab)->first();

            // $form->number('etablissementannees_id', __('Etablissementannees id'));
            $lesetabannees = array();
            $etabannees = DB::table('etablissementannees')
                ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
                ->get();
            foreach ($etabannees as $etabannee) {
                $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
            }
            $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees);
            // $form->number('apprenants_id', __('Apprenants id'));
            $lesapprenants = array();
            $apprenants = Apprenant::all();
            foreach ($apprenants as $apprenant) {
                $lesapprenants[$apprenant->id] = $apprenant->nom . ' ' . $apprenant->prenoms;
            }
            $form->text('apprenants_id', __('Apprenants'))->options($lesapprenants);
            // $form->display('apprenants_id', __('Nom & Prénoms'))->default(function ($form) {
            //     $apprenant = Apprenant::find($form->model()->apprenants_id);
            //     return $apprenant ? $apprenant->nom . $apprenant->prenoms : '';
            // });
            // $form->number('classes_id', __('Classes id'));
            $lesclasses = array();
            $classes = Classe::all();
            foreach ($classes as $classe) {
                $lesclasses[$classe->id] = $classe->denominationclasse;
            }
            $form->select('classes_id', __('Classes'))->options($lesclasses);
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

            // $form->text('candidat', __('Candidat'));
            // $form->text('resultat', __('Resultat'));
            // $form->decimal('moyenne1er', __('Moyenne1er'));
            // $form->decimal('moyenne2eme', __('Moyenne2eme'));
            // $form->decimal('moyenneannee', __('Moyenneannee'));
            // $form->textarea('observation', __('Observation'));
            // $form->number('decision_id', __('Decision id'));

        }



        return $form;
    }
}
