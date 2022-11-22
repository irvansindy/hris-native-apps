<?php 
if (!empty($_GET['shiftregroup_name']) && !empty($_GET['shiftregroup_year'])) {
       $shiftregroup_name 	       = $_GET['shiftregroup_name'];
       $shiftregroup_year          = $_GET['shiftregroup_year'];
       $where_srv 			= "WHERE (a.shiftregroup_name LIKE '%$shiftregroup_name%') AND (a.shiftyear = '$shiftregroup_year')";

} elseif (!empty($_GET['shiftregroup_name']) && empty($_GET['shiftregroup_year'])) {
       $shiftregroup_name 	       = $_GET['shiftregroup_name'];
       $shiftregroup_year          = $_GET['shiftregroup_year'];
       $where_srv 			= "WHERE (a.shiftregroup_name LIKE '%$shiftregroup_name%')";

} elseif (empty($_GET['shiftregroup_name']) && !empty($_GET['shiftregroup_year'])) {
       $shiftregroup_name 	       = $_GET['shiftregroup_name'];
       $shiftregroup_year          = $_GET['shiftregroup_year'];
       $where_srv 			= "WHERE (a.shiftyear = '$shiftregroup_year')";

} else {
       $where_srv 			= "";
}
?>