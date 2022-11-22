<?php include "../../../application/config.php";?>
<?php
if(isset($_POST["action_domisili"]))
{
 $output = '';
 if($_POST["action_domisili"] == "settlement_curcountry")
 {
  $query = "SELECT state_id,state_name FROM hrmstate WHERE country_id = '".$_POST["query"]."' GROUP BY state_name";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select State/City</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["state_id"].'">'.$row["state_name"].'</option>';
  }
 }
 if($_POST["action_domisili"] == "settlement_curprovince")
 {
  $query = "SELECT city_id,city_name FROM hrmcity WHERE state_id = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select City</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["city_id"].'">'.$row["city_name"].'</option>';
  }
 }
 if($_POST["action_domisili"] == "settlement_curcity")
 {
  $query = "SELECT district_id,district_name FROM hrmdistrict WHERE city_id = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select District</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
  }
 }
 if($_POST["action_domisili"] == "settlement_curdistrict")
 {
  $query = "SELECT subdistrict_id,subdistrict_name FROM hrmsubdistrict WHERE district_id = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select SubDistrict</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["subdistrict_id"].'">'.$row["subdistrict_name"].'</option>';
  }
 }
 echo $output;
}
?>