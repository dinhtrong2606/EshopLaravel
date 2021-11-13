@extends('pages.product.layout_detail')
@section('main_content')

<section id="form">
	<!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
				@endif
				<div class="login-form">
					<!--login form-->
					<h2>Đăng nhập tài khoản</h2>
					<form action="{{route('login-account')}}" method="POST">
						@csrf
						<input name="email_account" type="email" placeholder="Địa chỉ email" />
						<input name="password_account" type="password" placeholder="Mật khẩu" />
						<button name="submit" type="submit" class="btn btn-default">Đăng nhập</button>
					</form>
				</div>
				<!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">Hoặc</h2>
			</div>
			<div class="col-sm-4">
				@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
				@endif
				<div class="signup-form">
					<!--sign up form-->
					<h2>Tạo tài khoản mới!</h2>
					<form action="{{url('/login-customer')}}" method="POST">
						@csrf
						<input name="customer_name" type="text" placeholder="Name" />
						@error('customer_name')
						<span class="text-danger mt-2">{{$message}}</span>
						@enderror

						<input name="customer_email" type="customer_email" placeholder="Email Address" />
						@error('customer_email')
						<span class="text-danger mt-2">{{$message}}</span>
						@enderror

						<input name="customer_password" type="password" placeholder="Password" />
						@error('customer_password')
						<span class="text-danger mt-2">{{$message}}</span>
						@enderror

						<input type="text" name="customer_phone" placeholder="Phone" />
						@error('customer_phone')
						<span class="text-danger mt-2">{{$message}}</span>
						@enderror

						<button type="submit" class="btn btn-default">Đăng kí</button>
					</form>
				</div>
				<!--/sign up form-->
			</div>
		</div>
	</div>
</section>
<!--/form-->

@endsection