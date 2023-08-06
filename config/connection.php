<?php
    $hostname   = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "dance_community";

    $con = mysqli_connect($hostname, $username, $password, $database) or die (mysqli_error($con));
?>