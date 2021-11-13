@include('pages.header')

@include('pages.leftbar')

@include('pages.footer')

<script src="{{ url('frontend/js/jquery.js')}}"></script>
<script src="{{url('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{url('frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{url('frontend/js/price-range.js')}}"></script>
<script src="{{url('frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{url('frontend/js/main.js')}}"></script>
<script src="{{url('frontend/js/sweetalert.min.js')}}"></script>
<script src="{{url('frontend/js/lightgallery-all.min.js')}}"></script>
<script src="{{url('frontend/js/lightslider.js')}}"></script>
<!-- delete product in cart -->
<script type="text/javascript">
$(document).ready(function() {
    $('.fa-times').on('click', function() {
        var id = $(this).data('id');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{url('/del-to-product')}}",
            method: "POST",
            data: {
                _token: _token,
                id: id,
            },
            success: function(response) {
                $("#sid" + id).remove();
                $('#cal_cart').load('gio-hang-ajax #cal_cart');
            }
        });
    });
});
</script>

<!-- update quantity product in cart -->
<script type="text/javascript">
$(document).ready(function() {
    $('.cart_quantity').change(function() {
        var qty = $(this).val();
        var product_id = $(this).data('product_id');
        var product_exist = $('.product_exist_' + product_id).val();
        var text = $('#total' + product_id).text();
        var _token = $('meta[name="csrf-token"]').attr('content');
        if (parseInt(qty) > parseInt(product_exist)) {
            swal({
                title: "Thông báo",
                text: "Số lượng mua vượt quá số lượng trong kho, Vui lòng đặt lại!",
                button: "OK!",
            });
            $(this).val(1);
        } else {
            $.ajax({
                url: "{{url('/update-qty-ajax')}}",
                method: "POST",
                data: {
                    _token: _token,
                    qty: qty,
                    product_id: product_id
                },
                success: function(data) {
                    $('#total' + product_id).text(data);
                    $('#cal_cart').load('gio-hang-ajax #cal_cart');
                }
            });
        }

    });

    $('.check_out').click(function() {
        var coupon = $('input[name="coupon"]').val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{url('/coupon-ajax')}}",
            method: "POST",
            data: {
                _token: _token,
                coupon: coupon
            },
            success: function(data) {
                if (data) {
                    $('#cal_cart').load('gio-hang-ajax #cal_cart');
                    $('#error_coupon').html('<span class="text-danger">' + data +
                        '</span>');
                } else {
                    $('#cal_cart').load('gio-hang-ajax #cal_cart');
                    $('#error_coupon').html(
                        '<span class="text-success">Áp dụng mã giảm giá thành công!</span>'
                    );
                }


            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        thumbItem: 3,
        slideMargin: 0,
        enableDrag: false,
        currentPagerPosition: 'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }
    });
});
</script>

<!-- 
add cart ajax( in product detail ) -->
<script type="text/javascript">
$(document).ready(function() {
    $('.add-cart').on('click', function() {
        var id = $(this).data('product_id');
        var product_id = $('.product_id_' + id).val();
        var product_quantity = $('.product_quantity_' + id).val();
        var product_exist = $('.product_exist_' + id).val();
        var product_name = $('.product_name_' + id).val();
        var product_price = $('.product_price_' + id).val();
        var product_image = $('.product_image_' + id).val();
        var _token = $('input[name="_token"]').val();

        if (parseInt(product_quantity) > parseInt(product_exist)) {
            swal({
                title: "Thông báo",
                text: "Số lượng mua vượt quá số lượng trong kho, Vui lòng đặt lại!",
                button: "OK!",
            });
        } else {
            $.ajax({
                url: "{{url('/cart-product')}}",
                method: "POST",
                data: {
                    _token: _token,
                    product_id: product_id,
                    product_exist: product_exist,
                    product_quantity: product_quantity,
                    product_name: product_name,
                    product_price: product_price,
                    product_image: product_image
                },
                success: function() {
                    swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{url('/gio-hang-ajax')}}";
                        });
                }
            });
        }



    });
});
</script>


<!-- add order checkout -->
<script type="text/javascript">
$(document).ready(function() {
    $('.save-order').on('click', function() {
        swal({
                title: "Are you sure?",
                text: "Đơn hàng khi đã đặt sẽ không được hoàn trả!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Đồng ý đặt hàng!",
                cancelButtonText: "Hủy đặt hàng!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    var shipping_email = $('.shipping_email').val();
                    var shipping_name = $('.shipping_name').val();
                    var shipping_address = $('.shipping_address').val();
                    var shipping_phone = $('.shipping_phone').val();
                    var shipping_note = $('.shipping_note').val();
                    var payment = $('.payment_option').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('/order-place')}}",
                        method: "POST",
                        data: {
                            shipping_email: shipping_email,
                            shipping_name: shipping_name,
                            shipping_address: shipping_address,
                            shipping_phone: shipping_phone,
                            shipping_note: shipping_note,
                            payment: payment,
                            _token: _token
                        },
                        success: function() {
                            swal("Xác nhận đã đặt hàng!",
                                "Chúng tôi sẽ giao hàng trong thời gian sớm nhất.",
                                "success");
                        }
                    });
                    window.setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    swal("Đã hủy", "Bạn có thể suy nghĩ thật kĩ trước khi đặt hàng! :)", "error");
                }
            });
    });
});
</script>
</body>

</html>