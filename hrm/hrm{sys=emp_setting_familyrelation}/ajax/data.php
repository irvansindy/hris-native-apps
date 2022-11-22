<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.relationship_code LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.relationship_name_en LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.relationship_code LIKE '%$data1%' AND a.relationship_name_en LIKE '%$data2%'";
}

$output = array('data' => array());
if(empty($data1) && empty($data2)){
    $sql = "SELECT 
    a.relationship_code,
    a.relationship_name_en 
    FROM hrmfamilyrelation a";
}else{
    $sql = "SELECT 
    a.relationship_code,
    a.relationship_name_en 
    FROM hrmfamilyrelation a
    $where";
}



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $relationship     = "<a href='#' id1='{$row["relationship_code"]}' class='' data-toggle='modal' id='modal_view_relationship' data-target='#modal-view-relationship'>{$row["relationship_code"]}</a>";

	$output['data'][] = array(
        $no,
		$relationship,
		$row['relationship_name_en']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>