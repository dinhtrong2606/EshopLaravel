<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('frontend/css/login.css')}}" type="text/css">
    <title>Male-Fashion | Template</title>
</head>

<body>
    <div class="col-lg-3 col-md-3" style="margin-right: 80%; margin-top: -40px">
        <div class="header__logo">
            <a href="{{url('/')}}"><img src="{{url('frontend/images/icon/logo.png')}}" alt=""></a>
        </div>
    </div>
    <h2>Sign in/up Form</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{url('/signup-customer')}}" method="POST">
                @csrf
                <h1>Create Account</h1><br>
                @error('customer_name')
                <span class="text-danger mt-2" style="color: red"><i>{{$message}}</i></span>
                @enderror
                <input name="customer_name" type="text" placeholder="Name" value="{{old('customer_name')}}" autocomplete="off"/>

                @error('customer_email')
                <span class="text-danger mt-2" style="color: red"><i>{{$message}}</i></span>
                @enderror
                <input name="customer_email" type="email" placeholder="Email" value="{{old('customer_email')}}" autocomplete="off" />

                @error('customer_phone')
                <span class="text-danger mt-2" style="color: red"><i>{{$message}}</i></span>
                @enderror
                <input type="text" name="customer_phone" placeholder="Phone" value="{{old('customer_phone')}}" autocomplete="off"/>

                @error('customer_password')
                <span class="text-danger mt-2" style="color: red"><i>{{$message}}</i></span>
                @enderror
                <input name="customer_password" type="password" placeholder="Password" value="{{old('customer_password')}}"/>

                @error('customer_repassword')
                <span class="text-danger mt-2" style="color: red"><i>{{$message}}</i></span>
                @enderror
                <input name="customer_repassword" type="password" placeholder="Confirm Password" value="{{old('customer_repassword')}}"/><br>

                <button class="btn-signup" name="submit" type="submit">Sign Up</button>
            </form>
            @if($errors->any())
            <script type="text/javascript" src="{{url('frontend/js/checkSignup.js')}}"></script>
            @endif
        </div>
        <div class="form-container sign-in-container">
            <form action="{{route('login-account')}}" method="POST">
                @csrf
                <h1>Sign in</h1><br>
                @if (session('status'))
				<div class="alert alert-success" role="alert" style="color: red">
					<i>{{ session('status') }}</i>
				</div>
				@endif
                @if (session('success'))
				<div class="alert alert-success" role="alert" style="color: green">
					<i>{{ session('success') }}</i>
				</div>
				@endif
                <input name="email_account" type="email" placeholder="Email" />
                <input name="password_account" type="password" placeholder="Password" />
                <a href="{{url('/forgot-password')}}">Forgot your password?</a>
                <button name="submit" type="submit">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Male Fashion!</h1>
                    <p></p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>You haven't account ? Sign up now :D</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="{{url('frontend/js/login.js')}}"></script>
