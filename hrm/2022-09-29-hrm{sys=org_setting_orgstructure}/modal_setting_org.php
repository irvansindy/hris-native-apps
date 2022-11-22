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

// Ambil Head Div
$sql_head_div     = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en,
a.pos_code,
CONCAT(a.pos_name_en, ' [', a.pos_code, ']') AS name_pos
FROM hrmorgstruc a 
WHERE a.parent_id = '$id'
AND a.pos_flag = '2' 
AND a.pos_active = '1'");
// Ambil Head Div

// Ambil data
$sql_ambil_data     = mysqli_query($connect, "SELECT 
a.pos_code,
a.parent_id,
b.pos_name_en AS parent_name,
a.pos_name_en,
a.pos_name_id,
a.org_level,
a.pos_active,
a.head_div,
a.report_postype,
a.clevel,
a.corder
FROM hrmorgstruc a
LEFT JOIN hrmorgstruc b ON b.position_id = a.parent_id
WHERE a.position_id = '$id'");
$data_              = mysqli_fetch_assoc($sql_ambil_data);
// Ambil data


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


<!-- Autocomplete -->
<script src="jquery.autocomplete.min.js"></script>

<div class="modal-dialog modal-bg">
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
                                                                             name="" id="" type="Text" value="Organization Unit"
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
                                                        <option value="<?php echo $data_org_level['code'] ?>" <?php if($data_['org_level'] == $data_org_level['code']){ echo "selected"; } ?>><?php echo $data_org_level['name_en'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row" >
                                          <div class="col-4">Status</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <input class="form-check-input" type="checkbox" value="" id1="<?php if($data_['pos_active'] == '1'){ echo "1"; }else{ echo "0"; } ?>" id="status_org" <?php if($data_['pos_active'] == '1'){ echo "checked"; } ?> >

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Head Position</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="head_pos" id="head_pos" style="width: ;height: 30px;">
                                                    <option value="0">-- Select One --</option>
                                                                <?php 
                                                                    while($data_head_div    = mysqli_fetch_assoc($sql_head_div)){
                                                                        
                                                                ?>
                                                        <option value="<?php echo $data_head_div['position_id'] ?>" <?php if($data_head_div['position_id'] == $data_['head_div']){ echo 'selected'; } ?>><?php echo $data_head_div['name_pos'] ?></option>
                                                                <?php } ?>

                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Acting As</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="acting_as" id="acting_as" style="width: ;height: 30px;">
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

                                                    <select class="input--style-6" name="chart_level_org" id="chart_level_org" style="width: ;height: 30px;">
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

                                                    <select class="input--style-6" name="chart_order_org" id="chart_order_org" style="width: ;height: 30px;">
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
                        
                var position_id     = $('#position_id').val();         
                var unit_code       = $('#unit_code').val();            
                var parent_code     = $('#parent_code').attr('id1');
                var unit_name_en    = $('#unit_name_en').val();
                var unit_name_id    = $('#unit_name_id').val();
                var org_level       = $('#org_level').val();
                var status          = $('#status_org').attr('id1');
                var head_pos        = $('#head_pos').val();
                var acting_as       = $('#acting_as').val();
                var chart_level     = $('#chart_level_org').val();
                var chart_order     = $('#chart_order_org').val();

              let formData = new FormData();
              formData.append('position_id', position_id);
              formData.append('unit_code', unit_code);
              formData.append('parent_code', parent_code);
              formData.append('unit_name_en', unit_name_en);
              formData.append('unit_name_id', unit_name_id);
              formData.append('org_level', org_level);
              formData.append('status', status);
              formData.append('head_pos', head_pos);
              formData.append('acting_as', acting_as);
              formData.append('chart_level', chart_level);
              formData.append('chart_order', chart_order);
               
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

              $.ajax({
                     type: 'POST',
                     url: "ajax_setting_orgunit.php",
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
