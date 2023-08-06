<?php
session_start();
include ('../config/connection.php');

if(isset($_POST['save'])){
    $keterangan = $_POST['keterangan'];
    $time = time();
    $user_id = $_SESSION['iduser'];

    $foto       = $_FILES['foto'];
    $filename    = $_FILES['foto']['name'];
    $filetmp     = $_FILES['foto']['tmp_name'];
    $filesize    = $_FILES['foto']['size'];
    $filetype    = $_FILES['foto']['type'];
    $fileext     = explode('.', $filename);
    $fileactext  = strtolower(end($fileext));
    $allowed    = array('jpg','jpeg','png','gif','bmp');

    if($filename!=""){
        if (in_array($fileactext, $allowed)) {
            if ($filesize<2048000) {
                $filenew = "slide-".date('YmdHis').".".$fileactext;
                $filefolder = '../uploads/'.$filenew;
                
                move_uploaded_file($filetmp, $filefolder);
                $insert = mysqli_query($con,"INSERT INTO slide (idslide, foto_slide, nama_slide, create_at, create_by) VALUES ('','$filenew','$keterangan','$time','$user_id')") or die (mysqli_error($con));
                $msg = 'Berhasil menambahkan data slide';
            }else{
                $msg = "Ukuran foto yang anda upload terlalu besar.";
            }
        }else{
            $msg = "Format foto yang anda upload tidak sesuai.";
        }
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?sett_slide');
}
if(isset($_POST['edit'])){
    $id = $_POST['idslide'];
    $keterangan = $_POST['keterangan'];
    $time = time();
    $user_id = $_SESSION['iduser'];

    $foto       = $_FILES['foto'];
    $filename    = $_FILES['foto']['name'];
    $filetmp     = $_FILES['foto']['tmp_name'];
    $filesize    = $_FILES['foto']['size'];
    $filetype    = $_FILES['foto']['type'];
    $fileext     = explode('.', $filename);
    $fileactext  = strtolower(end($fileext));
    $allowed    = array('jpg','jpeg','png','gif','bmp');

    if($filename!=""){
        if (in_array($fileactext, $allowed)) {
            if ($filesize<2048000) {
                $filenew = "slide-".date('YmdHis').".".$fileactext;
                $filefolder = '../uploads/'.$filenew;
                
                $cek = mysqli_fetch_array(mysqli_query($con,"SELECT foto_slide FROM slide WHERE idslide='$id'")) or die(mysqli_error($con));
                if($cek['foto_slide']!=''){
                    unlink('../uploads/'.$cek['foto_slide']);
                }
                move_uploaded_file($filetmp, $filefolder);
                $update = mysqli_query($con,"UPDATE slide SET foto_slide='$filenew', nama_slide='$keterangan', update_at='$time', update_by='$user_id' WHERE idslide='$id'") or die (mysqli_error($con));
                $msg = 'Berhasil mengubah data slide';
            }else{
                $msg = "Ukuran foto yang anda upload terlalu besar.";
            }
        }else{
            $msg = "Format foto yang anda upload tidak sesuai.";
        }
    }else{
        $update = mysqli_query($con,"UPDATE slide SET nama_slide='$keterangan', update_at='$time', update_by='$user_id' WHERE idslide='$id'") or die (mysqli_error($con));
        $msg = 'Berhasil mengubah data slide';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?sett_slide');
}
if (isset($_GET['id'])!="") {
    $id = $_GET['id'];$cek = mysqli_fetch_array(mysqli_query($con,"SELECT foto_slide FROM slide WHERE idslide='$id'")) or die(mysqli_error($con));
    if($cek['foto_slide']!=''){
        unlink('../uploads/'.$cek['foto_slide']);
    }
    $query = mysqli_query($con, "DELETE FROM slide WHERE idslide='$id'")or die(mysqli_error($con));
    if ($query) {
        $msg = "Data slide berhasil dihapus";
    }else{
        $msg = "Data slide gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?sett_slide');
}
?>