<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{url('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <style>
    body {
        background-color: #b8aead;
        box-sizing: border-box;
    }

    .wrapper {
        margin-left: 37%;
    }

    .wrapper img {
        border-radius: 10px;
        box-shadow: #ebe0df;
    }
    </style>
    <div class="col">
        <a class="btn btn-primary" style="margin-top: 5px;" href="{{route('trang-chu')}}">Quay trở lại trang chủ</a>
    </div>
    <div class="wrapper">
        <img width="350" height="200" src="{{url('frontend/images/9161b520e9f886f994f3fc8ee3e2b357.jpg')}}" alt="">
        <h1>Chúng tôi xin lỗi vì sự bất tiện này...</h1>
        <p>Trang bạn tìm thấy hiện không tồn tại. Vui lòng trở lại trang chủ</p>
    </div>

</body>

</html>