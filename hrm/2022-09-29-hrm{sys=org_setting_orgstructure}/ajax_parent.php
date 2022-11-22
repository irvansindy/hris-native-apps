<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
include "../../application/session/session.php";

// Deklarasi variable keyword buah.
$parent_code = $_GET["query"];

// Query ke database.
$query  = $connect->query("SELECT * FROM hrmorgstruc WHERE pos_name_en LIKE '%$parent_code%' ORDER BY position_id DESC");

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['pos_name_en'],
            'parent'  => $data['position_id']
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
