<?php

namespace App\Admin\Controllers;

use App\Models\Entreprise;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;

class EntrepriseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Entreprise';
    
    /**
     * Get current user role and etablissement ID
     */
    private function getUserRole()
    {
        $user = AdminUser::find(Auth::id());
        
        if (!$user) {
            return ['role' => 'guest', 'etablissement_id' => null];
        }
        
        // Role 1: Admin - sees everything
        if ($user->idEtab === null && $user->idDR === null) {
            return ['role' => 'admin', 'etablissement_id' => null];
        }
        
        // Role 2: Etablissement - sees only their data
        if ($user->idEtab !== null) {
            return ['role' => 'etablissement', 'etablissement_id' => $user->idEtab];
        }
        
        // Other roles - limited access
        return ['role' => 'other', 'etablissement_id' => null];
    }
    
    /**
     * Check if user can manage data
     */
    private function canManageData()
    {
        $role = $this->getUserRole();
        return in_array($role['role'], ['admin', 'etablissement']);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Entreprise());
        
        $userRole = $this->getUserRole();
        
        // Apply role-based filtering
        switch ($userRole['role']) {
            case 'admin':
                // Admin sees everything
                $grid->model()->withCount(['stages']);
                break;
                
            case 'etablissement':
                // Etablissement can see all enterprises (for stage creation)
                $grid->model()->withCount(['stages']);
                break;
                
            case 'other':
            default:
                // Other roles - no access
                $grid->model()->whereRaw('1 = 0');
                break;
        }
        
        $grid->column('id', __('Id'));
        $grid->column('raison_sociale', __('Raison sociale'))->sortable();
        $grid->column('sigle', __('Sigle'));
        $grid->column('secteur_activite', __('Secteur activite'));
        $grid->column('ville', __('Ville'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('email', __('Email'));
        $grid->column('stages_count', __('Nombre de stages'))->sortable();
        $grid->column('statut', __('Statut'))->display(function ($value) {
            return $value ? '<span class="label label-success">Actif</span>' : '<span class="label label-danger">Inactif</span>';
        });
        $grid->column('created_at', __('Created at'));
        
        $grid->filter(function($filter){
            $filter->like('raison_sociale', 'Raison sociale');
            $filter->like('sigle', 'Sigle');
            $filter->like('ville', 'Ville');
            $filter->equal('statut', 'Statut')->select([1 => 'Actif', 0 => 'Inactif']);
        });
        
        // Disable actions for non-managing users
        if (!$this->canManageData()) {
            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->disableExport();
        } else {
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
            
            // Disable default export
            $grid->disableExport();
            
            // Add custom Excel export button
            $grid->tools(function ($tools) {
                $tools->append(new \App\Admin\Tools\ExcelExportButton('entreprises'));
            });
        }

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
        $show = new Show(Entreprise::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('raison_sociale', __('Raison sociale'));
        $show->field('sigle', __('Sigle'));
        $show->field('secteur_activite', __('Secteur activite'));
        $show->field('adresse', __('Adresse'));
        $show->field('ville', __('Ville'));
        $show->field('latitude', __('Latitude'));
        $show->field('longitude', __('Longitude'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('responsable', __('Responsable'));
        $show->field('fonction_responsable', __('Fonction responsable'));
        $show->field('telephone_responsable', __('Telephone responsable'));
        $show->field('email_responsable', __('Email responsable'));
        $show->field('statut', __('Statut'))->as(function ($value) {
            return $value ? 'Actif' : 'Inactif';
        });
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
        $form = new Form(new Entreprise());
        
        // Disable form for non-managing users
        if (!$this->canManageData()) {
            $form->disableEditing();
            $form->disableCreating();
            return $form;
        }

        $form->text('raison_sociale', __('Raison sociale'));
        $form->text('sigle', __('Sigle'));
        $form->text('secteur_activite', __('Secteur activite'));
        $form->textarea('adresse', __('Adresse'));
        $form->text('ville', __('Ville'));
        $form->decimal('latitude', __('Latitude'));
        $form->decimal('longitude', __('Longitude'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        $form->text('responsable', __('Responsable'));
        $form->text('fonction_responsable', __('Fonction responsable'));
        $form->text('telephone_responsable', __('Telephone responsable'));
        $form->text('email_responsable', __('Email responsable'));
        $form->switch('statut', __('Statut'))->default(1)->help('Activez pour rendre l\'entreprise visible dans le système');
        
        return $form;
    }
}
