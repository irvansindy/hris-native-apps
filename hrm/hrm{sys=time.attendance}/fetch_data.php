<?php include "../../application/session/session.php";?>

<?php
if(isset($_POST['get_option']))
{
 

 $state = $_POST['get_option'];
 $find=mysqli_query($connect, "select reason_name from hrmleaveurgreason where reason_code='ANL'");
 while($row=mysql_fetch_array($find))
 {
  echo "<option>".$row['reason_name']."</option>";
 }
 exit;
}
?>