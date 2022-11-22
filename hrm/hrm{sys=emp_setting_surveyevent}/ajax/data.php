<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];
$data3              = $_GET['data3'];

if(empty($data1) && empty($data2) && empty($data3)){
    $where          = "";
}elseif(empty($data1) && empty($data2) && !empty($data3)){
    $where          = "WHERE a.tahun LIKE '%$data3%'";
}elseif(empty($data1) && !empty($data2) && empty($data3)){
    $where          = "WHERE a.judul LIKE '%$data2%'";
}elseif(empty($data1) && !empty($data2) && !empty($data3)){
    $where          = "WHERE a.judul LIKE '%$data2%' OR a.tahun LIKE '%$data3%'";
}elseif(!empty($data1) && empty($data2) && empty($data3)){
    $where          = "WHERE a.id_event LIKE '%$data1%'";
}elseif(!empty($data1) && empty($data2) && !empty($data3)){
    $where          = "WHERE a.id_event LIKE '%$data1%' OR a.tahun LIKE '%$data3%'";
}elseif(!empty($data1) && !empty($data2) && empty($data3)){
    $where          = "WHERE a.id_event LIKE '%$data1%' OR a.judul LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2) && !empty($data3)){
    $where          = "WHERE a.id_event LIKE '%$data1%' OR a.judul LIKE '%$data2%' OR a.tahun LIKE '%$data3%'";
}

$output = array('data' => array());

    $sql = "SELECT 
    a.id,
    a.id_event,
    a.judul,
    a.tahun,
    a.divisi,
    a.dept
    FROM hrmsurveyevent a
    $where";


$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $aksi     = "<a href='#' id1='{$row["id"]}' class='' data-toggle='modal' id='modal_view_event' data-target='#modal-view-event'>{$row["id_event"]}</a>";

	$output['data'][] = array(
        $no,
		$aksi,
		$row['judul'],
        $row['tahun'],
        $row['divisi'],
        $row['dept']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>