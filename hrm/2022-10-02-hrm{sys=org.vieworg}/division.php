
<option value="0"> Choose Division</option>
<?php include "../../application/session/session.php";




$dir   = $_POST['dir'];
    $query_dir  = mysqli_query($connect, "SELECT 
    DISTINCT(a.division_id),
    a.division_name
    FROM od_tempmigrateorgunit a
    WHERE a.division_id IS NOT NULL AND a.division_id <> '' AND a.division_name <> '' AND a.division_name <> '-'
    AND a.direktorat_id = '$dir'");

while($data_dir = mysqli_fetch_assoc($query_dir)){
?>
    <option value="<?php echo $data_dir['division_id']; ?>"><?php echo $data_dir['division_name']; ?></option>
<?php } ?>

