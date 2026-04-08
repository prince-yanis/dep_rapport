<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('activitesportives', ActivitesportiveController::class);
    $router->resource('anneescolaires', AnneescolaireController::class);
    $router->resource('anneescolairesperiodes', AnneescolairesperiodeController::class);
    $router->resource('apprenants', ApprenantController::class);
    $router->resource('apprenantannees', ApprenantanneeController::class);
	$router->resource('apprenantannees2', Apprenantannee2Controller::class);
    $router->resource('associations', AssociationController::class);
    $router->resource('besoins', BesoinController::class);
    $router->resource('besoininfrastructures', BesoininfrastructureController::class);
    $router->resource('bourses', BourseController::class);
    $router->resource('classes', ClasseController::class);
    $router->resource('communes', CommuneController::class);
    $router->resource('departements', DepartementController::class);
    $router->resource('designationinfrastructures', DesignationinfrastructureController::class);
    $router->resource('diplomepersonnels', DiplomepersonnelController::class);
    $router->resource('diplomeprepares', DiplomeprepareController::class);
    $router->resource('directiondepartementales', DirectiondepartementaleController::class);
    $router->resource('directionregionales', DirectionregionaleController::class);
    $router->resource('disciplines', DisciplineController::class);
    $router->resource('districts', DistrictController::class);
    $router->resource('etablissements', EtablissementController::class);
    $router->resource('etablissements2', Etablissement2Controller::class);    
    $router->resource('documentsadministratifs', DocumentEtabController::class);    
    $router->resource('etablissementannees', EtablissementanneeController::class);
    $router->resource('filieres', FiliereController::class);
    // $router->resource('filiereautorises', FiliereautoriseController::class);
    $router->resource('filiereenseignes', FiliereenseigneController::class);
    $router->resource('fonctionpersonnels', FonctionpersonnelController::class);
    $router->resource('groupepedagogiques', GroupepedagogiqueController::class);
    $router->resource('heures', HeureController::class);
    $router->resource('infrastructures', InfrastructureController::class);
    $router->resource('jours', JourController::class);
    $router->resource('materiels', MaterielController::class);
    $router->resource('niveaux', NiveauController::class);
    $router->resource('niveauenseignants', NiveauenseignantController::class);
    $router->resource('periodes', PeriodeController::class);
    $router->resource('personnels', PersonnelController::class);
    $router->resource('personnelannees', PersonnelanneeController::class);
	$router->resource('personnelannees2', Personnelannee2Controller::class);
    $router->resource('plannings', PlanningController::class);
    $router->resource('emploidutemps', Etablissement_planningController::class);
	
	$router->get('getEvents', 'PlanningsController@getEvents');
	$router->get('getFilteredEvents', 'PlanningsController@getFilteredEvents')->name('admin.getFilteredEvents');
	$router->get('plannings1', 'PlanningsController@index1');
	$router->get('planningsdate', 'PlanningsController@lesdates');
	// $router->post('miseajourplanning','PlanningController@ajaxUpdate');
	$router->post('miseajourplanning','PlanningsController@ajaxUpdate');
	$router->post('supprimerplanning','PlanningsController@ajaxDelete');

    //Remplissage des rapports
    $router->get('remplissagerentree', 'ApprenantanneeController@remplissagerentree');
    $router->get('remplissage1ersemestre', 'Apprenantannee_1erController@remplissage1ersemestre');
    $router->get('remplissage2emesemestre', 'Apprenantannee_2emeController@remplissage2emesemestre');
	
	//$router->post('/remplissageequipe',['as'=>'remplissageequipe', 'uses'=> 'InsertionDansParcoursController@valider'] );
    $router->resource('regions', RegionController::class);
    $router->resource('resultats', ResultatController::class);
    $router->resource('series', SerieController::class);
    $router->resource('sports', SportController::class);
    $router->resource('statutapprenants', StatutapprenantController::class);
    $router->resource('statutpersonnels', StatutpersonnelController::class);
    $router->resource('typeperiodes', TypeperiodeController::class);
    $router->resource('typepersonnels', TypepersonnelController::class);
    $router->resource('unitepedagogiques', UnitepedagogiqueController::class);
    $router->resource('parametresglobauxes', ParametresglobauxController::class);
    $router->resource('periodesannuelles', PeriodesannuelleController::class);
    $router->resource('equipements', EquipementsController::class);
    $router->resource('problemeurgents', ProblemeurgentController::class);
    $router->resource('besoinpersonneladms', BesoinpersonneladmController::class);
    $router->resource('besoinpersonnelens', BesoinpersonnelensController::class);
    $router->resource('resultatexamens', ResultatexamenController::class);
    $router->resource('previsions', PrevisionController::class);
    $router->resource('conclusions', ConclusionController::class);
    $router->resource('etatgestions', EtatgestionController::class);
    $router->resource('fonctionparticipants', FonctionparticipantController::class);

