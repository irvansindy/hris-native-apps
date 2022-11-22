<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];


$output = array('data' => array());

    $sql = "SELECT 
    DISTINCT(a.request_no) AS request_no,
    b.emp_no,
    b.Full_Name,
    a.request_type,
    DATE_FORMAT(a.created_date, '%d %M %Y') AS request_date,
    c.name_en AS status_pengajuan
    FROM hrmrequestapproval a
    LEFT JOIN view_employee b ON a.seq_id = b.emp_no
    LEFT JOIN hrmstatus c ON a.request_status = c.code
    WHERE a.seq_id IN (SELECT x.emp_no FROM view_employee x WHERE x.emp_no = '$username')";




$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='#' data-toggle='modal' data-target='#ApprovalForm' data-backdrop='static' style='text-align: right;color: blue; border: 5px; cursor:pointer' onclick='ApprovalSubmission(`{$row["request_no"]}`)'>{$row["request_no"]}</a>";


	$output['data'][] = array(
        $no,
        $nc,
        $row['emp_no'],
        $row['Full_Name'],
        $row['request_type'],
        $row['request_date'],
        $row['status_pengajuan']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
