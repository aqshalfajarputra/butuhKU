<!DOCTYPE html>
<html>
<head>
    <title>Login | Admin AVI</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
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
<body>

<div class="container">
    <div class="row">
        <h1 class="text-center">Login to Access Admin Page</h1>

        <div class="login-wrap">
            <form action="<?php echo base_url(); ?>user/do_login" class="form-horizontal" role="form" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">
                        UserName</label>
                    <div class="col-sm-9">
                        <input type="text" name="username" class="form-control" id="inputUser" placeholder="UserName"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">
                        Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="inputPsw" name="password" placeholder="Password"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"/> Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group last">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="submit" name="submit" value="LOGIN" class="btn btn-block btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>
