<?php
$host 		= "localhost";
$user 		= "creatifk_agum";
$port 		= "3306";
$pwd 		= "agum130366";
$dbname 	= "creatifk_agum";



//$host 		= "localhost";
//$user 		= "creatifk_agus";
//$port 		= "3306";
//$pwd 		= "agus.prass9090@Gmail.com";
//$dbname 	= "creatifk_agus";

// $host 		= "10.132.80.137";
// $user 		= "gt-ic";
// $port 		= "3306";
// $pwd 		= "Gt-ic123";
// $dbname 	= "gt-ic";


$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pwd);

$connect = mysqli_connect($host, $user, $pwd, $dbname);
if (mysqli_connect_errno()){
	echo "we are sorry your connection is failed" . mysqli_connect_error();
}


?>

