

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pipeline Login</title>


    <link rel="shortcut icon" href="<?php echo URL::asset('logo_promedya.png') ?>">
    <link rel="apple-touch-icon" sizes="128x128" href="<?php echo URL::asset('logo_promedya.png') ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo URL::asset('logo_promedya.png') ?>">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('plugins/iCheck/square/blue.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background:#eeeeee;">
<div class="login-box">
    <div class="login-logo">

    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" style="border:1px solid black">

        {{--<img style="margin:0 auto;display:block;height: auto;width: 100%;padding:40px"
             src="<?php echo URL::asset('logo_promedya.png') ?>">--}}
        <img style="margin:0 auto;display:block;height: auto;width: 100%;padding:40px"
             src="<?php echo URL::asset('Promedya_Logo_PL.jpg') ?>">
<br>

        @if(isset($risposta) && $risposta != '')
            <p class="login-box-msg" style="color:red">{{ $risposta }}</p>
        @endif

        <form method="post" enctype="multipart/form-data">
            <div class="form -group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <br>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">

                <div class="col-xs-8">
                    <!--
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                    -->
                <a href="/privacy"> Policy e Informative</a>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Login">
                </div>
                <!-- /.col -->
            </div>

            <img style="margin:0 auto;display:block;height: auto;width: 100%;padding:15px"
                 src="<?php echo URL::asset('LogoWkiPartner.png') ?>">
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="<?php echo URL::asset('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo URL::asset('plugins/iCheck/icheck.min.js') ?>"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
