<?php

namespace App\Admin\Controllers;
//require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload
//require __DIR__ . '/vendor/autoload.php';

/////////////////////
use App\Models\Parametresglobaux;
use App\Models\Planning;
use App\Models\Personnel;
use App\Models\Etablissement;
use App\Models\Etablissementannee;
use App\Models\Classe;
use App\Models\Discipline;
use App\Models\Personnelannee;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\AdminUser;
use App\Models\AdminRole;
use App\Models\AdminRoleUser;

use Illuminate\Support\Facades\Redirect;
//////////////////

use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use Mail;
use PDFMerger;
use PdfReport;
use PHPJasper\PHPJasper;
use Dompdf\Dompdf;
use Anouar\Fpdf\Fpdf;

class PlanningsController extends Controller
{
    /** @var  AnneescolaireRepository */

    /**
     * Display a listing of the demandedoc.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Content $content, Request $request)
    // public function index(Request $request)
    {
        // dd(session('etablissementchoisi'));
        //$this->demandedocRepository->pushCriteria(new RequestCriteria($request));
        $utilisateurs_id = Auth::guard('admin')->user()->id;
        $query = AdminRoleUser::where('user_id', '=', $utilisateurs_id)->first();
        $role_id = $query ? $query->role_id : null;
        /*  if ($role_id == 2) {
			 $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();
		}else{
			 $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();
		}*/

        $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();
        if (!($EtabAnnee)) {
            // Redirect the browser to a different page
            header("Location: https://enquete-deep.cpntic.com/admin/etablissements2");
            exit;
        }
        $plannings = Planning::where('etablissementannees_id', '=', $EtabAnnee->id)->get();

        //$lesetablissements = array();
        $lespersonnels = array();
        //$lesannees = $this->anneescolaireRepository->all(['id', 'libelleanneescolaire'])->pluck('libelleanneescolaire', 'id');
        //$lessemestres = $this->semestreRepository->all(['id', 'libellesemestre'])->pluck('libellesemestre', 'id');
        //$lesecues = $this->ecueRepository->all(['id', 'libelleecue'])->pluck('libelleecue', 'id');
        $lesetablissements = array();
        $etablissementannees = Etablissementannee::join('etablissements', 'etablissements.id', '=', 'etablissementannees.etablissements_id')
            ->join('anneescolaires', 'anneescolaires.id', '=', 'etablissementannees.anneescolaires_id')
            ->select('etablissementannees.id', 'etablissements.denominationetab', 'anneescolaires.libelleanneescolaire')
            ->where('etablissementannees.id', '=', $EtabAnnee->id)
            ->get();
        foreach ($etablissementannees as $etablissementannee) {
            $lesetablissements[$etablissementannee->id] = $etablissementannee->libelleanneescolaire . ' - ' . $etablissementannee->denominationetab;
        }
        $lesdisciplines = Discipline::all()->pluck('libellediscipline', 'id');
        $lesclasses = Classe::where('etablissementannees_id', '=', $EtabAnnee->id)->get()->pluck('denominationclasse', 'id');
        $mesclasses = Classe::where('etablissementannees_id', '=', $EtabAnnee->id)->get();
        //$lessalles = $this->salleRepository->all(['id', 'designationsalle'])->pluck('designationsalle', 'id');
        //        $personnels = Personnel::all();
        $personnels = Personnelannee::where('etablissementannees_id', '=', $EtabAnnee->id)
            ->join('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
            ->get();
        foreach ($personnels as $personnel) {
            $lespersonnels[$personnel->id] = $personnel->matricule . " " . $personnel->nom . " " . $personnel->prenoms;
        }
        //dd($lesetablissements);
        /*
        return view('calendrier.index')
			->with('etablissements', $lesetablissements)
            ->with('plannings', $plannings)			
			->with('classes', $lesclasses)
			->with('professeurs', $lespersonnels)
			->with('disciplines', $lesdisciplines);*/
        return $content
            ->header('EMPLOI DU TEMPS')
            //->description('')
            ->body(view('calendrier.index2')
                ->with('etablissement_id', $EtabAnnee->id)
                ->with('etablissements', $lesetablissements)
                ->with('plannings', $plannings)
                ->with('classes', $lesclasses)
                ->with('mesclasses', $mesclasses)
                ->with('professeurs', $lespersonnels)
                ->with('disciplines', $lesdisciplines));
    }

