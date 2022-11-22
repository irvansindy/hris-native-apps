<?php 
date_default_timezone_set('Asia/Bangkok'); 

include '../config.php';

$datetime		    = date('Y-m-d H:i:s');
$date   		    = date('Y-m-d');
$dateprint 		    = date('d M Y');
$time   		    = date('h:i:s');
$request	        = date('Ydhis');

$requestno          = "ATD".$request;

$con=mysqli_connect($server,$username,$password,$db);
if($con)
{
  
  
    $id = $_POST['id'];
	$remark = $_POST['remark'];
	$leavedate = $_POST['leavedate'];
	$leaveenddate = $_POST['leaveenddate'];
 
	
	if(empty($id))
	{
          echo "mana datanya";
	}
	else
	{
	
    	$insertQuery="UPDATE ttadleaverequestdetail SET remark='$remark',leavedate='$leavedate',leaveenddate='$leaveenddate' WHERE id='$id'";
           
            $result=mysqli_query($con,$insertQuery);
            if($result)
            {
                echo "Item added to cart";
            }
            else
            {
            	 echo "Sorry could add to cart";

            }
   }
}
  	
  

else
{
	echo "database connection failed";
}

?>