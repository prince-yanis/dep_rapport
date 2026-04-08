<?php

namespace App\Admin\Controllers;

use App\Models\Resultatsmission;
use App\Models\Rubriquecontrole;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ResultatsmissionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resultatsmission';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Resultatsmission());

        $grid->column('id', __('Id'));
        $grid->column('observation', __('Observation'));
        $grid->column('recommandation', __('Recommandation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('mission_id', __('Mission id'));
        $grid->column('rubriquecontrole_id', __('Rubriquecontrole id'));

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
        $show = new Show(Resultatsmission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('observation', __('Observation'));
        $show->field('recommandation', __('Recommandation'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('mission_id', __('Mission id'));
        $show->field('rubriquecontrole_id', __('Rubriquecontrole id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Resultatsmission());

        $form->number('mission_id', __('Mission id'));
        // $form->number('rubriquecontrole_id', __('Rubriquecontrole id'));
        $query2 = Rubriquecontrole::orderBy('libellerubrique', 'ASC')
                ->get(['id', 'libellerubrique'])
                ->pluck('libellerubrique', 'id');

            $form->select('rubriquecontrole_id', "Rubrique controle")
                ->options($query2);
        $form->textarea('observation', __('Observation'));
        $form->text('recommandation', __('Recommandation'));

        return $form;
    }
}
