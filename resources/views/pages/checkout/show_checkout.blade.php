@extends('pages.product.layout_detail')
@section('main_content')
<section id="cart_items">
    <div class="container-fluid">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <div class="register-req">
            <p>Vui lòng sử dụng Đăng ký và Thanh toán để dễ dàng truy cập vào lịch sử đơn đặt hàng của bạn hoặc sử dụng Thanh toán với tư cách Khách</p>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <p>Điền thông tin người dùng</p>
            <div class="row">
                <div class="col-sm-9">
                    <div class="shopper-info">
                        <form>
                            @csrf
                            <input class="shipping_email" name="shipping_email" type="text" placeholder="Email">
                            <input class="shipping_name" name="shipping_name" type="text" placeholder="Họ và tên">
                            <input class="shipping_address" name="shipping_address" type="text" placeholder="Địa chỉ">
                            <input class="shipping_phone" name="shipping_phone" type="text" placeholder="Phone">
                            <textarea class="shipping_note" name="shipping_note" placeholder="Ghi chú đơn hàng của bạn" rows="12"></textarea>
                            <label>Chọn hình thức thanh toán</label>
                            <select class="payment_option" name="payment_option">
                                <option value="1">Thanh toán khi nhận hàng</option>
                                <option value="2">Thanh toán trực tuyến</option>
                            </select>
                            <button name="submit" class="btn btn-primary save-order" type="button">Gửi thông tin</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5 clearfix">
                </div>
            </div>
        </div>

    </div>
</section>
<!--/#cart_items-->
@endsection