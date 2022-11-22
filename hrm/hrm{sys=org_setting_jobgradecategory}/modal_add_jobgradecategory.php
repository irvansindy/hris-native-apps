<?php include "../../application/session/session.php";

// $id     = $_POST['id'];

// Ambil data job garde
$sql_jobgrade   = mysqli_query($connect, "SELECT * FROM teomgradecategory");
$job_rows       = mysqli_num_rows($sql_jobgrade);


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
                     <h4 class="modal-title">Add Job Grade Category</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Grade Category Code *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="grade_category_code" id="grade_category_code" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Grade Category Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="grade_category_name" id="grade_category_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Order No *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="order_no" id="order_no" style="width: ;height: 30px;">
                                                        <option value="0">-- Select one --</option>
                                                        <?php 
                                                            for ($i = 1; $i <= $job_rows+1; $i++){
                                                        ?>
                                                        <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
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
                                                                             <button type="submit" id="add_jobgrade"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

    $(document).on('click', '#add_jobgrade', function(){
              var grade_category_code          = $('#grade_category_code').val();            
              var grade_category_name          = $('#grade_category_name').val();
              var order_no                     = $('#order_no').val();
		
			  if(grade_category_code == ''){
                     alert('Grade category code is required!');
                     return;
              }else if(grade_category_name == ''){
                     alert('Grade category name is required!');
                     return;
              }

              // alert(fileupload);
              let formData = new FormData();
                formData.append('grade_category_code', grade_category_code);
                formData.append('grade_category_name', grade_category_name);
                formData.append('order_no', order_no);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_add_jobgardecategory.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                       location.reload();
					return;
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	        });

    }); 


}); 
</script>