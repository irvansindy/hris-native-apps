<?php include "../../../application/config.php";?>
<?php
if(isset($_POST["action_domisili"]))
{
 $output = '';
 if($_POST["action_domisili"] == "domisili_country")
 {
  $query = "SELECT state_id,state_name FROM tgemstate WHERE country_id = '".$_POST["query"]."' GROUP BY state_name";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Pilih Provinsi</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["state_id"].'">'.$row["state_name"].'</option>';
  }
 }
 if($_POST["action_domisili"] == "domisili_state")
 {
  $query = "SELECT city_id,city_name FROM tgemcity WHERE state_id = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Pilih Kota / Kabupaten</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["city_id"].'">'.$row["city_name"].'</option>';
  }
 }
 if($_POST["action_domisili"] == "domisili_city")
 {
  $query = "SELECT district_id,district_name FROM tgemdistrict WHERE city_id = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Pilih Kecamatan</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
  }
 }
 if($_POST["action_domisili"] == "domisili_district")
 {
  $query = "SELECT subdistrict_id,subdistrict_name FROM tgemsubdistrict WHERE district_id = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Pilih Kelurahan</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["subdistrict_id"].'">'.$row["subdistrict_name"].'</option>';
  }
 }
 echo $output;
}
?>