<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.disease_code LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.disease_name_en LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.disease_code LIKE '%$data1%' AND a.disease_name_en LIKE '%$data2%'";
}

$output = array('data' => array());
if(empty($data1) && empty($data2)){
    $sql = "SELECT 
    a.disease_code,
    a.disease_name_en
    FROM hrmdisease a ";
}else{
    $sql = "SELECT 
    a.disease_code,
    a.disease_name_en
    FROM hrmdisease a 
    $where";
}



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='#' id1='{$row["disease_code"]}' class='' data-toggle='modal' id='modal_view_disease' data-target='#modal-view-disease'>{$row["disease_code"]}</a>";

	$output['data'][] = array(
        $no,
		$nc,
		$row['disease_name_en']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>