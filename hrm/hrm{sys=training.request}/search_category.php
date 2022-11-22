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
                                          *
                                          FROM trnmcategory b
                                          WHERE
                                            ((b.categoryname LIKE '%$key%') OR
                                            (b.description LIKE '%$key%')) OR 
                                            ((concat(' ' ,b.categoryname) LIKE '%$key%'))
                                        LIMIT 10");


  $output = '<ul class="list-unstyled job_title_ul" style="margin-left: 0;width: 100%;">';
  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
      $output .= '<li class="job_title_li searchterm_category" id="select_add_category" onclick="select_add_category()">' . $row["parent_code"] . ' - ' . $row["categoryname"] . '</li>';
    }
  } else {
    $output .= '<li class="job_title_li">Invalid lookup</li>';
  }
  $output .= '</ul>';
  echo $output;
}
