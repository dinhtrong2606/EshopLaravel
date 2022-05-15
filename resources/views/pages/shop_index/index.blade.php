@extends('layout')
@section('main_content')   
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{route('trang-chu')}}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End --> 
<!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{url('/search-complete')}}" method="POST">
                                <input id="search" type="text" placeholder="Search..." autocomplete="off">
                                <button type="button"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @foreach($category as $val_category)
                                                    <li><a class="category" style="cursor:pointer" data-category_nm="{{$val_category->category_name}}" data-category_id="{{$val_category->category_id}}">{{$val_category->category_name}} (20)</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    @foreach($brand as $val_brand)
                                                    <li><a class="brand" style="cursor:pointer" data-brand_nm="{{$val_brand->brand_name}}" data-brand_id="{{$val_brand->brand_id}}">{{$val_brand->brand_name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a class="filter-price" data-filter_price="1" style="cursor: pointer">0 - 500.000</a></li>
                                                    <li><a class="filter-price" data-filter_price="2" style="cursor: pointer">500.000 - 2.000.000</a></li>
                                                    <li><a class="filter-price" data-filter_price="3" style="cursor: pointer">2.000.000 - 5.000.000</a></li>
                                                    <li><a class="filter-price" data-filter_price="4" style="cursor: pointer">5.000.000 - 10.000.000</a></li>
                                                    <li><a class="filter-price" data-filter_price="5" style="cursor: pointer">10.000.000+</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left" id="no-result" style="width: 600px">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="filter-product">
                        @foreach($product as $key => $value_product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/'. $value_product->product_image)}}">
                                    <ul class="product__hover">
                                        <li><a class="product-wishlist" data-product_id="{{$value_product->product_id}}" data-product_name="{{$value_product->product_name}}"
                                        data-product_price="{{$value_product->product_price}}" data-product_exist="{{$value_product->product_exist}}"
                                        data-product_image="{{$value_product->product_image}}" data-product_qty="1" data-product_size="s" data-product_sold="{{$value_product->product_sold}}"
                                        data-product_slug="{{$value_product->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                        <li><a class="product-detail" data-product_id="{{$value_product->product_id}}" data-product_name="{{$value_product->product_name}}"
                                        data-product_price="{{$value_product->product_price}}" data-product_exist="{{$value_product->product_exist}}"
                                        data-product_image="{{$value_product->product_image}}" data-product_qty="1" data-product_size="s"
                                        data-product_slug="{{$value_product->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{$value_product->product_name}} | Đã bán: {{$value_product->product_sold}}</h6>
                                    @if($value_product->product_exist !== 0)
                                    <form>
                                        @csrf
                                        <a data-product_id="{{$value_product->product_id}}" data-product_name="{{$value_product->product_name}}"
                                        data-product_price="{{$value_product->product_price}}" data-product_exist="{{$value_product->product_exist}}"
                                        data-product_image="{{$value_product->product_image}}" data-product_qty="1" data-product_size="s"
                                        name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                                    </form>
                                    @else
                                        <a class="add-cart" style="cursor: default;pointer-events: none;">Out of stock</a>
                                    @endif
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>{{number_format($value_product->product_price). ' vnđ'}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center btn-container">
                        <button type="button" class="see-more" id="toggle">See More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection