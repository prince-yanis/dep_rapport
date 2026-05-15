<?php

namespace App\Admin\Controllers;

use App\Models\Suivistage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;

class SuivistageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Suivistage';
    
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
        $grid = new Grid(new Suivistage());
        
        $userRole = $this->getUserRole();
        
        // Apply role-based filtering
        switch ($userRole['role']) {
            case 'admin':
                // Admin sees everything
                $grid->model()->with(['stage.entreprise', 'stage.apprenantannee']);
                break;
                
            case 'etablissement':
                // Etablissement sees only their suivistages
                $grid->model()->with(['stage.entreprise', 'stage.apprenantannee'])
                    ->whereHas('stage.apprenantannee', function($query) use ($userRole) {
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
        $grid->column('stage.apprenantannee.apprenant.nom_complet', __('Apprenant'));
        $grid->column('stage.entreprise.raison_sociale', __('Entreprise'));
        $grid->column('date_visite', __('Date visite'))->sortable();
        $grid->column('type_suivi', __('Type suivi'))->display(function ($value) {
            $colors = [
                'VISITE' => 'primary',
                'APPEL' => 'info',
                'REUNION' => 'warning',
                'EVALUATION' => 'success',
                'AUTRE' => 'default'
            ];
            $color = $colors[$value] ?? 'default';
            return '<span class="label label-' . $color . '">' . $value . '</span>';
        });
        $grid->column('encadreur', __('Encadreur'));
        $grid->column('compte_rendu', __('Compte rendu'))->limit(50);
        $grid->column('created_at', __('Created at'));
        
        $grid->filter(function($filter){
            $filter->equal('stages_id', 'Stage')->select(function () {
                return \App\Models\Stage::with(['entreprise', 'apprenantannee'])
                    ->get()
                    ->map(function ($stage) {
                        return [
                            'id' => $stage->id,
                            'text' => $stage->apprenantannee->nom_complet . ' - ' . $stage->entreprise->raison_sociale
                        ];
                    })
                    ->pluck('text', 'id');
            });
            $filter->equal('type_suivi', 'Type de suivi')->select([
                'VISITE' => 'Visite',
                'APPEL' => 'Appel téléphonique',
                'REUNION' => 'Réunion',
                'EVALUATION' => 'Évaluation',
                'AUTRE' => 'Autre'
            ]);
            $filter->between('date_visite', 'Date de visite')->date();
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
        $show = new Show(Suivistage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('stage.apprenantannee.apprenant.nom_complet', __('Apprenant'));
        $show->field('stage.entreprise.raison_sociale', __('Entreprise'));
        $show->field('date_visite', __('Date visite'));
        $show->field('type_suivi', __('Type suivi'))->as(function ($value) {
            $labels = [
                'VISITE' => 'Visite',
                'APPEL' => 'Appel téléphonique',
                'REUNION' => 'Réunion',
                'EVALUATION' => 'Évaluation',
                'AUTRE' => 'Autre'
            ];
            return $labels[$value] ?? $value;
        });
        $show->field('compte_rendu', __('Compte rendu'));
        $show->field('difficultes', __('Difficultes'));
        $show->field('decision', __('Decision'));
        $show->field('encadreur', __('Encadreur'));
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
        $form = new Form(new Suivistage());
        
        // Disable form for non-managing users
        if (!$this->canManageData()) {
            $form->disableEditing();
            $form->disableCreating();
            return $form;
        }
        
        $userRole = $this->getUserRole();

        $form->select('stages_id', __('Stage'))->options(function () use ($userRole) {
            $query = \App\Models\Stage::with(['entreprise', 'apprenantannee.apprenant']);
            
            // Filter by etablissement for etablissement role
            if ($userRole['role'] === 'etablissement') {
                $query->whereHas('apprenantannee', function($q) use ($userRole) {
                    $q->where('etablissementannees_id', $userRole['etablissement_id']);
                });
            }
            
            return $query->get()
                ->map(function ($stage) {
                    return [
                        'id' => $stage->id,
                        'text' => $stage->apprenantannee->apprenant->nom_complet . ' - ' . $stage->entreprise->raison_sociale
                    ];
                })
                ->pluck('text', 'id');
        })->required();
        $form->date('date_visite', __('Date visite'))->default(date('Y-m-d'));
        $form->select('type_suivi', __('Type suivi'))->options([
            'VISITE' => 'Visite',
            'APPEL' => 'Appel téléphonique',
            'REUNION' => 'Réunion',
            'EVALUATION' => 'Évaluation',
            'AUTRE' => 'Autre'
        ])->default('VISITE')->required();
        $form->textarea('compte_rendu', __('Compte rendu'))->rows(4);
        $form->textarea('difficultes', __('Difficultes'))->rows(4);
        $form->textarea('decision', __('Decision'))->rows(4);
        $form->text('encadreur', __('Encadreur'));

        return $form;
    }
}
