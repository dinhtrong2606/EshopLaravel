@extends('layout')
@section('main_content')
<!-- Blog Details Hero Begin -->
    <section class="blog-hero spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="blog__hero__text">
                        <h2>{{$post->post_title}}</h2>
                        <ul>
                            <li>By {{$post->post_author}}</li>
                            <li>{{$post->updated_at->toDayDateTimeString()}}</li>
                            <li>Views: {{$post->post_views}}</li>
                            <li>8 Comments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__text">
                            <p>{!! $post->post_content !!}</p>
                        </div>
                        <div class="blog__details__option">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__author">
                                        <div class="blog__details__author__text">
                                            <h5>Author: {{$post->post_author}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__tags">
                                        <a>{{$post->post_meta_keywords}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                @if($prev_post)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="{{route('blog_details', [$prev_post->post_slug])}}" class="blog__details__btns__item">
                                        <p><span class="arrow_left"></span> Previous Pod</p>
                                        <h5>{{$prev_post->post_title}}</h5>
                                    </a>
                                </div>
                                @else
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a class="blog__details__btns__item">
                                        <p><span class="arrow_left"></span> Previous Post</p>
                                    </a>
                                </div>
                                @endif

                                @if($next_post)
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="{{route('blog_details', [$next_post->post_slug])}}" class="blog__details__btns__item blog__details__btns__item--next">
                                        <p>Next Pod <span class="arrow_right"></span></p>
                                        <h5>{{$next_post->post_title}}</h5>
                                    </a>
                                </div>
                                @else
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a class="blog__details__btns__item">
                                        <p><span class="arrow_right"></span> Next Post</p>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection