<?php

$host 		= "10.132.80.137";
$user 		= "admin";
$port 		= "3306";
$pwd 		= "Admin123";
$dbname 	= "db_gajahtunggal_hris";


$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pwd);

$connect = mysqli_connect($host, $user, $pwd, $dbname);
if (mysqli_connect_errno()){
	echo "we are sorry your connection is failed" . mysqli_connect_error();
}
?>