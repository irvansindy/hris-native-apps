<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}
require_once '../../../application/config.php';
require_once '../../../model/org/GMPositionList.php';

$output = array('data' => array());

$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {
// echo 'wkwkwkwkwk';
$rmintf = '
<div class="d-flex justify-content-between align-items-center" style="border-radius: 22px;background: aliceblue;margin: 3px;padding: 7px;">
	
	
	<small class="text-muted digital" style="font-size: 12px;"> '.$row['pos_name_en'].' &nbsp;&nbsp; 
	</small>
	<div class="py-0 ml-2" style="font-size:13px;margin-top:5px;">
		<button data-dismiss="modal" aria-label="Close" onclick="setPosition(`'.$row['position_id'].' '.$row['pos_name_en'].'`);" class="btn btn-primary ml-auto" style="background: transparent;
						width: auto;
						border-radius: 103px;
						font-size: 10px;
						color: black;
						font-weight: bold;" type="button">Select
		</button>
	</div>
	</div>';

$output['data'][] = array(
	$rmintf
);

$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP