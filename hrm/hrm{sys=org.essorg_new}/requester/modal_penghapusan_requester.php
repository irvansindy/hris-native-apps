<?php 

include "../../../application/session/session_ess.php";

$id     = $_POST['id'];
$emp_no = $_SESSION['username'];


// Ambil data dari request requester
$sql_data_request   = mysqli_query($connect, "SELECT 
a.request_no,
a.request_by,
a.request_date,
a.request_division,
a.request_department,
a.request_type,
a.status_approval,
a.request_status,
a.attch
FROM hrmorgessrequest a WHERE a.request_no = '$id'");

$data_request       = mysqli_fetch_assoc($sql_data_request);
// Ambil data dari request requester


// Ambil data dari hrmorgessrequeststruc

$sql_data_reqstruc  = mysqli_query($connect, "SELECT 
b.orgpos,
b.leader_pos,
b.pos_code,
c.pos_name_en AS leader_pos_name,
b.position_name,
b.cost_center,
b.work_location,
d.worklocation_name,
b.jobstatus_code,
e.jobstatusname_en,
b.jobtitle_code,
f.jobtitle_name_en,
b.request_reason,
b.request_remark
FROM hrmorgessrequest a
LEFT JOIN hrdorgessrequest b ON a.request_no = b.request_no
LEFT JOIN hrmorgstruc c ON c.position_id = b.leader_pos
LEFT JOIN teomworklocation d ON d.worklocation_code = b.work_location
LEFT JOIN teomjobstatus e ON e.jobstatuscode = b.jobstatus_code
LEFT JOIN teomjobtitle f ON f.jobtitle_code = b.jobtitle_code
WHERE a.request_no = '$id'");

$count_data_reqstruc      = mysqli_num_rows($sql_data_reqstruc);

// Ambil data dari hrmorgessrequeststruc

// Ambil data div dan dept 
$sql_parent_path     = mysqli_query($connect, "SELECT 
parent_path
FROM view_employee WHERE emp_no = '$emp_no'");

$data_parent_path   = mysqli_fetch_assoc($sql_parent_path);
$in_position        = str_replace(",", "','", $data_parent_path['parent_path']);
$final_inposition   = "'".$in_position."'";

$sql_ambil_div          = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en
FROM hrmorgstruc a 
WHERE a.position_id IN ($final_inposition)
AND (a.org_level = 'DIV')
ORDER BY a.pos_level ASC
");

$count_ambil_divisi     = mysqli_num_rows($sql_ambil_div);

$sql_ambil_dept          = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en
FROM hrmorgstruc a 
WHERE a.position_id IN ($final_inposition)
AND (a.org_level = 'DEP')
ORDER BY a.pos_level ASC
");

$count_ambil_dept     = mysqli_num_rows($sql_ambil_dept);

// Ambil data div dan dept 

// Mengambil history revision
$sql_revision   = mysqli_query($connect, "SELECT 
DATE_FORMAT(a.created_date, '%d %M %Y') AS rev_date,
b.Full_Name,
a.remarks
FROM hrmorgessreqrevisiondetail a
LEFT JOIN view_employee b ON a.created_by = b.emp_no
WHERE a.req_no = '$id'");
// Mengambil history revision

?>

<link rel="stylesheet" href="../../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>
<!-- Autocomplete -->
<script src="jquery.autocomplete.min.js"></script>

<style>
            
            
            input[type=text] {
                
            }
            input[type=text]:focus {
                border: 2px solid #757575;
            	outline: none;
            }
            .autocomplete-suggestions {
                border: 1px solid #999;
                background: #FFF;
                overflow: auto;
            }
            .autocomplete-suggestion {
                padding: 2px 5px;
                white-space: nowrap;
                overflow: hidden;
            }
            .autocomplete-selected {
                background: #F0F0F0;
            }
            .autocomplete-suggestions strong {
                font-weight: normal;
                color: #3399FF;
            }
            .autocomplete-group {
                padding: 2px 5px;
            }
            .autocomplete-group strong {
                display: block;
                border-bottom: 1px solid #000;
            }
        </style>


        <div class="modal-body">
              <!-- <form method="post" id="myform"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Division</div>
                    <div class="col-sm-9">
                        <div class="input-group">

                            <select class="input--style-6" name="division" id="division" style="width: ;height: 30px;">
                                                        <?php 
                                                            if($count_ambil_divisi > '1'){
                                                        ?>
                                                        <option value="0">-- Select one --</option>
                                                        <?php } ?>
                                                        <?php  
                                                            while($data_ambil_div = mysqli_fetch_assoc($sql_ambil_div)){
                                                        ?>
                                                        <option value="<?php echo $data_ambil_div['position_id']; ?>" <?php if($data_ambil_div['position_id'] == $data_request['request_division']){ echo 'selected'; } ?>><?php echo $data_ambil_div['pos_name_en']; ?></option>
                                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Department</div>
                    <div class="col-sm-9">
                        <div class="input-group">

                            <select class="input--style-6" name="department" id="department" style="width: ;height: 30px;">
                                <?php 
                                    if($count_ambil_divisi > '1'){
                                ?>
                                                        <option value="0">-- Select one --</option>
                                                       
                                <?php }else{ ?>
                                                        <option value="0">-- Select one --</option>
                                                        <?php  
                                                            while($data_ambil_dept = mysqli_fetch_assoc($sql_ambil_dept)){
                                                        ?>
                                                        <option value="<?php echo $data_ambil_dept['position_id']; ?>" <?php if($data_ambil_dept['position_id'] == $data_request['request_department']){ echo 'selected'; } ?>><?php echo $data_ambil_dept['pos_name_en']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Type</div>
                    <div class="col-sm-9">
                        <div class="input-group">

                            <select class="input--style-6" name="tipe_pengajuan" id="tipe_pengajuan" style="width: ;height: 30px;" disabled>
                                <option value="0">-- Select one --</option>
                                <option value="1" <?php if($data_request['request_type'] == '1'){ echo 'selected'; } ?>>PENAMBAHAN</option>
                                <option value="2" <?php if($data_request['request_type'] == '2'){ echo 'selected'; } ?>>PENGHAPUSAN</option>
                                <option value="3" <?php if($data_request['request_type'] == '3'){ echo 'selected'; } ?>>PELEBURAN</option>
                                <option value="4" <?php if($data_request['request_type'] == '4'){ echo 'selected'; } ?>>PEMISAHAN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                                          <div class="col-3 name">Attch</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">
                                                        <input class="input--style-6" type="file" id="file_pengajuan" name="file_pengajuan">
                                                        <a href="../../asset/upload/attachmentessod/<?php echo $data_request['attch']; ?>"><?php echo $data_request['attch']; ?></a>

                                                 </div>
                                          </div>
                                   </div>
            </fieldset>

            <!-- Save otorisasi position -->    
            <input type="hidden" id="view_penambahan_reqno" value="<?php echo $id; ?>">
            <!-- Save otorisasi position -->

                            <fieldset id="fset_1" class="penambahan" style="display:">
                                   
                            <div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.9%; margin: 5px;overflow: scroll;">
<input type="hidden" id="parsing" value="<?php echo $data_request['request_department']; ?>">
<input type="hidden" id="req_no_penghapusan" value="<?php echo $id; ?>">
                                   <div class="form-row" style="width:130%">
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
                                                <?php 
                                                $no = 1;
                                                while($data_position = mysqli_fetch_assoc($sql_data_reqstruc)){
                                                    if($no == 1){
                                                        $button = '<button type="button" name="add" id="add" class="btn btn-success btn-sm">+</button>';
                                                      }else{
                                                        $button = '<button type="button" name="remove" id1="'.$no.'" class="btn btn-danger btn_removerb btn-sm">X</button>';
                                                      }
                                                ?>
                                                 <tr id="row<?php echo $no; ?>" class="dynamic-added">
                                                        <td width="15%">
                                                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_leader_pos_view" id="penghapusan_leader_pos_view<?php echo $no; ?>" type="Text" value="<?php echo $data_position['leader_pos_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="15%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_pos_name_view" id="penghapusan_pos_name_view<?php echo $no; ?>" type="Text" value="<?php echo $data_position['position_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_pos_code_view[]" id="penghapusan_pos_code_view<?php echo $no; ?>" type="Text" id1="<?php echo $data_position['pos_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength=""  value="<?php echo $data_position['position_name']; ?>"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_cost_center_view" id="penghapusan_cost_center_view<?php echo $no; ?>" type="Text"
                                                               onfocus="hlentry(this)" size="30" maxlength=""  value="<?php echo $data_position['cost_center']; ?>"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_work_location_view" id="penghapusan_work_location_view<?php echo $no; ?>" type="Text"
                                                               onfocus="hlentry(this)" size="30" maxlength=""  value="<?php echo $data_position['worklocation_name']; ?>"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_job_status_view" id="penghapusan_job_status_view<?php echo $no; ?>" type="Text"
                                                               onfocus="hlentry(this)" size="30" maxlength=""  value="<?php echo $data_position['jobstatusname_en']; ?>"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_job_title_view" id="penghapusan_job_title_view<?php echo $no; ?>" type="Text"
                                                               onfocus="hlentry(this)" size="30" maxlength=""  value="<?php echo $data_position['jobtitle_name_en']; ?>"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                        </td>
                                                        <td width="10%">
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_reason_view[]" id="penghapusan_reason_view<?php echo $no; ?>" type="Text" value="<?php echo $data_position['request_reason']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_remaks_view[]" id="penghapusan_remaks_view<?php echo $no; ?>" type="Text" value="<?php echo $data_position['request_remark']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                            <?php echo $button; ?>
                                                        </td>
                                                 </tr>
                                                 <?php $no++; } ?>
                                          </tbody>
                                   </table>
                                
                                   </div>
</div>
                                   
                            </fieldset>

                            <?php if($data_request['request_status'] != '0'){ ?>
                            <fieldset id="fset_1">
                                <div class="form-row">
                                    <div class="col-5 name"><b style="font-weight:bold">Revision History</b></div>
                                </div>
                                <div class="form-row">
                                    <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                                <thead>
                                                                        <tr>
                                                                            <!-- <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th> -->
                                                                            <th class="fontCustom" style="z-index: 1;">Date</th>
                                                                            <th class="fontCustom" style="z-index: 1;">Rev. By</th>
                                                                            <th class="fontCustom" style="z-index: 1;">Rev. Desc</th>
                                                                           
                                                                            <!-- <th class="fontCustom" style="z-index: 1;">Career Path Map</th>     -->

                                                                        </tr>
                                                                    

                                                                </thead>
                                                                <tbody>
                                                                        <?php while($data_rev   = mysqli_fetch_assoc($sql_revision)){ ?>
                                                                        <tr>
                                                                            <td class='fontCustom'><?php echo $data_rev['rev_date']; ?></td>
                                                                            <td class='fontCustom'><?php echo $data_rev['Full_Name'] ?></td>
                                                                            <td class='fontCustom'><?php echo $data_rev['remarks']; ?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                </tbody>
                                                                    

                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                            <?php } ?>



                        </div>
                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                                    <button type="submit" data-toggle='modal' id='preview_app' data-target='#modal-preview_approver' id1="<?php echo $id; ?>"
                                                                                    class="btn btn-info submit">Preview Approver</button>
                                                                                    <?php if($data_request['status_approval'] == '1' || $data_request['status_approval'] == '4'){ ?>
                                                                             <button type="submit" id="submit_penghapusan_view" id1="1"
                                                                                    class="btn btn-warning submit">Submit</button>
                                                                                    <?php } ?>
                                                                      </div>
                                                               </div>


                        
 <!-- Mengambil Leader Position -->
 <?php 
for($h = 1; $h <= $count_data_reqstruc; $h++){
?>
 <script type="text/javascript">
            $(document).ready(function() {

                var h = '<?php echo $h ?>';

                $( "#penghapusan_pos_code_view"+h+"" ).autocomplete({
                    serviceUrl: "ajax/get_poscode.php?aus="+$("#parsing").val(),   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#penghapusan_pos_code_view"+h+"" ).val("" + suggestion.value);
                        $( "#penghapusan_pos_code_view"+h+"" ).attr('id1', suggestion.pos_code);

                        $.ajax({
                                    type: 'POST',
                                    url: "ajax_penghapusan.php",
                                    data: {id:suggestion.pos_code},
                                    dataType: "JSON",   
                                success: function (msg) {
                                    $('#penghapusan_leader_pos_view'+h+'').attr('id1', msg.leader_pos_code);
                                    $('#penghapusan_leader_pos_view'+h+'').val("" + msg.leader_position);
                                    $('#penghapusan_pos_name_view'+h+'').val("" + msg.position_name);
                                    $('#penghapusan_cost_center_view'+h+'').val("" + msg.costcenter_code);
                                    $('#penghapusan_work_location_view'+h+'').attr('id1', msg.worklocation_code);
                                    $('#penghapusan_work_location_view'+h+'').val("" + msg.worklocation_name);
                                    $('#penghapusan_job_status_view'+h+'').attr('id1', msg.jobstatuscode);
                                    $('#penghapusan_job_status_view'+h+'').val("" + msg.jobstatusname_en);
                                    $('#penghapusan_job_title_view'+h+'').attr('id1', msg.jobtitle_code);
                                    $('#penghapusan_job_title_view'+h+'').val("" + msg.jobtitle_name_en);
                                },
                                
                        });
                    }
                });
            })
</script>
<?php } ?>
 <!-- Mengambil Leader Position -->

<!-- Mengambil Leader Position -->

<script type="text/javascript">
$(document).ready(function() {
var i=<?php echo $count_data_reqstruc; ?>;  
$('#add').click(function(){  

   if(i == 0){
       var validasi =  $( "#penghapusan_pos_code_view" ).val();
   }else{
       var validasi =  $( "#penghapusan_pos_code_view"+i+"" ).val();
   }

   if(validasi == ''){
       alert('Please fill currect row before add row!');
       return;
   }
i++; 

$.ajax({
   url: "ajax/append_penghapusan_view.php",
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

$(document).on('click', '.btn_removerb', function(){  

var button_id = $(this).attr("id1");   

$('#row'+button_id+'').remove();  



}); 

$(document).on('click', '.btn_remove', function(){  

var button_id = $(this).attr("id1");   

$('#row'+button_id+'').remove();  



});  
});
</script>
 

