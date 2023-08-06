<?php
session_start();
include ('../config/connection.php');

$query = mysqli_query($con,"SELECT sum(umur>5 AND umur<=10) as a,sum(umur>=11 AND umur<=17) as b,sum(umur>=18 AND umur<=35) as c FROM `pendaftar` WHERE `is_anggota`=0") or die(mysqli_error($con));
$row = mysqli_fetch_array($query);
$chartData = [
    [0,$row['a']],
    [1,$row['b']],
    [2,$row['c']]
];
echo json_encode($chartData);

?>