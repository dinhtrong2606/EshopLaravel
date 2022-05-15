@extends('layout')
@section('main_content')
 <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="{{url('frontend/images/img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Our Blog</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
   <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{url('uploads/post/' . $post->post_image)}}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{url('frontend/images/icon/calendar.png')}}" alt="">{{$post->updated_at->toDayDateTimeString()}}</span>
                            <span>Lượt xem: {{$post->post_views}}</span>
                            <h5>{{$post->post_title}}</h5>
                            <a href="{{route('blog_details', [$post->post_slug])}}">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection