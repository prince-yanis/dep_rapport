<?php

namespace App\Admin\Controllers;

use App\Models\Convention;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;

class ConventionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Convention';
    
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
        $grid = new Grid(new Convention());
        
        $userRole = $this->getUserRole();
        
        // Apply role-based filtering
        switch ($userRole['role']) {
            case 'admin':
                // Admin sees everything
                $grid->model()->with('entreprise');
                break;
                
            case 'etablissement':
                // Etablissement can see all conventions (for reference)
                $grid->model()->with('entreprise');
                break;
                
            case 'other':
            default:
                // Other roles - no access
                $grid->model()->whereRaw('1 = 0');
                break;
        }
        
        $grid->column('id', __('Id'));
        $grid->column('entreprise.raison_sociale', __('Entreprise'))->sortable();
        $grid->column('numero_convention', __('Numero convention'))->sortable();
        $grid->column('date_signature', __('Date signature'))->sortable();
        $grid->column('date_expiration', __('Date expiration'))->sortable();
        $grid->column('statut', __('Statut'))->display(function ($value) {
            $colors = [
                'ACTIVE' => 'success',
                'EXPIREE' => 'danger',
                'SUSPENDUE' => 'warning'
            ];
            $color = $colors[$value] ?? 'default';
            return '<span class="label label-' . $color . '">' . $value . '</span>';
        });
        $grid->column('created_at', __('Created at'));
        
        $grid->filter(function($filter){
            $filter->like('numero_convention', 'Numéro de convention');
            $filter->equal('entreprises_id', 'Entreprise')->select(function () {
                return \App\Models\Entreprise::pluck('raison_sociale', 'id');
            });
            $filter->equal('statut', 'Statut')->select([
                'ACTIVE' => 'Active',
                'EXPIREE' => 'Expirée',
                'SUSPENDUE' => 'Suspendue'
            ]);
            $filter->between('date_signature', 'Date de signature')->date();
            $filter->between('date_expiration', 'Date d\'expiration')->date();
        });
        
        // Disable actions for non-managing users
        if (!$this->canManageData()) {
            $grid->disableActions();
            $grid->disableCreateButton();
            $grid->disableExport();
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
        $show = new Show(Convention::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('entreprise.raison_sociale', __('Entreprise'));
        $show->field('numero_convention', __('Numero convention'));
        $show->field('date_signature', __('Date signature'));
        $show->field('date_expiration', __('Date expiration'));
        $show->field('document', __('Document'));
        $show->field('statut', __('Statut'))->as(function ($value) {
            $labels = [
                'ACTIVE' => 'Active',
                'EXPIREE' => 'Expirée',
                'SUSPENDUE' => 'Suspendue'
            ];
            return $labels[$value] ?? $value;
        });
        $show->field('observation', __('Observation'));
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
        $form = new Form(new Convention());
        
        // Disable form for non-managing users
        if (!$this->canManageData()) {
            $form->disableEditing();
            $form->disableCreating();
            return $form;
        }

        $form->select('entreprises_id', __('Entreprise'))->options(function () {
            return \App\Models\Entreprise::pluck('raison_sociale', 'id');
        })->required();
        $form->text('numero_convention', __('Numero convention'));
        $form->date('date_signature', __('Date signature'))->default(date('Y-m-d'));
        $form->date('date_expiration', __('Date expiration'))->default(date('Y-m-d'));
        $form->text('document', __('Document'))->help('Nom du fichier ou chemin vers le document');
        $form->select('statut', __('Statut'))->options([
            'ACTIVE' => 'Active',
            'EXPIREE' => 'Expirée',
            'SUSPENDUE' => 'Suspendue'
        ])->default('ACTIVE')->required();
        $form->textarea('observation', __('Observation'));

        return $form;
    }
}
