@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê mã giảm giá
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
                        <th>Tên mã giảm</th>
                        <th>Code mã giảm</th>
                        <th>Số lượng</th>
                        <th>Tính năng mã</th>
                        <th>Giá trị giảm</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupon as $key => $row_coupon)
                    <tr>
                        <td>{{$row_coupon->coupon_id}}</td>
                        <td>{{$row_coupon->coupon_name}}</td>
                        <td>{{$row_coupon->coupon_code}}</td>
                        <td>{{$row_coupon->coupon_time}}</td>
                        <td>
                            @if($row_coupon->coupon_condition==1)
                            Giảm theo %
                            @else
                            Giảm theo tiền
                            @endif
                        </td>
                        <td>{{$row_coupon->coupon_number}}</td>
                        <td>
                            <a onclick="return confirm('Bạn có thực sự muốn xóa mã giảm này không ?')" class="delete" href="{{route('coupon_delete', [$row_coupon->coupon_id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
@endsection