@extends('app')
@section('title',$ad->name)
@section('desc',$ad->name)
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
                            {{$ad->name}}
                        </a>
                    </li>
                </ol>
            </div>
        </div>

        <section class="vacancy">
            <div class="container">
                <div class="vacancy__inner">

                    <div class="vacancy__info">
                        <div class="vacancy__info-box">
                            <h2 class="vacancy__info-title">{{$ad->name}}</h2>
                            @foreach($ad->locations as $location)
                            <a class="vacancy__info-link" href="?location[]={{$location->id}}">{{$location->name_en}}</a>
                            @endforeach
                            <span class="vacancy__info-data">{{date('d M',strtotime($ad->public_at))}}</span>
                        </div>

                        <ul class="vacancy__info-list">
                   {{--         <li class="vacancy__info-item">Required work experience – 3-6 years</li>--}}
                            @if($ad->salary_from>0&&$ad->salary_to>0)
                            <li class="vacancy__info-item">Salary – $   @if($ad->salary_from>0) {{$ad->salary_from}} @endif - @if($ad->salary_to>0) {{$ad->salary_to}} @endif</li>
                            @endif
                           {{-- <li class="vacancy__info-item">Wort format</li>--}}
                        </ul>
                    </div>

                    <div class="vacancy-benefits">
                        <div class="vacancy-benefits__box">
                            @if($ad->company)
                                <p class="vacancy-benefits__subtitle">{{$ad->company->name_en}}</p>
                                <a class="vacancy-benefits__link" href="/?company={{$ad->company_id}}">
                                    @if($ad->logo)   <img class="vacancy-benefits__img" src="{{$ad->logo}}" alt="">@endif
                                </a>
                            @endif
                        </div>
                        <div class="vacancy-benefits__text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Condimentum id dui orci egestas proin.
                        </div>
                    </div>

                </div>
                <div class="vacancy__content">
                    <h2 class="vacancy__content-title">{{__('Descriotion')}}</h2>
                    {!! $ad->description !!}
                    <a class="vacancy__btn" href="#">
                        Apply
                        <span class="material-symbols-outlined">
              arrow_right_alt
            </span>
                    </a>
                </div>
            </div>
        </section>
    </main>

@endsection
