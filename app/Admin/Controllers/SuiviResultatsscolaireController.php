<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Resultatsmission;
use App\Models\Resultatsscolaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\AdminController;

class SuiviResultatsscolaireController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = ' ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Resultatsscolaire());

        $grid->column('id', __('Id'));
        $grid->column('observationpartielles', __('Observation partielles'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->column('resultatsmission_id', __('Resultats mission'));
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(Resultatsscolaire::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observationpartielles', __('Observation partielles'));
        $show->field('resultatsmission_id', __('Resultats mission'));
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
        $form = new Form(new Resultatsscolaire());
        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $role_id = $current_role->role_id;

        // filiere autorisé id
        $resultatMissionFiliere = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 6)
            ->where('mission_id', session('mission'))
            ->first();
        // Gestion administrative id

        $resultatMission_6 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 6)
            ->where('mission_id', session('mission'))
            ->first();
        $typepersonnel = DB::table('resultatstypepersonnel')
            ->where('resultatsmission_id', $resultatMission_6->id)
            ->where('typepersonnels_id', 3)
            ->first();
        // Infrastructure et equipement

        $resultatsmission_5 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 5)
            ->where('mission_id', session('mission'))
            ->first();
        $typeequipement = DB::table('resultatstypesequipement')
            ->where('resultatsmission_id', $resultatsmission_5->id)
            ->first();
        // Gestion administrative

        $resultatsmission_1 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 1)
            ->where('mission_id', session('mission'))
            ->first();
        $resultatscontrole_1 = DB::table('resultatscontrole')
            ->where('resultatsmission_id', $resultatsmission_1->id)
            ->where('sousrubriquecontrole_id', 1)
            ->first();
        // Resultat scolaire

        // $resultatsscolaire = DB::table('resultatsscolaire')
        //     ->where('resultatsmission_id', $resultatsmission_1->id)
        //     ->first();

        // Effectif et statut

        $resultatsscolaire = DB::table('resultatsscolaire')
            ->where('resultatsmission_id', $resultatsmission_1->id)
            ->first();
        // Gestion financière et juridique
        $resultatsmission_2 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 2)
            ->where('mission_id', session('mission'))
            ->first();
        $resultatscontrole_4 = DB::table('resultatscontrole')
            ->where('resultatsmission_id', $resultatsmission_2->id)
            ->where('sousrubriquecontrole_id', 4)
            ->first();
        // Relation avec le milieu professionnel
        $resultatsmission_3 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 3)
            ->where('mission_id', session('mission'))
            ->first();
        $resultatscontrole_5 = DB::table('resultatscontrole')
            ->where('resultatsmission_id', $resultatsmission_3->id)
            ->where('sousrubriquecontrole_id', 5)
            ->first();

        // Environnement Sécurité
        $resultatsmission_4 = DB::table('resultatsmission')
            ->where('rubriquecontrole_id', 4)
            ->where('mission_id', session('mission'))
            ->first();
        $resultatscontrole_6 = DB::table('resultatscontrole')
            ->where('resultatsmission_id', $resultatsmission_4->id)
            ->where('sousrubriquecontrole_id', 6)
            ->first();

        $form->html('
        <style>
            .numberCircle {
                display: inline-block;
                width: 30px;
                line-height: 30px;
                border-radius: 50%;
                text-align: center;
                font-size: 14px;
                border: 2px solid #666;
            }
            p {
                margin-bottom: 10px;
            }
            .menu-links span {
                text-transform: uppercase;
                font-size: 14px;
                margin-right: 5px;
            }
            .menu-links a {
                text-decoration: none;
            }
        </style>
    
    <h1 style="text-align:center; text-transform:uppercase;">Résultats scolaires</h1>
        <div class="menu-links">
        <span><a href="/admin/suivimissionedit/' . session('mission') . '/edit">Mission</a></span> |
        <span><a href="/admin/suivifiliere/' . $resultatMissionFiliere->id . '/edit">Filières autorisés</a></span> |
        <span><a href="/admin/suivipersonnel/' . $typepersonnel->id . '/edit">Gestion administrative</a></span> |
        <span><a href="/admin/suiviequipement/' . $typeequipement->id . '/edit">Infrastructures et Equipements</a></span> |
        <span><a href="/admin/suivicontrole_1/' . $resultatscontrole_1->id . '/edit">Gestion pédagogique</a></span> |
        <span>Résultats scolaires</span> |
        <span><a href="/admin/suivieffectifs/' . $resultatsscolaire->id . '/edit">Effectifs et statut des élèves de l année en cours</a></span> |
        <span><a href="/admin/suivicontrole_4/' . $resultatscontrole_4->id . '/edit">Gestion financière et juridique</a></span> |
        <span><a href="/admin/suivicontrole_5/' . $resultatscontrole_5->id . '/edit">Relation avec le milieu professionnel</a></span> |
        <span><a href="/admin/suivicontrole_6/' . $resultatscontrole_6->id . '/edit">Environnement Sécurité Hygiene et Santé</a></span>
    </div>
    ');

        // $query2 = Resultatsmission::orderBy('id', 'ASC')
        //     ->get(['id'])
        //     ->pluck('id');

        // $form->select('resultatsmission_id', "Resultats de la mission")
        //     ->options($query2);
        // $form->number('resultatsmission_id', __('Resultatsmission id'));

        switch ($role_id) {
            case 2:
                $form->hasMany('detailsresultatsscolaires', __('Détails'), function (Form\NestedForm $form) {

                    $query3 = Anneescolaire::orderBy('id', 'ASC')
                        ->get(['id', 'libelleanneescolaire'])
                        ->pluck('libelleanneescolaire', 'id');

                    $form->select('anneescolaires_id', "Année scolaire")
                        ->options($query3);

                    // $form->number('anneescolaires_id', __('Anneescolaires id'));
                    // $form->number('resultatsscolaire_id', __('Resultatsscolaire id'));
                    $form->number('present', __('Nombre de candidat présents'))->attribute('class', 'form-control no-spin');
                    $form->number('admis', __('Admis'))->attribute('class', 'form-control no-spin');
                    $form->decimal('taux', __('Taux de reussite'));
                })->useTable()
                    ->disableDelete();
                // $form->textarea('observationpartielles', __('Observation partielles'));

                $form->saved(function (Form $form) {
                    // Get the current mission ID
                    // $mission_id = $form->model()->mission_id;
                    $resultatsmission_id = $form->model()->resultatsmission_id;
                    // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
                    $resultatMission = DB::table('resultatsmission')
                        ->where('id', $resultatsmission_id)
                        ->first();
                    $mission_id = $resultatMission->mission_id;
                    $resultatsmission = DB::table('resultatsmission')
                        ->where('rubriquecontrole_id', 1)
                        ->where('mission_id', $mission_id)
                        ->first();

                    $resultatsscolaire = DB::table('resultatsscolaire')
                        ->where('resultatsmission_id', $resultatsmission_id)
                        ->first();
                    return redirect('admin/suivieffectifs/' . $resultatsscolaire->id . '/edit');
                });
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
                break;
            default:
                $form->hasMany('detailsresultatsscolaires', __('Détails'), function (Form\NestedForm $form) {

                    $query3 = Anneescolaire::orderBy('id', 'ASC')
                        ->get(['id', 'libelleanneescolaire'])
                        ->pluck('libelleanneescolaire', 'id');

                    $form->select('anneescolaires_id', "Année scolaire")
                        ->options($query3);

                    // $form->number('anneescolaires_id', __('Anneescolaires id'));
                    // $form->number('resultatsscolaire_id', __('Resultatsscolaire id'));
                    $form->number('present', __('Nombre de candidat présents'))->attribute('class', 'form-control no-spin');
                    $form->number('admis', __('Admis'))->attribute('class', 'form-control no-spin');
                    $form->decimal('taux', __('Taux de reussite'))->readonly();
                })->useTable();
                $form->textarea('observationpartielles', __('Observation partielles'));
                // Ajouter le script JavaScript pour le calcul en temps réel
                $form->html('
<script>
$(document).ready(function() {
    function calculateTaux(row) {
        var present = parseFloat($(row).find(".present-field input").val()) || 0;
        var admis = parseFloat($(row).find(".admis-field input").val()) || 0;
        var tauxField = $(row).find("input[readonly]");
        
        if (present > 0) {
            var taux = (admis / present) * 100;
            tauxField.val(taux.toFixed(2));
        } else {
            tauxField.val("0.00");
        }
    }

    // Calcul initial
    $(".has-many-relation-form").each(function() {
        calculateTaux(this);
    });

    // Calcul lors de la modification des champs
    $(document).on("input", ".present-field input, .admis-field input", function() {
        calculateTaux($(this).closest(".has-many-relation-form"));
    });

    // Gestion de ajout de nouvelles lignes
    $(document).on("click", ".add", function() {
        setTimeout(function() {
            $(".has-many-relation-form").each(function() {
                if (!$(this).data("initialized")) {
                    calculateTaux(this);
                    $(this).data("initialized", true);
                }
            });
        }, 100);
    });
});
</script>
');

                $form->saved(function (Form $form) {
                    // Get the current mission ID
                    // $mission_id = $form->model()->mission_id;
                    $resultatsmission_id = $form->model()->resultatsmission_id;
                    // Query the resultatsmissions table to check if there is a result with rubriquecontrole_id = 6 and mission_id = the current mission
                    $resultatMission = DB::table('resultatsmission')
                        ->where('id', $resultatsmission_id)
                        ->first();
                    $mission_id = $resultatMission->mission_id;
                    $resultatsmission = DB::table('resultatsmission')
                        ->where('rubriquecontrole_id', 1)
                        ->where('mission_id', $mission_id)
                        ->first();

                    $resultatsscolaire = DB::table('resultatsscolaire')
                        ->where('resultatsmission_id', $resultatsmission_id)
                        ->first();
                    return redirect('admin/suivieffectifs/' . $resultatsscolaire->id . '/edit');
                });
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
                break;
        }

        return $form;
    }
}
