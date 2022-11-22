<?php include "../../application/session/session.php";

$id     = $_POST['id'];

// Ambil data job garde
$sql_jobgrade   = mysqli_query($connect, "SELECT * FROM teomgradecategory");
$job_rows       = mysqli_num_rows($sql_jobgrade);


// Ambil grade category
$sql_gradecategory  = mysqli_query($connect, "SELECT * FROM teomgradecategory WHERE gradecategory_code = '$id'");
$data_gradecategory = mysqli_fetch_assoc($sql_gradecategory);
// Ambil grade category

// Ambil grade
$sql_grade          = mysqli_query($connect, "SELECT 
a.grade_code,
a.gradecategory_code,
a.grade_name
FROM teomjobgrade a WHERE a.gradecategory_code = '$id' ORDER BY a.grade_order ASC");

$sql_grade_notin    = mysqli_query($connect, "SELECT 
a.grade_code,
a.gradecategory_code,
a.grade_name
FROM teomjobgrade a WHERE a.gradecategory_code NOT IN('$id') ORDER BY a.grade_order ASC");
// Ambil grade
?>

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
			});
		</script>
<!-- Dual List Box -->


<div class="modal-dialog modal-bg">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Job Grade Category</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Grade Category Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="grade_category_code" id="grade_category_code" type="Text" value="<?php echo $data_gradecategory['gradecategory_code'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Grade Category Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="grade_category_name" id="grade_category_name" type="Text" value="<?php echo $data_gradecategory['gradecategory_name'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Grade List</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <select id="select2" class="grade_list" name="grade_list[]" multiple="multiple" size="15">
                                                     <?php while($data  = mysqli_fetch_assoc($sql_grade_notin)){ ?>
                                                    <option value="<?php echo $data['grade_code'] ?>"><?php echo $data['grade_name'] ?></option>
                                                    <?php } ?>
                                                    <?php while($data  = mysqli_fetch_assoc($sql_grade)){ ?>
                                                    <option value="<?php echo $data['grade_code'] ?>" selected><?php echo $data['grade_name'] ?></option>
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
                                                                            <button type="submit" id="delete_jobgradecategory"
                                                                                    class="btn btn-danger">Delete</button>
                                                                            <button type="submit" id="edit_jobgradecategory"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

    $(document).on('click', '#edit_jobgradecategory', function(){
              var grade_category_code          = $('#grade_category_code').val();            
              var grade_category_name          = $('#grade_category_name').val();
              var grade_list                   = $('.grade_list').val();

				if(grade_category_name == ''){
                     alert('Grade category name is required!');
                     return;
              }
		
            //   alert(grade_list);
              let formData = new FormData();
                formData.append('grade_category_code', grade_category_code);
                formData.append('grade_category_name', grade_category_name);
                formData.append('grade_list', grade_list);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_edit_jobgardecategory.php",
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
	
	$(document).on('click', '#delete_jobgradecategory', function(){
              var grade_category_code          = $('#grade_category_code').val();            

              // alert(fileupload);
              let formData = new FormData();
                formData.append('grade_category_code', grade_category_code);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_delete_jobgradecategory.php",
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

<script type="text/javascript">
       var tree4 = $("#test-select-4").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>

