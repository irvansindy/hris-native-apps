<?php
include "../config.php";
$nip = $_POST['nip'];
$password = md5($_POST['password']);
$acc = $_POST['acc'];

$cek = mysql_num_rows(mysql_query("SELECT * FROM users WHERE hak_akses = '$acc'"));
	if ($cek > 0 ) {
$modal=mysql_query("UPDATE users SET password = '$password', login='1' WHERE username = '$nip' and hak_akses = '$acc'");
echo "<script>window.alert('Your data has been saved please Re-Login')	
	window.location='../logout.php'</script>";
	}else{

echo"<script>window.alert('!! PASSWORD invalid Please try again')
	window.location='../logout.php'</script>";
	}
?>