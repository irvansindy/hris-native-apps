<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];
$data3              = $_GET['data3'];
$data4              = $_GET['data4'];

if(empty($data1) && empty($data2) && empty($data3) && $data4 == ''){
    $where          = "";
}elseif(empty($data1) && empty($data2) && empty($data3) && $data4 != ''){
    $where          = "WHERE a.`status` LIKE '%$data4%'";
}elseif(empty($data1) && empty($data2) && !empty($data3) && $data4 == ''){
    $where          = "WHERE a.edutype_level LIKE '%$data3%'";
}elseif(empty($data1) && empty($data2) && !empty($data3) && $data4 != ''){
    $where          = "WHERE a.edutype_level LIKE '%$data3%' AND a.`status` LIKE '%$data4%'";
}elseif(empty($data1) && !empty($data2) && empty($data3) && $data4 == ''){
    $where          = "WHERE a.edutype_name_en LIKE '%$data2%'";
}elseif(empty($data1) && !empty($data2) && empty($data3) && $data4 != ''){
    $where          = "WHERE a.edutype_name_en LIKE '%$data2%' AND AND a.`status` LIKE '%$data4%'";
}elseif(empty($data1) && !empty($data2) && !empty($data3) && $data4 == ''){
    $where          = "WHERE a.edutype_name_en LIKE '%$data2%' AND a.edutype_level LIKE '%$data3%'";
}elseif(empty($data1) && !empty($data2) && !empty($data3) && $data4 != ''){
    $where          = "WHERE a.edutype_name_en LIKE '%$data2%' AND a.edutype_level LIKE '%$data3%' AND a.`status` LIKE '%$data4%'";
}elseif(!empty($data1) && empty($data2) && empty($data3) && $data4 == ''){
    $where          = "WHERE a.edutype_code LIKE '%$data1%'";
}elseif(!empty($data1) && empty($data2) && empty($data3) && $data4 != ''){
    $where          = "WHERE a.edutype_code LIKE '%$data1%' AND a.`status` LIKE '%$data4%'";
}elseif(!empty($data1) && empty($data2) && !empty($data3) && $data4 == ''){
    $where          = "WHERE a.edutype_code LIKE '%$data1%' AND a.edutype_level LIKE '%$data3%'";
}elseif(!empty($data1) && empty($data2) && !empty($data3) && $data4 != ''){
    $where          = "WHERE a.edutype_code LIKE '%$data1%' AND a.edutype_level LIKE '%$data3%' AND a.`status` LIKE '%$data4%'";
}elseif(!empty($data1) && !empty($data2) && empty($data3) && $data4 == ''){
    $where          = "WHERE a.edutype_code LIKE '%$data1%' AND a.edutype_name_en LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2) && empty($data3) && $data4 != ''){
    $where          = "WHERE a.edutype_code LIKE '%$data1%' AND a.edutype_name_en LIKE '%$data2%' AND a.`status` LIKE '%$data4%'";
}elseif(!empty($data1) && !empty($data2) && !empty($data3) && $data4 == ''){
    $where          = "WHERE a.edutype_code LIKE '%$data1%' AND a.edutype_name_en LIKE '%$data2%' AND a.edutype_level LIKE '%$data3%'";
}elseif(!empty($data1) && !empty($data2) && !empty($data3) && $data4 != ''){
    $where          = "WHERE a.edutype_code LIKE '%$data1%' AND a.edutype_name_en LIKE '%$data2%' AND a.edutype_level LIKE '%$data3%' AND a.`status` LIKE '%$data4%'";
}

$output = array('data' => array());

    $sql = "SELECT 
    a.edutype_code,
    a.edutype_name_en,
    a.edutype_level,
    a.`status`
    FROM hrmedulevel a
    $where";




$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $edulevel     = "<a href='#' id1='{$row["edutype_code"]}' class='' data-toggle='modal' id='modal_view_edulevel' data-target='#modal-view-edulevel'>{$row["edutype_code"]}</a>";
    if($row['status'] == '1'){
        $status     = 'Aktif';
    }else{
        $status     = 'Tidak Aktif';
    }

	$output['data'][] = array(
        $no,
		$edulevel,
		$row['edutype_name_en'],
        $row['edutype_level'],
        $status
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>