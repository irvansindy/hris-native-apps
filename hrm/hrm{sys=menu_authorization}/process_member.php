<?php include "../../application/session/session.php";?>
<?php
$access_code        = $_POST['access_code'];
$formula            = addslashes($_POST['formula']);

if(isset($_POST["framework"]))
{
 $framework = '';
 foreach($_POST["framework"] as $row)
 {
  $framework .= mysqli_query($connect, "INSERT INTO users_menu_access (`emp_no`, `formula`, `is_acccessgroup_use`) VALUES ('$row','$formula','$access_code')") . ';';
 }
 $framework = substr($framework, 0, -1);
 echo $framework;
}
?>