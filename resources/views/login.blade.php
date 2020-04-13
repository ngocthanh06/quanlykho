<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{asset('qlk')}}/">
    <title>Quản lý kho| Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 style="margin-left: -110px" class="logo-name">QLKho</h1>

            </div>
            <h3>Chào mừng đến trang đăng nhập</h3>
            <p>Đăng nhập để được truy cập vào tài khoản.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            @include('Admin.errors.note')
            <p>Đăng nhập.</p>
            <form class="m-t" role="form" action="" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Quên mật khẩu?</small></a>
                <p class="text-muted text-center"><small>Bạn không có tài khoản?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Tạo tài khoản</a>
            </form>
            <p class="m-t"> <small>&copy; 2020</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
