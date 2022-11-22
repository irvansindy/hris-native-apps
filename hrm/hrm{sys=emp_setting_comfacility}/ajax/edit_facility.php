<?php 

include "../../../application/session/session_ess.php";

$fc             = $_POST['fc'];

$sql_fc         = mysqli_query($connect, "SELECT 
a.facility_code,
a.facility_name,
a.facility_desc
FROM hrmfacility a 
WHERE a.facility_code = '$fc'");

$data_fc        = mysqli_fetch_assoc($sql_fc);

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Facility Code *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_fc" id="edit_fc" type="Text" value="<?php echo $data_fc['facility_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Facility Name *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_fm" id="edit_fm" type="Text" value="<?php echo $data_fc['facility_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Facility Description *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            
                                                               <textarea class="textarea--style-6" id="edit_fd" name="edit_fd" placeholder=""><?php echo $data_fc['facility_desc']; ?></textarea>
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
                                                                                    class="btn btn-danger btn-sm" id="delete_facility"
                                                                                    >Delete</button>

                                                                                                                                                        
                                                                             <button type="submit" id="edit_facility" id1=""
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>