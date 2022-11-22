<?php 
include 'config.php';

$datetime		    = date('Y-m-d H:i:s');
$date   		    = date('Y-m-d');
$dateprint 		    = date('d M Y');
$time   		    = date('h:i:s');
$request	        = date('Ydhis');

$requestno          = "ATD".$request;

$con=mysqli_connect($server,$username,$password,$db);

if($con){

    $selectQuery="select * from teomdistance a" ;
                    
                    
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
    echo "database connection failed";
}

?>