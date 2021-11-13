@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        CẬP NHẬT SẢN PHẨM
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
                <form action="{{route('product.update', [$editproduct->product_id])}}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" name="product_name" value="{{$editproduct->product_name}}"
                            class="form-control" onkeyup="ChangeToSlug();" id="slug">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug sản phẩm</label>
                        <input type="text" name="slugproduct" value="{{$editproduct->slugproduct}}" class="form-control"
                            id="convert_slug" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea style="resize:none" name="product_desc" rows="7" type="text" class="form-control"
                            id="exampleInputPassword1">{{$editproduct->product_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea name="product_content" type="text" class="form-control"
                            id="content_product">{{$editproduct->product_content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="number" name="product_price" value="{{$editproduct->product_price}}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                        <input type="number" name="product_exist" value="{{$editproduct->product_exist}}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                        <input type="file" name="product_image" class="form-control">
                        <img style="width: 200px;height: 120px"
                            src="{{asset('uploads/gallevy/'. $editproduct->product_image)}}" alt="">
                    </div>
                    <div class="form-group">
                        <label>Thương hiệu sản phẩm</label>
                        <select name="brand_id" class="form-control input-sm m-bot15">
                            @foreach($brand as $key => $row_brand)
                            <option {{$editproduct->brand_id==$row_brand->brand_id ? 'selected' : ''}}
                                value="{{$row_brand->brand_id}}">{{$row_brand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Danh mục sản phẩm</label>
                        <select name="category_id" class="form-control input-sm m-bot15">
                            @foreach($category as $key => $row_category)
                            <option {{$editproduct->category_id==$row_category->category_id ? 'selected' : ''}}
                                value="{{$row_category->category_id}}">{{$row_category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="product_status" class="form-control input-sm m-bot15">
                            @if($editproduct->product_status==0)
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