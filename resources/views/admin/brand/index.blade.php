@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê thương hiệu
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
                        <th>Tên thương hiệu</th>
                        <th>Mô tả thương hiệu</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brand as $key => $row_brand)
                    <tr>
                        <td>{{$row_brand->brand_id}}</td>
                        <td>{{$row_brand->brand_name}}</td>
                        <td>{{$row_brand->brand_desc}}</td>
                        <td>
                            @if($row_brand->brand_status==0)
                            <form>
                                @csrf
                                <select name="brand_status" data-brand_id="{{$row_brand->brand_id}}"
                                    class="form-control input-sm m-bot15 thuonghieu">
                                    <option selected value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                </select>
                            </form>
                            @else
                            <form>
                                @csrf
                                <select name="brand_status" data-brand_id="{{$row_brand->brand_id}}"
                                    class="form-control input-sm m-bot15 thuonghieu">
                                    <option value="0">Hiển thị</option>
                                    <option selected value="1">Ẩn</option>
                                </select>
                            </form>
                            @endif
                        </td>
                        <td>{{$row_brand->created_at}}</td>
                        <td>{{$row_brand->updated_at}}</td>
                        <td>
                            <a class="edit" href="{{route('brand_edit', [$row_brand->brand_id])}}"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a onclick="return confirm('Bạn có thực sự muốn xóa danh mục này không ?')" class="delete"
                                href="{{route('brand_delete', [$row_brand->brand_id])}}"><i class="fa fa-trash"
                                    aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <a class="btn btn-primary" href="{{route('export-brand')}}">Export</a>
            </div>
        </footer>
    </div>
</div>
@endsection