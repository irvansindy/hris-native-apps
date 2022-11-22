<?php
	$db = mysqli_connect('localhost','creatifk_flutter','agus.prass9090@gmail.com','creatifk_flutter');
	if (!$db) {
		echo "Database connection faild";
	}

?>


<?php
 
$image = $_POST['image'];
    $name = $_POST['name'];
 
    $realImage = base64_decode($image);
 
    file_put_contents('uploads/'.$name, $realImage);
    move_uploaded_file('uploads/'.$name, $realImage);

	mysqli_query($db, "INSERT INTO ttadattendance_pic(title)VALUES('$name')");
 
	echo "Attendance Record Successfully";
?>