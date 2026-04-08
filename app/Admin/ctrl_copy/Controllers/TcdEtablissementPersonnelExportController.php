<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TcdEtablissementPersonnel;
use Encore\Admin\Controllers\AdminController;
use App\Exports\TcdEtablissementPersonnelExport;

class TcdEtablissementPersonnelExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TcdEtablissementPersonnel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TcdEtablissementPersonnel());

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();

        if (in_array($current_role->role_id, array(2))) {
            $grid->model()->where('id_etab', '=', $etablissement->id);
        }

        $grid->column('id', __('id'));
        $grid->column('etablissementannees_id', __('etablissementannees_id'));
        $grid->column('id_etab', __('etablissement id'));
        $grid->column('id_annee', __('annee id'));
		$grid->column('id_ordre_enseignement', __('ordre enseignement id'));
        $grid->column('libelleenseignement', __('libelle enseignement'));
        $grid->column('denominationetab', __('denominationetab'));
        $grid->column('libelleanneescolaire', __('libelleanneescolaire'));
        $grid->column('directiondepartementales_id', __('directiondepartementales_id'));
        $grid->column('DR', __('DR'));
        $grid->column('personnels_id', __('personnels_id'));
        $grid->column('matricule', __('matricule'));
        $grid->column('nom', __('nom'));
        $grid->column('prenoms', __('prenoms'));
        $grid->column('sexe', __('sexe'));
        $grid->column('telephone', __('telephone'));
        $grid->column('email', __('email'));
        $grid->column('numeroautorisation', __('numeroautorisation'));
        $grid->column('libelletypepersonnel', __('libelletypepersonnel'));
        $grid->column('libellediplome', __('libellediplome'));
        $grid->column('libellediscipline', __('libellediscipline'));
        $grid->column('libelleniveau', __('libelleniveau'));
        $grid->column('libellestatutpers', __('libellestatutpers'));
        $grid->column('libellefonction', __('libellefonction'));
		$grid->tools(function ($tools) {
			$tools->append("<a href='tcdetablissementpersonnel/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
		});
        
		$grid->disableActions();   
		$grid->disableCreateButton();    
		$grid->disableExport();
		$grid->disableFilter();
		//$grid->disableRowSelector();
		$grid->disableColumnSelector();


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
        $show = new Show(TcdEtablissementPersonnel::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TcdEtablissementPersonnel());



        return $form;
    }

    public function export() 
    {
        return Excel::download(new TcdEtablissementPersonnelExport, 'Tcd_Etablissement_Personnel.xlsx');
    }
}
