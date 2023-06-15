<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}


$memberId = $_POST['request_no_spvdown'];
//$memberId = 'PAREQ2022-130299';

$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
$get_data_print_0    = $get_data_0['position_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
              COUNT(*) AS is_approved_spvdown
                     FROM 
              hrmrequestapproval a
              WHERE 
                     a.request_no = '$memberId' AND
                     a.position_id='$get_data_print_0' AND
                     a.status = '1' AND
                     a.request_status IN ('2','3','4','5')";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

