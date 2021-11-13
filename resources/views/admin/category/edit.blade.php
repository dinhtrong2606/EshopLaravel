@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        CẬP NHẬT DANH MỤC SẢN PHẨM
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
                <form action="{{route('category.update', [$danhmuc->category_id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" name="category_name" value="{{$danhmuc->category_name}}" class="form-control"
                            onkeyup="ChangeToSlug();" id="slug">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug danh mục</label>
                        <input type="text" name="slugdanhmuc" value="{{$danhmuc->slugdanhmuc}}" class="form-control"
                            id="convert_slug" id="exampleInputEmail1" placeholder="Slug danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả danh mục</label>
                        <textarea style="resize:none" name="category_desc" rows="7" type="text" class="form-control"
                            id="exampleInputPassword1">{{$danhmuc->category_desc}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Thuộc danh mục</label>
                        <select name="category_parent" class="form-control ">
                            <option {{$danhmuc->category_parent== 0 ? 'selected' : ''}} value="0">---Danh mục cha---
                            </option>
                            @foreach($category as $val)
                            @if($val->category_parent==0)
                            <option {{$val->category_id==$danhmuc->category_parent ? 'selected' : ''}}
                                value="{{$val->category_id}}">{{$val->category_name}}</option>
                            @endif

                            @foreach($category as $val2)
                            @if($val->category_id==$val2->category_parent)
                            <option value="{{$val2->category_id}}">---{{$val2->category_name}}---</option>
                            @endif
                            @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="category_status" class="form-control ">
                            @if($danhmuc->category_status==0)
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