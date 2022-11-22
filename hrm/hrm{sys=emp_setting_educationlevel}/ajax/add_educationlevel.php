<?php 
include "../../../application/session/session_ess.php";
$sql_data_edutype       = mysqli_query($connect, "SELECT 
MAX(a.edutype_level) AS level_max
FROM hrmedulevel a 
");

$data_edutype           = mysqli_fetch_assoc($sql_data_edutype);
$max                    = $data_edutype['level_max'];


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
                                                               name="tambah_etc" id="tambah_etc" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
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
                                                                name="tambah_etm_en" id="tambah_etm_en" type="Text" value=""
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
                                                                name="tambah_etm_id" id="tambah_etm_id" type="Text" value=""
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
                            <select class="input--style-6" name="tambah_etl" id="tambah_etl" style="width: ;height: 27px;">
                                <option value="">--SELECT ONE--</option>
                                <?php 
                                    for($i = 1; $i<= $max+1; $i++){                                
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row" style="margin-top:5px">
                    <div class="col-4">Status</div>
                        <div class="col-sm-1" style="padding-left:20px">
                            <div class="input-group">
                                <input class="form-check-input" type="checkbox" value="" id1="0" id="tambah_ets" >
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
                                                                           
                                                                                                                                                        
                                                                             <button type="submit" id="tambah_educationlevel" id1=""
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<script>
$(document).ready(function() {
    $(document).on('change', '#tambah_ets', function(){
        var status      = $(this).attr('id1');
        // alert(status);
        if(status == '1'){
            $('#tambah_ets').attr('id1', '0');
        }else if(status == '0'){
            $('#tambah_ets').attr('id1', '1');
        }
    });
});
</script>