<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
include "../../../application/session/session_ess.php";



// Ambil data div dan dept 

// Deklarasi variable keyword buah.
$parent_code = $_GET["query"];

    $query  = $connect->query("SELECT 
    a.emp_id,
    a.Full_Name,
    CONCAT(a.Full_Name, ' [', a.emp_no, ']') AS ditampil
    FROM view_employee a 
    WHERE a.emp_no LIKE '%$parent_code%'
    OR a.Full_Name LIKE '%$parent_code%'
    LIMIT 10");


// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['ditampil'],
            'parent'  => $data['emp_id']
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
