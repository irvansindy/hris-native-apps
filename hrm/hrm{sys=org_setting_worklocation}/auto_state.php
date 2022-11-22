
<?php  
  include "../../application/session/session.php";

  $country_id   = $_POST['country_id'];
  
  if(isset($_POST["country_id"])){
    


    $query = mysqli_query($connect, "SELECT * FROM tgemstate WHERE country_id = '$country_id'");
    $output = '';
    $output .= '<option value="">-- Select one --</option>';
    
      while ($row = mysqli_fetch_assoc($query)) {
        $output .= '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';  
      }
   

    echo $output;
  }
?>