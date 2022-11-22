<?php include "../../application/session/session.php";

// $id     = $_POST['id'];

// Ambil data job garde



// Ambil grade category

?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-md">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Add Job Status</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Job Status Code *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group" style="padding-left:15.5px">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="job_status_code" id="job_status_code" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4">Job Status Name *</div>
                                          <div class="col-sm-8">
                                          <div class="from-row">
                                          <div class="col-sm-12" style="padding-left:2px">
                                          <div class="from-row">
                                            <div class="col-sm-10">
                                                    <div class="input-group">

                                                            <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="job_statusname_en" id="job_statusname_en" type="Text" value=""
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                                                    </div>
                                            </div>
                                            <div class="col-sm-2">
                                                        <div class="input-group">
                                                        <img src="img/flag_en.png" alt="">    
                                                        </div>
                                            </div>
                                          </div>
                                          <div class="from-row" style="margin-top:40px">
                                            <div class="col-sm-10">
                                                    <div class="input-group">

                                                            <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="job_statusname_id" id="job_statusname_id" type="Text" value=""
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                                                    </div>
                                            </div>
                                            <div class="col-sm-2">
                                                        <div class="input-group">
                                                        <img src="img/flag_id.png" alt="">    
                                                        </div>
                                            </div>
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
                                                                             <button type="submit" id="add_jobstatus"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

    $(document).on('click', '#add_jobstatus', function(){
              var job_status_code              = $('#job_status_code').val();            
              var job_statusname_en            = $('#job_statusname_en').val();
              var job_statusname_id            = $('#job_statusname_id').val();

              // alert(fileupload);
              let formData = new FormData();
                formData.append('job_status_code', job_status_code);
                formData.append('job_statusname_en', job_statusname_en);
                formData.append('job_statusname_id', job_statusname_id);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_add_jobstatus.php",
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