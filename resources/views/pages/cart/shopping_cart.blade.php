@extends('layout')
@section('main_content')
<!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row" id="update_cart">
                <div class="col-lg-8">
                @if(session()->get('cart') != null)
                @php
                $total = 0;
                @endphp
                    <div class="shopping__cart__table">
                        <table>
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>      
                        @endif

                        @if (session('success'))
                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Mã giảm giá hợp lệ!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            </script>
                        @endif
                        <?php
                        $data = session('cart');
                        ?>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                            @php
                            $subtotal = $value['product_qty'] * $value['product_price'];
                            $total += $subtotal;
                            @endphp
                                <tr id="sid{{$value['product_id']}}" class="cart-number">
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img width="90" height="90" src="{{url('uploads/gallevy/'. $value['product_image'])}}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$value['product_name']}} | Size: <span style="text-transform: capitalize;">{{$value['product_size']}}</span></h6>
                                            <h5>{{number_format($value['product_price']). ' vnd'}}</h5>
                                        </div>
                                    </td>
                                    <td>
                                        <input class="form-control cart_quantity" data-product_id="{{$value['product_id']}}"
                                            type="number" name="quantity[{{$value['session_id']}}]"
                                            value="{{$value['product_qty']}}" min="1" style="width: 60px">
                                        <input type="hidden" class="product_exist_{{$value['product_id']}}"
                                            value="{{$value['product_exist']}}">
                                        <input type="hidden" class="product_price_{{$value['product_id']}}"
                                            value="{{number_format($value['product_price'])}}">    
                                    </td>
                                    <td id="total{{$value['product_id']}}" class="cart__price">{{number_format($subtotal) . ' vnd'}}</td>
                                    <td class="cart__close"><a><i data-product_id="{{$value['product_id']}}" class="fa fa-close btn-delete"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <div id="error_coupon"></div>
                        <div class="row">
                            <input class="form-control" type="text" name="coupon" placeholder="Coupon code" style="width: 250px;">
                            <button class="btn btn-primary check_out" type="submit" style="margin-left: 10px;">Apply</button>
                        </div>
                    </div>
                    <div class="cart__total">
                        <div id="cal_cart">
                            <h6>Cart total</h6>
                            <ul>
                                <?php
                                $coupon = session('coupon');
                                ?>
                                @if(session()->has('coupon'))
                                <li>Tổng giá <span>{{number_format($total) . ' vnd'}}</span></li>
                                @if($coupon)
                                @foreach($coupon as $key => $value)
                                @if($value['coupon_condition']==1)
                                    <li>Mã giảm <span>{{$value['coupon_number']}} %</span></li>
                                
                                @php
                                    $total_coupon = ($total*$value['coupon_number'])/100;
                                    echo '<li>Số tiền giảm <span>' .number_format($total_coupon). 'vnd</span></li>'
                                @endphp

                                @else
                                    <li>Mã giảm <span> {{number_format($value['coupon_number'])}} vnd</span></li>
                                @php
                                    $total_coupon = $value['coupon_number'];
                                    echo '<li>Số tiền giảm <span>' . number_format($total_coupon). 'vnd</span></li>'
                                @endphp

                                @endif

                                @endforeach

                                @endif
                                <li>Phí vận chuyển <span>Free</span></li>
                                <li><hr></li>
                                @if($coupon)
                                @foreach($coupon as $key => $value)
                                @if($value['coupon_condition'] == 1)
                                
                                @php
                                    $total_coupon = ($total*$value['coupon_number'])/100;
                                    $total_after = $total - $total_coupon;
                                    echo '<li>Thành tiền <span>' .number_format($total_after) . 'vnd</span></li>'
                                @endphp

                                @php
                                    session_start();
                                    $total_after1 = number_format($total_after);
                                    $total_cus[] = array('total' => $total_after1);
                                    Session::put('total', $total_cus)
                                @endphp

                                @else

                                @php
                                    $total_coupon = $value['coupon_number'];
                                    $total_after = $total - $total_coupon;
                                    echo '<li>Thành tiền <span>' .number_format($total_after). 'vnd</span></li>'
                                @endphp

                                @php
                                    session_start();
                                    $total_after1 = number_format($total_after);
                                    $total_cus[] = array('total' => $total_after1);
                                    Session::put('total', $total_cus)
                                @endphp

                                @endif

                                @endforeach

                                @endif

                                @else
                                <li>Tổng giá<span>{{number_format($total) . ' vnd'}}</span></li>
                                <li>Phí vận chuyển<span>Free</span></li>
                                <li><hr></li>
                                <li>Thành tiền<span>{{number_format($total) . ' vnd'}}</span></li>
                                @php
                                session_start();
                                $total_cus[] = array('total' => $total);
                                Session::put('total', $total_cus)
                                @endphp
                                @endif
                            </ul>
                            @if(session()->has('customer_id'))
                                <a href="{{route('check-out')}}" class="primary-btn">Proceed to checkout</a>
                            @else
                                <a href="{{url('/login-customer')}}" class="primary-btn">Proceed to checkout</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="cart-null" style="text-align: center;margin-left: 45%">
                <img width="200" height="200" src="{{asset('frontend/images/icon_funny.jpg')}}" alt="" />
                <p>Giỏ hàng của bạn còn trống</p>
                <a href="{{url('/shop-detail')}}" class="btn btn-danger">MUA NGAY</a>
            </div>
            @endif
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection