<?php 
include "../../../application/session/session_ess.php";

$i      = $_POST['i'];
$row    = 'row'.$i;
$select = 'test-select-'.$i;

$sql_emp    = mysqli_query($connect, "SELECT 
a.emp_no,
CONCAT(a.Full_Name, ' [', a.emp_no, ']') AS nama
FROM view_employee a");

$sql_facility   = mysqli_query($connect, "SELECT 
a.facility_code,
a.facility_name
FROM teomfacility a");
?>

<tr id="<?php echo $row; ?>" class="dynamic-added">
    <!-- <td>
        <input class="form-check-input" type="checkbox" value="" id1="0" id="tambah_ets">
    </td> -->
    <td>
        <div class="input-group">
                                            <select id="edit_facility" class="input--style-6" name="edit_facility[]" style="width: ;height: 30px;">
                                                    <?php 
                                                        while($data_facility = mysqli_fetch_assoc($sql_facility)){
                                                    ?>
                                                    <option value="<?php echo $data_facility['facility_code'] ?>"><?php echo $data_facility['facility_name'] ?></option>
                                                    <?php } ?>
                                                </select>
        </div>
    </td>
    <td><input class="form-check-input" type="checkbox" value="0" id1="0" name="edit_newhire[]" id="edit_newhire"></td>
    <td><input class="form-check-input" type="checkbox" value="0" id1="0" name="edit_exit[]" id="edit_exit"></td>
    <td> 
        <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
            <select id="<?php echo $select; ?>" multiple="multiple" class="framework edit_pic" name="edit_pic[]" >
                <?php 
                    while($data_emp = mysqli_fetch_assoc($sql_emp)){
                ?>
                <option value="<?php echo $data_emp['emp_no'] ?>"><?php echo $data_emp['nama'] ?></option>
                <?php } ?>
            </select>
        </div>    
    </td>
    <!-- <td>Doe</td> -->
    <td>
        <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove btn-sm">X</button>
    </td>
</tr>