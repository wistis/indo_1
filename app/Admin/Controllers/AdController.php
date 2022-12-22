<?php

namespace App\Admin\Controllers;

use App\Models\Ad;
use App\Models\Company;
use App\Models\Location;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Объявления';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Ad());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name_en', __('Название'));


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
        $show = new Show(Ad::findOrFail($id));

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
        $form = new Form(new Ad);

        $form->display('id', __('ID'));
        $form->text('name_en', __('Название'));
        $form->select('location_id', __('Локация'))->options(Location::pluck('name_en','id'));
        $form->select('company_id', __('Компания'))->options(Company::pluck('name_en','id'));
        $form->text('salary_from', __('Зарплата от'));
        $form->text('salary_to', __('Зарплата до'));

        $form->text('expiries_from', __('Опыт от'));
        $form->text('expiries_to', __('Опыт до'));
        $form->select('expiries_type', __('Опыт срок'))->options(['month'=>'Месяц','years'=>'Год',]);
        $form->ckeditor('description_en','Описание');
        $form->ckeditor('skills_en','Скилы');
        /*$form->text('pl');*/
        $form->date('public_at','Дата');
$form->saving(function($f){
    $f->pl=str_replace(',','.',request()->pl);
});

        return $form;
    }
}
