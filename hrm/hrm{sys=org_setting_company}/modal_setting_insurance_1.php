<?php
include "../../application/session/session.php";

$id     = $_POST['id'];

// Query ambil data insurance
$sql_bank       = mysqli_query($connect, "SELECT a.institution_code, a.institution_name FROM tgeminsurance a");
// Query ambil data bank

// Query untuk ambil data
$sql_data       = mysqli_query($connect, "SELECT * FROM teorcompinsurance a WHERE a.register_no = '$id'");

$data           = mysqli_fetch_assoc($sql_data);
// Query untuk ambil data

?>

<div class="modal-body">
              <!-- <form method="post" id="myform"> -->
            <fieldset id="fset_1">

                <div class="form-row">
                                          <div class="col-sm-4 name">Insurance Number *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="insurance_number" id="insurance_number" type="Text" value="<?php echo $data['register_no'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                </div>

                <div class="form-row">
                                          <div class="col-sm-4 name">Insurance Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="insurance_name" id="insurance_name" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>
                                                        <?php 
                                                            while($data_bank = mysqli_fetch_assoc($sql_bank)){
                                                        ?>
                                                        <option value="<?php echo $data_bank['institution_code'] ?>" <?php if($data['institution_code'] == $data_bank['institution_code']){ echo 'selected';} ?> ><?php echo $data_bank['institution_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Insurance Date *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <input type="text" id="insurance_date" class="input--style-6"
                                                        name="insurance_date" style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      "
                                                                      value="<?php echo $data['register_date'] ?>"
                                                                      autocomplete="off"/>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Code *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="branch_code" id="branch_code" type="Text" value="<?php echo $data['branch_code'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="branch_name" id="branch_name" type="Text" value="<?php echo $data['branch_name'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Account *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="branch_account" id="branch_account" type="Text" value="<?php echo $data['branch_account'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Address</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <textarea class="textarea--style-6" id="branch_address" name="branch_address" placeholder="Branch Address"><?php echo $data['branch_address'] ?></textarea>        

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Phone</div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="branch_phone" id="branch_phone" type="Text" value="<?php echo $data['branch_phone'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                          <div class="col-sm-4">
                                          <div class="input-group">

                                                        <p>Use comma (,) for multiple entries</p>
                                                 </div>
                                          </div>
                                        <!-- </div> -->
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Company Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="company_name" id="company_name" type="Text" value="<?php echo $data['branchcompany_name'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Company Address</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <textarea class="textarea--style-6" id="insurance_address" name="insurance_address" placeholder="Insurance Address"><?php echo $data['insurance_address'] ?></textarea>        

                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Company Phone</div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="insurance_phone" id="insurance_phone" type="Text" value="<?php echo $data['insurance_phone'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                          <div class="col-sm-4">
                                          <div class="input-group">

                                                        <p>Use comma (,) for multiple entries</p>
                                                 </div>
                                          </div>
                                        <!-- </div> -->
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Business Unit</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="business_unit" id="business_unit" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Default</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                    <input class="form-check-input" type="checkbox" value="" id1="0" id="insurance_default" <?php if($data['default_insurance'] == '1'){ echo 'checked';} ?> >

                        
                                                 </div>
                                          </div>
                                   </div>


            </fieldset>

            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button" id="close"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" id="delete_insurance"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="edit_insurance"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>


<script>
$(document).ready(function() {
    $(document).on('click', '#edit_insurance', function(){
       var insurance_number         = $('#insurance_number').val();
       var insurance_name           = $('#insurance_name').val();
       var insurance_date           = $('#insurance_date').val();
       var branch_code              = $('#branch_code').val();
       var branch_name              = $('#branch_name').val();
       var branch_account           = $('#branch_account').val();
       var branch_address           = $('#branch_address').val();
       var branch_phone             = $('#branch_phone').val();
       var company_name             = $('#company_name').val();
       var insurance_address        = $('#insurance_address').val();
       var insurance_phone          = $('#insurance_phone').val();
       var business_unit            = $('#business_unit').val();
       var insurance_default        = $('#insurance_default').attr('id1');

       // Validasi
       if(insurance_name == ''){
              alert('Insurance name cannot empty!');
              return;
       }else if(insurance_date == ''){
              alert('Insurance date cannot empty!');
              return;
       }else if(branch_name == ''){
              alert('Branch name cannot empty!');
              return;
       }else if(branch_account == ''){
              alert('Branch account cannot empty!');
              return;
       }
       // Validasi


       let formData = new FormData();
                formData.append('insurance_number', insurance_number);
                formData.append('insurance_name', insurance_name);
                formData.append('insurance_date', insurance_date);
                formData.append('branch_code', branch_code);
                formData.append('branch_name', branch_name);
                formData.append('branch_account', branch_account);
                formData.append('branch_address', branch_address);
                formData.append('branch_phone', branch_phone);
                formData.append('company_name', company_name);
                formData.append('insurance_address', insurance_address);
                formData.append('insurance_phone', insurance_phone);
                formData.append('business_unit', business_unit);
                formData.append('insurance_default', insurance_default);

       $.ajax({
                     type: 'POST',
                     url: "ajax_editinsurance.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                    //    window.close();
                    window.location.href = '../hrm{sys=org_setting_company}';
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	});

    });

    $(document).on('click', '#delete_insurance', function(){

       var insurance_number     = $('#insurance_number').val();

       let formData = new FormData();
                formData.append('insurance_number', insurance_number);

       $.ajax({
                     type: 'POST',
                     url: "ajax_deleteinsurance.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                    //    window.close();
                    window.location.href = '../hrm{sys=org_setting_company}';
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	});

    });


       $(document).on('change', '#insurance_default', function(){
              var c   = $('#insurance_default').attr('id1');
              // alert(c);
              if(c == '1'){
                     $('#insurance_default').attr('id1', '0');
              }else if(c == '0'){
                     $('#insurance_default').attr('id1', '1');  
              }
       });

       $(document).on('click', '#close', function(){
              window.close();
	});

    

      
});
</script>