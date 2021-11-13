@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        CẬP NHẬT BÀI VIẾT
    </header>
    <div class="panel-body">
        <div class="position-center">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
                @endif
                <form action="{{route('post.update', $post->post_id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên bài viết</label>
                        <input type="text" name="post_title" value="{{$post->post_title}}" class="form-control"
                            onkeyup="ChangeToSlug();" id="slug">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug bài viết</label>
                        <input type="text" name="post_slug" value="{{$post->post_slug}}" class="form-control"
                            id="convert_slug" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label>Danh mục bài viết</label>
                        <select name="cate_post_id" class="form-control">
                            @foreach($catepost as $key => $row_cate_post)
                            <option {{$row_cate_post->cate_post_id==$post->catepost->cate_post_id ? 'selected' : ''}}
                                value="{{$row_cate_post->cate_post_id}}">{{$row_cate_post->cate_post_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả bài viết</label>
                        <textarea style="resize:none" name="post_desc" rows="7" type="text" class="form-control"
                            id="exampleInputPassword1">{{$post->post_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung bài viết</label>
                        <textarea name="post_content" type="text" class="form-control"
                            id="content_post">{!! $post->post_content !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Meta mô tả</label>
                        <textarea style="resize:none" name="post_meta_desc" rows="4" type="text" class="form-control"
                            id="exampleInputPassword1">{{$post->post_meta_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta keywords</label>
                        <input type="text" name="post_meta_keywords" value="{{$post->post_meta_keywords}}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                        <input type="file" name="post_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="post_status" class="form-control">
                            @if($post->post_status==0)
                            <option selected value="0">Hiển thị</option>
                            <option value="1">Ẩn</option>
                            @else
                            <option value="0">Hiển thị</option>
                            <option selected value="1">Ẩn</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
        </div>
</section>
@endsection