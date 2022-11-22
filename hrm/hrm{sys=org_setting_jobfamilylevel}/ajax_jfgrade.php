<?php 
include "../../application/session/session.php";

$id     = $_POST['id'];

$sql_jfgrade    = mysqli_query($connect, "SELECT
a.jfgrade_code, 
CONCAT(a.jfgrade_code, ' ', '-', ' ', a.jfgrade_name_en) AS jfgrade_name
FROM 
teomjfgrade a");


if($id == '0'){ ?>
<option value="0">--No Job Family Grade--</option>
<?php }else{

while($data_jfgrade = mysqli_fetch_assoc($sql_jfgrade)){

?>
<option value="<?php echo $data_jfgrade['jfgrade_code'] ?>"><?php echo $data_jfgrade['jfgrade_name']; ?></option>
<?php } }?>