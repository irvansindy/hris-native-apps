<?php include "../../application/session/session.php";

$id     = $_POST['id'];


// Ambil data job family grade
$sql_cc      = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en,
a.costcenter_name_id,
a.`status`,
a.parent_code
FROM teomcostcenter a
WHERE a.costcenter_code = '$id'");

$data_cc     = mysqli_fetch_assoc($sql_cc);


$sql_parent_code_cc    = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a ");

$sql_parent_code_company    = mysqli_query($connect, "SELECT 
a.parent_id,
a.company_name
FROM teomcompany a ");

// Ambil data job family grade


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-md">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Cost Center</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Cost Center Path</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="cc_path" id="cc_path" type="Text" value="<?php echo $data_cc['costcenter_name_en']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Parent Code *</div>
                                          <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select class="input--style-6" name="parent_code" id="parent_code" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_drop_company = mysqli_fetch_assoc($sql_parent_code_company)){
                                                        ?>
                                                        <option value="<?php echo $data_drop_company['parent_id'] ?>" <?php if($data_cc['parent_code'] == $data_drop_company['parent_id']){ echo 'selected';} ?> ><?php echo $data_drop_company['company_name'] ?></option>
                                                        <?php } ?>
                                                        <?php 
                                                            while($data_drop_cc = mysqli_fetch_assoc($sql_parent_code_cc)){
                                                        ?>
                                                        <option value="<?php echo $data_drop_cc['costcenter_code'] ?>" <?php if($data_cc['parent_code'] == $data_drop_cc['costcenter_code']){ echo 'selected';} ?> ><?php echo $data_drop_cc['costcenter_name_en'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Cost Center Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="cc_code" id="cc_code" type="Text" value="<?php echo $data_cc['costcenter_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-4 name">Cost Center Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="form-row" style="padding-left:0px">
                                                        <div class="col-sm-10">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" 
                                                                             name="cc_name_en" id="cc_name_en" type="Text" value="<?php echo $data_cc['costcenter_name_en']; ?>"
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
                                                                             name="cc_name_id" id="cc_name_id" type="Text" value="<?php echo $data_cc['costcenter_name_id']; ?>"
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
                                   <div class="form-row" >
                                          <div class="col-4">Status</div>
                                          <div class="col-sm-1">
                                                 <div class="input-group">

                                                 <input class="form-check-input" type="checkbox" value="" id1="<?php echo $data_cc['status'] ?>" id="cc_status" <?php if($data_cc['status'] == '1'){ echo 'checked';} ?> >
                                                 
                                                 </div>
                                          </div>
                                          <div class="col-sm-2">
                                                 <div class="input-group">
                                                        Active
                                                 </div>
                                          </div>
                                   </div>
                                   
                            </fieldset>
                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" id="delete_cc"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="submit_cc"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

       $(document).on('click', '#submit_cc', function(){
              var cc_path           = $('#cc_path').val();            
              var parent_code       = $('#parent_code').val();
              var cc_code           = $('#cc_code').val();
              var cc_name_en        = $('#cc_name_en').val();
              var cc_name_id        = $('#cc_name_id').val();
              var status            = $('#cc_status').attr('id1');

            if(parent_code == ''){
                alert('Parent code required!');
                return;
            }else if(cc_name_en == ''){
                alert('Cost center name en required!');
                return;
            }else if(cc_name_id == ''){
                alert('Cost center name id required!');
                return;
            }

              // alert(fileupload);
              let formData = new FormData();
                formData.append('cc_path', cc_path);
                formData.append('parent_code', parent_code);
                formData.append('cc_code', cc_code);
                formData.append('cc_name_en', cc_name_en);
                formData.append('cc_name_id', cc_name_id);
                formData.append('status', status);

               
              $.ajax({
                     type: 'POST',
                     url: "ajax_edit_cc.php",
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

       $(document).on('click', '#delete_cc', function(){
              var cc_code         = $('#cc_code').val();            
       

              // alert(fileupload);
              let formData = new FormData();
                formData.append('cc_code', cc_code);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_delete_cc.php",
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

<script>
$(document).ready(function() {
    $(document).on('change', '#cc_status', function(){
        var status      = $(this).attr('id1');
        // alert(status);
        if(status == '1'){
            $('#cc_status').attr('id1', '0');
        }else if(status == '0'){
            $('#cc_status').attr('id1', '1');
        }
    });
});
</script>
