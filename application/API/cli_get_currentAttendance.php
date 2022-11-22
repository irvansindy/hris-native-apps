<?php
include('config.php');

date_default_timezone_set('Asia/Bangkok'); 

       $SFdate                 = date("Y-m-d");

$con=mysqli_connect($server,$username,$password,$db);
if($con)
{
    $userid=$_GET['userid'];
	$selectQuery="SELECT 
						a.emp_id,  
						DATE_FORMAT(a.starttime, '%H:%i:%s') as starttime,
						DATE_FORMAT(a.breaktime, '%H:%i:%s') as breaktime,
						DATE_FORMAT(a.endtime, '%H:%i:%s') as endtime 
					FROM hrdattendance a
					LEFT JOIN view_employee b ON a.emp_id=b.emp_id
					WHERE b.emp_no = '$userid' AND a.dateforcheck = '$SFdate' 
					LIMIT 1" ;
	
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