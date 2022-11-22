<?php
include('config2.php');

$con=mysqli_connect($server,$username,$password,$db);
if($con)
{
    $userid		= $_GET['userid'];
    $SFdate          = date("Y-m-d");

    // $userid='13-0299';
    
	$selectQuery="SELECT b.nama,b.latitude,a.*,
				'0' AS starttimeq,
				'1'AS endtimeq
				from 
				hrdattendance a 
				LEFT JOIN view_employee c on a.emp_id=c.emp_id       
				LEFT JOIN users b on c.emp_no = b.username 
				
				where c.emp_no = '$userid'
				and a.dateforcheck = '$SFdate'" ;
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