// Rentrée
    $router->resource('ordreenseignements', OrdreEnseignementController::class);
    $router->resource('etablissementdetails', EtablissementDetailsController::class);
    $router->resource('etabanneepersonnel', EtablissementanneePersonnelController::class);
	 $router->resource('etabanneepersonnel2', EtablissementanneePersonnel2Controller::class);
    $router->resource('etabanneeapprenant', EtablissementanneeApprenantController::class);
    $router->resource('apprenantetab', EtabApprenantController::class);
    $router->resource('personneletab', PersonnelEtabController::class);
    $router->resource('infobase', EtablissementanneeInfoBaseController::class);
    $router->resource('etabanneeinfrastructure', EtablissementanneeInfrastructureController::class);
    $router->resource('etabanneebesoininfrastructure', EtablissementanneeBesoinInfrastructureController::class);
    $router->resource('etabanneeclasse', EtablissementanneeClasseController::class);
    $router->resource('etabanneeactivitesportive', EtablissementanneeActiviteSportiveController::class);
    $router->resource('etabanneeassociation', EtablissementanneeAssociationController::class);
    $router->resource('etabanneeresultat', EtablissementanneeResultatController::class);
    $router->resource('etabanneefiliereenseigne', EtablissementanneeFiliereEnseigneController::class);
    $router->resource('etablissementdetails2eme', EtablissementDetails2emeSemestreController::class);
    $router->resource('etabanneesocio', EtablissementanneeSocioController::class);
    $router->resource('etabanneeprobleme', EtablissementanneeProblemeController::class);
    // $router->resource('etabanneeinventaire', EtablissementanneeEquipementController::class);
    $router->resource('etabanneebesoinformation', EtablissementanneeBesoinformationController::class);
    $router->resource('decisions', DecisionController::class);
    $router->resource('etabanneeplanning', EtablissementanneePlanningController::class);

    $router->resource('etabanneepoint', EtablissementanneePointExecutionController::class);
    $router->resource('etabanneeindicateurs', EtablissementanneeIndicateurController::class);
    $router->resource('etabanneeproblemeinfrastructures', EtablissementanneeProblemeInfrastructureController::class);
    $router->resource('etabanneeinventaire', EtablissementanneeEquipementController::class);
    $router->resource('etabanneebudgets', EtablissementanneeExecutionBudgetController::class);
    $router->resource('etabanneeressources', EtablissementanneeRessourcesAdditionnelleController::class);
    $router->resource('etabanneeperspectives', EtablissementanneePerspectiveController::class);
    $router->resource('etabanneecomite', EtablissementanneeComiteGestionController::class);
    $router->resource('etabanneetravaux', EtablissementanneeTravauxExterieurController::class);
    $router->resource('etabanneescolarites', EtablissementanneeFraisScolariteController::class);
    $router->resource('etabanneeconclusion', EtablissementanneeConclusionController::class);
    $router->resource('besoin-urgents', BesoinUrgentController::class);
    $router->resource('itemsindicateurs', ItemsindicateurController::class);
    $router->resource('amenagements', AmenagementController::class);

    //1er Semestre
    $router->resource('etablissements1er', Etablissement1erSemestreController::class);    
    $router->resource('etablissementdetails1er', EtablissementDetails1erSemestreController::class);
    $router->resource('etabanneefiliereenseigne1er', EtablissementanneeFiliereEnseigne1erController::class);
    $router->resource('etabanneepersonnel1er', Personnelannee2_1erController::class);
    $router->resource('etabanneeclasse1er', EtablissementanneeClasse1erController::class);
    $router->resource('etabanneeapprenant1er', Apprenantannee2_1erController::class);
    $router->resource('etabanneeinfrastructure1er', EtablissementanneeInfrastructure1erController::class);
    $router->resource('etabanneeinventaire1er', EtablissementanneeEquipement1erController::class);
    $router->resource('etabanneesocio1er', EtablissementanneeSocio1erController::class);
    $router->resource('etabanneebesoinformation1er', EtablissementanneeBesoinformation1erController::class);
    $router->resource('etabanneeprobleme1er', EtablissementanneeProbleme1erController::class);
    $router->resource('etabanneeplanning1er', EtablissementanneePlanning1erController::class);
    $router->resource('etabanneeconclusion1er', EtablissementanneeConclusion1erController::class);
    $router->resource('etabanneeexecutionprogramme1er', EtablissementanneeExecutionProgramme1erController::class);
    $router->resource('etabanneebesoinpersonnelens1er', EtablissementanneeBesoinPersonnelEns1erController::class);
    $router->resource('etabanneeresultatscolaire1er', EtablissementanneeResultatScolaire1erController::class);
    $router->resource('apprenantannees_1er', Apprenantannee_1erController::class);
    $router->resource('etabanneepoint', EtablissementanneePointExecution1erController::class);



    //2eme Semestre
    $router->resource('etablissements2eme', Etablissement2emeSemestreController::class);   
    $router->resource('etabanneefiliereenseigne2eme', EtablissementanneeFiliereEnseigne2emeController::class);   
    $router->resource('etabanneeinfrastructure2eme', EtablissementanneeInfrastructure2emeController::class);   
    $router->resource('etabanneepersonnel2eme', Personnelannee2_2emeController::class);   
    $router->resource('etabanneeclasse2eme', EtablissementanneeClasse2emeController::class);   
    $router->resource('etabanneeapprenant2eme', EtablissementanneeApprenant2emeController::class);   
    $router->resource('etabanneebesoinpersonnelens', EtablissementanneeBesoinPersonnelEnsController::class);
    $router->resource('etabanneebesoinpersonneladmin', EtablissementanneeBesoinPersonnelAdminController::class);
    $router->resource('etabanneebesoinmateriel', EtablissementanneeBesoinController::class);
    $router->resource('etabanneeresultat2eme', EtablissementanneeResultat2emeController::class);
    $router->resource('etabanneeprevision2eme', EtablissementanneePrevision2emeController::class);
    $router->resource('etabanneeconclusion2eme', EtablissementanneeConclusion2emeController::class);
    $router->resource('etabanneeetat2eme', EtablissementanneeEtat2emeController::class);
    $router->resource('apprenantannees_2eme', Apprenantannee_2emeController::class);
    $router->resource('etabanneepoint2eme', EtablissementanneePointExecution2emeController::class);



    

    

    $router->resource('atlas-admins', AtlasAdminExportController::class);
    $router->resource('atlas-pedagogiques', AtlasPedagogiqueExportController::class);
    $router->resource('tcd-etablissement-annees', TcdEtablissementAnneeExportController::class);
    $router->resource('tcd-etablissement-personnels', TcdEtablissementPersonnelExportController::class);
    $router->resource('tcd-activite-sportives', TcdActiviteSportiveExportController::class);
    $router->resource('tcd-etablissement-apprenants', TcdEtablissementApprenantExportController::class);
    $router->resource('tcd-besoin-materiels', TcdBesoinMaterielExportController::class);
    $router->resource('tcd-besoin-infrastructures', TcdBesoinInfrastructureExportController::class);
    $router->resource('tcd-besoin-personnel-adms', TcdBesoinPersonnelAdmExportController::class);
    $router->resource('tcd-besoin-personnel-ens', TcdBesoinPersonnelEnsExportController::class);
    $router->resource('tcd-resultats', TcdResultatExportController::class);
    $router->resource('tcd-plannings', TcdPlanningExportController::class);
    $router->resource('tcd-infrastructures', TcdInfrastructureExportController::class);
    $router->resource('tcd-filiere-enseignes', TcdFiliereEnseigneExportController::class);
    $router->resource('tcd-filiere-autorises', TcdFiliereAutoriseExportController::class);
    $router->resource('tcd-classes', TcdClasseExportController::class);
    $router->resource('tcd-associations', TcdAssociationExportController::class);
	
    $router->resource('v-rubrique-etabs', VRubriqueEtabExportController::class);
    $router->resource('v-resultats-scolaires', VResultatsScolaireExportController::class);
    $router->resource('v-filiere-enseignes', VFiliereEnseigneExportController::class);
    $router->resource('v-etablissements', VEtablissementExportController::class);


    $router->get('atlasadmins/export', 'AtlasAdminExportController@export');
    $router->get('suiviremplissage/export', 'EtablissementanneeController@export');
    $router->get('tcdetablissementannee/export', 'TcdEtablissementAnneeExportController@export');
    $router->get('atlaspedagogique/export', 'AtlasPedagogiqueExportController@export');
    $router->get('tcdactivitesportive/export', 'TcdActiviteSportiveExportController@export');
    $router->get('tcdetablissementpersonnel/export', 'TcdEtablissementPersonnelExportController@export');
    $router->get('tcdetablissementapprenant/export', 'TcdEtablissementApprenantExportController@export');
    $router->get('tcdbesoinmateriel/export', 'TcdBesoinMaterielExportController@export');
    $router->get('tcdbesoininfrastructure/export', 'TcdBesoinInfrastructureExportController@export');
    $router->get('tcdbesoinpersonneladm/export', 'TcdBesoinPersonnelAdmExportController@export');
    $router->get('tcdbesoinpersonnelens/export', 'TcdBesoinPersonnelEnsExportController@export');
    $router->get('tcdresultat/export', 'TcdResultatExportController@export');
    $router->get('tcdplanning/export', 'TcdPlanningExportController@export');
    $router->get('tcdinfrastructure/export', 'TcdInfrastructureExportController@export');
    $router->get('tcdfiliereenseigne/export', 'TcdFiliereEnseigneExportController@export');
    $router->get('tcdfiliereautorise/export', 'TcdFiliereAutoriseExportController@export');
    $router->get('tcdclasse/export', 'TcdClasseExportController@export');
    $router->get('tcdassociation/export', 'TcdAssociationExportController@export');

    $router->get('vrubriqueetabs/export', 'VRubriqueEtabExportController@export');
    $router->get('vresultatsscolaires/export', 'VResultatsScolaireExportController@export');
    $router->get('vfiliereenseignes/export', 'VFiliereEnseigneExportController@export');
    $router->get('vetablissements/export', 'VEtablissementExportController@export');
	



    $router->get('/plannings' , 'PlanningsController@index');
	$router->get('/plannings2' , 'Plannings2Controller@index');
	$router->post('miseajourplanning','PlanningsController@ajaxUpdate');

    $router->resource('typeshandicaps', TypeshandicapController::class);
    $router->resource('handicaps', HandicapController::class);
    //Insertion des établissements
    // $router->get('insertions', 'InsertionetablissementController@insertions');
    // $router->post('insertion', 'InsertionetablissementController@insertion');
    
    //Insertion des séries
    $router->get('insertions', 'InsertionserieController@insertions');
    $router->post('insertion', 'InsertionserieController@insertion');

    //Insertion des moyennes du 1er semestre
    $router->get('moyenne1er', 'InsertionApprenantmoy1Controller@insertions');
    $router->post('moyenne1', 'InsertionApprenantmoy1Controller@insertion');

    // Les nouvelles routes de suivi
    $router->resource('missions', MissionController::class);
    $router->resource('participantsmissions', ParticipantsmissionController::class);
    $router->resource('superviseurs', SuperviseurController::class);
    $router->resource('ajoutersuperviseurs', AjouterSuperviseurController::class);
    $router->resource('structures', StructureController::class);
    $router->resource('resultatsmissions', ResultatsmissionController::class);
    $router->resource('detailsresultatsscolaires', DetailsresultatsscolaireController::class);
    $router->resource('resultatstypepersonnels', ResultatstypepersonnelController::class);
    $router->resource('resultatsscolaires', ResultatsscolaireController::class);
    $router->resource('resultatscontroles', ResultatscontroleController::class);
    $router->resource('detailsresultatspersonnels', DetailsresultatspersonnelController::class);
    $router->resource('itemscontroles', ItemscontroleController::class);
    $router->resource('detailsresultatscontroles', DetailsresultatscontroleController::class);
    $router->resource('sousrubriquecontroles', SousrubriquecontroleController::class);
    $router->resource('rubriquecontroles', RubriquecontroleController::class);
    $router->resource('detailseffectifsetstatuts', DetailseffectifsetstatutController::class);
    $router->resource('filiereautorises', FiliereautoriseController::class);
    $router->resource('effectifsetstatuts', EffectifsetstatutController::class);
    $router->resource('resultatstypesequipements', ResultatstypesequipementController::class);
    $router->resource('detailsequipements', DetailsequipementController::class);
    $router->resource('detailsinfrastructures', DetailsinfrastructureController::class);

    // Route des suivis pour l'évaluation
    $router->resource('suivimission', SuiviMissionController::class);
    $router->resource('suivimissionedit', SuiviMissionEditController::class);
    $router->resource('suivimissionimprim', SuiviMissionImprimController::class);
    $router->resource('suivifiliere', SuiviResultatsmissionController::class);
    $router->resource('suivipersonnel', SuiviResultatstypepersonnelController::class);
    $router->resource('suivipersonnel_1', SuiviResultatstypepersonnel_1Controller::class);
    $router->resource('suivipersonnel_2', SuiviResultatstypepersonnel_2Controller::class);
    $router->resource('suivipersonnel_3', SuiviResultatstypepersonnel_3Controller::class);
    $router->resource('suiviequipement', SuiviResultatstypesequipementController::class);
    $router->resource('suivicontrole_1', SuiviResultatscontrole_1Controller::class);
    $router->resource('suivicontrole_2', SuiviResultatscontrole_2Controller::class);
    $router->resource('suivicontrole_3', SuiviResultatscontrole_3Controller::class);
    $router->resource('suivicontrole_4', SuiviResultatscontrole_4Controller::class);
    $router->resource('suivicontrole_5', SuiviResultatscontrole_5Controller::class);
    $router->resource('suivicontrole_6', SuiviResultatscontrole_6Controller::class);
    $router->resource('suivieffectifs', SuiviEffectifsetstatutController::class);
    $router->resource('suiviscolaires', SuiviResultatsscolaireController::class);
	// $router->get('anneenouvelle', 'NouvelleanneeController@index');
    // $router->get('demaragenouvelannee', 'NouvelleanneeController@valider');

    $router->resource('demarrageannees', DemarrageanneeController::class);
    // $router->get('anneenouvelle', 'NouvelleanneeController@index');
    $router->get('demaragenouvelannee', 'DemarrageanneeController@valider');

    //Formulaire sur personnel /année pour ajouter un personnel
    // $router->get('form', 'PersonnelController@createForm');
    // $router->get('form', 'PersonnelController@form');
    // $router->post('form_save', 'PersonnelController@sauvegarde');

    //API

    $router->resource('operators', ApiOperatorController::class);
    $router->resource('responses', ApiResponseController::class);
	$router->resource('saisiedupersonnel', PersonnelnouveauController::class);

	//Insertion des séries
    $router->get('imports', 'InsertionetablissementController@imports');
    $router->get('reccuperations', 'InsertionetablissementController@reccuperations');
    $router->post('import', 'InsertionetablissementController@import');

    // Mise a jour des usernames
    $router->get('update-usernames', 'EtablissementController@updateUsernames');


    //NOUVELLE ROUTE POUR LES SESSIONS DE FOPRMATION
    $router->resource('sessionformations', SessionformationController::class);
    $router->resource('fondateurs', FondateurController::class);
    $router->resource('participants', ParticipantController::class);
    $router->resource('fondateuretablissements', FondateuretablissementController::class);


    //NOUVELLES ROUTES SPECIFIQUES A LA DEP POUR LE RAPPORT DE RENTREE
    $router->resource('recapgenerals', RecageneralController::class);
    $router->resource('point-executions', PointExecutionController::class);
    $router->resource('indicateurs', IndicateurController::class);
    $router->resource('itemsindicateurs', ItemsindicateurController::class);
    $router->resource('probleme-infrastructures', ProblemeInfrastructureController::class);
    $router->resource('equipements', EquipementController::class);
    $router->resource('execution-budgets', ExecutionBudgetController::class);
    $router->resource('ressources-additionnelles', RessourcesAdditionnelleBudgetController::class);
    $router->resource('amenagements', AmenagementController::class);
    $router->resource('perspectives', PerspectiveController::class);
    $router->resource('comite-gestions', ComiteGestionController::class);
    $router->resource('travaux-exterieurs', TravauxExterieurController::class);
    $router->resource('frais-scolarites', FraisScolariteController::class);
    $router->resource('besoin-urgents', BesoinUrgentController::class);



});
