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
                                          CONCAT(b.emp_no , '# [' , b.Full_Name , '] ') as ln
                                          FROM view_employee b
                                          LEFT JOIN hrmorgstrucdev a ON a.pos_code=b.pos_code
                                          WHERE
                                            ((b.emp_no LIKE '%$key%') OR
                                            (b.Full_Name LIKE '%$key%') OR
                                            (b.cost_code LIKE '%$key%')) AND 
                                            a.emp_no IS NULL
                                        LIMIT 10");


  $output = '<ul class="list-unstyled job_title_ul" style="margin-left: 0;width: 100%;">';
  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
      $output .= '<li class="job_title_li searchterm_employee" id="select_add_category" onclick="select_add_category()">' . $row["ln"] . '</li>';
    }
  } else {
    $output .= '<li class="job_title_li">Invalid lookup</li>';
  }
  $output .= '</ul>';
  echo $output;
}
