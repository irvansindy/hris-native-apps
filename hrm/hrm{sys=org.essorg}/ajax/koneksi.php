<?php
// Membuat variabel, ubah sesuai dengan nama host dan database pada hosting 
$host	= "localhost";
$user	= "gthrisco_tmdev";
$pass	= "P@yr0ll009ksf9090srsAsq12a";
$db	    = "gthrisco_tmdev";

//Menggunakan objek mysqli untuk membuat koneksi dan menyimpan nya dalam variabel $mysqli	
$mysqli = new mysqli($host, $user, $pass, $db);

?>