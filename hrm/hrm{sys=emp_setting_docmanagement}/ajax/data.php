<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.doc_name LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.remind_befnum LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.doc_name LIKE '%$data1%' AND a.remind_befnum LIKE '%$data2%'";
}

$output = array('data' => array());
if(empty($data1) && empty($data2)){
    $sql = "SELECT 
    a.doc_code,
    a.doc_name,
    a.remind_befnum
    FROM hrmdoctype a";
}else{
    $sql = "SELECT 
    a.doc_code,
    a.doc_name,
    a.remind_befnum
    FROM hrmdoctype a
    $where";
}



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='#' id1='{$row["doc_code"]}' class='' data-toggle='modal' id='modal_view_docmanagement' data-target='#modal-view-docmanagement'>{$row["doc_name"]}</a>";

	$output['data'][] = array(
        $no,
		$nc,
		$row['remind_befnum']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>