
<?php  
  include "../../application/session/session.php";

  
  if(isset($_POST["country_id"])){
    $key = $_POST['country_id'];
    $query = mysqli_query($connect, "SELECT * FROM tgemstate a WHERE a.country_id = '$key'");
    $output = '';
    $output .= '<option value="0">-- Select State --</option>';
      while ($row = mysqli_fetch_assoc($query)) {
        $output .= '<option value="'.$row["state_id"].'">'.$row["state_name"].'</option>';  
      }
   
    echo $output;
  }
?>