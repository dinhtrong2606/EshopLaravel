<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        @foreach($category as $key => $row_category)
                        <div class="panel panel-default">
                            @if($row_category->category_parent==0)
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#{{$row_category->slugdanhmuc}}"
                                        data-parent="#accordian">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        <a
                                            href="{{route('product-category', [$row_category->slugdanhmuc])}}">{{$row_category->category_name}}</a>
                                    </a>
                                </h4>
                            </div>
                            <div id="{{$row_category->slugdanhmuc}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @foreach($category as $key => $child)
                                        @if($row_category->category_id==$child->category_parent)
                                        <li><a
                                                href="{{route('product-category_child', [$child->slugdanhmuc])}}">{{$child->category_name}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <!--/category-products-->


                    <div class="brands_products">
                        <!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($brand as $key => $row_brand)
                                <li><a href="{{route('product-brand', [$row_brand->slugbrand])}}"> <span
                                            class="pull-right">(50)</span>{{$row_brand->brand_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--/brands_products-->

                    <div class="price-range">
                        <!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div>
                    <!--/price-range-->

                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="{{asset('frontend/images/shipping.jpg')}}" alt="" />
                    </div>
                    <!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                @yield('main_content')
















            </div>
        </div>
    </div>
</section>