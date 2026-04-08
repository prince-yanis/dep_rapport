<?php

namespace App\Admin\Controllers;

use App\Models\Resultatexamen;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ResultatexamenController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resultatexamen';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new resultatexamen());

        $grid->column('id', __('Id'));
        $grid->column('etablissementannees_id', __('Etablissementannees id'));
        $grid->column('diplomeprepares_id', __('Diplomeprepares id'));
        $grid->column('filieres_id', __('Filieres id'));
        $grid->column('nombrecandidat_f', __('Nombrecandidat f'));
        $grid->column('nombrecandidat_g', __('Nombrecandidat g'));
        $grid->column('nombrecandidat_t', __('Nombrecandidat t'));
        $grid->column('nombreadmis_f', __('Nombreadmis f'));
        $grid->column('nombreadmis_g', __('Nombreadmis g'));
        $grid->column('nombreadmis_t', __('Nombreadmis t'));
        $grid->column('observations', __('Observations'));

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
        $show = new Show(resultatexamen::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('etablissementannees_id', __('Etablissementannees id'));
        $show->field('diplomeprepares_id', __('Diplomeprepares id'));
        $show->field('filieres_id', __('Filieres id'));
        $show->field('nombrecandidat_f', __('Nombrecandidat f'));
        $show->field('nombrecandidat_g', __('Nombrecandidat g'));
        $show->field('nombrecandidat_t', __('Nombrecandidat t'));
        $show->field('nombreadmis_f', __('Nombreadmis f'));
        $show->field('nombreadmis_g', __('Nombreadmis g'));
        $show->field('nombreadmis_t', __('Nombreadmis t'));
        $show->field('observations', __('Observations'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new resultatexamen());

        $form->number('etablissementannees_id', __('Etablissementannees id'));
        $form->number('diplomeprepares_id', __('Diplomeprepares id'));
        $form->number('filieres_id', __('Filieres id'));
        $form->text('nombrecandidat_f', __('Nombrecandidat f'));
        $form->text('nombrecandidat_g', __('Nombrecandidat g'));
        $form->text('nombrecandidat_t', __('Nombrecandidat t'));
        $form->text('nombreadmis_f', __('Nombreadmis f'));
        $form->text('nombreadmis_g', __('Nombreadmis g'));
        $form->text('nombreadmis_t', __('Nombreadmis t'));
        $form->textarea('observations', __('Observations'));

        return $form;
    }
}
