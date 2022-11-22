<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

// include "../../../model/st/GMOrganizationSearchGen.php";
include "../../../model/st/GMOrganizationList.php";


$output = array('data' => array());


$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

       $prn = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#CreateForm" data-backdrop="static" onclick="update_training(`' . $row['position_id'] . '`)"> ' . $row['position_id'] . '</a>';
       $del = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`' . $row['position_id'] . '`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"></a>';

       $output['data'][] = array(
              $x,
              $row['position_id'],
              $row['pos_code'],
              $row['pos_name_en'],
              $row['parent_id'],
              $del
       );

       $x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP