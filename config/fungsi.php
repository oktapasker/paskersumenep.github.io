<?php
$base_url= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url.= "://".$_SERVER['HTTP_HOST'];
$base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
function session_timeout(){
    //lama waktu 30 menit
    if(isset($_SESSION['LAST_ACTIVITY'])&&(time()-$_SESSION['LAST_ACTIVITY']>1800)){
        session_unset();
        session_destroy();
        header("Location:".$base_url."login.php");
    }$_SESSION['LAST_ACTIVITY']=time();
}
function hitungHari($x,$y){
    $awal = explode("-",$x);
    $akhir = explode("-",$y);
    $date1 = mktime(0, 0, 0, $awal[1],$awal[2],$awal[0]);
    $date2 = mktime(0, 0, 0, $akhir[1],$akhir[2],$akhir[0]);
    $result = ($date2-$date1)/(3600*24);
    return $result;
}
function hitungUmur($tgl_lahir){
    list($year,$month,$day) = explode("-",$tgl_lahir);
    $year_diff = date("Y")-$year;
    $month_diff = date("m")-$month;
    $day_diff = date("d")-$day;
    if($month_diff<0)$year_diff--;
    elseif (($month_diff==0)&&($day_diff<0))$year_diff--;
    return $year_diff;
} 
function hakAkses( array $a){
    $akses = $_SESSION['akses'];
    if(!in_array($akses,$a)){
        header('Location:?dashboard');
    }
}
function hitung($table){
    include($_SERVER['DOCUMENT_ROOT'].'/sip-fapet/config/connection.php');
    $query = mysqli_query($con,"SELECT * FROM $table")or die (mysqli_error($con));
    return number_format(mysqli_num_rows($query));
}