@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh mục
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
            <table class="table table-bordered b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th style="width:20px;">ID</th>
                        <th>Tên danh mục</th>
                        <th>Thuộc danh mục</th>
                        <th>Mô tả danh mục</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($danhmuc as $key => $row_danhmuc)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$row_danhmuc->category_name}}</td>
                        <td>
                            @if($row_danhmuc->category_parent==0)
                            <p>Danh mục cha</p>
                            @else
                            @foreach($category as $key2 => $val)
                            @if($val->category_id==$row_danhmuc->category_parent)
                            {{$val->category_name}}
                            @endif
                            @endforeach
                            @endif
                        </td>
                        <td>{{$row_danhmuc->category_desc}}</td>
                        <td>
                            @if($row_danhmuc->category_status==0)
                            <form>
                                @csrf
                                <select name="category_status" data-category_id="{{$row_danhmuc->category_id}}"
                                    class="form-control trangthai">
                                    <option selected value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                </select>
                            </form>
                            @else
                            <form>
                                @csrf
                                <select name="category_status" data-category_id="{{$row_danhmuc->category_id}}"
                                    class="form-control trangthai">
                                    <option value="0">Hiển thị</option>
                                    <option selected value="1">Ẩn</option>
                                </select>
                            </form>
                            @endif
                        </td>
                        <td>{{$row_danhmuc->created_at}}</td>
                        <td>{{$row_danhmuc->updated_at}}</td>
                        <td>
                            <a class="edit" href="{{route('category_edit', [$row_danhmuc->category_id])}}"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a onclick="return confirm('Bạn có thực sự muốn xóa danh mục này không ?')" class="delete"
                                href="{{route('category_delete', [$row_danhmuc->category_id])}}"><i class="fa fa-trash"
                                    aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection