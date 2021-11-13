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
            <h4>Visitors</h4>
            <h3>13,500</h3>
            <p>Other hand, we denounce</p>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection