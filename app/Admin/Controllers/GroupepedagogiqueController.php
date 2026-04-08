<?php

namespace App\Admin\Controllers;

use App\Models\Diplomeprepare;
use App\Models\Serie;
use App\Models\Niveau;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Filiere;
use App\Models\Groupepedagogique;
use Encore\Admin\Controllers\AdminController;

class GroupepedagogiqueController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Groupepedagogique';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new groupepedagogique());

        $grid->column('id', __('Id'));
        $grid->column('libellegp', __('Libellegp'));
        $grid->niveau_id()->display(function ($id) {
            $query = Niveau::find($id);
            return $query ? $query->libelleniveau : 'Pas défini';
        });
        // $grid->column('filieres_id', __('Filieres id'));
        $grid->filieres_id()->display(function ($id) {
            $query = Filiere::find($id);
            return $query ? $query->libellefiliere : 'Pas défini';
        });
        // $grid->column('diplomeprepares_id', __('Diplomeprepares id'));
        $grid->diplomeprepares_id()->display(function ($id) {
            $query = Diplomeprepare::find($id);
            return $query ? $query->libellediplome : 'Pas défini';
        });
        // $grid->column('serie_id', __('Serie id'));
        
        
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
        $show = new Show(groupepedagogique::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('libellegp', __('Libellegp'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('niveau_id', __('Niveau id'));
        $show->field('filieres_id', __('Filieres id'));
        $show->field('diplomeprepares_id', __('Diplomeprepares id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new groupepedagogique());
        
        $form->text('libellegp', __('Libellegp'));
        $lesfilieres=array();
        $filieres=Filiere::all();
        foreach ($filieres as $filiere) {
            $lesfilieres[$filiere->id]=$filiere->libellefiliere;
        }
        $form->select('filieres_id', __('Filieres'))->options($lesfilieres);
        
        $lesdiplomes=array();
        $diplomes=Diplomeprepare::all();
        foreach ($diplomes as $diplome) {
            $lesdiplomes[$diplome->id]=$diplome->libellediplome;
        }
        $form->select('diplomeprepares_id', __('Diplome préparé'))->options($lesdiplomes);

        $lesniveaux=array();
        $niveaux=Niveau::all();
        foreach ($niveaux as $niveau) {
            $lesniveaux[$niveau->id]=$niveau->libelleniveau;
        }
        $form->select('niveau_id', __('Niveau'))->options($lesniveaux);
        // $form->number('niveau_id', __('Niveau id'));
        // $form->number('serie_id', __('Serie id'));
        // $form->number('filieres_id', __('Filieres id'));
        // $form->number('diplomeprepares_id', __('Diplomeprepares id'));

        return $form;
    }
}
