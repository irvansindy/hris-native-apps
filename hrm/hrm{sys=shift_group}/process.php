<?php include "../../application/session/session.php";?>
<?php
$emp_no = $_POST['emp_no'];
if(isset($_POST["framework"]))
{
 $framework = '';
 foreach($_POST["framework"] as $row)
 {
  $framework .= $row . ',';
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
  $framework_parent .= $row . "','";
 }
 $framework_parent = substr($framework_parent, 0, -1);
}
?>

<?php $update_before = mysqli_query($connect, "UPDATE hrmgroupdata SET status_use = '0' WHERE emp_no = '$emp_no'");  ?>


                     <?php 
                     if($update_before) {
                            $insert_after = mysqli_query($connect, "UPDATE hrmgroupdata SET status_use = '1' WHERE emp_no = '$emp_no' and Authorized_User IN ('$framework_parent'')");
                     }
                     ?>
                    

<?php echo "UPDATE hrmgroupdata SET status_use = '1' WHERE emp_no = '$emp_no' and Authorized_User IN ('$framework_parent'')";?>