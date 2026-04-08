<?php

namespace App\Admin\Controllers;

use App\Models\Activitesportive;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Models\Anneescolaire;
use App\Models\Apprenantannee;
use App\Models\Association;
use App\Models\Classe;
use App\Models\Demarrageannee;
use App\Models\Equipement;
use App\Models\Filiereenseigne;
use App\Models\Parametresglobaux;

use App\Models\Etablissementannee;
use App\Models\Infrastructure;
use App\Models\Personnelannee;
use App\Models\ProblemeUrgent;
use App\Models\SportEtab;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Encore\Admin\Controllers\AdminController;

class DemarrageanneeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Demarrageannee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Demarrageannee());

        $grid->column('id', __('Id'));
        $grid->column('nouvelan', __('Nouvelan'));
        $grid->column('anpreccedent', __('Anpreccedent'));

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
        $show = new Show(Demarrageannee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nouvelan', __('Nouvelan'));
        $show->field('anpreccedent', __('Anpreccedent'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    /*protected function form()
    {
        $form = new Form(new Demarrageannee());

        // $form->date('nouvelan', __('Nouvelan'))->default(date('Y-m-d'));
        // $form->date('anpreccedent', __('Anpreccedent'))->default(date('Y-m-d'));

        $anneescolaires_id = Parametresglobaux::find(1)->anneescolaires_id; // Récupérer uniquement anneescolaires_id

        $form->select('anpreccedent', __('Année scolaire précédente'))
            ->options(Anneescolaire::all()->pluck('libelleanneescolaire', 'id'))
            ->default($anneescolaires_id)
            ->readonly();

        $form->select('nouvelan', __('Année scolaire en cours'))
            ->options(Anneescolaire::all()->pluck('libelleanneescolaire', 'id'));

        $form->setAction('demaragenouvelannee');
        return $form;
    } */

    // public function valider(Request $request)
    // {
    //     $anneescolaire = Parametresglobaux::find(1)->anneescolaires_id;

    //     $donnees = $request->all();

    //     if ($donnees) {

    //         $nouvelan = $donnees['nouvelan'];
    //         $anpreccedent = $donnees['anpreccedent'];
    //         $etablissements = Etablissementannee::where('anneescolaires_id', '=', $anpreccedent)->->get();
    //         foreach ($etablissements as $etab) {
    //             $donneesetab = [
    //                 'exixtecloture' => $etab->existecloture,
    //                 'problemeequipement' => $etab->problemeequipement,
    //                 'anneescolaires_id' => $nouvelan,
    //                 'etablissements_id' => $etab->etablissements_id,
    //                 'periodesannuelle_id' => $etab->periodesannuelle_id
    //             ];
    //             $idInsere = Etablissementannee::create($donneesetab);
    //             // if($idInsere){
    //             //insertion dans filieres enseignés	
    //             /* $filieresenseignes=Filiereenseigne::where('etablissementannees_id','=',$etab->id)->get();
    // 				foreach($filieresenseignes as $filiere){
    // 					$donneesfiliere=[
    // 						'numautorisationouverture'=>$filiere->existecloture,
    // 						'dureeformation'=>$filiere->problemeequipement,
    // 						'observation'=>$filiere->observation,
    // 						'filieres_id'=>$filiere->filieres_id,
    // 						'diplomeprepares_id'=>$filiere->diplomeprepares_id,
    // 						'etablissementannees_id'=>$idInsere													
    // 					];
    // 					$idfilieree=Filiereenseigne::create($donneesfiliere);
    // 				}*/
    //             //insertion dans infrastructure
    //             //insertion dans equipement
    //             //insertion dans sportetab
    //             //insertion dans personnelannee
    //             //insertion dans association

    //             // }
    //         }
    //     }
    //     $success = new MessageBag([
    //         'title'   => 'Configuration d\'une nouvelle année scolaire',
    //         'message' => "La nouvelle année a été configurée avec succès.",
    //     ]);
    //     return back()->with(compact('success'));
    // }
    protected function form()
    {
        $form = new Form(new Demarrageannee());

        // Retrieve the current 'anneescolaires_id' for setting the default value
        $anneescolaires_id = Parametresglobaux::find(1)->anneescolaires_id;

        // Fetch all options for school years only once
        $anneesOptions = Anneescolaire::all()->pluck('libelleanneescolaire', 'id');

        // Populate previous and current school year selectors
        $form->select('anpreccedent', __('Année scolaire précédente'))
            ->options($anneesOptions)
            ->default($anneescolaires_id);
        // ->readonly();

        $form->select('nouvelan', __('Année scolaire en cours'))
            ->options($anneesOptions);

        // $form->setAction('demaragenouvelannee');
        $form->saved(function (Form $form) {
            $donnees = $form->model()->toArray();
            if ($donnees) {
                // Définir les options pour une lecture efficace des fichiers volumineux
                set_time_limit(0); // Supprime la limite de temps d'exécution
                ini_set('memory_limit', '512M'); // Augmente la limite de mémoire

                $nouvelan = $donnees['nouvelan'];
                $anpreccedent = $donnees['anpreccedent'];
                // $etablissements = Etablissementannee::where('anneescolaires_id', '=', $anpreccedent)->where('etablissements_id', '=', 1)->get();
                $etablissements = Etablissementannee::where('anneescolaires_id', '=', $anpreccedent)->get();
                foreach ($etablissements as $etab) {
                    $donneesetab = [
                        'existecloture' => $etab->existecloture,
                        'problemeequipement' => $etab->problemeequipement,
                        'anneescolaires_id' => $nouvelan,
                        'etablissements_id' => $etab->etablissements_id,
                        'periodesannuelle_id' => $etab->periodesannuelle_id
                    ];
                    $etablissementAnnee = Etablissementannee::updateOrCreate($donneesetab);
                    if ($etablissementAnnee) {

                        $apprenantData = DB::table('apprenantannees')
                            ->join('classes', 'apprenantannees.classes_id', '=', 'classes.id')
                            ->join('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
                            ->join('niveau', 'groupepedagogiques.niveau_id', '=', 'niveau.id')
                            ->join('filieres', 'groupepedagogiques.filieres_id', '=', 'filieres.id')
                            ->where('apprenantannees.etablissementannees_id', '=', $etab->id)
                            ->whereNotIn('niveau.id', [3, 6])
                            ->select('apprenantannees.*') // Sélectionner uniquement les colonnes nécessaires
                            ->get();

                        foreach ($apprenantData as $apprenant) {
                            $donneesapprenants = [
                                'bourses_id' => $apprenant->bourses_id,
                                'statutapprenants_id' => $apprenant->statutapprenants_id,
                                'apprenants_id' => $apprenant->apprenants_id,
                                'etablissementannees_id' => $etablissementAnnee->id
                            ];
                            Apprenantannee::create($donneesapprenants);
                        }
                    }
                }

                $parametres = Parametresglobaux::find(1);
                if ($parametres) {
                    $parametres->update(['anneescolaires_id' => $nouvelan]);
                }
            }
            $success = new MessageBag([
                'title'   => 'Configuration d\'une nouvelle année scolaire',
                'message' => "La nouvelle année a été configurée avec succès.",
            ]);
            return back()->with(compact('success'));
        });
        return $form;
    }
    // {
    //     // Replicate 'Filiereenseigne' data if needed
    //     $filieresenseignes = Filiereenseigne::where('etablissementannees_id', '=', $etab->id)->get();
    //     foreach ($filieresenseignes as $filiere) {
    //         $donneesfiliere = [
    //             'numautorisationouverture' => $filiere->existecloture,
    //             'dureeformation'           => $filiere->problemeequipement,
    //             'observation'              => $filiere->observation,
    //             'filieres_id'              => $filiere->filieres_id,
    //             'diplomeprepares_id'       => $filiere->diplomeprepares_id,
    //             'etablissementannees_id'    => $newEtabId
    //         ];
    //         Filiereenseigne::create($donneesfiliere);
    //     }
    // }

}
