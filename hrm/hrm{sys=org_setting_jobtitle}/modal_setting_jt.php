<?php include "../../application/session/session.php";

$id     = $_POST['id'];


// Ambil data job family grade
$sql_jt      = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en,
a.jobtitle_name_id,
a.jobtitle_desc_en,
a.jobtitle_desc_id,
a.jfl_code,
a.filename
FROM teomjobtitle a
WHERE a.jobtitle_code = '$id'");

$data_jt     = mysqli_fetch_assoc($sql_jt);

$sql_jfl     = mysqli_query($connect, "SELECT 
a.jfl_code,
CONCAT(a.jfl_name_en, ' [', a.jfl_code, ']') AS jfl_name
FROM teorjfl a ");

// Ambil data job family grade


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-bg">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Job Title</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Job Title Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="jt_code" id="jt_code" type="Text" value="<?php echo $data_jt['jobtitle_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Job Title Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="jt_name_en" id="jt_name_en" type="Text" value="<?php echo $data_jt['jobtitle_name_en']; ?>"
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
                                                                             name="jt_name_id" id="jt_name_id" type="Text" value="<?php echo $data_jt['jobtitle_name_id']; ?>"
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
                                          <div class="col-4 name">Job Family Level *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="jfl_code" id="jfl_code" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_jfl = mysqli_fetch_assoc($sql_jfl)){
                                                        ?>
                                                        <option value="<?php echo $data_jfl['jfl_code'] ?>" <?php if($data_jt['jfl_code'] == $data_jfl['jfl_code']){ echo 'selected';} ?> ><?php echo $data_jfl['jfl_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Attachment</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row">
                                                        <div class="col-sm-8">
                                                               <a href="file/<?php echo $data_jt['filename']; ?>" target="_blank"><u><?php echo $data_jt['filename']; ?></u></a>
                                                        </div>
                                                 </div>
                                                 <div class="form-row">
                                                        <div class="col-sm-8">
                                                               <input type="file" name="attch" id="attch" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                                        </div>
                                                 </div>
                                                 
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">File Extension</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                
                                                       <p>txt,doc,docx,pdf,xlsx,xlp,ppt,pptx</p>
           
                                                    
                                                 </div>
                                          </div>
                                   </div>
                                </fieldset>

                                
                                <fieldset id="fset_1">
                                   <div class="form-row">
                                          <div class="col-4 name">Job Title Desc</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                                    <textarea class="textarea--style-6" id="jt_desc_en" name="jt_desc_en" placeholder="Misi"><?php echo $data_jt['jobtitle_desc_en']; ?></textarea>        

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

                                                                <textarea class="textarea--style-6" id="jt_desc_id" name="jt_desc_id" placeholder="Misi"><?php echo $data_jt['jobtitle_desc_id']; ?></textarea>        

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
                                                                             <button type="submit" id="delete_jt"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="submit_jt"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

       $(document).on('click', '#submit_jt', function(){
              const fileupload     = $('#attch').prop('files')[0];  
              var jt_code         = $('#jt_code').val();            
              var jt_name_en      = $('#jt_name_en').val();
              var jt_name_id      = $('#jt_name_id').val();
              var jfl_code        = $('#jfl_code').val();
              var jt_desc_en      = $('#jt_desc_en').val();
              var jt_desc_id      = $('#jt_desc_id').val();

              if(jt_name_en == ''){
                     alert('Job title name en required!');
                     return;
              }else if(jt_name_id == ''){
                     alert('Job title name id required!');
                     return;
              }else if(jfl_code == ''){
                    alert('Job family level required!');
                    return;
              }

              // alert(fileupload);
              let formData = new FormData();
                formData.append('attch', fileupload);
                formData.append('jt_code', jt_code);
                formData.append('jt_name_en', jt_name_en);
                formData.append('jt_name_id', jt_name_id);
                formData.append('jfl_code', jfl_code);
                formData.append('jt_desc_en', jt_desc_en);
                formData.append('jt_desc_id', jt_desc_id);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_edit_jt.php",
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

       $(document).on('click', '#delete_jt', function(){
            var jt_code         = $('#jt_code').val();            
       

              // alert(fileupload);
              let formData = new FormData();
                formData.append('jt_code', jt_code);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_delete_jt.php",
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
