@include('pages.header')

@include('pages.slider')

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

<script>
$(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        thumbItem: 9,
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

<script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '.add-to-cart', function() {
        var id = $(this).data('id');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_exist = $('.cart_product_exist_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{url('/add-cart-ajax')}}",
            method: "POST",
            data: {
                cart_product_id: cart_product_id,
                cart_product_name: cart_product_name,
                cart_product_price: cart_product_price,
                cart_product_qty: cart_product_qty,
                cart_product_image: cart_product_image,
                cart_product_exist: cart_product_exist,
                _token: _token
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
    });
});
</script>


</body>

</html>