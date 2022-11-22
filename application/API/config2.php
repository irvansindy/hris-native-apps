<?php
// $server 		= "localhost";
// $username 		= "root";
// $port 		    	= "3306";
// $password 		= "Admin123";
// $db 	        = "dbhris_hr_gajahtunggal_secondary_training";

// $server 			= "localhost";
// $username 			= "gthrisco";
// $port 				= "3306";
// $password 			= "il!4Pj39";
// $db 				= "gthrisco_tm";

// $server 			= "localhost";
// $username 			= "root";
// $port 				= "3306";
// $password 			= "";
// $db 				= "hrdstudio_company_dbsfbiznet";

$server 			= "presfst.com";
$username 			= "presfstc_tm1";
$port 				= "3306";
$password 			= "1kMar2*72";
$db 				= "presfstc_tm1";

$pdo = new PDO('mysql:host='.$server.';dbname='.$db, $username, $password);

//index.php
$con = mysqli_connect($server, $username, $password, $db);
if (mysqli_connect_errno()){
	echo "we are sorry your connection is failed" . mysqli_connect_error();
}

error_reporting(0);
?>