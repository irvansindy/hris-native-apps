<?php 
include "../../../application/session/session_ess.php";
$i      = $_POST['i'];
$row    = 'row'.$i;
?>
<tr id="<?php echo $row; ?>" class="dynamic-added">
<td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_leader_pos" id="penghapusan_leader_pos<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_pos_name" id="penghapusan_pos_name<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_pos_code[]" id="penghapusan_pos_code<?php echo $i; ?>" type="Text" value="" id1="0"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_cost_center" id="penghapusan_cost_center<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_work_location" id="penghapusan_work_location<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_job_status" id="penghapusan_job_status<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="20%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_job_title" id="penghapusan_job_title<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_reason[]" id="penghapusan_reason<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_remaks[]" id="penghapusan_remaks<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove btn-sm">X</button>
                                                        </td>
                                                 </tr>

<script type="text/javascript">
$(document).ready(function() {
    var i = '<?php echo $i ?>';
    $( "#penghapusan_pos_code"+i+"" ).autocomplete({
                    serviceUrl: "ajax/get_poscode.php?aus="+$("#parsing").val(),   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#penghapusan_pos_code"+i+"" ).val("" + suggestion.value);
                        $( "#penghapusan_pos_code"+i+"" ).attr('id1', suggestion.pos_code);

                        $.ajax({
                                    type: 'POST',
                                    url: "ajax_penghapusan.php",
                                    data: {id:suggestion.pos_code},
                                    dataType: "JSON",   
                                success: function (msg) {
                                    $("#penghapusan_leader_pos"+i+"").attr("id1", msg.leader_pos_code);
                                    $("#penghapusan_leader_pos"+i+"").val("" + msg.leader_position);
                                    $("#penghapusan_pos_name"+i+"").val("" + msg.position_name);
                                    $("#penghapusan_cost_center"+i+"").val("" + msg.costcenter_code);
                                    $("#penghapusan_work_location"+i+"").attr("id1", msg.worklocation_code);
                                    $("#penghapusan_work_location"+i+"").val("" + msg.worklocation_name);
                                    $("#penghapusan_job_status"+i+"").attr("id1", msg.jobstatuscode);
                                    $("#penghapusan_job_status"+i+"").val("" + msg.jobstatusname_en);
                                    $("#penghapusan_job_title"+i+"").attr("id1", msg.jobtitle_code);
                                    $("#penghapusan_job_title"+i+"").val("" + msg.jobtitle_name_en);
                                },
                                
                        });
                    }
                });
})
</script>