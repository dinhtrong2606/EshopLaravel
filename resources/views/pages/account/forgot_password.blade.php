<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Yinka Enoch Adedokun">
        <meta name="description" content="Simple Forgot Password Page Using HTML and CSS">
        <meta name="keywords" content="forgot password page, basic html and css">
        <link type="text/css" rel="stylesheet" href="{{url('frontend/css/forgot_password.css')}}">
        <title>Forgot Password Male_Fashion</title>
    </head>
    <body>
        <div class="row">
            <h1>Forgot Password</h1>
            <h6 class="information-text">Enter your registered email to reset your password.</h6>
            <div class="form-group">
                 @if (session('status'))
				<div class="alert alert-success" role="alert" style="color: #e8234e;font-size: 18px">
					<i>{{ session('status') }}</i>
				</div>
				@endif
                <form action="{{route('confirm_password')}}" method="POST">
                    @csrf
                    <input type="email" name="user_email" id="user_email">
                    <button name="submit" type="submit">Reset Password</button>
                </form>
            </div>
            <div class="footer">
                <h5>Already have an account? <a href="{{route('login-customer')}}">Sign In.</a></h5>
            </div>
        </div>
    </body>
</html>