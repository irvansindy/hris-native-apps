<?php  
include '../../application/config.php';
date_default_timezone_set('Asia/Bangkok'); 

	$datetime		    = date('Y-m-d h:i:s');
	$date   		    = date('Y-m-d');
  $year   		    = date('Y');
	$dateprint 		    = date('d M Y');
	$time   		    = date('h:i:s');
  $request	        = date('Ydhis');

if(isset($_POST["query"])){
    $output = '';

    $key0     = $_GET["userid"];
    $key      = $_POST["query"];
    $period   = $_GET["period"];

    $query = mysqli_query($connect, "SELECT * FROM hrmmenu WHERE menu LIKE '%$key%' LIMIT 10");
                                            

   

    $output = '<ul class="list-unstyled job_title_ul">';
    if(mysqli_num_rows($query) > 0){
      while ($row = mysqli_fetch_array($query)) {
          $output .= '<a href='.$row["hyperlink"].'><li class="job_title_li" onclick="myFunction'.$row["menu"].'()">'.$row["menu"].'</li></a>';
        }
      } else {
        $output .= '<li class="job_title_li">Invalid lookup</li>';
      }
      $output .= '</ul>';
    echo $output;
}
?>  


<!-- 