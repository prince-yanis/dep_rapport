<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\TcdActiviteSportive;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TcdActiviteSportiveExport;
use Encore\Admin\Controllers\AdminController;

class TcdActiviteSportiveExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TcdActiviteSportive';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TcdActiviteSportive());

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
        $grid->column('sport_id', __('sport_id'));
        $grid->column('libellesport', __('libellesport'));
        $grid->column('directiondepartementales_id', __('directiondepartementales_id'));
        $grid->column('denominationdd', __('denominationdd'));
        $grid->column('directionregionales_id', __('directionregionales_id'));
        $grid->column('denominationdr', __('denominationdr'));
		$grid->tools(function ($tools) {
			$tools->append("<a href='tcdactivitesportive/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
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
        $show = new Show(TcdActiviteSportive::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TcdActiviteSportive());



        return $form;
    }

    public function export() 
    {
        return Excel::download(new TcdActiviteSportiveExport, 'Tcd_Activite_Sportive.xlsx');
    }
}
