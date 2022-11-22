<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.facility_code LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.facility_name LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.facility_code LIKE '%$data1%' AND a.facility_name LIKE '%$data2%'";
}

$output = array('data' => array());
if(empty($data1) && empty($data2)){
    $sql = "SELECT 
	a.facility_code,
	a.facility_name,
	a.facility_desc
	FROM hrmfacility a";
}else{
    $sql = "SELECT 
	a.facility_code,
	a.facility_name,
	a.facility_desc
	FROM hrmfacility a
    $where";
}



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='#' id1='{$row["facility_code"]}' class='' data-toggle='modal' id='modal_view_facility' data-target='#modal-view-facility'>{$row["facility_code"]}</a>";

	$output['data'][] = array(
        $no,
		$nc,
		$row['facility_name'],
		$row['facility_desc']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>