<?php 
require_once '../../../application/config.php';
// include "../../../model/st/GMAttendanceFormulaSettingSearchGen.php";
include "../../../model/st/GMAttendanceFormulaSetting.php";

$output = array('data' => array());

$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['process_order'].'`)"><u>'.$row['attformula'].'</u></a>   ';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`'.$row['process_order'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

	// $order = '<select id="sel_process_order" class="input--style-6" name="sel_process_order" onfocus="hlentry(this)" onchange="formodified(this);" style="width:undefined;border: 1px solid #cac2c2;color: #484545; height:33px"><option value="'.$row['process_order'].'">'.$row['process_order'].'</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select>' ;

	$output['data'][] = array(
		$row['ordering'],
		$rmintf,
		// $order,
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP