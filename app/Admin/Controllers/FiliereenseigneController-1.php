<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Filiere;
use App\Models\filiereenseigne;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Controllers\AdminController;

class FiliereenseigneController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Filiereenseigne';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new filiereenseigne());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('etablissement annees'));
        $grid->filieres_id()->display(function ($id) {
            $query = Filiere::find($id);
            return $query ? $query->libellefiliere : 'Pas défini';
        });
        $grid->column('dureeformation', __('Dureeformation'));
        $grid->column('observation', __('Observation'));
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
        $show = new Show(filiereenseigne::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('dureeformation', __('Dureeformation'));
        $show->field('observation', __('Observation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('filieres_id', __('Filieres id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new filiereenseigne());

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

        $lesfilieres=array();
        $filieres=Filiere::all();
        foreach ($filieres as $filiere) {
            $lesfilieres[$filiere->id]=$filiere->libellefiliere;
        }
        $form->select('filieres_id', __('Filieres'))->options($lesfilieres);
        $form->text('dureeformation', __('Dureeformation'));
        // $form->textarea('observation', __('Observation'));
        // $form->number('filieres_id', __('Filieres id'));
        $observations = [
            'FONCTIONNELLE'  => 'FONCTIONNELLE',
            'NON FONCTIONNELLE' => 'NON FONCTIONNELLE',
        ];
        $form->select('observation', 'Observation')->options($observations);
        return $form;
    }
}
