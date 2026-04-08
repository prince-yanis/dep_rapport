<?php

namespace App\Admin\Controllers;

use App\Models\Detailseffectifsetstatut;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DetailseffectifsetstatutController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Detailseffectifsetstatut';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Detailseffectifsetstatut());

        $grid->column('id', __('Id'));
        $grid->column('nbreaffecte', __('Nbreaffecte'));
        $grid->column('nbrenonaffecte', __('Nbrenonaffecte'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('niveau_id', __('Niveau id'));
        $grid->column('ordre_enseignement_id', __('Ordre enseignement id'));

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
        $show = new Show(Detailseffectifsetstatut::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nbreaffecte', __('Nbreaffecte'));
        $show->field('nbrenonaffecte', __('Nbrenonaffecte'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('niveau_id', __('Niveau id'));
        $show->field('ordre_enseignement_id', __('Ordre enseignement id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Detailseffectifsetstatut());

        $form->number('nbreaffecte', __('Nbreaffecte'));
        $form->number('nbrenonaffecte', __('Nbrenonaffecte'));
        $form->number('niveau_id', __('Niveau id'));
        $form->number('ordre_enseignement_id', __('Ordre enseignement id'));

        return $form;
    }
}
