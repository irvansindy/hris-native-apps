<?php
include '../../application/config.php';
date_default_timezone_set('Asia/Bangkok');

$datetime           = date('Y-m-d h:i:s');
$date               = date('Y-m-d');
$year               = date('Y');
$dateprint          = date('d M Y');
$time               = date('h:i:s');
$request            = date('Ydhis');

if (isset($_POST["query"])) {

  $output   = '';

  $key0     = $_GET["userid"];
  $key      = $_POST["query"];

  $query = mysqli_query($connect, "SELECT
                                          b.emp_no,
                                          b.full_name as Full_Name,
                                          b.pos_name_en,
                                          b.photo
                                          FROM view_employee b
                                          WHERE
                                            (b.emp_no LIKE '$key0%') AND
                                            (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
                                      
                                      UNION
                                      
                                      SELECT
                                            b.emp_no,
                                            b.full_name as Full_Name,
                                            b.pos_name_en,
                                            b.photo
                                            FROM tclcdreqappsetting_formula a
                                            LEFT JOIN
                                                    (
                                                      SELECT * FROM view_employee
                                                    ) b ON a.request_type = 'Onduty.request'
                                            WHERE
                                              (
                                                a.empno_appvr1 LIKE '%$key0%' OR
                                                a.empno_appvr2 LIKE '%$key0%' OR
                                                a.empno_appvr3 LIKE '%$key0%'
                                              ) AND
                                              (
                                                b.emp_no LIKE '$key%' OR 
                                                b.Full_Name LIKE '$key%'
                                              ) AND
                                              (
                                                b.end_date IS NULL OR 
                                                b.end_date = '0000-00-00 00:00:00'
                                              )
                                        GROUP BY b.emp_no
                                        -- ORDER BY b.emp_no DESC
                                        LIMIT 10");

  $output = '<ul class="list-unstyled job_title_ul">';
  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
      $output .= '<li class="job_title_li" id="job_title_li" onclick="myFunction' . $row["emp_no"] . '()"><img width="30px" src="../../asset/emp_photos/' . $row["photo"] . '" alt="Employee">' . $row["position_name_en"] . ' ' . $row["emp_no"] . ' [ ' . $row["Full_Name"] . ' ] <br><label style="font-size: 8px;color: #646464;">' . $row["pos_name_en"] . '</label></li>';
    }
  } else {
    $output .= '<li class="job_title_li">Invalid lookup</li>';
  }
  $output .= '</ul>';
  echo $output;
}
?>