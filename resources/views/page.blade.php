@extends('app')
@section('title',$post->title)
@section('desc',$post->description)
@section('content')
    <main class="main page-main">
        <div class="breadcrumbs">
            <div class="container">
                <ol class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a class="breadcrumbs__link" href="/{{$locale}}">
                            {{__('Main')}}
                        </a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a class="breadcrumbs__link" href="#">
                            {{$post->h1}}
                        </a>
                    </li>
                </ol>
            </div>
        </div>

        <section class="page rules">
            <div class="container">
                <div class="page__inner rules__inner">
                    <h1 class="page__title rules__title title">{{$post->h1}}</h1>
                    {!! $post->text !!}

                </div>
            </div>
        </section>
    </main>


@endsection
