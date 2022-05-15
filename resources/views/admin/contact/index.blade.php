@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê Contact
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">

                </div>
            </div>
            <div class="table-responsive">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <table class="table table-bordered b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th style="width:20px;">ID</th>
                            <th>Người gửi</th>
                            <th>Email</th>
                            <th>Nội dung</th>
                            <th>Ngày cập nhật</th>
                            <th>Ngày tạo</th>
                            <th style="width:13%">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $key => $contact)
                        <tr>
                            <td>{{$contact->slider_id}}</td>
                            <td>{{$contact->name}}</td>
                            <th>{{$contact->email}}</th>
                            <th>{{$contact->contact_content}}</th>
                            <th>{{$contact->created_at}}</th>
                            <th>{{$contact->updated_at}}</th>
                            <td>
                                @can('Delete Contact')
                                <a onclick="return confirm('Bạn có thực sự muốn xóa contact này không ?')" 
                                class="delete" href="{{route('contact_delete', [$contact->contact_id])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection