<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
include "../../../application/session/session_ess.php";



$emp_no     = $_SESSION['username'];


// Ambil data div dan dept 
$sql_parent_path     = mysqli_query($connect, "SELECT 
parent_path
FROM view_employee WHERE emp_no = '$emp_no'");

$data_parent_path   = mysqli_fetch_assoc($sql_parent_path);
$in_position        = str_replace(",", "','", $data_parent_path['parent_path']);
$final_inposition   = "'".$in_position."'";

$sql_ambil_div          = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en
FROM hrmorgstruc a 
WHERE a.position_id IN ($final_inposition)
AND (a.org_level = 'DIV')
ORDER BY a.pos_level ASC
LIMIT 1
");

$count_ambil_divisi     = mysqli_num_rows($sql_ambil_div);

$sql_ambil_dept          = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en
FROM hrmorgstruc a 
WHERE a.position_id IN ($final_inposition)
AND (a.org_level = 'DEP')
ORDER BY a.pos_level ASC
");

$count_ambil_dept     = mysqli_num_rows($sql_ambil_dept);


$data_ambil_divisi  = mysqli_fetch_assoc($sql_ambil_div);

$data_ambil_dept    = mysqli_fetch_assoc($sql_ambil_dept);



// Ambil data div dan dept 


// Deklarasi variable keyword buah.
$parent_code = $_GET["query"];

// Query ke database.
$query  = $connect->query("SELECT * FROM hrmorgstruc 
WHERE pos_code LIKE '%$parent_code%' 
AND (parent_path LIKE '%,$data_ambil_dept[position_id]%')
AND pos_active = '1'
AND pos_flag = '2'
ORDER BY position_id DESC");

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['pos_code'],
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
