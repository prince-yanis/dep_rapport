<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use App\Models\Apprenant;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use Encore\Admin\Widgets\Box;
use App\Models\Apprenantannee;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Models\Parametresglobaux;
use Encore\Admin\Widgets\InfoBox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Admin;


class HomeController extends Controller
{
    public function index(Content $content)
    {
        $user = Auth::guard('admin')->user();
        $role = AdminRoleUser::where('user_id', $user->id)->first();

        $parametresglobaux = Parametresglobaux::findorFail(1);
        $idAnneeScolaire = $parametresglobaux->anneescolaires_id;
        session(['anneescolaireactuelle' => $idAnneeScolaire]);

        session(['etablissementchoisi' => $user->idEtab]);


        if (in_array($role->role_id, array(1))) {
            // Compter le nombre d'hommes, de femmes
            $maleCount = DB::table('apprenantannees')
                ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', "apprenants.id")
                ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', "etablissementannees.id")
                ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                ->where('apprenants.sexe', 'M')
                ->count();

            $femaleCount = DB::table('apprenantannees')
                ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', "apprenants.id")
                ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', "etablissementannees.id")
                ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                ->where('apprenants.sexe', 'F')
                ->count();

            $parametresglobaux = Parametresglobaux::findorFail(1);
            $idAnneeScolaire = $parametresglobaux->anneescolaires_id;

            // Récupérer l'année scolaire correspondante
            $anneeScolaire = Anneescolaire::findOrFail($idAnneeScolaire);
            // Récupérer la valeur de rapport1
            $rapportrentree = $anneeScolaire->rapport1;

            // Calculer la différence en jours
            $rapport1 = Carbon::parse($rapportrentree);
            $today = Carbon::now();
            $daysDifference = $today->diffInDays($rapport1);

            // Ajouter un message à la session pour le popup
            session()->flash('popup_message', 'Bienvenue dans l\'interface d\'administration ! Jours restants: ' . $daysDifference);

            session(['popup_message' => 'Votre message personnalisé ici.']);


            // Créer une box contenant le graphique
            $chartBox = $this->generateChart($maleCount, $femaleCount);
            //Type d'etablissement

            $etab_tech = DB::table('etablissementannees')
                ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', "etablissements.id")
                ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', "ordre_enseignement.id")
                ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                ->where("ordre_enseignement.id", 1)
                ->where("etablissementannees.fonctionnel", 1)
                ->count();

            $etab_prof = DB::table('etablissementannees')
                ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', "etablissements.id")
                ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', "ordre_enseignement.id")
                ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                ->where("ordre_enseignement.id", 2)
                ->where("etablissementannees.fonctionnel", 1)
                ->count();

            $etab_sup = DB::table('etablissementannees')
                ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', "etablissements.id")
                ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', "ordre_enseignement.id")
                ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                ->where("ordre_enseignement.id", 3)
                ->where("etablissementannees.fonctionnel", 1)
                ->count();

            // dd($etab_tech);

            $chartboxetab = $this->generateChartEtab($etab_tech, $etab_prof, $etab_sup);


            //Etablissemnt visité

            $etab_visite = DB::table('mission')
                ->leftjoin('etablissementannees', 'mission.etablissementannees_id', '=', "etablissementannees.id")
                ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                ->where('mission.visite', 1)
                ->count();

            $etab_non_visite = DB::table('mission')
                ->leftjoin('etablissementannees', 'mission.etablissementannees_id', '=', "etablissementannees.id")
                ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                ->where('mission.visite', 0)
                ->count();

            $chartboxetabvisite = $this->generateChartEtabVisit($etab_visite, $etab_non_visite);
            Admin::html('
    <div class="modal fade" id="adminPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="adminPopupLabel">Alerte</h3>
                    
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h1 style="color: red; text-transform:uppercase; animation: clignoter 1s infinite alternate;" class="clignotant">Jour J -  <span id="daysDifference"></span></h1>
                    <h3>Date limite du dépôt des rapports de rentrée</h3>
                </div>
                <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
                
            </div>
        </div>
    </div>
    <style>
    @keyframes clignoter {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }
</style
');



            Admin::script('
$(document).ready(function() {
    // Récupérer la différence de jours
    var daysDifference = ' . $daysDifference . ';

    // Vérifier si la différence est supérieure à un certain seuil (par exemple 0 jours)
    if (daysDifference > 0) {
        // Mettre la différence dans le modal
        $("#daysDifference").text(daysDifference);
        $("#adminPopup").modal("show");
    }
});
');

            return $content
                ->title('Tableau de bord')
                ->description(' ')
                ->row(function (Row $row) {

                    $parametresglobaux = Parametresglobaux::findorFail(1);
                    $idAnneeScolaire = $parametresglobaux->anneescolaires_id;

                    // Récupérer l'année scolaire correspondante
                    $anneeScolaire = Anneescolaire::findOrFail($idAnneeScolaire);
                    // Récupérer la valeur de rapport1
                    $rapportrentree = $anneeScolaire->rapport1;

                    // Calculer la différence en jours
                    $rapport1 = Carbon::parse($rapportrentree);
                    $today = Carbon::now();
                    $daysDifference = $today->diffInDays($rapport1);

                    // Ajouter un message à la session pour le popup
                    session()->flash('popup_message', 'Bienvenue dans l\'interface d\'administration ! Jours restants: ' . $daysDifference);

                    $etablissements = DB::table('etablissements')->count();
                    $apprenants = DB::table('apprenants')->count();
                    $drs = DB::table('directionregionales')->count();
                    $dds = DB::table('directiondepartementales')->count();
                    $communes = DB::table('communes')->count();
                    $departements = DB::table('departements')->count();
                    $regions = DB::table('regions')->count();

                    // dd($daysDifference);

                    $parametresglobaux = Parametresglobaux::findOrFail(1);
                    $idAnneeScolaire = $parametresglobaux->anneescolaires_id;
                    $anneeScolaire = Anneescolaire::find($idAnneeScolaire)->libelleanneescolaire;
                    $row->column(4, $infoBox = new InfoBox('Année scolaire (en cours)', '', 'red', '',  $anneeScolaire));
                    $row->column(4, $infoBox = new InfoBox('Jours restants avant la fin du dépot des rapports de rentrée', '', 'red', '',  $daysDifference));
                    $row->column(4, $infoBox = new InfoBox("Nombre d'établissements", 'signal', 'aqua', '', $etablissements));
                    $row->column(4, $infoBox = new InfoBox("Nombre total d'apprenants", 'num', 'orange', '', $apprenants));
                    $row->column(4, $infoBox = new InfoBox('Début de rentrée', 'file', 'aqua', '/admin/etablissements2/', 'Rapport'));
                    $row->column(4, $infoBox = new InfoBox('Fin de 1er Semestre', 'file', 'green', '/admin/etablissements1er/', 'Rapport'));
                    $row->column(4, $infoBox = new InfoBox('Fin d année', 'file', 'yellow', '/admin/etablissements2eme/', 'Rapport'));
                    $row->column(6, $infoBox = new InfoBox('Nombre de Directions Régionales', 'signal', 'green', '', $drs));
                    $row->column(6, $infoBox = new InfoBox('Nombre de Directions Départementales', 'signal', 'yellow', '', $dds));
                    $row->column(4, $infoBox = new InfoBox('Nombre de Communes', 'signal', 'yellow', '', $communes));
                    $row->column(4, $infoBox = new InfoBox('Nombre de Departements', 'signal', 'red', '', $departements));
                    $row->column(4, $infoBox = new InfoBox('Nombre de Régions', 'signal', 'aqua', '', $regions));
                })
                ->row(function ($row) use ($chartBox, $chartboxetab, $chartboxetabvisite) {
                    $row->column(4, $chartBox);  // Graphique dans un col-6 à gauche
                    // Ajoute ici un autre contenu dans le col-6 droit si besoin
                    $row->column(4, $chartboxetab);

                    $row->column(4, $chartboxetabvisite);
                });
        } else {

            if ($user->idEtab) {
                session(['etablissementchoisi' => $user->idEtab]);
                $parametresglobaux = Parametresglobaux::findorFail(1);
                $idAnneeScolaire = $parametresglobaux->anneescolaires_id;

                // Récupérer l'année scolaire correspondante
                $anneeScolaire = Anneescolaire::findOrFail($idAnneeScolaire);
                // Récupérer la valeur de rapport1
                $rapportrentree = $anneeScolaire->rapport1;

                // Calculer la différence en jours
                $rapport1 = Carbon::parse($rapportrentree);
                $today = Carbon::now();
                $daysDifference = $today->diffInDays($rapport1);
                Admin::html('
    <div class="modal fade" id="adminPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="adminPopupLabel">Alerte</h3>
                   
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h1 style="color: red; text-transform:uppercase; animation: clignoter 1s infinite alternate;" class="clignotant">Jour J -  <span id="daysDifference"></span></h1>
                    <h3>Date limite du dépôt des rapports de rentrée</h3>
                </div>
                <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
                
            </div>
        </div>
    </div>
    <style>
    @keyframes clignoter {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }
</style
');



                Admin::script('
$(document).ready(function() {
    // Récupérer la différence de jours
    var daysDifference = ' . $daysDifference . ';

    // Vérifier si la différence est supérieure à un certain seuil (par exemple 0 jours)
    if (daysDifference > 0) {
        // Mettre la différence dans le modal
        $("#daysDifference").text(daysDifference);
        $("#adminPopup").modal("show");
    }
});
');

                $maleCount = DB::table('apprenantannees')
                    ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', "apprenants.id")
                    ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', "etablissementannees.id")
                    ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', "etablissements.id")
                    ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                    ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                    ->where('apprenants.sexe', 'M')
                    ->where('etablissements.id', session('etablissementchoisi'))
                    ->count();

                $femaleCount =  DB::table('apprenantannees')
                    ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', "apprenants.id")
                    ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', "etablissementannees.id")
                    ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', "etablissements.id")
                    ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', "anneescolaires.id")
                    ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
                    ->where('apprenants.sexe', 'F')
                    ->where('etablissements.id', session('etablissementchoisi'))
                    ->count();

                $chartBox = $this->generateChart($maleCount, $femaleCount);

                return $content
                    ->title('Tableau de bord')
                    ->description(' ')
                    ->row(function (Row $row) {

                        $parametresglobaux = Parametresglobaux::findOrFail(1);
                        $idAnneeScolaire = $parametresglobaux->anneescolaires_id;
                        $anneeScolaire = Anneescolaire::find($idAnneeScolaire)->libelleanneescolaire;

                        $row->column(12, $infoBox = new InfoBox('Année scolaire (en cours)', 'check', 'red', '',  $anneeScolaire));
                        $row->column(4, $infoBox = new InfoBox('Début de rentrée', 'file', 'aqua', '', 'Rapport'));
                        $row->column(4, $infoBox = new InfoBox('Fin de 1er Semestre', 'file', 'green', '', 'Rapport'));
                        $row->column(4, $infoBox = new InfoBox('Fin d année', 'file', 'yellow', '', 'Rapport'));
                    })
                    ->row(function ($row) use ($chartBox) {
                        $row->column(6, $chartBox);  // Graphique dans un col-6 à gauche
                        // Ajoute ici un autre contenu dans le col-6 droit si besoin
                        $row->column(6, '');  // Graphique dans un col-6 à gauche
                    });

                // return redirect('/admin/etablissementdetails/'.$user->idEtab.'/edit');
            } else {
                $parametresglobaux = Parametresglobaux::findorFail(1);
                $idAnneeScolaire = $parametresglobaux->anneescolaires_id;

                // Récupérer l'année scolaire correspondante
                $anneeScolaire = Anneescolaire::findOrFail($idAnneeScolaire);
                // Récupérer la valeur de rapport1
                $rapportrentree = $anneeScolaire->rapport1;

                // Calculer la différence en jours
                $rapport1 = Carbon::parse($rapportrentree);
                $today = Carbon::now();
                $daysDifference = $today->diffInDays($rapport1);
                Admin::html('
    <div class="modal fade" id="adminPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="adminPopupLabel">Alerte</h3>
                    
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h1 style="color: red; text-transform:uppercase; animation: clignoter 1s infinite alternate;" class="clignotant">Jour J -  <span id="daysDifference"></span></h1>
                    <h3>Date limite du dépôt des rapports de rentrée</h3>
                </div>
                <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
                
            </div>
        </div>
    </div>
    <style>
    @keyframes clignoter {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }
</style
');



                Admin::script('
$(document).ready(function() {
    // Récupérer la différence de jours
    var daysDifference = ' . $daysDifference . ';

    // Vérifier si la différence est supérieure à un certain seuil (par exemple 0 jours)
    if (daysDifference > 0) {
        // Mettre la différence dans le modal
        $("#daysDifference").text(daysDifference);
        $("#adminPopup").modal("show");
    }
});
');
                return $content
                    ->title('Tableau de bord')
                    ->description(' ')
                    ->row(function (Row $row) {

                        $etablissements = DB::table('etablissements')->count();
                        $apprenants = DB::table('apprenants')->count();
                        $drs = DB::table('directionregionales')->count();
                        $dds = DB::table('directiondepartementales')->count();
                        $communes = DB::table('communes')->count();
                        $departements = DB::table('departements')->count();
                        $regions = DB::table('regions')->count();

                        $parametresglobaux = Parametresglobaux::findOrFail(1);
                        $idAnneeScolaire = $parametresglobaux->anneescolaires_id;
                        $anneeScolaire = Anneescolaire::find($idAnneeScolaire)->libelleanneescolaire;
                        $row->column(4, $infoBox = new InfoBox('Année scolaire (en cours)', '', 'red', '',  $anneeScolaire));
                        $row->column(4, $infoBox = new InfoBox("Nombre d'établissements", 'signal', 'aqua', '', $etablissements));
                        $row->column(4, $infoBox = new InfoBox("Nombre total d'apprenants", 'num', 'orange', '', $apprenants));
                        $row->column(4, $infoBox = new InfoBox('Début de rentrée', 'file', 'aqua', '/admin/etablissements2/', 'Rapport'));
                        $row->column(4, $infoBox = new InfoBox('Fin de 1er Semestre', 'file', 'green', '/admin/etablissements1er/', 'Rapport'));
                        $row->column(4, $infoBox = new InfoBox('Fin d année', 'file', 'yellow', '/admin/etablissements2eme/', 'Rapport'));
                        $row->column(6, $infoBox = new InfoBox('Nombre de Directions Régionales', 'signal', 'green', '', $drs));
                        $row->column(6, $infoBox = new InfoBox('Nombre de Directions Départementales', 'signal', 'yellow', '', $dds));
                        $row->column(4, $infoBox = new InfoBox('Nombre de Communes', 'signal', 'yellow', '', $communes));
                        $row->column(4, $infoBox = new InfoBox('Nombre de Departements', 'signal', 'red', '', $departements));
                        $row->column(4, $infoBox = new InfoBox('Nombre de Régions', 'signal', 'aqua', '', $regions));
                    });
            }
        }
    }

    protected function generateChart($maleCount, $femaleCount)
    {
        // Préparer les données pour le graphique
        $data = [
            'labels' => ['Hommes', 'Femmes'],
            'data' => [$maleCount, $femaleCount]
        ];

        // Rendre la vue du graphique
        $chart = view('admin.chart', compact('data'))->render();

        // Encapsuler dans une box
        $box = new Box('Répartition par sexe', $chart);

        return $box;
    }

    protected function generateChartEtab($etab_tech, $etab_prof, $etab_sup)
    {
        // Préparer les données pour le graphique
        $data = [
            'labels' => ['Enseignement Technique', 'Formation Professionnelle', 'Enseignement Supérieur'],
            'data' => [$etab_tech, $etab_prof, $etab_sup]
        ];

        // dd($data);

        // Rendre la vue du graphique
        $chart = view('admin.chart_etab', compact('data'))->render();

        // Encapsuler dans une box
        $box = new Box("Répartition par type d'établissement", $chart);

        return $box;
    }


    protected function generateChartEtabVisit($etab_visite, $etab_non_visite)
    {
        // Préparer les données pour le graphique
        $data = [
            'labels' => ['Visité', 'Non visité'],
            'data' => [$etab_visite, $etab_non_visite]
        ];

        // dd($data);

        // Rendre la vue du graphique
        $chart = view('admin.chart_visit', compact('data'))->render();

        // Encapsuler dans une box
        $box = new Box("Répartition des établissements visités et non vistités", $chart);

        return $box;
    }
}
