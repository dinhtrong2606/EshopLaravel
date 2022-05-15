@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê khách hàng
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
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0 @endphp
                    @foreach($customers as $key => $customer)
                    @php $i++ @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$customer->customer_name}}</td>
                        <td>{{$customer->customer_email}}</td>
                        <td>{{$customer->customer_phone}}</td>
                        <td>{{$customer->created_at}}</td>
                        <td class="text-center">
                            <a onclick="return confirm('Bạn có thực sự muốn xóa mã giảm này không ?')" class="delete"
                                href="{{ route('customer_delete', [$customer->customer_id]) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection