<?php include "../../application/session/session.php";

$id     = $_POST['id'];


// Ambil data org level

$sql_org_level     = mysqli_query($connect, "SELECT 
a.code,
a.name_en
FROM teomorglevel a");

// Ambil data org level

// Ambil Job Status
$sql_job_status     = mysqli_query($connect, "SELECT 
a.jobstatuscode,
a.jobstatusname_en
FROM teomjobstatus a ");
// Ambil Job Status

// Ambil Job Title
$sql_job_title      = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en
FROM teomjobtitle a ");
// Ambil Job Title

// Ambil Work Location
$sql_cost_center  = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a ");
// Ambil Work Location

// Amdil Data
$sql_ambil_data     = mysqli_query($connect, "SELECT 
a.pos_code,
a.parent_id,
b.pos_name_en AS parent_name,
a.pos_name_en,
a.pos_name_id,
a.pos_active,
a.jobstatuscode,
a.jobtitle_code,
a.lstgradecode,
a.lstworklocation,
a.jobdesc_en,
a.jobdesc_id,
a.costcenter_code,
a.require_successor,
a.report_postype,
a.clevel,
a.corder,
a.filename
FROM hrmorgstruc a
LEFT JOIN hrmorgstruc b ON b.position_id = a.parent_id
WHERE a.position_id = '$id'");
$data_              = mysqli_fetch_assoc($sql_ambil_data);
// Ambil Data

// Ambil Work Location
$notin_work_location    = str_replace(",", "','", $data_['lstworklocation']);
$sql_work_location  = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a
WHERE a.worklocation_code NOT IN ('$notin_work_location') ");
// Ambil Work Location

// Ambil Work Location pick
$notin_work_location    = str_replace(",", "','", $data_['lstworklocation']);
$sql_work_location_pick  = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a
WHERE a.worklocation_code IN ('$notin_work_location') ");
// Ambil Work Location pick

// Ambil Job Grade
$notin_grade    = str_replace(",", "','", $data_['lstgradecode']);
if(!empty($notin_grade)){
$sql_job_grade      = mysqli_query($connect, "SELECT 
a.grade_code,
a.gradecategory_code,
a.grade_name
FROM teomjobgrade a 
WHERE a.grade_code NOT IN ('$notin_grade')
ORDER BY a.grade_order ASC");
}else{
    $sql_job_grade      = mysqli_query($connect, "SELECT 
a.grade_code,
a.gradecategory_code,
a.grade_name
FROM teomjobgrade a 
ORDER BY a.grade_order ASC");
}
// Ambil Job Grade

// Ambil Job Grade pick
$notin_grade    = str_replace(",", "','", $data_['lstgradecode']);
$sql_job_grade_pick      = mysqli_query($connect, "SELECT 
a.grade_code,
a.gradecategory_code,
a.grade_name
FROM teomjobgrade a 
WHERE a.grade_code IN ('$notin_grade')
ORDER BY a.grade_order ASC");
// Ambil Job Grade pick

// Ambil Data Grade sudah di pick

// 
?>

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

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<!-- Dual List Box -->
<script type="text/javascript" language="javascript" src="lib/dualselect/js/dualselect-1.0.min.js"></script>
<link rel="stylesheet" href="lib/dualselect/css/dualselect-1.0.min.css" />

<script type="text/javascript" language="javascript">
			function optionChanged(elm) {
				console.log('optionChanged', jQuery(elm).val());
			}
			jQuery(document).ready(function() {
				dualselect1 = jQuery('#select1').dualselect({
					moveOnSelect: true
					,showMoveButtons: true
					,showFilters: true
				});

				dualselect2 = jQuery('#select2').dualselect({
					beforeSelectOption: function (_option) {
						if (_option.text().indexOf('option30') >= 0) {
							alert('option30 selection not allowed');
							return false;
						}
						return true;
					}
					
					,moveOnSelect: false
					,showMoveButtons: true
					,showFilters: true
				});

                dualselect2 = jQuery('#select3').dualselect({
					beforeSelectOption: function (_option) {
						if (_option.text().indexOf('option30') >= 0) {
							alert('option30 selection not allowed');
							return false;
						}
						return true;
					}
					
					,moveOnSelect: false
					,showMoveButtons: true
					,showFilters: true
				});
			});
		</script>
<!-- Dual List Box -->
<!-- Autocomplete -->
<script src="jquery.autocomplete.min.js"></script>

<div class="modal-dialog modal-bgkpi">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Setting Organization Structure</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
		   
              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <input type="hidden" id="position_id" value="<?php echo $id; ?>">

                                   <div class="form-row">
                                          <div class="col-4 name">Position Flag</div>
                                          <div class="col-sm-8" >
                                                 <div class="input-group">

                                                    <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="" id="" type="Text" value="Job Position"
                                                                             onfocus="hlentry(this)" size="30" maxlength="" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                
                                   <div class="form-row">
                                          <div class="col-4 name">Unit Code *</div>
                                          <div class="col-sm-8">

                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="unit_code" id="unit_code" type="Text" value="<?php echo $data_['pos_code'] ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Parent Code *</div>
                                          <div class="col-sm-8">

                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="parent_code" id="parent_code" type="Text" value="<?php echo $data_['parent_name'] ?>" id1="<?php echo $data_['parent_id'] ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Unit Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                               <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="unit_name_en" id="unit_name_en" type="Text" value="<?php echo $data_['pos_name_en'] ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">       

                                                               </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                               <div class="input-group">
                                                                      <img src="img/flag_en.png" alt="">    
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                               <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="unit_name_id" id="unit_name_id" type="Text" value="<?php echo $data_['pos_name_id'] ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">        

                                                               </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                               <div class="input-group">
                                                                      <img src="img/flag_id.png" alt="">    
                                                               </div>
                                                        </div>
                                                 </div>
                                          </div>
                                   </div>
                                </fieldset>
                                

                                
                                <fieldset style="display:" id="tampil_job_pos">
                                    <div class="form-row" >
                                          <div class="col-4">Status</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <input class="form-check-input" type="checkbox" value="" id1="<?php if($data_['pos_active'] == '1'){ echo "1"; }else{ echo "0"; } ?>" id="status_pos" <?php if($data_['pos_active'] == '1'){ echo "checked"; } ?>>

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Status *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="job_status_pos" id="job_status_pos" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_job_status = mysqli_fetch_assoc($sql_job_status)){
                                                        ?>
                                                        <option value="<?php echo $data_job_status['jobstatuscode'] ?>" <?php if($data_job_status['jobstatuscode'] == $data_['jobstatuscode']){ echo "selected"; } ?>><?php echo $data_job_status['jobstatusname_en'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Title *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="job_title_pos" id="job_title_pos" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_job_title = mysqli_fetch_assoc($sql_job_title)){
                                                        ?>
                                                        <option value="<?php echo $data_job_title['jobtitle_code'] ?>" <?php if($data_job_title['jobtitle_code'] == $data_['jobtitle_code']){ echo "selected"; } ?>><?php echo $data_job_title['jobtitle_name_en'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Grade</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select id="select2" class="grade_list" name="grade_list[]" multiple="multiple" size="15">
                                                        <?php 
                                                            while($data_job_grade = mysqli_fetch_assoc($sql_job_grade)){
                                                        ?>
                                                        <option value="<?php echo $data_job_grade['grade_code'] ?>"><?php echo $data_job_grade['grade_name'] ?></option>
                                                        <?php } ?>
                                                        <?php 
                                                            while($data_job_grade_pick = mysqli_fetch_assoc($sql_job_grade_pick)){
                                                        ?>
                                                        <option value="<?php echo $data_job_grade_pick['grade_code'] ?>" selected><?php echo $data_job_grade_pick['grade_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Work Location</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select id="select3" class="work_location" name="work_location[]" multiple="multiple" size="15">
                                                        <?php 
                                                            while($data_work_location = mysqli_fetch_assoc($sql_work_location)){
                                                        ?>
                                                        <option value="<?php echo $data_work_location['worklocation_code'] ?>"><?php echo $data_work_location['worklocation_name'] ?></option>
                                                        <?php } ?>
                                                        <?php 
                                                            while($data_work_location_pick = mysqli_fetch_assoc($sql_work_location_pick)){
                                                        ?>
                                                        <option value="<?php echo $data_work_location_pick['worklocation_code'] ?>" selected><?php echo $data_work_location_pick['worklocation_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Description</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                                    <textarea class="textarea--style-6" id="job_desc_en" name="job_desc_en" placeholder="Description"><?php echo $data_['jobdesc_en'] ?></textarea>        

                                                               </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                               <div class="input-group">
                                                                      <img src="img/flag_en.png" alt="">    
                                                               </div>
                                                        </div>
                                                 </div>
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                                <textarea class="textarea--style-6" id="job_desc_id" name="job_desc_id" placeholder="Deskripsi"><?php echo $data_['jobdesc_id'] ?></textarea>        

                                                               </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                               <div class="input-group">
                                                                      <img src="img/flag_id.png" alt="">    
                                                               </div>
                                                        </div>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Cost Center *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="cost_center" id="cost_center" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_cost_center = mysqli_fetch_assoc($sql_cost_center)){
                                                        ?>
                                                        <option value="<?php echo $data_cost_center['costcenter_code'] ?>" <?php if($data_cost_center['costcenter_code'] == $data_['costcenter_code']){ echo "selected"; } ?>><?php echo $data_cost_center['costcenter_name_en'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row" >
                                          <div class="col-4">Require Successor</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <input class="form-check-input" type="checkbox" value="" id1="<?php if($data_['require_successor'] == 'Y'){ echo "Y"; }else{ echo "N"; } ?>" id="require_suc" <?php if($data_['require_successor'] == 'Y'){ echo "checked"; } ?>>

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Acting As</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="acting_as_pos" id="acting_as_pos" style="width: ;height: 30px;">
                                                        <option value="SO" <?php if($data_['report_postype'] == 'SO'){ echo 'selected'; } ?>>SubOrdinate</option>
                                                        <option value="DS" <?php if($data_['report_postype'] == 'DS'){ echo 'selected'; } ?>>Assistant</option>
                                                        <option value="DL" <?php if($data_['report_postype'] == 'DL'){ echo 'selected'; } ?>>Left Assistant</option>
                                                        <option value="DR" <?php if($data_['report_postype'] == 'DR'){ echo 'selected'; } ?>>Right Assistant</option>
                                                        <option value="CS" <?php if($data_['report_postype'] == 'CS'){ echo 'selected'; } ?>>Consultant</option>
                                                        <option value="CL" <?php if($data_['report_postype'] == 'CL'){ echo 'selected'; } ?>>Left Consultant</option>
                                                        <option value="CR" <?php if($data_['report_postype'] == 'CR'){ echo 'selected'; } ?>>Right Consultant</option>

                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Chart Level</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="chart_level_pos" id="chart_level_pos" style="width: ;height: 30px;">
                                                        <option value="1" <?php if($data_['clevel'] == '1'){ echo 'selected'; } ?>>1</option>
                                                        <option value="2" <?php if($data_['clevel'] == '2'){ echo 'selected'; } ?>>2</option>
                                                        <option value="3" <?php if($data_['clevel'] == '3'){ echo 'selected'; } ?>>3</option>
                                                        <option value="4" <?php if($data_['clevel'] == '4'){ echo 'selected'; } ?>>4</option>
                                                        <option value="5" <?php if($data_['clevel'] == '5'){ echo 'selected'; } ?>>5</option>
                                                        <option value="6" <?php if($data_['clevel'] == '6'){ echo 'selected'; } ?>>6</option>
                                                        <option value="7" <?php if($data_['clevel'] == '7'){ echo 'selected'; } ?>>7</option>
                                                        <option value="8" <?php if($data_['clevel'] == '8'){ echo 'selected'; } ?>>8</option>
                                                        <option value="9" <?php if($data_['clevel'] == '9'){ echo 'selected'; } ?>>9</option>
                                                        <option value="10" <?php if($data_['clevel'] == '10'){ echo 'selected'; } ?>>10</option>
                                                        <option value="11" <?php if($data_['clevel'] == '11'){ echo 'selected'; } ?>>11</option>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Chart Order</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="chart_order_pos" id="chart_order_pos" style="width: ;height: 30px;">
                                                        <option value="1" <?php if($data_['corder'] == '1'){ echo 'selected'; } ?>>1</option>
                                                        <option value="2" <?php if($data_['corder'] == '2'){ echo 'selected'; } ?>>2</option>
                                                        <option value="3" <?php if($data_['corder'] == '3'){ echo 'selected'; } ?>>3</option>
                                                        <option value="4" <?php if($data_['corder'] == '4'){ echo 'selected'; } ?>>4</option>
                                                        <option value="5" <?php if($data_['corder'] == '5'){ echo 'selected'; } ?>>5</option>
                                                        <option value="6" <?php if($data_['corder'] == '6'){ echo 'selected'; } ?>>6</option>
                                                        <option value="7" <?php if($data_['corder'] == '7'){ echo 'selected'; } ?>>7</option>
                                                        <option value="8" <?php if($data_['corder'] == '8'){ echo 'selected'; } ?>>8</option>
                                                        <option value="9" <?php if($data_['corder'] == '9'){ echo 'selected'; } ?>>9</option>
                                                        <option value="10" <?php if($data_['corder'] == '10'){ echo 'selected'; } ?>>10</option>
                                                        <option value="11" <?php if($data_['corder'] == '11'){ echo 'selected'; } ?>>11</option>
                                                        <option value="12" <?php if($data_['corder'] == '12'){ echo 'selected'; } ?>>12</option>
                                                        <option value="13" <?php if($data_['corder'] == '13'){ echo 'selected'; } ?>>13</option>
                                                        <option value="14" <?php if($data_['corder'] == '14'){ echo 'selected'; } ?>>14</option>
                                                        <option value="15" <?php if($data_['corder'] == '15'){ echo 'selected'; } ?>>15</option>
                                                        <option value="16" <?php if($data_['corder'] == '16'){ echo 'selected'; } ?>>16</option>
                                                        <option value="17" <?php if($data_['corder'] == '17'){ echo 'selected'; } ?>>17</option>
                                                        <option value="18" <?php if($data_['corder'] == '18'){ echo 'selected'; } ?>>18</option>
                                                        <option value="19" <?php if($data_['corder'] == '19'){ echo 'selected'; } ?>>19</option>
                                                        <option value="20" <?php if($data_['corder'] == '20'){ echo 'selected'; } ?>>20</option>
                                                        <option value="21" <?php if($data_['corder'] == '21'){ echo 'selected'; } ?>>21</option>
                                                        <option value="22" <?php if($data_['corder'] == '22'){ echo 'selected'; } ?>>22</option>
                                                        <option value="23" <?php if($data_['corder'] == '23'){ echo 'selected'; } ?>>23</option>
                                                        <option value="24" <?php if($data_['corder'] == '24'){ echo 'selected'; } ?>>24</option>
                                                        <option value="25" <?php if($data_['corder'] == '25'){ echo 'selected'; } ?>>25</option>
                                                        <option value="26" <?php if($data_['corder'] == '26'){ echo 'selected'; } ?>>26</option>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Attachment</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row">
                                                        <div class="col-sm-8">
                                                               <a href="file/<?php echo $data_['filename']; ?>" target="_blank"><u><?php echo $data_['filename']; ?></u></a>
                                                        </div>
                                                 </div>
                                                 <div class="form-row">
                                                        <div class="col-sm-8">
                                                               <input type="file" name="attch" id="attch" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                                        </div>
                                                 </div>
                                                 
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">File Extension</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                
                                                       <p>txt,doc,docx,pdf,xlsx,xlp,ppt,pptx</p>
           
                                                    
                                                 </div>
                                          </div>
                                   </div>
                            </fieldset>
                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" id="delete_org"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="submit_org"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

       $(document).on('click', '#submit_org', function(){
          
		   		const fileupload    = $('#attch').prop('files')[0]; 
                var position_id     = $('#position_id').val();         
                var unit_code       = $('#unit_code').val();            
                var parent_code     = $('#parent_code').attr('id1');
                var unit_name_en    = $('#unit_name_en').val();
                var unit_name_id    = $('#unit_name_id').val();
                var status_pos      = $('#status_pos').attr('id1');
                var job_status_pos  = $('#job_status_pos').val();
                var job_title_pos   = $('#job_title_pos').val();
                var grade_list      = $('.grade_list').val();
                var work_location   = $('.work_location').val();
                var job_desc_en     = $('#job_desc_en').val();
                var job_desc_id     = $('#job_desc_id').val();
                var cost_center     = $('#cost_center').val();
                var require_suc     = $('#require_suc').attr('id1');
                var acting_as_pos   = $('#acting_as_pos').val();
                var chart_level_pos = $('#chart_level_pos').val();
                var chart_order_pos = $('#chart_order_pos').val();

            if(unit_code == ''){
                alert('Unit code is required!');
                return;
            }else if(parent_code == ''){
                alert('Parent code is required!');
                return;
            }else if(unit_name_en == ''){
                alert('Unit name en is required!');
                return
            }else if(unit_name_id == ''){
                alert('Unit name id is required!');
                return
            }else if(job_status_pos == ''){
                alert('Job status is required!');
                return
            }else if(job_title_pos == ''){
                alert('Job title is required!');
                return
            }else if(cost_center == ''){
              alert('Cost center is required!');
                return
            }

              let formData = new FormData();
		   formData.append('attch', fileupload);
              formData.append('position_id', position_id);
              formData.append('unit_code', unit_code);
              formData.append('parent_code', parent_code);
              formData.append('unit_name_en', unit_name_en);
              formData.append('unit_name_id', unit_name_id);
              formData.append('status_pos', status_pos);
              formData.append('job_status_pos', job_status_pos);
              formData.append('job_title_pos', job_title_pos);
              formData.append('grade_list', grade_list);
              formData.append('work_location', work_location);
              formData.append('job_desc_en', job_desc_en);
              formData.append('job_desc_id', job_desc_id);
              formData.append('cost_center', cost_center);
              formData.append('require_suc', require_suc);
              formData.append('acting_as_pos', acting_as_pos);
              formData.append('chart_level_pos', chart_level_pos);
              formData.append('chart_order_pos', chart_order_pos);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_setting_posjob.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                       location.reload();
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	       });

        
          

       }); 

       $(document).on('click', '#delete_org', function(){

            var position_id     = $('#position_id').val();         
       

              // alert(fileupload);
              let formData = new FormData();
                formData.append('position_id', position_id);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_delete_org.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                       location.reload();
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	        });

       }); 


}); 
</script>

<script>
$(document).ready(function() {

   
});
</script>

<script type="text/javascript">
            $(document).ready(function() {

                // Selector input yang akan menampilkan autocomplete.
                $( "#parent_code" ).autocomplete({
                    serviceUrl: "ajax_parent.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#parent_code" ).val("" + suggestion.value);
                        $( "#parent_code" ).attr('id1', suggestion.parent);
                    }
                });
            })
        </script>

<script>
$(document).ready(function() {
    $(document).on('change', '#status_org', function(){
        var status      = $(this).attr('id1');
        // alert(status);
        if(status == '1'){
            $('#status_org').attr('id1', '0');
        }else if(status == '0'){
            $('#status_org').attr('id1', '1');
        }
    });
});
</script>

<script>
$(document).ready(function() {
    $(document).on('change', '#status_pos', function(){
        var status      = $(this).attr('id1');
        // alert(status);
        if(status == '1'){
            $('#status_pos').attr('id1', '0');
        }else if(status == '0'){
            $('#status_pos').attr('id1', '1');
        }
    });
});
</script>


<script>
$(document).ready(function() {
    $(document).on('change', '#require_suc', function(){
        var status      = $(this).attr('id1');
        // alert(status);
        if(status == 'Y'){
            $('#require_suc').attr('id1', 'N');
        }else if(status == 'N'){
            $('#require_suc').attr('id1', 'Y');
        }
    });
});
</script>
