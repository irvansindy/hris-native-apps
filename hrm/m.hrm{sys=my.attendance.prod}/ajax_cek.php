<?php 
include "../../application/config.php";
include "../../application/session/sessionlv2.php";

if(empty($_GET['inp_emp'])){
       $nip = '';
} else {
       $nip = $_GET['inp_emp'];
       $qPosEmp    = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
}


$query = mysqli_query($connect, "select 
                                   a.emp_no,
                                   a.Full_Name as full_name
                                   from 
                                   view_employee a
                                   
                                   WHERE a.emp_no = '$nip'");

$hrs = mysqli_fetch_array($query);

$data = array(
            'nama'          =>  $hrs['full_name'],
            'nik'           =>  $hrs['emp_no']);
 echo json_encode($data);
?>