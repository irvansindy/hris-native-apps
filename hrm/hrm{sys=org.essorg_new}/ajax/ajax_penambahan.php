<?php 
include "../../../application/session/session_ess.php";

$pos_id = $_POST['id'];
?>

<div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.9%; margin: 5px;overflow: scroll;">
<input type="hidden" id="parsing" value="<?php echo $pos_id; ?>">
                                   <div class="form-row" style="width:150%">
                                   <table class="table table-bordered table-striped table-hover">
                                          <thead>
                                                 <tr>
                                                        <th>Org Unit/Position</th>
                                                        <th>Leader Position</th>
                                                        <th>Position Name</th>
                                                        <th>Cost Center</th>
                                                        <th>Work Location</th>
                                                        <th>Job Status</th>
                                                        <th>Jobtitle Code</th>
                                                        <th>Reason</th>
                                                        <th>Remarks</th>
                                                        <th>Aksi</th>
                                                 </tr>
                                          </thead>
                                          <tbody id="addrow_manual">
                                                 <tr id="rowab" class="dynamic-added">
                                                        <td>
                                                               <select class="input--style-6" name="penambahan_orgorpos[]" id="penambahan_orgorpos" style="width: ;height: 30px;">
                                                                      <option value="">Choose</option>
                                                                      <option value="1">ORG UNIT</option>
                                                                      <option value="2">POSITION</option>
                                                               </select>
                                                        </td>
                                                        <td width="15%">
                                                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_leader_pos[]" id="penambahan_leader_pos" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_pos_name[]" id="penambahan_pos_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="9%">
                                                            <select class="input--style-6" name="penambahan_cost_center[]" id="penambahan_cost_center" style="width: ;height: 30px;">
                                                                <option value="0">Choose</option>
                                                        <?php 
                                                            $sql_cost_center        = mysqli_query($connect, "SELECT 
                                                            a.costcenter_code,
                                                            a.costcenter_name_en
                                                            FROM teomcostcenter a");
                                                            while($data_cc  = mysqli_fetch_assoc($sql_cost_center)){
                                                        ?>
                                                                <option value="<?php echo $data_cc['costcenter_code'] ?>"><?php echo $data_cc['costcenter_name_en'] ?></option>
                                                        <?php } ?>
                          
                                                            </select>
                                                        </td>
                                                        <td width="9%">
                                                            <select class="input--style-6" name="penambahan_work_location[]" id="penambahan_work_location" style="width: ;height: 30px;">
                                                                <option value="0">Choose</option>
                                                        <?php 
                                                            $sql_work_location      = mysqli_query($connect, "SELECT 
                                                            a.worklocation_code,
                                                            a.worklocation_name
                                                            FROM teomworklocation a");
                                                            while($data_wc  = mysqli_fetch_assoc($sql_work_location)){
                                                        ?>
                                                                <option value="<?php echo $data_wc['worklocation_code'] ?>"><?php echo $data_wc['worklocation_name'] ?></option>
                                                        <?php } ?>
                          
                                                            </select>
                                                        </td>
                                                        <td width="9%">
                                                            <select class="input--style-6" name="penambahan_job_status[]" id="penambahan_job_status" style="width: ;height: 30px;">
                                                                <option value="0">Choose</option>
                                                        <?php 
                                                            $sql_job_status         = mysqli_query($connect, "SELECT 
                                                            a.jobstatuscode,
                                                            a.jobstatusname_en
                                                            FROM teomjobstatus a");
                                                            while($data_js  = mysqli_fetch_assoc($sql_job_status)){
                                                        ?>
                                                                <option value="<?php echo $data_js['jobstatuscode'] ?>"><?php echo $data_js['jobstatusname_en'] ?></option>
                                                        <?php } ?>
                          
                                                            </select>
                                                        </td>
                                                        <td width="9%">
                                                            <select class="input--style-6" name="penambahan_job_title[]" id="penambahan_job_title" style="width: ;height: 30px;">
                                                                <option value="0">Choose</option>
                                                        <?php 
                                                            $sql_job_title          = mysqli_query($connect, "SELECT 
                                                            a.jobtitle_code,
                                                            a.jobtitle_name_en
                                                            FROM teomjobtitle a");
                                                            while($data_jt  = mysqli_fetch_assoc($sql_job_title)){
                                                        ?>
                                                                <option value="<?php echo $data_jt['jobtitle_code'] ?>"><?php echo $data_jt['jobtitle_name_en'] ?></option>
                                                        <?php } ?>
                          
                                                            </select>
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_reason[]" id="penambahan_reason" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_remarks[]" id="penambahan_remarks" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                            <button type="button" name="add" id="add" class="btn btn-success btn-sm">+</button>
                                                        </td>
                                                 </tr>
                                          </tbody>
                                   </table>
                                
                                   </div>
</div>
                                   

  <!-- Mengambil Leader Position -->

  <script type="text/javascript">
            $(document).ready(function() {

                $( "#penambahan_leader_pos" ).autocomplete({
                    serviceUrl: "ajax/leader_pos.php?aus="+$("#parsing").val(),   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#penambahan_leader_pos" ).val("" + suggestion.value);
                        $( "#penambahan_leader_pos" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script>

 <!-- Mengambil Leader Position -->

<script type="text/javascript">
$(document).ready(function() {
var i=0;  
 $('#add').click(function(){  

i++; 

$.ajax({
    url: "ajax/append_penambahan.php",
    type: "POST",
            data: {
                    i: i,
            },
            success: function(ajaxData) {
                    $("#addrow_manual").append(ajaxData);

                    $( "#penambahan_leader_pos"+i+"" ).autocomplete({
                    serviceUrl: "ajax/leader_pos.php?aus="+$("#parsing").val(),   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#penambahan_leader_pos"+i+"" ).val("" + suggestion.value);
                        $( "#penambahan_leader_pos"+i+"" ).attr('id1', suggestion.parent);
                    }
                });

                    return false;

            }
    });

 

// $('#count').val($i);

});

$(document).on('click', '.btn_remove', function(){  

var button_id = $(this).attr("id");   

$('#row'+button_id+'').remove();  

i--;  

$('#count').val($i);

});  
});
</script>
