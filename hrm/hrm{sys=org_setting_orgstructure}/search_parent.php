<?php
include '../../application/config.php';
date_default_timezone_set('Asia/Bangkok');

$datetime        = date('Y-m-d h:i:s');
$date           = date('Y-m-d');
$year           = date('Y');
$dateprint         = date('d M Y');
$time           = date('h:i:s');
$request          = date('Ydhis');

if (isset($_POST["query"])) {
  $output = '';

  $key0     = $_GET["userid"];
  $key      = $_POST["query"];

  $query = mysqli_query($connect, "SELECT
  a.emp_no,
  a.Full_Name,
  CONCAT(b.position_id , '# [' , b.pos_name_en , '] ') as ln
  FROM hrmorgstrucdev b
  LEFT JOIN (SELECT emp_no, Full_Name, pos_code FROM view_employee) a ON a.emp_no=b.emp_no
                                          WHERE
                                            ((b.position_id LIKE '%$key%') OR
                                            (b.pos_code LIKE '%$key%') OR
                                            (b.pos_name_en LIKE '%$key%') OR
                                            (b.emp_no LIKE '%$key%') OR
                                            (a.Full_Name LIKE '%$key%')
                                            )
                                        LIMIT 10");


  $output = '<ul class="list-unstyled job_title_ul" style="margin-left: 0;width: 100%;">';
  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
      $output .= '<li class="job_title_li searchterm_venue" id="select_add_category" onclick="select_add_category()">' . $row["ln"] . '</li>';
    }
  } else {
    $output .= '<li class="job_title_li">Invalid lookup</li>';
  }
  $output .= '</ul>';
  echo $output;
}
