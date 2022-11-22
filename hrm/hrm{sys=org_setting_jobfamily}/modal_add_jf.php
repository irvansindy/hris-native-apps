<?php include "../../application/session/session.php";

// $id     = $_POST['id'];


// Ambil data job family grade
// $sql_jf      = mysqli_query($connect, "SELECT 
// a.jf_code,
// a.jf_name_en,
// a.jf_name_id,
// a.jf_desc_en,
// a.jf_desc_id
// FROM teomjf a 
// WHERE a.jf_code = '$id'");

// $data_jf     = mysqli_fetch_assoc($sql_jf);

// Ambil data job family grade


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-md">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Add Job Family</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Code *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="jf_code" id="jf_code" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Family Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="jf_name_en" id="jf_name_en" type="Text" value=""
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
                                                                             name="jf_name_id" id="jf_name_id" type="Text" value=""
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
                                          <div class="col-4 name">Job Family Description *</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                            <div class="input-group">
                                                                <textarea class="textarea--style-6" id="jf_desc_en" name="jf_desc_en" placeholder="Description"></textarea> 
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

                                                               <textarea class="textarea--style-6" id="jf_desc_id" name="jf_desc_id" placeholder="Deskripsi"></textarea> 

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
                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             
                                                                             <button type="submit" id="submit_jf"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

       $(document).on('click', '#submit_jf', function(){
              var jf_code         = $('#jf_code').val();            
              var jf_name_en      = $('#jf_name_en').val();
              var jf_name_id      = $('#jf_name_id').val();
              var jf_desc_en      = $('#jf_desc_en').val();
              var jf_desc_id      = $('#jf_desc_id').val();

		   if(jf_code == ''){
                     alert('Job family code is required!');
                     return;
              }else if(jf_name_en == ''){
                     alert('Job family name en is required!');
                     return;
              }else if(jf_name_id == ''){
                     alert('Job family name id is required!');
                     return;
              }else if(jf_desc_en == ''){
                     alert('Job family desc en is required!');
                     return;
              }
              else if(jf_desc_id == ''){
                     alert('Job family desc id is required!');
                     return;
              }
              // alert(fileupload);
              let formData = new FormData();
                formData.append('jf_code', jf_code);
                formData.append('jf_name_en', jf_name_en);
                formData.append('jf_name_id', jf_name_id);
                formData.append('jf_desc_en', jf_desc_en);
                formData.append('jf_desc_id', jf_desc_id);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_add_jf.php",
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
    $(document).on('click', '#jobfamilyrelation', function(){
        var id  = $(this).attr('id1');
        $.post('data_jobfamilyrelation.php',{id:id}, function (data) {
                var w = window.open('data_jobfamilyrelation.php?id='+id+'','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true);
                w.document.open();
                w.document.write(data);
                w.document.close();
                // w.document.focus();
        });
    });
});
</script>
