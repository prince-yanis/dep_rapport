<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TcdEtablissementApprenant;
use Encore\Admin\Controllers\AdminController;
use App\Exports\TcdEtablissementApprenantExport;

class TcdEtablissementApprenantExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TcdEtablissementApprenant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TcdEtablissementApprenant());

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
        $grid->column('denominationetab', __('denominationetab'));
        $grid->column('libelleanneescolaire', __('libelleanneescolaire'));
        $grid->column('directiondepartementales_id', __('directiondepartementales_id'));
        $grid->column('denominationdd', __('denominationdd'));
        $grid->column('directionregionales_id', __('directionregionales_id'));
        $grid->column('denominationdr', __('denominationdr'));
        $grid->column('matriculeap', __('matriculeap'));
        $grid->column('nom', __('nom'));
        $grid->column('prenoms', __('prenoms'));
        $grid->column('datenaissance', __('datenaissance'));
        $grid->column('lieunaissance', __('lieunaissance'));
        $grid->column('sexe', __('sexe'));
        $grid->column('telephone', __('telephone'));
        $grid->column('email', __('email'));
        $grid->column('nationalite', __('nationalite'));
        $grid->column('libellestatutap', __('libellestatutap'));
        $grid->column('libellebourse', __('libellebourse'));
        $grid->column('denominationclasse', __('denominationclasse'));
		$grid->tools(function ($tools) {
			$tools->append("<a href='tcdetablissementapprenant/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
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
        $show = new Show(TcdEtablissementApprenant::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TcdEtablissementApprenant());



        return $form;
    }

    public function export() 
    {
        return Excel::download(new TcdEtablissementApprenantExport, 'Tcd_Etablissement_Apprenant.xlsx');
    }
}
