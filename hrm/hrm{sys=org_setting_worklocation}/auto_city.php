
<?php  
  include "../../application/session/session.php";

  $state_id   = $_POST['state_id'];
  
  if(isset($_POST["state_id"])){
    


    $query = mysqli_query($connect, "SELECT * FROM tgemcity WHERE state_id = '$state_id'");
    $output = '';
    $output .= '<option value="">-- Select one --</option>';
    
      while ($row = mysqli_fetch_assoc($query)) {
        $output .= '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';  
      }
   

    echo $output;
  }
?>