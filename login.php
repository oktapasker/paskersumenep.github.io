<?php
    session_start();
    include ('config/fungsi.php');
    include ('config/connection.php');

    if(isset($_POST['cek_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) && empty($password)){
            $msg = 'Harap isi username dan password';
        }else{
            $user = mysqli_query($con,"SELECT * FROM users WHERE user_name='$username'") or die(mysqli_error($con));
            if(mysqli_num_rows($user)!=0){
                $data = mysqli_fetch_array($user);
                if($data['is_active']==1){
                    if(password_verify($password,$data['user_password'])){
                        $_SESSION['iduser'] = $data['idusers'];
                        $_SESSION['username'] = $data['user_name'];
                        $_SESSION['fullname'] = $data['user_fullname'];
                        $_SESSION['bio'] = $data['user_bio'];
                        $_SESSION['akses'] = $data['user_type'];
                        header("Location:".$base_url);
                    }else{
                        $msg = 'Password anda salah';
                    }
                }else{
                    $msg = 'Akun anda sudah tidak aktif';
                }
            }else{
                $msg = 'Username tidak terdaftar';
            }
        }
        $_SESSION['msg'] = $msg;
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Login</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=$base_url;?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=$base_url;?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=$base_url;?>/assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=$base_url;?>/assets/dist/css/AdminLTE.min.css">

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

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Login Here</b>
            <!-- <p style="font-size:10pt;">Please type your Username and Password</p> -->
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <?php if(isset($_SESSION['msg'])):?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$_SESSION['msg'];?>
            </div>
            <?php endif; unset($_SESSION['msg']);?>
            <p class="login-box-msg">Please enter your username and password !</p>

            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username" autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="cek_login">Login</button>
            </form>
<br><center><p>Created by <a href='' title='' target='_blank'>RMS</a></p></center>

            <!-- <a href="#">I forgot my password ?</a><br>
            Not ready account ?<a href="" class="text-center"> Register here</a> -->

        </div>
        <a href="<?=$base_url;?>" class="btn btn-info btn-xs btn-block btn-flat">Back To Website</a>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?=$base_url;?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?=$base_url;?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>


</html>