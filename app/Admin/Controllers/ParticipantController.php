<?php

namespace App\Admin\Controllers;

use App\Models\Participant;
use App\Models\Fondateur;
use App\Models\Sessionformation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ParticipantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Participant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Participant());

        $grid->column('id', __('Id'));
		$grid->fondateurs_id("Nom & Prénoms")->display(function ($id) {
                    $query = Fondateur::find($id);
                    return $query ? $query->nom . ' ' . $query->prenom : 'Pas défini';
                });
		$grid->sessionformations_id("Session")->display(function ($id) {
                    $query = Sessionformation::find($id);
    if ($query) {
        $dateDebut = date('d/m/Y', strtotime($query->date_debut));
        $dateFin = date('d/m/Y', strtotime($query->date_fin));
        return $query->libelle . ' DU ' . $dateDebut . ' AU ' . $dateFin;
    }
    return 'Pas défini';
                });
		$grid->column('date', __('Date'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Participant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('status', __('Status'));
        $show->field('fondateurs_id', __('Fondateurs id'));
        $show->field('sessionformations_id', __('Sessionformations id'));
        $show->field('date', __('Date'));
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
        $form = new Form(new Participant());

        //$form->number('fondateurs_id', __('Fondateurs id'));
        //$form->number('sessionformations_id', __('Sessionformations id'));
        $form->date('date', __('Date'))->default(date('Y-m-d'));
		$form->text('status', __('Status'));

        return $form;
    }
}
