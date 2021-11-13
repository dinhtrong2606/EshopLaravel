@extends('layout')
@section('main_content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center"></h2>


    <div class="col-sm-12">
        <div class="blog-post-area">
            <h2 class="title text-center">{{$catepost_id->cate_post_name}}</h2>
            <div class="single-blog-post">
                @foreach($post_list as $key => $val_post)
                <div class="row-post">
                    <div class="post-image">
                        <a href="{{route('post_detail', $val_post->post_slug)}}">
                            <img src="{{asset('uploads/post/' . $val_post->post_image)}}" alt="">
                        </a>
                    </div>
                    <div class="post-content">
                        <a href="">
                            <h3>{{$val_post->post_title}}</h3>
                        </a>
                        <p>{{$val_post->post_desc}}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pagination-area">
                <ul class="pagination">
                    {!! $post_list->links() !!}
                </ul>
            </div>
        </div>
    </div>
</div>


<!--/recommended_items-->
@endsection