<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Male-Fashion | Template</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{url('frontend/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/slicknav.min.css')}}" type="text/css">
    <link type="text/css" href="{{url('frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link type="text/css" href="{{url('frontend/css/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/comment.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/lightslider.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('frontend/css/lightgallery.min.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="{{route('login-customer')}}">Sign in</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a>
            <a href="#"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a>
            <a href="#"><img src="{{url('frontend/images/icon/cart.png')}}" alt=""> <span></span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                @if(session()->has('customer_id'))
                                <a href="{{url('/logout-account')}}">Logout</a>
                                @else
                                <a href="{{route('login-customer')}}">Login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="{{route('trang-chu')}}"><img src="{{url('frontend/images/icon/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="{{ route('trang-chu') }}">Home</a></li>
                            <li><a href="{{ route('shop-detail') }}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/shop-detail') }}">Shop Details</a></li>
                                    <li><a href="{{ url('/gio-hang-ajax') }}">Shopping Cart</a></li>
                                    <li><a href="{{ url('/blog-list') }}">Blog List</a></li>
                                    <li><a href="{{ url('contact-page') }}">Contact</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('/blog-list')}}">Blog</a></li>
                            <li><a href="{{url('contact-page')}}">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a class="number-product-wishlist" href="{{url('/wishlist-product')}}"><img src="{{url('frontend/images/icon/heart.png')}}" alt="">
                            @if(session('product_wishlist'))
                            <span style="margin: -15px 9px;background-color: red;color: white" class="badge badge-warning" id="lblCartCount">{{count(session('product_wishlist'))}}</span>
                            @else
                            <span  class="badge badge-warning" id="lblCartCount"></span>
                            @endif
                        </a>
                        <a class="number-product-cart" href="{{route('gio-hang')}}"><img src="{{url('frontend/images/icon/cart.png')}}" alt="">
                            @if(session('cart'))
                            <span style="margin: -15px 9px;background-color: red;color: white" class="badge badge-warning" id="lblCartCount">{{count(session('cart'))}}</span>
                            @else
                            <span  class="badge badge-warning" id="lblCartCount"></span>
                            @endif
                        </a>    
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->