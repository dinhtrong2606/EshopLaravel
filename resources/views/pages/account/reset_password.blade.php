<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('frontend/css/reset_password.css')}}" type="text/css">
    <title>Document</title>
</head>
<body>
    <div class="mainDiv">
        <div class="cardStyle">
            <form action="{{url('/save-new-password')}}" method="POST" name="signupForm" id="signupForm">
                @csrf
                <img src="" id="signupLogo" />
                <h2 class="formTitle">
                    Reset Password
                </h2>
                <div class="inputDiv">
                    <label class="inputLabel" for="password">New Password</label>
                    <input type="password" id="password" name="password" required>
                    <input type="hidden" name="customer_id" value="{{$customer_id}}">
                </div>
                <div class="inputDiv">
                    <label class="inputLabel" for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword">
                </div>
                <div class="buttonWrapper">
                    <button type="submit" id="submitButton" onclick="validateSignupForm()" class="submitButton pure-button pure-button-primary">
                        <span>Continue</span>
                        <span id="loader"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script src="{{url('frontend/js/reset_password.js')}}"></script>