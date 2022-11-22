<?php 
require_once '../../../application/config.php';

$user = $_GET['user'];

$output = array('data' => array());

if(!empty($_GET['is_pic'])){
	if (!empty($_GET['src_emp_no']) && !empty($_GET['src_request_no'])) {
		$where         = "WHERE a.created_by = '$user' OR (a.category IN ($_GET[is_pic]))AND a.suspecter = '$_GET[src_emp_no]' AND a._id_whistle = '$_GET[src_request_no]' ";
	} else if (!empty($_GET['src_emp_no'])) {
		$where         = "WHERE a.created_by = '$user' OR (a.category IN ($_GET[is_pic]))AND a.suspecter = '$_GET[src_emp_no]'";
	} else if (!empty($_GET['src_request_no'])) {
		$where         = "WHERE a.created_by = '$user' OR (a.category IN ($_GET[is_pic]))AND a._id_whistle = '$_GET[src_request_no]'";	
	} else {
		$where         = "WHERE a.created_by = '$user' OR (a.category IN ($_GET[is_pic]))";
	}
} else {
	if (!empty($_GET['src_emp_no']) && !empty($_GET['src_request_no'])) {
		$where         = "WHERE a.created_by = '$user' AND a.suspecter = '$_GET[src_emp_no]' AND a._id_whistle = '$_GET[src_request_no]' ";
	} else if (!empty($_GET['src_emp_no'])) {
		$where         = "WHERE a.created_by = '$user' AND a.suspecter = '$_GET[src_emp_no]'";
	} else if (!empty($_GET['src_request_no'])) {
		$where         = "WHERE a.created_by = '$user' AND a._id_whistle = '$_GET[src_request_no]'";	
	} else {
		$where         = "WHERE a.created_by = '$user'";
	}
}



$sql = "SELECT a.*,b.*,c.name_en FROM whstd_request a
		LEFT JOIN view_employee b on a.suspecter=b.emp_no
		LEFT JOIN hrmstatus c on a.whistle_status=c.code
		$where
		ORDER BY a.created_date DESC";

$query = mysqli_query($connect, $sql);


while ($row = mysqli_fetch_assoc($query)) {

	$key = $row['_id_whistle'];
	$encrypte = base64_encode($key);

	$x = 1;

	$rmintf = '<img src="../../asset/emp_photos/'.$row['photo'].'" alt="user" class="profile-pic rounded-circle" width="30" style="height: 32px;"> <a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: orange; border: 5px; cursor:pointer;font-weight: bold;font-size: 13px;" onclick="editMember(`'.$row['_id_whistle'].'`) , myFunction()">'.$row['emp_no'].' '.$row['Full_Name'].'</a>  <br> <label style="padding-top: 4px;color: #A5B0B7 !important;">'.$row['_id_whistle'].' | '.$row['title'].'</label> 
			<a href="chat?emp_id='.$user.'&_key='.$encrypte.'">
			<div href="" class="toolbar sprite-toolbar-mandatoryTraining" style="position: unset;text-align: right;margin-left: 96%;margin-top: -24px;"></div>

			





<div class="chart-text me-2">
                                          <h6 class="mb-0"><small>'.strtoupper($row['name_en']).'</small></h6>
                                      
                                   </div>
</td>
			</a>';

	$output['data'][] = array(
		$rmintf
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP