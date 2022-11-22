<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}


//variabel nim yang dikirimkan form.php
$nim = $_GET['nim'];

//mengambil data
$query = mysqli_query($connect, "SELECT * FROM hrmttamshiftdaily WHERE shiftdailycode='$nim'");
$mahasiswa = mysqli_fetch_array($query);
$data = array(
            'company_id1'      =>  @$mahasiswa['company_id'],
            'company_id2'    =>  @$mahasiswa['company_id'],);

//tampil data
echo json_encode($data);
?>