@extends('pages.product.layout_detail')
@section('main_content')
<div id="container">
    <section id="cart_items">
        <div class="container-fluid">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{route('trang-chu')}}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            @if(session()->has('cart'))
            <div id="update_cart" class="table-responsive cart_info">
                <table class="table table-condensed table-responsive">
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <!-- @if (session('status'))
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Xóa sản phẩm thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
                @endif -->
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
                        <tr class="cart_menu">
                            <td>Hình ảnh</td>
                            <th>Tên SP</th>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Total</td>
                            <td>Del</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @foreach($data as $key => $value)
                        @php
                        $subtotal = $value['product_qty'] * $value['product_price'];
                        $total += $subtotal;
                        @endphp
                        <form action="{{route('update-cart')}}" method="POST">
                            @csrf
                            <tr id="sid{{$value['product_id']}}">
                                <td><img style="width: 150px;height:80px"
                                        src="{{asset('uploads/gallevy/' .$value['product_image'])}}" alt=""></td>
                                <td>{{$value['product_name']}}</td>
                                <td>{{number_format($value['product_price']) . ' vnd'}}</td>
                                <td><input class="cart_quantity" data-product_id="{{$value['product_id']}}"
                                        type="number" name="quantity[{{$value['session_id']}}]"
                                        value="{{$value['product_qty']}}" min="1" style="width: 50px">
                                    <input type="hidden" class="product_exist_{{$value['product_id']}}"
                                        value="{{$value['product_exist']}}">
                                </td>
                                <td id="total{{$value['product_id']}}">{{number_format($subtotal) . ' vnd'}}</td>
                                <td><a><i data-id="{{$value['product_id']}}" class="fa fa-times"></i></a></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Cập nhật giỏ hàng</button>
                </form>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
    <section id="do_action">
        <div class="container-fluid">
            <div style="margin-left: 15px;" id="error_coupon"></div>
            <div class="col-sm-6">
                <div class="total_area">
                    <div class="row">
                        <ul>
                            <input class="input-group-text" type="text" name="coupon"
                                placeholder="Nhập mã giảm giá"><br>
                            <button name="submit" type="button" class="btn btn-default check_out">Xác
                                nhận</button>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="cal_cart" class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <?php
                            $coupon = session('coupon');
                            ?>
                            @if(session()->has('coupon'))
                            <li>Tổng: {{number_format($total) . ' vnd'}}</li>
                            <li>
                                @if($coupon)
                                @foreach($coupon as $key => $value)
                                @if($value['coupon_condition']==1)
                                Mã giảm: {{$value['coupon_number']}} %<br>

                                @php
                                $total_coupon = ($total*$value['coupon_number'])/100;
                                echo 'Số tiền giảm: '. number_format($total_coupon) . ' vnd';
                                @endphp

                                @else
                                Mã giảm: {{number_format($value['coupon_number']). ' vnd'}} <br>
                                @php
                                $total_coupon = $value['coupon_number'];
                                echo 'Số tiền giảm: '. number_format($total_coupon) . ' vnd';
                                @endphp

                                @endif

                                @endforeach

                                @endif
                            </li>
                            <li>Thuế<span></span></li>
                            <li>Phí vận chuyển<span>Free</span></li>
                            <li>
                                @if($coupon)
                                @foreach($coupon as $key => $value)
                                @if($value['coupon_condition']==1)

                                @php
                                $total_coupon = ($total*$value['coupon_number'])/100;
                                $total_after = $total - $total_coupon;
                                echo 'Thành tiền: '. number_format($total_after) . ' vnd';
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
                                echo 'Thành tiền: '. number_format($total_after) . ' vnd';
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
                            </li>
                            @else
                            <li>Tổng<span>{{number_format($total) . ' vnd'}}</span></li>
                            <li>Thuế<span></span></li>
                            <li>Phí vận chuyển<span>Free</span></li>
                            <li>Thành tiền<span>{{number_format($total) . ' vnd'}}</span></li>
                            @php
                            session_start();
                            $total_cus[] = array('total' => $total);
                            Session::put('total', $total_cus)
                            @endphp
                            @endif
                        </ul>
                        @if(session()->has('customer_id'))
                        <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
                        @else
                        <a class="btn btn-default check_out" href="{{url('/login-checkout')}}">Check Out</a>
                        @endif
                    </div>
                </div>
                @else
                Bạn có thể tiếp tục mua hàng trước khi kiểm tra giỏ hàng
                @endif
            </div>
        </div>
    </section>
</div>
<!--/#do_action-->
@endsection