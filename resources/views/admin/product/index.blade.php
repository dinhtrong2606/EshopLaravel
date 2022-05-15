@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">

                </div>
            </div>
            <div>
                @if (session('status'))
                <div class=" alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <div class="table-responsive-lg">
                    <table class="table table-bordered b-t b-light" id="myTable">
                        <thead>
                            <tr>
                                <th style=" width:20px;">ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Thư viện ảnh</th>
                                <th>Hình ảnh</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Số lượng tồn</th>
                                <th>Giá</th>
                                <th style="width:13%">Trạng thái</th>
                                <th style="width:13%">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category as $key => $row_product)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$row_product->product_name}}</td>
                                <td><a href="{{route('add_gallevy', $row_product->product_id)}}">Thêm thư viện ảnh</a>
                                </td>
                                <th><img style="width: 130px;height:90px"
                                        src="{{asset('uploads/gallevy/' .$row_product->product_image)}}" alt=""></th>
                                <th>{{$row_product->category->category_name}}</th>
                                <th>{{$row_product->brand->brand_name}}</th>
                                <th>{{$row_product->product_exist}}</th>
                                <th>{{number_format($row_product->product_price)}}</th>
                                <td>
                                    @if($row_product->product_status==0)
                                    <form>
                                        @csrf
                                        <select name="product_status" data-product_id="{{$row_product->product_id}}"
                                            class="form-control sanpham">
                                            <option selected value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                        </select>
                                    </form>
                                    @else
                                    <form>
                                        @csrf
                                        <select name="product_status" data-product_id="{{$row_product->product_id}}"
                                            class="form-control sanpham">
                                            <option value="0">Hiển thị</option>
                                            <option selected value="1">Ẩn</option>
                                        </select>
                                    </form>
                                    @endif
                                </td>
                                <td>
                                    <a class="edit" href="{{route('product_edit', [$row_product->product_id])}}"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a onclick="return confirm('Bạn có thực sự muốn xóa sản phẩm này không ?')"
                                        class="delete" href="{{route('product_delete', [$row_product->product_id])}}"><i
                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection