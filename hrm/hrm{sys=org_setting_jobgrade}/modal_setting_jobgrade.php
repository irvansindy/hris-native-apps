<?php include "../../application/session/session.php";

$id     = $_POST['id'];

// Ambil data job garde
$sql_jobgrade   = mysqli_query($connect, "SELECT * FROM teomjobgrade WHERE grade_code = '$id'");
$job_grade      = mysqli_fetch_assoc($sql_jobgrade);

// Ambil grade category
$sql_gradecategory  = mysqli_query($connect, "SELECT * FROM teomgradecategory ORDER BY order_id ASC");
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-md">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Job Grade</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Grade Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="grade_code" id="grade_code" type="Text" value="<?php echo $id; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Grade Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="grade_name" id="grade_name" type="Text" value="<?php echo $job_grade['grade_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Grade Category *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="grade_category" id="grade_category" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_category = mysqli_fetch_assoc($sql_gradecategory)){
                                                        ?>
                                                        <option value="<?php echo $data_category['gradecategory_code'] ?>" <?php if($job_grade['gradecategory_code'] == $data_category['gradecategory_code']){ echo 'selected';} ?> ><?php echo $data_category['gradecategory_name'] ?></option>
                                                        <?php } ?>
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
                                                                                    <button type="submit" id="delete_jobgrade"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="ubah_jobgrade"
                                                                                    class="btn btn-warning">Ubah</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
<script>
$(document).ready(function(){  

    $(document).on('click', '#ubah_jobgrade', function(){
              var grade_code          = $('#grade_code').val();            
              var grade_name          = $('#grade_name').val();
              var grade_category      = $('#grade_category').val();
		
			  if(grade_name == ''){
                     alert('Grade name is required!');
                     return;
              }else if(grade_category == ''){
                     alert('Grade category is required!');
                     return;
              }

              // alert(fileupload);
              let formData = new FormData();
                formData.append('grade_code', grade_code);
                formData.append('grade_name', grade_name);
                formData.append('grade_category', grade_category);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_ubah_jobgrade.php",
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

    $(document).on('click', '#delete_jobgrade', function(){
              var grade_code          = $('#grade_code').val();            

              // alert(fileupload);
              let formData = new FormData();
                formData.append('grade_code', grade_code);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_delete_jobgrade.php",
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

