@extends('layout')
@section('main_content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach($search as $key => $row_product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{route('product-detail', [$row_product->slugproduct])}}"><img
                            style="width: 230px;height:170px"
                            src="{{asset('uploads/product/'. $row_product->product_image)}}" alt="" /></a>
                    <h2>{{number_format($row_product->product_price). ' vnđ'}}</h2>
                    <p>{{$row_product->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--features_items-->

<!--/category-tab-->
<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($recommend_product as $key => $value)
            <div class="item active">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{asset('uploads/gallevy/' . $value->product_image)}}" alt="" />
                                <h2>{{number_format($value->product_price) . ' vnd'}}</h2>
                                <p>{{$value->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<!--/recommended_items-->
@endsection