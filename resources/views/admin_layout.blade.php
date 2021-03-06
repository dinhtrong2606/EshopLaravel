<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>DashBoard Eshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{url('backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/css/datatables.min.css')}}" />
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{url('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{url('backend/css/bootstrap-tagsinput.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{url('backend/css/style-responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{url('backend/css/font.css')}}" type="text/css" />
    <link href="{{url('backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('backend/css/morris.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{url('backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script type="text/javascript" src="{{url('js/app.js')}}"></script>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ Auth::user()->avatar }}">
                            <span class="username">{{ Auth::user()->name }}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li> <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{route('home')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @hasanyrole('Manage slider|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-picture-o"></i>
                                <span>Qu???n l?? slider</span>
                            </a>
                            <ul class="sub">
                                @can('Add Slider')
                                <li><a href="{{route('slider.create')}}">Th??m Slider</a></li>
                                @endcan
                                @can('List Slider')
                                <li><a href="{{route('slider.index')}}">Li???t k?? Slider</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Manage category|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Qu???n l?? danh m???c s???n ph???m</span>
                            </a>
                            <ul class="sub">
                                @can('Add Category')
                                <li><a href="{{route('category.create')}}">Th??m danh m???c</a></li>
                                @endcan
                                @can('List Category')
                                <li><a href="{{route('category.index')}}">Li???t k?? danh m???c</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Manage Catepost|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-gift"></i>
                                <span>Qu???n l?? danh m???c b??i vi???t</span>
                            </a>
                            <ul class="sub">
                                @can('Add Catepost')
                                <li><a href="{{route('catepost.create')}}">Th??m danh m???c b??i vi???t</a></li>
                                @endcan
                                @can('List Catepost')
                                <li><a href="{{route('catepost.index')}}">Li???t k?? danh m???c b??i vi???t</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Manage Post|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-gift"></i>
                                <span>Qu???n l?? b??i vi???t</span>
                            </a>
                            <ul class="sub">
                                @can('Add Post')
                                <li><a href="{{route('post.create')}}">Th??m b??i vi???t</a></li>
                                @endcan
                                @can('List Post')
                                <li><a href="{{route('post.index')}}">Li???t k?? b??i vi???t</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Manage brand|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-shield"></i>
                                <span>Qu???n l?? th????ng hi???u s???n ph???m</span>
                            </a>
                            <ul class="sub">
                                @can('Add Brand')
                                <li><a href="{{route('brand.create')}}">Th??m th????ng hi???u</a></li>
                                @endcan
                                @can('List Brand')
                                <li><a href="{{route('brand.index')}}">Li???t k?? th????ng hi???u</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Manage product|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>Qu???n l?? s???n ph???m</span>
                            </a>
                            <ul class="sub">
                                @can('Add Product')
                                <li><a href="{{route('product.create')}}">Th??m s???n ph???m</a></li>
                                @endcan
                                @can('List Product')
                                <li><a href="{{route('product.index')}}">Li???t k?? s???n ph???m</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Manage order|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-money"></i>
                                <span>????n h??ng</span>
                            </a>
                            <ul class="sub">
                                @can('List Order')
                                <li><a href="{{route('manage-order')}}">Li???t k?? ????n h??ng</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Manage coupon|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-gift"></i>
                                <span>M?? gi???m gi??</span>
                            </a>
                            <ul class="sub">
                                @can('Add Coupon')
                                <li><a href="{{route('coupon.create')}}">Th??m m?? gi???m gi??</a></li>
                                @endcan
                                @can('List Coupon')
                                <li><a href="{{route('coupon.index')}}">Li???t k?? m?? gi???m gi??</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endhasanyrole

                        @role('Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-gift"></i>
                                <span>User Admin</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{route('create_user')}}">Th??m User</a></li>
                                <li><a href="{{route('all_user')}}">Li???t k?? User</a></li>
                            </ul>
                        </li>
                        @endrole

                        @hasanyrole('Manage contact|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-phone"></i>
                                <span>Qu???n l?? contact</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{url('/contact-list')}}">Li???t k?? Contact</a></li>
                            </ul>
                        </li>
                        @endhasanyrole

                        @hasanyrole('Manage customer|Admin')
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-phone"></i>
                                <span>Qu???n l?? kh??ch h??ng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{url('/list-customer')}}">Li???t k?? kh??ch h??ng</a></li>
                            </ul>
                        </li>
                        @endhasanyrole
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!-- //market-->
                <div class="market-updates">
                    @yield('admin_content')
                </div>
                <!-- tasks -->
                <!-- //tasks -->
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>?? 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{url('backend/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/js/jquery.slimscroll.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/js/jquery.scrollTo.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/js/jquery.nicescroll.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/js/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/js/bootstrap-tagsinput.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/js/bootstrap-tagsinput-angular.js')}}"></script>
    <script src="{{url('backend/js/raphael-min.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/js/monthly.js')}}"></script>
    <script src="{{url('backend/js/bootstrap.js')}}"></script>
    <script src="{{url('backend/js/scripts.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <!-- morris JavaScript -->
    <!-- calendar -->
    <script type="text/javascript">
    $(window).load(function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
    </script>
    <!-- //calendar -->
</body>

</html>
<script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
CKEDITOR.replace('content_product');
CKEDITOR.replace('content_post');

$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>
<script>
$('.trangthai').change(function() {
    var status = $(this).val();
    var category_id = $(this).data('category_id');
    var _token = $('input[name="_token"]').val();
    var thongbao = '';
    if (status == 0) {
        var thongbao = 'B???n ???? hi???n th??? danh m???c th??nh c??ng';
    } else {
        var thongbao = 'B???n ???? ???n danh m???c th??nh c??ng';
    }
    $.ajax({
        url: "{{url('/trang-thai')}}",
        method: "POST",
        data: {
            status: status,
            category_id: category_id,
            _token: _token
        },
        success: function(data) {
            alert(thongbao);
        }
    });
});
</script>
<script>
$('.thuonghieu').change(function() {
    var status = $(this).val();
    var brand_id = $(this).data('brand_id');
    var _token = $('input[name="_token"]').val();
    var thongbao = '';
    if (status == 0) {
        var thongbao = 'B???n ???? hi???n th??? th????ng hi???u th??nh c??ng';
    } else {
        var thongbao = 'B???n ???? ???n th????ng hi???u th??nh c??ng';
    }
    $.ajax({
        url: "{{url('/thuong-hieu')}}",
        method: "POST",
        data: {
            status: status,
            brand_id: brand_id,
            _token: _token
        },
        success: function(data) {
            alert(thongbao);
        }
    });
});
</script>
<script>
$('.sanpham').change(function() {
    var status = $(this).val();
    var product_id = $(this).data('product_id');
    var _token = $('input[name="_token"]').val();
    var thongbao = '';
    if (status == 0) {
        var thongbao = 'B???n ???? hi???n th??? s???n ph???m th??nh c??ng';
    } else {
        var thongbao = 'B???n ???? ???n s???n ph???m th??nh c??ng';
    }
    $.ajax({
        url: "{{url('/san-pham')}}",
        method: "POST",
        data: {
            status: status,
            product_id: product_id,
            _token: _token
        },
        success: function(data) {
            alert(thongbao);
        }
    });
});
</script>
<script>
$('.slider').change(function() {
    var status = $(this).val();
    var slider_id = $(this).data('slider_id');
    var _token = $('input[name="_token"]').val();
    var thongbao = '';
    if (status == 0) {
        var thongbao = 'B???n ???? hi???n th??? slider th??nh c??ng';
    } else {
        var thongbao = 'B???n ???? ???n slider th??nh c??ng';
    }
    $.ajax({
        url: "{{url('/slider-status')}}",
        method: "POST",
        data: {
            status: status,
            slider_id: slider_id,
            _token: _token
        },
        success: function(data) {
            alert(thongbao);
        }
    });
});
</script>
<script>
$('.catepost').change(function() {
    var status = $(this).val();
    var cate_post_id = $(this).data('cate_post_id');
    var _token = $('input[name="_token"]').val();
    var thongbao = '';
    if (status == 0) {
        var thongbao = 'B???n ???? hi???n th??? hi???n th??? danh m???c b??i vi???t th??nh c??ng';
    } else {
        var thongbao = 'B???n ???? ???n danh m???c b??i vi???t';
    }
    $.ajax({
        url: "{{url('/cate-post')}}",
        method: "POST",
        data: {
            status: status,
            cate_post_id: cate_post_id,
            _token: _token
        },
        success: function(data) {
            alert(thongbao);
        }
    });
});
</script>
<script>
$('.post').change(function() {
    var status = $(this).val();
    var post_id = $(this).data('post_id');
    var _token = $('input[name="_token"]').val();
    var thongbao = '';
    if (status == 0) {
        var thongbao = 'B???n ???? hi???n th??? hi???n th??? b??i vi???t th??nh c??ng';
    } else {
        var thongbao = 'B???n ???? ???n b??i vi???t';
    }
    $.ajax({
        url: "{{url('/post-status')}}",
        method: "POST",
        data: {
            status: status,
            post_id: post_id,
            _token: _token
        },
        success: function(data) {
            alert(thongbao);
        }
    });
});
</script>
<script>
$('.order_status').change(function() {
    var order_status = $(this).val();
    var order_id = $(this).data('order_id');
    var _token = $('input[name="_token"]').val();
    //lay ra so luong
    quantity = [];
    $("input[name='product_sales_quantity']").each(function() {
        quantity.push($(this).val());
    });

    product_id = [];
    $("input[name='product_id']").each(function() {
        product_id.push($(this).val());
    });

    for (i = 0; i < product_id.length; i++) {
        // so luong ban
        var quantity_sales = $('.product_sales_quantity_' + product_id[i]).val();
        // so luong ton kho san pham
        var product_exist = $('.product_exist_' + product_id[i]).val();

        var j = 0;
        if (parseInt(quantity_sales) > parseInt(product_exist)) {
            j = j + 1;
            alert('S??? l?????ng s???n ph???m trong kho hi???n kh??ng ????? !');
            $('.color_qty_' + product_id[i]).css('background', '#db4132');
        }
    }

    if (order_status == 0) {
        var thongbao = '????n h??ng ch??a ???????c x??? l??';
    } else {
        var thongbao = '????n h??ng ???? ???????c x??? l?? | Chu???n b??? giao h??ng';
    }
    if (j == 0) {
        $.ajax({
            url: "{{url('/done-order')}}",
            method: "POST",
            data: {
                order_status: order_status,
                order_id: order_id,
                quantity: quantity,
                product_id: product_id,
                _token: _token
            },
            success: function(data) {
                alert(thongbao);
                location.reload();
            }
        });

    }
});
</script>
<script type="text/javascript">
function ChangeToSlug() {
    var slug;

    //L???y text t??? th??? input title
    slug = document.getElementById("slug").value;
    slug = slug.toLowerCase();
    //?????i k?? t??? c?? d???u th??nh kh??ng d???u
    slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
    slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
    slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
    slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
    slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
    slug = slug.replace(/??|???|???|???|???/gi, 'y');
    slug = slug.replace(/??/gi, 'd');
    //X??a c??c k?? t??? ?????t bi???t
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
    slug = slug.replace(/ /gi, "-");
    //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
    //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
    slug = '@ ' + slug + '@ ';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox c?? id ???slug???
    document.getElementById('convert_slug').value = slug;
}
</script>