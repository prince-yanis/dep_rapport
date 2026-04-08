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
use Auth;
use Illuminate\Support\Facades\Redirect;
//////////////////

use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use Mail;
use DB;
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
        $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();
        if (!($EtabAnnee)) {
            // Redirect the browser to a different page
            header("Location: https://enquete-deep.cpntic.com/admin/etablissements2");
            exit;
        }
        $plannings = Planning::where('etablissementannees_id', '=', $EtabAnnee->id)
        ->join('etablissementannees', 'etablissementannees.id', '=', 'planning.etablissementannees_id')
        // ->where('etablissementannees.anneescolaires_id', session('anneescolaireactuelle'))
        ->get();
        $lesetablissements = array();
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
        $lesclasses = Classe::where('etablissementannees_id', '=', $EtabAnnee->id)
            ->join('etablissementannees', 'etablissementannees.id', '=', 'classes.etablissementannees_id')
            ->get()
            ->pluck('denominationclasse', 'id');
        $mesclasses = Classe::where('etablissementannees_id', '=', $EtabAnnee->id)
            ->join('etablissementannees', 'etablissementannees.id', '=', 'classes.etablissementannees_id')
            ->get();
        //$lessalles = $this->salleRepository->all(['id', 'designationsalle'])->pluck('designationsalle', 'id');
        //        $personnels = Personnel::all();
        $personnels = Personnelannee::where('etablissementannees_id', '=', $EtabAnnee->id)
            ->join('personnels', 'personnelannees.personnels_id', '=', 'personnels.id')
            ->get();
        foreach ($personnels as $personnel) {
            $lespersonnels[$personnel->id] = $personnel->matricule . " " . $personnel->nom . " " . $personnel->prenoms;
        }
        /*
        return view('calendrier.index')
			->with('etablissements', $lesetablissements)
            ->with('plannings', $plannings)			
			->with('classes', $lesclasses)
			->with('professeurs', $lespersonnels)
			->with('disciplines', $lesdisciplines);*/
        return $content
            ->header()
            ->description('')
            ->body(view('calendrier.index')
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
        $start = $debut ? $debut : $periodes->datedebut;
        $end = $periodes->datefin;
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
        $monid = $request->id;
        if ($monid == 0) {
            /*	$donnees = array(
            'etablissementannees_id'=>$request->etablissementannees_id,			
			'personnels_id'=>$request->personnels_id,
			'classes_id'=>$request->classes_id,
			'disciplines_id'=>$request->disciplines_id,
			'datedebut'=>$request->datedebut,
			'datefin'=>$request->datefin
		);	*/
            $mesdates = $this->lesdates();
            // dd($mesdates);
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
                    $cours = Planning::create($donnees);
                    /*				$UID=Planning::where([
					'etablissementannees_id'=>$request->etablissementannees_id,			
					'personnels_id'=>$request->personnels_id,
					'classes_id'=>$request->classes_id,
					'disciplines_id'=>$request->disciplines_id,
					'datedebut'=>$request->datedebut,
					'datefin'=>$request->datefin							
					])->first()->id;
				$planning=Planning::with(['discipline','personnel','classe'])->find($UID);*/
                }
            }
            // return redirect()->back();
        } else {
            $planning = Planning::with(['discipline', 'personnel', 'classe'])->find($request->id);
            $planning->update($request->all());
        }
        // return Redirect::to('https://enquete-deep.cpntic.com/admin/plannings');
        return response()->json(['planning' => []]);
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
                            'personnels_id' => $request->personnels_id,
                            'classes_id' => $request->classes_id,
                            'disciplines_id' => $request->disciplines_id,
                            'datedebut' => $madate . ' ' . date('H:i:s', strtotime($request->datedebut)),
                            'datefin' => $madate . ' ' . date('H:i:s', strtotime($request->datefin)),
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
    public function getEvents(Request $request)
    {
        // Si une classe est sélectionnée, récupérer seulement les événements de cette classe
        if ($request->has('classFilter') && !empty($request->classFilter)) {
            $plannings = Planning::where('classes_id', $request->classFilter)->get();
        } else {
            // Sinon, récupérer tous les événements
            $plannings = Planning::all();
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
}
