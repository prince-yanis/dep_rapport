<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class GeneratepdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function missionpdf($id)
    {
        // Get the mission ID from the session
        // $missionId = Session::get('mission');

        // Ensure the mission ID exists
        // if (!$missionId) {
        //     return redirect()->back()->withErrors(['message' => 'No mission ID found in session.']);
        // }

        $query1 = DB::table('mission')
            ->select(
                'etablissements.id as etablissement_id',
                "etablissements.*",
                'anneescolaires.libelleanneescolaire',
                'ordre_enseignement.libelleenseignement',
                'directiondepartementales.denominationdd',
                'directionregionales.denominationdr',
                'communes.denominationcommune',
                'departements.denominationdepartement'
            )
            ->leftJoin('etablissementannees', 'mission.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftJoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->leftJoin('directiondepartementales', 'etablissements.directiondepartementales_id', '=', 'directiondepartementales.id')
            ->leftJoin('directionregionales', 'directiondepartementales.directionregionales_id', '=', 'directionregionales.id')
            ->leftJoin('communes', 'etablissements.communes_id', '=', 'communes.id')
            ->leftJoin('departements', 'communes.departements_id', '=', 'departements.id')
            ->where('mission.id', $id)
            ->first();

        $filiere_autorises = DB::table('filiereautorises')
            ->leftjoin('resultatsmission', 'filiereautorises.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftjoin('mission', 'resultatsmission.mission_id', '=', 'mission.id')
            ->leftjoin('diplomeprepares', 'filiereautorises.diplomeprepares_id', '=', 'diplomeprepares.id')
            ->leftjoin('filieres', 'filiereautorises.filieres_id', '=', 'filieres.id')
            ->leftJoin('ordre_enseignement', 'filiereautorises.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->where('mission.id', $id)
            ->select(
                "filiereautorises.*",
                'ordre_enseignement.libelleenseignement',
                "filieres.*",
                "diplomeprepares.*"
            )
            ->get();

        $groupedFilieres = $filiere_autorises
            ->groupBy('libelleenseignement')
            ->map(function ($items) {

                return $items
                    ->groupBy('filieres_id')
                    ->map(function ($filiereGroup) {

                        return [
                            'libellefiliere' => $filiereGroup->first()->libellefiliere,
                            'observation'    => $filiereGroup->first()->observation,
                            'diplomeprepares'       => $filiereGroup
                                ->pluck('libellediplome')
                                ->filter()
                                ->unique()
                                ->values(),
                        ];
                    })->values();
            });



        $nbre_filiere_autorises = DB::table('filiereautorises')
            ->leftjoin('resultatsmission', 'filiereautorises.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftjoin('mission', 'resultatsmission.mission_id', '=', 'mission.id')
            ->leftjoin('diplomeprepares', 'filiereautorises.diplomeprepares_id', '=', 'diplomeprepares.id')
            ->leftjoin('filieres', 'filiereautorises.filieres_id', '=', 'filieres.id')
            ->leftJoin('ordre_enseignement', 'filiereautorises.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->where('mission.id', $id)
            ->select(
                "filiereautorises.*",
                'ordre_enseignement.libelleenseignement',
                "filieres.*",
                "diplomeprepares.*"
            )
            ->count();

        // Gestion administative
        $etat_personnels = DB::table('detailsresultatspersonnel')
            ->leftjoin('fonctionpersonnels', 'detailsresultatspersonnel.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
            ->leftjoin('resultatstypepersonnel', 'detailsresultatspersonnel.resultatstypepersonnel_id', '=', 'resultatstypepersonnel.id')
            ->leftjoin('typepersonnels', 'resultatstypepersonnel.typepersonnels_id', '=', 'typepersonnels.id')
            ->leftjoin('resultatsmission', 'resultatstypepersonnel.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftjoin('mission', 'resultatsmission.mission_id', '=', 'mission.id')
            ->where('mission.id', $id)
            ->select(
                "detailsresultatspersonnel.*",
                'fonctionpersonnels.libellefonction',
                'typepersonnels.libelletypepersonnel',
                'resultatstypepersonnel.observationpartielles',
            )
            ->get();

        $groupedPersonnels = $etat_personnels->groupBy('libelletypepersonnel');

        // Gestion pédagogique

        $etat_pedagogiques = DB::table('detailsresultatscontrole')
            ->leftjoin('itemscontrole', 'detailsresultatscontrole.itemscontrole_id', '=', 'itemscontrole.id')
            ->leftjoin('resultatscontrole', 'detailsresultatscontrole.resultatscontrole_id', '=', 'resultatscontrole.id')
            ->leftjoin('sousrubriquecontrole', 'resultatscontrole.sousrubriquecontrole_id', '=', 'sousrubriquecontrole.id')
            ->leftjoin('rubriquecontrole', 'sousrubriquecontrole.rubriquecontrole_id', '=', 'rubriquecontrole.id')
            ->leftjoin('resultatsmission', 'resultatscontrole.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftjoin('mission', 'resultatsmission.mission_id', '=', 'mission.id')
            ->where('rubriquecontrole.id', 1)
            ->where('mission.id', $id)
            ->select(
                "detailsresultatscontrole.*",
                'rubriquecontrole.libellerubrique',
                'sousrubriquecontrole.libellesousrubrique',
                'itemscontrole.libelleitems',
                'resultatscontrole.observationpartielles',
            )
            ->get();

        $groupedPedagogiques = $etat_pedagogiques->groupBy('libellesousrubrique');

        // Resultats scolaires

        $resultats_scolaires = DB::table('detailsresultatsscolaire')
        ->leftJoin('anneescolaires', 'detailsresultatsscolaire.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftjoin('resultatsscolaire', 'detailsresultatsscolaire.resultatsscolaire_id', '=', 'resultatsscolaire.id')
            ->leftjoin('resultatsmission', 'resultatsscolaire.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftjoin('mission', 'resultatsmission.mission_id', '=', 'mission.id')
            ->where('mission.id', $id)
            ->select(
                "detailsresultatsscolaire.*",
                'resultatsscolaire.observationpartielles',
                'anneescolaires.libelleanneescolaire',
            )
            ->get();

        // Effectifs et statuts

        $effectifs = DB::table('resultatsmission')
            ->select(
                'detailseffectifsetstatut.nbreaffecte',
                'detailseffectifsetstatut.nbrenonaffecte',
                'detailseffectifsetstatut.total',
                'niveau.libelleniveau',
                'ordre_enseignement.libelleenseignement'
            )
            ->leftJoin('effectifsetstatut', 'effectifsetstatut.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftJoin('detailseffectifsetstatut', 'detailseffectifsetstatut.effectifsetstatut_id', '=', 'effectifsetstatut.id')
            ->leftJoin('niveau', 'detailseffectifsetstatut.niveau_id', '=', 'niveau.id')
            ->leftJoin('ordre_enseignement', 'detailseffectifsetstatut.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->where('rubriquecontrole_id', 1)
            ->where('mission_id', $id)
            ->get();

        $nbreAffectes = DB::table('resultatsmission')
            ->leftJoin('effectifsetstatut', 'effectifsetstatut.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftJoin('detailseffectifsetstatut', 'detailseffectifsetstatut.effectifsetstatut_id', '=', 'effectifsetstatut.id')
            ->leftJoin('niveau', 'detailseffectifsetstatut.niveau_id', '=', 'niveau.id')
            ->leftJoin('ordre_enseignement', 'detailseffectifsetstatut.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->where('rubriquecontrole_id', 1)
            ->where('mission_id', $id)
            ->sum('detailseffectifsetstatut.nbreaffecte');

        $nbreNonAffectes = DB::table('resultatsmission')
            ->leftJoin('effectifsetstatut', 'effectifsetstatut.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftJoin('detailseffectifsetstatut', 'detailseffectifsetstatut.effectifsetstatut_id', '=', 'effectifsetstatut.id')
            ->leftJoin('niveau', 'detailseffectifsetstatut.niveau_id', '=', 'niveau.id')
            ->leftJoin('ordre_enseignement', 'detailseffectifsetstatut.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->where('rubriquecontrole_id', 1)
            ->where('mission_id', $id)
            ->sum('detailseffectifsetstatut.nbrenonaffecte');

        $totalEffectifs = DB::table('resultatsmission')
            ->leftJoin('effectifsetstatut', 'effectifsetstatut.resultatsmission_id', '=', 'resultatsmission.id')
            ->leftJoin('detailseffectifsetstatut', 'detailseffectifsetstatut.effectifsetstatut_id', '=', 'effectifsetstatut.id')
            ->leftJoin('niveau', 'detailseffectifsetstatut.niveau_id', '=', 'niveau.id')
            ->leftJoin('ordre_enseignement', 'detailseffectifsetstatut.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->where('rubriquecontrole_id', 1)
            ->where('mission_id', $id)
            ->sum('detailseffectifsetstatut.total');



        $pdf = Pdf::loadView(
            'fiche_suivie',
            compact('query1', 'effectifs', 'filiere_autorises', 'groupedFilieres', 'nbre_filiere_autorises', 'etat_personnels', 'groupedPersonnels', 'nbreAffectes', 'nbreNonAffectes', 'totalEffectifs', 'etat_pedagogiques', 'groupedPedagogiques', 'resultats_scolaires')
        )->setPaper('a4', 'landscape');
        // )->setPaper('a4', 'landscape');

        // return $pdf->download('test.pdf');
        return $pdf->stream('fiche.pdf'); // Vous pouvez aussi utiliser `download` pour télécharger le fichier

    }

    // public function rapport_rentre($id)
    // {

    //     ini_set('memory_limit', '-1');

    //     $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

    //     $etablissements = DB::table('etablissements')
    //         ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
    //         ->leftjoin('directiondepartementales', 'etablissements.directiondepartementales_id', '=', 'directiondepartementales.id')
    //         ->leftjoin('directionregionales', 'directiondepartementales.directionregionales_id', '=', 'directionregionales.id')
    //         ->leftjoin('communes', 'etablissements.communes_id', '=', 'communes.id')
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "etablissements.*",
    //             "ordre_enseignement.*",
    //             "directiondepartementales.*",
    //             "directionregionales.*",
    //             "communes.*",
    //             "ordre_enseignement.id AS ordre_en_id",
    //         )
    //         ->first();

    //     $filiere_enseignes = DB::table('filiereenseignes')
    //         ->leftjoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
    //         ->leftjoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
    //         ->leftjoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             // "filiereenseignes.numautorisationouverture AS filnumaut",
    //             "filiereenseignes.*",
    //             "filieres.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "diplomeprepares.*"
    //         )
    //         ->get();


    //     $nbre_filiere_enseignes = DB::table('filiereenseignes')
    //         ->leftjoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
    //         ->leftjoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
    //         ->leftjoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             // "filiereenseignes.numautorisationouverture AS filnumaut",
    //             "filiereenseignes.*",
    //             "filieres.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "diplomeprepares.*"
    //         )
    //         ->count();

    //     $classefilierepros = [];
    //     $classefiliereproParClasses = [];
    //     $classefilieres = [];
    //     $classefiliereParClasses = [];
    //     $classefilieretechs = [];
    //     $classefilieretechParClasses = [];

    //     if ($etablissements->ordre_enseignement_id == 1) {
    //         $classefilieres = DB::table('classefilieretech')
    //             ->where('etablissements_id', $id)
    //             ->where('anneescolaires_id', $anneescolaires_id)
    //             ->get();
    //         $classefiliereParClasses = $classefilieres->groupBy('libelleenseignement');
    //     }

    //     if ($etablissements->ordre_enseignement_id == 2) {
    //         $classefilieres = DB::table('classefilierepro')
    //             ->where('etablissements_id', $id)
    //             ->where('anneescolaires_id', $anneescolaires_id)
    //             ->get();
    //         $classefiliereParClasses = $classefilieres->groupBy('libelleenseignement');
    //     }

    //     if ($etablissements->ordre_enseignement_id == 4) {
    //         $classefilierepros = DB::table('classefilieredeuxpro')
    //             ->where('etablissements_id', $id)
    //             ->where('anneescolaires_id', $anneescolaires_id)
    //             ->get();
    //         $classefiliereproParClasses = $classefilierepros->groupBy('libelleenseignement');

    //         $classefilieretechs = DB::table('classefilieredeuxtech')
    //             ->where('etablissements_id', $id)
    //             ->where('anneescolaires_id', $anneescolaires_id)
    //             ->get();
    //         $classefilieretechParClasses = $classefilieretechs->groupBy('libelleenseignement');
    //     }

    //     //Equipe de Direction
    //     $equipedirections = DB::table('equipedirection')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->get();

    //     //Autres personnels administratifs
    //     $autrespersonnelsadmins = DB::table('autrespersonnelsadministratifs')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->get();

    //     //Effectifs du personnel enseignant par discipline
    //     $effectifsenseignants = DB::table('effectifenseignantdiscipline')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libellediscipline', 'ASC')
    //         ->get();

    //     //Effectif des apprenants par niveau et par classe
    //     $effectifsapprenants = DB::table('effectifApprenantNiveauClasseBourse')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libellediplome', 'ASC')
    //         ->orderBy('libellefiliere', 'ASC')
    //         ->get();
    //     $effectifsapprenantsParFilieres = $effectifsapprenants->groupBy(function ($item) {
    //         return $item->etablissement_ordre . ' : ' . $item->libellediplome . ' - ' . $item->libellefiliere;
    //     });

    //     //Effectif des apprenants de 1ère année et de seconde en fonction du mode de recrutement
    //     $effectifsrecrutements = DB::table('effectifsDesEntrantsParModeRecrutement')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libellediplome', 'ASC')
    //         ->get();

    //     //Statut des apprenants par filière et par niveau
    //     $statutsapprenants = DB::table('statutApprenantFiliereNiveau')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libellediplome', 'ASC')
    //         ->orderBy('libellefiliere', 'ASC')
    //         ->get();

    //     //Récapitulatif Général
    //     $recapGens = DB::table('recapGeneral')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libelleniveau', 'ASC')
    //         ->get();

    //     $recapEffectifs = DB::table('RecapGeneralNouveauEntrant')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libelleniveau', 'ASC')
    //         ->get();


    //     $personnels = DB::table('personnelannees')
    //         ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
    //         ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
    //         ->leftjoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
    //         ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
    //         ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
    //         ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)

    //         ->select(
    //             "personnelannees.*",
    //             "personnels.*",
    //             "personnels.email AS pemail",
    //             "personnels.telephone AS tel",
    //             "typepersonnels.*",
    //             "diplomepersonnels.*",
    //             "disciplines.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "statutpersonnel.*",
    //             "fonctionpersonnels.*",
    //             "niveauenseignant.*",
    //         )
    //         ->get();

    //     // Extraire les Conseils d'Enseignement (cons_ens = 1)
    //     $conseilsEnseignement = $personnels->map(function($personnel) {
    //         return [
    //             'id' => $personnel->id,
    //             'nom' => $personnel->nom,
    //             'prenoms' => $personnel->prenoms,
    //             'telephone' => $personnel->tel,
    //             'email' => $personnel->pemail,
    //             'discipline' => $personnel->libellediscipline ?? 'aucun',
    //             'cons_ens' => $personnel->cons_ens
    //         ];
    //     })->filter(function($personnel) {
    //         return isset($personnel['cons_ens']) && $personnel['cons_ens'] == 1;
    //     });


    //     $nbre_personnels = DB::table('personnelannees')
    //         ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
    //         ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
    //         ->leftjoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
    //         ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
    //         ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
    //         ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)

    //         ->select(
    //             "personnelannees.*",
    //             "personnels.*",
    //             "personnels.email AS pemail",
    //             "personnels.telephone AS tel",
    //             "typepersonnels.*",
    //             "diplomepersonnels.*",
    //             "disciplines.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "statutpersonnel.*",
    //             "fonctionpersonnels.*",
    //             "niveauenseignant.*",
    //         )
    //         ->count();


    //     $classes = DB::table('classes')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "classes.*",
    //             "groupepedagogiques.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->get();


    //     $nbre_classes = DB::table('classes')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "classes.*",
    //             "groupepedagogiques.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();

    //     $BoursiersParClasse = DB::table('classes')
    //         ->leftjoin('apprenantannees', 'classes.id', '=', 'apprenantannees.classes_id')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             'classes.denominationclasse',
    //             'classes.effectif_total',
    //             'classes.effectif_gar',
    //             'classes.effectif_fil',
    //             'groupepedagogiques.libellegp',
    //             DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 1 THEN 1 ELSE 0 END) AS nombre_boursiers"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 2 THEN 1 ELSE 0 END) AS nombre_non_boursiers"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 4 THEN 1 ELSE 0 END) AS nombre_affectes"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 5 THEN 1 ELSE 0 END) AS nombre_non_affectes"),

    //         )
    //         ->groupBy('classes.denominationclasse', 'groupepedagogiques.libellegp', 'classes.effectif_total', 'classes.effectif_gar', 'classes.effectif_fil')
    //         ->orderBy('classes.denominationclasse', 'ASC')
    //         ->get();



    //     $apprenants = DB::table('apprenantannees')
    //         ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
    //         ->leftjoin('handicaps', 'apprenants.handicaps_id', '=', 'handicaps.id')
    //         ->leftjoin('typeshandicaps', 'handicaps.typeshandicaps_id', '=', 'typeshandicaps.id')
    //         ->leftjoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
    //         ->leftjoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
    //         ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->orderBy('apprenants.nom', 'ASC')
    //         ->select(
    //             "apprenantannees.*",
    //             "apprenants.*",
    //             "handicaps.libelle_handicap",
    //             "typeshandicaps.libelle_typeshandicap",
    //             "classes.denominationclasse AS la_classe",
    //             "statutapprenants.*",
    //             "bourses.*",
    //         )->get();



    //     $nbre_apprenants = DB::table('apprenantannees')
    //         ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
    //         ->leftjoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
    //         ->leftjoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
    //         ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "apprenantannees.*",
    //             "apprenants.*",
    //             "classes.*",
    //             "statutapprenants.*",
    //             "bourses.*",
    //             "decision.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();

    //     $infrastructures = DB::table('infrastructures')
    //         ->leftjoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "infrastructures.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "designationinfrastructures.*",
    //             "infrastructures.capacite AS cap",
    //             "infrastructures.observation AS obs",
    //         )
    //         ->get();


    //     $nbre_infrastructures = DB::table('infrastructures')
    //         ->leftjoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "infrastructures.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "designationinfrastructures.*",

    //         )
    //         ->count();

    //     $equipements = DB::table('equipements')
    //         ->leftjoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "equipements.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_equipements = DB::table('equipements')
    //         ->leftjoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "equipements.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $activites = DB::table('activitesportive')
    //         ->leftjoin('sport', 'activitesportive.sport_id', '=', 'sport.id')
    //         ->leftjoin('etablissementannees', 'activitesportive.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "activitesportive.*",
    //             "sport.libellesport",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_activites = DB::table('activitesportive')
    //         ->leftjoin('sport', 'activitesportive.sport_id', '=', 'sport.id')
    //         ->leftjoin('etablissementannees', 'activitesportive.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "activitesportive.*",
    //             "sport.libellesport",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $associations = DB::table('associations')
    //         ->leftjoin('etablissementannees', 'associations.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "associations.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_associations = DB::table('associations')
    //         ->leftjoin('etablissementannees', 'associations.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "associations.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $probleme_urgents = DB::table('probleme_urgent')
    //         ->leftjoin('etablissementannees', 'probleme_urgent.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "probleme_urgent.libelleprobleme",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_probleme = DB::table('probleme_urgent')
    //         ->leftjoin('etablissementannees', 'probleme_urgent.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "probleme_urgent.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $conclusions = DB::table('conclusion')
    //         ->leftjoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "conclusion.libelleconclusion",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_conclusions = DB::table('conclusion')
    //         ->leftjoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "conclusion.libelleconclusion",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $emplois = DB::table('emploidutemps')
    //         ->leftjoin('etablissementannees', 'emploidutemps.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('denominationclasse', 'ASC')
    //         ->get();

    //     $emploisParClasse = $emplois->groupBy('denominationclasse');

    //     $emploisProfs = DB::table('emploidutempsprof')
    //         ->leftjoin('etablissementannees', 'emploidutempsprof.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('personnels', 'emploidutempsprof.personnels_id', '=', 'personnels.id')
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             'emploidutempsprof.*'
    //         )
    //         ->get();

    //     // $emploisParProf = $emploisProfs->groupBy('nom');

    //     $emploisParProf = $emploisProfs->groupBy(function ($item) {
    //         return $item->nom . ' ' . $item->prenoms;
    //     });


    //     // Assurez-vous que le nom de l'établissement est formaté sans caractères spéciaux
    //     $nomEtablissement = preg_replace('/[^A-Za-z0-9_\- ]/', '', $etablissements->denominationetab ?? 'etablissement');


    //     ////////////////////////////////////////////////////
        

    //     // Point d'exécution
    //     $pointexecutions = DB::table('point_executions')
    //         ->leftjoin('disciplines', 'point_executions.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('etablissementannees', 'point_executions.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "point_executions.*",
    //             "disciplines.libellediscipline",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();

    //     // Indicateurs
    //     $indicateurs = DB::table('indicateurs')
    //         ->leftjoin('itemsindicateurs', 'indicateurs.itemsindicateurs_id', '=', 'itemsindicateurs.id')
    //         ->leftjoin('etablissementannees', 'indicateurs.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "indicateurs.*",
    //             "itemsindicateurs.libelleitems",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();

    //     // Exécution budget
    //     $executionbudgets = DB::table('execution_budgets')
    //         ->leftjoin('etablissementannees', 'execution_budgets.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "execution_budgets.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();

    //     // Ressources additionnelles
    //     $ressourcesadditionnelles = DB::table('ressources_additionnelles')
    //         ->leftjoin('etablissementannees', 'ressources_additionnelles.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "ressources_additionnelles.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();

    //     // Frais de scolarité
    //     $fraisscolarites = DB::table('frais_scolarites')
    //         ->leftjoin('etablissementannees', 'frais_scolarites.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "frais_scolarites.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();

    //     // Travaux extérieurs
    //     $travauxexterieurs = DB::table('travaux_exterieurs')
    //         ->leftjoin('etablissementannees', 'travaux_exterieurs.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "travaux_exterieurs.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();

    //     // Comité de gestion
    //     $comitegestions = DB::table('comite_gestions')
    //         ->leftjoin('membre_comites', 'comite_gestions.membre_comites_id', '=', 'membre_comites.id')
    //         ->leftjoin('etablissementannees', 'comite_gestions.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "comite_gestions.*",
    //             "membre_comites.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();

    //     // Aménagements
    //     $amenagements = DB::table('amenagements')
    //         ->leftjoin('besoin_urgents', 'amenagements.besoin_urgents_id', '=', 'besoin_urgents.id')
    //         ->leftjoin('etablissementannees', 'besoin_urgents.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "amenagements.*",
    //             "besoin_urgents.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();


    //     $pdf = Pdf::loadView(
    //         'etab_identification',
    //         [
    //             'etablissements' => $etablissements,
    //             'filiere_enseignes' => $filiere_enseignes,
    //             'nbre_filiere_enseignes' => $nbre_filiere_enseignes,
    //             'personnels' => $personnels,
    //             'nbre_personnels' => $nbre_personnels,
    //             'classes' => $classes,
    //             'nbre_classes' => $nbre_classes,
    //             'apprenants' => $apprenants,
    //             'nbre_apprenants' => $nbre_apprenants,
    //             'infrastructures' => $infrastructures,
    //             'nbre_infrastructures' => $nbre_infrastructures,
    //             'equipements' => $equipements,
    //             'boursiers' => $BoursiersParClasse,
    //             'nbre_equipements' => $nbre_equipements,
    //             'activites' => $activites,
    //             'nbre_activites' => $nbre_activites,
    //             'associations' => $associations,
    //             'nbre_associations' => $nbre_associations,
    //             'probleme_urgents' => $probleme_urgents,
    //             'nbre_probleme' => $nbre_probleme,
    //             'conclusions' => $conclusions,
    //             'nbre_conclusions' => $nbre_conclusions,
    //             'emplois' => $emplois,
    //             'emploisParClasse' => $emploisParClasse,
    //             'emploisProfs' => $emploisProfs,
    //             'emploisParProf' => $emploisParProf,
    //             'classefilieres' => $classefilieres,
    //             'classefiliereParClasses' => $classefiliereParClasses,
    //             'classefilierepros' => $classefilierepros,
    //             'classefiliereproParClasses' => $classefiliereproParClasses,
    //             'classefilieretechs' => $classefilieretechs,
    //             'classefilieretechParClasses' => $classefilieretechParClasses,
    //             'equipedirections' => $equipedirections,
    //             'autrespersonnelsadmins' => $autrespersonnelsadmins,
    //             'effectifsenseignants' => $effectifsenseignants,
    //             'effectifsapprenants' => $effectifsapprenants,
    //             'effectifsapprenantsParFilieres' => $effectifsapprenantsParFilieres,
    //             'effectifsrecrutements' => $effectifsrecrutements,
    //             'statutsapprenants' => $statutsapprenants,
    //             'recapGens' => $recapGens,
    //             'recapEffectifs' => $recapEffectifs,
    //             'pointexecutions' => $pointexecutions,
    //             'indicateurs' => $indicateurs,
    //             'executionbudgets' => $executionbudgets,
    //             'ressourcesadditionnelles' => $ressourcesadditionnelles,
    //             'fraisscolarites' => $fraisscolarites,
    //             'travauxexterieurs' => $travauxexterieurs,
    //             'comitegestions' => $comitegestions,
    //             'amenagements' => $amenagements,
    //             'conseilsEnseignement' => $conseilsEnseignement,
    //         ]
    //     )->setPaper('a4', 'landscape');

    //     return $pdf->stream("Rapport_de_rentrée_{$nomEtablissement}.pdf");
    // }

    public function rapport_rentre($id)
    {
        
        ini_set('memory_limit', '-1');

        $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

        // ── Établissement ─────────────────────────────────────────────────────────
        $etablissements = DB::table('etablissements')
            ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->leftjoin('directiondepartementales', 'etablissements.directiondepartementales_id', '=', 'directiondepartementales.id')
            ->leftjoin('directionregionales', 'directiondepartementales.directionregionales_id', '=', 'directionregionales.id')
            ->leftjoin('communes', 'etablissements.communes_id', '=', 'communes.id')
            ->where('etablissements.id', $id)
            ->select(
                "etablissements.*",
                "ordre_enseignement.*",
                "directiondepartementales.*",
                "directionregionales.*",
                "communes.*",
                "ordre_enseignement.id AS ordre_en_id",
            )
            ->first();

        // ── Filières enseignées ────────────────────────────────────────────────────
        $filiere_enseignes = DB::table('filiereenseignes')
            ->leftjoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
            ->leftjoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
            ->leftjoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "filiereenseignes.*",
                "filieres.*",
                "etablissementannees.*",
                "etablissements.*",
                "diplomeprepares.*"
            )
            ->get();

        $nbre_filiere_enseignes = $filiere_enseignes->count();

        // ── Classes par filière (selon ordre d'enseignement) ──────────────────────
        $classefilierepros        = [];
        $classefiliereproParClasses = [];
        $classefilieres           = [];
        $classefiliereParClasses  = [];
        $classefilieretechs       = [];
        $classefilieretechParClasses = [];

        if ($etablissements->ordre_enseignement_id == 1) {
            $classefilieres = DB::table('classefilieretech')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();
            $classefiliereParClasses = $classefilieres->groupBy('libelleenseignement');
        }

        if ($etablissements->ordre_enseignement_id == 2) {
            $classefilieres = DB::table('classefilierepro')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();
            $classefiliereParClasses = $classefilieres->groupBy('libelleenseignement');
        }

        if ($etablissements->ordre_enseignement_id == 4) {
            $classefilierepros = DB::table('classefilieredeuxpro')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();
            $classefiliereproParClasses = $classefilierepros->groupBy('libelleenseignement');

            $classefilieretechs = DB::table('classefilieredeuxtech')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();
            $classefilieretechParClasses = $classefilieretechs->groupBy('libelleenseignement');
        }

        // ── Équipe de direction ────────────────────────────────────────────────────
        $equipedirections = DB::table('equipedirection')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get();

        // ── Autres personnels administratifs ──────────────────────────────────────
        $autrespersonnelsadmins = DB::table('autrespersonnelsadministratifs')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get();

        // ── [NOUVEAU] Besoins en personnels administratifs ────────────────────────
        $besoinspersonneladmins = DB::table('besoinpersonneladm')
            ->leftjoin('fonctionpersonnels', 'besoinpersonneladm.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
            ->leftjoin('etablissementannees', 'besoinpersonneladm.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "besoinpersonneladm.*",
                "fonctionpersonnels.libellefonction",
            )
            ->get();

        // ── Effectifs enseignants par discipline ──────────────────────────────────
        $effectifsenseignants = DB::table('effectifenseignantdiscipline')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediscipline', 'ASC')
            ->get();

        // ── [NOUVEAU] Besoins en personnel enseignant (remplace tableau vide) ─────
        $besoinspersonnelens = DB::table('besoinpersonnelens')
            ->leftjoin('disciplines', 'besoinpersonnelens.disciplines_id', '=', 'disciplines.id')
            ->leftjoin('niveauenseignant', 'besoinpersonnelens.niveauenseignant_id', '=', 'niveauenseignant.id')
            ->leftjoin('etablissementannees', 'besoinpersonnelens.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "besoinpersonnelens.*",
                "disciplines.libellediscipline",
                "niveauenseignant.libelleniveau",
            )
            ->get();

        // ── Personnels (liste complète pour annexe) ────────────────────────────────
        $personnels = DB::table('personnelannees')
            ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
            ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
            ->leftjoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
            ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
            ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftjoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
            ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
            ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "personnelannees.*",
                "personnels.*",
                "personnels.email AS pemail",
                "personnels.telephone AS tel",
                "typepersonnels.*",
                "diplomepersonnels.*",
                "disciplines.*",
                "etablissementannees.*",
                "etablissements.*",
                "statutpersonnel.*",
                "fonctionpersonnels.*",
                "niveauenseignant.*",
            )
            ->get();

        $nbre_personnels = $personnels->count();

        // Conseils d'Enseignement (cons_ens = 1)
        $conseilsEnseignement = $personnels->filter(function ($personnel) {
            return isset($personnel->cons_ens) && $personnel->cons_ens == 1;
        });

        // ── [NOUVEAU] Liste personnels enseignants (vue SQL) pour annexe ──────────
        // Vue listepaersonnelenseignant : fonctionpersonnels.id IN (10,15,16)
        $listepersonnelenseignant = DB::table('listepaersonnelenseignant')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get();

        // ── [NOUVEAU] Liste personnels admin non-enseignants (vue SQL) pour annexe ─
        // Vue listepersonneladminautre : fonctionpersonnels.id NOT IN (1,3,4,11,17,19,10,15,16)
        $listepersonneladminautre = DB::table('listepersonneladminautre')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get();

        // ── Classes ────────────────────────────────────────────────────────────────
        $classes = DB::table('classes')
            ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
            ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "classes.*",
                "groupepedagogiques.*",
                "etablissementannees.*",
                "etablissements.*"
            )->get();

        $nbre_classes = $classes->count();

        // Boursiers / affectés par classe
        $BoursiersParClasse = DB::table('classes')
            ->leftjoin('apprenantannees', 'classes.id', '=', 'apprenantannees.classes_id')
            ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
            ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
            ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                'classes.denominationclasse',
                'classes.effectif_total',
                'classes.effectif_gar',
                'classes.effectif_fil',
                'groupepedagogiques.libellegp',
                DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 1 THEN 1 ELSE 0 END) AS nombre_boursiers"),
                DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 2 THEN 1 ELSE 0 END) AS nombre_non_boursiers"),
                DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 4 THEN 1 ELSE 0 END) AS nombre_affectes"),
                DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 5 THEN 1 ELSE 0 END) AS nombre_non_affectes"),
            )
            ->groupBy('classes.denominationclasse', 'groupepedagogiques.libellegp', 'classes.effectif_total', 'classes.effectif_gar', 'classes.effectif_fil')
            ->orderBy('classes.denominationclasse', 'ASC')
            ->get();

        // ── Apprenants ─────────────────────────────────────────────────────────────
        $apprenants = DB::table('apprenantannees')
            ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
            ->leftjoin('handicaps', 'apprenants.handicaps_id', '=', 'handicaps.id')
            ->leftjoin('typeshandicaps', 'handicaps.typeshandicaps_id', '=', 'typeshandicaps.id')
            ->leftjoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
            ->leftjoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
            ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
            ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
            ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->orderBy('apprenants.nom', 'ASC')
            ->select(
                "apprenantannees.*",
                "apprenants.*",
                "handicaps.libelle_handicap",
                "typeshandicaps.libelle_typeshandicap",
                "classes.denominationclasse AS la_classe",
                "statutapprenants.*",
                "bourses.*",
            )->get();

        $nbre_apprenants = $apprenants->count();

        // ── Effectifs apprenants (vues statistiques) ───────────────────────────────
        $effectifsapprenants = DB::table('effectifApprenantNiveauClasseBourse')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediplome', 'ASC')
            ->orderBy('libellefiliere', 'ASC')
            ->get();

        $effectifsapprenantsParFilieres = $effectifsapprenants->groupBy(function ($item) {
            return $item->etablissement_ordre . ' : ' . $item->libellediplome . ' - ' . $item->libellefiliere;
        });

        $effectifsrecrutements = DB::table('effectifsDesEntrantsParModeRecrutement')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediplome', 'ASC')
            ->get();

        $statutsapprenants = DB::table('statutApprenantFiliereNiveau')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediplome', 'ASC')
            ->orderBy('libellefiliere', 'ASC')
            ->get();

        $recapGens = DB::table('recapGeneral')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libelleniveau', 'ASC')
            ->get();

        $recapEffectifs = DB::table('RecapGeneralNouveauEntrant')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libelleniveau', 'ASC')
            ->get();

        // ── Point d'exécution des programmes ──────────────────────────────────────
        $pointexecutions = DB::table('point_executions')
            ->leftjoin('disciplines', 'point_executions.disciplines_id', '=', 'disciplines.id')
            ->leftjoin('etablissementannees', 'point_executions.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "point_executions.*",
                "disciplines.libellediscipline",
                "etablissementannees.*",
                "etablissements.*"
            )
            ->get();

        // ── Indicateurs de performance ─────────────────────────────────────────────
        $indicateurs = DB::table('indicateurs')
            ->leftjoin('itemsindicateurs', 'indicateurs.itemsindicateurs_id', '=', 'itemsindicateurs.id')
            ->leftjoin('etablissementannees', 'indicateurs.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "indicateurs.*",
                "itemsindicateurs.libelleitems",
                "etablissementannees.*",
                "etablissements.*"
            )
            ->get();

        // ── [NOUVEAU] Section 5 — Bilan des mises en stage de vacances ────────────
        // Table à créer : mise_en_stages (id, etablissementannees_id, filieres_id,
        //                                nombre_stagiaires, nombre_mis_en_stages,
        //                                taux, analyse_situation, created_at, updated_at)
        $misesenstagevacances = DB::table('mise_en_stages')
            ->leftjoin('filieres', 'mise_en_stages.filieres_id', '=', 'filieres.id')
            ->leftjoin('etablissementannees', 'mise_en_stages.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "mise_en_stages.*",
                "filieres.libellefiliere",
            )
            ->get();

        $nbre_misesenstagevacances = $misesenstagevacances->count();

        // Analyse de la situation (champ texte unique sur le premier enregistrement,
        // ou null si aucun enregistrement)
        $analysesituation = $misesenstagevacances->first()?->analyse_situation ?? null;

        // ── Infrastructures ────────────────────────────────────────────────────────
        $infrastructures = DB::table('infrastructures')
            ->leftjoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftjoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "infrastructures.*",
                "etablissementannees.*",
                "etablissements.*",
                "designationinfrastructures.*",
                "infrastructures.capacite AS cap",
                "infrastructures.observation AS obs",
            )
            ->get();

        $nbre_infrastructures = $infrastructures->count();

        // ── Équipements ────────────────────────────────────────────────────────────
        $equipements = DB::table('equipements')
            ->leftjoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "equipements.*",
                "etablissementannees.*",
                "etablissements.*",
            )->get();

        $nbre_equipements = $equipements->count();

        // ── Gestion financière ─────────────────────────────────────────────────────
        $executionbudgets = DB::table('execution_budgets')
            ->leftjoin('etablissementannees', 'execution_budgets.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "execution_budgets.*",
                "etablissementannees.*",
                "etablissements.*"
            )
            ->get();

        $ressourcesadditionnelles = DB::table('ressources_additionnelles')
            ->leftjoin('etablissementannees', 'ressources_additionnelles.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "ressources_additionnelles.*",
                "etablissementannees.*",
                "etablissements.*"
            )
            ->get();

        // ── [NOUVEAU] Frais scolarité COURS DU JOUR ────────────────────────────────
        // On distingue jour/soir via le champ `nature` (valeurs : "Frais d'inscription", "Frais de scolarité")
        // Si ta table ajoute un champ `type_cours` (jour/soir), remplace le where en conséquence.
        // En l'état de la BD actuelle, on utilise tous les enregistrements pour le cours du jour,
        // et on laisse le tableau cours du soir vide (à remplir manuellement).
        $fraisscolaritesjour = DB::table('frais_scolarites')
            ->leftjoin('etablissementannees', 'frais_scolarites.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            // ->where('frais_scolarites.type_cours', 'jour')  // décommenter après migration
            ->select(
                "frais_scolarites.*",
                "etablissementannees.*",
                "etablissements.*"
            )
            ->get();

        // Cours du soir — vide jusqu'à l'ajout du champ type_cours dans la migration
        $fraisscolaritessoir = collect();
        // Après migration : même requête avec ->where('frais_scolarites.type_cours', 'soir')

        $travauxexterieurs = DB::table('travaux_exterieurs')
            ->leftjoin('etablissementannees', 'travaux_exterieurs.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "travaux_exterieurs.*",
                "etablissementannees.*",
                "etablissements.*"
            )
            ->get();

        // ── Comité de gestion ──────────────────────────────────────────────────────
        $comitegestions = DB::table('comite_gestions')
            ->leftjoin('membre_comites', 'comite_gestions.membre_comites_id', '=', 'membre_comites.id')
            ->leftjoin('etablissementannees', 'comite_gestions.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "comite_gestions.*",
                "membre_comites.*",
                "etablissementannees.*",
                "etablissements.*"
            )
            ->get();

        // ── Activités socio-éducatives ─────────────────────────────────────────────
        $activites = DB::table('activitesportive')
            ->leftjoin('sport', 'activitesportive.sport_id', '=', 'sport.id')
            ->leftjoin('etablissementannees', 'activitesportive.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "activitesportive.*",
                "sport.libellesport",
                "etablissementannees.*",
                "etablissements.*",
            )->get();

        $nbre_activites = $activites->count();

        $associations = DB::table('associations')
            ->leftjoin('etablissementannees', 'associations.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "associations.*",
                "etablissementannees.*",
                "etablissements.*",
            )->get();

        $nbre_associations = $associations->count();

        // ── Problèmes urgents ──────────────────────────────────────────────────────
        $probleme_urgents = DB::table('probleme_urgent')
            ->leftjoin('etablissementannees', 'probleme_urgent.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "probleme_urgent.libelleprobleme",
                "etablissementannees.*",
                "etablissements.*",
            )->get();

        $nbre_probleme = $probleme_urgents->count();

        // ── [NOUVEAU] Perspectives ─────────────────────────────────────────────────
        $perspectives = DB::table('perspectives')
            ->leftjoin('etablissementannees', 'perspectives.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "perspectives.libelleperspective",
                "etablissementannees.*",
                "etablissements.*",
            )->get();

        $nbre_perspectives = $perspectives->count();

        // ── Conclusion ─────────────────────────────────────────────────────────────
        $conclusions = DB::table('conclusion')
            ->leftjoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "conclusion.libelleconclusion",
                "etablissementannees.*",
                "etablissements.*",
            )->get();

        $nbre_conclusions = $conclusions->count();

        // ── Emplois du temps ───────────────────────────────────────────────────────
        $emplois = DB::table('emploidutemps')
            ->leftjoin('etablissementannees', 'emploidutemps.etablissementannees_id', '=', 'etablissementannees.id')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('denominationclasse', 'ASC')
            ->get();

        $emploisParClasse = $emplois->groupBy('denominationclasse');

        $emploisProfs = DB::table('emploidutempsprof')
            ->leftjoin('etablissementannees', 'emploidutempsprof.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftjoin('personnels', 'emploidutempsprof.personnels_id', '=', 'personnels.id')
            ->where('etablissements.id', $id)
            ->select('emploidutempsprof.*')
            ->get();

        $emploisParProf = $emploisProfs->groupBy(function ($item) {
            return $item->nom . ' ' . $item->prenoms;
        });

        // Aménagements
        $amenagements = DB::table('amenagements')
            ->leftjoin('besoin_urgents', 'amenagements.besoin_urgents_id', '=', 'besoin_urgents.id')
            ->leftjoin('etablissementannees', 'besoin_urgents.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "amenagements.*",
                "besoin_urgents.*",
                "etablissementannees.*",
                "etablissements.*"
            )
            ->get();

        // ── Nom établissement (pour le nom du fichier PDF) ─────────────────────────
        $nomEtablissement = preg_replace(
            '/[^A-Za-z0-9_\- ]/', '',
            $etablissements->denominationetab ?? 'etablissement'
        );

        // ── Génération PDF ─────────────────────────────────────────────────────────
        $pdf = Pdf::loadView('etab_identification', [
            // Établissement
            'etablissements'                  => $etablissements,
            // Filières
            'filiere_enseignes'               => $filiere_enseignes,
            'nbre_filiere_enseignes'          => $nbre_filiere_enseignes,
            // Classes par filière
            'classefilieres'                  => $classefilieres,
            'classefiliereParClasses'         => $classefiliereParClasses,
            'classefilierepros'               => $classefilierepros,
            'classefiliereproParClasses'      => $classefiliereproParClasses,
            'classefilieretechs'              => $classefilieretechs,
            'classefilieretechParClasses'     => $classefilieretechParClasses,
            // Équipe direction
            'equipedirections'                => $equipedirections,
            // Autres personnels admin
            'autrespersonnelsadmins'          => $autrespersonnelsadmins,
            // [NOUVEAU] Besoins personnels admin
            'besoinspersonneladmins'          => $besoinspersonneladmins,
            // Effectifs enseignants
            'effectifsenseignants'            => $effectifsenseignants,
            // [NOUVEAU] Besoins personnel enseignant (remplace tableau vide)
            'besoinspersonnelens'             => $besoinspersonnelens,
            // Personnels
            'personnels'                      => $personnels,
            'nbre_personnels'                 => $nbre_personnels,
            'conseilsEnseignement'            => $conseilsEnseignement,
            // [NOUVEAU] Listes annexes personnels
            'listepersonnelenseignant'        => $listepersonnelenseignant,
            'listepersonneladminautre'        => $listepersonneladminautre,
            // Classes
            'classes'                         => $classes,
            'nbre_classes'                    => $nbre_classes,
            'boursiers'                       => $BoursiersParClasse,
            // Apprenants
            'apprenants'                      => $apprenants,
            'nbre_apprenants'                 => $nbre_apprenants,
            // Effectifs stats
            'effectifsapprenants'             => $effectifsapprenants,
            'effectifsapprenantsParFilieres'  => $effectifsapprenantsParFilieres,
            'effectifsrecrutements'           => $effectifsrecrutements,
            'statutsapprenants'               => $statutsapprenants,
            'recapGens'                       => $recapGens,
            'recapEffectifs'                  => $recapEffectifs,
            // Point exécution programmes
            'pointexecutions'                 => $pointexecutions,
            // Indicateurs
            'indicateurs'                     => $indicateurs,
            // [NOUVEAU] Mises en stage vacances
            'misesenstagevacances'            => $misesenstagevacances,
            'nbre_misesenstagevacances'       => $nbre_misesenstagevacances,
            'analysesituation'                => $analysesituation,
            // Infrastructures
            'infrastructures'                 => $infrastructures,
            'nbre_infrastructures'            => $nbre_infrastructures,
            // Équipements
            'equipements'                     => $equipements,
            'nbre_equipements'                => $nbre_equipements,
            // Gestion financière
            'executionbudgets'                => $executionbudgets,
            'ressourcesadditionnelles'        => $ressourcesadditionnelles,
            // [NOUVEAU] Frais scolarité jour / soir séparés
            'fraisscolaritesjour'             => $fraisscolaritesjour,
            'fraisscolaritessoir'             => $fraisscolaritessoir,
            'travauxexterieurs'               => $travauxexterieurs,
            // Comité de gestion
            'comitegestions'                  => $comitegestions,
            // Activités
            'activites'                       => $activites,
            'nbre_activites'                  => $nbre_activites,
            'associations'                    => $associations,
            'nbre_associations'               => $nbre_associations,
            // Problèmes
            'probleme_urgents'                => $probleme_urgents,
            'nbre_probleme'                   => $nbre_probleme,
            // [NOUVEAU] Perspectives
            'perspectives'                    => $perspectives,
            'nbre_perspectives'               => $nbre_perspectives,
            // Conclusion
            'conclusions'                     => $conclusions,
            'nbre_conclusions'                => $nbre_conclusions,
            // Emplois du temps
            'emplois'                         => $emplois,
            'emploisParClasse'                => $emploisParClasse,
            'emploisProfs'                    => $emploisProfs,
            'emploisParProf'                  => $emploisParProf,
            // Aménagements
            'amenagements'                    => $amenagements,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream("Rapport_de_rentrée_{$nomEtablissement}.pdf");

    }

    // public function rapport_sem1($id)
    // {

    //     ini_set('memory_limit', '-1');

    //     $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

    //     $etablissements = DB::table('etablissements')
    //         ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
    //         ->leftjoin('directiondepartementales', 'etablissements.directiondepartementales_id', '=', 'directiondepartementales.id')
    //         ->leftjoin('directionregionales', 'directiondepartementales.directionregionales_id', '=', 'directionregionales.id')
    //         ->leftjoin('communes', 'etablissements.communes_id', '=', 'communes.id')
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "etablissements.*",
    //             "ordre_enseignement.*",
    //             "directiondepartementales.*",
    //             "directionregionales.*",
    //             "communes.*",
    //             "ordre_enseignement.id AS ordre_en_id",
    //         )
    //         ->first();

    //     $filiere_enseignes = DB::table('filiereenseignes')
    //         ->leftjoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
    //         ->leftjoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
    //         ->leftjoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             // "filiereenseignes.numautorisationouverture AS filnumaut",
    //             "filiereenseignes.*",
    //             "filieres.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "diplomeprepares.*"
    //         )
    //         ->get();


    //     $nbre_filiere_enseignes = DB::table('filiereenseignes')
    //         ->leftjoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
    //         ->leftjoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
    //         ->leftjoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             // "filiereenseignes.numautorisationouverture AS filnumaut",
    //             "filiereenseignes.*",
    //             "filieres.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "diplomeprepares.*"
    //         )
    //         ->count();

    //     $classefilierepros = [];
    //     $classefiliereproParClasses = [];
    //     $classefilieres = [];
    //     $classefiliereParClasses = [];
    //     $classefilieretechs = [];
    //     $classefilieretechParClasses = [];

    //     if ($etablissements->ordre_enseignement_id == 1) {
    //         $classefilieres = DB::table('classefilieretech')
    //             ->where('etablissements_id', $id)
    //             ->where('anneescolaires_id', $anneescolaires_id)
    //             ->get();
    //         $classefiliereParClasses = $classefilieres->groupBy('libelleenseignement');
    //     }

    //     if ($etablissements->ordre_enseignement_id == 2) {
    //         $classefilieres = DB::table('classefilierepro')
    //             ->where('etablissements_id', $id)
    //             ->where('anneescolaires_id', $anneescolaires_id)
    //             ->get();
    //         $classefiliereParClasses = $classefilieres->groupBy('libelleenseignement');
    //     }

    //     if ($etablissements->ordre_enseignement_id == 4) {
    //         $classefilierepros = DB::table('classefilieredeuxpro')
    //             ->where('etablissements_id', $id)
    //             ->where('anneescolaires_id', $anneescolaires_id)
    //             ->get();
    //         $classefiliereproParClasses = $classefilierepros->groupBy('libelleenseignement');

    //         $classefilieretechs = DB::table('classefilieredeuxtech')
    //             ->where('etablissements_id', $id)
    //             ->where('anneescolaires_id', $anneescolaires_id)
    //             ->get();
    //         $classefilieretechParClasses = $classefilieretechs->groupBy('libelleenseignement');
    //     }

    //     //Equipe de Direction
    //     $equipedirections = DB::table('equipedirection')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->get();

    //     //Autres personnels administratifs
    //     $autrespersonnelsadmins = DB::table('autrespersonnelsadministratifs')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->get();

    //     //Effectifs du personnel enseignant par discipline
    //     $effectifsenseignants = DB::table('effectifenseignantdiscipline')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libellediscipline', 'ASC')
    //         ->get();

    //     //Effectif des apprenants par niveau et par classe
    //     $effectifsapprenants = DB::table('effectifApprenantNiveauClasseBourse')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libellediplome', 'ASC')
    //         ->orderBy('libellefiliere', 'ASC')
    //         ->get();
    //     $effectifsapprenantsParFilieres = $effectifsapprenants->groupBy(function ($item) {
    //         return $item->etablissement_ordre . ' : ' . $item->libellediplome . ' - ' . $item->libellefiliere;
    //     });

    //     //Effectif des apprenants de 1ère année et de seconde en fonction du mode de recrutement
    //     $effectifsrecrutements = DB::table('effectifsDesEntrantsParModeRecrutement')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libellediplome', 'ASC')
    //         ->get();

    //     //Statut des apprenants par filière et par niveau
    //     $statutsapprenants = DB::table('statutApprenantFiliereNiveau')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libellediplome', 'ASC')
    //         ->orderBy('libellefiliere', 'ASC')
    //         ->get();

    //     //Récapitulatif Général
    //     $recapGens = DB::table('recapGeneral')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libelleniveau', 'ASC')
    //         ->get();

    //     $recapEffectifs = DB::table('RecapGeneralNouveauEntrant')
    //         ->where('etablissements_id', $id)
    //         ->where('anneescolaires_id', $anneescolaires_id)
    //         ->orderBy('libelleniveau', 'ASC')
    //         ->get();


    //     $personnels = DB::table('personnelannees')
    //         ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
    //         ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
    //         ->leftjoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
    //         ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
    //         ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
    //         ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)

    //         ->select(
    //             "personnelannees.*",
    //             "personnels.*",
    //             "personnels.email AS pemail",
    //             "personnels.telephone AS tel",
    //             "typepersonnels.*",
    //             "diplomepersonnels.*",
    //             "disciplines.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "statutpersonnel.*",
    //             "fonctionpersonnels.*",
    //             "niveauenseignant.*",
    //         )
    //         ->get();


    //     $nbre_personnels = DB::table('personnelannees')
    //         ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
    //         ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
    //         ->leftjoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
    //         ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
    //         ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
    //         ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)

    //         ->select(
    //             "personnelannees.*",
    //             "personnels.*",
    //             "personnels.email AS pemail",
    //             "personnels.telephone AS tel",
    //             "typepersonnels.*",
    //             "diplomepersonnels.*",
    //             "disciplines.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "statutpersonnel.*",
    //             "fonctionpersonnels.*",
    //             "niveauenseignant.*",
    //         )
    //         ->count();


    //     $classes = DB::table('classes')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "classes.*",
    //             "groupepedagogiques.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->get();


    //     $nbre_classes = DB::table('classes')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "classes.*",
    //             "groupepedagogiques.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();

    //     $BoursiersParClasse = DB::table('classes')
    //         ->leftjoin('apprenantannees', 'classes.id', '=', 'apprenantannees.classes_id')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             'classes.denominationclasse',
    //             'classes.effectif_total',
    //             'classes.effectif_gar',
    //             'classes.effectif_fil',
    //             'groupepedagogiques.libellegp',
    //             DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 1 THEN 1 ELSE 0 END) AS nombre_boursiers"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 2 THEN 1 ELSE 0 END) AS nombre_non_boursiers"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 4 THEN 1 ELSE 0 END) AS nombre_affectes"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 5 THEN 1 ELSE 0 END) AS nombre_non_affectes"),

    //         )
    //         ->groupBy('classes.denominationclasse', 'groupepedagogiques.libellegp', 'classes.effectif_total', 'classes.effectif_gar', 'classes.effectif_fil')
    //         ->orderBy('classes.denominationclasse', 'ASC')
    //         ->get();

    //     $apprenants = DB::table('apprenantannees')
    //         ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
    //         ->leftjoin('handicaps', 'apprenants.handicaps_id', '=', 'handicaps.id')
    //         ->leftjoin('typeshandicaps', 'handicaps.typeshandicaps_id', '=', 'typeshandicaps.id')
    //         ->leftjoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
    //         ->leftjoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
    //         ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->orderBy('apprenants.nom', 'ASC')
    //         ->select(
    //             "apprenantannees.*",
    //             "apprenants.*",
    //             "handicaps.libelle_handicap",
    //             "typeshandicaps.libelle_typeshandicap",
    //             "classes.denominationclasse AS la_classe",
    //             "statutapprenants.*",
    //             "bourses.*"
    //         )
    //         ->get()
    //         ->groupBy('la_classe');



    //     $nbre_apprenants = DB::table('apprenantannees')
    //         ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
    //         ->leftjoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
    //         ->leftjoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
    //         ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "apprenantannees.*",
    //             "apprenants.*",
    //             "classes.*",
    //             "statutapprenants.*",
    //             "bourses.*",
    //             "decision.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();

    //     $infrastructures = DB::table('infrastructures')
    //         ->leftjoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "infrastructures.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "designationinfrastructures.*",
    //             "infrastructures.capacite AS cap",
    //             "infrastructures.observation AS obs",
    //         )
    //         ->get();


    //     $nbre_infrastructures = DB::table('infrastructures')
    //         ->leftjoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "infrastructures.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "designationinfrastructures.*",

    //         )
    //         ->count();

    //     $equipements = DB::table('equipements')
    //         // ->leftjoin('materiels', 'equipements.materiels_id', '=', 'materiels.id')
    //         ->leftjoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "equipements.*",
    //             // "materiels.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_equipements = DB::table('equipements')
    //         // ->leftjoin('materiels', 'equipements.materiels_id', '=', 'materiels.id')
    //         ->leftjoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "equipements.*",
    //             // "materiels.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $activites = DB::table('activitesportive')
    //         ->leftjoin('sport', 'activitesportive.sport_id', '=', 'sport.id')
    //         ->leftjoin('etablissementannees', 'activitesportive.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "activitesportive.*",
    //             "sport.libellesport",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_activites = DB::table('activitesportive')
    //         ->leftjoin('sport', 'activitesportive.sport_id', '=', 'sport.id')
    //         ->leftjoin('etablissementannees', 'activitesportive.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "activitesportive.*",
    //             "sport.libellesport",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $associations = DB::table('associations')
    //         ->leftjoin('etablissementannees', 'associations.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "associations.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_associations = DB::table('associations')
    //         ->leftjoin('etablissementannees', 'associations.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "associations.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $probleme_urgents = DB::table('probleme_urgent')
    //         ->leftjoin('etablissementannees', 'probleme_urgent.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "probleme_urgent.libelleprobleme",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_probleme = DB::table('probleme_urgent')
    //         ->leftjoin('etablissementannees', 'probleme_urgent.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "probleme_urgent.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $conclusions = DB::table('conclusion')
    //         ->leftjoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "conclusion.libelleconclusion",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_conclusions = DB::table('conclusion')
    //         ->leftjoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "conclusion.libelleconclusion",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $emplois = DB::table('emploidutemps')
    //         ->leftjoin('etablissementannees', 'emploidutemps.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             'emploidutemps.*',
    //             'etablissementannees.*',
    //             'etablissements.*'
    //         )
    //         ->get();

    //     $emploisParClasse = $emplois->groupBy('denominationclasse');

    //     $emploisProfs = DB::table('emploidutempsprof')
    //         ->leftjoin('etablissementannees', 'emploidutempsprof.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('personnels', 'emploidutempsprof.personnels_id', '=', 'personnels.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             'emploidutempsprof.*',
    //             'personnels.nom',
    //             'personnels.prenoms'
    //         )
    //         ->orderBy('personnels.nom', 'ASC')
    //         ->orderBy('personnels.prenoms', 'ASC')
    //         ->get();

    //     $emploisParProf = $emploisProfs->groupBy(function ($item) {
    //         return $item->nom . ' ' . $item->prenoms;
    //     });

    //     // Point d'exécution des programmes
    //     $pointexecutions = DB::table('point_executions')
    //         ->leftjoin('disciplines', 'point_executions.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('etablissementannees', 'point_executions.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "point_executions.*",
    //             "disciplines.libellediscipline",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )
    //         ->get();

    //     // Besoins en personnel enseignant
    //     $besoinpersonnelens = DB::table('besoinpersonnelens')
    //         ->leftjoin('etablissementannees', 'besoinpersonnelens.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('disciplines', 'besoinpersonnelens.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('niveauenseignant', 'besoinpersonnelens.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoinpersonnelens.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "disciplines.*",
    //             "niveauenseignant.*"
    //         )
    //         ->get();

    //     // Extraire les Conseils d'Enseignement (cons_ens = 1)
    //     $conseilsEnseignement = $personnels->map(function($personnel) {
    //         return [
    //             'id' => $personnel->id,
    //             'nom' => $personnel->nom,
    //             'prenoms' => $personnel->prenoms,
    //             'telephone' => $personnel->tel,
    //             'email' => $personnel->pemail,
    //             'discipline' => $personnel->libellediscipline ?? 'aucun',
    //             'cons_ens' => $personnel->cons_ens
    //         ];
    //     })->filter(function($personnel) {
    //         return isset($personnel['cons_ens']) && $personnel['cons_ens'] == 1;
    //     });

    //     // Assurez-vous que le nom de l'établissement est formaté sans caractères spéciaux
    //     $nomEtablissement = preg_replace('/[^A-Za-z0-9_\- ]/', '', $etablissements->denominationetab ?? 'etablissement');


    //     $pdf = Pdf::loadView(
    //         'etab_identificationsem1',
    //         [
    //             'etablissements' => $etablissements,
    //             'filiere_enseignes' => $filiere_enseignes,
    //             'nbre_filiere_enseignes' => $nbre_filiere_enseignes,
    //             'personnels' => $personnels,
    //             'nbre_personnels' => $nbre_personnels,
    //             'classes' => $classes,
    //             'nbre_classes' => $nbre_classes,
    //             'apprenants' => $apprenants,
    //             'nbre_apprenants' => $nbre_apprenants,
    //             'infrastructures' => $infrastructures,
    //             'nbre_infrastructures' => $nbre_infrastructures,
    //             'equipements' => $equipements,
    //             'boursiers' => $BoursiersParClasse,
    //             'nbre_equipements' => $nbre_equipements,
    //             'activites' => $activites,
    //             'nbre_activites' => $nbre_activites,
    //             'associations' => $associations,
    //             'nbre_associations' => $nbre_associations,
    //             'probleme_urgents' => $probleme_urgents,
    //             'nbre_probleme' => $nbre_probleme,
    //             'conclusions' => $conclusions,
    //             'nbre_conclusions' => $nbre_conclusions,
    //             'emplois' => $emplois,
    //             'emploisParClasse' => $emploisParClasse,
    //             'emploisProfs' => $emploisProfs,
    //             'emploisParProf' => $emploisParProf,
    //             'classefilieres' => $classefilieres,
    //             'classefiliereParClasses' => $classefiliereParClasses,
    //             'classefilierepros' => $classefilierepros,
    //             'classefiliereproParClasses' => $classefiliereproParClasses,
    //             'classefilieretechs' => $classefilieretechs,
    //             'classefilieretechParClasses' => $classefilieretechParClasses,
    //             'equipedirections' => $equipedirections,
    //             'autrespersonnelsadmins' => $autrespersonnelsadmins,
    //             'effectifsenseignants' => $effectifsenseignants,
    //             'effectifsapprenants' => $effectifsapprenants,
    //             'effectifsapprenantsParFilieres' => $effectifsapprenantsParFilieres,
    //             'effectifsrecrutements' => $effectifsrecrutements,
    //             'statutsapprenants' => $statutsapprenants,
    //             'recapGens' => $recapGens,
    //             'recapEffectifs' => $recapEffectifs,
    //             'pointexecutions' => $pointexecutions,
    //             'besoinpersonnelens' => $besoinpersonnelens,
    //             'conseilsEnseignement' => $conseilsEnseignement,
    //         ]
    //     )->setPaper('a4', 'landscape');

    //     return $pdf->stream("Rapport_de_1erSemestre_{$nomEtablissement}.pdf");
    // }

    public function rapport_sem1($id)
    {
        ini_set('memory_limit', '-1');

        $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

        // ─────────────────────────────────────────
        // IDENTIFICATION DE L'ÉTABLISSEMENT
        // ─────────────────────────────────────────
        $etablissements = DB::table('etablissements')
            ->leftJoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->leftJoin('directiondepartementales', 'etablissements.directiondepartementales_id', '=', 'directiondepartementales.id')
            ->leftJoin('directionregionales', 'directiondepartementales.directionregionales_id', '=', 'directionregionales.id')
            ->leftJoin('communes', 'etablissements.communes_id', '=', 'communes.id')
            ->where('etablissements.id', $id)
            ->select(
                'etablissements.*',
                'ordre_enseignement.*',
                'directiondepartementales.*',
                'directionregionales.*',
                'communes.*',
                'ordre_enseignement.id AS ordre_en_id',
            )
            ->first();

        // Données clôture stockées dans etablissementannees
        $etabAnnee = DB::table('etablissementannees')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->select('existecloture', 'problemeequipement')
            ->first();

        // ─────────────────────────────────────────
        // FILIÈRES ENSEIGNÉES
        // ─────────────────────────────────────────
        $filiere_enseignes = DB::table('filiereenseignes')
            ->leftJoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
            ->leftJoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
            ->leftJoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('filiereenseignes.*', 'filieres.*', 'etablissementannees.*', 'etablissements.*', 'diplomeprepares.*')
            ->get();

        $nbre_filiere_enseignes = $filiere_enseignes->count();

        // ─────────────────────────────────────────
        // CLASSES FILIÈRES PAR ORDRE D'ENSEIGNEMENT
        // ─────────────────────────────────────────
        $classefilierepros          = collect();
        $classefiliereproParClasses = collect();
        $classefilieres             = collect();
        $classefiliereParClasses    = collect();
        $classefilieretechs         = collect();
        $classefilieretechParClasses = collect();

        if ($etablissements->ordre_enseignement_id == 1) {
            $classefilieres          = DB::table('classefilieretech')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();
            $classefiliereParClasses = $classefilieres->groupBy('libelleenseignement');
        }

        if ($etablissements->ordre_enseignement_id == 2) {
            $classefilieres          = DB::table('classefilierepro')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();
            $classefiliereParClasses = $classefilieres->groupBy('libelleenseignement');
        }

        if ($etablissements->ordre_enseignement_id == 4) {
            $classefilierepros           = DB::table('classefilieredeuxpro')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();
            $classefiliereproParClasses  = $classefilierepros->groupBy('libelleenseignement');

            $classefilieretechs          = DB::table('classefilieredeuxtech')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();
            $classefilieretechParClasses = $classefilieretechs->groupBy('libelleenseignement');
        }

        // ─────────────────────────────────────────
        // SECTION 1 : PERSONNEL ENSEIGNANT
        // ─────────────────────────────────────────

        // 1.1 Liste complète du personnel
        $personnels = DB::table('personnelannees')
            ->leftJoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
            ->leftJoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
            ->leftJoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
            ->leftJoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
            ->leftJoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
            ->leftJoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
            ->leftJoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                'personnelannees.*',
                'personnels.*',
                'personnels.email AS pemail',
                'personnels.telephone AS tel',
                'typepersonnels.*',
                'diplomepersonnels.*',
                'disciplines.*',
                'etablissementannees.*',
                'etablissements.*',
                'statutpersonnel.*',
                'fonctionpersonnels.*',
                'niveauenseignant.*',
            )
            ->get();

        $nbre_personnels = $personnels->count();

        // 1.1bis Effectif par discipline et par genre (tableau IG/IC/IP/PL/PC/IFPB/IAFPB)
        $effectifsenseignants = DB::table('effectifenseignantdiscipline')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediscipline', 'ASC')
            ->get();

        $effectifsEnseignantsParDiscipline = DB::table('v_effectif_enseignant_discipline_genre')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediscipline', 'ASC')
            ->get()
            ->groupBy('libellediscipline');

        // 1.2 Conseils d'enseignement
        $conseilsEnseignement = $personnels->map(function ($personnel) {
            return [
                'id'         => $personnel->id,
                'nom'        => $personnel->nom,
                'prenoms'    => $personnel->prenoms,
                'telephone'  => $personnel->tel,
                'email'      => $personnel->pemail,
                'discipline' => $personnel->libellediscipline ?? 'Aucune',
                'cons_ens'   => $personnel->cons_ens,
            ];
        })->filter(fn($p) => isset($p['cons_ens']) && $p['cons_ens'] == 1);

        // 1.3 Besoins en personnel enseignant
        $besoinpersonnelens = DB::table('besoinpersonnelens')
            ->leftJoin('etablissementannees', 'besoinpersonnelens.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftJoin('disciplines', 'besoinpersonnelens.disciplines_id', '=', 'disciplines.id')
            ->leftJoin('niveauenseignant', 'besoinpersonnelens.niveauenseignant_id', '=', 'niveauenseignant.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                'besoinpersonnelens.*',
                'disciplines.*',
                'niveauenseignant.*',
                'niveauenseignant.libelleniveau AS libelleniveauenseignant',
            )
            ->get();

        // ─────────────────────────────────────────
        // SECTION 2 : APPRENANTS
        // ─────────────────────────────────────────

        // 2.1 Effectif des apprenants par niveau et par classe
        $classes = DB::table('classes')
            ->leftJoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
            ->leftJoin('filieres', 'groupepedagogiques.filieres_id', '=', 'filieres.id')
            ->leftJoin('diplomeprepares', 'groupepedagogiques.diplomeprepares_id', '=', 'diplomeprepares.id')
            ->leftJoin('niveau', 'groupepedagogiques.niveau_id', '=', 'niveau.id')
            ->leftJoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->where('classes.type_cours', '!=', 1) // Exclure cours du soir de ce tableau
            ->select(
                'classes.*',
                'groupepedagogiques.*',
                'filieres.libellefiliere',
                'diplomeprepares.libellediplome',
                'niveau.libelleniveau',
                'etablissementannees.*',
                'etablissements.*',
            )
            ->get();

        $nbre_classes = $classes->count();

        // Regrouper par diplôme pour les tableaux Technique / Pro / Supérieur
        $classeParDiplome = $classes->groupBy('libellediplome');

        // Données boursiers/affectés par classe
        $BoursiersParClasse = DB::table('classes')
            ->leftJoin('apprenantannees', 'classes.id', '=', 'apprenantannees.classes_id')
            ->leftJoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
            ->leftJoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
            ->leftJoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                'classes.denominationclasse',
                'classes.effectif_total',
                'classes.effectif_gar',
                'classes.effectif_fil',
                'groupepedagogiques.libellegp',
                DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 1 THEN 1 ELSE 0 END) AS nombre_boursiers"),
                DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 2 THEN 1 ELSE 0 END) AS nombre_non_boursiers"),
                DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 4 THEN 1 ELSE 0 END) AS nombre_affectes"),
                DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 5 THEN 1 ELSE 0 END) AS nombre_non_affectes"),
            )
            ->groupBy('classes.denominationclasse', 'groupepedagogiques.libellegp', 'classes.effectif_total', 'classes.effectif_gar', 'classes.effectif_fil')
            ->orderBy('classes.denominationclasse', 'ASC')
            ->get();

        // Effectif détaillé (vue avec boursier/non-boursier par filière)
        $effectifsapprenants = DB::table('effectifApprenantNiveauClasseBourse')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediplome', 'ASC')
            ->orderBy('libellefiliere', 'ASC')
            ->get();

        $effectifsapprenantsParFilieres = $effectifsapprenants->groupBy(function ($item) {
            return $item->etablissement_ordre . ' : ' . $item->libellediplome . ' - ' . $item->libellefiliere;
        });

        // Effectif avec sexe par classe (vue effectifapprenantniveauclassesexe)
        $effectifsApprenantsParClasseSexe = DB::table('effectifapprenantniveauclassesexe')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get()
            ->groupBy('libellediplome');

        // 2.2 Mode de recrutement
        $effectifsrecrutements = DB::table('effectifsDesEntrantsParModeRecrutement')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediplome', 'ASC')
            ->get();

        // 2.3 Statut des apprenants
        $statutsapprenants = DB::table('statutApprenantFiliereNiveau')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediplome', 'ASC')
            ->orderBy('libellefiliere', 'ASC')
            ->get();

        // 2.4 Récapitulatif général
        $recapGens = DB::table('recapGeneral')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libelleniveau', 'ASC')
            ->get();

        $recapEffectifs = DB::table('RecapGeneralNouveauEntrant')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libelleniveau', 'ASC')
            ->get();

        // Récapitulatif capacité / effectif inscrits / écart (second tableau section 2.4)
        $recapCapaciteEffectif = DB::table('v_recap_capacite_effectif')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get();

        // 2.5 Cours du soir
        $coursSoir = DB::table('v_cours_soir')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediplome', 'ASC')
            ->orderBy('libelleniveau', 'ASC')
            ->get();

        $nbre_cours_soir = $coursSoir->count();

        // Liste des apprenants par classe (pour les listes nominatives)
        $apprenants = DB::table('apprenantannees')
            ->leftJoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
            ->leftJoin('handicaps', 'apprenants.handicaps_id', '=', 'handicaps.id')
            ->leftJoin('typeshandicaps', 'handicaps.typeshandicaps_id', '=', 'typeshandicaps.id')
            ->leftJoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
            ->leftJoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
            ->leftJoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
            ->leftJoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
            ->leftJoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->orderBy('apprenants.nom', 'ASC')
            ->select(
                'apprenantannees.*',
                'apprenants.*',
                'handicaps.libelle_handicap',
                'typeshandicaps.libelle_typeshandicap',
                'classes.denominationclasse AS la_classe',
                'statutapprenants.*',
                'bourses.*',
            )
            ->get()
            ->groupBy('la_classe');

        $nbre_apprenants = $apprenants->flatten()->count();

        // ─────────────────────────────────────────
        // SECTION 3 : EXÉCUTION DES PROGRAMMES
        // ─────────────────────────────────────────
        $pointexecutions = DB::table('point_executions')
            ->leftJoin('disciplines', 'point_executions.disciplines_id', '=', 'disciplines.id')
            ->leftJoin('etablissementannees', 'point_executions.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                'point_executions.*',
                'disciplines.libellediscipline',
                'etablissementannees.*',
                'etablissements.*',
            )
            ->get();

        // ─────────────────────────────────────────
        // SECTION 4 (bis) : INDICATEURS DE PERFORMANCE
        // ─────────────────────────────────────────
        $indicateurs = DB::table('v_indicateurs_performance')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get();

        // ─────────────────────────────────────────
        // SECTION 4 : RÉSULTATS DU 1ER SEMESTRE
        // ─────────────────────────────────────────

        // 4.1 Résultats par classe et par niveau
        $resultatsclasses = DB::table('v_resultatclasse_sem1')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('libellediplome', 'ASC')
            ->orderBy('denominationclasse', 'ASC')
            ->get();

        $nbre_resultatsclasses = $resultatsclasses->count();

        // 4.2 Récapitulatif résultats par niveau et par filière (examens)
        $resultatexamens = DB::table('resultatexamens')
            ->leftJoin('diplomeprepares', 'resultatexamens.diplomeprepares_id', '=', 'diplomeprepares.id')
            ->leftJoin('filieres', 'resultatexamens.filieres_id', '=', 'filieres.id')
            ->leftJoin('etablissementannees', 'resultatexamens.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissementannees.etablissements_id', $id)
            ->select(
                'resultatexamens.*',
                'diplomeprepares.libellediplome',
                'filieres.libellefiliere',
            )
            ->orderBy('diplomeprepares.libellediplome', 'ASC')
            ->orderBy('filieres.libellefiliere', 'ASC')
            ->get();

        $nbre_resultatexamens = $resultatexamens->count();

        // 4.3 Abandons et reports de scolarité
        $abandonsReports = DB::table('v_abandons_sem1')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->orderBy('type', 'ASC')
            ->orderBy('nom', 'ASC')
            ->get();

        $nbre_abandons = $abandonsReports->count();

        // ─────────────────────────────────────────
        // SECTION 5 : INFRASTRUCTURES ET LOCAUX
        // ─────────────────────────────────────────
        $infrastructures = DB::table('infrastructures')
            ->leftJoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                'infrastructures.*',
                'etablissementannees.*',
                'etablissements.*',
                'designationinfrastructures.*',
                'infrastructures.capacite AS cap',
                'infrastructures.observation AS obs',
            )
            ->get();

        $nbre_infrastructures = $infrastructures->count();

        // 5.3 Problèmes liés aux infrastructures
        $probleme_infrastructures = DB::table('probleme_infrastructures')
            ->leftJoin('etablissementannees', 'probleme_infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('probleme_infrastructures.libelleprobleme', 'etablissementannees.*', 'etablissements.*')
            ->get();

        $nbre_probleme_infra = $probleme_infrastructures->count();

        // ─────────────────────────────────────────
        // SECTION 6 : NOUVELLES ACQUISITIONS
        // ─────────────────────────────────────────
        $equipements = DB::table('equipements')
            ->leftJoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('equipements.*', 'etablissementannees.*', 'etablissements.*')
            ->get();

        $nbre_equipements = $equipements->count();

        // ─────────────────────────────────────────
        // SECTION 7 : PROBLÈMES URGENTS
        // ─────────────────────────────────────────
        $probleme_urgents = DB::table('probleme_urgent')
            ->leftJoin('etablissementannees', 'probleme_urgent.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('probleme_urgent.libelleprobleme', 'etablissementannees.*', 'etablissements.*')
            ->get();

        $nbre_probleme = $probleme_urgents->count();

        // ─────────────────────────────────────────
        // SECTION DILIGENCES
        // ─────────────────────────────────────────
        $diligences = DB::table('diligences')
            ->leftJoin('etablissementannees', 'diligences.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('diligences.libellediligence', 'etablissementannees.*', 'etablissements.*')
            ->get();

        $nbre_diligences = $diligences->count();

        // ─────────────────────────────────────────
        // CONCLUSION
        // ─────────────────────────────────────────
        $conclusions = DB::table('conclusion')
            ->leftJoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('conclusion.libelleconclusion', 'etablissementannees.*', 'etablissements.*')
            ->get();

        $nbre_conclusions = $conclusions->count();

        // ─────────────────────────────────────────
        // ÉQUIPE DE DIRECTION & AUTRES PERSONNELS
        // ─────────────────────────────────────────
        $equipedirections = DB::table('equipedirection')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get();

        $autrespersonnelsadmins = DB::table('autrespersonnelsadministratifs')
            ->where('etablissements_id', $id)
            ->where('anneescolaires_id', $anneescolaires_id)
            ->get();

        // ─────────────────────────────────────────
        // EMPLOIS DU TEMPS
        // ─────────────────────────────────────────
        $emplois = DB::table('emploidutemps')
            ->leftJoin('etablissementannees', 'emploidutemps.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('emploidutemps.*', 'etablissementannees.*', 'etablissements.*')
            ->get();

        $emploisParClasse = $emplois->groupBy('denominationclasse');

        $emploisProfs = DB::table('emploidutempsprof')
            ->leftJoin('etablissementannees', 'emploidutempsprof.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('personnels', 'emploidutempsprof.personnels_id', '=', 'personnels.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('emploidutempsprof.*', 'personnels.nom', 'personnels.prenoms')
            ->orderBy('personnels.nom', 'ASC')
            ->orderBy('personnels.prenoms', 'ASC')
            ->get();

        $emploisParProf = $emploisProfs->groupBy(fn($item) => $item->nom . ' ' . $item->prenoms);

        // ─────────────────────────────────────────
        // ACTIVITÉS, ASSOCIATIONS
        // ─────────────────────────────────────────
        $activites = DB::table('activitesportive')
            ->leftJoin('sport', 'activitesportive.sport_id', '=', 'sport.id')
            ->leftJoin('etablissementannees', 'activitesportive.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('activitesportive.*', 'sport.libellesport', 'etablissementannees.*', 'etablissements.*')
            ->get();

        $nbre_activites = $activites->count();

        $associations = DB::table('associations')
            ->leftJoin('etablissementannees', 'associations.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftJoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select('associations.*', 'etablissementannees.*', 'etablissements.*')
            ->get();

        $nbre_associations = $associations->count();

        // ─────────────────────────────────────────
        // GÉNÉRATION PDF
        // ─────────────────────────────────────────
        $nomEtablissement = preg_replace('/[^A-Za-z0-9_\- ]/', '', $etablissements->denominationetab ?? 'etablissement');

        $pdf = Pdf::loadView('etab_identificationsem1', [
            // Identification
            'etablissements'                     => $etablissements,
            'etabAnnee'                          => $etabAnnee,
            // Filières
            'filiere_enseignes'                  => $filiere_enseignes,
            'nbre_filiere_enseignes'             => $nbre_filiere_enseignes,
            // Classes filières
            'classefilieres'                     => $classefilieres,
            'classefiliereParClasses'            => $classefiliereParClasses,
            'classefilierepros'                  => $classefilierepros,
            'classefiliereproParClasses'         => $classefiliereproParClasses,
            'classefilieretechs'                 => $classefilieretechs,
            'classefilieretechParClasses'        => $classefilieretechParClasses,
            // Personnel
            'personnels'                         => $personnels,
            'nbre_personnels'                    => $nbre_personnels,
            'effectifsenseignants'               => $effectifsenseignants,
            'effectifsEnseignantsParDiscipline'  => $effectifsEnseignantsParDiscipline,
            'conseilsEnseignement'               => $conseilsEnseignement,
            'besoinpersonnelens'                 => $besoinpersonnelens,
            'equipedirections'                   => $equipedirections,
            'autrespersonnelsadmins'             => $autrespersonnelsadmins,
            // Apprenants
            'classes'                            => $classes,
            'nbre_classes'                       => $nbre_classes,
            'classeParDiplome'                   => $classeParDiplome,
            'apprenants'                         => $apprenants,
            'nbre_apprenants'                    => $nbre_apprenants,
            'boursiers'                          => $BoursiersParClasse,
            'effectifsapprenants'                => $effectifsapprenants,
            'effectifsapprenantsParFilieres'     => $effectifsapprenantsParFilieres,
            'effectifsApprenantsParClasseSexe'   => $effectifsApprenantsParClasseSexe,
            'effectifsrecrutements'              => $effectifsrecrutements,
            'statutsapprenants'                  => $statutsapprenants,
            'recapGens'                          => $recapGens,
            'recapEffectifs'                     => $recapEffectifs,
            'recapCapaciteEffectif'              => $recapCapaciteEffectif,
            'coursSoir'                          => $coursSoir,
            'nbre_cours_soir'                    => $nbre_cours_soir,
            // Exécution des programmes
            'pointexecutions'                    => $pointexecutions,
            // Indicateurs de performance
            'indicateurs'                        => $indicateurs,
            // Résultats
            'resultatsclasses'                   => $resultatsclasses,
            'nbre_resultatsclasses'              => $nbre_resultatsclasses,
            'resultatexamens'                    => $resultatexamens,
            'nbre_resultatexamens'               => $nbre_resultatexamens,
            'abandonsReports'                    => $abandonsReports,
            'nbre_abandons'                      => $nbre_abandons,
            // Infrastructures
            'infrastructures'                    => $infrastructures,
            'nbre_infrastructures'               => $nbre_infrastructures,
            'probleme_infrastructures'           => $probleme_infrastructures,
            'nbre_probleme_infra'                => $nbre_probleme_infra,
            // Équipements
            'equipements'                        => $equipements,
            'nbre_equipements'                   => $nbre_equipements,
            // Problèmes urgents
            'probleme_urgents'                   => $probleme_urgents,
            'nbre_probleme'                      => $nbre_probleme,
            // Diligences
            'diligences'                         => $diligences,
            'nbre_diligences'                    => $nbre_diligences,
            // Conclusion
            'conclusions'                        => $conclusions,
            'nbre_conclusions'                   => $nbre_conclusions,
            // Emplois du temps
            'emplois'                            => $emplois,
            'emploisParClasse'                   => $emploisParClasse,
            'emploisProfs'                       => $emploisProfs,
            'emploisParProf'                     => $emploisParProf,
            // Activités
            'activites'                          => $activites,
            'nbre_activites'                     => $nbre_activites,
            'associations'                       => $associations,
            'nbre_associations'                  => $nbre_associations,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream("Rapport_de_1erSemestre_{$nomEtablissement}.pdf");
    }


    // public function rapport_sem2($id)
    // {
    //     ini_set('memory_limit', '-1');

    //     $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

    //     $etablissements = DB::table('etablissements')
    //         ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
    //         ->leftjoin('directiondepartementales', 'etablissements.directiondepartementales_id', '=', 'directiondepartementales.id')
    //         ->leftjoin('directionregionales', 'directiondepartementales.directionregionales_id', '=', 'directionregionales.id')
    //         ->leftjoin('communes', 'etablissements.communes_id', '=', 'communes.id')
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "etablissements.*",
    //             "ordre_enseignement.*",
    //             "directiondepartementales.*",
    //             "directionregionales.*",
    //             "communes.*",
    //             "ordre_enseignement.id AS ordre_en_id",
    //         )
    //         ->first();

    //     $filiere_enseignes = DB::table('filiereenseignes')
    //         ->leftjoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
    //         ->leftjoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
    //         ->leftjoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             // "filiereenseignes.numautorisationouverture AS filnumaut",
    //             "filiereenseignes.*",
    //             "filieres.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "diplomeprepares.*"
    //         )
    //         ->get();


    //     $nbre_filiere_enseignes = DB::table('filiereenseignes')
    //         ->leftjoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
    //         ->leftjoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
    //         ->leftjoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "filiereenseignes.numautorisationouverture AS filnumaut",
    //             "filiereenseignes.*",
    //             "filieres.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "diplomeprepares.*"
    //         )
    //         ->count();


    //     $personnels = DB::table('personnelannees')
    //         ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
    //         ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
    //         ->leftjoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
    //         ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
    //         ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
    //         ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)

    //         ->select(
    //             "personnelannees.*",
    //             "personnels.*",
    //             "personnels.email AS pemail",
    //             "personnels.telephone AS tel",
    //             "typepersonnels.*",
    //             "diplomepersonnels.*",
    //             "disciplines.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "statutpersonnel.*",
    //             "fonctionpersonnels.*",
    //             "niveauenseignant.*",
    //         )
    //         ->get();


    //     $nbre_personnels = DB::table('personnelannees')
    //         ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
    //         ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
    //         ->leftjoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
    //         ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
    //         ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
    //         ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)

    //         ->select(
    //             "personnelannees.*",
    //             "personnels.*",
    //             "personnels.email AS pemail",
    //             "personnels.telephone AS tel",
    //             "typepersonnels.*",
    //             "diplomepersonnels.*",
    //             "disciplines.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "statutpersonnel.*",
    //             "fonctionpersonnels.*",
    //             "niveauenseignant.*",
    //         )
    //         ->count();


    //     $classes = DB::table('classes')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "classes.*",
    //             "groupepedagogiques.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->get();

    //     $nbre_classes = DB::table('classes')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "classes.*",
    //             "groupepedagogiques.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();

    //     $BoursiersParClasse = DB::table('classes')
    //         ->leftjoin('apprenantannees', 'classes.id', '=', 'apprenantannees.classes_id')
    //         ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             'classes.denominationclasse',
    //             'classes.effectif_total',
    //             'classes.effectif_gar',
    //             'classes.effectif_fil',
    //             'groupepedagogiques.libellegp',
    //             DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 1 THEN 1 ELSE 0 END) AS nombre_boursiers"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 2 THEN 1 ELSE 0 END) AS nombre_non_boursiers"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 4 THEN 1 ELSE 0 END) AS nombre_affectes"),
    //             DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 5 THEN 1 ELSE 0 END) AS nombre_non_affectes"),

    //         )
    //         ->groupBy('classes.denominationclasse', 'groupepedagogiques.libellegp', 'classes.effectif_total', 'classes.effectif_gar', 'classes.effectif_fil')
    //         ->orderBy('classes.denominationclasse', 'ASC')
    //         ->get();

    //     $apprenants = DB::table('apprenantannees')
    //         ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
    //         ->leftjoin('handicaps', 'apprenants.handicaps_id', '=', 'handicaps.id')
    //         ->leftjoin('typeshandicaps', 'handicaps.typeshandicaps_id', '=', 'typeshandicaps.id')
    //         ->leftjoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
    //         ->leftjoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
    //         ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->orderBy('apprenants.nom', 'ASC')
    //         ->select(
    //             "apprenantannees.*",
    //             "apprenants.*",
    //             "handicaps.libelle_handicap",
    //             "typeshandicaps.libelle_typeshandicap",
    //             "classes.denominationclasse AS la_classe",
    //             "statutapprenants.*",
    //             "decision.*",
    //             "bourses.*"
    //         )
    //         ->get()
    //         ->groupBy('la_classe');


    //     $nbre_apprenants = DB::table('apprenantannees')
    //         ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
    //         ->leftjoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
    //         ->leftjoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
    //         ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
    //         ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
    //         ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "apprenantannees.*",
    //             "apprenants.*",
    //             "classes.*",
    //             "statutapprenants.*",
    //             "bourses.*",
    //             "decision.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();

    //     $infrastructures = DB::table('infrastructures')
    //         ->leftjoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "infrastructures.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "designationinfrastructures.*",
    //             "infrastructures.capacite AS cap",
    //             "infrastructures.observation AS obs",
    //         )
    //         ->get();


    //     $nbre_infrastructures = DB::table('infrastructures')
    //         ->leftjoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "infrastructures.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "designationinfrastructures.*",

    //         )
    //         ->count();

    //     $equipements = DB::table('equipements')
    //         // ->leftjoin('materiels', 'equipements.materiels_id', '=', 'materiels.id')
    //         ->leftjoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "equipements.*",
    //             // "materiels.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->get();

    //     $nbre_equipements = DB::table('equipements')
    //         // ->leftjoin('materiels', 'equipements.materiels_id', '=', 'materiels.id')
    //         ->leftjoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "equipements.*",
    //             "materiels.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //         )->count();

    //     $besoins = DB::table('besoinformation')
    //         ->leftjoin('etablissementannees', 'besoinformation.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoinformation.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->get();

    //     $nbre_besoins = DB::table('besoinformation')
    //         ->leftjoin('etablissementannees', 'besoinformation.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoinformation.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();

    //     $conclusions = DB::table('conclusion')
    //         ->leftjoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "conclusion.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->get();

    //     $nbre_conclusions = DB::table('conclusion')
    //         ->leftjoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "conclusion.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();

    //     $resultatexamens = DB::table('resultatexamens')
    //         ->leftjoin('etablissementannees', 'resultatexamens.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('diplomeprepares', 'resultatexamens.diplomeprepares_id', '=', 'diplomeprepares.id')
    //         ->leftjoin('filieres', 'resultatexamens.filieres_id', '=', 'filieres.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "resultatexamens.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "diplomeprepares.*",
    //             "filieres.*",
    //         )->get();


    //     $nbre_resultatexamens = DB::table('resultatexamens')
    //         ->leftjoin('etablissementannees', 'resultatexamens.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('diplomeprepares', 'resultatexamens.diplomeprepares_id', '=', 'diplomeprepares.id')
    //         ->leftjoin('filieres', 'resultatexamens.filieres_id', '=', 'filieres.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "resultatexamens.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "diplomeprepares.*",
    //             "filieres.*",
    //         )->count();

    //     $besoinsenmateriels = DB::table('besoin')
    //         ->leftjoin('etablissementannees', 'besoin.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('materiels', 'besoin.materiels_id', '=', 'materiels.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoin.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "materiels.*",
    //         )->get();


    //     $nbre_besoinsenmateriels = DB::table('besoin')
    //         ->leftjoin('etablissementannees', 'besoin.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('materiels', 'besoin.materiels_id', '=', 'materiels.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoin.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "materiels.*",
    //         )->count();

    //     $previsions = DB::table('previsions')
    //         ->leftjoin('etablissementannees', 'previsions.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "previsions.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->get();

    //     $nbre_previsions = DB::table('previsions')
    //         ->leftjoin('etablissementannees', 'previsions.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "previsions.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();


    //     $etatgestions = DB::table('etatgestion')
    //         ->leftjoin('etablissementannees', 'etatgestion.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "etatgestion.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->get();


    //     $nbre_etatgestions = DB::table('etatgestion')
    //         ->leftjoin('etablissementannees', 'etatgestion.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "etatgestion.*",
    //             "etablissementannees.*",
    //             "etablissements.*"
    //         )->count();


    //     $besoinpersonnel_admins = DB::table('besoinpersonneladm')
    //         ->leftjoin('etablissementannees', 'besoinpersonneladm.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('fonctionpersonnels', 'besoinpersonneladm.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
    //         ->leftjoin('typepersonnels', 'fonctionpersonnels.typepersonnels_id', '=', 'typepersonnels.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoinpersonneladm.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "fonctionpersonnels.*",
    //             "typepersonnels.*",
    //         )->get();


    //     $nbre_besoinpersonnel_admins = DB::table('besoinpersonneladm')
    //         ->leftjoin('etablissementannees', 'besoinpersonneladm.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('fonctionpersonnels', 'besoinpersonneladm.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
    //         ->leftjoin('typepersonnels', 'fonctionpersonnels.typepersonnels_id', '=', 'typepersonnels.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoinpersonneladm.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "fonctionpersonnels.*",
    //             "typepersonnels.*",
    //         )->count();

    //     $besoinpersonnelens = DB::table('besoinpersonnelens')
    //         ->leftjoin('etablissementannees', 'besoinpersonnelens.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('disciplines', 'besoinpersonnelens.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('niveauenseignant', 'besoinpersonnelens.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoinpersonnelens.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "disciplines.*",
    //             "niveauenseignant.*"
    //         )->get();

    //     $nbre_besoinpersonnelens = DB::table('besoinpersonnelens')
    //         ->leftjoin('etablissementannees', 'besoinpersonnelens.etablissementannees_id', '=', 'etablissementannees.id')
    //         ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
    //         ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
    //         ->leftjoin('disciplines', 'besoinpersonnelens.disciplines_id', '=', 'disciplines.id')
    //         ->leftjoin('niveauenseignant', 'besoinpersonnelens.niveauenseignant_id', '=', 'niveauenseignant.id')
    //         ->where('anneescolaires.id', $anneescolaires_id)
    //         ->where('etablissements.id', $id)
    //         ->select(
    //             "besoinpersonnelens.*",
    //             "etablissementannees.*",
    //             "etablissements.*",
    //             "disciplines.*",
    //             "niveauenseignant.*"
    //         )->count();

    //     // dd($nbre_previsions);

    //     // Assurez-vous que le nom de l'établissement est formaté sans caractères spéciaux
    //     $nomEtablissement = preg_replace('/[^A-Za-z0-9_\- ]/', '', $etablissements->denominationetab ?? 'etablissement');

    //     $pdf = Pdf::loadView(
    //         'etab_identificationsem2',
    //         [
    //             'etablissements' => $etablissements,
    //             'filiere_enseignes' => $filiere_enseignes,
    //             'nbre_filiere_enseignes' => $nbre_filiere_enseignes,
    //             'personnels' => $personnels,
    //             'nbre_personnels' => $nbre_personnels,
    //             'classes' => $classes,
    //             'nbre_classes' => $nbre_classes,
    //             'boursiers' => $BoursiersParClasse,
    //             'apprenants' => $apprenants,
    //             'nbre_apprenants' => $nbre_apprenants,
    //             'infrastructures' => $infrastructures,
    //             'nbre_infrastructures' => $nbre_infrastructures,
    //             'equipements' => $equipements,
    //             'nbre_equipements' => $nbre_equipements,
    //             'besoins' => $besoins,
    //             'nbre_besoins' => $nbre_besoins,
    //             'conclusions' => $conclusions,
    //             'nbre_conclusions' => $nbre_conclusions,
    //             'resultatexamens' => $resultatexamens,
    //             'nbre_resultatexamens' => $nbre_resultatexamens,
    //             'besoinsenmateriels' => $besoinsenmateriels,
    //             'nbre_besoinsenmateriels' => $nbre_besoinsenmateriels,
    //             'previsions' => $previsions,
    //             'nbre_previsions' => $nbre_previsions,
    //             'etatgestions' => $etatgestions,
    //             'nbre_etatgestions' => $nbre_etatgestions,
    //             'besoinpersonnel_admins' => $besoinpersonnel_admins,
    //             'nbre_besoinpersonnel_admins' => $nbre_besoinpersonnel_admins,
    //             'besoinpersonnelens' => $besoinpersonnelens,
    //             'nbre_besoinpersonnelens' => $nbre_besoinpersonnelens,
    //         ]
    //     )->setPaper('a4', 'landscape');

    //     return $pdf->stream("Rapport_de_2emeSemestre_{$nomEtablissement}.pdf");
    // }

    public function rapport_sem2($id)
    {
        ini_set('memory_limit', '-1');

        $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

        // ---------------------------------------------------------------
        // 1. ETABLISSEMENT
        // ---------------------------------------------------------------
        $etablissements = DB::table('etablissements')
            ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->leftjoin('directiondepartementales', 'etablissements.directiondepartementales_id', '=', 'directiondepartementales.id')
            ->leftjoin('directionregionales', 'directiondepartementales.directionregionales_id', '=', 'directionregionales.id')
            ->leftjoin('communes', 'etablissements.communes_id', '=', 'communes.id')
            ->where('etablissements.id', $id)
            ->select(
                "etablissements.*",
                "ordre_enseignement.*",
                "directiondepartementales.*",
                "directionregionales.*",
                "communes.*",
                "ordre_enseignement.id AS ordre_en_id",
            )
            ->first();

        // ---------------------------------------------------------------
        // 2. FILIERES ENSEIGNEES (avec debouches et observations)
        // ---------------------------------------------------------------
        $filiere_enseignes = DB::table('filiereenseignes')
            ->leftjoin('filieres', 'filiereenseignes.filieres_id', '=', 'filieres.id')
            ->leftjoin('diplomeprepares', 'filiereenseignes.diplomeprepares_id', '=', 'diplomeprepares.id')
            ->leftjoin('etablissementannees', 'filiereenseignes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                // "filiereenseignes.numautorisationouverture AS filnumaut",
                "filiereenseignes.*",
                "filieres.*",
                "etablissementannees.*",
                "etablissements.*",
                "diplomeprepares.*"
            )
            ->get();

        $nbre_filiere_enseignes = $filiere_enseignes->count();

        // ---------------------------------------------------------------
        // 3. PERSONNELS — liste nominative (annexe)
        // ---------------------------------------------------------------
        $personnels = DB::table('personnelannees')
            ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
            ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
            ->leftjoin('diplomepersonnels', 'personnels.diplomepersonnels_id', '=', 'diplomepersonnels.id')
            ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
            ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftjoin('statutpersonnel', 'personnelannees.statutpersonnel_id', '=', 'statutpersonnel.id')
            ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
            ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "personnelannees.*",
                "personnels.*",
                "personnels.email AS pemail",
                "personnels.telephone AS tel",
                "typepersonnels.*",
                "diplomepersonnels.*",
                "disciplines.*",
                "etablissementannees.*",
                "etablissements.*",
                "statutpersonnel.*",
                "fonctionpersonnels.*",
                "niveauenseignant.*",
            )
            ->get();

        $nbre_personnels = $personnels->count();

        // Personnels enseignants agreges par discipline et grade (tableau Word)
        // Grades : PETP, PLP, PCFP, IFPB — adapter la valeur de libelleniveau selon la BDD
        $personnels_enseignants_par_discipline = DB::table('personnelannees')
            ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
            ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
            ->leftjoin('disciplines', 'personnelannees.disciplines_id', '=', 'disciplines.id')
            ->leftjoin('niveauenseignant', 'personnelannees.niveauenseignant_id', '=', 'niveauenseignant.id')
            ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->where('typepersonnels.libelletypepersonnel', 'like', '%enseignant%')
            ->select(
                "disciplines.libellediscipline",
                DB::raw("SUM(CASE WHEN niveauenseignant.libelleniveau = 'PETP' THEN 1 ELSE 0 END) AS nb_petp"),
                DB::raw("SUM(CASE WHEN niveauenseignant.libelleniveau = 'PLP'  THEN 1 ELSE 0 END) AS nb_plp"),
                DB::raw("SUM(CASE WHEN niveauenseignant.libelleniveau = 'PCFP' THEN 1 ELSE 0 END) AS nb_pcfp"),
                DB::raw("SUM(CASE WHEN niveauenseignant.libelleniveau = 'IFPB' THEN 1 ELSE 0 END) AS nb_ifpb"),
                DB::raw("COUNT(*) AS nb_total"),
            )
            ->groupBy('disciplines.libellediscipline')
            ->orderBy('disciplines.libellediscipline', 'ASC')
            ->get();

        // Personnels administratifs agreges par fonction
        $personnels_admins_par_fonction = DB::table('personnelannees')
            ->leftjoin('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
            ->leftjoin('typepersonnels', 'personnels.typepersonnels_id', '=', 'typepersonnels.id')
            ->leftjoin('fonctionpersonnels', 'personnelannees.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
            ->leftjoin('etablissementannees', 'personnelannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->where('typepersonnels.libelletypepersonnel', 'not like', '%enseignant%')
            ->select(
                "fonctionpersonnels.libellefonction",
                DB::raw("COUNT(*) AS nb_existants"),
            )
            ->groupBy('fonctionpersonnels.libellefonction')
            ->orderBy('fonctionpersonnels.libellefonction', 'ASC')
            ->get();

        // ---------------------------------------------------------------
        // 4. CLASSES
        // ---------------------------------------------------------------
        $classes = DB::table('classes')
            ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
            ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "classes.*",
                "groupepedagogiques.*",
                "etablissementannees.*",
                "etablissements.*"
            )->get();

        $nbre_classes = $classes->count();

        // ---------------------------------------------------------------
        // 5. EFFECTIFS ET SITUATION DES APPRENANTS
        //    avec colonnes BE / Demi-B / NB et Interne / Externe par genre
        // ---------------------------------------------------------------
        $BoursiersParClasse = DB::table('classes')
            ->leftjoin('apprenantannees', 'classes.id', '=', 'apprenantannees.classes_id')
            ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
            ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
            ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
            ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftjoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                'classes.denominationclasse',
                'classes.effectif_total',
                'classes.effectif_gar',
                'classes.effectif_fil',
                'groupepedagogiques.libellegp',
                // Bourse Entiere
                DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 1 AND apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS be_f"),
                DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 1 AND apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS be_g"),
                // Demi-Bourse
                DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 2 AND apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS demi_b_f"),
                DB::raw("SUM(CASE WHEN apprenantannees.bourses_id = 2 AND apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS demi_b_g"),
                // Non Boursier
                DB::raw("SUM(CASE WHEN (apprenantannees.bourses_id IS NULL OR apprenantannees.bourses_id = 0) AND apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS nb_f"),
                DB::raw("SUM(CASE WHEN (apprenantannees.bourses_id IS NULL OR apprenantannees.bourses_id = 0) AND apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS nb_g"),
                // Regime interne (statutapprenants_id = 4) / externe (= 5) — a ajuster selon la BDD
                DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 4 AND apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS interne_f"),
                DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 4 AND apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS interne_g"),
                DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 5 AND apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS externe_f"),
                DB::raw("SUM(CASE WHEN apprenantannees.statutapprenants_id = 5 AND apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS externe_g"),
            )
            ->groupBy('classes.denominationclasse', 'groupepedagogiques.libellegp', 'classes.effectif_total', 'classes.effectif_gar', 'classes.effectif_fil')
            ->orderBy('classes.denominationclasse', 'ASC')
            ->get();

        // ---------------------------------------------------------------
        // 6. APPRENANTS — liste nominative pour annexe (resultats scolaires par classe)
        // ---------------------------------------------------------------
        $apprenants = DB::table('apprenantannees')
            ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
            ->leftjoin('handicaps', 'apprenants.handicaps_id', '=', 'handicaps.id')
            ->leftjoin('typeshandicaps', 'handicaps.typeshandicaps_id', '=', 'typeshandicaps.id')
            ->leftjoin('classes', 'apprenantannees.classes_id', '=', 'classes.id')
            ->leftjoin('statutapprenants', 'apprenantannees.statutapprenants_id', '=', 'statutapprenants.id')
            ->leftjoin('bourses', 'apprenantannees.bourses_id', '=', 'bourses.id')
            ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
            ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->orderBy('apprenants.nom', 'ASC')
            ->select(
                "apprenantannees.*",
                "apprenants.*",
                "handicaps.libelle_handicap",
                "typeshandicaps.libelle_typeshandicap",
                "classes.denominationclasse AS la_classe",
                "statutapprenants.*",
                "decision.*",
                "bourses.*"
            )
            ->get()
            ->groupBy('la_classe');

        $nbre_apprenants = DB::table('apprenantannees')
            ->leftjoin('etablissementannees', 'apprenantannees.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->count();

        // ---------------------------------------------------------------
        // 7. RESULTATS DE FIN D'ANNEE — Admis / Redoublants / Riorientes par filiere
        // ---------------------------------------------------------------
        $resultats_fin_annee = DB::table('classes')
            ->leftjoin('apprenantannees', 'classes.id', '=', 'apprenantannees.classes_id')
            ->leftjoin('apprenants', 'apprenantannees.apprenants_id', '=', 'apprenants.id')
            ->leftjoin('decision', 'apprenantannees.decision_id', '=', 'decision.id')
            ->leftjoin('groupepedagogiques', 'classes.groupepedagogiques_id', '=', 'groupepedagogiques.id')
            // ->leftjoin('filiereenseignes', 'classes.filiereenseignes_id', '=', 'filiereenseignes.id')
            ->leftjoin('filieres', 'groupepedagogiques.filieres_id', '=', 'filieres.id')
            ->leftjoin('etablissementannees', 'classes.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                'filieres.libellefiliere',
                'groupepedagogiques.libellegp AS niveau',
                DB::raw("SUM(CASE WHEN apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS effectif_f"),
                DB::raw("SUM(CASE WHEN apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS effectif_g"),
                DB::raw("COUNT(apprenantannees.id) AS effectif_t"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%admis%'    AND apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS admis_f"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%admis%'    AND apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS admis_g"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%admis%'    THEN 1 ELSE 0 END) AS admis_t"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%redoubl%'  AND apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS redoublants_f"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%redoubl%'  AND apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS redoublants_g"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%redoubl%'  THEN 1 ELSE 0 END) AS redoublants_t"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%réorient%' AND apprenants.sexe = 'F' THEN 1 ELSE 0 END) AS reorientes_f"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%réorient%' AND apprenants.sexe = 'G' THEN 1 ELSE 0 END) AS reorientes_g"),
                DB::raw("SUM(CASE WHEN decision.libelledecision LIKE '%réorient%' THEN 1 ELSE 0 END) AS reorientes_t"),
            )
            ->groupBy('filieres.libellefiliere', 'groupepedagogiques.libellegp')
            ->orderBy('filieres.libellefiliere', 'ASC')
            ->get();

        $nbre_resultats_fin_annee = $resultats_fin_annee->count();

        // ---------------------------------------------------------------
        // 8. RESULTATS AUX EXAMENS SCOLAIRES
        // ---------------------------------------------------------------
        $resultatexamens = DB::table('resultatexamens')
            ->leftjoin('etablissementannees', 'resultatexamens.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftjoin('diplomeprepares', 'resultatexamens.diplomeprepares_id', '=', 'diplomeprepares.id')
            ->leftjoin('filieres', 'resultatexamens.filieres_id', '=', 'filieres.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "resultatexamens.*",
                "etablissementannees.*",
                "etablissements.*",
                "diplomeprepares.*",
                "filieres.*",
            )->get();

        $nbre_resultatexamens = $resultatexamens->count();

        // ---------------------------------------------------------------
        // 9. INDICATEURS DE PERFORMANCE (table a creer si inexistante)
        // ---------------------------------------------------------------
        $indicateurs = collect(); // remplacer par la vraie requete si la table existe
        $nbre_indicateurs = 0;

        // ---------------------------------------------------------------
        // 10. INFRASTRUCTURES
        // ---------------------------------------------------------------
        $infrastructures = DB::table('infrastructures')
            ->leftjoin('etablissementannees', 'infrastructures.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftjoin('designationinfrastructures', 'infrastructures.designationinfrastructures_id', '=', 'designationinfrastructures.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "infrastructures.*",
                "etablissementannees.*",
                "etablissements.*",
                "designationinfrastructures.*",
                "infrastructures.capacite AS cap",
                "infrastructures.observation AS obs",
            )
            ->get();

        $nbre_infrastructures = $infrastructures->count();

        // ---------------------------------------------------------------
        // 11. EQUIPEMENTS
        // ---------------------------------------------------------------
        $equipements = DB::table('equipements')
            ->leftjoin('etablissementannees', 'equipements.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "equipements.*",
                "etablissementannees.*",
                "etablissements.*",
            )->get();

        $nbre_equipements = $equipements->count();

        // ---------------------------------------------------------------
        // 12. BESOINS EN MATERIELS ET EQUIPEMENTS
        // ---------------------------------------------------------------
        $besoinsenmateriels = DB::table('besoin')
            ->leftjoin('etablissementannees', 'besoin.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftjoin('materiels', 'besoin.materiels_id', '=', 'materiels.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "besoin.*",
                "etablissementannees.*",
                "etablissements.*",
                "materiels.*",
            )->get();

        $nbre_besoinsenmateriels = $besoinsenmateriels->count();

        // ---------------------------------------------------------------
        // 13. GESTION FINANCIERE — difficultes et suggestions
        // ---------------------------------------------------------------
        $etatgestions = DB::table('etatgestion')
            ->leftjoin('etablissementannees', 'etatgestion.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "etatgestion.*",
                "etablissementannees.*",
                "etablissements.*"
            )->get();

        $nbre_etatgestions = $etatgestions->count();

        // ---------------------------------------------------------------
        // 14. ACTIVITES EXTRA-SCOLAIRES
        // ---------------------------------------------------------------
        $activites_extra = DB::table('activitesextrascolaires')
            ->leftjoin('etablissementannees', 'activitesextrascolaires.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select("activitesextrascolaires.*")
            ->get();

        $nbre_activites_extra = $activites_extra->count();

        // ---------------------------------------------------------------
        // 15. CONCLUSION GENERALE
        // ---------------------------------------------------------------
        $conclusions = DB::table('conclusion')
            ->leftjoin('etablissementannees', 'conclusion.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "conclusion.*",
                "etablissementannees.*",
                "etablissements.*"
            )->get();

        $nbre_conclusions = $conclusions->count();

        // ---------------------------------------------------------------
        // 16. PREVISIONS / PERSPECTIVES
        // ---------------------------------------------------------------
        $previsions = DB::table('previsions')
            ->leftjoin('etablissementannees', 'previsions.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "previsions.*",
                "etablissementannees.*",
                "etablissements.*"
            )->get();

        $nbre_previsions = $previsions->count();

        // ---------------------------------------------------------------
        // 17. BESOINS EN PERSONNEL ADMINISTRATIF
        // ---------------------------------------------------------------
        $besoinpersonnel_admins = DB::table('besoinpersonneladm')
            ->leftjoin('etablissementannees', 'besoinpersonneladm.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftjoin('fonctionpersonnels', 'besoinpersonneladm.fonctionpersonnels_id', '=', 'fonctionpersonnels.id')
            ->leftjoin('typepersonnels', 'fonctionpersonnels.typepersonnels_id', '=', 'typepersonnels.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "besoinpersonneladm.*",
                "etablissementannees.*",
                "etablissements.*",
                "fonctionpersonnels.*",
                "typepersonnels.*",
            )->get();

        $nbre_besoinpersonnel_admins = $besoinpersonnel_admins->count();

        // ---------------------------------------------------------------
        // 18. BESOINS EN PERSONNEL ENSEIGNANT
        // ---------------------------------------------------------------
        $besoinpersonnelens = DB::table('besoinpersonnelens')
            ->leftjoin('etablissementannees', 'besoinpersonnelens.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftjoin('disciplines', 'besoinpersonnelens.disciplines_id', '=', 'disciplines.id')
            ->leftjoin('niveauenseignant', 'besoinpersonnelens.niveauenseignant_id', '=', 'niveauenseignant.id')
            ->where('anneescolaires.id', $anneescolaires_id)
            ->where('etablissements.id', $id)
            ->select(
                "besoinpersonnelens.*",
                "etablissementannees.*",
                "etablissements.*",
                "disciplines.*",
                "niveauenseignant.*"
            )->get();

        $nbre_besoinpersonnelens = $besoinpersonnelens->count();

        // ---------------------------------------------------------------
        // GENERATION DU PDF
        // ---------------------------------------------------------------
        $nomEtablissement = preg_replace('/[^A-Za-z0-9_\- ]/', '', $etablissements->denominationetab ?? 'etablissement');

        $pdf = Pdf::loadView(
            'etab_identificationsem2',
            [
                'etablissements'                        => $etablissements,
                'filiere_enseignes'                     => $filiere_enseignes,
                'nbre_filiere_enseignes'                => $nbre_filiere_enseignes,
                'personnels'                            => $personnels,
                'nbre_personnels'                       => $nbre_personnels,
                'personnels_enseignants_par_discipline' => $personnels_enseignants_par_discipline,
                'personnels_admins_par_fonction'        => $personnels_admins_par_fonction,
                'classes'                               => $classes,
                'nbre_classes'                          => $nbre_classes,
                'boursiers'                             => $BoursiersParClasse,
                'apprenants'                            => $apprenants,
                'nbre_apprenants'                       => $nbre_apprenants,
                'resultats_fin_annee'                   => $resultats_fin_annee,
                'nbre_resultats_fin_annee'              => $nbre_resultats_fin_annee,
                'resultatexamens'                       => $resultatexamens,
                'nbre_resultatexamens'                  => $nbre_resultatexamens,
                'indicateurs'                           => $indicateurs,
                'nbre_indicateurs'                      => $nbre_indicateurs,
                'infrastructures'                       => $infrastructures,
                'nbre_infrastructures'                  => $nbre_infrastructures,
                'equipements'                           => $equipements,
                'nbre_equipements'                      => $nbre_equipements,
                'besoinsenmateriels'                    => $besoinsenmateriels,
                'nbre_besoinsenmateriels'               => $nbre_besoinsenmateriels,
                'etatgestions'                          => $etatgestions,
                'nbre_etatgestions'                     => $nbre_etatgestions,
                'activites_extra'                       => $activites_extra,
                'nbre_activites_extra'                  => $nbre_activites_extra,
                'conclusions'                           => $conclusions,
                'nbre_conclusions'                      => $nbre_conclusions,
                'previsions'                            => $previsions,
                'nbre_previsions'                       => $nbre_previsions,
                'besoinpersonnel_admins'                => $besoinpersonnel_admins,
                'nbre_besoinpersonnel_admins'           => $nbre_besoinpersonnel_admins,
                'besoinpersonnelens'                    => $besoinpersonnelens,
                'nbre_besoinpersonnelens'               => $nbre_besoinpersonnelens,
            ]
        )->setPaper('a4', 'landscape');

        return $pdf->stream("Rapport_de_2emeSemestre_{$nomEtablissement}.pdf");
    }



    public function observation($id)
    {

        $etablissements = DB::table('resultatsmission')
            ->leftjoin('mission', 'resultatsmission.mission_id', '=', 'mission.id')
            ->leftjoin('rubriquecontrole', 'resultatsmission.rubriquecontrole_id', '=', 'rubriquecontrole.id')
            ->leftjoin('etablissementannees', 'mission.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->leftJoin('anneescolaires', 'etablissementannees.anneescolaires_id', '=', 'anneescolaires.id')
            ->leftjoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
            ->where("mission.id", $id)
            ->first();

        $resultatmissions = DB::table('resultatsmission')
            ->leftjoin('mission', 'resultatsmission.mission_id', '=', 'mission.id')
            ->leftjoin('rubriquecontrole', 'resultatsmission.rubriquecontrole_id', '=', 'rubriquecontrole.id')
            ->leftjoin('etablissementannees', 'mission.etablissementannees_id', '=', 'etablissementannees.id')
            ->leftjoin('etablissements', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
            ->where("mission.id", $id)
            ->select(
                'resultatsmission.*',
                'mission.*',
                'rubriquecontrole.*',
                'etablissementannees.*',
                'etablissements.*',
                'mission.date AS missdate',
            )
            ->get();

        // dd($resultatmissions);
        $pdf = Pdf::loadView(
            'fiche_observation',
            [
                'resultatmissions' => $resultatmissions,
                'etablissements' => $etablissements,
            ]
        )->setPaper('a4', 'landscape');

        return $pdf->stream('fiche_observation.pdf'); // Vous pouvez aussi utiliser `download` pour télécharger le fichier

    }

    public function emploi_du_temps($id)
    {
        try {
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', 300); // Augmente le temps d'exécution à 5 minutes
            set_time_limit(300);

            $anneescolaires_id = Parametresglobaux::findOrFail(1)->anneescolaires_id;

            $etablissements = DB::table('etablissements')
                ->leftJoin('ordre_enseignement', 'etablissements.ordre_enseignement_id', '=', 'ordre_enseignement.id')
                ->leftJoin('directiondepartementales', 'etablissements.directiondepartementales_id', '=', 'directiondepartementales.id')
                ->leftJoin('directionregionales', 'directiondepartementales.directionregionales_id', '=', 'directionregionales.id')
                ->leftJoin('communes', 'etablissements.communes_id', '=', 'communes.id')
                ->where('etablissements.id', $id)
                ->select(
                    "etablissements.*",
                    "ordre_enseignement.*",
                    "directiondepartementales.*",
                    "directionregionales.*",
                    "communes.*",
                    "ordre_enseignement.id AS ordre_en_id"
                )
                ->first();



            $emplois = DB::table('emploidutemps')
                ->where('etablissements_id', $id)
                ->where('anneescolaires_id', $anneescolaires_id)
                ->get();

            $emploisParClasse = $emplois->groupBy('denominationclasse');

            $nomEtablissement = preg_replace('/[^A-Za-z0-9_\- ]/', '', $etablissements->denominationetab ?? 'etablissement');

            $pdf = Pdf::loadView(
                'emploidutemps',
                [
                    'etablissements' => $etablissements,
                    'emplois' => $emplois,
                    'emploisParClasse' => $emploisParClasse,
                ]
            )->setPaper('a4', 'landscape');

            return $pdf->stream('emplois_du_temps.pdf'); // Vous pouvez aussi utiliser `download` pour télécharger le fichier

            // return $pdf->download("Emploisdutemps_{$nomEtablissement}.pdf");

        } catch (Exception $e) {
            // Log the error for debugging
            Log::error("Error generating timetable PDF: {$e->getMessage()}");
            return response()->json(['error' => 'Unable to generate timetable.'], 500);
        }
    }
}
