<?php 
require_once '../../../application/config.php';
require_once '../../../application/session/sessionlv2.php';

$memberId = $_POST['request_no_spvup'];
//$memberId = 'PAREQ2022-130299';

$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
$get_data_print_0    = $get_data_0['position_id'];

$get_data_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT ipa_reqno FROM hrmperf_ipprequest WHERE ipp_reqno = '$memberId'"));
$get_data_print_1    = $get_data_1['ipa_reqno'];


//$memberId = 'DO170048';

$sql = "SELECT 
              COUNT(*) AS is_approved_spvup
                     FROM 
              hrmperf_ipprequest a
              WHERE 
                     a.ipp_reqno = '$memberId' AND
                     a.appraisal_status IN ('4','10')";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

