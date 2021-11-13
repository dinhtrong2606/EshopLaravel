@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê đơn hàng
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
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày tháng đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody> 
                @php $i=1 @endphp 
                    @foreach($manage_order as $key => $row_order)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row_order->order_id}}</td>
                        <td>{{$row_order->created_at}}</td>
                        <td>{{$row_order->order_status}}</td>
                        <td>
                        <a class="btn btn-primary" href="{{route('manage-detail', $row_order->order_id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a onclick="return confirm('Bạn có thực sự muốn xóa đơn hàng này không ?')" class="delete" href="{{route('delete-order', [$row_order->order_id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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