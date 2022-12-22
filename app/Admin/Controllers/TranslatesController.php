<?php

namespace App\Admin\Controllers;

use App\Models\Lang;
use App\Models\Translate;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TranslatesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Перевод статики';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Translate());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('vkey', __('Ключ'));
        $grid->column('vvalue', __('Значение'));
        $grid->column('lang_id', __('Язык'))->display(function($use){
            $lang=Lang::find($use);
            if($lang){
                return $lang->name;
            }


        });

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
        $show = new Show(Translate::findOrFail($id));

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
        $form = new Form(new Translate);

        $form->display('id', __('ID'));
        $form->text('vkey', __('Ключ'));
        $form->text('vvalue', __('Значение'));
        $form->select('lang_id', __('Язык'))->options(Lang::pluck('name','id'));


        return $form;
    }
}
