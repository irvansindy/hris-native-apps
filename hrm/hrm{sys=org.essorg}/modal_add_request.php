<?php include "../../application/session/session.php";

$emp_no     = $_SESSION['username'];


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

// Ambil data cost center
$sql_cost_center        = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a ");
// Ambil data cost center

// Ambil data work location
$sql_work_location      = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a");
// Ambil data work location

// Ambil data Job Status
$sql_job_status         = mysqli_query($connect, "SELECT 
a.jobstatuscode,
a.jobstatusname_en
FROM teomjobstatus a");
// Ambil data Job Status

// Ambil data Job Title
$sql_job_title          = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en
FROM teomjobtitle a");
// Ambil data Job Title

?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>
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
                                                        <option value="<?php echo $data_ambil_div['position_id']; ?>"><?php echo $data_ambil_div['pos_name_en']; ?></option>
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
                                                        <option value="<?php echo $data_ambil_dept['position_id']; ?>"><?php echo $data_ambil_dept['pos_name_en']; ?></option>
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

                            <select class="input--style-6" name="tipe_pengajuan" id="tipe_pengajuan" style="width: ;height: 30px;">
                                <option value="0">-- Select one --</option>
                                <option value="1">PENAMBAHAN</option>
                                <option value="2">PENGHAPUSAN</option>
                                <option value="3">PELEBURAN</option>
                                <option value="4">PEMISAHAN</option>
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- Save otorisasi position -->    
             <input type="hidden" id="save_otorisasi" value="">
            <!-- Save otorisasi position -->

                            <fieldset id="fset_1" class="penambahan" style="display:none">
                                   <!-- <legend>Searching Form</legend> -->
                                   <div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.8%; margin: 5px;overflow: scroll;">
				   <div class="form-row">
                                          <div class="col-3 name">Org Unit/Position *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                 <select class="input--style-6" name="penambahan_orgorpos" id="penambahan_orgorpos" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <option value="1">Org Unit</option>
                                                        <option value="2">Position</option>
                             
                          
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Leader Position *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                        <input class="input--style-6" id1=""
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_leader_pos" id="penambahan_leader_pos" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Position Name *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_pos_name" id="penambahan_pos_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Cost Center *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="penambahan_cost_center" id="penambahan_cost_center" style="width: ;height: 30px;">
                                                        <option value="0">-- Select one --</option>
                                                        <?php 
                                                            while($data_cc  = mysqli_fetch_assoc($sql_cost_center)){
                                                        ?>
                                                        <option value="<?php echo $data_cc['costcenter_code'] ?>"><?php echo $data_cc['costcenter_name_en'] ?></option>
                                                        <?php } ?>
                          
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Work Location *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                 <select class="input--style-6" name="penambahan_work_location" id="penambahan_work_location" style="width: ;height: 30px;">
                                                        <option value="0">-- Select one --</option>
                                                        <?php 
                                                            while($data_wl  = mysqli_fetch_assoc($sql_work_location)){
                                                        ?>
                                                        <option value="<?php echo $data_wl['worklocation_code'] ?>"><?php echo $data_wl['worklocation_name'] ?></option>
                                                        <?php } ?>
                          
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Job Status *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="penambahan_job_status" id="penambahan_job_status" style="width: ;height: 30px;">
                                                        <option value="0">-- Select one --</option>
                                                        <?php 
                                                            while($data_js  = mysqli_fetch_assoc($sql_job_status)){
                                                        ?>
                                                        <option value="<?php echo $data_js['jobstatuscode'] ?>"><?php echo $data_js['jobstatusname_en'] ?></option>
                                                        <?php } ?>
                          
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Jobtitle Code *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                 <select class="input--style-6" name="penambahan_job_title" id="penambahan_job_title" style="width: ;height: 30px;">
                                                        <option value="0">-- Select one --</option>
                                                        <?php 
                                                            while($data_jt  = mysqli_fetch_assoc($sql_job_title)){
                                                        ?>
                                                        <option value="<?php echo $data_jt['jobtitle_code'] ?>"><?php echo $data_jt['jobtitle_name_en'] ?></option>
                                                        <?php } ?>
                          
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Reason *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_reason" id="penambahan_reason" type="Text" value=""
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

                                                 <textarea class="textarea--style-6" id="penambahan_remark" name="penambahan_remark" placeholder="Remarks"></textarea>
                                                 </div>
                                          </div>
                                   </div>
<div class="form-row">
                                          <div class="col-3 name">Attch</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">
                                                        <input class="input--style-6" type="file" id="penambahan_file" name="penambahan_file">
                                                 </div>
                                          </div>
                                   </div>
                                   </div>
                                   
                            </fieldset>






                            <!-- Penghapusan -->
                            <fieldset id="fset_1" class="penghapusan" style="display:none">
                                   <!-- <legend>Searching Form</legend> -->
                                   <div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                   <div class="form-row">
                                          <div class="col-3 name">Leader Position *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                        <input class="input--style-6" id1=""
                                                               autocomplete="off" autofocus="on" 
                                                               name="penghapusan_leader_pos" id="penghapusan_leader_pos" type="Text" value=""
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
                                                               name="penghapusan_pos_name" id="penghapusan_pos_name" type="Text" value=""
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
                                                               name="penghapusan_pos_code" id="penghapusan_pos_code" type="Text" value=""
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
                                                               name="penghapusan_cost_center" id="penghapusan_cost_center" type="Text" value=""
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
                                                               autocomplete="off" autofocus="on" id1=""
                                                               name="penghapusan_work_location" id="penghapusan_work_location" type="Text" value=""
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
                                                               name="penghapusan_job_status" id="penghapusan_job_status" type="Text" value=""
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
                                                               name="penghapusan_jobtitle_code" id="penghapusan_jobtitle_code" type="Text" value=""
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
                                                               name="penghapusan_reason" id="penghapusan_reason" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-3 name">Remarks</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                 <textarea class="textarea--style-6" id="penghapusan_remark" name="penghapusan_remark" placeholder="Remarks"></textarea>
                                                 </div>
                                          </div>
                                   </div>
<div class="form-row">
                                          <div class="col-3 name">Attch</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">
                                                        <input class="input--style-6" type="file" id="penghapusan_file" name="penghapusan_file">
                                                 </div>
                                          </div>
                                   </div>
                                   </div>
                                   
                            </fieldset>
                            <!-- Pengahpusan -->



                             <!-- Peleburan -->
                             <fieldset id="fset_1" class="peleburan" style="display:none">
                                   <!-- <legend>Searching Form</legend> -->
                                   <div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                   <div class="form-row">
                                          <div class="col-3 name">Leader Position *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_lp">

                                                        <input class="input--style-6" id1=""
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_leader_pos" id="peleburan_leader_pos" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Position Name *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_pn">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_pos_name" id="peleburan_pos_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Position Code *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_pc">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_pos_code" id="peleburan_pos_code" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Cost Center *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_cc">

                                                    <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_cost_center" id="peleburan_cost_center" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Work Location *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_wl">

                                                 <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id1=""
                                                               name="peleburan_work_location" id="peleburan_work_location" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Job Status *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_js">

                                                    <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_job_status" id="peleburan_job_status" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Jobtitle Code *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_jt">

                                                 <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="peleburan_jobtitle_code" id="peleburan_jobtitle_code" type="Text" value=""
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
                                                               name="peleburan_reason" id="peleburan_reason" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-3 name">Remarks</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                 <textarea class="textarea--style-6" id="peleburan_remark" name="peleburan_remark" placeholder="Remarks"></textarea>
                                                 </div>
                                          </div>
                                   </div>
<div class="form-row">
                                          <div class="col-3 name">Attch</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">
                                                        <input class="input--style-6" type="file" id="peleburan_file" name="peleburan_file">
                                                 </div>
                                          </div>
                                   </div>

                                   </div>
                                   
                            </fieldset>
                            <!-- Peleburan -->

                            <!-- Pemisahan -->
                            <fieldset id="fset_1" class="pemisahan" style="display:none">
                                   <!-- <legend>Searching Form</legend> -->
                                   <div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                   <div class="form-row">
                                          <div class="col-3 name">Leader Position *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_lp_pl">

                                                        <input class="input--style-6" id1=""
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_leader_pos" id="pemisahan_leader_pos" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Position Name *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_pn_pl">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_pos_name" id="pemisahan_pos_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Position Code *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_pc_pl">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_pos_code" id="pemisahan_pos_code" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Cost Center *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_cc_pl">

                                                    <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_cost_center" id="pemisahan_cost_center" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Work Location *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_wl_pl">

                                                 <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id1=""
                                                               name="pemisahan_work_location" id="pemisahan_work_location" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Job Status *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_js_pl">

                                                    <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_job_status" id="pemisahan_job_status" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-3 name">Jobtitle Code *</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group" id="tampil_jt_pl">

                                                 <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="pemisahan_jobtitle_code" id="pemisahan_jobtitle_code" type="Text" value=""
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
                                                               name="pemisahan_reason" id="pemisahan_reason" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-3 name">Remarks</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">

                                                 <textarea class="textarea--style-6" id="pemisahan_remark" name="pemisahan_remark" placeholder="Remarks"></textarea>
                                                 </div>
                                          </div>
                                   </div>
<div class="form-row">
                                          <div class="col-3 name">Attch</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">
                                                        <input class="input--style-6" type="file" id="pemisahan_file" name="pemisahan_file">
                                                 </div>
                                          </div>
                                   </div>

                                   </div>
                                   
                                   
                            </fieldset>
                            <!-- Pemisahan -->

                        </div>
                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" data-toggle='modal' id='preview_app_view' data-target='#modal-preview_approver' id1="<?php echo $id; ?>"
                                                                                    class="btn btn-primary">Preview Approver</button>
                                                                             <button type="submit" id="submit_draft" id1="2"
                                                                                    class="btn btn-info submit" data-dismiss="modal">Draft</button>
                                                                             <button type="submit" id="submit_peleburan" id1="1"
                                                                                    class="btn btn-warning submit" data-dismiss="modal">Submit</button>
                                                                      </div>
                                                               </div>
<!-- </div>
</div> -->
                            
<!-- Merubah Value Parameter posisi otorisasi -->
<script>
$(document).ready(function(){  

    $(document).on('change', '#division', function(){
        var id            = $(this).val();

        $('#save_otorisasi').val(id);  

    }); 

    $(document).on('change', '#department', function(){
        var id            = $(this).val();

        $('#save_otorisasi').val(id);  

    });


}); 
</script>
 <!-- Merubah Value Parameter posisi otorisasi -->

 <!-- Menampilkan form berdasarkan type yang dipilih -->
<script>
$(document).ready(function(){  

    $(document).on('change', '#tipe_pengajuan', function(){
        var id            = $(this).val();
        
        if(id == '1'){
            const penambahan = $(".penambahan");
            penambahan.css("display", "");
            const penghapusan = $(".penghapusan");
            penghapusan.css("display", "none");
            const peleburan = $(".peleburan");
            peleburan.css("display", "none");
            const pemisahan = $(".pemisahan");
            pemisahan.css("display", "none");
            $('.submit').attr('id', 'submit_penambahan');
        }else if(id == '2'){
            const penghapusan = $(".penghapusan");
            penghapusan.css("display", "");
            const penambahan = $(".penambahan");
            penambahan.css("display", "none");
            const peleburan = $(".peleburan");
            peleburan.css("display", "none");
            const pemisahan = $(".pemisahan");
            pemisahan.css("display", "none");
            $('.submit').attr('id', 'submit_penghapusan');
        }else if(id == '3'){
            const penghapusan = $(".penghapusan");
            penghapusan.css("display", "none");
            const penambahan = $(".penambahan");
            penambahan.css("display", "none");
            const peleburan = $(".peleburan");
            peleburan.css("display", "");
            const pemisahan = $(".pemisahan");
            pemisahan.css("display", "none");
            $('.submit').attr('id', 'submit_peleburan');
        }else if(id == '4'){
            const penghapusan = $(".penghapusan");
            penghapusan.css("display", "none");
            const penambahan = $(".penambahan");
            penambahan.css("display", "none");
            const peleburan = $(".peleburan");
            peleburan.css("display", "none");
            const pemisahan = $(".pemisahan");
            pemisahan.css("display", "");
            $('.submit').attr('id', 'submit_pemisahan');
        }
        

    }); 


}); 
</script>
 <!-- Menampilkan form berdasarkan type yang dipilih -->

 <!-- Mengambil Leader Position -->

 <script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#penambahan_leader_pos" ).autocomplete({
                    serviceUrl: "ajax_leader_pos.php?",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#penambahan_leader_pos" ).val("" + suggestion.value);
                        $( "#penambahan_leader_pos" ).attr('id1', suggestion.parent);
                    }
                });
            })
        </script>

 <!-- Mengambil Leader Position -->

  <!-- Mengambil Leader Position -->

  <script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#peleburan_leader_pos" ).autocomplete({
                    serviceUrl: "ajax_leader_pos.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#peleburan_leader_pos" ).val("" + suggestion.value);
                        $( "#peleburan_leader_pos" ).attr('id1', suggestion.parent);
                    }
                });
            })
        </script>

 <!-- Mengambil Leader Position -->

  <!-- Mengambil Position -->

  <script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#penghapusan_pos_code" ).autocomplete({
                    serviceUrl: "ajax_pos_code.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                       
                        $( "#penghapusan_pos_code" ).val("" + suggestion.pos_code);
                        $( "#penghapusan_pos_code" ).attr('id1', suggestion.parent);
                      
                        $.ajax({
                                    type: 'POST',
                                    url: "ajax_penghapusan.php",
                                    data: {id:suggestion.parent},
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
                                    $('#penghapusan_jobtitle_code').attr('id1', msg.jobtitle_code);
                                    $('#penghapusan_jobtitle_code').val("" + msg.jobtitle_name_en);
                                },
                                
                        });

                    }
                });
            })
        </script>

 <!-- Mengambil Position -->

