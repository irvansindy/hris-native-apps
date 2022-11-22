<?php
//fetch.php

if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "123", "payroll");
 $output = '';
 if($_POST["action"] == "tahap")
 {
  $query = "SELECT nokpt FROM kptrans WHERE tahap = '".$_POST["query"]."' GROUP BY nokpt";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select nokpt</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["nokpt"].'">'.$row["nokpt"].'</option>';
  }
 }
 if($_POST["action"] == "nokpt")
 {
  $query = "SELECT nokpt FROM kptrans WHERE nokpt NOT LIKE '%".$_POST["query"]."%' and GROUP BY nokpt";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select nokpt</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["nokpt"].'">'.$row["nokpt"].'</option>';
  }
 }
 echo $output;
}
?>