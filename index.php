<?php
    ob_start();
    session_start();
    include ('config/connection.php');
    include ('config/fungsi.php');
    if($_SESSION['username']=="" && $_SESSION['akses']==""):
        header("Location:home.php");
    else:
        session_timeout();
        include ('config/header.php');
?>

<?php
    if(isset($_GET['backup_app'])){
        $hal = 'proses/backup_app.php';
    }
    else if(isset($_GET['formulir'])){
        $formulir = 'class="active"';
        $hal = 'hal/form/formulir.php';
    }
    else if(isset($_GET['ubah'])){
        $hal = 'hal/form/formulir.php';
    }
    else if(isset($_GET['pendaftar'])){
        $pendaftar = true;
        $hal = 'hal/data/pendaftar.php';
    }
    else if(isset($_GET['detail_pendaftar'])){
        $pendaftar = true;
        $hal = 'hal/data/detail_pendaftar.php';
    }
    else if(isset($_GET['statistik'])){
        $statistik = true;
        $hal = 'hal/data/statistik.php';
    }
    else if(isset($_GET['sett_slide'])){
        $sett_slide = true;
        $hal = 'hal/data/slide.php';
    }
    else if(isset($_GET['sett_informasi'])){
        $sett_info = true;
        $hal = 'hal/data/informasi.php';
    }
    else if(isset($_GET['sett_pengguna'])){
        $sett_pengguna = true;
        $hal = 'hal/data/pengguna.php';
    }
    else{
        $home = true;
        $hal = 'hal/data/dashboard.php';
    }
    include ('config/nav.php');
    include ($hal);
?>
<?php include ('config/footer.php');?>
</body>

</html>
<?php endif;?>