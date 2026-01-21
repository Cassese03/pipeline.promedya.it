

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pipeline Login | Promedya SRL</title>

    <link rel="shortcut icon" href="<?php echo URL::asset('logo_promedya.png') ?>">
    <link rel="apple-touch-icon" sizes="128x128" href="<?php echo URL::asset('logo_promedya.png') ?>">
    <link rel="apple-touch-icon" sizes="192x192" href="<?php echo URL::asset('logo_promedya.png') ?>">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('plugins/iCheck/square/blue.css') ?>">
    <link rel="stylesheet" href="<?php echo URL::asset('css/custom-design.css') ?>">

    <style>
        .login-page {
            background: linear-gradient(135deg, #4366F6 0%, #14B8A6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-page::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        
        .login-box {
            width: 420px;
            position: relative;
            z-index: 10;
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-box-body {
            background: white !important;
            border-radius: 1rem !important;
            /* padding: 3rem 2.5rem !important; */
        }
        
        .login-logo-img {
            transition: transform 0.3s ease;
            /* filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1)); */
            border-radius: 10px!important;
        }
        
        .login-logo-img:hover {
            transform: scale(1.05);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-control {
            border: 2px solid #E2E8F0;
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.2s;
            background: #FFFFFF;
            height: 50px;
        }
        
        .form-control:focus {
            border-color: #4366F6;
            box-shadow: 0 0 0 4px rgba(67, 102, 246, 0.1);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #94A3B8;
        }
        
        .form-control-feedback {
            color: #64748B;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4366F6 0%, #2D4ADE 100%);
            border: none;
            border-radius: 0.75rem;
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.2s;
            box-shadow: 0 4px 6px rgba(67, 102, 246, 0.3);
            width: 100%;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2D4ADE 0%, #4366F6 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(67, 102, 246, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .login-box-msg {
            color: #EF4444;
            font-weight: 500;
            margin-bottom: 1.5rem;
            padding: 0.75rem;
            background: #FEE2E2;
            border-radius: 0.5rem;
            border-left: 4px solid #EF4444;
        }
        
        .privacy-link {
            color: #4366F6;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .privacy-link:hover {
            color: #2D4ADE;
            text-decoration: underline;
        }
        
        .partner-logo {
            margin-top: 1.5rem;
            opacity: 0.9;
            transition: opacity 0.3s;
        }
        
        .partner-logo:hover {
            opacity: 1;
        }
    </style>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-box-body">
        <img class="login-logo-img" style="margin:0 auto;display:block;height: auto;width: 100%;padding:15px"
             src="<?php echo URL::asset('Promedya_Logo_PL.jpg') ?>">
        <br>

        @if(isset($risposta) && $risposta != '')
            <p class="login-box-msg">{{ $risposta }}</p>
        @endif

        <form method="post" enctype="multipart/form-data">
            <div class="form-group has-feedback">
                <input style = "font-size: 15px" type="text" name="username" class="form-control" placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <br>
            <div class="form-group has-feedback">
                <input style = "font-size: 15px" type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            
            <div class="row" style="margin-bottom: 1rem;">
                <div class="col-xs-8">
                    <a href="/privacy" class="privacy-link">
                        <i class="fa fa-shield"></i> Policy e Informative
                    </a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block" name="login" value="Login" style="font-size: 1rem; padding: 0.875rem;">
                </div>
            </div>
            

            <img class="partner-logo" style="margin:0 auto;display:block;height: auto;width: 100%;padding:15px"
                 src="<?php echo URL::asset('LogoWkiPartner.png') ?>">

            <p style="text-align: center; color: #64748B; font-size: 15px; margin-top: 1.5rem;">
                Copyright © <?php echo date('Y'); ?> <strong>Softmaint</strong> | IT 07374571219
            </p>
      </form>
    </div>
</div>

<script src="<?php echo URL::asset('bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo URL::asset('plugins/iCheck/icheck.min.js') ?>"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    });
</script>
</body>
</html>
