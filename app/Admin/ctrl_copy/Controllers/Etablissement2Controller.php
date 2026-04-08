<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Commune;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Filiereautorise;
use App\Models\Filiereenseigne;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\Directiondepartementale;
use Encore\Admin\Controllers\AdminController;

use Illuminate\Support\Facades\Redirect;

class Etablissement2Controller extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rapport de la rentrée';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new etablissement());

        $parametresglobaux = Parametresglobaux::findOrFail(1);
        $anneeScolaire = Anneescolaire::findOrFail($parametresglobaux->anneescolaires_id);

        // Calculer la différence en jours pour rapport1
        $rapport1 = Carbon::parse($anneeScolaire->rapport1);
        $today = Carbon::now();

        $daysDifference = $today->lessThanOrEqualTo($rapport1)
            ? $today->diffInDays($rapport1)
            : 0;

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $role_id = $current_role->role_id;
        switch ($role_id) {
            case 2:
                $grid->model()->where('code', Auth::guard('admin')->user()->username);
                $grid->column('id', __('Id'));
                $grid->column('denominationetab', __("Denomination de l'etablissement"));
                $grid->column('communes_id', __('Commune'))->display(function ($id) {
                    $query = Commune::find($id);
                    return $query ? $query->denominationcommune : 'Non renseigné';
                });
                $grid->column('contact', __('Contact du fondateur'));
				$grid->column('releve_bancaire')->downloadable();
				$grid->column('registre_commerce')->downloadable();
				$grid->column('certificat_nonredevance')->downloadable();
                $grid->column('Document')->display(function () {
                    return '<a href="/rapportrentre/' . $this->id . '"  target="_blank" class="btn btn-primary">Télécharger </a>';
                });
                if ($daysDifference === 0) {
                    $grid->column('Action')->display(function () {
                        // session(['etablissementchoisi' => $this->id]);
                        return '<a href="#"class="btn btn-warning" disabled>Rapport clôturé</a>';
                    });
                } else {
                    $grid->column('Action')->display(function () {
                        // session(['etablissementchoisi' => $this->id]);
                        return '<a href="/admin/etablissementdetails/' . $this->id . '/edit"class="btn btn-success">Saisir les données</a>';
                    });
                }
                $grid->disableActions();
                $grid->disableCreateButton();
                $grid->disableExport();
                $grid->disableFilter();
                //$grid->disableRowSelector();
                $grid->disableColumnSelector();

                break;
            case 5:
                // $grid->model()->where('directiondepartementales_id', Auth::guard('admin')->user()->idDr)->where('fonctionnel', 1);
                // $grid->model()
                //     // ->leftjoin('etablissementannees', 'etablissementannees.etablissements_id', '=', 'etablissements.id')
                //     ->where('directiondepartementales_id', Auth::guard('admin')->user()->idDr);
                //     // ->where('etablissementannees.fonctionnel', 1);
                $grid->model()
                    ->where('directiondepartementales_id', Auth::guard('admin')->user()->idDr);
                    //->whereHas('etablissementannees', function ($query) {
                     //   $query->where('fonctionnel', 1);
                    //});
                $grid->column('id', __('Id'));
                $grid->column('denominationetab', __("Denomination de l'etablissement"));
                $grid->column('contact', __('Contact du fondateur'));
				$grid->column('releve_bancaire')->downloadable();
				$grid->column('registre_commerce')->downloadable();
				$grid->column('certificat_nonredevance')->downloadable();
                $grid->column('Document')->display(function () {
                    return '<a href="/rapportrentre/' . $this->id . '"  target="_blank" class="btn btn-primary">Télécharger le rapport</a>';
                });
                $grid->disableActions();
                $grid->disableCreateButton();
                $grid->disableExport();
                $grid->disableFilter();
                $grid->disableRowSelector();
                $grid->disableColumnSelector();

                $grid->quickSearch(function ($model, $search) {
                    $model->where('denominationetab', 'like', "%{$search}%");
                });

                break;
            case 4:
                $grid->column('id', __('Id'));
                $grid->column('denominationetab', __("Denomination de l'etablissement"));
                $grid->column('contact', __('Contact du fondateur'));
				$grid->column('releve_bancaire')->downloadable();
				$grid->column('registre_commerce')->downloadable();
				$grid->column('certificat_nonredevance')->downloadable();
                $grid->column('Document')->display(function () {
                    return '<a href="/rapportrentre/' . $this->id . '"  target="_blank" class="btn btn-primary">Télécharger le rapport</a>';
                });
                $grid->disableActions();
                $grid->disableCreateButton();
                $grid->disableExport();
                $grid->disableFilter();
                $grid->disableRowSelector();
                $grid->disableColumnSelector();

                $grid->quickSearch(function ($model, $search) {
                    $model->where('denominationetab', 'like', "%{$search}%");
                });

                break;
            default:
                $grid->column('id', __('Id'));
                $grid->column('denominationetab', __('Denominationetab'));
                $grid->column('communes_id', __('Commune'))->display(function ($id) {
                    $query = Commune::find($id);
                    return $query ? $query->denominationcommune : 'Non renseigné';
                });
                $grid->column('contact', __('Contact du fondateur'));
				$grid->column('releve_bancaire')->downloadable();
				$grid->column('registre_commerce')->downloadable();
				$grid->column('certificat_nonredevance')->downloadable();
                $grid->column('Document')->display(function () {
                    return '<a href="/rapportrentre/' . $this->id . '"  target="_blank" class="btn btn-primary">Télécharger </a>';
                });
                $grid->column('Action')->display(function () {
                    // $EtabAnnee = DB::table('etablissementannees')
                    // ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                    // ->where('etablissements_id', '=', 	$this->id)
                    // ->first();
                    // session(['etablissementchoisi' => $this->id]);
                    return '<a href="/admin/etablissementdetails/' . $this->id . '/edit"class="btn btn-success">Saisir les données</a>';
                });
                $grid->disableActions();
                $grid->disableCreateButton();
                $grid->disableExport();
                $grid->disableFilter();
                //$grid->disableRowSelector();
                $grid->disableColumnSelector();

                $grid->quickSearch(function ($model, $search) {
                    $model->where('denominationetab', 'like', "%{$search}%");
                });

                break;
        }
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
        $show->field('denominationetab', __('Denomination Etablissement'));
        $show->field('datecreation', __('Date de creation'));
        $show->field('numautorisationcreation', __('N° autorisation de creation'));
        $show->field('numautorisationouverture', __('N° autorisation d ouverture'));
        $show->field('localisation', __('Localisation'));
        $show->field('adresse', __('Adresse'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('nomfondateur', __('Nom du fondateur'));
        $show->field('fonctionnel', __('Fonctionnel'));
        $show->field('contact', __('Contact'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('communes_id', __('Communes id'));
        $show->field('filiereautorises_id', __('Filiereautorises id'));
        $show->field('filiereenseignes_id', __('Filiereenseignes id'));
        $show->field('directiondepartementales_id', __('Directiondepartementales id'));

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

        // $route = \URL::current();
        //  $data = explode("/", $route);
        //  //dd($data);
        //  $etablissements_id=$data[5];
        // session(['etablissementchoisi'=> $data[5]]);	
        // $parametresglobaux = Parametresglobaux::findOrFail(1);
        // 	$anneescolaires_id = $parametresglobaux->anneescolaires_id;	            			
        // 	$EtabAnnee = DB::table('etablissementannees')
        // 	    ->where('anneescolaires_id', '=', $anneescolaires_id)	
        //         ->where('etablissements_id', '=', $etablissements_id)				
        //         ->first();
        // 	$mesDonnees = $EtabAnnee->id;
        // 		//dd($DonneeEtab);
        // 	$libelleanneescolaire=Anneescolaire::find($anneescolaires_id)->libelleanneescolaire;
        // 	$denominationetab=Etablissement::find($etablissements_id)->denominationetab;
        // 	session(['libelleanneescolaire' =>$libelleanneescolaire]);
        // 	session(['denominationetab' =>$denominationetab]);

        //     session(['id' =>$mesDonnees ]);

        $form->html('
            <style>
            .numberCircle {
      display: inline-block;
      border-radius: 100%;
      border: 2px solid;
      font-size: 15px;
    }
    
    .numberCircle:before,
    .numberCircle:after {
      
      display: inline-block;
      line-height: 0px;
      padding-top: 50%;
      padding-bottom: 50%;
    }
    
    .numberCircle:before {
      padding-left: 8px;
    }
    
    .numberCircle:after {
      padding-right: 8px;
    }
            </style>
            <p>Nos choix: Code Etablissement: ' . session('etablissementchoisi') . '|  Etablissement: ' . session('denominationetab') . '|  Année Scolaire: ' . session('libelleanneescolaire') . '</p>
            <div>
                <span style="font-size: 14px";><a href="/admin/etablissements2/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                
                <span style="font-size: 14px";><a href="/admin/personnels/create">Personnel</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/personnelannees/create">Personnel-Année</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/besoinpersonneladms/create">Besoin personnel Administratif</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/besoinpersonnelens/create">Besoin personnel enseignant</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/infrastructures/create">Infrastructure</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/besoininfrastructures/create">Besoin infrastructure</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/classes/create">Classe</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/activitesportives/create">Activités sportives</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/associations/create">Association/Club</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/apprenants/create">Apprenants</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/apprenantannees/create">Apprenant-Année</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/besoins/create">Besoin</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/plannings/create">Planning</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/resultats/create">Resultats</a></span>
            </div>
            
        <style>
            .numberCircle {
        width: 30px;
        line-height: 30px;
        border-radius: 50%;
        text-align: center;
        font-size: 14px;
        border: 2px solid #666;
    }
    
    </style>
    
    ');

        $lesdds = array();
        $dds = Directiondepartementale::all();
        foreach ($dds as $dd) {
            $lesdds[$dd->id] = $dd->denominationdd;
        }
        $form->select('directiondepartementales_id', __('Direction départementale'))->options($lesdds);
        // $form->number('communes_id', __('Communes id'));
        $lescommunes = array();
        $communes = Commune::all();
        foreach ($communes as $commune) {
            $lescommunes[$commune->id] = $commune->denominationcommune;
        }
        $form->select('communes_id', __('Commune'))->options($lescommunes);

        $form->text('denominationetab', __('Denomination etablissement'));
        $form->text('datecreation', __('Date de creation'));
        $form->text('numautorisationcreation', __('N° autorisation de creation'));
        $form->text('numautorisationouverture', __('N° autorisation d ouverture'));
        $form->text('localisation', __('Localisation'));
        $form->text('adresse', __('Adresse'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        $form->text('nomfondateur', __('Nom de fondateur'));
        $form->text('contact', __('Contact'));
        $form->hasMany('etablissementannees', __(''), function (Form\NestedForm $form) {
            $form->text('existecloture', __('Existe-t-il cloture'));
            $form->text('problemeequipement', __('Probleme d equipement'));
            // $form->text('anneescolaires_id', __('Anneescolaires'))->default(1);
            // $form->number('anneescolaires_id', __('Anneescolaires id'));
            $lesannees = array();
            $annees = Anneescolaire::all();
            foreach ($annees as $annee) {
                $lesannees[$annee->id] = $annee->libelleanneescolaire;
            }
            $form->select('anneescolaires_id', __('Annees colaires'))->options($lesannees)->default(1);
        });

        $form->saved(function (Form $form) {
            // $idDonneeEtab=session('idDonneesEtab');
            // $idEtab=session('etablissementchoisi'); 
            //   return redirect('admin/personnels/create');
            //   return redirect('admin/personnels/create');

            // $EtabAnnee = DB::table('etablissementannees')
            // ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            // ->where('etablissements_id', '=', session('etablissementchoisi'))				
            // ->first();

            //   return redirect('admin/infobase/'.$EtabAnnee->id.'/edit');

        });
        return $form;
    }
}
