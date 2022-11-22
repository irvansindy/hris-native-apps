<?php 
require_once '../../../application/config.php';
include "../../../model/pr/GMPerformancePlanSearchGen.php";
include "../../../model/pr/GMPerformancePlan.php";

$output = array('data' => array());

$sql = $qListRenderPerformanceComparatio;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {
	
	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="UpdateForm(`'.$row['ipp_reqno'].'`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="delete" width="22px"/></a>';
       // $prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="UpdateForm(`' . $row['shiftregroup_id'] . '`)"> '.$row['shiftregroup_name'].'</a>';

	

	$output['data'][] = array(
		$x,
		$row['emp_no'],
		$row['Full_Name'],
        $row['pa_grade_adjust'],
        $row['range_name'],
        number_format($row['SIM'],2) .'%',
        number_format($row['basic_salary'],2),
		number_format($row['diff'],2),
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP