@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê User
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">

                </div>
            </div>
            <div class="table-responsive">
                @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="post[]"></th>
                            <th>Tên User</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Phân quyền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admin as $key => $val)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$val->name}}</td>
                            <td>{{$val->email}}</td>
                            <td><b>
                                    @foreach($val->roles as $roles)
                                    {{$roles->name}}
                                    @endforeach
                                </b>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{route('roles_user', $val->id)}}">Phân quyền</a>
                                <a class="btn btn-primary" href="{{route('permission_user', $val->id)}}">Phân vai
                                    trò</a>
                            </td>
                            <td><a href="{{route('delete-user', $val->id)}}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn có thực sự muốn xóa user này không!')">Delete</a>
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
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <nav aria-label="Page navigation">
                                {!! $admin->links() !!}
                            </nav>
                        </ul>
                    </div>



                </div>
























                </f ooter>
                </d iv>
        </div>
    </div>
































    @endsection