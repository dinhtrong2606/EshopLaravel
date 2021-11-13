@extends('pages.product.layout_detail')
@section('main_content')

<div class="product-details">
    <!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <ul id="imageGallery">
                @foreach($gallevy_product as $val_gallevy)
                <li data-thumb="{{asset('uploads/gallevy/'. $val_gallevy->gallevy_image)}}"
                    data-src="{{asset('uploads/gallevy/'. $val_gallevy->gallevy_image)}}">
                    <img src="{{asset('uploads/gallevy/'. $val_gallevy->gallevy_image)}}" />
                </li>
                @endforeach
            </ul>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$product->product_name}}</h2>
            <p>PRODUCT ID: {{$product->product_id}}</p>
            <img src="{{asset('frontend/images/rating.png')}}" alt="" />
            <span>
                <form>
                    @csrf
                    <span>{{number_format($product->product_price) . ' vnđ'}}</span>
                    <label>Quantity:</label>
                    <input name="product_qty" class="product_quantity_{{$product->product_id}}" type="number" value="1"
                        min="1" />
                    <input type="hidden" name="product_id" class="product_id_{{$product->product_id}}"
                        value="{{$product->product_id}}">
                    <input type="hidden" name="product_exist" class="product_exist_{{$product->product_id}}"
                        value="{{$product->product_exist}}">
                    <input type="hidden" name="product_name" class="product_name_{{$product->product_id}}"
                        value="{{$product->product_name}}">
                    <input type="hidden" name="product_price" class="product_price_{{$product->product_id}}"
                        value="{{$product->product_price}}">
                    <input type="hidden" name="product_image" class="product_image_{{$product->product_id}}"
                        value="{{$product->product_image}}">
                    <button type="button" name="add-cart" data-product_id="{{$product->product_id}}"
                        class="btn btn-fefault cart add-cart">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </form>
            </span>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Category:</b> {{$product->category->category_name}}</p>
            <p><b>Brand:</b> {{$product->brand->brand_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
        </div>
        <!--/product-information-->
    </div>
</div>
<!--/product-details-->
<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
            <li><a href="#tag" data-toggle="tab">Tag</a></li>
            <li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="companyprofile">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tag">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($recommend_product as $key => $row_product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{route('product-detail', [$row_product->slugproduct])}}"><img
                                        src="{{asset('uploads/gallevy/'. $row_product->product_image)}}" alt="" /></a>
                                <h2>{{number_format($row_product->product_price). ' vnđ'}}</h2>
                                <p>{{$row_product->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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