@extends('app')
@section('title',$blog->title)
@section('desc',$blog->description)
@section('content')

    <main class="main">
        <section class="article">
            <div class="container">
                <div class="article__inner">
                    <div class="breadcrumbs">
                        <ol class="breadcrumbs__list">
                            <li class="breadcrumbs__item">
                                <a class="breadcrumbs__link" href="/{{$locale}}">
                                    {{__('Main')}}
                                </a>
                            </li>
                            <li class="breadcrumbs__item">
                                <a class="breadcrumbs__link" href="/{{$locale}}/blogs">
                                    {{__('Articles')}}
                                </a>
                            </li>
                        </ol>
                    </div>
                  {{--  <div class="article__top">
                        <img class="article__top-img" src="/storage/post/{{$blog->image}}" alt="{{$blog->h1}}">
                        <ul class="article__contents-list">
                            <li class="article__top-title">Содержание:</li>
                            <li class="article__top-item">
                                <a class="article__top-link" href="#">
                                    Правила размещения
                                </a>
                            </li>
                            <li class="article__top-item">
                                <a class="article__top-link" href="#">
                                    Политика конфиденциальности
                                </a>
                            </li>
                            <li class="article__top-item">
                                <a class="article__top-link" href="#">
                                    Вопросы и ответы
                                </a>
                            </li>
                            <li class="article__top-item">
                                <a class="article__top-link" href="#">
                                    О компании
                                </a>
                            </li>
                        </ul>
                    </div>--}}
                    <div class="article__column">
                        <div class="article__contents">
                            <h1 class="article__title title">{{$blog->h1}}</h1>
                          {!! $blog->text !!}

                        </div>

                        <aside class="article__aside">
                            <div class="article__aside-inner">
                                <p class="aside__title">Vacancies</p>
                                <ul class="article__aside-list">
                                    <li class="article__aside-list-item">
                                        <p class="article__aside-list-item-title">
                                            Lorem ipsum dolor sit amet
                                        </p>
                                        <p class="article__aside-price">
                                            1000$
                                        </p>
                                        <span class="article__aside-company">
                      OOO Employeer
                    </span>
                                    </li>
                                    <li class="article__aside-list-item">
                                        <p class="article__aside-list-item-title">
                                            Lorem ipsum dolor sit amet consectetur
                                        </p>
                                        <p class="article__aside-price">
                                            1000$
                                        </p>
                                        <span class="article__aside-company">
                      OOO Employeer
                    </span>
                                    </li>
                                    <li class="article__aside-list-item">
                                        <p class="article__aside-list-item-title">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit
                                        </p>
                                        <p class="article__aside-price">
                                            1000$
                                        </p>
                                        <span class="article__aside-company">
                      OOO Employeer
                    </span>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="article__bottom">
                        <p class="article__bottom-title">{{__('Suggested Articles')}}</p>
                        <div class="article__bottom-inner">
@foreach($latests as $latest)
                            <div class="article__bottom-item">
                                <p class="article__bottom-item-title">
                                    {{$latest->h1}}
                                </p>
                                <p class="article__bottom-text">
                                    {{$latest->short_text}}
                                </p>
                                <a class="article__bottom-link-more" href="{{$locale}}/blogs/{{$blog->slug}}">{{__('Read more')}} →</a>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
