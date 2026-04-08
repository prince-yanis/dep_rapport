<?php

namespace App\Admin\Controllers;

use App\Models\Filiere;
use App\Models\OrdreEnseignement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FiliereController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Filiere';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new filiere());

        $grid->column('id', __('Id'));
        $grid->ordre_enseignement_id('Type de filière')->display(function ($id) {
            $query = OrdreEnseignement::find($id);
            return $query->libelleenseignement;
        });
        $grid->column('libellefiliere', __('Libelle de la filiere'));
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
        $show = new Show(filiere::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libellefiliere', __('Libellefiliere'));
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
        $form = new Form(new filiere());

        $lesordres = array();
        $ordres = OrdreEnseignement::all();
        foreach ($ordres as $ordre) {
            $lesordres[$ordre->id] = $ordre->libelleenseignement;
        }
        $form->select('ordre_enseignement_id', __('Type de filière'))->options($lesordres);
        $form->text('libellefiliere', __('Libellefiliere'));

        return $form;
    }
}
