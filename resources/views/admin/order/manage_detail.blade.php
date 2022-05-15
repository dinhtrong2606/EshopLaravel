@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin đăng nhập
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
            <table class="table table-bordered< b-t b-light">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$customer->customer_name}}</td>
                        <td>{{$customer->customer_phone}}</td>
                        <td>{{$customer->customer_email}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển hàng
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
            <table class="table table-bordered b-t b-light">
                <thead>
                    <tr>
                        <th>Tên người vận chuyển</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ghi chú</th>
                        <th>Hình thức thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$shipping->shipping_name}}</td>
                        <td>{{$shipping->shipping_address}}</td>
                        <td>{{$shipping->shipping_phone}}</td>
                        <td>{{$shipping->shipping_email}}</td>
                        <td>{{$shipping->shipping_note}}</td>
                        @if($payment->payment_method==1)
                        <td>Thanh toán khi nhận hàng</td>
                        @else
                        <td>Thanh toán trực tuyến</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê chi tiết đơn hàng
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
            <table class="table table-bordered b-t b-light">
                <thead>
                    <tr>
                        <th><i class="fa fa-square"></i></th>
                        <th>Tên sản phẩm</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    <?php
                    $subtotal = 0;
                    $totals = 0;
                    ?>
                    @foreach($order_detail as $key => $row_order)
                    <?php
                    $totals = ($row_order->product_price) * ($row_order->product_sales_quantity);
                    $subtotal += $totals;
                    ?>
                    <tr class="color_qty_{{$row_order->product_id}}">
                        <td>{{$i++}}</td>
                        <td>{{$row_order->product_name}}</td>
                        <td>{{$row_order->coupon_code}}</td>
                        <td>{{$row_order->product_sales_quantity}}</td>
                        <input type="hidden" class="product_sales_quantity_{{$row_order->product_id}}" name="product_sales_quantity" value="{{$row_order->product_sales_quantity}}">
                        <input type="hidden" class="product_exist_{{$row_order->product_id}}" name="product_exist" value="{{$row_order->products->product_exist}}">
                        <input type="hidden" class="product_id" name="product_id" value="{{$row_order->product_id}}">
                        <td>{{number_format($row_order->product_price). ' vnd'}}</td>
                        <td>
                            {{number_format($totals). ' vnd'}}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Tổng tiền:</td>
                        <td>{{number_format($subtotal) . ' vnd'}}</td>
                    </tr>
                </tbody>
            </table>
            <label style="color: gray;margin-top:8px" for="">Tình trạng đơn hàng</label>
            @if($id->order_status==0)
            <form>
                @csrf
                <select style="width: 40%;height: 40px" name="order_status" data-order_id="{{$row_order->order_id}}" class="form-control input-sm m-bot15 order_status">
                    <option value="0" selected>Chưa xử lí</option>
                    <option value="1">Đơn hàng đã được xử lí | Chuẩn bị giao hàng</option>
                </select>
            </form>
            @else
            <form>
                @csrf
                <select style="width: 40%;height: 40px" name="order_status" data-order_id="{{$row_order->order_id}}" class="form-control input-sm m-bot15 order_status">
                <option value="0">Chưa xử lí</option>
                <option value="1" selected>Đơn hàng đã được xử lí | Chuẩn bị giao hàng</option>
            </select>
            </form>
            @endif
            <br>
            @if($id->order_status==1)
            <a target="_blank" href="{{route('print-pdf', $row_order->order_id)}}" class="btn btn-primary">In đơn PDF</a>
            @endif
        </div>
    </div>
</div>
@endsection