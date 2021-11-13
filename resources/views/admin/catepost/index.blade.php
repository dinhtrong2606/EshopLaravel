@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh mục bài viết
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">

            </div>
        </div>
        <div class="table-responsive">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">ID</th>
                        <th>Tên danh mục bài viết</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($catepost as $key => $row_cate)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$row_cate->cate_post_name}}</td>
                        <td>{{$row_cate->cate_post_desc}}</td>
                        <td>
                            @if($row_cate->cate_post_status==0)
                            <form>
                                @csrf
                                <select name="cate_post_status" data-cate_post_id="{{$row_cate->cate_post_id}}"
                                    class="form-control input-sm m-bot15 catepost">
                                    <option selected value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                </select>
                            </form>
                            @else
                            <form>
                                @csrf
                                <select name="cate_post_status" data-cate_post_id="{{$row_cate->cate_post_id}}"
                                    class="form-control input-sm m-bot15 catepost">
                                    <option value="0">Hiển thị</option>
                                    <option selected value="1">Ẩn</option>
                                </select>
                            </form>
                            @endif
                        </td>
                        <td>{{$row_cate->created_at}}</td>
                        <td>{{$row_cate->updated_at}}</td>
                        <td>
                            <a class="edit" href="{{route('cate_post_edit', $row_cate->cate_post_id)}}"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a onclick="return confirm('Bạn có thực sự muốn xóa danh mục này không ?')" class="delete"
                                href="{{route('catepost_delete', $row_cate->cate_post_id)}}"><i class="fa fa-trash"
                                    aria-hidden="true"></i></a>
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
                        {!! $catepost->links() !!}
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection