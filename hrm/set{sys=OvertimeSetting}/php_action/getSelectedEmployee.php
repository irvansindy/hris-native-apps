<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

$_SESSION["favcolor"] = "green";
$dataon = $_SESSION["favcolor"];


//$memberId = 'DO170048';

$sql = "SELECT 
			a.*,
			(SELECT 
			GROUP_CONCAT(step , ' Hours x ' , value ORDER BY factor_no ASC SEPARATOR ', ') AS factor_no
								FROM hrmovertimefactor
								WHERE overtime_code=a.overtime_code
								GROUP BY overtime_code) as factor
			FROM hrmovertime a
		WHERE a.overtime_code = '$memberId'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

