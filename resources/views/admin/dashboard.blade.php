@extends('admin_layout')
@section('admin_content')
<div class="col-md-3 market-update-gd">
    <div class="market-update-block clr-block-2">
        <div class="col-md-4 market-update-right">
            <i class="fa fa-eye"> </i>
        </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="col-md-8 market-update-left">
            <h4>Tổng số lượt xem bài viết</h4>
            <h3>{{ $number_views_post }}</h3>
            @hasanyrole('Admin')
            <a href="{{route('post.index')}}" style="color: white">See more</a>
            @endhasanyrole
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<div class="col-md-3 market-update-gd">
    <div class="market-update-block clr-block-2">
        <div class="col-md-4 market-update-right">
            <i class="fa fa-eye"> </i>
        </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="col-md-8 market-update-left">
            <h4>Tổng số lượt xem sản phẩm</h4>
            <h3>{{ $number_views_product }}</h3>
            @hasanyrole('Admin')
            <a href="{{route('product.index')}}" style="color: white">See more</a>
            @endhasanyrole
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<div class="col-md-3 market-update-gd">
    <div class="market-update-block clr-block-2">
        <div class="col-md-4 market-update-right">
            
        </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="col-md-8 market-update-left">
            <h4>Tổng số sản phẩm trong kho</h4>
            <h3>{{ count($products) }}</h3>
            @hasanyrole('Admin')
            <a href="{{route('product.index')}}" style="color: white">See more</a>
            @endhasanyrole
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<div class="col-md-3 market-update-gd">
    <div class="market-update-block clr-block-2">
        <div class="col-md-4 market-update-right">
           
        </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="col-md-8 market-update-left">
            <h4>Tổng số đơn hàng đã đặt</h4>
            <h3>{{ count($orders) }}</h3>
            @hasanyrole('Admin')
            <a href="{{route('manage-order')}}" style="color: white">See more</a>
            @endhasanyrole
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection