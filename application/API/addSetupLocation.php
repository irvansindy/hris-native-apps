<?php 
date_default_timezone_set('Asia/Bangkok'); 

include('config.php');

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
  $lat      = $_POST['lat'];
  $long     = $_POST['long'];

  
   

	$query=mysqli_query($con,$checkQuery);
	$check_query_count=mysqli_num_rows($query);
	
	$insertQuery="UPDATE users SET latitude = '$lat' , longlatitude = '$long' WHERE username='$userid'";
           
            $result=mysqli_query($con,$insertQuery);
            if($result)
            {
                echo "Successfully Record Attendance";
            }
            else
            {
            	 echo "Sorry could add to cart";

            }
   }

  

else
{
	echo "database connection failed";
}

?>
