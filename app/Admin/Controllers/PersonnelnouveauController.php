<?php

namespace App\Admin\Controllers;

use App\Models\Personnel;
use App\Models\Personnelannee;
use App\Models\Etablissementannee;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PersonnelnouveauController extends AdminController
{
    /**
     * Titre pour cette ressource.
     *
     * @var string
     */
    protected $title = 'Personnel';

    /**
     * Configuration de la grille (Grid).
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Personnel());

        // Colonnes de la grille
        $grid->column('id', __('ID'));
        $grid->column('matricule', __('Matricule'));
        $grid->column('nom', __('Nom'));
        $grid->column('prenoms', __('Prénoms'));
        $grid->column('sexe', __('Sexe'));
        $grid->column('telephone', __('Téléphone'));

        // Relation : année scolaire via personnelannee -> etablissementannee
        $grid->column('personnelannees.etablissementannee.anneescolaire.libelleanneescolaire', __('Année Scolaire'));
        $grid->column('personnelannees.etablissementannee.etablissement.code', __('Code Établissement'));

        // Ajout de filtres
        $grid->filter(function ($filter) {
            // Filtrer par année scolaire (relation)
            $filter->select('personnelannees.etablissementannee.anneescolaire.id', __('Année Scolaire'))
                ->options(Anneescolaire::pluck('libelleanneescolaire', 'id')->toArray());

            // Filtrer par code établissement (relation)
            $filter->select('personnelannees.etablissementannee.etablissement.id', __('Code Établissement'))
                ->options(Etablissement::pluck('code', 'id')->toArray());

            // Filtrer par nom
            $filter->like('nom', __('Nom'));
        });

        // Recherche rapide (QuickSearch)
        $grid->quickSearch(function ($model, $query) {
            $model->where('nom', 'like', "%{$query}%")
                  ->orWhere('prenoms', 'like', "%{$query}%")
                  ->orWhereHas('personnelannees.etablissementannee', function ($subQuery) use ($query) {
                      $subQuery->whereHas('anneescolaire', function ($nestedQuery) use ($query) {
                          $nestedQuery->where('libelleanneescolaire', 'like', "%{$query}%");
                      })
                      ->orWhereHas('etablissement', function ($nestedQuery) use ($query) {
                          $nestedQuery->where('code', 'like', "%{$query}%");
                      });
                  });
        });

        return $grid;
    }

    /**
     * Configuration de la vue détail (Show).
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Personnel::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('matricule', __('Matricule'));
        $show->field('nom', __('Nom'));
        $show->field('prenoms', __('Prénoms'));
        $show->field('datenaissance', __('Date de naissance'));
        $show->field('lieunaissance', __('Lieu de naissance'));
        $show->field('sexe', __('Sexe'));
        $show->field('telephone', __('Téléphone'));
        $show->field('email', __('Email'));
        $show->field('numeroautorisation', __('Numéro d’autorisation'));
        $show->field('dateautorisation', __('Date d’autorisation'));

        // Relations
        $show->field('personnelannees.etablissementannee.anneescolaire.libelleanneescolaire', __('Année Scolaire'));
        $show->field('personnelannees.etablissementannee.etablissement.code', __('Code Établissement'));

        return $show;
    }

    /**
     * Configuration du formulaire (Form).
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Personnel());

        // Champs du modèle Personnel
        $form->text('matricule', __('Matricule'))->required();
        $form->text('nom', __('Nom'))->required();
        $form->text('prenoms', __('Prénoms'))->required();
        $form->date('datenaissance', __('Date de naissance'))->required();
        $form->text('lieunaissance', __('Lieu de naissance'));
        $form->select('sexe', __('Sexe'))->options(['M' => 'Masculin', 'F' => 'Féminin'])->required();
        $form->text('telephone', __('Téléphone'))->required();
        $form->email('email', __('Email'));
        $form->text('numeroautorisation', __('Numéro d’autorisation'));
        $form->date('dateautorisation', __('Date d’autorisation'))->required();

        // Relation avec Personnelannee
        $form->hasMany('personnelannees', __('Années Associées'), function (Form\NestedForm $nestedForm) {
            // Champs du modèle Personnelannee
            $nestedForm->select('etablissementannees_id', __('Établissement Année'))
                ->options(Etablissement::all()->pluck('denominationetab', 'id'))
                ->required();

            $nestedForm->text('quotahoraire', __('Quota Horaire'))->required();
            $nestedForm->text('nbreheureeffectuee', __('Heures Effectuées'))->required();
        });

        return $form;
    }
}
