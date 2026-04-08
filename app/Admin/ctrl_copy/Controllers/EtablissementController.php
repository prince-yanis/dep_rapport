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
use App\Models\Anneescolaire;
use App\Models\Etablissementannee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\OrdreEnseignement;
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

        $grid->filter(function ($filter) {

            // Remove the default id filter
            $filter->disableIdFilter();

            // $filter->expand();
            $lesordres = array();
            $ordres = OrdreEnseignement::all();
            foreach ($ordres as $ordre) {
                $lesordres[$ordre->id] = $ordre->libelleenseignement;
            }
            $filter->in('ordre_enseignement_id', "ordre d'enseignement")->multipleSelect($lesordres);

            $lesdds = array();
            $dds = Directiondepartementale::all();
            foreach ($dds as $dd) {
                $lesdds[$dd->id] = $dd->denominationdd;
            }
            $filter->in('directiondepartementales_id', "Direction departementale")->multipleSelect($lesdds);
        });
        $grid->quickSearch('denominationetab', 'code');

        $grid->column('id', __('Id'));
        // $grid->column('directiondepartementales_id', __('Directiondepartementales id'));
        $grid->directiondepartementales_id("Direction Départementale")->display(function ($id) {
            $query = Directiondepartementale::find($id);
            return $query ? $query->denominationdd : 'Pas défini';
        });
        // $grid->column('ordre_enseignement_id', __('Ordre enseignement id'));
        $grid->ordre_enseignement_id("Ordre d'enseignement")->display(function ($id) {
            $query = OrdreEnseignement::find($id);
            return $query ? $query->libelleenseignement : 'Pas défini';
        });
        $grid->column('denominationetab', __('Denomination'));
        $grid->column('code', __('Code'));
        $grid->column('date_creation', __("Date de création de l'établissement"));
        $grid->column('date_ouverture', __("Date d'ouverture de l'établissement"));
        $grid->column('localisation', __('Localisation'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('email', __('Email'));
        $grid->column('contact', __('Contact'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('communes_id', __('Communes id'));
        $grid->communes_id()->display(function ($id) {
            $query = Commune::find($id);
            return $query ? $query->denominationcommune : 'Pas défini';
        });

        // Ajouter un bouton "Mettre à jour les usernames"
        $grid->tools(function (Grid\Tools $tools) {
            $url = admin_url('update-usernames'); // route admin
            $tools->append('<a href="' . $url . '" class="btn btn-sm btn-primary">Mettre à jour les usernames</a>');
        });

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
        $show->field('code', __('Code'));
        $show->field('date_creation', __('Date de création de l\'établissement'));
        $show->field('date_ouverture', __('Date d\'ouverture de l\'établissement'));
        $show->field('localisation', __('Localisation'));
        $show->field('adresse', __('Adresse'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('nomfondateur', __('Nomfondateur'));
        $show->field('contact', __('Contact'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('communes_id', __('Communes id'));
        $show->field('directiondepartementales_id', __('Directiondepartementales id'));
        $show->field('ordre_enseignement_id', __('Ordre enseignement id'));

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

        $lesdds = array();
        $dds = Directiondepartementale::all();
        foreach ($dds as $dd) {
            $lesdds[$dd->id] = $dd->denominationdd;
        }
        $form->select('directiondepartementales_id', __('Direction départementale'))->options($lesdds);
        $lescommunes = array();
        $communes = Commune::all();
        foreach ($communes as $commune) {
            $lescommunes[$commune->id] = $commune->denominationcommune;
        }
        $form->select('communes_id', __('Commune'))->options($lescommunes);
        // $form->number('ordre_enseignement_id', __('Ordre enseignement id'));
        $lesordres = array();
        $ordres = OrdreEnseignement::all();
        foreach ($ordres as $ordre) {
            $lesordres[$ordre->id] = $ordre->libelleenseignement;
        }
        $form->select('ordre_enseignement_id', __('Ordre enseignement'))->options($lesordres);
        $form->text('denominationetab', __('Denominationetab'));
        $form->text('code', __('Code'));
        $form->text('date_creation', __('Date de création de l\'établissement'));
        $form->text('date_ouverture', __('Date d\'ouverture de l\'établissement'));
        $form->text('localisation', __('Localisation'));
        $form->text('adresse', __('Adresse'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        // $form->text('nomfondateur', __('Nomfondateur'));
        $form->text('contact', __('Contact'));
        // $form->number('communes_id', __('Communes id'));
        // $form->number('directiondepartementales_id', __('Directiondepartementales id'));
        

        $form->hasMany('etablissementannees', __('Année'), function (Form\NestedForm $form) {
            $lesannees = array();
            $annees = Anneescolaire::all();
            foreach ($annees as $annee) {
                $lesannees[$annee->id] = $annee->libelleanneescolaire;
            }
            $form->select('anneescolaires_id', __('Anneescolaires'))->options($lesannees);
            // $form->number('etablissements_id', __('Etablissements id'));
        });

        $form->saved(function (Form $form) {
            $idEtab = $form->model()->id;
            $code = $form->code;
            // $ordreId = $form->ordre_enseignement_id;

            // Déterminer le suffixe selon l'ordre d'enseignement
            // $suffixe = '';

            // switch ($ordreId) {
            //     case 1: // Exemple : Technique
            //         $suffixe = 'ET';
            //         break;
            //     case 2: // Exemple : Professionnel
            //         $suffixe = 'FP';
            //         break;
            //     default:
            //         break;
            // }

            // Construire le username en mettant le suffixe à la fin du code
            $username = $code;
            // dd($idEtab);
            // Create an user account
            if (!AdminUser::where([
                ['username', '=', $username],
            ])->exists()) {
                $rubric = new AdminUser([
                    'username' => $username,
                    'name' => $username,
                    'idEtab' => $idEtab,
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

    public function updateUsernames()
    {
        // $suffixes = [
        //     1 => 'ET',
        //     2 => 'FP',
        // ];
        // $ignoreIds = [3, 4];

        $etablissements = \App\Models\Etablissement::all();
        $updated = $created = $skipped = 0;

        foreach ($etablissements as $etab) {
            $username = $etab->code;

            $user = \App\Models\AdminUser::where('idEtab', $etab->id)->first();

            if ($user) {
                // Mise à jour
                if ($user->username !== $username) {
                    if (\App\Models\AdminUser::where('username', $username)->exists()) {
                        $skipped++;
                        continue;
                    }

                    $user->update([
                        'username' => $username,
                        'name' => $etab->denominationetab,
                    ]);

                    $updated++;
                } else {
                    // On met quand même à jour le nom si besoin
                    if ($user->name !== $etab->denominationetab) {
                        $user->update(['name' => $etab->denominationetab]);
                        $updated++;
                    }
                }
            } else {
                // Création
                if (\App\Models\AdminUser::where('username', $username)->exists()) {
                    $skipped++;
                    continue;
                }

                $newUser = \App\Models\AdminUser::create([
                    'username' => $username,
                    'name' => $etab->denominationetab,
                    'idEtab' => $etab->id,
                    'password' => \Hash::make('00000000'),
                ]);

                if ($role = \App\Models\AdminRole::where('slug', 'etablissements')->first()) {
                    \App\Models\AdminRoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => $role->id,
                    ]);
                }

                $created++;
            }
        }

        admin_toastr("✅ Usernames mis à jour : {$updated}, créés : {$created}, ignorés (doublons) : {$skipped}");
        return redirect()->back();
    }
}
