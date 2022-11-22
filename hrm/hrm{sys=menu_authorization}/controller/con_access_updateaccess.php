<?php

if (isset($_POST['save'])) {


$emp_no = $_POST['emp_no'];
if(isset($_POST["framework"]))
{
 $framework = '';
 foreach($_POST["framework"] as $row)
 {
  $framework .= substr($row,4,4) . ',';
 }
 $framework = substr($framework, 0, -1);
}
?>

<?php 
if(isset($_POST["framework"]))
{
 $framework_parent = '';
 foreach($_POST["framework"] as $row)
 {
  $framework_parent .= substr($row,0,3) . "','";
 }
 $framework_parent = substr($framework_parent, 0, -1);
}
?>

<?php $delete_before = mysqli_query($connect, "DELETE FROM users_menu_access WHERE emp_no='$emp_no'");  ?>

<?php
$framework_parentparent_conversion = mysqli_query($connect, "SELECT CONCAT(menu_id, ',') as menu_id FROM hrmmenu WHERE module_code IN ('$framework_parent'') and submenu_id='0'");
if (mysqli_num_rows($framework_parentparent_conversion) > 0) { ?>
       <?php while ($row = mysqli_fetch_array($framework_parentparent_conversion)) { ?>

                     <?php $dataPrint = $row['menu_id'].$framework.',' ; ?>

                     <?php
                     $var1 = array(" ");
			$var2 = array("");
			$conversion = str_replace($var1, $var2, $dataPrint); 
                  
                     ?>
                     
                     <?php 
                     if($delete_before) {
                            $insert_after = mysqli_query($connect, "INSERT INTO users_menu_access (emp_no, formula) VALUES ('$emp_no','$conversion')");
                     }
                     ?>
                    
              <?php
              }
       }

       
if($insert_after) {
       echo   "<script type='text/javascript'>
                  window.alert('Successfully Setting Access Menu'); 
                  window.location.replace('../hrm{sys=menu_authorization}/menu_auth_emp?rfid=$emp_no&group_set=emp');         
              </script>";  

      } else {
       echo   "<script type='text/javascript'>
                     window.alert('Something went error');     
              </script>";
      } 
}
?>