<?php 
$username = "creatifk_agum";
$password = "agum130366";
$server ="localhost";
$db="creatifk_agum";

$con = mysqli_connect($server,$username,$password,$db);
if($con){
$userid=$_POST['userid'];
$distance = $_POST['distance'];
    
    $updateQuery="update teomdistance set distance_km='$distance' where id='$userid'" ;
	$result=$con->query($updateQuery);
			if($result)
			{
				 $con->close();
				echo "updated successfully";	
			}
			else
			{ $con->close();
				echo "could not update";
			}
           
}
else
{
    echo "database connection failed";
}

?>