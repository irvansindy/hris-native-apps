<?php  
include '../../application/config.php';
if(isset($_POST["query"])){
    $output = '';
    $key = $_POST["query"];
    $query = mysqli_query($connect, "SELECT * FROM view_employee WHERE emp_no LIKE '%$key%' OR Full_Name LIKE '%$key%' LIMIT 10");
    $output = '<ul class="list-unstyled title_ul">';
    if(mysqli_num_rows($query) > 0){
      while ($row = mysqli_fetch_array($query)) {
        $output .= '<li class="title_li" onclick="myFunction()">'.$row["Full_Name"].' [ '.$row["emp_no"].' ]</li>';
      }
    } else {
      $output .= '<li class="title_li">Invalid lookup</li>';
    }
    $output .= '</ul>';
    echo $output;
}
?>  
 <script>
function myFunction() {
  alert("I am an alert box!");
       // $('#CreateFormSPVUP').modal('hide');
       // $('.modal-backdrop').remove();
}
</script>
