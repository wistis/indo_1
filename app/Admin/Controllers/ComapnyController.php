<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use App\Models\Lang;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ComapnyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Компании';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name_en', __('Название'));
        $grid->column('amount', __('Количесвто'));
        $grid->column('status', __('Статус'))->switch([]);


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Company);

        $form->display('id', __('ID'));
        $form->text('name_en','Название');
        $form->switch('status','Статус')->options([]);

        return $form;
    }
}
