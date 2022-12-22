<?php

namespace App\Admin\Controllers;

use App\Models\Lang;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LangController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Языки';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lang());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Язык'));


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
        $show = new Show(Lang::findOrFail($id));

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
        $form = new Form(new Lang);

        $form->display('id', __('ID'));
        $form->text('name','Название');
        $form->text('code','Код');
        $form->text('sort','Сортировка')->help('От меньшего к большему');
        $form->switch('is_default','Язык поумолчанию')->options([]);

        return $form;
    }
}
