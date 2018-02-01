<!DOCTYPE html>
<html>
<head>
    <title>Login | butuhKu</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/dist/img/Slice_11.png"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/style.css">
    <style media="screen">
        .login-wrap {
            width: 320px;
            margin: 0 auto;
            margin-top: 100px;
            border: 1px solid #eee;
            padding: 15px;
            background: #f8f8f8;
            border-radius: 4px;
        }

        .form-group.last {
            margin-bottom: 0px;
        }
    </style>
</head>
<body class="login-body">

<div class="container">
    <div class="row">


        <div class="login-wrap login">
            <img src="<?php echo base_url(); ?>assets/dist/img/logo.png"
                 style="height: 100px; display: block; margin: 0px auto;">
            <h1 class="text-center login-title">Selamat Datang</h1>
            <br>
            <form action="<?php echo base_url(); ?>user/do_login" class="form-horizontal" role="form" method="post">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" name="username" class="form-control login-input" id="inputUser"
                               placeholder="Username"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" class="form-control login-input" id="inputPsw" name="password"
                               placeholder="Password"
                               required>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"/> Remember me
                            </label>
                        </div>
                    </div>
                </div>-->
                <div class="form-group last">
                    <div class="col-sm-12 col-sm-12">
                        <input type="submit" name="submit" value="LOGIN" class="btn btn-btn btn-update">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>
