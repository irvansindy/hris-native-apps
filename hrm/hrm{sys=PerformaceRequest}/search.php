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

    $query = mysqli_query($connect, "SELECT x.emp_no, 
                                            x.Full_Name,
                                            x.pos_name_en,
                                            x.photo,
                                            x.history_no,
                                            x.careertransition_code, 
                                            x.careertranstype, 
                                            x.effectivedt,
                                            x.functions,
                                            x.functions_type,
                                            x.functions_contra
                                            FROM (
                                                SELECT 
                                                  a.emp_no, 
                                                  a.Full_Name,
                                                  a.photo,
                                                  f.pos_name_en,
                                                  b.history_no,
                                                  b.careertransition_code, 
                                                  b.careertranstype, 
                                                  b.effectivedt,
                                                  CASE 
                                                      WHEN c.kpi_perspektif_type = '1' THEN '#show_detail_for_spv_up'
                                                      ELSE '#show_detail_for_spv_up_down'
                                                  END AS functions,
                                                  CASE 
                                                      WHEN c.kpi_perspektif_type = '1' THEN 'spv_up'
                                                    ELSE 'spv_down'
                                                  END AS functions_type,
                                                  CASE 
                                                      WHEN c.kpi_perspektif_type = '1' THEN '#show_detail_for_spv_up_down'
                                                      ELSE '#show_detail_for_spv_up'
                                                  END AS functions_contra
                                                FROM view_employee a 
                                                LEFT JOIN hrmemploymenthistory b ON a.emp_id=b.emp_id
                                                INNER JOIN hrdperf_set_period c ON a.emp_no=c.emp_no AND c.period_id = '$period'
                                                LEFT JOIN hrmperf_set_period d ON c.period_id=d.period_id
                                                LEFT JOIN tclcdreqPMappsetting e ON a.emp_no=e.employee
                                                LEFT JOIN hrmorgstruc f ON b.position_code=f.pos_code
                                                WHERE 
                                                b.careertranstype = 'MUTN' AND 
                                                YEAR(b.effectivedt) = '$year' AND
                                                '10' NOT BETWEEN MONTH(d.period_accrued_start) AND MONTH(d.period_accrued_end) AND
                                                (a.emp_no LIKE '$key%' OR a.Full_Name LIKE '$key%') AND
                                                e.emp_no = '$key0' AND
                                                e.request_type = 'Performance'
                                                
                                                UNION ALL
                                                
                                                (SELECT 
                                                  a.emp_no, 
                                                  a.Full_Name,
                                                  a.photo,
                                                  f.pos_name_en,
                                                  b.history_no, 
                                                  b.careertransition_code, 
                                                  b.careertranstype, 
                                                  b.effectivedt,
                                                  CASE 
                                                      WHEN c.kpi_perspektif_type = '1' THEN '#show_detail_for_spv_up'
                                                      ELSE '#show_detail_for_spv_up_down'
                                                  END AS functions,
                                                  CASE 
                                                      WHEN c.kpi_perspektif_type = '1' THEN 'spv_up'
                                                    ELSE 'spv_down'
                                                  END AS functions_type,
                                                  CASE 
                                                      WHEN c.kpi_perspektif_type = '1' THEN '#show_detail_for_spv_up_down'
                                                      ELSE '#show_detail_for_spv_up'
                                                  END AS functions_contra
                                                FROM view_employee a 
                                                LEFT JOIN hrmemploymenthistory b ON a.emp_id=b.emp_id
                                                INNER JOIN hrdperf_set_period c ON a.emp_no=c.emp_no AND c.period_id = '$period'
                                                LEFT JOIN hrmperf_set_period d ON c.period_id=d.period_id
                                                LEFT JOIN tclcdreqPMappsetting e ON a.emp_no=e.employee
                                                LEFT JOIN hrmorgstruc f ON b.position_code=f.pos_code
                            
                                                WHERE 
                                                b.careertranstype = 'MUTN' AND 
                                                YEAR(b.effectivedt) <> '$year' AND
                                                (a.emp_no LIKE '$key%' OR a.Full_Name LIKE '$key%') AND
                                                e.emp_no = '$key0' AND
                                                e.request_type = 'Performance'
                                                ORDER BY b.effectivedt DESC LIMIT 1)
                                            
                                            ) x
                                            
                                            GROUP BY x.history_no
                                            ORDER BY x.effectivedt DESC");
                                            

   

    $output = '<ul class="list-unstyled job_title_ul">';
    if(mysqli_num_rows($query) > 0){
      while ($row = mysqli_fetch_array($query)) {
          $output .= '<li class="job_title_li" onclick="myFunction'.$row["emp_id"].'()"><img width="30px" src="../../asset/emp_photos/'.$row["photo"].'" alt="Employee">'.$row["position_name_en"].' '.$row["history_no"].' '.$row["emp_no"].' [ '.$row["Full_Name"].' ] <br><label style="font-size: 8px;color: #646464;">'.$row["pos_name_en"].'</label></li>';
          echo '<script>
            function myFunction'.$row["emp_id"].'() {
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