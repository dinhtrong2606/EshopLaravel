@extends('layout')
@section('main_content')
<!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{route('trang-chu')}}">Home</a>
                            <a href="{{route('shop-detail')}}">Shop</a>
                            <span>{{$product->product_name}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($gallevy_product as $product_images)
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg img-thumbnail" data-setbg="{{url('uploads/gallevy/'. $product_images->gallevy_image)}}">
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item zoom">
                                    <img class="image-product img-thumbnail" width="350" height="250" src="{{url('uploads/gallevy/'. $product->product_image)}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{$product->product_name}} | Đã bán: {{ $product->product_sold }} | <i class="fa fa-eye"></i> {{$product->product_views}}</h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>{{number_format($product->product_price). ' vnđ'}}</h3>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <label for="xxl">xxl
                                        <input type="radio" name="product_size" id="xxl" value="xxl">
                                    </label>
                                    <label for="xl">xl
                                        <input type="radio" name="product_size" id="xl" value="xl">
                                    </label>
                                    <label for="l">l
                                        <input type="radio" name="product_size" id="l" value="l">
                                    </label>
                                    <label for="sm">s
                                        <input type="radio" name="product_size" id="sm" value="sm">
                                    </label>
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="number" name="product_qty" value="1" min="1">
                                    </div>
                                </div>
                                <a class="primary-btn add-to-cart-detail" style="color: white;cursor: pointer" data-product_id="{{$product->product_id}}"
                                data-product_name="{{$product->product_name}}" data-product_price="{{$product->product_price}}"
                                data-product_exist="{{$product->product_exist}}" data-product_image="{{$product->product_image}}">add to cart</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{url('frontend/images/shop-details/details-payment.png')}}" alt="">
                                <ul>
                                    @if($product->product_exist > 0)
                                    <li>In Stock</li>
                                    @else
                                    <li>Out Stock</li>
                                    @endif
                                    <li><span>Categories:</span> {{$product->category->category_name}}</li>
                                    <li><span>Tag:</span> {{$product->product_tags}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(<span id="number-comment2">{{count($comments)}}</span>)</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">{!! $product->product_content !!}</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                        <div class="container">
                                            <div class="be-comment-block">
                                                <h1 class="comments-title">Comments (<span id="number-comment">{{count($comments)}}</span>)</h1>
                                                <div id="comment-list">
                                                    @if($comments)
                                                    @foreach($comments as $comment)
                                                    <div class="be-comment comment{{$comment->comment_id}}">
                                                        <div class="be-img-comment">	
                                                            <a href="blog-detail-2.html">
                                                                <img src="{{url('frontend/images/about/team-1.jpg')}}" alt="" class="be-ava-comment">
                                                            </a>
                                                        </div>
                                                        <div class="be-comment-content mt-3">
                                                            <span class="be-comment-name">
                                                                <a href="blog-detail-2.html" style="font-size: 16px;"><b>{{$comment->name}}</b></a>
                                                                @if($comment->user_id == session('customer_id'))
                                                                    <i class="fa-solid fa-paper-plane-top"></i>
                                                                    <i data-comment_id="{{$comment->comment_id}}" class="fa fa-edit ml-2 edit-comment" style="font-size: 17px;"></i>
                                                                    <i data-comment_id="{{$comment->comment_id}}" class="fa fa-trash ml-1 delete-comment" style="font-size: 17px;"></i>
                                                                @endif
                                                                </span>
                                                            <span class="be-comment-time">
                                                                <i class="fa fa-clock-o"></i>
                                                                <span class="time-comment{{$comment->comment_id}}" style="margin-left: -100px">{{$comment->updated_at}}</span>
                                                            </span>
                                                            <div class="comment-content{{$comment->comment_id}}">
                                                                <input class="form-control form-control-lg comment_content" type="text" id="comment_content{{$comment->comment_id}}" 
                                                                    name="comment_content" value="{{$comment->comment_content}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif 
                                                </div>
                                                @if(session()->has('customer_id'))
                                                <form class="form-block mt-4">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <div class="form-group fl_icon">
                                                                <div class="icon"><i class="fa fa-user"></i></div>
                                                                <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                                                <input class="form-input" id="comment_name" name="comment_name" type="text" placeholder="Your name">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6 fl_icon">
                                                            <div class="form-group fl_icon">
                                                                <div class="icon"><i class="fa fa-envelope-o"></i></div>
                                                                <input class="form-input" name="comment_email" type="text" placeholder="Your email">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 fl_icon">									
                                                            <div class="form-group">
                                                                <textarea class="form-input" required="" name="comment_content" placeholder="Your text"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary float-right btn-comment" type="button" name="submit">Submit</button>
                                                </form>
                                                @else
                                                <a href="{{route('login-customer')}}">
                                                    <div class="input-group">
                                                        <div class="form-control" style="padding: 10px 0">
                                                            <p class="text-center" style="font-size: 18px">Đăng nhập để bình luận</p>
                                                        </div>
                                                    </div>        
                                                </a>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                @foreach($recommend_product as $key => $val_product_relate)
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/'. $val_product_relate->product_image)}}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a class="product-wishlist" data-product_id="{{$val_product_relate->product_id}}" data-product_name="{{$val_product_relate->product_name}}"
                                data-product_price="{{$val_product_relate->product_price}}" data-product_exist="{{$val_product_relate->product_exist}}"
                                data-product_image="{{$val_product_relate->product_image}}" data-product_qty="1" data-product_size="s"
                                data-product_slug="{{$val_product_relate->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                <li><a class="product-detail" data-product_id="{{$val_product_relate->product_id}}" data-product_name="{{$val_product_relate->product_name}}"
                                data-product_price="{{$val_product_relate->product_price}}" data-product_exist="{{$val_product_relate->product_exist}}"
                                data-product_image="{{$val_product_relate->product_image}}" data-product_qty="1" data-product_size="s"
                                data-product_slug="{{$val_product_relate->slugproduct}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$val_product_relate->product_name}}</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>{{number_format($val_product_relate->product_price). ' vnđ'}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Viewed Recently</h3>
                </div>
            </div>
            <div class="row">
                @foreach(session('product_viewed') as $val_product_viewed)
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{url('uploads/gallevy/' .$val_product_viewed['product_image'] )}}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a class="product-wishlist" data-product_id="{{$val_product_viewed['product_id']}}" data-product_name="{{$val_product_viewed['product_name']}}"
                                data-product_price="{{$val_product_viewed['product_price']}}" data-product_exist="{{$val_product_viewed['product_exist']}}"
                                data-product_image="{{$val_product_viewed['product_image']}}" data-product_qty="1" data-product_size="s"
                                data-product_slug="{{$val_product_viewed['product_slug']}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/heart.png')}}" alt=""></a></li>
                                <li><a class="product-detail" data-product_id="{{$val_product_viewed['product_id']}}" data-product_name="{{$val_product_viewed['product_name']}}"
                                data-product_price="{{$val_product_viewed['product_price']}}" data-product_exist="{{$val_product_viewed['product_exist']}}"
                                data-product_image="{{$val_product_viewed['product_image']}}" data-product_qty="1" data-product_size="s"
                                data-product_slug="{{$val_product_viewed['product_slug']}}" style="cursor: pointer"><img src="{{url('frontend/images/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$val_product_viewed['product_name']}}</h6>
                            <form>
                                @csrf
                                <a data-product_id="{{$val_product_viewed['product_id']}}" data-product_name="{{$val_product_viewed['product_name']}}"
                                data-product_price="{{$val_product_viewed['product_price']}}" data-product_exist="{{$val_product_viewed['product_exist']}}"
                                data-product_image="{{$val_product_viewed['product_image']}}" data-product_qty="1" data-product_size="s"
                                name="add-to-cart" class="add-cart add-to-cart" style="cursor: pointer">+ Add To Cart</a>
                            </form>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>{{number_format($val_product_viewed['product_price']). ' vnđ'}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->
@endsection