<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
include "../../../application/session/session_ess.php";



// Ambil data div dan dept 
$username = $_SESSION['username'];

$sql_get_worklocation = mysqli_query($connect, "SELECT 
a.worklocation_code
FROM view_employee a WHERE a.emp_no = '$username'");

$get_worklocation = mysqli_fetch_assoc($sql_get_worklocation);

$sql_view_all = mysqli_query($connect, "SELECT 
a.view_all
FROM hrmconselor a
LEFT JOIN view_employee b ON b.pos_code = a.pos_code
WHERE b.emp_no = '$username'");

$view_all = mysqli_fetch_assoc($sql_view_all);

// Deklarasi variable keyword buah.
$parent_code = $_GET["query"];

// Query ke database.
if($view_all['view_all'] == '1'){
    $query  = $connect->query("SELECT 
    a.emp_no,
    a.Full_Name,
    CONCAT(a.Full_Name, ' [', a.emp_no, ']') AS ditampil
    FROM view_employee a 
    WHERE a.emp_no LIKE '%$parent_code%'
    OR a.Full_Name LIKE '%$parent_code%'
    LIMIT 10");
}else{
$query  = $connect->query("SELECT 
a.emp_no,
a.Full_Name,
CONCAT(a.Full_Name, ' [', a.emp_no, ']') AS ditampil
FROM view_employee a 
WHERE a.emp_no LIKE '%$parent_code%'
OR a.Full_Name LIKE '%$parent_code%'
AND a.worklocation_code LIKE '%$get_worklocation[worklocation_code]%'
LIMIT 10");
}

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['ditampil'],
            'parent'  => $data['emp_no']
        ];
    }

    // Encode ke JSON.
    echo json_encode($output);

// Jika tidak ada yang cocok.
} else {
    $output['suggestions'][] = [
        'value' => '',
        'parent'  => ''
    ];

    // Encode ke JSON.
    echo json_encode($output);
}
