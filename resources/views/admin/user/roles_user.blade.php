@extends('admin_layout')
@section('admin_content')
<section class="panel">
    <a style="font-size: 13px;" class="btn btn-danger" href="{{route('all_user')}}">Quay lại trang user</a>
    <header class="panel-heading">
        ROLES
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
                <form action="{{route('assign_roles')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    @foreach($roles as $val)
                    <input id="{{$val->id}}" type="radio" value="{{$val->id}}" name="roles_user"
                        {{$val->id==$all_roles->id ? 'checked' : ''}}>
                    <label for="{{$val->id}}">{{$val->name}}</label><br>
                    @endforeach
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
</section>
@endsection