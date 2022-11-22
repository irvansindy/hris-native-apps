<?php
include '../config.php';


$queryResult=$con->query("
SELECT * FROM `teomcalendar` WHERE year = '2020'");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}

echo json_encode($result);

?>
