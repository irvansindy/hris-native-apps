<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}



$memberId = $_POST['request_no'];

//$memberId = 'PAREQ2022-130299';



$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));

$get_data_print_0    = $get_data_0['position_id'];



//$memberId = 'DO170048';



$sql = "SELECT MAX(request_status) AS status_request FROM hrmrequestapproval WHERE request_no = '$memberId'";



		

$query = mysqli_query($connect, $sql);

$result = mysqli_fetch_assoc($query);



$connect->close();



echo json_encode($result);



