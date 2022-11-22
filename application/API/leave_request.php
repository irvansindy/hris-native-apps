<?php 
date_default_timezone_set('Asia/Bangkok'); 

$username = "creatifk_agum";
$password = "agum130366";
$server ="localhost";
$db="creatifk_agum";

$con=mysqli_connect($server,$username,$password,$db);
if($con)
{
  $image=$_FILES['image']['name'];
  $title=$_POST['title'];
  $categoryname=$_POST['category'];
  $description=$_POST['description'];
  $price=$_POST['price'];
  $discount=$_POST['discount'];
  $imagePath='uploads/'.$image;
  $tmp_name=$_FILES['image']['tmp_name'];
  // $_FILES['image']['name']
  move_uploaded_file($tmp_name, $imagePath);

  $insertQuery="insert into leaverequest(name) values ('ada')";
 // $insertQuery="insert into leaverequest(name,imagepath,category,price,discount,description) values ('$title','$image','$category','$price','$discount','$description')";
           
            $result=mysqli_query($con,$insertQuery);
            if($result)
            {
                echo "Data registered succcessfully";
            }
            else
            {
            	 echo "Data not registered succcessfully";

            }
  // $con->query("insert into fooditem(name,imagepath,category,price,discount,description) values ('$title','$image','$category','$price','$discount','$description')");
}
else
{
	echo "database connection failed";
}

?>