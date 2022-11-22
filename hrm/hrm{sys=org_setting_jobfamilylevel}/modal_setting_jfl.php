<?php include "../../application/session/session.php";

$id     = $_POST['id'];


// Ambil data job family grade
$sql_jfl      = mysqli_query($connect, "SELECT 
a.jfl_code,
a.jfl_name_en,
a.jfl_name_id,
CONCAT(b.jf_code, ' - ', b.jf_name_en) AS job_family,
CONCAT(c.jfgrade_code, ' - ', c.jfgrade_name_en) AS job_grade
FROM teorjfl a
LEFT JOIN teomjf b ON a.jf_code = b.jf_code
LEFT JOIN teomjfgrade c ON a.jfgrade_code = c.jfgrade_code
WHERE a.jfl_code = '$id'");

$data_jfl     = mysqli_fetch_assoc($sql_jfl);

// Ambil data job family grade


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-md">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Job Family Level</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Level Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="jfl_code" id="jfl_code" type="Text" value="<?php echo $data_jfl['jfl_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Level Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="jfl_name_en" id="jfl_name_en" type="Text" value="<?php echo $data_jfl['jfl_name_en']; ?>"
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
                                                                             name="jfl_name_id" id="jfl_name_id" type="Text" value="<?php echo $data_jfl['jfl_name_id']; ?>"
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
                                   <div class="form-row">
                                          <div class="col-4 name">Job Family</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="grade_code" id="grade_code" type="Text" value="<?php echo $data_jfl['job_family']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Grade</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="grade_code" id="grade_code" type="Text" value="<?php echo $data_jfl['job_grade']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row" style="align-items:end">
                                          <div class="col-5 name">Job Family Level - Job Title Relation</div>
                                          <div class="col-sm-7">
                                                 <div class="input-group">

                                                        <a href="#" id="datajobtitle" id1="<?php echo $data_jfl['jfl_code']; ?>"><u>Yes</u></a>
                                                 </div>
                                          </div>
                                   </div>
                            </fieldset>
                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" id="delete_jfl"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="submit_jfl"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

       $(document).on('click', '#submit_jfl', function(){
              var jfl_code         = $('#jfl_code').val();            
              var jfl_name_en      = $('#jfl_name_en').val();
              var jfl_name_id      = $('#jfl_name_id').val();
		   
		   	  if(jfl_name_en == ''){
                     alert('Job family level name en required!');
                     return;
              }else if(jfl_name_id == ''){
                     alert('Job family level name id required!');
                     return;
              }

              // alert(fileupload);
              let formData = new FormData();
                formData.append('jfl_code', jfl_code);
                formData.append('jfl_name_en', jfl_name_en);
                formData.append('jfl_name_id', jfl_name_id);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_edit_jfl.php",
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
    $(document).on('click', '#datajobtitle', function(){
        var id  = $(this).attr('id1');
        $.post('data_jobtitle.php',{id:id}, function (data) {
                var w = window.open('data_jobtitle.php?id='+id+'','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true);
                w.document.open();
                w.document.write(data);
                w.document.close();
                // w.document.focus();
        });
    });
});
</script>
