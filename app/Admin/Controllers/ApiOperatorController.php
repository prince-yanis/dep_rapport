<?php

namespace App\Admin\Controllers;

use App\Models\ApiOperator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ApiOperatorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Operateurs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ApiOperator());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('api_code', __('Api code'));
        $grid->column('api_pass', __('Api pass'));
        $grid->column('mobile', __('Mobile'));
        $grid->column('email', __('Email'));

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
        $show = new Show(ApiOperator::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('api_code', __('Api code'));
        $show->field('api_pass', __('Api pass'));
        $show->field('mobile', __('Mobile'));
        $show->field('email', __('Email'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ApiOperator());

        $form->text('name', __('Name'))->rules('required');
        $form->text('mobile', __('Mobile'))->rules('required|min:8|max:10');
        $form->email('email', __('Email'));

		$form->saved(function (Form $form) {
            $item = $form->model();
            $data = [
                'api_code' => $item->api_code ? $item->api_code : $this->_generator(5),
                'api_pass' => $item->api_pass ? $item->api_pass : $this->_generator(5, true),
            ];
            $id = $form->model()->id;
            ApiOperator::where('id', $id)->update($data);
        });

        return $form;
    }
	
    /**
     * @param $nbr
     * @return string
     */
    public function _generator($nbr, $alpha = false)
    {
        if($alpha) {
            $char = 'azertyuiopqsdfghjklmwxcvbn1234567890';
        } else {
            $char = '1234567890';
        }
        $code = '';
        for ($i = 0; $i < $nbr; $i++) {
            $pos = mt_rand(0, (strlen($char) - 1));
            $car = $char[$pos];
            $code .= $car;
        }
        return $code;
    }
}
