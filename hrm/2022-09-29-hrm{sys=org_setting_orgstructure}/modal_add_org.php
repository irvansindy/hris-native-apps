<?php include "../../application/session/session.php";

// $id     = $_POST['id'];


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

// Ambil Job Grade
$sql_job_grade      = mysqli_query($connect, "SELECT 
a.grade_code,
a.gradecategory_code,
a.grade_name
FROM teomjobgrade a 
ORDER BY a.grade_order ASC");
// Ambil Job Grade

// Ambil Work Location
$sql_work_location  = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a");
// Ambil Work Location

// Ambil Work Location
$sql_cost_center  = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a ");
// Ambil Work Location


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
                     <h4 class="modal-title">Add Organization Structure</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Position Flag</div>
                                          <div class="col-sm-8" style="padding-left:0px">
                                            <div class="form-row" style="padding-left:0px; padding-bottom:0px">
                                                 <div class="input-group">
                                                    <div class="col-sm-6" style="padding-left:1px">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <input class=""
                                                                              
                                                                              name="pf_org_unit" id="pf_org_unit" type="radio" value="" id1="1"
                                                                              style="margin-top:11px" 
                                                                              
                                                                         >
                                                                </td>
                                                                <td>
                                                                    <p style="margin-bottom:0px; margin-top:6px">Organization Unit</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        
                                                        
                                                    </div>
                                                    <div class="col-sm-6" style="padding-left:0px">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <input class=""
                                                                              
                                                                              name="pf_job_pos" id="pf_job_pos1" type="radio" id1="0" value=""
                                                                              style="margin-top:11px" 
                                                                              
                                                                         >
                                                                </td>
                                                                <td>
                                                                    <p style="margin-bottom:0px; margin-top:6px">Job Position</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        
                                                        
                                                    </div>
                                                 </div>
                                            </div>
                                          </div>
                                   </div>
                                
                                   <div class="form-row">
                                          <div class="col-4 name">Unit Code *</div>
                                          <div class="col-sm-8">

                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="unit_code" id="unit_code" type="Text" value=""
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
                                                                             name="parent_code" id="parent_code" type="Text" value="" id1=""
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
                                                                             name="unit_name_en" id="unit_name_en" type="Text" value=""
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
                                                                             name="unit_name_id" id="unit_name_id" type="Text" value=""
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
                                <fieldset style="style:" id="tampil_org_unit">
                                   <div class="form-row">
                                          <div class="col-4 name">Organization Level *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="org_level" id="org_level" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_org_level = mysqli_fetch_assoc($sql_org_level)){
                                                        ?>
                                                        <option value="<?php echo $data_org_level['code'] ?>"><?php echo $data_org_level['name_en'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row" >
                                          <div class="col-4">Status</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <input class="form-check-input" type="checkbox" value="" id1="0" id="status_org" >

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Acting As</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="acting_as" id="acting_as" style="width: ;height: 30px;">
                                                        <option value="SO">SubOrdinate</option>
                                                        <option value="DS">Assistant</option>
                                                        <option value="DL">Left Assistant</option>
                                                        <option value="DR">Right Assistant</option>
                                                        <option value="CS">Consultant</option>
                                                        <option value="CL">Left Consultant</option>
                                                        <option value="CR">Right Consultant</option>

                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Chart Level</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="chart_level_org" id="chart_level_org" style="width: ;height: 30px;">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Chart Order</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="chart_order_org" id="chart_order_org" style="width: ;height: 30px;">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                </fieldset>

                                
                                <fieldset style="display:none" id="tampil_job_pos">
                                    <div class="form-row" >
                                          <div class="col-4">Status</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <input class="form-check-input" type="checkbox" value="" id1="0" id="status_pos" >

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
                                                        <option value="<?php echo $data_job_status['jobstatuscode'] ?>"><?php echo $data_job_status['jobstatusname_en'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job TItle *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="job_title_pos" id="job_title_pos" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_job_title = mysqli_fetch_assoc($sql_job_title)){
                                                        ?>
                                                        <option value="<?php echo $data_job_title['jobtitle_code'] ?>"><?php echo $data_job_title['jobtitle_name_en'] ?></option>
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

                                                                    <textarea class="textarea--style-6" id="job_desc_en" name="job_desc_en" placeholder="Description"></textarea>        

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

                                                                <textarea class="textarea--style-6" id="job_desc_id" name="job_desc_id" placeholder="Deskripsi"></textarea>        

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
                                                        <option value="<?php echo $data_cost_center['costcenter_code'] ?>"><?php echo $data_cost_center['costcenter_name_en'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row" >
                                          <div class="col-4">Require Successor</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <input class="form-check-input" type="checkbox" value="" id1="0" id="require_suc" >

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Acting As</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <select class="input--style-6" name="acting_as_pos" id="acting_as_pos" style="width: ;height: 30px;">
                                                        <option value="SO">SubOrdinate</option>
                                                        <option value="DS">Assistant</option>
                                                        <option value="DL">Left Assistant</option>
                                                        <option value="DR">Right Assistant</option>
                                                        <option value="CS">Consultant</option>
                                                        <option value="CL">Left Consultant</option>
                                                        <option value="CR">Right Consultant</option>

                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Chart Level</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="chart_level_pos" id="chart_level_pos" style="width: ;height: 30px;">
                                                    <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Chart Order</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="chart_order_pos" id="chart_order_pos" style="width: ;height: 30px;">
                                                    <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Attachment</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                
                                                        <input type="file" name="attch" id="attch" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
           
                                                    
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
                                                                             
                                                                             <button type="submit" id="submit_org"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

       $(document).on('click', '#submit_org', function(){
            var pf_org_unit       = $('#pf_org_unit').attr('id1');
            var pf_job_pos        = $('#pf_job_pos1').attr('id1');

            if(pf_org_unit == '1'){
                var unit_code       = $('#unit_code').val();            
                var parent_code     = $('#parent_code').attr('id1');
                var unit_name_en    = $('#unit_name_en').val();
                var unit_name_id    = $('#unit_name_id').val();
                var org_level       = $('#org_level').val();
                var status          = $('#status_org').attr('id1');
                var acting_as       = $('#acting_as').val();
                var chart_level     = $('#chart_level_org').val();
                var chart_order     = $('#chart_order_org').val();

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
              }else if(org_level == ''){
                     alert('Job status is required!');
                     return
              }

              let formData = new FormData();
              formData.append('unit_code', unit_code);
              formData.append('parent_code', parent_code);
              formData.append('unit_name_en', unit_name_en);
              formData.append('unit_name_id', unit_name_id);
              formData.append('org_level', org_level);
              formData.append('status', status);
              formData.append('acting_as', acting_as);
              formData.append('chart_level', chart_level);
              formData.append('chart_order', chart_order);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_add_orgunit.php",
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
            }

            if(pf_job_pos == '1'){
				const fileupload    = $('#attch').prop('files')[0]; 
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
                     url: "ajax_add_posjob.php",
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

            }
            //   var jt_code         = $('#jt_code').val();            
            //   var jt_name_en      = $('#jt_name_en').val();
            //   var jt_name_id      = $('#jt_name_id').val();
            //   var jfl_code        = $('#jfl_code').val();
            //   var jt_desc_en      = $('#jt_desc_en').val();
            //   var jt_desc_id      = $('#jt_desc_id').val();

            //   if(jt_code == ''){
            //         alert('Job title code required!');
            //         return;
            //   }else if(jt_name_en == ''){
            //          alert('Job title name en required!');
            //          return;
            //   }else if(jt_name_id == ''){
            //          alert('Job title name id required!');
            //          return;
            //   }else if(jfl_code == ''){
            //         alert('Job family level required!');
            //         return;
            //   }

            //   // alert(fileupload);
            //   let formData = new FormData();
            //     formData.append('jt_code', jt_code);
            //     formData.append('jt_name_en', jt_name_en);
            //     formData.append('jt_name_id', jt_name_id);
            //     formData.append('jfl_code', jfl_code);
            //     formData.append('jt_desc_en', jt_desc_en);
            //     formData.append('jt_desc_id', jt_desc_id);
               
            //   $.ajax({
            //          type: 'POST',
            //          url: "ajax_add_jt.php",
            //          data: formData,
            //          cache: false,
            //          processData: false,
            //          contentType: false,
	        //     success: function (msg) {
	        //         alert(msg);
            //            location.reload();
	        //     },
	        //     error: function () {
	        //         alert("Data Gagal Diupload");
	        //     }
	        // });

       }); 

       $(document).on('click', '#delete_jfl', function(){
              var jfl_code         = $('#jfl_code').val();            
       

              // alert(fileupload);
              let formData = new FormData();
                formData.append('jfl_code', jfl_code);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_delete_jfl.php",
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

    $('#pf_org_unit').prop('checked', true);
    $('#pf_org_unit').attr('id1', '1');

    $(document).on('click', '#pf_org_unit', function(){
        const org_unit = $("#tampil_org_unit");
        org_unit.css("display", "");
        const job_pos = $("#tampil_job_pos");
        job_pos.css("display", "none");
        $(this).attr('id1', '1');
        $('#pf_job_pos1').attr('id1', '0');
        $('#pf_job_pos1').prop('checked', false);
    });

    $(document).on('click', '#pf_job_pos1', function(){
        const job_pos = $("#tampil_job_pos");
        job_pos.css("display", "");
        const org_unit = $("#tampil_org_unit");
        org_unit.css("display", "none");
        $(this).attr('id1', '1');
        $('#pf_org_unit').attr('id1', '0');
        $('#pf_org_unit').prop('checked', false);
    });
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
        if(status == '1'){
            $('#require_suc').attr('id1', '0');
        }else if(status == '0'){
            $('#require_suc').attr('id1', '1');
        }
    });
});
</script>
