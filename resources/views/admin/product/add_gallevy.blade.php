@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thêm ảnh vào sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">

                </div>
            </div>
            <div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form action="{{route('insert_gallevy', $product_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3" align="right">

                        </div>
                        <div class="col-md-6">
                            <input class="form-control" id="file" type="file" name="file[]" accept="image/*" multiple>
                            <span id="error-gallevy"></span>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-success" name="upload_gallevy" value="Upload Image">
                        </div>
                    </div>
                </form>
                <br>
                <form>
                    @csrf
                    <input type="hidden" class="product_id" name="product_id" value="{{$product_id}}">
                    <div id="gallevy_load">


                    </div>
                </form>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">

                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

<script>
load_gallevy();

function load_gallevy() {
    var product_id = $('.product_id').val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: "{{url('/select-gallevy')}}",
        method: "POST",
        data: {
            product_id: product_id,
            _token: _token
        },
        success: function(data) {
            $('#gallevy_load').html(data);
        }
    });
}

$('#file').change(function() {
    var error = '';
    var files = $('#file')[0].files;

    if (files.length > 5) {
        error += '<p>Bạn không được phép chọn quá 5 ảnh</p>';
    } else if (files.length == '') {
        error += '<p>Bạn không được bỏ trống file ảnh</p>';
    } else if (files.size > 2000000) {
        error += '<p>Kích cỡ file ảnh không được vượt quá 2M</p>';
    }

    if (error == '') {

    } else {
        $('#file').val('');
        $('#error-gallevy').html('<span class="text-danger">' + error + '</span>');
        return false;
    }
});

$(document).on('change', '.edit_image', function() {
    var gallevy_id = $(this).data('gal_id');

    var formData = new FormData();
    formData.append('file', document.getElementById("edit_image_" + gallevy_id).files[0]);
    formData.append('gallevy_id', gallevy_id);

    $.ajax({
        url: "{{url('/update-image-gallevy')}}",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        data: formData,

        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            load_gallevy();
            $('#error-gallevy').html(
                '<span class="text-success">Bạn đã cập nhật hình ảnh thành công!</span>'
            );
        }
    });
});

$(document).on('blur', '.image-name', function() {
    var id = $(this).data('gal_id');
    var gallevy_name = $(this).text();
    var _token = $('meta[name="csrf_token"]').attr('content');
    $.ajax({
        url: "{{url('/update-name-gallevy')}}",
        method: "POST",
        data: {
            id: id,
            gallevy_name: gallevy_name,
            _token: _token
        },
        success: function(data) {
            load_gallevy();
            $('#error-gallevy').html(
                '<span class="text-success">Bạn đã cập nhật tên hình ảnh thành công!</span>'
            );
        }
    });
});

$(document).on('click', '.delete-gallevy', function() {
    var gal_id = $(this).data('pro_id');
    var _token = $('meta[name="csrf_token"]').attr('content')
    $.ajax({
        url: "{{url('/delete-gallevy')}}",
        method: "DELETE",
        data: {
            gal_id: gal_id,
            _token: _token
        },
        success: function(data) {
            load_gallevy();
            $('#error-gallevy').html(
                '<span class="text-success">Bạn đã xóa hình ảnh thành công!</span>'
            );
        }
    });
});
</script>
@endsection