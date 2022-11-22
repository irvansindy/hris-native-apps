
<?php  
  include "../../application/session/session.php";

  
  if(isset($_POST["state_id"])){
    $key = $_POST['state_id'];
    $query = mysqli_query($connect, "SELECT * FROM tgemcity a WHERE a.state_id = '$key'");
    $output = '';
    $output .= '<option value="0">-- Select City --</option>';
      while ($row = mysqli_fetch_assoc($query)) {
        $output .= '<option value="'.$row["city_id"].'">'.$row["city_name"].'</option>';  
      }
   
    echo $output;
  }
?>