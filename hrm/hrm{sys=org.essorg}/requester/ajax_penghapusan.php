<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
include "../../../application/session/session_ess.php";



$emp_no     = $_SESSION['username'];


// Deklarasi variable keyword buah.
$id         = $_POST["id"];

// Query ke database.
$query  = mysqli_query($connect, "SELECT 
b.position_id AS leader_pos_code,
b.pos_name_en AS leader_position,
a.pos_name_en AS position_name,
a.pos_code,
a.costcenter_code,
c.worklocation_code,
c.worklocation_name,
a.jobstatuscode,
d.jobstatusname_en,
e.jobtitle_code,
e.jobtitle_name_en
FROM hrmorgstruc a
LEFT JOIN hrmorgstruc b ON b.position_id = a.parent_id
LEFT JOIN teomworklocation c ON c.worklocation_code = a.lstworklocation
LEFT JOIN teomjobstatus d ON d.jobstatuscode = a.jobstatuscode
LEFT JOIN teomjobtitle e ON e.jobtitle_code = a.jobtitle_code
WHERE a.position_id = '$id'");

// Fetch hasil query.
$result = mysqli_fetch_assoc($query);
$count  = mysqli_num_rows($query);

// Cek apakah ada yang cocok atau tidak.
if ($count > 0) {
    $output['leader_pos_code']      = $result['leader_pos_code'];
    $output['leader_position']      = $result['leader_position'];
    $output['position_name']        = $result['position_name'];
    $output['pos_code']             = $result['pos_code'];
    $output['costcenter_code']      = $result['costcenter_code'];
    $output['worklocation_code']    = $result['worklocation_code'];
    $output['worklocation_name']    = $result['worklocation_name'];
    $output['jobstatuscode']        = $result['jobstatuscode'];
    $output['jobstatusname_en']     = $result['jobstatusname_en'];
    $output['jobtitle_code']        = $result['jobtitle_code'];
    $output['jobtitle_name_en']     = $result['jobtitle_name_en'];

    // Encode ke JSON.
    echo json_encode($output);

    // Jika tidak ada yang cocok.
} else {
    
        $output['leader_position']      = '';
        $output['position_name']        = '';
        $output['pos_code']             = '';
        $output['costcenter_code']      = '';
        $output['worklocation_name']    = '';
        $output['jobstatusname_en']     = '';
        $output['jobtitle_name_en']     = '';
        $output['worklocation_code']    = '';
        $output['jobstatuscode']        = '';
    
    // Encode ke JSON.
    echo json_encode($output);
}
