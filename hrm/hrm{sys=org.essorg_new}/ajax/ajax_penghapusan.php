<?php 
include "../../../application/session/session_ess.php";

$pos_id = $_POST['id'];
?>

<div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.9%; margin: 5px;overflow: scroll;">
<input type="hidden" id="parsing" value="<?php echo $pos_id; ?>">
                                   <div class="form-row" style="width:150%">
                                   <table class="table table-bordered table-striped table-hover" width="">
                                          <thead>
                                                 <tr>
                                                        <th>Leader Position</th>
                                                        <th>Position Name</th>
                                                        <th>Position Code</th>
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
                                                        <td width="15%">
                                                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_leader_pos" id="penghapusan_leader_pos" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="15%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_pos_name" id="penghapusan_pos_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="15%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_pos_code[]" id="penghapusan_pos_code" type="Text" value="" id1="0"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_cost_center" id="penghapusan_cost_center" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_work_location" id="penghapusan_work_location" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_job_status" id="penghapusan_job_status" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_job_title" id="penghapusan_job_title" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_reason[]" id="penghapusan_reason" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_remaks[]" id="penghapusan_remaks" type="Text" value=""
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

                $( "#penghapusan_pos_code" ).autocomplete({
                    serviceUrl: "ajax/get_poscode.php?aus="+$("#parsing").val(),   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#penghapusan_pos_code" ).val("" + suggestion.value);
                        $( "#penghapusan_pos_code" ).attr('id1', suggestion.pos_code);

                        $.ajax({
                                    type: 'POST',
                                    url: "ajax_penghapusan.php",
                                    data: {id:suggestion.pos_code},
                                    dataType: "JSON",   
                                success: function (msg) {
                                    $('#penghapusan_leader_pos').attr('id1', msg.leader_pos_code);
                                    $('#penghapusan_leader_pos').val("" + msg.leader_position);
                                    $('#penghapusan_pos_name').val("" + msg.position_name);
                                    $('#penghapusan_cost_center').val("" + msg.costcenter_code);
                                    $('#penghapusan_work_location').attr('id1', msg.worklocation_code);
                                    $('#penghapusan_work_location').val("" + msg.worklocation_name);
                                    $('#penghapusan_job_status').attr('id1', msg.jobstatuscode);
                                    $('#penghapusan_job_status').val("" + msg.jobstatusname_en);
                                    $('#penghapusan_job_title').attr('id1', msg.jobtitle_code);
                                    $('#penghapusan_job_title').val("" + msg.jobtitle_name_en);
                                },
                                
                        });
                    }
                });
            })
</script>

 <!-- Mengambil Leader Position -->

<script type="text/javascript">
$(document).ready(function() {
var i=0;  
 $('#add').click(function(){  

    if(i == 0){
        var validasi =  $( "#penghapusan_pos_code" ).val();
    }else{
        var validasi =  $( "#penghapusan_pos_code"+i+"" ).val();
    }

    if(validasi == ''){
        alert('Please fill currect row before add row!');
        return;
    }
i++; 

$.ajax({
    url: "ajax/append_penghapusan.php",
    type: "POST",
            data: {
                    i: i,
            },
            success: function(ajaxData) {
                    $("#addrow_manual").append(ajaxData);

                    

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
