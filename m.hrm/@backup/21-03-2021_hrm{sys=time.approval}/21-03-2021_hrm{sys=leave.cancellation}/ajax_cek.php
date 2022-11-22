<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>


<?php 

if(empty($_GET['modal_emp'])){
       $nip = '';
} else {
       $nip = $_GET['modal_emp'];
       $qPosEmp    = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
}


$query = mysqli_query($connect, "select 
                                   a.emp_no,
                                   a.Full_Name as full_name
                                   from 
                                   view_employee a
                                   LEFT JOIN tclcreqappsetting_final b on a.pos_code=b.position_id
                                   LEFT JOIN tclcreqappsetting_final_fantasy_final c on b.seq_id=c.seq_id
                                   LEFT JOIN teodempcompany d on a.emp_id=d.emp_id
                                   WHERE (c.position_id='$qPosEmp[position_id]' or a.position_id = '$qPosEmp[position_id]')
                                   and d.`status` = '1'
                                   and a.emp_no = '$nip'");

$hrs = mysqli_fetch_array($query);

$data = array(
            'nama'          =>  $hrs['full_name'],
            'nik'           =>  $hrs['emp_no']);
 echo json_encode($data);
?>