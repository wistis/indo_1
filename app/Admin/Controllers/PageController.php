<?php

namespace App\Admin\Controllers;

use App\Models\Author;
use App\Models\Lang;
use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class PageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Страницы footer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('h1', __('Название'));
        $grid->column('lang_id', __('Язык'))->display(function($use){
            $lang=Lang::find($use);
            if($lang){
                return $lang->name;
            }
        });

$grid->model()->where('footer',1);
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
        $show = new Show(Post::findOrFail($id));

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
        $form = new Form(new Post());

        $form->display('id', __('ID'));
        $form->text('title','Тайтл');
        $form->text('description','Seo описание');
        $form->text('slug','URL');
        $form->text('h1','H1');
        $form->ckeditor('text','Текст');
        $form->select('lang_id','Язык')->options(Lang::pluck('name','id'));
        $form->text('sort','Сортировка');
        $form->hidden('footer')->value(1)->default(1);
        $form->saved(function($form){

           if($form->model()->slug==''){
               $form->model()->slug=Str::slug($form->model()->h1);
               $form->model()->save();
           }


        });

        return $form;
    }
}
