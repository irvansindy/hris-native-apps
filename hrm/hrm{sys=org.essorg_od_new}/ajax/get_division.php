<?php
// Set header type konten.

// Deklarasi variable untuk koneksi ke database.
include "../../../application/session/session_ess.php";



$position_id     = $_POST['position_id'];

$get_department     = mysqli_query($connect, "SELECT a.position_id, a.pos_name_en FROM hrmorgstruc a 
WHERE a.parent_path LIKE '%$position_id%'
AND a.org_level = 'DEP'");


while($data_dept    = mysqli_fetch_assoc($get_department)){
?>
<option value="<?php echo $data_dept['position_id'] ?>"><?php echo $data_dept['pos_name_en'] ?></option>
<?php } ?>
