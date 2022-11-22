<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

// Validasi can see all
$sql_view_all = mysqli_query($connect, "SELECT 
a.view_all
FROM hrmconselor a
LEFT JOIN view_employee b ON b.pos_code = a.pos_code
WHERE b.emp_no = '$username'");

$view_all = mysqli_fetch_assoc($sql_view_all);

$sql_get_worklocation = mysqli_query($connect, "SELECT 
a.worklocation_code
FROM view_employee a WHERE a.emp_no = '$username'");

$get_worklocation = mysqli_fetch_assoc($sql_get_worklocation);


$data1              = $_GET['data1'];
$data2              = $_GET['data2'];

    if($view_all['view_all'] == '1'){
        if(!empty($data1) && empty($data2)){
            $where          = "WHERE a.to_empno LIKE '%$data1%'";
        }elseif(empty($data1) && !empty($data2)){
            $where          = "WHERE b.Full_Name LIKE '%$data2%'";
        }elseif(!empty($data1) && !empty($data2)){
            $where          = "WHERE a.to_empno LIKE '%$data1%' AND b.Full_Name LIKE '%$data2%'";
        }elseif(empty($data1) && empty($data2)){
            $where          = "";
        }
    }else{
        if(!empty($data1) && empty($data2)){
            $where          = "WHERE a.to_empno LIKE '%$data1%' AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
        }elseif(empty($data1) && !empty($data2)){
            $where          = "WHERE b.Full_Name LIKE '%$data2% AND a.work_location LIKE '%$get_worklocation[worklocation_code]%''";
        }elseif(!empty($data1) && !empty($data2)){
            $where          = "WHERE a.to_empno LIKE '%$data1%' AND b.Full_Name LIKE '%$data2%' AND a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
        }elseif(empty($data1) && empty($data2)){
            $where          = "WHERE a.work_location LIKE '%$get_worklocation[worklocation_code]%'";
        }
    }




$output = array('data' => array());

    $sql = "SELECT 
    a.noref,
    a.to_empno,
    b.Full_Name,
    DATE_FORMAT(a.tanggal, '%d %M %Y') AS tanggal,
    a.created_by,
    DATE_FORMAT(a.created_date, '%d %M %Y %H:%i') AS created_date
    FROM hrddisciplineshistory a 
    LEFT JOIN view_employee b ON b.emp_no = a.to_empno
    $where";



$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {

    
     
    $action         = "<a href='#' id1='{$row["noref"]}' id2='{$row["noref"]}' class='' data-toggle='modal' id='modal_edit_sp' data-target='#modal-edit-sp'><img src='../../asset/img/icons/acticon-note.png'></a>
    <a href='#' id1='{$row["noref"]}' id2='{$row["noref"]}' class='' data-toggle='modal' id='modal_view_sp' data-target='#modal-view-sp'><img src='../../asset/img/icons/glasses.png'></a>";

	$output['data'][] = array(
        $row['noref'],
        $row['to_empno'],
        $row['Full_Name'],
        $row['tanggal'],
        $row['created_by'],
        $row['created_date'],
		$action
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>