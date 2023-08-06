<?php
session_start();
include ('../config/connection.php');

if(isset($_POST['save'])){
    $judul = $_POST['title'];
    $isi = $_POST['content'];
    $time = time();
    $user_id = $_SESSION['iduser'];
    
    $insert = mysqli_query($con,"INSERT INTO informasi (idinfo, judul_info, isi_info, create_at, create_by) VALUES ('','$judul','$isi','$time','$user_id')") or die (mysqli_error($con));
    if($insert){
        $msg = 'Berhasil menambahkan informasi baru';
    }else{
        $msg = 'Gagal menambahkan informasi baru';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?sett_informasi');
}
if(isset($_POST['edit'])){
    $id = $_POST['idinfo'];
    $judul = $_POST['title'];
    $isi = $_POST['content'];
    $time = time();
    $user_id = $_SESSION['iduser'];
    
    $update = mysqli_query($con,"UPDATE informasi SET judul_info='$judul', isi_info='$isi', update_at='$time', update_by='$user_id' WHERE idinfo='$id'") or die (mysqli_error($con));
    if($update){
        $msg = 'Berhasil mengubah data informasi';
    }else{
        $msg = 'Gagal mengubah data informasi';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?sett_informasi');
}
if (isset($_GET['id'])!="") {
    $id = $_GET['id'];
    $query = mysqli_query($con, "DELETE FROM informasi WHERE idinfo='$id'")or die(mysqli_error($con));
    if ($query) {
        $msg = "Data informasi berhasil dihapus";
    }else{
        $msg = "Data informasi gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?sett_informasi');
}
?>