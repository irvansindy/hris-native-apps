<?php
$hostName	= "localhost";
$userName	= "gthrisco_tmdev";
$passWord	= "P@yr0ll009ksf9090srsAsq12a";
$database	= "gthrisco_tmdev";

$masuk = mysqli_connect($hostName,$userName,$passWord, $database) or die('Connection Failed');
// $hore = mysql_select_db($database) or die('Database Failed');
$connect = mysqli_connect($hostName,$userName,$passWord, $database) or die('Connection Failed');
?>