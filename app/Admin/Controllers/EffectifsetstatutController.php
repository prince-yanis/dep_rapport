<?php

namespace App\Admin\Controllers;

use App\Models\Niveau;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Resultatsmission;
use App\Models\Effectifsetstatut;
use App\Models\OrdreEnseignement;
use Encore\Admin\Controllers\AdminController;

class EffectifsetstatutController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Effectifsetstatut';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Effectifsetstatut());

        $grid->column('id', __('Id'));
        $grid->column('resultatsmission_id', __('Resultats mission'));
        $grid->column('nbretotal', __('Nombre total'));
        $grid->column('observations', __('Observations'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        // $grid->column('ordre_enseignement_id', __('Ordre enseignement id'));

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
        $show = new Show(Effectifsetstatut::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nbretotal', __('Nombre total'));
        $show->field('observations', __('Observations'));
        $show->field('resultatsmission_id', __('Resultats mission'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        // $show->field('ordre_enseignement_id', __('Ordre enseignement id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Effectifsetstatut());

        // $form->number('resultatsmission_id', __('Resultatsmission id'));
        $query1 = Resultatsmission::get(['id'])->pluck('id');
        $form->select('resultatsmission_id', "Resultats de la mission")->options($query1);
        
        $form->number('nbretotal', __('Nombre total'))->attribute('class', 'form-control no-spin');
        // $form->number('ordre_enseignement_id', __('Ordre enseignement id'));

        $form->hasMany('detailseffectifsetstatut', __("Détails sur l'éffectif"), function (Form\NestedForm $form) {

            $query2 = OrdreEnseignement::get(['id', 'libelleenseignement'])->pluck('libelleenseignement', 'id');
            $form->select('ordre_enseignement_id', "Ordre enseignement")->options($query2);

            $query2 = Niveau::get(['id', 'libelleniveau'])->pluck('libelleniveau', 'id');
            $form->select('niveau_id', "Niveau")->options($query2);

            // $form->number('ordre_enseignement_id', __('Ordre enseignement'));
            // $form->number('niveau_id', __('Niveau'));
            $form->number('nbreaffecte', __("Nombre d'affecté"))->attribute('class', 'form-control no-spin');
            $form->number('nbrenonaffecte', __("Nombre non affecté"))->attribute('class', 'form-control no-spin');
        })->useTable();
        $form->textarea('observations', __('Observations'));

        return $form;
    }
}
