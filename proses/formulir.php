<?php
session_start();
include ('../config/connection.php');
include ('../config/fungsi.php');

if(isset($_POST['save'])){
    $tanggal = date('Y-m-d');
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_pendek = $_POST['nama_pendek'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $umur = hitungUmur($_POST['tanggal_lahir']);
    $jk = $_POST['jk'];
    $hobi = $_POST['hobi'];
    $citacita = $_POST['citacita'];
    $status = $_POST['status'];
    $alamat = $_POST['alamat_lengkap'];
    $nama_ayah = $_POST['nama_lengkap_ayah'];
    $nama_ibu = $_POST['nama_lengkap_ibu'];
    $alamat_ortu = $_POST['alamat_lengkap_ortu'];
    $whatsapp = $_POST['whatsapp'];
    $telegram = $_POST['telegram'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $youtube = $_POST['youtube'];
    $is_anggota = 0;
    $user_id = $_SESSION['iduser'];

    $foto       = $_FILES['foto'];
    $filename    = $_FILES['foto']['name'];
    $filetmp     = $_FILES['foto']['tmp_name'];
    $filesize    = $_FILES['foto']['size'];
    $filetype    = $_FILES['foto']['type'];
    $fileext     = explode('.', $filename);
    $fileactext  = strtolower(end($fileext));
    $allowed    = array('jpg','jpeg','png');

    $cek = mysqli_query($con,"SELECT * FROM pendaftar WHERE user_id='$user_id'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        if($filename!=""){
            if (in_array($fileactext, $allowed)) {
                if ($filesize<1024000) {
                    $filenew = $nama_lengkap."-".date('YmdHis').".".$fileactext;
                    $filefolder = '../uploads/'.$filenew;
                    
                    move_uploaded_file($filetmp, $filefolder);
                    mysqli_query($con,"INSERT INTO pendaftar (idpendaftar,tanggal,foto,nama_lengkap,nama_pendek,tempat_lahir,tanggal_lahir,umur,jk,hobi,citacita,status,alamat,nama_ayah,nama_ibu,alamat_ortu,whatsapp,telegram,facebook,instagram,twitter,youtube,is_anggota,user_id) VALUES ('','$tanggal','$filenew','$nama_lengkap','$nama_pendek','$tempat_lahir','$tanggal_lahir','$umur','$jk','$hobi','$citacita','$status','$alamat','$nama_ayah','$nama_ibu','$alamat_ortu','$whatsapp','$telegram','$facebook','$instagram','$twitter','$youtube','$is_anggota','$user_id')") or die (mysqli_error($con));
                    $msg = 'Formulir pendaftaran anda berhasil di simpan';
                }else{
                    $msg = "Ukuran foto yang anda upload terlalu besar.";
                }
            }else{
                $msg = "Format foto yang anda upload tidak sesuai.";
            }
        }
        // else{
        //     $insert = mysqli_query($con,"INSERT INTO pendaftar (idpendatar,tanggal,nama_lengkap,nama_pendek,tempat_lahir,tanggal_lahir,jk,hobi,citacita,status,alamat,nama_ayah,nama_ibu,alamat_ortu,whatsapp,telegram,facebook,instagram,twitter,youtube,is_anggota,user_id) VALUES ('','$tanggal','$nama_lengkap','$nama_pendek','$tempat_lahir','$tanggal_lahir','$jk','$hobi','$citacita','$alamat','$nama_ayah','$nama_ibu','$alamat_ortu','$whatsapp','$telegram','$facebook','$instagram','$twitter','$youtube','$is_anggota','$user_id')") or die (mysqli_error($con));
        //     $msg = 'Formulir pendaftaran anda berhasil di simpan';
        // }
    }else{
        $msg = 'Mohon maaf, Anda telah melakukan pendaftaran dengan akun ini';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?formulir');
}
if(isset($_POST['ubah'])){
    $id = $_POST['id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_pendek = $_POST['nama_pendek'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $umur = hitungUmur($_POST['tanggal_lahir']);
    $jk = $_POST['jk'];
    $hobi = $_POST['hobi'];
    $citacita = $_POST['citacita'];
    $status = $_POST['status'];
    $alamat = $_POST['alamat_lengkap'];
    $nama_ayah = $_POST['nama_lengkap_ayah'];
    $nama_ibu = $_POST['nama_lengkap_ibu'];
    $alamat_ortu = $_POST['alamat_lengkap_ortu'];
    $whatsapp = $_POST['whatsapp'];
    $telegram = $_POST['telegram'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $youtube = $_POST['youtube'];
    
    $foto       = $_FILES['foto'];
    $filename    = $_FILES['foto']['name'];
    $filetmp     = $_FILES['foto']['tmp_name'];
    $filesize    = $_FILES['foto']['size'];
    $filetype    = $_FILES['foto']['type'];
    $fileext     = explode('.', $filename);
    $fileactext  = strtolower(end($fileext));
    $allowed    = array('jpg','jpeg','png');

    if($filename!=""){
        if (in_array($fileactext, $allowed)) {
            if ($filesize<1024000) {
                $filenew = $nama_lengkap."-".date('YmdHis').".".$fileactext;
                $filefolder = '../uploads/'.$filenew;
                $cek = mysqli_fetch_array(mysqli_query($con,"SELECT foto FROM pendaftar WHERE idpendaftar='$id'")) or die(mysqli_error($con));
                if($cek['foto']!=''){
                    unlink('../uploads/'.$cek['foto']);
                }
                move_uploaded_file($filetmp, $filefolder);
                mysqli_query($con,"UPDATE pendaftar SET foto='$filenew',nama_lengkap='$nama_lengkap',nama_pendek='$nama_pendek',tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir',umur='$umur',jk='$jk',hobi='$hobi',citacita='$citacita',status='$status',alamat='$alamat',nama_ayah='$nama_ayah',nama_ibu='$nama_ibu',alamat_ortu='$alamat_ortu',whatsapp='$whatsapp',telegram='$telegram',facebook='$facebook',instagram='$instagram',twitter='$twitter',youtube='$youtube' WHERE idpendaftar='$id'") or die (mysqli_error($con));
                $msg = 'Data berhasil di ubah';
            }else{
                $msg = "Ukuran foto yang anda upload terlalu besar.";
            }
        }else{
            $msg = "Format foto yang anda upload tidak sesuai.";
        }
    }
    else{
        mysqli_query($con,"UPDATE pendaftar SET nama_lengkap='$nama_lengkap',nama_pendek='$nama_pendek',tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir',umur='$umur',jk='$jk',hobi='$hobi',citacita='$citacita',status='$status',alamat='$alamat',nama_ayah='$nama_ayah',nama_ibu='$nama_ibu',alamat_ortu='$alamat_ortu',whatsapp='$whatsapp',telegram='$telegram',facebook='$facebook',instagram='$instagram',twitter='$twitter',youtube='$youtube' WHERE idpendaftar='$id'") or die (mysqli_error($con));
        $msg = 'Data berhasil di ubah';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?pendaftar');
}
if(isset($_GET['sts'])&& $_GET['id']!=''){
    $id = $_GET['id'];
    mysqli_query($con,"UPDATE pendaftar SET is_anggota=1 WHERE idpendaftar='$id'");
    $msg = 'Status telah berhasil berubah menjandi Member';
    $_SESSION['msg'] = $msg;
    header('Location:../?pendaftar');
}
if (isset($_GET['hapus'])&& $_GET['id']!='') {
    $id = $_GET['id'];
    $cek = mysqli_fetch_array(mysqli_query($con,"SELECT foto FROM pendaftar WHERE idpendaftar='$id'")) or die(mysqli_error($con));
    if($cek['foto']!=''){
        unlink('../uploads/'.$cek['foto']);
    }
    $query = mysqli_query($con, "DELETE FROM pendaftar WHERE idpendaftar='$id'")or die(mysqli_error($con));
    if ($query) {
        $msg = "Data pendaftar berhasil dihapus";
    }else{
        $msg = "Data pendaftar gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?pendaftar');
}
?>