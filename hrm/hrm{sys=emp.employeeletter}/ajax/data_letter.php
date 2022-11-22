<?php 
include "../../../application/session/session_ess.php";

$username           = $_GET['username'];

// $data1              = $_GET['data1'];
// $data2              = $_GET['data2'];

// if(!empty($data1) && empty($data2)){
//     $where          = "WHERE a.emp_no LIKE '%$data1%'";
// }elseif(empty($data1) && !empty($data2)){
//     $where          = "WHERE a.Full_Name LIKE '%$data2%'";
// }elseif(!empty($data1) && !empty($data2)){
//     $where          = "WHERE a.emp_no LIKE '%$data1%' AND a.Full_Name LIKE '%$data2%'";
// }elseif(empty($data1) && empty($data2)){
//     $where          = "";
// }

$output = array('data' => array());

    $sql = "SELECT 
    d.Full_Name AS employee_name,
    b.letter_no,
    DATE_FORMAT(b.letter_date, '%d %M %Y') AS refdate,
    c.Full_Name AS signee
    FROM tclmletterdocument b
    LEFT JOIN view_employee c ON c.emp_id = b.letter_signee
    LEFT JOIN view_employee d ON d.emp_id = b.letter_receiver
    WHERE b.letter_receiver = (SELECT emp_id FROM view_employee WHERE emp_no = '$username')";




$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    $nc     = "<a href='#' id1='{$row["letter_no"]}' class='' data-toggle='modal' id='modal_view_letter' data-target='#modal-view-letter'>{$row["letter_no"]}</a>";
    $ne     = "<a href='#' id1='{$row["letter_no"]}' class='' data-toggle='modal' id='modal_view_print' data-target='#modal-view-print'>[Assign Letter]</a>";


	$output['data'][] = array(
        $no,
        $row['employee_name'],
        $nc,
        $row['refdate'],
		$ne,
        $row['signee']
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>