@extends('app')

@section('content')
    <main class="main">
        <section class="top">
            <div class="container">
                <div class="top__inner">
                    <h1 class="top__title title">Find a remote job</h1>
                    <p class="top__slogan">Work from anywhere. Get paid in $$$</p>
                    <form class="search" action="/" method="Get">
                        <input class="search__input search__input1" type="search" name="q" value="{{request('q')}}">

                        <button class="search__btn" type="submit">Search</button>
                    </form>
                    <form id="form_search">
                        <input type="hidden" name="company" value="{{request('company')}}">
                    </form>
                    <p class="top__subtitle top__subtitle-more">More than 100500 remote vacancies</p>
                    <p class="top__subtitle top__subtitle-job">For job-seekers from Indonesia and APAC countries</p>
                    <div class="top__control">
                        <h2 class="top__control-title">Jobs from</h2>
                        <div class="top__control-btns">
                            @foreach($comps as $comp)
                                <div class="top-control-btn"><a href="/?company={{$comp->id}}">{{$comp->name_en}}</a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="offer">
            <div class="container">
                <button class="filter-btn" type="button">{{__('Filter')}}</button>
                <div class="offer__inner">
                    <form action="#" class="filter" id="form-filter">
                        @csrf
                        <button class="filter-btn-close" type="button">
                            <img src="/images/icons/close.svg" alt="Close">
                        </button>
                        <div class="filter__item">
                            <p class="form-search__title form-title">{{__('Job type')}}</p>
                            <div class="filter-search">
                                <input class="filter-search__input" type="search" placeholder="search" name="q" value="{{request('q')}}">
                            </div>
                        </div>
                        <div class="filter__item">
                            <p class="form-sort__title form-title">{{__('Sort by')}}</p>
                            <div class="form-sort">
                                <label class="form-sort__label" for="latest">
                                    <input class="form-sort__input class_check_click" type="radio" id="latest" name="price" value="latest"
                                           checked>
                                    <span class="form-sort__radio">{{__('Latest')}}</span>
                                </label>
                                <label class="form-sort__label" for="highest">
                                    <input class="form-sort__input class_check_click" type="radio" id="highest" name="price"
                                           value="highest">
                                    <span class="form-sort__radio">{{__('Highest paid')}}</span>
                                </label>
                            </div>
                        </div>
                        <div class="filter__item">
                            <p class="filter-title form-title">{{__('Location')}}</p>
                            <div class="form-local">
                                @foreach(\App\Models\Location::get() as $loc)
                                <label class="form-local__label">
                                    <input class="form-local__input class_check_click" type="checkbox" name="location[]"
                                           value="{{$loc->id}}">
                                    <span class="form-local__checkbox">{{$loc->name_en}}</span>
                                </label>
                                @endforeach


                            </div>
                        </div>
                        <div class="filter__item">
                            <p class="filter-title form-title">{{__('Salary')}}</p>
                            <div class="form-salary">
                                @foreach(\App\Models\Salary::get() as $salary)
                                    <label class="form-salary__label">
                                        <input class="form-salary__input class_check_click" type="checkbox" name="salary[]" value="{{$salary->id}}">
                                        <span class="form-salary__checkbox">{{$salary->name_en}}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>
                    </form>
                    <div class="offer__content">
                        <div class="offer__preview">
          @include('_ad')
                        </div>
                        <button class="show-more__btn">Show more</button>
                        <div class="offer__content-bottom">
                            <h2 class="offer__content-bottom-title">
                                Vel venenatis habitasse mattis ultricies tincidunt diam
                            </h2>
                            <p class="offer__content-bottom-text">
                                A, faucibus enim mauris, in imperdiet nisl tellus. Fringilla est amet in lacus cras
                                feugiat. Sed
                                integer
                                at
                                vitae id vitae ac velit mattis urna. Nunc arcu at suspendisse diam diam sem duis luctus.
                                Massa,
                                commodo
                                tincidunt egestas ullamcorper cras habitant. Vitae maecenas in nec scelerisque amet id
                                sed eu sed.
                            </p>
                            <p class="offer__content-bottom-text">
                                Magna lectus nisl sed non adipiscing fermentum. Ipsum convallis mattis enim gravida. Et
                                enim semper
                                neque,
                                amet sodales volutpat mauris ornare.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
