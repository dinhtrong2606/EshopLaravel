@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        THÊM MÃ GIẢM GIÁ
    </header>
    <div class="panel-body">
        <div class="position-center">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
                @endif
                <form action="{{route('coupon.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên giảm giá</label>
                        <input type="text" name="coupon_name" value="{{old('coupon_name')}}" class="form-control"  placeholder="Tên mã giảm giá">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mã giảm giá</label>
                        <input type="text" name="coupon_code" value="{{old('coupon_code')}}" class="form-control"  placeholder="Mã giảm giá">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Số lượng mã</label>
                        <input type="text" name="coupon_time" value="{{old('coupon_time')}}" class="form-control"  placeholder="Số lượng mã giảm giá">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tính năng mã</label>
                        <select name="coupon_condition" class="form-control input-sm m-bot15">
                            <option value="#">---Chọn---</option>
                            <option value="1">Giảm theo phần trăm</option>
                            <option value="2">Giảm theo tiền</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                        <input type="text" name="coupon_number" value="{{old('coupon_number')}}" class="form-control"  placeholder="% hoặc tiền mã giảm giá">
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>

        </div>
</section>
@endsection