<!-- Peleburan Position -->

   <script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#peleburan_pos_code" ).autocomplete({
                    serviceUrl: "ajax_pos_code.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {

                        $('#peleburan_leader_pos').prop('disabled', false);

                        $('#peleburan_pos_name').prop('disabled', false);

                     //       alert(suggestion.parent);
                       
                        $( "#peleburan_pos_code" ).val("" + suggestion.value);
                        $( "#peleburan_pos_code" ).attr('id1', suggestion.pos_code);
                      
                        $.ajax({
                                    type: 'POST',
                                    url: "ajax_penghapusan.php",
                                    data: {id:suggestion.parent},
                                    dataType: "JSON",   
                                success: function (msg) {
                                    $('#peleburan_leader_pos').attr('id1', msg.leader_pos_code);
                                    $('#peleburan_leader_pos').val("" + msg.leader_position);
                                    $('#peleburan_pos_name').val("" + msg.position_name);
                                  
                                },
                                
                        });

                     // Mengambil cost center
                                   let formData = new FormData();
                                   formData.append('pos_code', suggestion.parent);
                                   
                                   
                            $.ajax({
                                          type: 'POST',
                                          url: "ajax_ambil_cc.php",
                                          data: formData,
                                          cache: false,
                                          processData: false,
                                          contentType: false,  
                                success: function (msg) {
                                   $('#tampil_cc').html(msg);
                                },
                                
                            });
                     // Mengambil cost center

                     // Mengambil work location
                                   
                            $.ajax({
                                          type: 'POST',
                                          url: "ajax_ambil_wl.php",
                                          data: formData,
                                          cache: false,
                                          processData: false,
                                          contentType: false,  
                                success: function (msg) {
                                   $('#tampil_wl').html(msg);
                                },
                                
                            });
                     // Mengambil work location

                     // Mengambil Job Status
                                   
                     $.ajax({
                                          type: 'POST',
                                          url: "ajax_ambil_js.php",
                                          data: formData,
                                          cache: false,
                                          processData: false,
                                          contentType: false,  
                                success: function (msg) {
                                   $('#tampil_js').html(msg);
                                },
                                
                            });
                     // Mengambil Job Status

                     // Mengambil Job Title
                                   
                     $.ajax({
                                          type: 'POST',
                                          url: "ajax_ambil_jt.php",
                                          data: formData,
                                          cache: false,
                                          processData: false,
                                          contentType: false,  
                                success: function (msg) {
                                   $('#tampil_jt').html(msg);
                                },
                                
                            });
                     // Mengambil Job Title

                     

                    }
                });
            })
        </script>

 <!-- Peleburan Position -->

 <!-- Pemisahan Position -->

 <script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#pemisahan_pos_code" ).autocomplete({
                    serviceUrl: "ajax_pos_code.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {

                        $('#pemisahan_leader_pos').prop('disabled', false);

                        $('#pemisahan_pos_name').prop('disabled', false);

                     //       alert(suggestion.parent);
                       
                        $( "#pemisahan_pos_code" ).val("" + suggestion.value);
                        $( "#pemisahan_pos_code" ).attr('id1', suggestion.pos_code);
                      
                        $.ajax({
                                    type: 'POST',
                                    url: "ajax_penghapusan.php",
                                    data: {id:suggestion.parent},
                                    dataType: "JSON",   
                                success: function (msg) {
                                    $('#pemisahan_leader_pos').attr('id1', msg.leader_pos_code);
                                    $('#pemisahan_leader_pos').val("" + msg.leader_position);
                                    $('#pemisahan_pos_name').val("" + msg.position_name);
                                  
                                },
                                
                        });

                     // Mengambil cost center
                                   let formData = new FormData();
                                   formData.append('pos_code', suggestion.parent);
                                   
                                   
                                   $.ajax({
                                          type: 'POST',
                                          url: "ajax_ambil_cc_pl.php",
                                          data: formData,
                                          cache: false,
                                          processData: false,
                                          contentType: false,  
                                success: function (msg) {
                                   $('#tampil_cc_pl').html(msg);
                                },
                                
                            });
                     // Mengambil cost center

                     // Mengambil work location
                                   
                                   $.ajax({
                                          type: 'POST',
                                          url: "ajax_ambil_wl_pl.php",
                                          data: formData,
                                          cache: false,
                                          processData: false,
                                          contentType: false,  
                                success: function (msg) {
                                   $('#tampil_wl_pl').html(msg);
                                },
                                
                            });
                     // Mengambil work location

                     // Mengambil Job Status
                                   
                     $.ajax({
                                          type: 'POST',
                                          url: "ajax_ambil_js_pl.php",
                                          data: formData,
                                          cache: false,
                                          processData: false,
                                          contentType: false,  
                                success: function (msg) {
                                   $('#tampil_js_pl').html(msg);
                                },
                                
                            });
                     // Mengambil Job Status

                     // Mengambil Job Title
                                   
                     $.ajax({
                                          type: 'POST',
                                          url: "ajax_ambil_jt_pl.php",
                                          data: formData,
                                          cache: false,
                                          processData: false,
                                          contentType: false,  
                                success: function (msg) {
                                   $('#tampil_jt_pl').html(msg);
                                },
                                
                            });
                     // Mengambil Job Title

                     

                    }
                });
            })
        </script>

 <!-- pemisahan Position -->

<script>
$(document).ready(function() {
    $(document).on('change', '#jf_code', function(){
        var id  = $(this).val();
        $('#jfgrade').empty();
        $.ajax({
                     type: 'POST',
                     url: "ajax_jfgrade.php",
                     data: {id:id},
                     
	            success: function (msg) {
	                $('#jfgrade').html(msg);
	            },
	            
	    });

    });
});
</script>

