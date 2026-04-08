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
use App\Models\Activitesportive;
use App\Models\Niveauenseignant;
use App\Models\Periodesannuelle;
use App\Models\Fonctionpersonnel;
use App\Models\Etablissementannee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Designationinfrastructure;
use App\Exports\TcdSuiviRemplissageExport;
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

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();

        $role_id = $current_role->role_id;
        switch ($role_id) {
            case 2:
                $grid->model()->where('etablissements_id', '=', $etablissement->id)->where('anneescolaires_id', session('anneescolaireactuelle'));
                $grid->anneescolaires_id("Année scolaire")->display(function ($id) {
                    $query = Anneescolaire::find($id);
                    return $query ? $query->libelleanneescolaire : 'Pas défini';
                });
                // $grid->column('etablissements_id', __('Etablissements id'));
                $grid->etablissements_id("Etablissement")->display(function ($id) {
                    $query = Etablissement::find($id);
                    return $query ? '<strong>' . $query->denominationetab . '</strong>' . ' - Code: ' .  $query->code : 'Pas défini';
                });
                // $grid->column('existecloture', __('Existecloture'));
                // $grid->column('problemeequipement', __('Problemeequipement'));
                // $grid->column('niveaurentree', __('Rapport de rentrée renseigné'));
                $grid->column('niveaurentree', __('Rapport de rentrée renseigné'))->bool(['1' => true, '0' => false]);
                // $grid->column('niveau1semestre', __('Rapport de 1er semestre renseigné'))->bool(['1' => true, '0' => false]);
                $grid->column('niveau1semestre', __('Rapport de 1er semestre renseigné'))->bool(['1' => true, '0' => false]);
                $grid->column('niveau2semestre', __('Rapport de 2eme semestre renseigné'))->bool(['1' => true, '0' => false]);
                $grid->disableActions();
                $grid->disableCreateButton();
                $grid->disableExport();
                $grid->disableFilter();
                $grid->disableRowSelector();
                $grid->disableColumnSelector();
                // $grid->column('created_at', __('Created at'));
                // $grid->column('updated_at', __('Updated at'));
                // $grid->column('associations_id', __('Associations id'));
                break;
            case 5:
                $grid->model()->join('etablissements', 'etablissements.id', '=', 'etablissements_id')
                    ->join('anneescolaires', 'anneescolaires.id', '=', 'anneescolaires_id')
                    ->where('directiondepartementales_id', '=', Auth::guard('admin')->user()->idDr)
                    ->where('anneescolaires_id', session('anneescolaireactuelle'))
                    ->where('fonctionnel', 1);

                $grid->quickSearch(function ($model, $search) {
                    $model->whereHas('etablissement', function ($query) use ($search) {
                        $query->where('code', 'like', "%{$search}%")
                            ->orWhere('denominationetab', 'like', "%{$search}%");
                    });
                });

                $grid->anneescolaires_id("Année scolaire")->display(function ($anneescolaires_id) {
                    $query = Anneescolaire::find($anneescolaires_id);
                    return $query ? $query->libelleanneescolaire : 'Pas défini';
                });
                // $grid->column('etablissements_id', __('Etablissements id'));
                $grid->etablissements_id("Etablissement")->display(function ($id) {
                    $query = Etablissement::find($id);
                    return $query ? '<strong>' . $query->denominationetab . '</strong>' . ' - Code: ' .  $query->code : 'Pas défini';
                });
                // $grid->column('existecloture', __('Existecloture'));
                // $grid->column('problemeequipement', __('Problemeequipement'));
                // $grid->column('niveaurentree', __('Rapport de rentrée renseigné'));
                $grid->column('niveaurentree', __('Rapport de rentrée renseigné'))->bool(['1' => true, '0' => false]);
                // $grid->column('niveau1semestre', __('Rapport de 1er semestre renseigné'))->bool(['1' => true, '0' => false]);
                $grid->column('niveau1semestre', __('Rapport de 1er semestre renseigné'))->bool(['1' => true, '0' => false]);
                $grid->column('niveau2semestre', __('Rapport de 2eme semestre renseigné'))->bool(['1' => true, '0' => false]);
                // $grid->column('created_at', __('Created at'));
                // $grid->column('updated_at', __('Updated at'));
                // $grid->column('associations_id', __('Associations id'));
                $grid->disableActions();
                $grid->disableCreateButton();
                $grid->disableExport();
                $grid->disableFilter();
                $grid->disableRowSelector();
                $grid->disableColumnSelector();
                break;
                case 4:
                    $grid->model()->join('etablissements', 'etablissements.id', '=', 'etablissements_id')
                        ->join('anneescolaires', 'anneescolaires.id', '=', 'anneescolaires_id')
                        ->where('directiondepartementales_id', '=', Auth::guard('admin')->user()->idDr)
                        ->where('anneescolaires_id', session('anneescolaireactuelle'));
    
                    $grid->quickSearch(function ($model, $search) {
                        $model->whereHas('etablissement', function ($query) use ($search) {
                            $query->where('code', 'like', "%{$search}%")
                                ->orWhere('denominationetab', 'like', "%{$search}%");
                        });
                    });
    
                    $grid->anneescolaires_id("Année scolaire")->display(function ($anneescolaires_id) {
                        $query = Anneescolaire::find($anneescolaires_id);
                        return $query ? $query->libelleanneescolaire : 'Pas défini';
                    });
                    // $grid->column('etablissements_id', __('Etablissements id'));
                    $grid->etablissements_id("Etablissement")->display(function ($id) {
                        $query = Etablissement::find($id);
                        return $query ? '<strong>' . $query->denominationetab . '</strong>' . ' - Code: ' .  $query->code : 'Pas défini';
                    });
                    // $grid->column('existecloture', __('Existecloture'));
                    // $grid->column('problemeequipement', __('Problemeequipement'));
                    // $grid->column('niveaurentree', __('Rapport de rentrée renseigné'));
                    $grid->column('niveaurentree', __('Rapport de rentrée renseigné'))->bool(['1' => true, '0' => false]);
                    // $grid->column('niveau1semestre', __('Rapport de 1er semestre renseigné'))->bool(['1' => true, '0' => false]);
                    $grid->column('niveau1semestre', __('Rapport de 1er semestre renseigné'))->bool(['1' => true, '0' => false]);
                    $grid->column('niveau2semestre', __('Rapport de 2eme semestre renseigné'))->bool(['1' => true, '0' => false]);
                    // $grid->column('created_at', __('Created at'));
                    // $grid->column('updated_at', __('Updated at'));
                    // $grid->column('associations_id', __('Associations id'));
                    $grid->disableActions();
                    $grid->disableCreateButton();
                    $grid->disableExport();
                    $grid->disableFilter();
                    $grid->disableRowSelector();
                    $grid->disableColumnSelector();
                    break;
            default:
                $grid->model()->where('anneescolaires_id', session('anneescolaireactuelle'));
                $grid->tools(function ($tools) {
                    $tools->append("<a href='suiviremplissage/export' class='btn btn-danger' target='_blank'>Exporter vers Excel</a>");
                });
                $grid->quickSearch(function ($model, $search) {
                    $model->whereHas('etablissement', function ($query) use ($search) {
                        $query->where('code', 'like', "%{$search}%")
                            ->orWhere('denominationetab', 'like', "%{$search}%");
                    });
                });
                $grid->column('id', __('id'));
                // $grid->column('anneescolaires_id', __('Anneescolaires id'));
                $grid->anneescolaires_id("Année scolaire")->display(function ($id) {
                    $query = Anneescolaire::find($id);
                    return $query ? $query->libelleanneescolaire : 'Pas défini';
                });
                // $grid->column('etablissements_id', __('Etablissements id'));
                $grid->etablissements_id("Etablissement")->display(function ($id) {
                    $query = Etablissement::find($id);
                    return $query ? '<strong>' . $query->denominationetab . '</strong>' . ' - Code: ' .  $query->code : 'Pas défini';
                });

                // $grid->column('existecloture', __('Existecloture'));
                // $grid->column('problemeequipement', __('Problemeequipement'));
                // $grid->column('niveaurentree', __('Rapport de rentrée renseigné'));
                $grid->column('niveaurentree', __('Rapport de rentrée renseigné'))->bool(['1' => true, '0' => false]);
                // $grid->column('niveau1semestre', __('Rapport de 1er semestre renseigné'))->bool(['1' => true, '0' => false]);
                $grid->column('niveau1semestre', __('Rapport de 1er semestre renseigné'))->bool(['1' => true, '0' => false]);
                $grid->column('niveau2semestre', __('Rapport de 2eme semestre renseigné'))->bool(['1' => true, '0' => false]);
                // $grid->column('created_at', __('Created at'));
                // $grid->column('updated_at', __('Updated at'));
                // $grid->column('associations_id', __('Associations id'));
                break;
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
        $show = new Show(etablissementannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('existecloture', __('Existecloture'));
        $show->field('problemeequipement', __('Problemeequipement'));
        $show->field('niveaurentree', __('Niveau'));
        $show->field('niveau1semestre', __('Niveau'));
        $show->field('niveau2semestre', __('Niveau'));
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

        $form->tab('Information de base', function ($form) {

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
            // $lesperiodes = array();
            // $periodes = Periodesannuelle::all();
            // foreach ($periodes as $periode) {
            //     $lesperiodes[$periode->id] = $periode->libelleperiode;
            // }
            // $form->select('periodesannuelle_id', __('Periodes'))->options($lesperiodes);
            $form->text('niveaurentree', __("J'ai terminé le remplissage du questionnaire"));
            $form->text('niveau1semestre', __("J'ai terminé le remplissage du questionnaire"));
            $form->text('niveau2semestre', __("J'ai terminé le remplissage du questionnaire"));
        });

        // Activité Sportive

        // $current_user = Auth::guard('admin')->user();
        // $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        // $current_school = Etablissement::where('id', $current_user->idEtab)->first();
        /*
        $lesetabannees = array();
        $etabannees = DB::table('etablissementannees')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->select('etablissementannees.*', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
            ->get();
        foreach ($etabannees as $etabannee) {
            $lesetabannees[$etabannee->id] = $etabannee->libelleanneescolaire . ' - ' . $etabannee->denominationetab;
        }
        $form->select('etablissementannees_id', __('Etablissementannees'))->options($lesetabannees)->default($current_school->id);
        */
        //         $form->hidden('etablissementannees_id', 'Etablissement Annee ID')->default($current_school->id);
        // $lessports = array();
        // $sports = Sport::all();
        // foreach ($sports as $sport) {
        //     $lessports[$sport->id] = $sport->libellesport;
        // }
        //         $form->multipleSelect('activitesportive')->options($lessports);

        return $form;
    }

    public function export() 
    {
        return Excel::download(new TcdSuiviRemplissageExport, 'Suivi_Remplissage.xlsx');
    }
}
