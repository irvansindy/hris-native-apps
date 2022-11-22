





<?php 
date_default_timezone_set('Asia/Bangkok'); 

include 'config.php';

$datetime		    = date('Y-m-d H:i:s');
$date   		    = date('Y-m-d');
$dateprint 		    = date('d M Y');
$time   		    = date('h:i:s');
$request	        = date('Ydhis');

$requestno          = "ATD".$request;

$con=mysqli_connect($server,$username,$password,$db);
if($con)
{
  
  
	$userid=$_POST['userid'];
	$username = $_POST['name'];
	// $email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
 
	

	
    	$insertQuery="UPDATE user set address='$address',mobile='$mobile' where id = '$userid'";
           
            $result=mysqli_query($con,$insertQuery);
            if($result)
            {
                echo "updated successfully";
            }
            else
            {
            	 echo "could not update";

            }
   }

  	
?>