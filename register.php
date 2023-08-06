<?php
    session_start();
    include ('config/fungsi.php');
    include ('config/connection.php');

    if(isset($_POST['buat_akun'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $cek = mysqli_query($con,"SELECT * FROM users WHERE user_name='$username'") or die(mysqli_error($con));
        if(mysqli_num_rows($cek)==0){
            $insert = mysqli_query($con,"INSERT INTO users (idusers, user_name, user_fullname, user_type, user_password, is_active) VALUES ('','$username','$fullname','member','$password',1)") or die (mysqli_error($con));
            $msg = 'Berhasil membuat akun baru. Silahkan login <a href="login.php">di sini</a>';
        }else{
            $msg = 'Maaf, Username sudah ada pada sistem';
        }
        $_SESSION['msg'] = $msg;
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pendaftaran Akun Baru</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=$base_url;?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=$base_url;?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=$base_url;?>/assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=$base_url;?>/assets/dist/css/AdminLTE.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Form Daftar Akun</b>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <?php if(isset($_SESSION['msg'])):?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$_SESSION['msg'];?>
            </div>
            <?php endif; unset($_SESSION['msg']);?>
            <p class="login-box-msg">Silahkan lengkapi form pendaftaran akun berikut !</p>

            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="fullname" autofocus
                        required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="buat_akun">Daftar Akun
                    Baru</button>
            </form>
<br><center><p>Creatde by <a href='' title='' target='_blank'>RMS</a></p></center>

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