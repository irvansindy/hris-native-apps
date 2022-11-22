<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<?php 


$selected = "";
if($_POST['id']){
	$id=$_POST['id'];
	if($id=='0'){
		echo "<option>Select Reason</option>";
		}else{
			echo "<option>--Select Reason--</option>";
			$sql = mysqli_query($connect,"SELECT * FROM hrmleaveurgreason WHERE leave_code='$id'");
			while($row = mysqli_fetch_array($sql)){
				
				echo '<option value="'.$row['reason_code'].'">'.$row['reason_name'].'</option>';
				}
			}
		}
?>