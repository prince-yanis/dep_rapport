<?php

namespace App\Admin\Controllers;
//require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload
//require __DIR__ . '/vendor/autoload.php';

/////////////////////

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Auth;

//////////////////
use App\Repositories\AnneescolaireRepository;
use App\Repositories\SemestreRepository;
use App\Repositories\EcueRepository;
use App\Repositories\PersonnelRepository;
use App\Repositories\SalleRepository;
use App\Repositories\EquipeRepository;
use App\Repositories\CourRepository;
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
    private $anneescolaireRepository;	
	/** @var  SemestreRepository */
    private $semestreRepository;
	/** @var  EcueRepository */
    private $ecueRepository;
	/** @var  PersonnelRepository */
    private $personnelRepository;
	/** @var  SalleRepository */
    private $salleRepository;
	/** @var  EquipeRepository */
    private $equipeRepository;
	/** @var  CourRepository */
    private $courRepository;
	
	
	public function __construct(AnneescolaireRepository $anneescolaireRepo,
	SemestreRepository $semestreRepo,
	EcueRepository $ecueRepo,
	PersonnelRepository $personnelRepo,
	EquipeRepository $equipeRepo,
	SalleRepository $salleRepo,
	CourRepository $courRepo
	)
    {
        $this->anneescolaireRepository = $anneescolaireRepo;
		$this->semestreRepository = $semestreRepo;
		$this->ecueRepository = $ecueRepo;
		$this->personnelRepository = $personnelRepo;	
		$this->salleRepository = $salleRepo;
		$this->equipeRepository = $equipeRepo;
		$this->courRepository = $courRepo;
    }
    /**
     * Display a listing of the demandedoc.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Content $content)
    {
        //$this->demandedocRepository->pushCriteria(new RequestCriteria($request));
        $cours = $this->courRepository->all();
		
		$lesannees = $this->anneescolaireRepository->all(['id', 'libelleanneescolaire'])->pluck('libelleanneescolaire', 'id');
		$lessemestres = $this->semestreRepository->all(['id', 'libellesemestre'])->pluck('libellesemestre', 'id');
		$lesecues = $this->ecueRepository->all(['id', 'libelleecue'])->pluck('libelleecue', 'id');
		$lessalles = $this->salleRepository->all(['id', 'designationsalle'])->pluck('designationsalle', 'id');
        $personnels = $this->personnelRepository->all();
		foreach ($personnels as $personnel ){
			$lespersonnels[$personnel->id]=$personnel->matricule." ".$personnel->nom." ".$personnel->prenoms;
		}
		/*return $content
            
            ->body(view('calendrier.index')
            ->with('cours', $cours)
			->with('semestres', $lessemestres)
			->with('anneescolaires', $lesannees)
			->with('salles', $lessalles)
			->with('professeurs', $lespersonnels)
			->with('ecues', $lesecues));*/
       return view('calendrier.index')
            ->with('cours', $cours)
			->with('semestres', $lessemestres)
			->with('anneescolaires', $lesannees)
			->with('salles', $lessalles)
			->with('professeurs', $lespersonnels)
			->with('ecues', $lesecues)
            ->with('etablissement_id', null);
		/*return $content
            ->header()
            ->description('Les manuels')
            ->body(view('manuels', ['mesmanuels' => $mesmanuels,'eleve' => $eleve]));*/
    }
	public function ajaxUpdate(Request $request)
	{
		
		$monid=$request->id;
		if($monid==0) {
			$donnees = array(
            'anneescolaire_id'=>$request->anneescolaire_id,					
			'semestre_id'=>$request->semestre_id,
			'codecours'=>$request->codecours,
			'personnel_id'=>$request->personnel_id,
			'salle_id'=>$request->salle_id,
			'ecue_id'=>$request->ecue_id,
			'datedebut'=>$request->datedebut,
			'datefin'=>$request->datefin
		);				
		$cours = $this->courRepository->create($donnees);
		$UID=$this->courRepository->findWhere([
					'anneescolaire_id'=>$request->anneescolaire_id,					
					'semestre_id'=>$request->semestre_id,
					'codecours'=>$request->codecours,
					'personnel_id'=>$request->personnel_id,
					'salle_id'=>$request->salle_id,
					'ecue_id'=>$request->ecue_id,
					'datedebut'=>$request->datedebut,
					'datefin'=>$request->datefin								
			])->first()->id;
		$cour=$this->courRepository->with(['ecue','personnel','salle'])->find($UID);	
		}else{
			$cour=$this->courRepository->with(['ecue','personnel','salle'])->find($request->id);		
			$cour->update($request->all());	
		}
				
		return response()->json(['cour' => $cour]);
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
