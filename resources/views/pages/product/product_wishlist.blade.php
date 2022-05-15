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
                            <span>Product Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End --> 
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <h3 class="related-title">Product Wishlist List</h3>
                </div>
            </div>
            <div class="row">
                @if(session('product_wishlist'))
                    @foreach(session('product_wishlist') as $val_product_wishlist)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/' .$val_product_wishlist['product_image'] )}}">
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li><a class="product-detail" data-product_id="{{$val_product_wishlist['product_id']}}" data-product_name="{{$val_product_wishlist['product_name']}}"
                                    data-product_price="{{$val_product_wishlist['product_price']}}" data-product_exist="{{$val_product_wishlist['product_exist']}}"
                                    data-product_image="{{$val_product_wishlist['product_image']}}" data-product_qty="1" data-product_size="s"
                                    data-product_slug="{{$val_product_wishlist['product_slug']}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{$val_product_wishlist['product_name']}} | Đã bán: {{ $val_product_wishlist['product_sold'] }}</h6>
                                <form>
                                    @csrf
                                    <a data-product_id="{{$val_product_wishlist['product_id']}}" data-product_name="{{$val_product_wishlist['product_name']}}"
                                    data-product_price="{{$val_product_wishlist['product_price']}}" data-product_exist="{{$val_product_wishlist['product_exist']}}"
                                    data-product_image="{{$val_product_wishlist['product_image']}}" data-product_qty="1" data-product_size="s"
                                    name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                                </form>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>{{number_format($val_product_wishlist['product_price']). ' vnđ'}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection