<?php 
include "../../application/config.php";
$selected = "";
if($_POST['id']){
	$id=$_POST['id'];
	if($id=='0'){
		echo "<option>Select Reason</option>";
		}else{
			echo "<option value='NULL'>--Select Reason--</option>";
			$sql = mysqli_query($connect,"SELECT * FROM hrmleaveurgreason WHERE leave_code='$id'");
			while($row = mysqli_fetch_array($sql)){
				
				echo '<option value="'.$row['reason_code'].'">'.$row['reason_name'].'</option>';
				}
			}
		}
?>