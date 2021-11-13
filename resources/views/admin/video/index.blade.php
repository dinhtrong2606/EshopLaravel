@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thêm video
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
                <!-- Thêm video bang ajax -->
                <div class="panel-body">
                    <div class="position-center">
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên video</label>
                                    <input type="text" name="video_title" onkeyup="ChangeToSlug();" id="slug"
                                        class="form-control video_title" placeholder="Tên videos">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug video</label>
                                    <input type="text" name="video_slug" id="convert_slug"
                                        class="form-control video_slug" placeholder="Slug video">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh video</label>
                                    <input type="file" name="video_image" id="img_video"
                                        class="form-control video_image">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đường dẫn</label>
                                    <input type="text" name="video_link" class="form-control video_link"
                                        placeholder="Video links">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả video</label>
                                    <textarea style="resize:none" name="video_desc" rows="7" type="text"
                                        class="form-control video_desc" id="exampleInputPassword1"></textarea>
                                </div>
                                <button type="button" class="btn btn-info submit_video">Thêm video</button>
                            </form>
                        </div>
                    </div>
                </div>


                <hr>
                <div id="notify-video"></div>
                <!-- list video -->
                <form>
                    @csrf
                    <div class="table-responsive" id="load_video">
                    </div>
                </form>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
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

<!-- hien thi video bang ajax -->
<script>
load_video();

function load_video() {
    var _token = $('meta[name="csrf_token"]').attr('content');
    $.ajax({
        url: "{{url('/select-video')}}",
        method: "POST",
        data: {
            _token: _token
        },
        success: function(data) {
            $('#load_video').html(data);
        }
    });
}
$(document).on('click', '.delete_video', function() {
    var video_id = $(this).data('video_id');
    if (confirm('Bạn thực sự muốn xóa video này không?')) {
        $.ajax({
            url: "{{url('/delete-video')}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            data: {
                video_id: video_id,
            },
            success: function(data) {
                load_video();
                $('#notify-video').html('<span class="text-success">Bạn đã xóa thành công!</span>')
            }
        });
    }
});

$(document).on('blur', '.edit_video', function() {
    var video_id = $(this).data('vid_id');
    var video_type = $(this).data('type');
    var video_title = $('.video_title_' + video_id).text();
    var video_slug = $('.video_slug_' + video_id).text();
    var video_link = $('.video_link_' + video_id).text();
    var video_desc = $('.video_desc_' + video_id).text();

    var thongbao = '';
    if (video_type == 'video_title') {
        var video_edit = video_title;
        var thongbao = "Title video thay đổi thành công!";
    } else if (video_type == 'video_slug') {
        var video_edit = video_slug;
        var thongbao = "Slug video thay đổi thành công!";
    } else if (video_type == 'video_link') {
        var video_edit = video_link;
        var thongbao = "Link video thay đổi thành công!";
    } else if (video_type == 'video_desc') {
        var video_edit = video_desc;
        var thongbao = "Mô tả video thay đổi thành công!";
    }

    $.ajax({
        url: "{{url('/edit-video')}}",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        data: {
            video_edit: video_edit,
            video_id: video_id,
            video_type: video_type
        },
        success: function(data) {
            load_video();
            $('#notify-video').html(
                '<span class="text-success">' + thongbao + '</span>')
        }
    });
});

$(document).on('change', '.edit_image', function() {
    video_id = $(this).data('vid_id');
    var formData = new FormData();
    formData.append('file', document.getElementById("file_image_" + video_id).files[0]);
    formData.append('video_id', video_id);
    $.ajax({
        url: "{{url('/edit-image')}}",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        data: formData,

        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            load_video();
            $('#notify-video').html(
                '<span class="text-success">Bạn đã cập nhật hình ảnh thành công!</span>')
        }
    });

});

$(document).on('click', '.submit_video', function() {
    var video_title = $('.video_title').val();
    var video_slug = $('.video_slug').val();
    var video_link = $('.video_link').val();
    var video_desc = $('.video_desc').val();


    var formData = new FormData();
    formData.append('file', document.getElementById("img_video").files[0]);
    formData.append('video_title', video_title);
    formData.append('video_slug', video_slug);
    formData.append('video_link', video_link);
    formData.append('video_desc', video_desc);

    $.ajax({
        url: "{{url('/store-video')}}",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        data: formData,

        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            load_video();
            $('#notify-video').html(
                '<span class="text-success">Bạn đã thêm video thành công!</span>')
            $('.video_title').val('');
            $('.video_slug').val('');
            $('.video_link').val('');
            $('.video_desc').val('');
            $('#img_video').val('');
        }
    });
});
</script>
@endsection