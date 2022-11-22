<?php
include('config.php');



$con=mysqli_connect($server,$username,$password,$db);
if($con)
{
    $userid			=	$_GET['userid'];
	$selectQuery	=	"SEELCT *
						,CASE WHEN distance_flag = 'in' THEN 'In zone' ELSE 'Out zone' END as flag
						,CASE WHEN status = '1' THEN 'Attend IN' ELSE 'Attend Out' END as name 
						FROM ttadattendancetemp 
						WHERE emp_no = '$userid'
						ORDER BY starttime DESC LIMIT 20";
	
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