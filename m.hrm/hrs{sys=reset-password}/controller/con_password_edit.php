<?php

if(isset($_POST["ChgPsw"]))
{
if(empty($_POST["txtPassword"]) || empty($_POST["txtCPassword"]))
 {
  echo "<script type='text/javascript'>
                  window.alert('Successfully Revise Leave Transaction Request');
                  window.location.replace('../hrm{sys=time.attendance}');       
            </script>";
 }
 else
 {

	if($_POST["txtPassword"] != $_POST["txtCPassword"]) 
	 {
		echo "<script type='text/javascript'>
                        window.alert('Successfully Revise Leave Transaction Request');
                        window.location.replace('../hrm{sys=time.attendance}');       
                  </script>";
	} 
	else
	{
	$password = $_POST['txtPassword'];
	
	

		$has = password_hash($_POST['txtPassword'], PASSWORD_DEFAULT);
		$save = $connect->real_query("UPDATE users SET password = '$has', login='1' WHERE username = '$username'");
		if($save) {
			
		echo "
		<script type='text/javascript'>
                        window.alert('Successfully Change Password');
                        window.location.replace('../../application/logout');       
                  </script>";
			
			
		}else{
			
		echo "
		<script type='text/javascript'>
                              window.alert('Something went error');     
                        </script>";
			
		}
	}


	}}

	

?> 