    public function lesdates($debut = null)
    {
        $periodes =  DB::table('parametresglobaux')
            ->join('anneescolaires', 'anneescolaires.id', '=', 'parametresglobaux.anneescolaires_id')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->select('anneescolaires.datedebut', 'datefin')
            ->first();
        $start = $debut ? $debut : ($periodes ? $periodes->datedebut : '');
        $end = $periodes ? $periodes->datefin : '';
        // Get list of dates between two dates
        $dates = new \DatePeriod(
            new \DateTime($start),
            new \DateInterval('P1D'),
            new \DateTime($end)
        );
        //
        $mesdates = array();
        foreach ($dates  as $key => $val) {
            //echo $date = strtotime($val->format('Y-m-d'));
            // echo $date = $val->format('Y-m-d');
            $mesdates[] = $val->format('Y-m-d');
            // echo '<br>';
        }
        return $mesdates;
    }

    public function ajaxUpdate(Request $request)
    {
        // Debug: log the request data
        \Log::info('ajaxUpdate called with data: ' . json_encode($request->all()));
        
        $monid = $request->id;
        if ($monid == 0) {
            // Create events for all matching days in the school year
            $mesdates = $this->lesdates();
            foreach ($mesdates as $madate) {
                $jour = date('w', strtotime($madate));
                $jour1 = date('w', strtotime($request->datedebut));
                if ($jour == $jour1) {
                    $donnees = array(
                        'etablissementannees_id' => $request->etablissementannees_id,
                        'personnels_id' => $request->personnels_id,
                        'classes_id' => $request->classes_id,
                        'disciplines_id' => $request->disciplines_id,
                        'datedebut' => $madate . ' ' . date('H:i:s', strtotime($request->datedebut)),
                        'datefin' => $madate . ' ' . date('H:i:s', strtotime($request->datefin)),
                    );
                    \Log::info('Creating event for date ' . $madate . ' with data: ' . json_encode($donnees));
                    $cours = Planning::create($donnees);
                    \Log::info('Event created with ID: ' . $cours->id);
                }
            }
        } else {
            // Update all matching events in the school year
            $planning = Planning::with(['discipline', 'personnel', 'classe'])->find($request->id);
            if ($planning) {
                $mesdates = $this->lesdates($request->datedebut);
                foreach ($mesdates as $madate) {
                    $jour = date('w', strtotime($madate));
                    $jour1 = date('w', strtotime($request->datedebut));
                    if ($jour == $jour1) {
                        Planning::where([
                            'etablissementannees_id' => $planning->etablissementannees_id,
                            'personnels_id' => $planning->personnels_id,
                            'classes_id' => $planning->classes_id,
                            'disciplines_id' => $planning->disciplines_id,
                            'datedebut' => $madate . ' ' . date('H:i:s', strtotime($planning->datedebut)),
                            'datefin' => $madate . ' ' . date('H:i:s', strtotime($planning->datefin)),
                        ])->update([
                            'etablissementannees_id' => $request->etablissementannees_id,
                            'personnels_id' => $request->personnels_id,
                            'classes_id' => $request->classes_id,
                            'disciplines_id' => $request->disciplines_id,
                            'datedebut' => $madate . ' ' . date('H:i:s', strtotime($request->datedebut)),
                            'datefin' => $madate . ' ' . date('H:i:s', strtotime($request->datefin)),
                        ]);
                        \Log::info('Updated events for date: ' . $madate);
                    }
                }
            }
        }
        
        return response()->json(['success' => true]);
    }

    public function ajaxDelete(Request $request)
    {
        $mesdates = [];
        if ($request->id == 0) {
        } else {
            if ($request->all == 0) {
                // Suppression unique
                Planning::where('id', $request->id)->delete();
            } else {
                // Suppression multiple
                $mesdates = $this->lesdates($request->datedebut);
                // dd($mesdates);
                foreach ($mesdates as $madate) {
                    $jour = date('w', strtotime($madate));
                    $jour1 = date('w', strtotime($request->datedebut));
                    if ($jour == $jour1) {
                        Planning::where([
                            'etablissementannees_id' => $request->etablissementannees_id,
                            // 'personnels_id' => $request->personnels_id,
                            'classes_id' => $request->classes_id,
                            'disciplines_id' => $request->disciplines_id,
                            'datedebut' => $madate . ' ' . date('H:i:s', strtotime($request->datedebut)),
                            // 'datefin' => $madate . ' ' . date('H:i:s', strtotime($request->datefin)),
                        ])->delete();
                    }
                }
            }
        }

        return response()->json(['planning' => [], 'dates' => $mesdates]);
    }

    /**
     * Show the form for creating a new Demandedoc.
     *
     * @return Response
     */
    public function create()
    {
        //return view('demandedocs.create');
    }

