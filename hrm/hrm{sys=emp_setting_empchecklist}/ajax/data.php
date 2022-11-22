<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.checklistheader_code LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.checklistgrp_name LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.checklistheader_code LIKE '%$data1%' AND a.checklistgrp_name LIKE '%$data2%'";
}else{
    $where          = "";
}

$output = array('data' => array());

    $sql = "SELECT 
    a.checklistheader_code as Checklist_Group_Code,
    a.checklistgrp_name as Checklist_Group_Name,
    c.pos_name_en
    FROM hrmchecklistheader a
    LEFT JOIN tgemchecklistorgunit b ON b.checklistheader_code = a.checklistheader_code
    LEFT JOIN hrmorgstruc c ON c.position_id = b.dept_id
    $where
    ";

$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='#' id1='{$row["Checklist_Group_Code"]}' class='' data-toggle='modal' id='modal_view_checklistheader' data-target='#modal-view-checklistheader'>{$row["Checklist_Group_Code"]}</a>";

	$output['data'][] = array(
        $no,
		$nc,
		$row['Checklist_Group_Name'],
        $row['pos_name_en']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>