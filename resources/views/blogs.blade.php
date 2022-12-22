@extends('app')
@section('title',__('Blog title'))
@section('desc',__('Blog desc'))
@section('content')
    <main class="main">
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
                            {{__('Articles')}}
                        </a>
                    </li>
                </ol>
            </div>
        </div>

        <section class="blog">
            <div class="container">
                <div class="blog__inner">
                    @foreach($blogs as $blog)
                        <div class="blog__item">
                            <a class="blog__excerpt-link" href="{{$locale}}/blogs/{{$blog->slug}}">
                                <img class="blog__img" src="/storage/post/{{$blog->image}}" alt="article image">
                            </a>
                            <div class="blog__info">
                                <a class="blog__excerpt-link" href="{{$locale}}/blogs/{{$blog->slug}}">
                                    <h2 class="blog__title" >{{$blog->h1}}</h2>
                                </a>
                                <span class="blog__data-post">{{date('d.m.Y',strtotime($blog->created_at))}}</span>
                               @if($blog->author) <span class="blog__data-author">{{$blog->author->name}}</span> @endif
                                <p class="blog__excerpt">
                                    {{$blog->text_short}}
                                    <a class="blog__excerpt-more" href="{{$locale}}/blogs/{{$blog->slug}}">
                                        more
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" fill="#8B8B8B">
                                            <path d="m10 15.688-.771-.792 4.375-4.354H4.312V9.458h9.292L9.229 5.104 10 4.312 15.688 10Z" />
                                        </svg>
                                    </a>
                                </p>
                            </div>
                        </div>

                    @endforeach


                </div>
            </div>
        </section>
    </main>


@endsection
