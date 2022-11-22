<?php 
include('config2.php');

$con = mysqli_connect($server,$username,$password,$db);
if($con){
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $token = $_POST['token'];

    $emailQuery = "select * from users where username= '$email' AND user_status = '1'";
    $idQuery = "select username from users where username= '$email' AND user_status = '1'";
    $query = mysqli_query($con,$emailQuery);
    $emailcount = mysqli_num_rows($query);
    if($emailcount)
    {
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass = $email_pass['password'];

        $pass_decode = password_verify($pass, $db_pass);
        if($pass_decode)
        {
            
            $savetoken="INSERT INTO user_pushnotification_token (`emp_no`, `token`) VALUES ('$email', '$token')";      
            $querys=mysqli_query($con,$savetoken);

	    $idquery = mysqli_query($con,$idQuery);	
		$userid;
		$response=array();
			if($idquery->num_rows>0)
			{
				
				while($row=$idquery->fetch_assoc())
				{
					array_push($response,$row);
					$userid=$row['username'];
				}
			}
            $con->close();
            header('Content-Type: application/json');
            
            
            echo $userid;

            
            
        }
        else
        {
            echo "login not successfull";
        }
    }
    else
    {
        echo "invalid email";
    }
	
}
else
{
    echo "oops database connection failed";
}

?>