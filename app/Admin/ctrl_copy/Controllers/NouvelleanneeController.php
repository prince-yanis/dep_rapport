<?php

namespace App\Admin\Controllers;


//use App\Models\Manuelseleve;
use App\Models\AdminRoleUser;
use App\Models\AdminRole;
use App\Models\AdminUser;
//use App\Models\Drena;
use App\Models\Etablissement;
use App\Models\Anneescolaire;
use App\Models\Filiereenseigne;
//use App\Models\Etablissement;
use App\Models\Etablissementannee;
use App\Models\Infrastructure;
use App\Models\Equipement;
use App\Models\Personnel;
use App\Models\Personnelannee;
use App\Models\Association;
use App\Models\Sport;
use App\Models\SportEtab;
use App\Models\Parametresglobaux;
//use App\Models\Eleve;
use Auth;
use PDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Admin\Forms\Settings;
use App\Admin\Forms\Steps;
//use App\Admin\Forms\Remiseeleve;
use App\Http\Controllers\Controller;
use App\Models\User;
use Encore\Admin\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\MultipleSteps;
use Encore\Admin\Widgets;
use Illuminate\Support\MessageBag;


use Illuminate\Http\Request;

//////////////////////

use Encore\Admin\Layout\Column;


use Encore\Admin\Layout\Row;

use DB;

class NouvelleanneeController extends Controller
{


   public function index(Content $content)
    {
       // $this->dumpRequest($content);

        $content->title('Démarer une nouvelle année scolaire');

        $form = new Widgets\Form();
        $form->action('demaragenouvelannee');
	    //$form->action('reinitialiser'); 

        $anneescolaires_id = Parametresglobaux::find(1)->anneescolaires_id;
        $form->method('get');
      //  $form->html('DEMARER UNE NOUVELLE ANNEE');
		//$form->select('anneescolaires_id', __('Année scolaire en cours'))->options($mesetablissements);  
        $form->select('anneescolaires_id', __('Année scolaire en cours'))->options(Anneescolaire::all()->pluck('libelleanneescolaire', 'id'))->default($anneescolaires_id)->readonly();
	   $form->select('anneescolairesP_id', __('Année scolaire précedente'))->options(Anneescolaire::all()->pluck('libelleanneescolaire', 'id'))->default($anneescolaires_id);
       // $form->text('Matricule')->placeholder('Entrez le matricule de l\'élève');
       
        $content->body(new Widgets\Box('Veuillez selectionner l\'année preccedente', $form));

        return $content;
    }
	/**
	 * Index interface.
	 *
	 * @param Content $content
	 * @return Content
	 */

/*	public function index(Content $content)
	{
		return $content
			->header('Reinitialisation des données')			
			->body($this->form());
	}*/
	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
/*	protected function form()
	{
		$form = new Form(new Anneescolaire);
		$form->setAction('reinitialiser');
		$anneescolaires_id = Parametrage::find(1)->anneescolaires_id;
		$form->html('BONAMAS - REINITIALISATION DES DONNEES');
        $form->select('anneescolaires_id', __('Année scolaire en cours'))->options(Anneescolaire::all()->pluck('libelleanneescolaire', 'id'))->default($anneescolaires_id)->readonly();		
       
		return $form;
	}*/

	public function valider(Content $content,Request $request)
	{
		$anneescolaire = Parametresglobaux::find(1)->anneescolaires_id;
		
		$donnees = $request->all();
		
		if($donnees){
			
		    $nouvelleanneescolaires_id= $donnees['anneescolaires_id'];
			$anneescolairesP_id= $donnees['anneescolairesP_id'];
			 $nouvelleanneescolaires_id= $donnees['anneescolaires_id'];
			$anneescolairesP_id= $donnees['anneescolairesP_id'];
			$etablissements=Etablissementannee::where('anneescolaires_id','=',$anneescolairesP_id)->get();
			foreach($etablissements as $etab){
				$donneesetab=[
					'exixtecloture'=>$etab->existecloture,
					'problemeequipement'=>$etab->problemeequipement,
					'anneescolaires_id'=>$nouvelleanneescolaires_id,
					'etablissements_id'=>$etab->etablissements_id,
					'periodesannuelle_id'=>$etab->periodesannuelle_id					
				];
				$idInsere=Etablissementannee::create($donneesetab);
				if($idInsere){
					//insertion dans filieres enseignés	
					$filieresenseignes=Filiereenseigne::where('etablissementannees_id','=',$etab->id)->get();
					foreach($filieresenseignes as $filiere){
						$donneesfiliere=[
							'numautorisationouverture'=>$filiere->existecloture,
							'dureeformation'=>$filiere->problemeequipement,
							'observation'=>$filiere->observation,
							'filieres_id'=>$filiere->filieres_id,
							'diplomeprepares_id'=>$filiere->diplomeprepares_id,
							'etablissementannees_id'=>$idInsere													
						];
						$idfilieree=Filiereenseigne::create($donneesfiliere);
					}
					//insertion dans infrastructure
					//insertion dans equipement
					//insertion dans sportetab
					//insertion dans personnelannee
					//insertion dans association
					
				}
			}
			
		}
		$success = new MessageBag([
		'title'   => 'Configuration d\'une nouvelle année scolaire',
		'message' => "La nouvelle année a été configurée avec succès." ,					
						]); 
		return back()->with(compact('success'));
		
	}
}
