<?php include "../../application/session/session.php";

// $id     = $_POST['id'];


// Ambil data job family 
$sql_jf     = mysqli_query($connect, "SELECT 
a.jf_code,
CONCAT(a.jf_code, ' ', '-', ' ', a.jf_name_en) AS jf_name
FROM teomjf a");
// Ambil data job family 


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-md">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Add Job Family Level</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Level Code *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="jfl_code" id="jfl_code" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
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
                                                                             name="jfl_name_en" id="jfl_name_en" type="Text" value=""
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
                                                                             name="jfl_name_id" id="jfl_name_id" type="Text" value=""
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
                                   <div class="form-row">
                                          <div class="col-4 name">Job Family *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="jf_code" id="jf_code" style="width: ;height: 30px;">
                                                        <option value="0">-- Select one --</option>
                                                        <?php  
                                                            while($data_jf = mysqli_fetch_assoc($sql_jf)){
                                                        ?>
                                                        <option value="<?php echo $data_jf['jf_code']; ?>"><?php echo $data_jf['jf_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Grade *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="jfgrade" id="jfgrade" style="width: ;height: 30px;">
                                                        <option value="0">-- Choose Job Family First --</option>
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
              var jf_code          = $('#jf_code').val(); 
              var jf_grade         = $('#jfgrade').val(); 

			  if(jfl_code == ''){
                     alert('Job family level code required!');
                     return;
              }else if(jfl_name_en == ''){
                     alert('Job family level name en required!');
                     return;
              }else if(jfl_name_id == ''){
                     alert('Job family level name id required!');
                     return;
              }else if(jf_code == ''){
                     alert('Job family code required!');
                     return;
              }else if(jf_grade == ''){
                     alert('Job family grade required!');
                     return;
              }

              // alert(fileupload);
              let formData = new FormData();
                formData.append('jfl_code', jfl_code);
                formData.append('jfl_name_en', jfl_name_en);
                formData.append('jfl_name_id', jfl_name_id);
                formData.append('jf_code', jf_code);
                formData.append('jf_grade', jf_grade);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_add_jfl.php",
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
