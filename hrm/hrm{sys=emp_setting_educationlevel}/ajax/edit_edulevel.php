<?php 
include "../../../application/session/session_ess.php";

$el                     = $_POST['el'];

$sql_data_edutype       = mysqli_query($connect, "SELECT 
MAX(a.edutype_level) AS level_max
FROM hrmedulevel a 
");

$data_edutype           = mysqli_fetch_assoc($sql_data_edutype);
$max                    = $data_edutype['level_max'];


$sql_data_edulevel      = mysqli_query($connect, "SELECT 
a.edutype_code,
a.edutype_name_en,
a.edutype_name_id,
a.edutype_level,
a.`status`
FROM hrmedulevel a
WHERE a.edutype_code = '$el'");

$data_edulevel          = mysqli_fetch_assoc($sql_data_edulevel);


?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-4 name">Education Type Code *</div>
                    <div class="col-sm-8" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_etc" id="edit_etc" type="Text" value="<?php echo $data_edulevel['edutype_code'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 name">Education Type Name *</div>
                        <div class="col-sm-8">
                            <div class="from-row">
                                <div class="col-sm-12" style="padding-left:0px">
                                    <div class="from-row">
                                        <div class="col-sm-10">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="edit_etm_en" id="edit_etm_en" type="Text" value="<?php echo $data_edulevel['edutype_name_en'] ?>"
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
                                                                name="edit_etm_id" id="edit_etm_id" type="Text" value="<?php echo $data_edulevel['edutype_name_id'] ?>"
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
                    <div class="col-4 name">Education Type Level *</div>
                    <div class="col-sm-8" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="edit_etl" id="edit_etl" style="width: ;height: 27px;">
                                <option value="">--SELECT ONE--</option>
                                <?php 
                                    for($i = 1; $i<= $max+1; $i++){                                
                                ?>
                                <option value="<?php echo $i; ?>" <?php if($data_edulevel['edutype_level'] == $i){ echo 'selected'; } ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row" style="margin-top:5px">
                    <div class="col-4">Status</div>
                        <div class="col-sm-1" style="padding-left:20px">
                            <div class="input-group">
                                <input class="form-check-input" type="checkbox" value="" id1="<?php echo $data_edulevel['status'] ?>" id="edit_ets" <?php if($data_edulevel['status'] == '1'){ echo 'checked'; } ?>>
                            </div>
                        </div>
                                          <div class="col-sm-2">
                                                 <div class="input-group">
                                                        Active
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
                                                                                    class="btn btn-danger btn-sm" id="delete_educationlevel"
                                                                                    >Delete</button>

                                                                                                                                                        
                                                                             <button type="submit" id="edit_educationlevel" id1=""
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<script>
$(document).ready(function() {
    $(document).on('change', '#edit_ets', function(){
        var status      = $(this).attr('id1');
        // alert(status);
        if(status == '1'){
            $('#edit_ets').attr('id1', '0');
        }else if(status == '0'){
            $('#edit_ets').attr('id1', '1');
        }
    });
});
</script>