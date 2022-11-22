<?php 
include "../../../application/session/session_ess.php";

$eic            = $_POST['eic'];

$sql_eic         = mysqli_query($connect, "SELECT 
a.edu_code,
a.edu_name
FROM hrmeduinstitution a 
WHERE a.edu_code = '$eic'");

$data_eic        = mysqli_fetch_assoc($sql_eic);

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Educational Institution Code *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_eic" id="edit_eic" type="Text" value="<?php echo $data_eic['edu_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Educational Institution Name *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            
                                                               <textarea class="textarea--style-6" id="edit_eim" name="edit_eim" placeholder=""><?php echo $data_eic['edu_name']; ?></textarea>
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
                                                                           
                                                                             <button type="button" id1=""
                                                                                    class="btn btn-danger btn-sm" id="delete_eduinstitution"
                                                                                    >Delete</button>

                                                                             
                                                                             <button type="submit" id="edit_eduinstitution" id1=""
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>