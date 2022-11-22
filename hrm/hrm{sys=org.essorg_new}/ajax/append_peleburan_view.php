<?php 
include "../../../application/session/session_ess.php";
$i      = $_POST['i'];
$row    = 'row'.$i;
$parsing = $_POST['parsing'];
?>
<tr id="<?php echo $row; ?>" class="dynamic-added">
<td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_leader_pos_view[]" id="peleburan_leader_pos_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_pos_name_view[]" id="peleburan_pos_name_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_pos_code_view[]" id="peleburan_pos_code_view<?php echo $i; ?>" type="Text" value="" id1="0"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="20%" id="pel_cc<?php echo $i; ?>">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_cost_center_view[]" id="peleburan_cost_center_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%" id="pel_wl<?php echo $i; ?>">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_work_location_view[]" id="peleburan_work_location_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%" id="pel_js<?php echo $i; ?>">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_job_status_view[]" id="peleburan_job_status_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%" id="pel_jt<?php echo $i; ?>">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_job_title_view[]" id="peleburan_job_title_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_reason_view[]" id="peleburan_reason_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_remarks_view[]" id="peleburan_remarks_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <button type="button" name="remove" id1="<?php echo $i ?>" class="btn btn-danger btn_remove btn-sm">X</button>
                                                        </td>
                                                 </tr>
<script type="text/javascript">
        var i = '<?php echo $i ?>';
        var parsing = '<?php echo $parsing ?>';
            $(document).ready(function() {

                $( "#peleburan_leader_pos_view"+i+"" ).autocomplete({
                    serviceUrl: "ajax/leader_pos.php?aus="+parsing,   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#peleburan_leader_pos_view"+i+"" ).val("" + suggestion.value);
                        $( "#peleburan_leader_pos_view"+i+"" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script>

<script type="text/javascript">
$(document).ready(function() {
    var i = '<?php echo $i ?>';
    var view = '2';
    $( "#peleburan_pos_code_view"+i+"" ).autocomplete({
                    serviceUrl: "ajax/get_poscode.php?aus="+$("#parsing").val(),   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#peleburan_pos_code_view"+i+"" ).val("" + suggestion.value);
                        $( "#peleburan_pos_code_view"+i+"" ).attr('id1', suggestion.pos_code);


                        let formData = new FormData();
                        formData.append('pos_code', suggestion.pos_code);
                        formData.append('number', i);
                        formData.append('view', view);

                        $.ajax({
                            type: 'POST',
                            url: "ajax_leader_pos.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#peleburan_leader_pos_view"+i+"").attr("id1", msg.leader_pos_code);
                                    $("#peleburan_leader_pos_view"+i+"").val("" + msg.leader_position);
                                    $("#peleburan_pos_name_view"+i+"").val("" + msg.position_name);
                                    $("#peleburan_leader_pos_view"+i+"").prop("disabled", false);
                                    $("#peleburan_pos_name_view"+i+"").prop("disabled", false);

                                },
                                   
                        });

                        $.ajax({
                            type: 'POST',
                            url: "ajax_ambil_cc.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pel_cc"+i+"").html(msg);

                                },
                                   
                        });

                        $.ajax({
                            type: 'POST',
                            url: "ajax_ambil_wl.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pel_wl"+i+"").html(msg);

                                },
                                   
                        });

                        $.ajax({
                            type: 'POST',
                            url: "ajax_ambil_js.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pel_js"+i+"").html(msg);

                                },
                                   
                        });

                        $.ajax({
                            type: 'POST',
                            url: "ajax_ambil_jt.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,  
                                success: function (msg) {
                                    $("#pel_jt"+i+"").html(msg);

                                },
                                   
                        });
                    }
                });
})
</script>