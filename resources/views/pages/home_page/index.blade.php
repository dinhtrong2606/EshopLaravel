@extends('layout')
@section('main_content')
<!-- Hero Section Begin -->
    <section class="hero">
        @foreach($sliders as $slider)
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="{{url('uploads/slider/' . $slider->slider_image)}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>{{ $slider->slider_name }}</h6>
                                <h2>{{ $slider->slider_script }}</h2>
                                <p>{{ $slider->slider_desc }}</p>
                                <a href="{{url('shop-detail')}}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Hero Section End -->
    
    <!-- Product Section Begin -->
    <section class="product spad mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter=".best-sellers">Best Sellers</li>
                        <li class="new-arrival" data-filter=".new-arrivals">New Arrivals</li>
                        <li class="hot-sale" data-filter=".hot-sales">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
            @foreach($product_best_sellers as $key => $product_best_seller)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix best-sellers">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/'.$product_best_seller->product_image)}}">
                            @if($product_best_seller->product_exist !== 0)
                            <span class="label">Best Sellers</span>
                            @else
                            <span class="label" style="color: red">Out of stock</span>
                            @endif
                            <ul class="product__hover">
                                <li><a class="product-wishlist" data-product_id="{{$product_best_seller->product_id}}" data-product_name="{{$product_best_seller->product_name}}"
                                data-product_price="{{$product_best_seller->product_price}}" data-product_exist="{{$product_best_seller->product_exist}}"
                                data-product_image="{{$product_best_seller->product_image}}" data-product_qty="1" data-product_size="s" data-product_sold="{{$product_best_seller->product_sold}}"
                                data-product_slug="{{$product_best_seller->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                <li><a class="product-detail" data-product_id="{{$product_best_seller->product_id}}" data-product_name="{{$product_best_seller->product_name}}"
                                data-product_price="{{$product_best_seller->product_price}}" data-product_exist="{{$product_best_seller->product_exist}}"
                                data-product_image="{{$product_best_seller->product_image}}" data-product_qty="1" data-product_size="s"
                                data-product_slug="{{$product_best_seller->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product_best_seller->product_name}} | Đã bán: {{$product_best_seller->product_sold}}</h6>
                            @if($product_best_seller->product_exist !== 0)
                            <form>
                                @csrf
                                <a data-product_id="{{$product_best_seller->product_id}}" data-product_name="{{$product_best_seller->product_name}}"
                                data-product_price="{{$product_best_seller->product_price}}" data-product_exist="{{$product_best_seller->product_exist}}"
                                data-product_image="{{$product_best_seller->product_image}}" data-product_qty="1" data-product_size="s" 
                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                            </form>
                            @else
                                <a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>
                            @endif
                            <div class="rating"></div>
                            <h5>{{number_format($product_best_seller->product_price). ' vnđ'}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($product_new_arrivals as $key => $product_new_arrival)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals d-none">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/'.$product_new_arrival->product_image)}}">
                            @if($product_new_arrival->product_exist !== 0)
                            <span class="label">New Arrivals</span>
                            @else
                            <span class="label" style="color: red">Out of stock</span>
                            @endif
                            <ul class="product__hover">
                                <li><a class="product-wishlist" data-product_id="{{$product_new_arrival->product_id}}" data-product_name="{{$product_new_arrival->product_name}}"
                                data-product_price="{{$product_new_arrival->product_price}}" data-product_exist="{{$product_new_arrival->product_exist}}"
                                data-product_image="{{$product_new_arrival->product_image}}" data-product_qty="1" data-product_size="s" data-product_sold="{{$product_new_arrival->product_sold}}"
                                data-product_slug="{{$product_new_arrival->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                <li><a class="product-detail" data-product_id="{{$product_new_arrival->product_id}}" data-product_name="{{$product_new_arrival->product_name}}"
                                data-product_price="{{$product_new_arrival->product_price}}" data-product_exist="{{$product_new_arrival->product_exist}}"
                                data-product_image="{{$product_new_arrival->product_image}}" data-product_qty="1" data-product_size="s"
                                data-product_slug="{{$product_new_arrival->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product_new_arrival->product_name}} | Đã bán: {{$product_new_arrival->product_sold}}</h6>
                            @if($product_new_arrival->product_exist !== 0)
                            <form>
                                @csrf
                                <a data-product_id="{{$product_new_arrival->product_id}}" data-product_name="{{$product_new_arrival->product_name}}"
                                data-product_price="{{$product_new_arrival->product_price}}" data-product_exist="{{$product_new_arrival->product_exist}}"
                                data-product_image="{{$product_new_arrival->product_image}}" data-product_qty="1" data-product_size="s"
                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                            </form>
                            @else
                                <a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>
                            @endif
                            <div class="rating"></div>
                            <h5>{{number_format($product_new_arrival->product_price). ' vnđ'}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($product_hot_sales as $key => $product_hot_sale)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales d-none">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/'. $product_hot_sale->product_image)}}">
                            <ul class="product__hover">
                                <li><a class="product-wishlist" data-product_id="{{$product_hot_sale->product_id}}" data-product_name="{{$product_hot_sale->product_name}}"
                                data-product_price="{{$product_hot_sale->product_price}}" data-product_exist="{{$product_hot_sale->product_exist}}"
                                data-product_image="{{$product_hot_sale->product_image}}" data-product_qty="1" data-product_size="s" data-product_sold="{{$product_hot_sale->product_sold}}"
                                data-product_slug="{{$product_hot_sale->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                <li><a class="product-detail" data-product_id="{{$product_hot_sale->product_id}}" data-product_name="{{$product_hot_sale->product_name}}"
                                data-product_price="{{$product_hot_sale->product_price}}" data-product_exist="{{$product_hot_sale->product_exist}}"
                                data-product_image="{{$product_hot_sale->product_image}}" data-product_qty="1" data-product_size="s"
                                data-product_slug="{{$product_hot_sale->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product_hot_sale->product_name}} | Đã bán: {{$product_hot_sale->product_sold}}</h6>
                            @if($product_hot_sale->product_exist !== 0)
                            <form>
                                @csrf
                                <a data-product_id="{{$product_hot_sale->product_id}}" data-product_name="{{$product_hot_sale->product_name}}"
                                data-product_price="{{$product_hot_sale->product_price}}" data-product_exist="{{$product_hot_sale->product_exist}}"
                                data-product_image="{{$product_hot_sale->product_image}}" data-product_qty="1" data-product_size="s"
                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                            </form>
                            @else
                                <a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>
                            @endif
                            <div class="rating"></div>
                            <h5>{{number_format($product_hot_sale->product_price). ' vnđ'}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="{{url('frontend/images/instagram/instagram-1.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{url('frontend/images/instagram/instagram-2.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{url('frontend/images/instagram/instagram-3.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{url('frontend/images/instagram/instagram-4.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{url('frontend/images/instagram/instagram-5.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{url('frontend/images/instagram/instagram-6.jpg')}}"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                        <h3>#Male_Fashion</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Latest News</span>
                        <h2>Fashion New Trends</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{url('uploads/post/'. $post->post_image)}}"></div>
                        <div class="blog__item__text">
                            <span><img src="{{url('frontend/images/icon/calendar.png')}}" alt="">{{$post->updated_at->toDayDateTimeString()}}</span>
                            <span>Lượt xem: {{$post->post_views}}</span>
                            <h5>{{$post->post_title}}</h5>
                            <a href="{{route('blog_details', [$post->post_slug])}}">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
@endsection