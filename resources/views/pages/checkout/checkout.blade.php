@extends('layout')
@section('main_content')
<!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form>
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="checkout__input">
                                <p>Họ và tên<span>*</span></p>
                                <input class="shipping_name" name="shipping_name" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input class="shipping_email" name="shipping_email" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input class="shipping_address" name="shipping_address" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Phone<span>*</span></p>
                                <input class="shipping_phone" name="shipping_phone" type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Ghí chú đơn hàng<span>*</span></p>
                                <textarea name="shipping_note" class="form-control shipping_note" type="text" style="height: 200px;"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <ul class="checkout__total__products">
                                <?php
                                $data = session('cart');
                                ?>
                                @foreach($data as $value)
                                @php 
                                $subtotal = $value['product_qty'] * $value['product_price'];
                                @endphp
                                    <li>{{$value['product_name']}} | SL: {{$value['product_qty']}} <span>{{number_format($subtotal). ' vnd'}}</span></li>
                                @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Coupon code <span>
                                    @php 
                                    $coupon = session('coupon');
                                    if($coupon){
                                        echo $coupon[0]['coupon_code'] ;
                                    }else{
                                        echo 'Không áp dụng!';
                                    }
                                    @endphp
                                    </span></li>
                                    <li>Total <span>
                                    @php 
                                    $total = session('total');
                                    echo $total[0]['total'] . ' vnd';
                                    @endphp
                                    </span></li>
                                </ul>
                                <div class="checkout__input__checkbox row">
                                    <input value="1" type="checkbox" name="payment_option" id="payment_option" style="margin: 2px 0 0 15px">
                                    <label for="payment_option">Thanh toán khi nhận hàng</label>
                                </div>
                                <div class="checkout__input__checkbox row">
                                    <input value="2" name="payment_option" type="checkbox" id="payment_option2" style="margin: 2px 0 0 15px">
                                    <label for="payment_option2">Thanh toán trực tuyến</label>
                                </div>
                                <button type="button" class="site-btn save-order">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection