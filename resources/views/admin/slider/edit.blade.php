@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        EDIT SLIDER
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
                <form action="{{route('slider.update', $slider->slider_id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên slider</label>
                        <input type="text" name="slider_name" value="{{$slider->slider_name}}" class="form-control" placeholder="Tên slider">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh</label>
                        <input type="file" name="slider_image" class="form-control">
                        <img style="width: 200px;height: 120px" src="{{asset('uploads/slider/' .$slider->slider_image)}}" alt="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                        <textarea style="resize:none" name="slider_desc" rows="7" type="text" class="form-control" id="exampleInputPassword1">{{$slider->slider_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="slider_status" class="form-control input-sm m-bot15">
                            @if($slider->slider_status==0)
                            <option value="0" selected>Hiển thị</option>
                            <option value="1">Ẩn</option>
                            @else
                            <option value="0">Hiển thị</option>
                            <option value="1" selected>Ẩn</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>

        </div>
</section>
@endsection