<?php

namespace App\Admin\Controllers;

use Hash;
use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Commune;
use App\Models\AdminRole;
use App\Models\AdminUser;
use App\Models\AdminRoleUser;
use App\Models\Anneescolaire;
use App\Models\Etablissement;
use App\Models\Filiereautorise;
use App\Models\Filiereenseigne;
use App\Models\OrdreEnseignement;
use App\Models\Parametresglobaux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Encore\Admin\Actions\RowAction;
use Illuminate\Support\Facades\Auth;
use App\Models\Directiondepartementale;

use Encore\Admin\Controllers\AdminController;

class EtablissementDetailsController extends AdminController
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

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();
        // echo $current_role->role_id;
        // echo $postulant->id;
        // dd($postulant);
        if (in_array($current_role->role_id, array(2))) {
            $grid->model()->where('id', '=', $etablissement->id);
            $grid->disableActions();
        }

        $grid->column('id', __('Id'));
        $grid->column('denominationetab', __("Denomination de l'etablissement"));
        $grid->column('datecreation', __('Date de creation'));
        $grid->column('numautorisationcreation', __("Numero d'autorisation de creation"));
        $grid->column('numautorisationouverture', __("Numero d'autorisation d'ouverture"));
        $grid->column('capacite', __("Capacité d'accueil"));
        $grid->column('localisation', __('Localisation'));
        $grid->column('adresse', __('Adresse'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('email', __('Email'));
        $grid->column('nomfondateur', __('Nom du fondateur'));
        $grid->column('contact', __('Contact'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('communes_id', __('Communes id'));
        $grid->column('filiereautorises_id', __('Filiere Autorises'));
        $grid->column('filiereenseignes_id', __('Filiere enseignes'));
        $grid->column('directiondepartementales_id', __('Direction departementales'));
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();

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
        $show->field('denominationetab', __('Denominationetab'));
        $show->field('datecreation', __('Datecreation'));
        $show->field('numautorisationcreation', __('Numautorisationcreation'));
        $show->field('numautorisationouverture', __('Numautorisationouverture'));
        $show->field('localisation', __('Localisation'));
        $show->field('adresse', __('Adresse'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('nomfondateur', __('Nomfondateur'));
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

        session(['etablissementchoisi' => $this->_get_id()]);
        // dd(session('etablissementchoisi'));
        
        $form = new Form(new etablissement());
        // dd($form->id);

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();

        $EtabAnnee = DB::table('etablissementannees')
            ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
            ->where('etablissements_id', '=', session('etablissementchoisi'))
            ->first();

        $form->html('
		<style>
		.span {
            line-height: 1;
            background: #1ABB9C;
            color: #fff !important;
}

		</style>

		<div>
                <h1 style="text-align:center; text-transform:uppercase;">Identification</h1>
                <span style="font-size: 14px;"><a style="color:red !important;" href="/admin/etablissementdetails/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne/' . $EtabAnnee->id . '/edit">Filières de Formation</a></span>
                
				<span >|</span>
                <span style="font-size: 14px";><a href="/admin/personnelannees2">Personnels</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeclasse/' . $EtabAnnee->id . '/edit">Classe</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneepoint/' . $EtabAnnee->id . '/edit">Progression</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeindicateurs/' . $EtabAnnee->id . '/edit">Indicateurs</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure/' . $EtabAnnee->id . '/edit">Infrastructure et Locaux</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeproblemeinfrastructures/' . $EtabAnnee->id . '/edit">Problèmes Infrastructures</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinventaire/' . $EtabAnnee->id . '/edit">Inventaire d\'Equipement</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebudgets/' . $EtabAnnee->id . '/edit">Exécution Budget</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeressources/' . $EtabAnnee->id . '/edit">Ressources Additionnelles</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneescolarites/' . $EtabAnnee->id . '/edit">Frais scolarité</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneetravaux/' . $EtabAnnee->id . '/edit">Autres ressources</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneecomite/' . $EtabAnnee->id . '/edit">Comité gestion</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneesocio/' . $EtabAnnee->id . '/edit">Activités Socio-Educative</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeprobleme/' . $EtabAnnee->id . '/edit">Problèmes Urgents</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeperspectives/' . $EtabAnnee->id . '/edit">Perspectives</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeconclusion/' . $EtabAnnee->id . '/edit">Conclusion</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/plannings">Planning</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/apprenantannees2">Apprenants</a></span>
                
            </div>
            ');

		$lesordres = array();
        $ordres = OrdreEnseignement::all();
        foreach ($ordres as $ordre) {
            $lesordres[$ordre->id] = $ordre->libelleenseignement;
        }
        $form->select('ordre_enseignement_id', __("Ordre d'enseignement"))->options($lesordres)->readonly();
        $lesdds = array();
        $dds = Directiondepartementale::all();
        foreach ($dds as $dd) {
            $lesdds[$dd->id] = $dd->denominationdd;
        }
        $form->select('directiondepartementales_id', __('Direction Régionale'))->options($lesdds)->required();

        $lescommunes = array();
        $communes = Commune::all();
        foreach ($communes as $commune) {
            $lescommunes[$commune->id] = $commune->denominationcommune;
        }
        $form->select('communes_id', __('Commune'))->options($lescommunes)->required();
		$form->text('code', __('Code'))->readonly();
        $form->text('denominationetab', __("Denomination de l'établissement"))->readonly();
        $form->text('sigle', __('Sigle'));
        $form->text('date_creation', __('Date de création de l\'établissement'));
        $form->text('date_ouverture', __('Date d\'ouverture de l\'établissement'));
        $form->text('localisation', __('Localisation'));
        $form->text('adresse', __('Adresse'));
        $form->latlong('latitude', 'longitude', 'Position');
        $form->text('telephone', __("Téléphone"))->required();
        $form->email('email', __('Courriel 1'))->required();
        $form->email('email_2', __('Courriel 2'));
        $form->text('contact', __('Contact'));

        $form->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();

            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });


        // $form->number('directiondepartementales_id', __('Directiondepartementales id'));

        // $form->number('communes_id', __('Communes id'));

        // $form->hasMany('etablissementannees', __(''), function (Form\NestedForm $form) {
        //     $form->text('existecloture', __('Existe-t-il une cloture'));
        //     $form->text('problemeequipement', __('Probleme d equipement'));
        //     // $form->number('anneescolaires_id', __('Anneescolaires id'));
        //     // $lesannees = array();
        //     // $annees = Anneescolaire::all();
        //     // foreach ($annees as $annee) {
        //     //     $lesannees[$annee->id] = $annee->libelleanneescolaire;
        //     // }
        //     // $form->select('anneescolaires_id', __('Anneescolaires'))->options($lesannees);
        // });
        // $form->confirm('Vérfiez les informations');

        $form->saved(function (Form $form) {

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

            return redirect('admin/etabanneefiliereenseigne/' . $EtabAnnee->id . '/edit');
        });

        return $form;
    }

    public function _get_id()
    {
        $route = \URL::current();
        $data = explode("/", $route);
        // dd($data);
        return $data[5];
    }
    private function _check_access(Request $request, $id)
    {
        $parametresglobaux = Parametresglobaux::findOrFail(1);
        $anneeScolaire = Anneescolaire::findOrFail($parametresglobaux->anneescolaires_id);

        // Calculer la différence en jours pour rapport1
        $rapport1 = Carbon::parse($anneeScolaire->rapport1);
        $today = Carbon::now();

        $daysDifference = $today->lessThanOrEqualTo($rapport1)
            ? $today->diffInDays($rapport1)
            : 0;


        // Si la différence est égale à 0, empêcher l'accès
        if ($daysDifference === 0) {

            // Modifier ton modèle ou effectuer une action
            $model = Etablissement::findOrFail($id);
            $model->update($request->all());

            // admin_toastr('Le rapport de rentrée est cloturé. ', 'error');
            // // Retourner un message d'erreur avec un popup
            return redirect('/admin');
            // Afficher une page avec un message d'erreur
            // return back()->with('error', new MessageBag(['title' => 'Accès refusé', 'message' => "Le rapport de rentrée est clôturé. Vous ne pouvez plus modifier cette ressource."]));
            // return redirect()->back();
            // return $this->response()->success('Action réussie !')->redirect('/admin');
            // return Redirect::to('https://enquete-deep.cpntic.com/admin');
            // $error = new MessageBag([
            //     'title'   => 'title...',
            //     'message' => 'message....',
            // ]);

            // return response()->redirectTo(admin_url('/'))->with(compact('error'));
        }

        // dd(Redirect::to('https://enquete-deep.cpntic.com/admin'));
        // return Redirect::to('https://enquete-deep.cpntic.com/admin');
    }
}
