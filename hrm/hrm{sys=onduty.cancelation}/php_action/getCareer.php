<?php 
require_once '../../../application/config.php';
require_once '../../../application/session/sessionlv2.php';

$employee_pre			= strtoupper($_POST['employee']);

// GET OUTPUT NIP 13-0299 FROM AGUS PRASETYA [ 13-0299 ]
// $memberId 			= substr($employee_pre,-9,-2);
$memberId 			= substr($employee_pre,1,6);
// GET OUTPUT NIP 13-0299 FROM AGUS PRASETYA [ 13-0299 ]

// $get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM view_employee WHERE emp_no = '$memberId'"));
// $get_data_print_0    = $get_data_0['position_id'];
$memberId;
//$memberId = 'DO170048';

$sql = "SELECT a.*,
    (SELECT
    x1.history_no
    FROM hrmemploymenthistory x1 
    WHERE x1.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$memberId')
            AND x1.history_no <> a.history_no
            ORDER BY x1.effectivedt DESC LIMIT 1) as secon
    FROM hrmemploymenthistory a WHERE a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$memberId')
    ORDER BY a.effectivedt DESC LIMIT 1";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();
header('Content-Type: application/json');
echo json_encode($result);

