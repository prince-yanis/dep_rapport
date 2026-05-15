<?php

namespace App\Admin\Controllers;

use App\Models\Stage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;

class StageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Stage';
    
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
        $grid = new Grid(new Stage());
        
        $userRole = $this->getUserRole();
        
        // Apply role-based filtering
        switch ($userRole['role']) {
            case 'admin':
                // Admin sees everything
                $grid->model()->with(['entreprise', 'apprenantannee']);
                break;
                
            case 'etablissement':
                // Etablissement sees only their stages
                $grid->model()->with(['entreprise', 'apprenantannee'])
                    ->whereHas('apprenantannee', function($query) use ($userRole) {
                        $query->where('etablissementannees_id', $userRole['etablissement_id']);
                    });
                break;
                
            case 'other':
            default:
                // Other roles - no access
                $grid->model()->whereRaw('1 = 0');
                break;
        }
        
        $grid->column('id', __('Id'));
        $grid->column('apprenantannee.apprenant.nom_complet', __('Apprenant'))->sortable();
        $grid->column('entreprise.raison_sociale', __('Entreprise'))->sortable();
        $grid->column('date_debut', __('Date debut'))->sortable();
        $grid->column('date_fin', __('Date fin'))->sortable();
        $grid->column('theme_stage', __('Theme stage'));
        $grid->column('service_affectation', __('Service affectation'));
        $grid->column('tuteur_entreprise', __('Tuteur entreprise'));
        $grid->column('statut_stage', __('Statut stage'))->display(function ($value) {
            $colors = [
                'EN_ATTENTE' => 'warning',
                'AFFECTE' => 'info', 
                'EN_COURS' => 'primary',
                'TERMINE' => 'success',
                'ABANDONNE' => 'danger',
                'VALIDE' => 'success'
            ];
            $color = $colors[$value] ?? 'default';
            return '<span class="label label-' . $color . '">' . $value . '</span>';
        });
        $grid->column('note_stage', __('Note stage'))->sortable();
        $grid->column('rapport_depose', __('Rapport depose'))->display(function ($value) {
            return $value ? '<span class="label label-success">Oui</span>' : '<span class="label label-danger">Non</span>';
        });
        $grid->column('soutenance_effectuee', __('Soutenance effectuee'))->display(function ($value) {
            return $value ? '<span class="label label-success">Oui</span>' : '<span class="label label-danger">Non</span>';
        });
        $grid->column('created_at', __('Created at'));
        
        $grid->filter(function($filter){
            $filter->like('theme_stage', 'Thème de stage');
            $filter->equal('statut_stage', 'Statut')->select([
                'EN_ATTENTE' => 'En attente',
                'AFFECTE' => 'Affecté',
                'EN_COURS' => 'En cours',
                'TERMINE' => 'Terminé',
                'ABANDONNE' => 'Abandonné',
                'VALIDE' => 'Validé'
            ]);
            $filter->between('date_debut', 'Date de début')->date();
            $filter->between('date_fin', 'Date de fin')->date();
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
        $show = new Show(Stage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('apprenantannee.apprenant.nom_complet', __('Apprenant'));
        $show->field('entreprise.raison_sociale', __('Entreprise'));
        $show->field('date_debut', __('Date debut'));
        $show->field('date_fin', __('Date fin'));
        $show->field('theme_stage', __('Theme stage'));
        $show->field('service_affectation', __('Service affectation'));
        $show->field('tuteur_entreprise', __('Tuteur entreprise'));
        $show->field('statut_stage', __('Statut stage'))->as(function ($value) {
            $labels = [
                'EN_ATTENTE' => 'En attente',
                'AFFECTE' => 'Affecté',
                'EN_COURS' => 'En cours',
                'TERMINE' => 'Terminé',
                'ABANDONNE' => 'Abandonné',
                'VALIDE' => 'Validé'
            ];
            return $labels[$value] ?? $value;
        });
        $show->field('note_stage', __('Note stage'));
        $show->field('rapport_depose', __('Rapport depose'))->as(function ($value) {
            return $value ? 'Oui' : 'Non';
        });
        $show->field('soutenance_effectuee', __('Soutenance effectuee'))->as(function ($value) {
            return $value ? 'Oui' : 'Non';
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
        $form = new Form(new Stage());
        
        // Disable form for non-managing users
        if (!$this->canManageData()) {
            $form->disableEditing();
            $form->disableCreating();
            return $form;
        }
        
        $userRole = $this->getUserRole();

        $form->select('apprenantannees_id', __('Apprenant'))->options(function () use ($userRole) {
            $query = \App\Models\Apprenantannee::with('apprenant');
            
            // Filter by etablissement for etablissement role
            if ($userRole['role'] === 'etablissement') {
                $query->where('etablissementannees_id', $userRole['etablissement_id']);
            }
            
            return $query->get()
                ->map(function ($apprenantannee) {
                    return [
                        'id' => $apprenantannee->id,
                        'text' => $apprenantannee->apprenant->nom_complet
                    ];
                })
                ->pluck('text', 'id');
        })->required();
        $form->select('entreprises_id', __('Entreprise'))->options(function () {
            return \App\Models\Entreprise::pluck('raison_sociale', 'id');
        })->required();
        $form->date('date_debut', __('Date debut'))->default(date('Y-m-d'));
        $form->date('date_fin', __('Date fin'))->default(date('Y-m-d'));
        $form->text('theme_stage', __('Theme stage'));
        $form->text('service_affectation', __('Service affectation'));
        $form->text('tuteur_entreprise', __('Tuteur entreprise'));
        $form->text('telephone_tuteur', __('Telephone tuteur'));
        $form->text('email_tuteur', __('Email tuteur'));
        $form->select('statut_stage', __('Statut stage'))->options([
            'EN_ATTENTE' => 'En attente',
            'AFFECTE' => 'Affecté',
            'EN_COURS' => 'En cours',
            'TERMINE' => 'Terminé',
            'ABANDONNE' => 'Abandonné',
            'VALIDE' => 'Validé'
        ])->default('EN_ATTENTE')->required();
        $form->decimal('note_stage', __('Note stage'))->help('Note sur 20 (entre 0 et 20)');
        $form->switch('rapport_depose', __('Rapport depose'))->help('Cochez si le rapport a été déposé');
        $form->switch('soutenance_effectuee', __('Soutenance effectuee'))->help('Cochez si la soutenance a été effectuée');
        $form->textarea('observation', __('Observation'));

        return $form;
    }
}
