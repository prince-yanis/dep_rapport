<?php

namespace App\Admin\Controllers;

use App\Models\Classe;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\Groupepedagogique;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Parametresglobaux;
use Encore\Admin\Controllers\AdminController;

class ClasseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Classe';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new classe());
		
		$current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', '=', $current_user->idEtab)->first();

        $role_id = $current_role->role_id;
		
		switch ($role_id) {
            case 2:
				$etab = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', $etablissement->id)
				->first();
				$grid->model()->where('etablissementannees_id', '=', $etab->id);
				

        $grid->column('id', __('Id'));
        // $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->etablissementannees_id('Etablissement')->display(function ($id) {
            $query = DB::table('etablissementannees')
                ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                ->select('etablissementannees.id', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
                ->where('etablissementannees.id', $id)
                ->first();
            return $query->libelleanneescolaire . ' - ' . $query->denominationetab;
            // return $query->libellestatutpers;

        });
        // $grid->column('groupepedagogiques_id', __('Groupepedagogiques id'));
        $grid->groupepedagogiques_id('Groupe pédagogique')->display(function ($id) {
            $query = Groupepedagogique::find($id);
            return $query->libellegp;
        });
        $grid->column('denominationclasse', __('Dénomination de la classe'));
        //$grid->column('effectif_total', __('Effectif total'));
        //$grid->column('effectif_gar', __('Effectif des garçcons'));
        //$grid->column('effectif_fil', __('Effectif des filles'));
        //$grid->column('effectif_boursier', __('Effectif des boursiers'));
        //$grid->column('effectif_nonboursier', __('Effectif des non boursiers'));
        //$grid->column('effectif_affecte', __('Effectif des affectés'));
        //$grid->column('effectif_nonaffecte', __('Effectif des non affectés'));
		$grid->column('planning', __('Emplois du temps'))->display(function ($planning) {
    if ($planning) {
        $url = url('uploads/files/' . basename($planning));
        return "<a href='{$url}' target='_blank' download><i class='fa fa-download'></i> Télécharger</a>";
    }
    return '-';
});
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
		break;
				
			default:
				 // 🔸 Filtrer uniquement les classes ayant un fichier planning
    $grid->model()
        ->whereNotNull('planning')
        ->where('planning', '!=', '')
        // 🔸 Joindre les tables nécessaires pour les recherches
        ->leftJoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
        ->leftJoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
        ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
        ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
		->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
        ->select(
            'classes.*',
            'groupepedagogiques.libellegp',
            'etablissements.denominationetab',
            'anneescolaires.libelleanneescolaire'
        );

    // ✅ QuickSearch sur classe + groupe + établissement + année scolaire
    $grid->quickSearch([
        'classes.denominationclasse',
        'groupepedagogiques.libellegp',
        'etablissements.denominationetab',
        'anneescolaires.libelleanneescolaire',
        'classes.planning'
    ])->placeholder('Rechercher par classe, groupe, établissement ou année...');
				$grid->column('id', __('Id'));
        // $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->etablissementannees_id('Etablissement')->display(function ($id) {
            $query = DB::table('etablissementannees')
                ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
                ->select('etablissementannees.id', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab')
                ->where('etablissementannees.id', $id)
                ->first();
            return $query->libelleanneescolaire . ' - ' . $query->denominationetab;
            // return $query->libellestatutpers;

        });
        // $grid->column('groupepedagogiques_id', __('Groupepedagogiques id'));
        $grid->groupepedagogiques_id('Groupe pédagogique')->display(function ($id) {
            $query = Groupepedagogique::find($id);
            return $query->libellegp;
        });
        $grid->column('denominationclasse', __('Dénomination de la classe'));
        //$grid->column('effectif_total', __('Effectif total'));
        //$grid->column('effectif_gar', __('Effectif des garçcons'));
        //$grid->column('effectif_fil', __('Effectif des filles'));
        //$grid->column('effectif_boursier', __('Effectif des boursiers'));
        //$grid->column('effectif_nonboursier', __('Effectif des non boursiers'));
        //$grid->column('effectif_affecte', __('Effectif des affectés'));
        //$grid->column('effectif_nonaffecte', __('Effectif des non affectés'));
		$grid->column('planning', __('Emplois du temps'))->display(function ($planning) {
    if ($planning) {
        $url = url('uploads/files/' . basename($planning));
        return "<a href='{$url}' target='_blank' download><i class='fa fa-download'></i> Télécharger</a>";
    }
    return '-';
});
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
        $show = new Show(classe::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('denominationclasse', __('Denominationclasse'));
        $show->field('effectif_total', __('Effectif total'));
        $show->field('effectif_gar', __('Effectif gar'));
        $show->field('effectif_fil', __('Effectif fil'));
        $show->field('effectif_boursier', __('Effectif boursier'));
        $show->field('effectif_nonboursier', __('Effectif nonboursier'));
        $show->field('effectif_affecte', __('Effectif affecte'));
        $show->field('effectif_nonaffecte', __('Effectif nonaffecte'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('groupepedagogiques_id', __('Groupepedagogiques id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
{
    $form = new Form(new classe());

    $current_user = Auth::guard('admin')->user();
    $current_school = Etablissement::where('id', $current_user->idEtab)->first();

    // Récupération de l'établissement-année lié à l'utilisateur
    $etab = null;
    if ($current_school) {
        $etab = DB::table('etablissementannees')
            ->where('anneescolaires_id', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', $current_school->id)
            ->first();
    }

    // Remplir la liste des établissement-année
    $lesetabannees = DB::table('etablissementannees')
        ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
        ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
		->where('anneescolaires_id', Parametresglobaux::findOrFail(1)->anneescolaires_id)
        ->select(
            'etablissementannees.id',
            DB::raw("CONCAT(anneescolaires.libelleanneescolaire, ' - ', etablissements.denominationetab) AS label")
        )
        ->pluck('label', 'id');

    // Champ Etablissement - année
    if ($etab) {
        $form->select('etablissementannees_id', __('Etablissement - années'))
            ->options($lesetabannees)
            ->default($etab->id)
            ->readonly(); // meilleur que readonly()
    } else {
        $form->select('etablissementannees_id', __('Etablissement - années'))
            ->options($lesetabannees);
    }

    // Remplir la liste des groupes pédagogiques
    $lesgroupes = DB::table('groupepedagogiques')
        ->select('id', 'libellegp')
        ->pluck('libellegp', 'id');

    $form->select('groupepedagogiques_id', __("Niveau d'étude"))
         ->options($lesgroupes);

    $form->text('denominationclasse', __('Dénomination de la classe'));
    $form->file('planning', __('Emplois du temps'));

    return $form;
}

}
