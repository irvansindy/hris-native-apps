<?php
include "../../../application/session/sessionlv2.php";
require_once '../../../application/config.php';

$user = $_GET['username'];

require_once '../../../model/tr/GMTrainingReqList.php';

$output = array('data' => array());

$sql = $qListRenderMyTrining;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $keyserv_1 = '<button type="reset" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" data-toggle="modal" style="font-family: verdana;font-size: 10px;" data-target="#CreateFormStarttime" onclick="CreateButtonStarttime(`'.$row['request_no'].'#'.$row['emp_id'].'#'.$row['training_category'].'#'.$row['training_course'].'`)" data-keyboard="false" data-backdrop="static">
                        &nbsp;Starttime&nbsp;
                    </button>';
    
    if($row['fr'] == 'Passed') {
        $keyserv_3 = '<a href="" type="reset" data-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#Certificate" onclick="Certificate(`'.$row['request_no'].'#'.$row['emp_id'].'#'.$row['training_category'].'#'.$row['training_course'].'`)" data-keyboard="false" data-backdrop="static">
                        &nbsp;Yes&nbsp;
                    </a>';
    } else {
        $keyserv_3 = 'No';
    }

    $keyserv_2 = '<a href="" type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormChooseTest" data-backdrop="static" onclick="chooseTest(`'.$row['request_no'].'#'.$row['emp_id'].'#'.$row['training_category'].'#'.$row['training_course'].'`)">Yes</a> ';

    

	$output['data'][] = array(
		$x,
        $row['request_no'],
        $row['course_name'],
        $row['training_topic'],
        $row['c_startdate'],
        $row['c_enddate'],
        $row['providertype'],
        $row['providername'],
        $keyserv_1,
        'Yes',
        $keyserv_2,
        $keyserv_3,
        $row['fr']
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP