<?php

$username = "creatifk_agum";
$password = "agum130366";
$server ="localhost";
$db="creatifk_agum";


$con=mysqli_connect($server,$username,$password,$db);
if($con)
{
	$category=$_GET['category'];
// 	$selectQuery="select * from fooditem where category='$category'" ;
    $selectQuery="select * from fooditem where category='$category'" ;
	$result=$con->query($selectQuery);
	$response=array();
			if($result->num_rows>0)
			{
				
				while($row=$result->fetch_assoc())
				{
					array_push($response,$row);
				}
			}
            $con->close();
            header('Content-Type: application/json');
            echo json_encode($response);
}
else
{
	echo "connection failed";
}


?>