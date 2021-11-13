@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        THÊM SẢN PHẨM
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
                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" name="product_name" value="{{old('product_name')}}" class="form-control"
                            onkeyup="ChangeToSlug();" id="slug" placeholder="Tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug sản phẩm</label>
                        <input type="text" name="slugproduct" value="{{old('slugproduct')}}" class="form-control"
                            id="convert_slug" id="exampleInputEmail1" placeholder="Slug sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea style="resize:none" name="product_desc" rows="7" type="text" class="form-control"
                            id="exampleInputPassword1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea name="product_content" type="text" class="form-control"
                            id="content_product"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="number" name="product_price" value="{{old('product_price')}}" class="form-control"
                            placeholder="Giá sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số sản phẩm</label>
                        <input type="number" name="product_exist" value="{{old('product_exist')}}" class="form-control"
                            placeholder="Số lượng sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                        <input type="file" name="product_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Thương hiệu sản phẩm</label>
                        <select name="brand_id" class="form-control">
                            @foreach($brand as $key => $row_brand)
                            <option value="{{$row_brand->brand_id}}">{{$row_brand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Danh mục sản phẩm</label>
                        <select name="category_id" class="form-control">
                            @foreach($category as $key => $row_category)
                            @if($row_category->category_parent==0)
                            <option value="{{$row_category->category_id}}">{{$row_category->category_name}}</option>
                            @endif

                            @foreach($category as $val)
                            @if($row_category->category_id==$val->category_parent)
                            <option value="{{$val->category_id}}">---{{$val->category_name}}---</option>
                            @endif
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="product_status" class="form-control">
                            <option value="0">Hiển thị</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>


           
         <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>

        </div>
</section>
@endsection