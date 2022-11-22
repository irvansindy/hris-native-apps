<?php 
date_default_timezone_set('Asia/Bangkok'); 

include('../config2.php');

$datetime		      = date('Y-m-d H:i:s');
$date   		      = date('Y-m-d');
$dateprint 		    = date('d M Y');
$time   		      = date('h:i:s');
$request	        = date('Ydhis');

$requestno        = "ATD".$request;

$con = mysqli_connect($server,$username,$password,$db);

if($con)
{
  
  $userid   = $_POST['userid'];
  $data   = $_POST['data'];
	
	$insertQuery="SELECT username,pin FROM users WHERE username = '$userid' and pin = '$data'";
           
            $result=mysqli_query($con,$insertQuery);
            
            if(mysqli_num_rows($result) <> 0)
            {
                echo "Access Granted";
            }
            else
            {
            	 echo "Access Denied";

            }
   }


else
{
	echo "database connection failed";
}

?>