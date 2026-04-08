<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Models\TcdInfrastructure;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TcdInfrastructureExport;
use Encore\Admin\Controllers\AdminController;

class TcdInfrastructureExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TcdInfrastructure';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TcdInfrastructure());

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
        $grid->column('libelleinfrastructure', __('libelleinfrastructure'));
        $grid->column('nombre', __('nombre'));
        $grid->column('nombrebureaux', __('nombrebureaux'));
        $grid->column('capacite', __('capacite'));
        $grid->column('observation', __('observation'));
		$grid->tools(function ($tools) {
			$tools->append("<a href='tcdinfrastructure/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
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
        $show = new Show(TcdInfrastructure::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TcdInfrastructure());



        return $form;
    }

    public function export() 
    {
        return Excel::download(new TcdInfrastructureExport, 'Tcd_Infrastructure.xlsx');
    }
}
