<?php
include '../config2.php';

$userid=$_GET['userid'];

$queryResult=$con->query("
SELECT 
*
FROM ttadpayslip
WHERE emp_no='$userid' 
ORDER BY created_date DESC");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}

echo json_encode($result);

?>
