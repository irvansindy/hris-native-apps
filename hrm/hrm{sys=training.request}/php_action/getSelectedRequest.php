<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

$memberId = $_POST['member_id'];

$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
$get_data_print_0    = $get_data_0['position_id'];

$sql = "SELECT
			a.*,
			CONCAT(a.training_venue , ' - ' , b.venuename) as venues,
			CONCAT(a.training_category , ' - ' , c.categoryname) as sel_categoryname

		FROM trnmrequest a 
		LEFT JOIN trnvenue b ON a.training_venue=b.venue_code
		LEFT JOIN trnmcategory c ON c.parent_code=a.training_category
		WHERE a.request_no = '$memberId'
		GROUP BY a.request_no";
		

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);