<?php 
include "../../../application/session/session_ess.php";

$id            = $_POST['dc'];

$sql_dm         = mysqli_query($connect, "SELECT 
a.doc_code,
a.doc_name,
a.remind_befnum,
a.remind_beftype
FROM hrmdoctype a 
WHERE a.doc_code = '$id'");

$data_dm        = mysqli_fetch_assoc($sql_dm);

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Document Name *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_dm" id="edit_dm" type="Text" value="<?php echo $data_dm['doc_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3 name">Reminder</div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <div class="from-row">
                                <div class="col-sm-6">
                                    <select class="input--style-6" name="edit_day" id="edit_day" style="width: ;height: 27px;">
                                        <option value="1" <?php if($data_dm['remind_befnum'] == '1'){ echo 'selected'; } ?>>1</option>
                                        <option value="2" <?php if($data_dm['remind_befnum'] == '2'){ echo 'selected'; } ?>>2</option>
                                        <option value="3" <?php if($data_dm['remind_befnum'] == '3'){ echo 'selected'; } ?>>3</option>
                                        <option value="4" <?php if($data_dm['remind_befnum'] == '4'){ echo 'selected'; } ?>>4</option>
                                        <option value="5" <?php if($data_dm['remind_befnum'] == '5'){ echo 'selected'; } ?>>5</option>
                                        <option value="6" <?php if($data_dm['remind_befnum'] == '6'){ echo 'selected'; } ?>>6</option>

                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="input--style-6" name="edit_daytpe" id="edit_daytpe" style="width: ;height: 27px;">
                                        <option value="Day" <?php if($data_dm['remind_beftype'] == 'Day'){ echo 'selected'; } ?>>Day</option>
                                        <option value="Week" <?php if($data_dm['remind_beftype'] == 'Week'){ echo 'selected'; } ?>>Week</option>
                                        <option value="Month" <?php if($data_dm['remind_beftype'] == 'Month'){ echo 'selected'; } ?>>Month</option>
                                       
                                    </select>
                                </div>
                            </div>
                            
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
                                                                           
                                                                             <button type="button"
                                                                                    class="btn btn-danger btn-sm" id="delete_docman" id1="<?php echo $id; ?>"
                                                                                    >Delete</button>

                                                                             
                                                                             <button type="submit" id="edit_docman" id1="<?php echo $id; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>