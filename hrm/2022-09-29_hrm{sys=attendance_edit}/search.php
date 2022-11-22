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

    $query = mysqli_query($connect, "SELECT a.emp_no, 
                                            a.Full_Name,
                                            a.pos_name_en,
                                            a.photo
                                                FROM view_employee a 
                   
                                                WHERE 
                                                (a.emp_no LIKE '$key%' OR a.Full_Name LIKE '$key%')
                                            
                                      
                                            
                                            GROUP BY a.emp_no
                                            ORDER BY a.emp_no DESC
                                            LIMIT 10");
                                            

   

    $output = '<ul class="list-unstyled job_title_ul">';
    if(mysqli_num_rows($query) > 0){
      while ($row = mysqli_fetch_array($query)) {
          $output .= '<li class="job_title_li" id="job_title_li" onclick="myFunction'.$row["emp_no"].'()"><img width="30px" src="../../asset/emp_photos/'.$row["photo"].'" alt="Employee">'.$row["position_name_en"].' '.$row["emp_no"].' [ '.$row["Full_Name"].' ] <br><label style="font-size: 8px;color: #646464;">'.$row["pos_name_en"].'</label></li>';
          echo '<script>
            function myFunction'.$row["emp_no"].'() {
                  $("'.$row["functions_contra"].'").hide();
                  $("'.$row["functions"].'").show();
                  $("#box_sp_up").hide();
                  $("#box_sp_up_down").hide();
                  $("#inp_formtype").val("'.$row["functions_type"].'");
            }
            </script>';
        }
      } else {
        $output .= '<li class="job_title_li">Invalid lookup</li>';
      }
      $output .= '</ul>';
    echo $output;
}
?>  


<!-- 