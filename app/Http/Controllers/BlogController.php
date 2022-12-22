<?php

namespace App\Http\Controllers;

use App\Models\Post;class BlogController extends Controller
{
  public function index()
  {

      $blogs=Post::where('lang_id',config('lang')->id)->where('footer',0)->orderby('id','desc')->paginate(9);

      return view('blogs',compact('blogs'));
  }public function show($url)
  {

      $blog=Post::where('lang_id',config('lang')->id)->where('footer',0)->where('slug',$url)->firstOrFail();
$latests=Post::where('lang_id',config('lang')->id)->where('footer',0)->where('id','!=',$blog->id)->take(3)->get();
      return view('blog_post',compact('blog','latests'));
  }
}
