<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];
$data3              = $_GET['data3'];

if(empty($data1) && empty($data2) && !empty($data3)){
    $where          = "WHERE a.doctorhospital_phone LIKE '%$data3%'";
}elseif(empty($data1) && !empty($data2) && empty($data3)){
    $where          = "WHERE a.doctorhospital_name LIKE '%$data2%'";
}elseif(empty($data1) && !empty($data2) && !empty($data3)){
    $where          = "WHERE a.doctorhospital_name LIKE '%$data2%' AND a.doctorhospital_phone LIKE '%$data3%'";
}elseif(!empty($data1) && empty($data2) && empty($data3)){
    $where          = "WHERE a.doctorhospital_code LIKE '%$data1%'";
}elseif(!empty($data1) && empty($data2) && !empty($data3)){
    $where          = "WHERE a.doctorhospital_code LIKE '%$data1%' AND a.doctorhospital_phone LIKE '%$data3%'";
}elseif(!empty($data1) && !empty($data2) && empty($data3)){
    $where          = "WHERE a.doctorhospital_code LIKE '%$data1%' AND a.doctorhospital_name LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2) && !empty($data3)){
    $where          = "WHERE a.doctorhospital_code LIKE '%$data1%' AND a.doctorhospital_name LIKE '%$data2%' AND a.doctorhospital_phone LIKE '%$data3%'";
}

$output = array('data' => array());
if(empty($data1) && empty($data2)){
    $sql = "SELECT 
    a.doctorhospital_code,
    a.doctorhospital_name,
    a.doctorhospital_address,
    a.doctorhospital_phone
    FROM hrmdoctorhospital a";
}else{
    $sql = "SELECT 
    a.doctorhospital_code,
    a.doctorhospital_name,
    a.doctorhospital_address,
    a.doctorhospital_phone
    FROM hrmdoctorhospital a
    $where";
}



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='#' id1='{$row["doctorhospital_code"]}' class='' data-toggle='modal' id='modal_view_doctorhospital' data-target='#modal-view-doctorhospital'>{$row["doctorhospital_code"]}</a>";

	$output['data'][] = array(
        $no,
		$nc,
		$row['doctorhospital_name'],
        $row['doctorhospital_address'],
        $row['doctorhospital_phone']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>