<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Commune;
use App\Models\AdminRole;
use App\Models\AdminUser;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Hash;
use App\Models\Directiondepartementale;
use Encore\Admin\Controllers\AdminController;

class EtablissementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Etablissement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Etablissement());

        $grid->column('id', __('Id'));
        $grid->column('denominationetab', __('Denominationetab'));
        // $grid->column('communes_id', __('Communes id'));
        $grid->communes_id()->display(function ($id) {
            $query = Commune::find($id);
            return $query ? $query->denominationcommune : 'Pas défini';
        });
        $grid->column('code', __('Code'));
        $grid->column('datecreation', __('Datecreation'));
        $grid->column('numautorisationcreation', __('Numautorisationcreation'));
        $grid->column('numautorisationouverture', __('Numautorisationouverture'));
        $grid->column('localisation', __('Localisation'));
        $grid->column('adresse', __('Adresse'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('email', __('Email'));
        $grid->column('nomfondateur', __('Nomfondateur'));
        $grid->column('contact', __('Contact'));
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
        $show = new Show(Etablissement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('denominationetab', __('Denominationetab'));
        $show->field('code', __('Code'));
        $show->field('datecreation', __('Datecreation'));
        $show->field('numautorisationcreation', __('Numautorisationcreation'));
        $show->field('numautorisationouverture', __('Numautorisationouverture'));
        $show->field('localisation', __('Localisation'));
        $show->field('adresse', __('Adresse'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('nomfondateur', __('Nomfondateur'));
        $show->field('contact', __('Contact'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('communes_id', __('Communes id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Etablissement());

        $form->text('denominationetab', __('Denominationetab'));
        $form->text('code', __('Code'));

        $lesdds=array();
        $dds=Directiondepartementale::all();
        foreach ($dds as $dd) {
            $lesdds[$dd->id]=$dd->denominationdd;
        }
        $form->select('directiondepartementales_id', __('Direction départementale'))->options($lesdds);
        
        $lescommunes=array();
        $communes=Commune::all();
        foreach ($communes as $commune) {
            $lescommunes[$commune->id]=$commune->denominationcommune;
        }
        $form->select('communes_id', __('Commune'))->options($lescommunes);

        $form->datetime('datecreation', __('Datecreation'));
        $form->text('numautorisationcreation', __('Numautorisationcreation'));
        $form->text('numautorisationouverture', __('Numautorisationouverture'));
        $form->text('localisation', __('Localisation'));
        $form->text('adresse', __('Adresse'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        $form->text('nomfondateur', __('Nomfondateur'));
        $form->text('contact', __('Contact'));

        $form->saved(function (Form $form) {
			$idEtab = $form->model()->id;
            // dd($idEtab);
		  // Create an user account
            if (!AdminUser::where([
                ['username', '=', $form->code],
            ])->exists()) {
                $rubric = new AdminUser([
                    'username' => $form->code,
                    'name' => $form->code,
                    'etablissements_id' => $idEtab,
                    'password' => \Hash::make('00000000'),
                ]);
                if ($rubric->save()) {
                    $query = new AdminRoleUser([
                        'user_id' => $rubric->id,
                        'role_id' => AdminRole::where('slug', 'etablissements')->firstOrFail()->id,
                    ]);
                    $query->save();
                }
            }
		});

        return $form;
    }
}
