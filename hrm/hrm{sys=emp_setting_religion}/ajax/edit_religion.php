<?php 
include "../../../application/session/session_ess.php";

$rc             = $_POST['rc'];

$sql_rc         = mysqli_query($connect, "SELECT 
a.religion_code,
a.religion_name_en,
a.religion_name_id
FROM hrmreligion a
WHERE a.religion_code = '$rc'");

$data_rc        = mysqli_fetch_assoc($sql_rc);

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Religion Code *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="rc" id="rc" type="Text" value="<?php echo $data_rc['religion_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Religion Name *</div>
                        <div class="col-sm-9">
                            <div class="from-row">
                                <div class="col-sm-12" style="padding-left:0px">
                                    <div class="from-row">
                                        <div class="col-sm-10">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="rm_en" id="rm_en" type="Text" value="<?php echo $data_rc['religion_name_en']; ?>"
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
                                                                name="rm_id" id="rm_id" type="Text" value="<?php echo $data_rc['religion_name_id']; ?>"
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
                
                <!-- <a href='#' id1='' id2='' class='' data-toggle='modal' id='' data-target='#modal-view-od-1'><img src='../../asset/img/icons/glasses.png'></a> -->
                
            </fieldset>


            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                           
                                                                             <button type="button" id1=""
                                                                                    class="btn btn-danger btn-sm" id="delete_religion"
                                                                                    data-dismiss="modal">Delete</button>

                                                                             
                                                                             <button type="submit" id="edit_religion" id1=""
                                                                                    class="btn btn-warning btn-sm submit" data-dismiss="modal">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>