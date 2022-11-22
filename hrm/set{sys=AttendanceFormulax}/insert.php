<?php
if (isset($_POST['submitformula'])) {

	$formula1 = addslashes($_POST['formula1']);
       // $name=$_POST['name'];
	// $email=$_POST['email'];
	// $phone=$_POST['phone'];
	// $city=$_POST['city'];
	// $sql = "INSERT INTO `debug`( `name`, `last_name`) 
	// VALUES ('$name','$email')";

       $delete = mysqli_query($connect, "DELETE FROM hrmattformula_dev");
       for($iemg=0;$iemg<count($_POST['formula1']);$iemg++){
		$iemg_plus = $iemg+1;
		$formula1s	= addslashes($_POST['formula1'][$iemg]);
		
		if($formula1!==''){
		       $sql = mysqli_query($connect, "INSERT INTO `hrmattformula_dev`(`company_id`,`process_order`,`attformula`) VALUES ('15432','$iemg_plus','$formula1s')");

                     echo "<script type='text/javascript'>
                            $(document).ready(function(){
                                   modals.style.display = 'block';
                                   document.getElementById('msg').innerHTML = 'Formula has been update';
                                   return false;
                            });
                            window.setTimeout(function () {
                                   location.href = '../set{sys=AttendanceFormula}/';
                               }, 100);
                            </script>";
		}
	}
	mysqli_close($connect);
}
?>