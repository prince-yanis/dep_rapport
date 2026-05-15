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
use App\Models\Parametresglobaux;
use Encore\Admin\Controllers\AdminController;


class EtablissementanneePointExecutionController extends AdminController
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

       $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();

        $form->html('
		<style>
		.span {
            line-height: 1;
            background: #1ABB9C;
            color: #fff !important;
}

		</style>

		<div>
                <h1 style="text-align:center; text-transform:uppercase;">Point de l\'execution des programmes et progressions</h1>
                <span style="font-size: 14px;"><a href="/admin/etablissementdetails/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne/' . $EtabAnnee->id . '/edit">Filières de Formation</a></span>
                
				<span >|</span>
                <span style="font-size: 14px";><a href="/admin/personnelannees2">Personnels</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeclasse/' . $EtabAnnee->id . '/edit">Classe</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a style="color:red !important;" href="/admin/etabanneepoint/' . $EtabAnnee->id . '/edit">Progression</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneemiseenstage/' . $EtabAnnee->id . '/edit">Mise en Stage</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeindicateurs/' . $EtabAnnee->id . '/edit">Indicateurs</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure/' . $EtabAnnee->id . '/edit">Infrastructure et Locaux</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeproblemeinfrastructures/' . $EtabAnnee->id . '/edit">Problèmes Infrastructures</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinventaire/' . $EtabAnnee->id . '/edit">Inventaire d\'Equipement</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebudgets/' . $EtabAnnee->id . '/edit">Exécution Budget</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeressources/' . $EtabAnnee->id . '/edit">Ressources Additionnelles</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneescolarites/' . $EtabAnnee->id . '/edit">Frais scolarité</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneetravaux/' . $EtabAnnee->id . '/edit">Autres ressources</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneecomite/' . $EtabAnnee->id . '/edit">Comité gestion</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneesocio/' . $EtabAnnee->id . '/edit">Activités Socio-Educative</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeprobleme/' . $EtabAnnee->id . '/edit">Problèmes Urgents</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeperspectives/' . $EtabAnnee->id . '/edit">Perspectives</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeconclusion/' . $EtabAnnee->id . '/edit">Conclusion</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/plannings">Planning</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/apprenantannees2">Apprenants</a></span>
                
            </div>
            ');

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


        $form->hasMany('pointexecution', __(''), function (Form\NestedForm $form) {
        $form->number('total_chapitre', __('Total chapitre'));
        $form->number('chapitres_execute', __('Chapitres execute'));
        $form->number('total_lecon', __('Total lecon'));
        $form->number('lecons_execute', __('Lecons execute'));
        $form->number('disciplines_id', __('Disciplines id'));
        $form->decimal('pourcentage_chapitre', __('Pourcentage chapitre'));
        $form->decimal('pourcentage_lecon', __('Pourcentage lecon'));
        $form->text('observations', __('Observations'));
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
            // $idDonneeEtab=session('idDonneesEtab');
            // $idEtab=session('etablissementchoisi');
            //   return redirect('admin/personnels/create');
            //   return redirect('admin/personnels/create');

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

            return redirect('admin/etabanneemiseenstage/' . $EtabAnnee->id . '/edit');
        });

        return $form;
    }

    public function export() 
    {
        return Excel::download(new TcdSuiviRemplissageExport, 'Suivi_Remplissage.xlsx');
    }
}
