@extends('layout')
@section('main_content')
<!-- Checkout Section Begin -->
    @if($order_status->del_flg == 0)
    <?php 
        if($order_status->order_status == 0){
            $status = 'Đơn hàng đang chờ xác nhận';
        }else{
            $status = 'Đơn hàng đã được xác nhận và đang được giao';
        }
    ?> 
    <h3 class="text-center mt-5"><b><i>Tình trạng đơn hàng : <span>{{ $status }}</span></i></b></h3>
    <section class="checkout spad">
        <div class="container">
            <div class="col-lg-15 text-center">
                <div class="shopping__cart__table">
                    <input type="hidden" name="order_id" value="{{ $order_status->order_id }}">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th style="width: 12%"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 12%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @foreach($orders as $key => $order)
                        @php
                        $subtotal = $order->product_sales_quantity * $order->product_price;
                        $total += $subtotal;
                        @endphp
                            <tr id="sid{{$order->order_details_id}}" class="cart-number">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img width="90" height="90" src="{{url('uploads/gallevy/'. $order->products->product_image)}}" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{$order->products->product_name}}</h6>
                                        <h5>{{number_format($order->product_price). ' vnd'}}</h5>
                                    </div>
                                </td>
                                <td>{{$order->product_sales_quantity}}</td>
                                <td class="cart__price">{{number_format($subtotal) . ' vnd'}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tbody>
                            <tr>
                                <td></td>
                                <td class="product__cart__item"><h4>Thành tiền :</h4></td>
                                <td class="product__cart__item"><h4>{{number_format($total) . ' vnd'}}</h4></td>
                                <td><button class="btn btn-danger btn-destroy-order">Hủy đơn hàng</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    @else
    <section class="checkout spad">
        <div class="container">
            <h3 class="text-center mt-5"><b><i>Tình trạng đơn hàng : <span style="color: red">Đã bị hủy</span></i></b></h3>
        </div>
    </section>
    @endif
@endsection