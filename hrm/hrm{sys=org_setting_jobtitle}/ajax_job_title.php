<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
include "../../application/session/session.php";

// Deklarasi variable keyword buah.
$parent_code = $_GET["query"];

// Query ke database.
$query  = $connect->query("SELECT * FROM teomjobtitle WHERE jobtitle_code LIKE '%$parent_code%' ORDER BY created_date DESC");

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['jobtitle_name_en'],
            'parent'  => $data['jobtitle_code']
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
