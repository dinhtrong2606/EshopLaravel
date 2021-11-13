@extends('pages.product.layout_detail')
@section('main_content')
<section id="cart_items">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <!--/register-req-->
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed table-responsive">

                <?php

                use Gloudemans\Shoppingcart\Facades\Cart;

                $content = Cart::content();
                ?>
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <th class="name-product">Tên SP</th>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td class="total-product">Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $key => $row_product)
                    <tr>
                        <td class="image"><img style="width: 150px;height:80px"
                                src="{{asset('uploads/gallevy/' .$row_product->options->image)}}" alt=""></td>
                        <td class="name-product">{{$row_product->name}}</td>
                        <td>{{number_format($row_product->price) . ' vnd'}}</td>
                        <td>
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="{{$row_product->qty}}" min="1" style="width: 50px">
                            </div>
                        </td>
                        <td class="total-product">
                            <p class="cart_total_price">
                                @php
                                $subtotal = $row_product->price * $row_product->qty;
                                echo number_format($subtotal) . ' vnd';
                                @endphp
                            </p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4 style="margin: 40px;font-size: 20px">Chọn hình thức thanh toán</h4>
        <form action="{{route('order-place')}}" method="POST">
            @csrf
            <div style="margin-left: 40px" class="payment-options">
                <span>
                    <label><input class="payment_option" type="checkbox" name="payment_option" value="1"> Thanh toán
                        trực tuyến</label>
                </span>
                <span>
                    <label><input class="payment_option" type="checkbox" name="payment_option" value="2"> Thanh toán khi
                        nhận hàng</label>
                </span>
                <button name="submit" class="btn btn-primary" type="submit">Đặt hàng</button>
            </div>
        </form>
    </div>
</section>
<!--/#cart_items-->
@endsection