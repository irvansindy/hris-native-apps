<?php 
include "../../../application/session/session_ess.php";

$pos_id = $_POST['id'];
?>

<div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.9%; margin: 5px;overflow: scroll;">
<input type="hidden" id="parsing" value="<?php echo $pos_id; ?>">
                                   <div class="form-row" style="width:160%">
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
                                                               name="pemisahan_leader_pos[]" id="pemisahan_leader_pos" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="15%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_pos_name[]" id="pemisahan_pos_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="15%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_pos_code[]" id="pemisahan_pos_code" type="Text" value="" id1="0"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="10%" id="pel_cc">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_cost_center[]" id="pemisahan_cost_center" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="8%" id="pel_wl">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_work_location[]" id="pemisahan_work_location" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%" id="pel_js">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_job_status[]" id="pemisahan_job_status" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%" id="pel_jt">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_job_title[]" id="pemisahan_job_title" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_reason[]" id="pemisahan_reason" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_remarks[]" id="pemisahan_remarks" type="Text" value=""
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

                
            })
</script>

<script type="text/javascript">
            $(document).ready(function() {

                $( "#pemisahan_leader_pos" ).autocomplete({
                    serviceUrl: "ajax/leader_pos.php?aus="+$("#parsing").val(),   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#pemisahan_leader_pos" ).val("" + suggestion.value);
                        $( "#pemisahan_leader_pos" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script>

 <!-- Mengambil Leader Position -->

<script type="text/javascript">
$(document).ready(function() {
var i=0;  
var parsing = $("#parsing").val()
 $('#add').click(function(){  

    if(i == 0){
        var validasi =  $( "#pemisahan_pos_code" ).val();
    }else{
        var validasi =  $( "#pemisahan_pos_code"+i+"" ).val();
    }

    if(validasi == ''){
        alert('Please fill currect row before add row!');
        return;
    }
i++; 

$.ajax({
    url: "ajax/append_pemisahan.php",
    type: "POST",
            data: {
                    i: i, parsing: parsing,
            },
            success: function(ajaxData) {
                    $("#addrow_manual").append(ajaxData);

                    return false;

            }
    });

 

// $('#count').val($i);

});

// Bukan Addrow
$( "#pemisahan_pos_code" ).autocomplete({
                    serviceUrl: "ajax/get_poscode.php?aus="+$("#parsing").val(),   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#pemisahan_pos_code" ).val("" + suggestion.value);
                        $( "#pemisahan_pos_code" ).attr('id1', suggestion.pos_code);

                        let formData = new FormData();
                        formData.append('pos_code', suggestion.pos_code);
                        formData.append('number', i);

                        $.ajax({
                            type: 'POST',
                            url: "ajax_leader_pos.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pemisahan_leader_pos").attr("id1", msg.leader_pos_code);
                                    $("#pemisahan_leader_pos").val("" + msg.leader_position);
                                    $('#pemisahan_pos_name').val("" + msg.position_name);
                                    $("#pemisahan_leader_pos").prop("disabled", false);
                                    $("#pemisahan_pos_name").prop("disabled", false);

                                },
                                   
                        });

                        $.ajax({
                            type: 'POST',
                            url: "ajax_ambil_cc_pl.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pel_cc").html(msg);

                                },
                                   
                        });

                        $.ajax({
                            type: 'POST',
                            url: "ajax_ambil_wl_pl.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pel_wl").html(msg);

                                },
                                   
                        });

                        $.ajax({
                            type: 'POST',
                            url: "ajax_ambil_js_pl.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pel_js").html(msg);

                                },
                                   
                        });

                        $.ajax({
                            type: 'POST',
                            url: "ajax_ambil_jt_pl.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pel_jt").html(msg);

                                },
                                   
                        });
                    }
});

$(document).on('click', '.btn_remove', function(){  

var button_id = $(this).attr("id");   

$('#row'+button_id+'').remove();  

i--;  

$('#count').val($i);

});  
});
</script>
