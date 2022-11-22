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
a.position_name,
a.request_type,
a.status_approval,
a.request_status,
a.request_reason,
a.request_remark,
a.attch
FROM hrmorgessrequest a WHERE a.request_no = '$id'");

$data_request       = mysqli_fetch_assoc($sql_data_request);
// Ambil data dari request requester


// Ambil data dari hrmorgessrequeststruc

$sql_data_reqstruc  = mysqli_query($connect, "SELECT 
a.parent_id,
b.pos_name_en AS leader_pos,
a.pos_name_en,
a.pos_code,
a.lstworklocation,
d.worklocation_name,
a.jobtitle_code,
f.jobtitle_name_en,
a.jobstatuscode,
e.jobstatusname_en,
a.costcenter_code,
c.costcenter_name_en
FROM hrmorgessrequeststruc a 
LEFT JOIN hrmorgstruc b ON a.parent_id = b.position_id
LEFT JOIN teomcostcenter c ON c.costcenter_code = a.costcenter_code
LEFT JOIN teomworklocation d ON d.worklocation_code = a.lstworklocation
LEFT JOIN teomjobstatus e ON e.jobstatuscode = a.jobstatuscode
LEFT JOIN teomjobtitle f ON f.jobtitle_code = a.jobtitle_code
WHERE a.req_no = '$id'");

$data_reqstruc      = mysqli_fetch_assoc($sql_data_reqstruc);

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

<!-- <div class="modal-dialog modal-md">
       <div class="modal-content"> -->

              <!-- <div class="modal-header">
                     <h4 class="modal-title">Usulan Perubahan Struktur Organisasi</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div> -->

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
            </fieldset>

            <!-- Save otorisasi position -->    
            <input type="hidden" id="view_penambahan_reqno" value="<?php echo $id; ?>">
            <!-- Save otorisasi position -->

                            <fieldset id="fset_1" class="penambahan" style="display:">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-3 name">Leader Position *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                        <input class="input--style-6" id1="<?php echo $data_reqstruc['parent_id']; ?>"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_penghapusan_leader_pos" id="view_penghapusan_leader_pos" type="Text" value="<?php echo $data_reqstruc['leader_pos']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Position Name *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_penghapusan_pos_name" id="view_penghapusan_pos_name" type="Text" value="<?php echo $data_request['position_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Position Code *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_penghapusan_pos_code" id="view_penghapusan_pos_code" type="Text" value="<?php echo $data_reqstruc['pos_code']; ?>" id1="<?php echo $data_reqstruc['pos_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Cost Center *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                    <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_penghapusan_cost_center" id1="<?php echo $data_reqstruc['costcenter_code']; ?>" id="view_penghapusan_cost_center" type="Text" value="<?php echo $data_reqstruc['costcenter_name_en']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Work Location *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                    <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_penghapusan_work_location" id1="<?php echo $data_reqstruc['lstworklocation']; ?>" id="view_penghapusan_work_location" type="Text" value="<?php echo $data_reqstruc['worklocation_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Job Status *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                        
                                                    <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_penghapusan_job_status" id1="<?php echo $data_reqstruc['jobstatuscode']; ?>" id="view_penghapusan_job_status" type="Text" value="<?php echo $data_reqstruc['jobstatusname_en']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Jobtitle Code *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                 
                                                    <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_penghapusan_jobtitle_code" id1="<?php echo $data_reqstruc['jobtitle_code']; ?>" id="view_penghapusan_jobtitle_code" type="Text" value="<?php echo $data_reqstruc['jobtitle_name_en']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Reason *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_penghapusan_reason" id="view_penghapusan_reason" type="Text" value="<?php echo $data_request['request_reason']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-3 name">Remarks</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                 <textarea class="textarea--style-6" id="view_penghapusan_remark" name="view_penghapusan_remark" placeholder="Remarks"><?php echo $data_request['request_remark']; ?></textarea>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Attch</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">
                                                 <input class="input--style-6" type="file" id="view_penghapusan_file" name="view_penghapusan_file">
                                                 <a href="../../../asset/upload/attachmentessod/<?php echo $data_request['attch']; ?>"><?php echo $data_request['attch']; ?></a>
                                                 </div>
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
                                                                                    class="btn btn-warning submit" data-dismiss="modal">Submit</button>
                                                                                    <?php } ?>
                                                                      </div>
                                                               </div>


                        
  <!-- Mengambil Position -->

  <script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#view_penghapusan_pos_code" ).autocomplete({
                    serviceUrl: "ajax_pos_code.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                       
                        $( "#view_penghapusan_pos_code" ).val("" + suggestion.value);
                        $( "#view_penghapusan_pos_code" ).attr('id1', suggestion.pos_code);
                      
                        $.ajax({
                                    type: 'POST',
                                    url: "ajax_penghapusan.php",
                                    data: {id:suggestion.parent},
                                    dataType: "JSON",   
                                success: function (msg) {
                                    $('#view_penghapusan_leader_pos').attr('id1', msg.leader_pos_code);
                                    $('#view_penghapusan_leader_pos').val("" + msg.leader_position);
                                    $('#view_penghapusan_pos_name').val("" + msg.position_name);
                                    $('#view_penghapusan_cost_center').val("" + msg.costcenter_code);
                                    $('#view_penghapusan_work_location').attr('id1', msg.worklocation_code);
                                    $('#view_penghapusan_work_location').val("" + msg.worklocation_name);
                                    $('#view_penghapusan_job_status').attr('id1', msg.jobstatuscode);
                                    $('#view_penghapusan_job_status').val("" + msg.jobstatusname_en);
                                    $('#view_penghapusan_jobtitle_code').attr('id1', msg.jobtitle_code);
                                    $('#view_penghapusan_jobtitle_code').val("" + msg.jobtitle_name_en);
                                },
                                
                        });

                    }
                });
            })
        </script>

 <!-- Mengambil Position -->
 

