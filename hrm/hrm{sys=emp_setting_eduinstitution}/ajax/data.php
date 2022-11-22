<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.edu_code LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.edu_name LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.edu_code LIKE '%$data1%' AND a.edu_name LIKE '%$data2%'";
}else{
    $where          = "";
}

$output = array('data' => array());

    $sql = "SELECT 
    a.edu_code,
    a.edu_name
    FROM hrmeduinstitution a
    
    $where
    ORDER BY a.created_date ASC";




$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $edu     = "<a href='#' id1='{$row["edu_code"]}' class='' data-toggle='modal' id='modal_view_edu' data-target='#modal-view-edu'>{$row["edu_code"]}</a>";

	$output['data'][] = array(
        $no,
		$edu,
		$row['edu_name']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>