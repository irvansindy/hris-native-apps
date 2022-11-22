
<option value="0"> Choose Department</option>
<?php include "../../application/session/session.php"; 
if($_SESSION['user_type'] == 'SuperAdmin'){
    $level            = '1';
}elseif($_SESSION['user_type'] == 'Admin'){
    $level            = '2';
}
$emp_no   = $_SESSION['username'];
$div   = $_POST['division'];


// validasi filter direktorat atau divisi
$validasi   = mysqli_query($connect, "SELECT 
DISTINCT(a.direktorat_id),
a.direktorat_name
FROM od_tempmigrateorgunit a
WHERE a.direktorat_id = '$div'");

$val    = mysqli_num_rows($validasi);
// validasi filter direktorat atau divisi

if($val == '0'){
    $query_div  = mysqli_query($connect, "SELECT 
    DISTINCT(a.departemen_id),
    a.departemen_name
    FROM od_tempmigrateorgunit a
    WHERE a.departemen_id IS NOT NULL AND a.departemen_id <> '' AND a.departemen_name <> '' AND a.departemen_name <> '-'
    AND a.division_id = '$div'");
}elseif($val >= '1'){
    $query_div  = mysqli_query($connect, "SELECT 
    DISTINCT(a.departemen_id),
    a.departemen_name
    FROM od_tempmigrateorgunit a
    WHERE (a.departemen_id IS NOT NULL AND (a.division_id IS NULL OR a.division_id = '' AND a.departemen_name <> '' AND a.departemen_name <> '-'))
    AND a.departemen_id <> ''
    AND a.direktorat_id = '$div'");
}
while($data_div = mysqli_fetch_assoc($query_div)){
?>
    <option value="<?php echo $data_div['departemen_id']; ?>"><?php echo $data_div['departemen_name']; ?></option>
<?php } ?>

