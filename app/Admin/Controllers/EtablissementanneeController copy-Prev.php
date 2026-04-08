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
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Statutpersonnel;
use App\Models\Niveauenseignant;
use App\Models\Fonctionpersonnel;
use App\Models\Etablissementannee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Designationinfrastructure;
use Encore\Admin\Controllers\AdminController;

class EtablissementanneeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Etablissementannee';

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
        $grid->column('existecloture', __('Existecloture'));
        $grid->column('problemeequipement', __('Problemeequipement'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('anneescolaires_id', __('Anneescolaires id'));
        $grid->column('etablissements_id', __('Etablissements id'));
        // $grid->column('associations_id', __('Associations id'));

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
        $show->field('existecloture', __('Existecloture'));
        $show->field('problemeequipement', __('Problemeequipement'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('anneescolaires_id', __('Anneescolaires id'));
        $show->field('etablissements_id', __('Etablissements id'));
        // $show->field('associations_id', __('Associations id'));

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

        $form->text('existecloture', __('Existecloture'));
        $form->text('problemeequipement', __('Problemeequipement'));
        // $form->number('anneescolaires_id', __('Anneescolaires id'));
        $lesannees = array();
        $annees = Anneescolaire::all();
        foreach ($annees as $annee) {
            $lesannees[$annee->id] = $annee->libelleanneescolaire;
        }
        $form->select('anneescolaires_id', __('Anneescolaires'))->options($lesannees);
        // $form->number('etablissements_id', __('Etablissements id'));
        $lesetablissements = array();
        $etablissements = Etablissement::all();
        foreach ($etablissements as $etablissement) {
            $lesetablissements[$etablissement->id] = $etablissement->denominationetab;
        }
        $form->select('etablissements_id', __('Etablissements'))->options($lesetablissements);

        // Personnel Année
        $form->hasMany('personnelannees', __('I. Personnel Année'), function (Form\NestedForm $form) {
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
        });

        //Besoin personnel adm
        $form->hasMany('besoinpersonneladm', __('II. Besoin Personnel Administratif'), function (Form\NestedForm $form) {
            $lesfonctions = array();
            $fonctions = Fonctionpersonnel::all();
            foreach ($fonctions as $fonction) {
                $lesfonctions[$fonction->id] = $fonction->libellefonction;
            }
            $form->select('fonctionpersonnels_id', __('Fonction personnel'))->options($lesfonctions);
            $form->text('nombre', __('Nombre'));
        });

        //Besoin personnel Ens
        $form->hasMany('besoinpersonnelens', __('III. Besoin Personnel Enseignant'), function (Form\NestedForm $form) {
            $lesdisciplines = array();
            $disciplines = Discipline::all();
            foreach ($disciplines as $discipline) {
                $lesdisciplines[$discipline->id] = $discipline->libellediscipline;
            }
            $form->select('disciplines_id', __('Disciplines'))->options($lesdisciplines);
            $lesniveaux = array();
            $niveaux = Niveauenseignant::all();
            foreach ($niveaux as $niveau) {
                $lesniveaux[$niveau->id] = $niveau->libelleniveau;
            }
            $form->select('niveauenseignant_id', __('Niveau enseignant'))->options($lesniveaux);
        });

        //Infrastructure
        $form->hasMany('infrastructures', __('IV. Infrastructure'), function (Form\NestedForm $form) {
            // $form->number('designationinfrastructures_id', __('Designationinfrastructures id'));
            $lesinfrastructures = array();
            $infrastructures = Designationinfrastructure::all();
            foreach ($infrastructures as $infrastructure) {
                $lesinfrastructures[$infrastructure->id] = $infrastructure->libelleinfrastructure;
            }
            $form->select('designationinfrastructures_id', __('Designation infrastructure'))->options($lesinfrastructures);
            $form->text('nombre', __('Nombre'));
            $form->text('nombrebureaux', __('Nombrebureaux'));
            $form->text('capacite', __('Capacite'));
            $form->textarea('observation', __('Observation'));
        });

        //Besoin infrastructure
        $form->hasMany('besoininfrastructures', __('V. Infrastructure'), function (Form\NestedForm $form) {
            $lesdesignations = array();
            $designations = Designationinfrastructure::all();
            foreach ($designations as $designation) {
                $lesdesignations[$designation->id] = $designation->libelleinfrastructure;
            }
            $form->select('designationinfrastructures_id', __('Designation infrastructures'))->options($lesdesignations);

            $form->text('quantite', __('Quantite'));
        });

        // Classe
        $form->hasMany('classes', __('VI. Classe'), function (Form\NestedForm $form) {
            $form->text('denominationclasse', __('Denominationclasse'));
            $form->text('effectif', __('Effectif'));
            $lesgroupes = array();
            $groupes = DB::table('groupepedagogiques')
                ->leftJoin('filieres', 'groupepedagogiques.filieres_id', '=', 'filieres.id')
                ->leftJoin('serie', 'groupepedagogiques.serie_id', '=', 'serie.id')
                ->select('groupepedagogiques.*', 'filieres.libellefiliere', 'serie.libelleserie')
                ->get();
            foreach ($groupes as $groupe) {
                $lesgroupes[$groupe->id] = $groupe->libellegp . ' - ' . $groupe->libellefiliere . ' - ' . $groupe->libelleserie;
            }
            $form->select('groupepedagogiques_id', __('Groupepedagogiques'))->options($lesgroupes);
        });

        // Activité Sportive
        $form->hasMany('activitesportive', __('VII. Activité Sportive'), function (Form\NestedForm $form) {
        $lessports = array();
        $sports = Sport::all();
        foreach ($sports as $sport) {
            $lessports[$sport->id] = $sport->libellesport;
        }
        $form->select('sport_id', __('Sport'))->options($lessports);
        });
        //Association - Club
        $form->hasMany('association', __('VIII. Association / Club'), function (Form\NestedForm $form) {
            $form->text('designation', __('Designation'));
            $form->text('objet', __('Objet'));
            $form->text('nomresponsable', __('Nomresponsable'));
        });

        // Besoin
        $form->hasMany('besoins', __('IX. Besoin'), function (Form\NestedForm $form) {
            $form->text('quantite', __('Quantite'));
            $lesmateriels = array();
            $materiels = Materiel::all();
            foreach ($materiels as $materiel) {
                $lesmateriels[$materiel->id] = $materiel->libellemateriel;
            }
            $form->select('materiels_id', __('Materiels'))->options($lesmateriels);
        });

        // Planning
        $form->hasMany('plannings', __('X. Planning'), function (Form\NestedForm $form) {
            $lesjours = array();
            $jours = Jour::all();
            foreach ($jours as $jour) {
                $lesjours[$jour->id] = $jour->libellejours;
            }
            $form->select('jours_id', __('Jours'))->options($lesjours);
            // $form->number('heures_id', __('Heures id'));
            $lesheures = array();
            $heures = Heure::all();
            foreach ($heures as $heure) {
                $lesheures[$heure->id] = $heure->libelleheures;
            }
            $form->radio('heures_id', __('Heures'))->options($lesheures);
            // $form->number('personnels_id', __('Personnels id'));
            $lespersonnels = array();
            $personnels = Personnel::all()->where('typepersonnels_id', '=', '1');
            foreach ($personnels as $personnel) {
                $lespersonnels[$personnel->id] = $personnel->nom . ' ' . $personnel->prenoms;
            }
            $form->select('personnels_id', __('Personnel'))->options($lespersonnels);
            // $form->number('classes_id', __('Classes id'));
            $lesclasses = array();
            $classes = Classe::all();
            foreach ($classes as $classe) {
                $lesclasses[$classe->id] = $classe->denominationclasse;
            }
            $form->select('classes_id', __('Classes'))->options($lesclasses);
        });

        return $form;
    }
}
