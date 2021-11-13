@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        Cập nhật thương hiệu sản phẩm
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
                <form action="{{route('brand.update', [$brand->brand_id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                        <input type="text" name="brand_name" value="{{$brand->brand_name}}"  class="form-control" onkeyup="ChangeToSlug();" id="slug" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug thương hiệu</label>
                        <input type="text" name="slugbrand" value="{{$brand->slugbrand}}" class="form-control" id="convert_slug" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                        <textarea style="resize:none" name="brand_desc" rows="7" type="text" class="form-control" id="exampleInputPassword1">{{$brand->brand_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="brand_status" class="form-control input-sm m-bot15">
                           @if($brand->brand_status==0)
                           <option selected value="0">Hiển thị</option>
                            <option value="1">Ẩn</option>
                           @else
                           <option value="0">Hiển thị</option>
                            <option selected value="1">Ẩn</option>
                           @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>

        </div>
</section>
@endsection