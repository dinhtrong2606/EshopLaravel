@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê slider
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
                            <th>Tên slider</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Ngày cập nhật</th>
                            <th>Ngày tạo</th>
                            <th style="width:13%">Trạng thái</th>
                            <th style="width:13%">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slider as $key => $row_slider)
                        <tr>
                            <td>{{$row_slider->slider_id}}</td>
                            <td>{{$row_slider->slider_name}}</td>
                            <th><img style="width: 130px;height:90px"
                                    src="{{asset('uploads/slider/' .$row_slider->slider_image)}}" alt=""></th>
                            <th>{{$row_slider->slider_desc}}</th>
                            <th>{{$row_slider->created_at}}</th>
                            <th>{{$row_slider->updated_at}}</th>
                            <td>
                                @if($row_slider->slider_status==0)
                                <form>
                                    @csrf
                                    <select name="slider_status" data-slider_id="{{$row_slider->slider_id}}"
                                        class="form-control input-sm m-bot15 slider">
                                        <option selected value="0">Hiển thị</option>
                                        <option value="1">Ẩn</option>
                                    </select>
                                </form>
                                @else
                                <form>
                                    @csrf
                                    <select name="slider_status" data-slider_id="{{$row_slider->slider_id}}"
                                        class="form-control input-sm m-bot15 slider">
                                        <option value="0">Hiển thị</option>
                                        <option selected value="1">Ẩn</option>
                                    </select>
                                </form>
                                @endif
                            </td>
                            <td>
                                <a class="edit" href="{{route('slider_edit', $row_slider->slider_id)}}"><i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a onclick="return confirm('Bạn có thực sự muốn xóa slider này không ?')" class="delete"
                                    href="{{route('delete-slider', $row_slider->slider_id)}}"><i class="fa fa-trash"
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
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection