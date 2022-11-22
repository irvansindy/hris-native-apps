<?php
if(isset($_POST['get_option']))
{
    include "../../../application/config.php";

 $state = $_POST['get_option'];
 $find=mysqli_query($connect, "SELECT * FROM hrmttamshiftgroup WHERE shiftgroupcode ='$state'");
 while($row=mysqli_fetch_array($find))
 {
  for ($x = 1; $x <= $row['totaldays']; $x++) {
    echo "<option>".$x."</option>";
  }
 }
 exit;
}
