<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Itemscontrole;
use App\Models\Resultatscontrole;
use Illuminate\Support\Facades\DB;
use App\Models\Detailsresultatscontrole;
use Encore\Admin\Controllers\AdminController;

class DetailsresultatscontroleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Detailsresultatscontrole';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Detailsresultatscontrole());

        $grid->column('id', __('Id'));
        $grid->column('existence', __('Existence'));
        $grid->column('observations', __('Observations'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('itemscontrole_id', __('Itemscontrole id'));
        $grid->column('resultatscontrole_id', __('Resultatscontrole id'));

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
        $show = new Show(Detailsresultatscontrole::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('existence', __('Existence'));
        $show->field('observations', __('Observations'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('itemscontrole_id', __('Itemscontrole id'));
        $show->field('resultatscontrole_id', __('Resultatscontrole id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Detailsresultatscontrole());

        $lesresultats = [];
        $resultats = Resultatscontrole::all();
        $resultats = DB::table('resultatscontrole')
            ->leftJoin('resultatsmission', 'resultatscontrole.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftJoin('mission', 'resultatsmission.mission_id', '=', 'mission.id')
            ->leftJoin('etablissementannees', 'mission.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftJoin('sousrubriquecontrole', 'resultatscontrole.sousrubriquecontrole_id', '=', 'sousrubriquecontrole.id')
            ->select('resultatscontrole.id', 'anneescolaires.libelleanneescolaire', 'etablissements.denominationetab', 'sousrubriquecontrole.libellesousrubrique')
            ->get();
        foreach ($resultats as $resultat) {
            $lesresultats[$resultat->id] = $resultat->libelleanneescolaire . '-' . $resultat->denominationetab. '|' . $resultat->libellesousrubrique;
        }
        $form->select('resultatscontrole_id', __('Resultats controle'))->options($lesresultats);
        // $form->number('resultatscontrole_id', __('Resultatscontrole id'));
        $lesitems = array();
        $items = Itemscontrole::all();
        foreach ($items as $item) {
            $lesitems[$item->id] = $item->libelleitems;
        }
        $form->select('itemscontrole_id', __('Items controle'))->options($lesitems);
        $form->radio('existence', __('Existence'))->options(['0' => 'Oui', '1' => 'Non']);
        $form->number('observations', __('Observations'));

        return $form;
    }
}
