<?php

namespace App\Admin\Controllers;

use Hash;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Commune;
use App\Models\AdminRole;
use App\Models\AdminUser;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Filiereautorise;
use App\Models\Filiereenseigne;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $grid = new Grid(new etablissement());

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();
        // echo $current_role->role_id;
        // echo $postulant->id;
        // dd($postulant);
        if (in_array($current_role->role_id, array(2))) {
            $grid->model()->where('id', '=', $etablissement->id);
            $grid->disableActions();
        }

        $grid->column('id', __('Id'));
        $grid->column('denominationetab', __('Denominationetab'));
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
        $grid->column('communes_id', __('Communes id'));
        $grid->column('filiereautorises_id', __('Filiereautorises id'));
        $grid->column('filiereenseignes_id', __('Filiereenseignes id'));
        $grid->column('directiondepartementales_id', __('Directiondepartementales id'));

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
        $show = new Show(etablissement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('denominationetab', __('Denominationetab'));
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
        $show->field('filiereautorises_id', __('Filiereautorises id'));
        $show->field('filiereenseignes_id', __('Filiereenseignes id'));
        $show->field('directiondepartementales_id', __('Directiondepartementales id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new etablissement());
        $form->text('denominationetab', __('Denominationetab'));
        // $form->number('directiondepartementales_id', __('Directiondepartementales id'));
        $lesdds = array();
        $dds = Directiondepartementale::all();
        foreach ($dds as $dd) {
            $lesdds[$dd->id] = $dd->denominationdd;
        }
        $form->select('directiondepartementales_id', __('Direction départementale'))->options($lesdds);
        // $form->number('communes_id', __('Communes id'));
        $lescommunes = array();
        $communes = Commune::all();
        foreach ($communes as $commune) {
            $lescommunes[$commune->id] = $commune->denominationcommune;
        }
        $form->select('communes_id', __('Commune'))->options($lescommunes);

        $form->text('datecreation', __('Datecreation'));
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
                ['username', '=', $form->email],
            ])->exists()) {
                $rubric = new AdminUser([
                    'username' => $form->email,
                    'name' => $form->email,
                    'idEtab' => $idEtab,
                    'password' => Hash::make('00000000'),
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
