<?php 
include "../../../application/session/session_ess.php";

$id     = $_POST['dc'];

$sql_get_data       = mysqli_query($connect, "SELECT 
a.doctorhospital_code,
a.doctorhospital_name,
a.doctorhospital_address,
a.doctorhospital_phone,
a.doctorhospital_type
FROM hrmdoctorhospital a 
WHERE a.doctorhospital_code = '$id'");

$data               = mysqli_fetch_assoc($sql_get_data);

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Code *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_code" id="edit_code" type="Text" value="<?php echo $data['doctorhospital_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Name *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_name" id="edit_name" type="Text" value="<?php echo $data['doctorhospital_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Type *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="edit_type" id="edit_type" style="width: ;height: 30px;">
                                                       <option value="HS" <?php if($data['doctorhospital_type'] == 'HS'){ echo 'selected'; } ?>>Hospital</option>
                                                       <option value="DR" <?php if($data['doctorhospital_type'] == 'DR'){ echo 'selected'; } ?>>Doctor</option>
                            </select>
                        </div>
                        
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3 name">Address *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <textarea class="textarea--style-6" id="edit_address" name="edit_address" placeholder=""><?php echo $data['doctorhospital_address']; ?></textarea>

                        </div>
                        
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-3 name">Phone</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_phone" id="edit_phone" type="Text" value="<?php echo $data['doctorhospital_phone']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
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
                                                                                    class="btn btn-danger btn-sm" id="delete_dochos"
                                                                                    >Delete</button>
                                                                                                                                                        
                                                                             <button type="submit" id="edit_dochos" id1=""
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>