
<?php 
include('config2.php');

$con = mysqli_connect($server,$username,$password,$db);
if($con)
{
	$selectQuery="select * from hrmnews limit 1 " ;
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
            
            $msg = "ada kali";
      
            header('Content-Type: application/json');
            echo json_encode($response);
            
}
else
{
	echo "connection failed";
}


?>