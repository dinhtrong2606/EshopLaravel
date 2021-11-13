@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <a style="font-size: 13px;" class="btn btn-danger" href="{{route('all_user')}}">Quay lại trang user</a>
    <header class="panel-heading">
        PERMISSION
    </header>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
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
                Vai trò hiện tại:
                @if(isset($name_roles))
                <b>{{$name_roles}}</b>
                @endif
                <br />
                <hr>
                <h5>Permission</h5>
                <form action="{{route('assign_permission')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="user_id">

                    @foreach($permission as $val)

                    <input id="{{$val->id}}" type="checkbox" value="{{$val->id}}" name="permissions[]"
                        @foreach($hasPermission as $per) {{ $per->id==$val->id ? 'checked' : '' }} @endforeach>
                    <label for="{{$val->id}}">{{$val->name}}</label><br>
                    @endforeach
                    <input type="submit" class="btn btn-success" value="Submit">
                    <a class="btn btn-danger" href="{{route('delete_permission', $user->id)}}">Delete all
                        permissions</a>
                </form>
            </div>





        </div>
</section>















@endsection