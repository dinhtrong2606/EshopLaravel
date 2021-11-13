@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <header class="panel-heading">
        THÊM DANH MỤC SẢN PHẨM
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
                <form action="{{route('category.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" name="category_name" value="{{old('category_name')}}" class="form-control"
                            onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug danh mục</label>
                        <input type="text" name="slugdanhmuc" value="{{old('slugdanhmuc')}}" class="form-control"
                            id="convert_slug" id="exampleInputEmail1" placeholder="Slug danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả danh mục</label>
                        <textarea style="resize:none" name="category_desc" rows="7" type="text" class="form-control"
                            id="exampleInputPassword1"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Danh mục cha</label>
                        <select name="category_parent" class="form-control">
                            <option value="0">---Danh mục cha---</option>
                            @foreach($category as $val_category)
                            <option value="{{$val_category->category_id}}">{{$val_category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="category_status" class="form-control">
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