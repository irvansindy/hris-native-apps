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

$sql_ambil_div1         = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en
FROM hrmorgstruc a 
WHERE a.position_id IN ($final_inposition)
AND (a.org_level = 'DEP')
ORDER BY a.pos_level ASC
");

$sql_ambil_div2         = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en
FROM hrmorgstruc a 
WHERE a.position_id IN ($final_inposition)
AND (a.org_level = 'DIV')
ORDER BY a.pos_level ASC
");

$count_ambil_divisi     = mysqli_num_rows($sql_ambil_div1);
$data_div               = mysqli_fetch_assoc($sql_ambil_div2);



// Ambil data div dan dept 

if($count_ambil_divisi == 0){
       $sql_ambil_dept        = mysqli_query($connect, "SELECT a.position_id, a.pos_name_en FROM hrmorgstruc a 
       WHERE a.parent_path LIKE '%$data_div[position_id]%'
       AND a.org_level = 'DEP'");
}else{
       $sql_ambil_dept          = mysqli_query($connect, "SELECT 
       a.position_id,
       a.pos_name_en
       FROM hrmorgstruc a 
       WHERE a.position_id IN ($final_inposition)
       AND (a.org_level = 'DEP')
       ORDER BY a.pos_level ASC
       ");
}

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

<!-- <script src="vendor/select2.min.js"></script>
<link href="vendor/select2.min_2.css" rel="stylesheet" />
<link rel="stylesheet" href="vendor/select2-bootstrap4.min.css"> -->

<!-- <link href="../../asset/gt_developer/select2-ajax/css/select2.css" rel="stylesheet" />
<script src="../../asset/gt_developer/jquery.min.js"></script>
<script src="../../asset/gt_developer/select2-ajax/js/select2.min.js"></script> -->

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
                               
                                                        <option value="">-- Select one --</option>
                                                        <?php  
                                                            while($data_ambil_dept = mysqli_fetch_assoc($sql_ambil_dept)){
                                                        ?>
                                                        <option value="<?php echo $data_ambil_dept['position_id']; ?>"><?php echo $data_ambil_dept['pos_name_en']; ?></option>
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
                <div class="form-row">
                                          <div class="col-3 name">Attch</div>
                                          <div class="col-sm-9">
                                                 <div class="input-group">
                                                        <input class="input--style-6" type="file" id="file_pengajuan" name="file_pengajuan">
                                                 </div>
                                          </div>
                                   </div>
            </fieldset>

            <!-- Save otorisasi position -->    
             <input type="hidden" id="save_otorisasi" value="">
            <!-- Save otorisasi position -->

                            <fieldset id="fset_1" class="type_request" style="display:none">
                                   <!-- <legend>Searching Form</legend> -->
                                   
                                   
                                   
                            </fieldset>


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
                                                                             <button type="submit" id="" id1="1"
                                                                                    class="btn btn-warning submit tombol">Submit</button>
                                                                      </div>
                                                               </div>

                            
<!-- Merubah Value Parameter posisi otorisasi -->
<script>
$(document).ready(function(){  
    
$(document).on('change', '#tipe_pengajuan', function(){

       var m         = $('#department').val();
       var value     = $(this).val();
       const penambahan = $(".type_request");
       penambahan.css("display", "");

       $(".type_request").empty(); 

       if(value == '1'){

        $('.tombol').attr('id', 'submit_penambahan');

        $.ajax({
        url: "ajax/ajax_penambahan.php",
        type: "POST",
              data: {
                     id: m,
              },
              success: function(ajaxData) {
                     $(".type_request").html(ajaxData);
                    
              }
        });

       }else if(value == '2'){

        $('.tombol').attr('id', 'submit_penghapusan');

        $.ajax({
        url: "ajax/ajax_penghapusan.php",
        type: "POST",
              data: {
                     id: m,
              },
              success: function(ajaxData) {
                     $(".type_request").html(ajaxData);
                    
              }
        });

       }else if(value == '3'){

        $('.tombol').attr('id', 'submit_peleburan');

        $.ajax({
        url: "ajax/ajax_peleburan.php",
        type: "POST",
              data: {
                     id: m,
              },
              success: function(ajaxData) {
                     $(".type_request").html(ajaxData);
                    
              }
        });
           
       }else if(value == '4'){

        $('.tombol').attr('id', 'submit_pemisahan');
        
        $.ajax({
        url: "ajax/ajax_pemisahan.php",
        type: "POST",
              data: {
                     id: m,
              },
              success: function(ajaxData) {
                     $(".type_request").html(ajaxData);
                    
              }
        });

        }
     
});

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
  

