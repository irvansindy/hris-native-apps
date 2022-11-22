<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.religion_code LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.religion_name_en LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.religion_code LIKE '%$data1%' AND a.religion_name_en LIKE '%$data2%'";
}

$output = array('data' => array());
if(empty($data1) && empty($data2)){
    $sql = "SELECT 
    a.religion_code,
    a.religion_name_en 
    FROM hrmreligion a ";
}else{
    $sql = "SELECT 
    a.religion_code,
    a.religion_name_en 
    FROM hrmreligion a
    $where";
}



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $religion     = "<a href='#' id1='{$row["religion_code"]}' class='' data-toggle='modal' id='modal_view_religion' data-target='#modal-view-religion'>{$row["religion_code"]}</a>";

	$output['data'][] = array(
        $no,
		$religion,
		$row['religion_name_en']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>