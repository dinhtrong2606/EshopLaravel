@include('pages.header')

@yield('main_content')

@include('pages.footer')

<script>
    $(document).ready(function() {

        $(document).on('click', 'input[type="checkbox"]', function() {      
            $('input[type="checkbox"]').not(this).prop('checked', false);      
        });

        //add to cart ajax
        $(document).on('click', '.add-to-cart', function() {
            var cart_product_id = $(this).data('product_id');
            var cart_product_name = $(this).data('product_name');
            var cart_product_price = $(this).data('product_price');
            var cart_product_image = $(this).data('product_image');
            var cart_product_exist = $(this).data('product_exist');
            var cart_product_qty = $(this).data('product_qty');
            var cart_product_size = $(this).data('product_size');
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
                    cart_product_size: cart_product_size,
                    _token: _token
                },

                success: function() {
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Add to cart sucessfully!',
                    width: 400,
                    showConfirmButton: false,
                    timer: 1500
                    })
                    $('.number-product-cart').load('/ .number-product-cart');
                    $('.number-product-cart').load('shop-detail .number-product-cart');
                }
            });
        });

        //add product recently viewed
        $("body").on("click", ".product-detail", function(){
            var product_id = $(this).data('product_id');
            var product_name = $(this).data('product_name');
            var product_price = $(this).data('product_price');
            var product_image = $(this).data('product_image');
            var product_exist = $(this).data('product_exist');
            var product_qty = $(this).data('product_qty');
            var product_size = $(this).data('product_size');
            var product_slug = $(this).data('product_slug');
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('/add-product-viewed')}}",
                method: "POST",
                data: {
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    product_qty: product_qty,
                    product_image: product_image,
                    product_exist: product_exist,
                    product_size: product_size,
                    product_slug: product_slug,
                    _token: _token
                },
                success: function() {
                    window.location.href = `{{URL::to('/detail-product/${product_slug}')}}`;
                }
            });
        });

        //add product wishlist
        $("body").on("click", ".product-wishlist", function(){
            var product_id = $(this).data('product_id');
            var product_name = $(this).data('product_name');
            var product_price = $(this).data('product_price');
            var product_image = $(this).data('product_image');
            var product_exist = $(this).data('product_exist');
            var product_qty = $(this).data('product_qty');
            var product_size = $(this).data('product_size');
            var product_slug = $(this).data('product_slug');
            var product_sold = $(this).data('product_sold');
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('/add-product-wishlist')}}",
                method: "POST",
                data: {
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    product_qty: product_qty,
                    product_image: product_image,
                    product_exist: product_exist,
                    product_size: product_size,
                    product_sold: product_sold,
                    product_slug: product_slug,
                    _token: _token
                },
                success: function() {
                    Swal.fire({
                        title: 'Sản phẩm đã được thêm vào danh sách yêu thích :D',
                        width: 600,
                        padding: '3em',
                        color: '#716add',
                        background: '#fff url(https://sweetalert2.github.io/images/trees.png)',
                        backdrop: `
                            rgba(0,0,123,0.4)
                            url("https://sweetalert2.github.io/images/nyan-cat.gif")
                            left top
                            no-repeat
                        `
                    })
                }
            });
        });

        //add comment product
        $("body").on("click", ".btn-comment", function(){
            var name = $('input[name="comment_name"]').val();
            var email = $('input[name="comment_email"]').val();
            var comment_content = $('textarea[name="comment_content"]').val();
            var product_id = $('input[name="product_id"]').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('/add-comment-product')}}",
                method: "POST",
                data: {
                    name: name,
                    email: email,
                    comment_content: comment_content,
                    product_id: product_id,
                    _token: _token
                },
            success: function(response) {
                $('#comment-list').append(response['htmlComment']);
                $('#number-comment').empty().append(response['number_comment']);
                $('#number-comment2').empty().append(response['number_comment']);
                $('input[name="comment_name"]').val("");
                $('input[name="comment_email"]').val("");
                $('textarea[name="comment_content"]').val("");
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Đã add bình luận thành công!',
                    showConfirmButton: false,
                    timer: 1500
                    })   
                }
            });
        });

        //edit comment
        $("body").on("click", ".edit-comment", function(){
            var comment_id = $(this).data('comment_id');
            $('.comment-content'+comment_id).find('#comment_content'+comment_id).removeClass('comment_content');
            $('.comment-content'+comment_id).find('#comment_content'+comment_id).focus();
            $('#comment_content'+comment_id).keypress(function(e){
                if(e.keyCode === 13){
                    var comment_content = $('#comment_content'+comment_id).val();
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{url('/edit-comment-product')}}",
                        method: "POST",
                        data: {
                            comment_content: comment_content,
                            comment_id: comment_id,
                            _token: _token,
                        },
                        success: function(response) {
                            let html = `<input class="form-control form-control-lg comment_content" type="text" 
                                        id="comment_content${comment_id}" name="comment_content" value="${response['comment_content']}">`;
                            $('.comment-content'+comment_id).empty().append(html);
                            $('.time-comment'+comment_id).empty().append(response['updated_at']);
                        }
                    });
                }
            });
        });

        //delete comment
        $("body").on("click", ".delete-comment", function(){
            var comment_id = $(this).data('comment_id');
            var product_id = $('input[name="product_id"]').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{url('/delete-comment-product')}}",
                        method: "POST",
                        data: {
                            comment_id: comment_id,
                            product_id: product_id,
                            _token: _token,
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your comment has been deleted.',
                                'success'
                            )
                            $('.comment'+comment_id).remove();
                            $('#number-comment').empty().append(response['number_comment']);
                            $('#number-comment2').empty().append(response['number_comment']);
                        }
                    });
                }
            })
        });  

        //add to cart detail product page
        $('.add-to-cart-detail').on('click', function(){
            var cart_product_id = $(this).data('product_id');
            var cart_product_name = $(this).data('product_name');
            var cart_product_price = $(this).data('product_price');
            var cart_product_image = $(this).data('product_image');
            var cart_product_exist = $(this).data('product_exist');
            var cart_product_qty = $('input[name="product_qty"]').val();
            var cart_product_size = $("input[name='product_size']:checked").val() ? $("input[name='product_size']:checked").val() : 's';
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
                    cart_product_size: cart_product_size,
                    _token: _token
                },

                success: function() {
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Add to cart sucessfully!',
                    width: 400,
                    showConfirmButton: false,
                    timer: 1500
                    })
                    $('.number-product-cart').load('/ .number-product-cart');
                    $('.number-product-cart').load('shop-detail .number-product-cart');
                }
            });
        });

        /*-------------------
		Add contact ajax
	    --------------------- */
        $('.btn-contact').on('click', function(){
            var contact_name = $('input[name="contact_name"]').val();
            var contact_email = $('input[name="contact_email"]').val();
            var contact_content = $('#contact_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/store-contact')}}",
                method: "POST",
                data: {
                    contact_name: contact_name,
                    contact_email: contact_email,
                    contact_content: contact_content,
                    _token: _token
                },
                success: function(res) {
                    if(res.status == 200){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Add contact sucessfully!',
                            width: 400,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('input[name="contact_name"]').val("");
                        $('input[name="contact_email"]').val("");
                        $('#contact_content').val("");
                    }else{
                        //console.log error
                    }
                }
            });
        });

        /*-------------------
		Quantity change cart ajax
	    --------------------- */
        $('.cart_quantity').change(function() {
        var qty = $(this).val();
        var product_id = $(this).data('product_id');
        var product_exist = $('.product_exist_' + product_id).val();
        var text = $('#total' + product_id).text();
        var product_price = $('.product_price_' + product_id).val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        if (parseInt(qty) > parseInt(product_exist)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Số lượng đặt vượt quá số lượng sản phẩm trong kho!',
                footer: '<a href="">Vui lòng đặt lại số lượng sản phẩm :D</a>'
            });
            $(this).val(1);
            $('#total' + product_id).text(product_price+' '+'vnd');
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
                    $('#total' + product_id).text(data+' '+'vnd');
                    $('#cal_cart').load('gio-hang-ajax #cal_cart');
                }
            });
        }
    });

        /*-------------------
		Apply coupon product ajax
	    --------------------- */
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
                        $('input[name="coupon"]').val(coupon);
                        $('#cal_cart').load('gio-hang-ajax #cal_cart');
                        $('#error_coupon').html('<span class="text-danger">' + data +
                            '</span>');
                    } else {
                        $('input[name="coupon"]').val(coupon);
                        $('#cal_cart').load('gio-hang-ajax #cal_cart');
                        $('#error_coupon').html(
                            '<span class="text-success">Áp dụng mã giảm giá thành công!</span>'
                        );
                    }
                }
            });
        });

        /*-------------------
		Delete product ajax 
	    --------------------- */
        $('.btn-delete').on('click', function() {
            var id = $(this).data('product_id');
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
                $('.number-product-cart').load('gio-hang-ajax .number-product-cart');
                checkCartEmpty();
                $('#cal_cart').load('gio-hang-ajax #cal_cart');
            }
        });
    });

        /*-------------------
            Save order ajax 
        --------------------- */
        $('.save-order').on('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Đơn hàng khi được đặt sẽ không được hủy!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I"m sure!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var shipping_email = $('.shipping_email').val();
                    var shipping_name = $('.shipping_name').val();
                    var shipping_address = $('.shipping_address').val();
                    var shipping_phone = $('.shipping_phone').val();
                    var shipping_note = $('.shipping_note').val();
                    var payment = $('input[name="payment_option"]:checked').val();
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
                            let timerInterval
                            Swal.fire({
                            title: 'Đơn hàng đang chờ xác nhận!',
                            html: 'Xác nhận trong <b></b> milliseconds.',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                            }).then((result) => {
                                window.location.href = "{{URL::to('/checkout-success')}}";
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                            }
                            })
                        }
                    });
                }
            })
        });

        //destroy order
        $('.btn-destroy-order').on('click', function(){
            var _token = $('meta[name="csrf-token"]').attr('content');
            var order_id = $('input[name="order_id"]').val();
            Swal.fire({
                title: 'Are you sure?',
                text: "Bạn có thực sự muốn hủy đơn hàng này không!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        url: "{{url('/destroy-order')}}",
                        method: "POST",
                        data: {
                            order_id: order_id,
                            _token: _token,
                        },
                        success: function(res) {
                            if(res.status == 200){
                                location.reload();
                            }else{
                                //error
                            }
                        }
                    });
                }
            })
        });

        $('#search').keyup(function() {
            var _token = $('meta[name="csrf-token"]').attr('content');
            var text = $('#search').val();
            $.ajax({
                url: "{{url('/search-complete')}}",
                method: "POST",
                data: {
                    text: text,
                    _token: _token
                },
                success: function(data) {
                    var html = '';
                    $.each( data, function( key, value ) {
                        var product_image = value.product_image ? value.product_image : '';
                        var product_name = value.product_name ? value.product_name : '';
                        var product_price = value.product_price ? formatNumber(value.product_price) : '';
                        var product_exist = value.product_exist ? value.product_exist : '';
                        var product_id = value.product_id ? value.product_id : '';
                        var product_slug = value.slugproduct ? value.slugproduct : '';
                        var product_sold = value.product_sold ? value.product_sold : '';
                        html += `
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/${product_image}')}}"
                                style="background-image: url('{{url('uploads/gallevy/${product_image}')}}');">
                                    <ul class="product__hover">
                                        <li><a class="product-wishlist" data-product_id="${product_id}" data-product_name="${product_name}"
                                        data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                        data-product_image="${product_image}" data-product_qty="1" data-product_size="s" data-product_sold="${product_sold}"
                                        data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                        <li><a class="product-detail" data-product_id="${product_id}" data-product_name="${product_name}"
                                        data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                        data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                        data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>${product_name} | Đã bán: ${product_sold}</h6>`;
                                    if(product_exist == 0){
                                        html += `<a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>`;
                                    }else{
                                        html += `
                                        <form>
                                            @csrf
                                            <a data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                            name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                                        </form>
                                        `;
                                    }
                                    html += `
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>${product_price} vnđ</h5>
                                </div>
                            </div>
                        </div>
                        `;
                    });
                    $('#no-result').empty().html('<p>Showing 1–12 of 126 results</p>');
                    $('#filter-product').empty().append(html);
                }
            });
        });

        //filter category
        $('.category').on('click', function(){
            var category_id = $(this).data('category_id');
            var category_nm = $(this).data('category_nm');
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('/filter-product-category')}}",
                method: "POST",
                data: {
                    category_id: category_id,
                    _token: _token
                },
                success: function(data) {
                    if(data.length > 0){
                        var html = '';
                        $.each( data, function( key, value ) {
                            var product_image = value.product_image ? value.product_image : '';
                            var product_name = value.product_name ? value.product_name : '';
                            var product_price = value.product_price ? formatNumber(value.product_price) : '';
                            var product_exist = value.product_exist ? value.product_exist : '';
                            var product_id = value.product_id ? value.product_id : '';
                            var product_slug = value.slugproduct ? value.slugproduct : '';
                            var product_sold = value.product_sold ? value.product_sold : '';
                            html += `
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/${product_image}')}}"
                                    style="background-image: url('{{url('uploads/gallevy/${product_image}')}}');">
                                        <ul class="product__hover">
                                            <li><a class="product-wishlist" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s" data-product_sold="${product_sold}"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                            <li><a class="product-detail" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>${product_name} | Đã bán: ${product_sold}</h6>`;
                                        if(product_exist == 0){
                                            html += `<a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>`;
                                        }else{
                                            html += `
                                            <form>
                                                @csrf
                                                <a data-product_id="${product_id}" data-product_name="${product_name}"
                                                data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                                data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                                            </form>`;
                                        }
                                        html += `
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>${product_price} vnđ</h5>
                                    </div>
                                </div>
                            </div>
                            `;
                        });
                        $('#no-result').empty().html('<p>Showing 1–12 of 126 results</p>');
                        $('#filter-product').empty().append(html);
                    }else{
                        var noResult = `<p style="color: red"><i>Không có kết quả cho sản phẩm thuộc category <b>${category_nm}</b></i></p>`;
                        $('#no-result').empty().append(noResult);
                        $('#filter-product').empty();
                    }
                }
            });
        });

        //filter brand
        $('.brand').on('click', function(){
            var brand_id = $(this).data('brand_id');
            var brand_nm = $(this).data('brand_nm');
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('/filter-product-brand')}}",
                method: "POST",
                data: {
                    brand_id: brand_id,
                    _token: _token
                },
                success: function(data) {
                    if(data.length > 0){
                        var html = '';
                        $.each( data, function( key, value ) {
                            var product_image = value.product_image ? value.product_image : '';
                            var product_name = value.product_name ? value.product_name : '';
                            var product_price = value.product_price ? formatNumber(value.product_price) : '';
                            var product_exist = value.product_exist ? value.product_exist : '';
                            var product_id = value.product_id ? value.product_id : '';
                            var product_slug = value.slugproduct ? value.slugproduct : '';
                            var product_sold = value.product_sold ? value.product_sold : '';
                            html += `
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/${product_image}')}}"
                                    style="background-image: url('{{url('uploads/gallevy/${product_image}')}}');">
                                        <ul class="product__hover">
                                            <li><a class="product-wishlist" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s" data-product_sold="${product_sold}"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                            <li><a class="product-detail" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>${product_name} | Đã bán: ${product_sold}</h6>`;
                                        if(product_exist == 0){
                                            html += `<a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>`;
                                        }else{
                                            html += `
                                            <form>
                                                @csrf
                                                <a data-product_id="${product_id}" data-product_name="${product_name}"
                                                data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                                data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                                            </form>
                                            `;
                                        }
                                        html += `
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>${product_price} vnđ</h5>
                                    </div>
                                </div>
                            </div>
                            `;
                        });
                        $('#no-result').empty().html('<p>Showing 1–12 of 126 results</p>');
                        $('#filter-product').empty().append(html);
                    }else{
                        var noResult = `<p style="color: red"><i>Không có kết quả cho sản phẩm thuộc brand <b>${brand_nm}</b></i></p>`;
                        $('#no-result').empty().append(noResult);
                        $('#filter-product').empty();
                    }
                }
            });
        });

        //filter price
        $('.filter-price').on('click', function(){
            var filter_price = $(this).data('filter_price');
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('/filter-product-price')}}",
                method: "POST",
                data: {
                    filter_price: filter_price,
                    _token: _token
                },
                success: function(data) {
                    if(data.length > 0){
                        var html = '';
                        $.each( data, function( key, value ) {
                            var product_image = value.product_image ? value.product_image : '';
                            var product_name = value.product_name ? value.product_name : '';
                            var product_price = value.product_price ? formatNumber(value.product_price) : '';
                            var product_exist = value.product_exist ? value.product_exist : '';
                            var product_id = value.product_id ? value.product_id : '';
                            var product_slug = value.slugproduct ? value.slugproduct : '';
                            var product_sold = value.product_sold ? value.product_sold : '';
                            html += `
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/${product_image}')}}"
                                    style="background-image: url('{{url('uploads/gallevy/${product_image}')}}');">
                                        <ul class="product__hover">
                                            <li><a class="product-wishlist" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s" data-product_sold="${product_sold}"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                            <li><a class="product-detail" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>${product_name} | Đã bán: ${product_sold}</h6>`;
                                        if(product_exist == 0){
                                            html += `<a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>`;
                                        }else{
                                            html += `
                                            <form>
                                                @csrf
                                                <a data-product_id="${product_id}" data-product_name="${product_name}"
                                                data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                                data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                                            </form>
                                            `;
                                        }
                                        html += `
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>${product_price} vnđ</h5>
                                    </div>
                                </div>
                            </div>
                            `;
                        });
                        $('#no-result').empty().html('<p>Showing 1–12 of 126 results</p>');
                        $('#filter-product').empty().append(html);
                    }else{
                        if(filter_price == 1){
                            var noResult = `<p style="color: red"><i>Không có kết quả cho sản phẩm thuộc trong khoảng từ <b>0 - 500.000</b></i></p>`;
                        }else if(filter_price == 2){
                            var noResult = `<p style="color: red"><i>Không có kết quả cho sản phẩm thuộc trong khoảng từ <b>500.000 - 2000.000</b></i></p>`;
                        }else if(filter_price == 3){
                            var noResult = `<p style="color: red"><i>Không có kết quả cho sản phẩm thuộc trong khoảng từ <b>2000.000  - 5000.000</b></i></p>`;
                        }else if(filter_price == 4){
                            var noResult = `<p style="color: red"><i>Không có kết quả cho sản phẩm thuộc trong khoảng từ <b>5000.000 - 10.000.000</b></i></p>`;
                        }else{
                            var noResult = `<p style="color: red"><i>Không có kết quả cho sản phẩm thuộc trong khoảng từ <b>10.000.000+</b></i></p>`;
                        }
                        
                        $('#no-result').empty().append(noResult);
                        $('#filter-product').empty();
                    }
                }
            });
        });

        //see more product
        $("body").on("click", ".see-more", function(){
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('/see-more-product')}}",
                method: "POST",
                data: {
                    _token: _token
                },
                success: function(res) {
                    if(res.data.length > 0){
                        var html = '';
                        $.each( res.data, function( key, value ) {
                            var product_image = value.product_image ? value.product_image : '';
                            var product_name = value.product_name ? value.product_name : '';
                            var product_price = value.product_price ? formatNumber(value.product_price) : '';
                            var product_exist = value.product_exist ? value.product_exist : '';
                            var product_id = value.product_id ? value.product_id : '';
                            var product_slug = value.slugproduct ? value.slugproduct : '';
                            var product_sold = value.product_sold ? value.product_sold : '';
                            html += `
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/${product_image}')}}"
                                    style="background-image: url('{{url('uploads/gallevy/${product_image}')}}');">
                                        <ul class="product__hover">
                                            <li><a class="product-wishlist" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s" data-product_sold="${product_sold}"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                            <li><a class="product-detail" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>${product_name} | Đã bán: ${product_sold}</h6>`;
                                        if(product_exist == 0){
                                            html += `<a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>`;
                                        }else{
                                            html += `
                                            <form>
                                                @csrf
                                                <a data-product_id="${product_id}" data-product_name="${product_name}"
                                                data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                                data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                                            </form>
                                            `;
                                        }
                                        html += `
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>${product_price} vnđ</h5>
                                    </div>
                                </div>
                            </div>
                            `;
                        });
                        $('#no-result').empty().html('<p>Showing 1–12 of 126 results</p>');
                        var seeLess = '<button type="button" class="see-less" id="toggle">See Less</button>';
                        $('.btn-container').empty().append(seeLess);
                        $('#filter-product').empty().append(html);
                    }
                }
            });
        });

        //see less product
        $("body").on("click", ".see-less", function(){
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{url('/see-less-product')}}",
                method: "POST",
                data: {
                    _token: _token
                },
                success: function(res) {
                    if(res.data.length > 0){
                        var html = '';
                        $.each( res.data, function( key, value ) {
                            var product_image = value.product_image ? value.product_image : '';
                            var product_name = value.product_name ? value.product_name : '';
                            var product_price = value.product_price ? formatNumber(value.product_price) : '';
                            var product_exist = value.product_exist ? value.product_exist : '';
                            var product_id = value.product_id ? value.product_id : '';
                            var product_slug = value.slugproduct ? value.slugproduct : '';
                            var product_sold = value.product_sold ? value.product_sold : '';
                            html += `
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/${product_image}')}}"
                                    style="background-image: url('{{url('uploads/gallevy/${product_image}')}}');">
                                        <ul class="product__hover">
                                            <li><a class="product-wishlist" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s" data-product_sold="${product_sold}"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                            <li><a class="product-detail" data-product_id="${product_id}" data-product_name="${product_name}"
                                            data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                            data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                            data-product_slug="${product_slug}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>${product_name} | Đã bán: ${product_sold}</h6>`;
                                        if(product_exist == 0){
                                            html += `<a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>`;
                                        }else{
                                            html += `
                                            <form>
                                                @csrf
                                                <a data-product_id="${product_id}" data-product_name="${product_name}"
                                                data-product_price="${value.product_price}" data-product_exist="${product_exist}"
                                                data-product_image="${product_image}" data-product_qty="1" data-product_size="s"
                                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                                            </form>
                                            `;
                                        }
                                        html += `
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>${product_price} vnđ</h5>
                                    </div>
                                </div>
                            </div>
                            `;
                        });
                        $('#no-result').empty().html('<p>Showing 1–12 of 126 results</p>');
                        var seeLess = '<button type="button" class="see-more" id="toggle">See More</button>';
                        $('.btn-container').empty().append(seeLess);
                        $('#filter-product').empty().append(html);
                    }
                }
            });
        });
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function checkCartEmpty(){
        var count = $(".cart-number").length;
        if(count == 0){
            $('#update_cart').empty().append(`
            <div class="cart-null" style="text-align: center;margin-left: 45%">
                <img width="200" height="200" src="{{asset('frontend/images/icon/icon_funny.jpg')}}" alt="" />
                <p>Giỏ hàng của bạn còn trống</p>
                <a href="{{url('/shop-detail')}}" class="btn btn-danger">MUA NGAY</a>
            </div>
            `);
        }
    }
</script>


