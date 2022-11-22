<?php
$username="creatifk_agum";
$pass="agum130366";
$db="creatifk_agum";
$server="localhost";



$con=mysqli_connect($server,$username,$pass,$db);
if($con)
{
	$selectQuery="select * from ttadattendance where form_attendance = '1'" ;
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