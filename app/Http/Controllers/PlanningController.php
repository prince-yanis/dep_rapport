<?php

namespace App\Http\Controllers;
//require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload
//require __DIR__ . '/vendor/autoload.php';
use App\Models\Planning;
use App\Models\Personnel;
use App\Models\Etablissement;
use App\Models\Etablissementannee;
use App\Models\Classe;
use App\Models\Discipline;
/*use App\Repositories\CourRepository;*/
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
class PlanningController extends Controller
{
	/** @var  AnneescolaireRepository */
    
	
	
	
    /**
     * Display a listing of the demandedoc.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->demandedocRepository->pushCriteria(new RequestCriteria($request));
        $plannings = Planning::all();
		$lesetablissements=array();
		$lespersonnels=array();
		//$lesannees = $this->anneescolaireRepository->all(['id', 'libelleanneescolaire'])->pluck('libelleanneescolaire', 'id');
		//$lessemestres = $this->semestreRepository->all(['id', 'libellesemestre'])->pluck('libellesemestre', 'id');
		//$lesecues = $this->ecueRepository->all(['id', 'libelleecue'])->pluck('libelleecue', 'id');
		$lesetablissements=Etablissement::all();
		$etablissementannees=Etablissementannee::join ('etablissements','etablissements.id','=','etablissementannees.etablissements_id')
			->select('etablissementannees.id','etablissements.denominationetab')
			->get();
		foreach ($etablissementannees as $etablissementannee ){
			$lesetablissements[$etablissementannee->id]=$etablissementannee->denominationetab;
		}
		$lesdisciplines=Discipline::all()->pluck('libellediscipline', 'id');
		$lesclasses=Classe::all()->pluck('denominationclasse','id');
		//$lessalles = $this->salleRepository->all(['id', 'designationsalle'])->pluck('designationsalle', 'id');
        $personnels = Personnel::all();
		foreach ($personnels as $personnel ){
			$lespersonnels[$personnel->id]=$personnel->matricule." ".$personnel->nom." ".$personnel->prenoms;
		}
        return view('calendrier.index')
			->with('etablissements', $lesetablissements)
            ->with('plannings', $plannings)			
			->with('classes', $lesclasses)
			->with('professeurs', $lespersonnels)
			->with('disciplines', $lesdisciplines)
            ->with('etablissement_id', null);
    }
	public function ajaxUpdate(Request $request)
	{
		
		$monid=$request->id;
		if($monid==0) {
			$donnees = array(
            'etablissementannees_id'=>$request->etablissementannees_id,			
			'personnels_id'=>$request->personnels_id,
			'classes_id'=>$request->classes_id,
			'disciplines_id'=>$request->disciplines_id,
			'datedebut'=>$request->datedebut,
			'datefin'=>$request->datefin
		);				
		$cours = Planning::create($donnees);
		$UID=Planning::where([
					'etablissementannees_id'=>$request->etablissementannees_id,			
					'personnels_id'=>$request->personnels_id,
					'classes_id'=>$request->classes_id,
					'disciplines_id'=>$request->disciplines_id,
					'datedebut'=>$request->datedebut,
					'datefin'=>$request->datefin							
			])->first()->id;
		$planning=Planning::with(['discipline','personnel','classe'])->find($UID);	
		}else{
			$planning=Planning::with(['discipline','personnel','classe'])->find($request->id);		
			$planning->update($request->all());	
		}
				
		return response()->json(['planning' => $planning]);
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
    public function showdemandeconge()
    {
      
    }

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
	 
	public function refuser($id)
    {
        
    }
	/**
     * Update the specified Demandedoc in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function detail($id)
    {
        
    }
/**
     * Update the specified Demandedoc in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function valider($id)
    {
       
		
    }

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
	
}
