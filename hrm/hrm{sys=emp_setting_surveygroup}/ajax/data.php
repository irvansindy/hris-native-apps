<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];
$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.groupName LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.groupId LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.groupName LIKE '%$data1%' AND a.groupId LIKE '%$data2%'";
}elseif(empty($data1) && empty($data2)){
    $where          = "";
}

$output = array('data' => array());

    $sql = "SELECT 
    a.groupId,
    a.groupName
    FROM hrmsurveytgroup a
    $where
    ORDER BY a.groupId ASC";



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $edu     = "<a href='#' id1='{$row["groupId"]}' class='' data-toggle='modal' id='modal_view_gpertanyaan' data-target='#modal-view-gpertanyaan'>{$row["groupName"]}</a>";

	$output['data'][] = array(
        $no,
		$edu,
		$row['groupId']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>