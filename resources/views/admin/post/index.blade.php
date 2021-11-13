@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê bài viết
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">

                </div>
            </div>
            <div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <table class="table table-striped b-t b-light table-responsive">
                    <thead>
                        <tr>
                            <th style="width:20px;">ID</th>
                            <th>Tên bài viết</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Mô tả</th>
                            <th>Meta mô tả</th>
                            <th>Ngày cập nhật</th>
                            <th>Ngày tạo</th>
                            <th style="width:13%">Trạng thái</th>
                            <th style="width:13%">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($post as $key => $row_post)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$row_post->post_title}}</td>
                            <th><img style="width: 130px;height:90px"
                                    src="{{asset('uploads/post/' .$row_post->post_image)}}" alt=""></th>
                            <th>{{$row_post->catepost->cate_post_name}}</th>
                            <th>{{$row_post->post_desc}}</th>
                            <th>{{$row_post->post_meta_desc}}</th>
                            <th>{{$row_post->created_at}}</th>
                            <th>{{$row_post->updated_at}}</th>
                            <td>
                                @if($row_post->post_status==0)
                                <form>
                                    @csrf
                                    <select name="post_status" data-post_id="{{$row_post->post_id}}"
                                        class="form-control post">
                                        <option selected value="0">Hiển thị</option>
                                        <option value="1">Ẩn</option>
                                    </select>
                                </form>
                                @else
                                <form>
                                    @csrf
                                    <select name="post_status" data-post_id="{{$row_post->post_id}}"
                                        class="form-control post">
                                        <option value="0">Hiển thị</option>
                                        <option selected value="1">Ẩn</option>
                                    </select>
                                </form>
                                @endif
                            </td>
                            <td>
                                <a class="edit" href="{{route('post_edit', $row_post->post_id)}}"><i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a onclick="return confirm('Bạn có thực sự muốn xóa sản phẩm này không ?')"
                                    class="delete" href="{{route('post_delete', $row_post->post_id)}}"><i
                                        class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!! $post->links() !!}
                        </ul>
                    </div>


                    <a class="btn btn-primary" href="{{route('export-product')}}">Export</a>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection