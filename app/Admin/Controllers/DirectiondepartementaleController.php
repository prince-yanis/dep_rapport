<?php

namespace App\Admin\Controllers;

use App\Models\AdminRole;
use App\Models\AdminRoleUser;
use App\Models\AdminUser;
use App\Models\Directiondepartementale;
use App\Models\Directionregionale;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DirectiondepartementaleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Directiondepartementale';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Directiondepartementale());

        $grid->column('id', __('Id'));
        // $grid->column('directionregionales_id', __('Directionregionales id'));
        $grid->directionregionales_id()->display(function ($id) {
            $query = Directionregionale::find($id);
            return $query ? $query->denominationdr : 'Pas défini';
        });
        $grid->column('denominationdd', __('Denominationdd'));
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
        $show = new Show(Directiondepartementale::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('directionregionales_id', __('Directionregionales id'));
        $show->field('denominationdd', __('Denominationdd'));
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
        $form = new Form(new Directiondepartementale());
        $lesdrs = array();
        $drs = Directionregionale::all();
        foreach ($drs as $dr) {
            $lesdrs[$dr->id] = $dr->denominationdr;
        }
        $form->select('directionregionales_id', __('Direction regionale'))->options($lesdrs);

        // $form->number('directionregionales_id', __('Directionregionales id'));
        $form->text('denominationdd', __('Denominationdd'));

        $form->saved(function (Form $form) {
            // Récupérer les données depuis la table direction_departementale
            $directions = Directiondepartementale::all();
            $createdCount = 0; // Compteur pour savoir combien de comptes ont été créés


            // Parcourir chaque enregistrement et créer un admin_user
            foreach ($directions as $direction) {
                if (!AdminUser::where('username', preg_replace('/\s+/', '', $direction->denominationdd))->exists()) {
                    $new_admin = AdminUser::create([
                        'username' => preg_replace('/\s+/', '', $direction->denominationdd), // Supprime les espaces
                        'name' => $direction->denominationdd,
                        'idDR' => $direction->id,
                        'password' => \Hash::make('00000000'), // Définir un mot de passe par défaut
                    ]);
                    if ($new_admin->save()) {
                        $query = new AdminRoleUser([
                            'user_id' => $new_admin->id,
                            'role_id' => AdminRole::where('slug', 'dr')->firstOrFail()->id,
                        ]);
                        $query->save();
                    }
                    $createdCount++;
                }
            }

            // Rediriger avec un message de succès
            // return redirect()->back()->with('success', "$createdCount comptes ont été créés avec succès.");
            admin_toastr("$createdCount Remplissage du rapport effectué avec succès", 'success');

        });

        return $form;
    }
}
