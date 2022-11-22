<?php 
include "../../../application/session/session_ess.php";

$eic            = $_POST['eic'];

$sql_eic         = mysqli_query($connect, "SELECT 
a.groupId,
a.groupName,
a.`status`
FROM hrmsurveytgroup a
WHERE a.groupId = '$eic'");

$data_eic        = mysqli_fetch_assoc($sql_eic);

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Nama Group *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_nama_group" id="edit_nama_group" type="Text" value="<?php echo $data_eic['groupName']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Status *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="edit_status" id="edit_status" style="width: ;height: 27px;">
                                    <option value="">--SELECT ONE--</option>
                                    <option value="0" <?php if($data_eic['status'] == '0'){ echo 'selected'; } ?>>PERTANYAAN</option>
                                    <option value="1" <?php if($data_eic['status'] == '1'){ echo 'selected'; } ?>>ESSAY</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                
                <!-- <a href='#' id1='' id2='' class='' data-toggle='modal' id='' data-target='#modal-view-od-1'><img src='../../asset/img/icons/glasses.png'></a> -->
                
            </fieldset>


            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                           
                                                                             <button type="button" id1="<?php echo $data_eic['groupId']; ?>"
                                                                                    class="btn btn-danger btn-sm" id="delete_gpertanyaan"
                                                                                    >Delete</button>

                                                                             
                                                                             <button type="submit" id="edit_gpertanyaan" id1="<?php echo $data_eic['groupId']; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>