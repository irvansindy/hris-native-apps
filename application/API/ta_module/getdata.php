<?php
include '../config.php';

$userid=$_GET['userid'];

$queryResult=$con->query("
SELECT 
id,
remark,
DATE_FORMAT(leavedate, '%d %b %Y') as leavedate,
DATE_FORMAT(leaveenddate, '%d %b %Y') as leaveenddate,
leavecode 
FROM ttadleaverequestdetail 
WHERE emp_no='$userid' 
ORDER BY created_date DESC");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}

echo json_encode($result);

?>
