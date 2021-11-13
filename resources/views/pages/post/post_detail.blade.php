@extends('layout')
@section('main_content')
<div class="features_items">
    <div class="col-sm-12">
        <div class="blog-post-area">
            <h2 class="title text-center">{{$post_detail->catepost->cate_post_name}}</h2>
            <div class="single-blog-post">
                <h3>{{$post_detail->post_title}}</h3>
                <div class="single-post">
                    {!! $post_detail->post_content !!}
                </div>
            </div>
        </div>
        <!--/blog-post-area-->

        <br>
        <br>
        <div class="recommended_items">
            <!--recommended_items-->
            <h2 class="title text-center">Bài viết liên quan</h2>

            @foreach($relate_post as $val)
            <div class="post-relate">
                <a class="post-relate-image" href="{{route('post_detail', $val->post_slug)}}">
                    <img class="media-object" src="{{asset('uploads/post/' .$val->post_image)}}" alt="">
                </a>
                <div class=post-relate-content">
                    <a href="{{route('post_detail', $val->post_slug)}}">
                        <h4 class="media-heading">{{$val->post_title}}</h4>
                    </a>
                    <p>{{$val->post_desc}}</p>
                </div>
            </div>
            @endforeach
            <!--Comments-->
        </div>

        <!--Comments-->

        <!--/Response-area-->
        <div class="replay-box">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Leave a replay</h2>
                    <form>
                        <div class="blank-arrow">
                            <label>Your Name</label>
                        </div>
                        <span>*</span>
                        <input type="text" placeholder="write your name...">
                        <div class="blank-arrow">
                            <label>Email Address</label>
                        </div>
                        <span>*</span>
                        <input type="email" placeholder="your email address...">
                        <div class="blank-arrow">
                            <label>Web Site</label>
                        </div>
                        <input type="email" placeholder="current city...">
                    </form>
                </div>
                <div class="col-sm-8">
                    <div class="text-area">
                        <div class="blank-arrow">
                            <label>Your Name</label>
                        </div>
                        <span>*</span>
                        <textarea name="message" rows="11"></textarea>
                        <a class="btn btn-primary" href="">post comment</a>
                    </div>
                </div>
            </div>
        </div>
        <!--/Repaly Box-->
    </div>
</div>
@endsection