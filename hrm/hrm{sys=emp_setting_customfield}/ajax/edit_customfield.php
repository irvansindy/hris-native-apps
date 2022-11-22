<?php 
include "../../../application/session/session_ess.php";

$id     = $_POST['id'];

$sql_customfield    = mysqli_query($connect, "SELECT 
a.customfield_no,
a.customfield_name_en,
a.customfield_name_id,
a.config_string
FROM hrmcustomfield a
WHERE a.customfield_no = '$id'");

$customfield        = mysqli_fetch_assoc($sql_customfield);

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                
                <div class="form-row">
                    <div class="col-3 name">Custom Field Name *</div>
                        <div class="col-sm-9">
                            <div class="from-row">
                                <div class="col-sm-12" style="padding-left:0px">
                                    <div class="from-row">
                                        <div class="col-sm-10">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="cf_name_en" id="cf_name_en" type="Text" value="<?php echo $customfield['customfield_name_en'] ?>"
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <img src="img/flag_en.png" alt="">    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="from-row" style="margin-top:40px">
                                        <div class="col-sm-10">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="cf_name_id" id="cf_name_id" type="Text" value="<?php echo $customfield['customfield_name_id'] ?>"
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                                            </div>
                                        </div>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <img src="img/flag_id.png" alt="">    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3 name">Config String *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <textarea class="textarea--style-6" id="cf_string" name="cf_string" placeholder="Address"><?php echo $customfield['config_string'] ?></textarea>

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
                                                                           
                                                                             <button type="button" id1="<?php echo $id; ?>"
                                                                                    class="btn btn-danger btn-sm" id="delete_cfield"
                                                                                    >Delete</button>

                                                                             
                                                                             <button type="submit" id="edit_cfield" id1="<?php echo $id; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>