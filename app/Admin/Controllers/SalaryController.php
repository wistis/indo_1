<?php

namespace App\Admin\Controllers;

use App\Models\Lang;
use App\Models\Salary;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SalaryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Фильтр зарплат';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Salary());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name_en', __('Название'));
        $grid->column('znak', __('Знак'));
        $grid->column('value', __('Значение'));
        $grid->column('value2', __('Значение 2'));



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
        $show = new Show(Salary::findOrFail($id));

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
        $form = new Form(new Salary);

        $form->display('id', __('ID'));
        $form->text('name_en','Название');
        $form->select('znak','Сравнение')->options(['>='=>'>=','=='=>'=','<='=>'<=','RANGE'=>'RANGE']);
        $form->text('value','Значение');
        $form->text('value2','Значение 2');



        return $form;
    }
}
