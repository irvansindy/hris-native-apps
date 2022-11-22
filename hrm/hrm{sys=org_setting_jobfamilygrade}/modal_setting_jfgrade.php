<?php include "../../application/session/session.php";

$id     = $_POST['id'];


// Ambil data job family grade
$sql_jf      = mysqli_query($connect, "SELECT 
a.jfgrade_code,
a.jfgrade_name_en,
a.jfgrade_name_id
FROM teomjfgrade a
WHERE a.jfgrade_code = '$id'");

$data_jf     = mysqli_fetch_assoc($sql_jf);

// Ambil data job family grade


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-md">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Job Family Grade</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Grade Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="jfgrade_code" id="jfgrade_code" type="Text" value="<?php echo $data_jf['jfgrade_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Grade Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="jfgrade_name_en" id="jfgrade_name_en" type="Text" value="<?php echo $data_jf['jfgrade_name_en']; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
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
                                                                             name="jfgrade_name_id" id="jfgrade_name_id" type="Text" value="<?php echo $data_jf['jfgrade_name_id']; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
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
                                   
                                   <div class="form-row" style="align-items:end">
                                          <div class="col-4 name">Job Family Grade Relation</div>
                                          <div class="col-sm-7">
                                                 <div class="input-group">

                                                        <a href="#" id="jobfamilygraderelation" id1="<?php echo $data_jf['jfgrade_code']; ?>"><u>Yes</u></a>
                                                 </div>
                                          </div>
                                   </div>
                                   
                            </fieldset>
                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" id="delete_jfgrade"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="submit_jfgrade"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

       $(document).on('click', '#submit_jfgrade', function(){
              var jfgrade_code         = $('#jfgrade_code').val();            
              var jfgrade_name_en      = $('#jfgrade_name_en').val();
              var jfgrade_name_id      = $('#jfgrade_name_id').val();

              if(jfgrade_name_en == ''){
                alert('Job family grade name en required!');
                  return;
              }else if(jfgrade_name_id == ''){
                alert('Job family grade name id required!!');
                  return;
              }
            

              // alert(fileupload);
              let formData = new FormData();
                formData.append('jfgrade_code', jfgrade_code);
                formData.append('jfgrade_name_en', jfgrade_name_en);
                formData.append('jfgrade_name_id', jfgrade_name_id);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_edit_jfgrade.php",
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

       $(document).on('click', '#delete_jfgrade', function(){
              var jfgrade_code         = $('#jfgrade_code').val();            
       

              // alert(fileupload);
              let formData = new FormData();
                formData.append('jfgrade_code', jfgrade_code);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_delete_jfgrade.php",
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
    $(document).on('click', '#jobfamilygraderelation', function(){
        var id  = $(this).attr('id1');
        $.post('data_jobfamilygraderelation.php',{id:id}, function (data) {
                var w = window.open('data_jobfamilygraderelation.php?id='+id+'','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true);
                w.document.open();
                w.document.write(data);
                w.document.close();
                // w.document.focus();
        });
    });
});
</script>
