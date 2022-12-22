<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('desc')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<header class="header @if(request()->route()&&request()->route()->getName()!='index')header-page @endif">
    <div class="container">
        <div class="header__inner">
            <a class="logo" href="#">
                <img class="logo__img" src="/images/logo.svg" alt="logo">
            </a>
            <div class="header__languages">
                <div class="header__languages-menu-btn">{{config('lang')->name}}</div>
                <div class="header__languages-menu">
                    @foreach($langs as $lan)
                    <a class="header__languages-link" href="/setlocale/{{$lan->code}}">{{$lan->name}}</a>
                        @endforeach
                </div>
                <button class="header__btn btn" type="button">{{__('Post a job')}}</button>
            </div>
        </div>
    </div>
</header>

@yield('content')
<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <div class="footer__item footer__articles">
                <p class="footer__title">{{__('Articles')}}</p>
               @foreach(\App\Models\Post::where('lang_id',$lang->id)->orderby('id','desc')->where('footer',0)->take(3)->get() as $blog)
                <p class="footer__text">{{$blog->h1}}</p>
                @endforeach
                <a class="footer__link" href="{{$locale}}/blogs">
                    {{__('All articles')}}
                    <span class="material-symbols-outlined">
              arrow_right_alt
            </span>
                </a>
            </div>
            <div class="footer__item footer__menu">
                <p class="footer__title">{{__('Information')}}</p>
                <ul class="footer__list">
                    @foreach(\App\Models\Post::where('lang_id',$lang->id)->orderby('id','desc')->where('footer',1)->get() as $blog)
                    <li class="footer__list-item">
                        <a class="footer__list-link" href="{{$locale}}/page/{{$blog->slug}}">
                            {{$blog->h1}}
                        </a>
                    </li>@endforeach
                        <li class="footer__list-item">
                            <a class="footer__list-link" href="{{$locale}}/contacts">
                              {{__('Contacts')}}
                            </a>
                        </li>
                </ul>
            </div>
            <div class="footer__item footer__contact">
                <ul class="footer__list">
                    <li class="footer__title">{{__('Contact')}}</li>

                    <li class="footer__list-item">{{__('General site mail')}}: _________</li>
                </ul>

                <div class="footer__contact-box">
                    <div class="footer__social">
                        <a class="footer__social-link" href="#">
                            <svg width="40" height="40" fill="none">
                                <use xlink:href="images/icons/social/sprite.svg#telegram">
                                </use>
                            </svg>
                        </a>
                        <a class="footer__social-link" href="https://www.viber.com/ru/" target="_blank">
                            <svg width="40" height="40" fill="none">
                                <use xlink:href="images/icons/social/sprite.svg#viber">
                                </use>
                            </svg>
                        </a>
                    </div>
                    <div class="footer__copy">
                        <p class="footer__copy-text">{{date('Y')}} © {{__('Copywright')}}</p>
                    </div>
                </div>
            </div>
            <a class="footer__logo" href="https://telegram.org/" target="_blank">
                <img class="footer__logo-img" src="/images/logo.svg" alt="logo">
            </a>
        </div>
    </div>
</footer>
<script src="/js/jquery.js"></script>
<script src="/js/data.js"></script>
<script src="/js/main.js"></script>
</body>

</html>