    /**
     * Display the specified Demandedoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified Demandedoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function showdemandeconge() {}

    /**
     * Show the form for editing the specified Demandedoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified Demandedoc in storage.
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
     * Update the specified Demandedoc in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refuser($id) {}

    /**
     * Update the specified Demandedoc in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id) {}

    /**
     * Update the specified Demandedoc in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function valider($id) {}

    /**
     * Remove the specified Demandedoc from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
    public function getEvents(Request $request)
    {
        // Si une classe est sélectionnée, récupérer seulement les événements de cette classe
        if ($request->has('classFilter') && !empty($request->classFilter)) {
            $plannings = Planning::where('etablissementannees_id', session('etablissementchoisi'))->where('classes_id', $request->classFilter)->get();
        } else {
            // Sinon, récupérer tous les événements
            $plannings = Planning::where('etablissementannees_id', session('etablissementchoisi'))->get();
        }

        $events = [];
        foreach ($plannings as $planning) {
            $events[] = [
                'id' => $planning->id,
                'title' => 'Etablissement: ' . $planning->etablissementannee->etablissement->denominationetab .
                    ' - Discipline: ' . $planning->discipline->libellediscipline .
                    ' - Professeur: ' . $planning->personnel->nom .
                    ' - Classe: ' . $planning->classe->denominationclasse,
                'start' => $planning->datedebut,
                'end' => $planning->datefin,
            ];
        }

        return response()->json($events);
    }
	*/
    public function getEvents(Request $request)
    {
        $query = Planning::with(['etablissementannee.etablissement', 'discipline', 'personnel', 'classe'])
            ->where('etablissementannees_id', session('etablissementchoisi'));

        if ($request->has('classFilter') && !empty($request->classFilter)) {
            $query->where('classes_id', $request->classFilter);
        }

        $plannings = $query->get();

        $events = $plannings->map(function ($planning) {
            return [
                'id' => $planning->id,
                'etablissement' => $planning->etablissementannee->etablissement->denominationetab,
                'discipline' => $planning->discipline->libellediscipline,
                'professeur' => $planning->personnel->nom,
                'classe' => $planning->classe->denominationclasse,
                'datedebut' => $planning->datedebut,
                'datefin' => $planning->datefin,
            ];
        });

        return view('calendrier.index', ['events' => $events]);
    }

    // PlanningController.php
    public function getFilteredEvents(Request $request)
    {
        // Debug: Log les paramètres reçus
        \Log::info('PlanningsController::getFilteredEvents called with params:', $request->all());
        
        $query = Planning::with(['etablissementannee.etablissement', 'discipline', 'personnel', 'classe']);
        
        // Application des filtres si présents
        if ($request->filled('etablissementannees_id')) {
            $query->where('etablissementannees_id', $request->etablissementannees_id);
            \Log::info('Filtering by etablissementannees_id: ' . $request->etablissementannees_id);
        }
        if ($request->filled('personnels_id')) {
            $query->where('personnels_id', $request->personnels_id);
            \Log::info('Filtering by personnels_id: ' . $request->personnels_id);
        }
        if ($request->filled('classes_id')) {
            $query->where('classes_id', $request->classes_id);
            \Log::info('Filtering by classes_id: ' . $request->classes_id);
        }
        if ($request->filled('disciplines_id')) {
            $query->where('disciplines_id', $request->disciplines_id);
            \Log::info('Filtering by disciplines_id: ' . $request->disciplines_id);
        }

        // Supprimer la limite pour obtenir tous les événements
        $plannings = $query->get();
        
        // Debug: Compter les résultats
        \Log::info('Found ' . $plannings->count() . ' plannings');

        $events = $plannings->map(function ($planning) {
            try {
                $etablissement = optional(optional($planning->etablissementannee)->etablissement)->denominationetab ?? '';
                $discipline = optional($planning->discipline)->libellediscipline ?? '';
                $professeur = optional($planning->personnel)->nom ?? '';
                $classe = optional($planning->classe)->denominationclasse ?? '';

                // Debug: Log chaque événement
                \Log::info('Event mapped: ' . $planning->id . ' - ' . $discipline . ' - ' . $classe . ' - ' . $planning->datedebut);
                
                return [
                    'id' => $planning->id,
                    'title' => $discipline . ' - ' . $professeur . ' - ' . $classe,
                    'start' => $planning->datedebut,
                    'end' => $planning->datefin,
                    'extendedProps' => [
                        'letablissement' => $planning->etablissementannees_id,
                        'leprofesseur' => $planning->personnels_id,
                        'laclasse' => $planning->classes_id,
                        'ladiscipline' => $planning->disciplines_id,
                        'etablissement_nom' => $etablissement,
                        'discipline_nom' => $discipline,
                        'professeur_nom' => $professeur,
                        'classe_nom' => $classe,
                    ]
                ];
            } catch (\Exception $e) {
                \Log::error('Error processing planning ' . $planning->id . ': ' . $e->getMessage());
                return null;
            }
        })->filter()->values(); // Supprimer les null et réindexer

        \Log::info('Returning ' . $events->count() . ' events');
        return response()->json($events);
    }
}
