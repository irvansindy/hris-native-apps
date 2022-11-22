<?php
// Membuat variabel, ubah sesuai dengan nama host dan database pada hosting 
$host	= "localhost";
$user	= "root";
$pass	= "";
$db	    = "tmdev";

//Menggunakan objek mysqli untuk membuat koneksi dan menyimpan nya dalam variabel $mysqli	
$mysqli = new mysqli($host, $user, $pass, $db);

?>