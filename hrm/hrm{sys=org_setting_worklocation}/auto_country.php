
<?php  
  include "../../application/session/session.php";

  
  if(isset($_POST["query"])){
    $key = $_POST['query'];
    $query = mysqli_query($connect, "SELECT * FROM tgemcountry WHERE country_name LIKE '%$key%' LIMIT 10");
    $output = '';
    $output = '<ul class="list-group">';
    
      while ($row = mysqli_fetch_assoc($query)) {
        $output .= '<li id="licountry" id1='.$row["country_id"].' class="list-group-item">'.$row["country_name"].'</li>';  
      }
   
    $output .= '</ul>';
    echo $output;
  }
?>