<?php

namespace App\Admin\Controllers;

use Hash;
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
use Illuminate\Support\Facades\Auth;
use App\Models\Directiondepartementale;
use Encore\Admin\Controllers\AdminController;

class EtablissementDetails1erSemestreController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rapport de 1er semestre';

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
        $grid->column('denominationetab', __('Denominationetab'));
        // $grid->column('datecreation', __('Datecreation'));
        $grid->column('numautorisationcreation', __('Numautorisationcreation'));
        $grid->column('numautorisationouverture', __('Numautorisationouverture'));
        $grid->column('localisation', __('Localisation'));
        $grid->column('adresse', __('Adresse'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('email', __('Email'));
        $grid->column('nomfondateur', __('Nomfondateur'));
        $grid->column('contact', __('Contact'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('communes_id', __('Communes id'));
        $grid->column('filiereautorises_id', __('Filiereautorises id'));
        $grid->column('filiereenseignes_id', __('Filiereenseignes id'));
        $grid->column('directiondepartementales_id', __('Direction regionale'));
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
        $show->field('denominationetab', __("Denomination de l'établissement"));
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
        $form = new Form(new etablissement());


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
                <span style="font-size: 14px;"><a style="color:red !important;" href="/admin/etablissementdetails1er/' . session('etablissementchoisi') . '/edit">Identification</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneefiliereenseigne1er/'. $EtabAnnee->id .'/edit">Filières de Formation</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneepersonnel1er">Personnels</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeclasse1er/'. $EtabAnnee->id .'/edit">Classe</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinfrastructure1er/'. $EtabAnnee->id .'/edit">Infrastructure et Locaux</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeinventaire1er/'. $EtabAnnee->id .'/edit">Equipement</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneesocio1er/'. $EtabAnnee->id .'/edit">Activités Socio-Educative</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneebesoinformation1er/'. $EtabAnnee->id .'/edit">Besoin en Formation</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeprobleme1er/'. $EtabAnnee->id .'/edit">Problèmes Urgents</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeconclusion1er/'. $EtabAnnee->id .'/edit">Conclusion</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/plannings2">Planning</a></span>
                <span >|</span>
                <span style="font-size: 14px";><a href="/admin/etabanneeapprenant1er">Apprenants</a></span>
            </div>
            ');

        $lesordres = array();
        $ordres = OrdreEnseignement::all();
        foreach ($ordres as $ordre) {
            $lesordres[$ordre->id] = $ordre->libelleenseignement;
        }
        $form->select('ordre_enseignement_id', __("Ordre d'enseignement"))->options($lesordres)->readonly();
		$form->text('code', __('Code'))->readonly();
        $form->text('denominationetab', __("Denomination de l'établissement"))->readonly();
        $form->text('sigle', __('Sigle'));
        $form->text('numautorisationcreation', __("Numéro d'autorisation de création"))->required();
        $form->file('documentcreation', "Uploader le document d'autorisation de création")->required();
        $form->text('numautorisationouverture', __("Numéro d'autorisation d'ouverture"))->required();
        $form->file('documentouverture', "Uploader le document d'autorisation d'ouverture")->required();
		$form->file('releve_bancaire', "Uploader votre relévé bancaire")->required();
		$form->file('registre_commerce', "Uploader votre régistre de commerce")->required();
		$form->file('certificat_nonredevance', "Uploader votre certificat de non redevance");
        $form->text('capacite', __("Capacité d'accueil"))->required();
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

        $form->text('localisation', __('Localisation'));
        $form->text('adresse', __('Adresse'));
        $form->latlong('latitude', 'longitude', 'Position');
        $form->text('telephone', __("Téléphone"))->required();
        $form->email('email', __('Courriel 1'))->required();
        $form->email('email_2', __('Courriel 2'));
        $form->text('contact_de', __('Contact du Directeur des études'))->required();
        $form->text('contact_cf', __('Contact du Correspondant Fichier'))->required();
        $form->text('contact_se', __('Contact du Sécrétariat'))->required();
        $form->text('contact_serfe', __('Contact du Serfe'))->required();
        $form->text('nomfondateur', __("Nom du Fondateur"))->required();
        $form->text('contact', __('Contact du Fondateur'))->required();
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


        // $form->hasMany('etablissementannees', __(''), function (Form\NestedForm $form) {
        //     $form->text('existecloture', __("Existe t'il une cloture ?"));
        //     $form->text('problemeequipement', __("Problème d'équipement"));

        // });
        // $form->confirm('Vérfiez les informations');

        $form->saved(function (Form $form) {
        //     $idEtab = $form->model()->id;
        //     // dd($idEtab);
        //     // Create an user account
        //     if (!AdminUser::where([
        //         ['username', '=', $form->email],
        //     ])->exists()) {
        //         $rubric = new AdminUser([
        //             'username' => $form->email,
        //             'name' => $form->email,
        //             'idEtab' => $idEtab,
        //             'password' => \Hash::make('00000000'),
        //         ]);
        //         if ($rubric->save()) {
        //             $query = new AdminRoleUser([
        //                 'user_id' => $rubric->id,
        //                 'role_id' => AdminRole::where('slug', 'etablissements')->firstOrFail()->id,
        //             ]);
        //             $query->save();
        //         }
        //     }

            $EtabAnnee = DB::table('etablissementannees')
                ->where('anneescolaires_id', '=', Parametresglobaux::findOrFail(1)->anneescolaires_id)
                ->where('etablissements_id', '=', session('etablissementchoisi'))
                ->first();

            return redirect('admin/etabanneepersonnel1er/' . $EtabAnnee->id . '/edit');
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
}
