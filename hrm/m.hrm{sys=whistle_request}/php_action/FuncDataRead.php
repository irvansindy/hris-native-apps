<?php 
require_once '../../../application/config.php';

$user = $_GET['user'];


$output = array('data' => array());

$sql = "SELECT 
a.*
FROM view_employee a

ORDER BY a.Full_name asc";

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<img src="../../asset/emp_photos/'.$row['photo'].'" alt="user" class="profile-pic rounded-circle" width="30"> <a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: orange; border: 5px; cursor:pointer;font-weight: bold;font-size: 13px;" onclick="editMember(`'.$row['emp_no'].'`)">'.$row['emp_id'].'</a>  <br> <label style="padding-top: 4px;color: #A5B0B7 !important;">'.$row['Full_Name'].' </label>';

	$output['data'][] = array(
		$rmintf
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP