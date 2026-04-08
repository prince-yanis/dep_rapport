<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\AtlasAdmin;
use App\Models\AdminRoleUser;
use App\Models\Etablissement;
use App\Exports\AtlasAdminExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Encore\Admin\Controllers\AdminController;

class AtlasAdminExportController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Atlas Admin';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AtlasAdmin());

        $current_user = Auth::guard('admin')->user();
        $current_role = AdminRoleUser::where('user_id', $current_user->id)->first();
        $etablissement = Etablissement::where('id', $current_user->idEtab)->first();

        if (in_array($current_role->role_id, array(2))) {
            $grid->model()->where('id_etab', '=', $etablissement->id);
        }

        $grid->column('id_etab', __('id'));
        $grid->column('denominationetab', __("dénomination de l'établissement"));
        $grid->column('id_district', __('district'));
        $grid->column('denominationdistrict', __('denomination du district'));
        $grid->column('id_region', __('region'));
        $grid->column('denominationregion', __('denomination de la region'));
        $grid->column('id_departement', __('Département'));
        $grid->column('denominationdepartement', __('Denomination du departement'));
        $grid->column('id_commune', __('Commune'));
        $grid->column('denominationcommune', __('Denomination commune'));
		$grid->tools(function ($tools) {
			$tools->append("<a href='atlasadmins/export' class='btn btn-primary' target='_blank'>Export vers Excel</a>");
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
        $show = new Show(AtlasAdmin::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AtlasAdmin());



        return $form;
    }

    public function export()
    {
        return Excel::download(new AtlasAdminExport, 'Atlas_Admin.xlsx');
    }
}
