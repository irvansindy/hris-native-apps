<?php 
include "../../../application/session/session_ess.php";

$eic            = $_POST['eic'];

$sql_eic         = mysqli_query($connect, "SELECT 
a.descriptionId,
a.description,
a.groupId
FROM hrmsurveytdescription a
WHERE a.descriptionId = '$eic'");

$data_eic        = mysqli_fetch_assoc($sql_eic);

// Ambil data group pertanyaan
$sql_gpertanyaan    = mysqli_query($connect, "SELECT 
a.groupId,
a.groupName
FROM hrmsurveytgroup a");

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Nama Deskripsi *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_description" id="edit_description" type="Text" value="<?php echo $data_eic['description']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Group Pertanyaan *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="edit_gpertanyaan" id="edit_gpertanyaan" style="width: ;height: 27px;">
                                    <option value="">--SELECT ONE--</option>
                                    <?php 
                                        while($data_gpertanyaan = mysqli_fetch_assoc($sql_gpertanyaan)){
                                    ?>
                                        <option value="<?php echo $data_gpertanyaan['groupId'] ?>" <?php if($data_eic['groupId'] == $data_gpertanyaan['groupId']){ echo 'selected'; } ?>><?php echo $data_gpertanyaan['groupName'] ?></option>
                                    <?php } ?>
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
                                                                           
                                                                             <button type="button" id1="<?php echo $data_eic['descriptionId']; ?>"
                                                                                    class="btn btn-danger btn-sm" id="delete_desc"
                                                                                    >Delete</button>

                                                                             
                                                                             <button type="submit" id="edit_desc" id1="<?php echo $data_eic['descriptionId']; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>