<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

if(!empty($data1) && empty($data2)){
    $where          = "WHERE a.emp_no LIKE '%$data1%'";
}elseif(empty($data1) && !empty($data2)){
    $where          = "WHERE a.Full_Name LIKE '%$data2%'";
}elseif(!empty($data1) && !empty($data2)){
    $where          = "WHERE a.emp_no LIKE '%$data1%' AND a.Full_Name LIKE '%$data2%'";
}elseif(empty($data1) && empty($data2)){
    $where          = "";
}

$output = array('data' => array());

    $sql = "SELECT 
    a.emp_id,
    a.emp_no,
    a.Full_Name,
    a.pos_name_en,
    b.pos_name_en AS organizationlevel,
    a.employ_code
    FROM view_employee a
    LEFT JOIN hrmorgstruc b ON b.position_id = a.parent_id
    $where";




$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='data_letter?emp_no={$row['emp_no']}&emp_id={$row['emp_id']}' id1='' class='fetch_employee_decree' data-emp_id='$row[emp_id]'>{$row["Full_Name"]}</a>";

	$output['data'][] = array(
        $no,
        $row['emp_no'],
		$nc,
		$row['pos_name_en'],
        $row['employ_code']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>