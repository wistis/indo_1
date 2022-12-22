@extends('app')
@section('title',__('Contacts'))
@section('desc',__('Contacts'))
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
                            {{__('Contacts')}}
                        </a>
                    </li>
                </ol>
            </div>
        </div>

        <section class="page contacts">
            <div class="container">
                <div class="page__inner contacts__inner">
                    <h1 class="page__title contacts__title title">{{_('Contact')}}</h1>
                    <ul class="contacts__list">

                        <li class="contacts__list-item">{{__('Mail for appeals')}}: _______</li>

                    </ul>
                </div>
            </div>
        </section>
    </main>


@endsection
