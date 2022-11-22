<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];

if(!empty($data1)){
    $where          = "WHERE a.customfield_name_en LIKE '%$data1%'";
}else{
    $where          = "";
}

$output = array('data' => array());

	
    $sql = "SELECT 
    a.customfield_no,
    a.customfield_name_en,
    a.config_string
    FROM hrmcustomfield a
    $where";



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='#' id1='{$row["customfield_no"]}' class='' data-toggle='modal' id='modal_view_customfield' data-target='#modal-view-customfield'>{$row["customfield_name_en"]}</a>";

    $configur = "<textarea style='width:100%' disabled>{$row["config_string"]}</textarea>";

	$output['data'][] = array(
        $no,
		$nc,
		$configur
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>