<?php 
include "../../application/session/session.php";

// Query ambil data bank
$sql_bank       = mysqli_query($connect, "SELECT a.institution_code, a.institution_name FROM tgeminsurance a");
// Query ambil data bank


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-body">
              <!-- <form method="post" id="myform"> -->
            <fieldset id="fset_1">
            <div class="form-row">
                                          <div class="col-sm-4 name">Insurance Number *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="insurance_number" id="insurance_number" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
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
                                                        <option value="<?php echo $data_bank['institution_code'] ?>" ><?php echo $data_bank['institution_name'] ?></option>
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
                                                               name="branch_code" id="branch_code" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="branch_name" id="branch_name" type="Text" value=""
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
                                                               name="branch_account" id="branch_account" type="Text" value=""
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

                                                    <textarea class="textarea--style-6" id="branch_address" name="branch_address" placeholder="Branch Address"></textarea>        

                                                 </div>
                                          </div>
                                   </div>
                                   <!-- <div class="form-row">
                                          <div class="col-sm-4 name">Branch Company Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="branch_company_name" id="branch_company_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Register Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="register_name" id="register_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div> -->
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Branch Phone</div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="branch_phone" id="branch_phone" type="Text" value=""
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
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Company Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="company_name" id="company_name" type="Text" value=""
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

                                                    <textarea class="textarea--style-6" id="company_address" name="company_address" placeholder="Company Address"></textarea>        

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Company Phone</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="company_phone" id="company_phone" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
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
                                                    <input class="form-check-input" type="checkbox" value="" id1="0" id="insurance_default" >

                        
                                                 </div>
                                          </div>
                                   </div>
            </fieldset>

            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default" id="close"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" id="add_insurance"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '#add_insurance', function(){
       var insurance_number         = $('#insurance_number').val();
       var insurance_name           = $('#insurance_name').val();
       var insurance_date           = $('#insurance_date').val();
       var branch_code              = $('#branch_code').val();
       var branch_name              = $('#branch_name').val();
       var branch_account           = $('#branch_account').val();
       var branch_address           = $('#branch_address').val();
       // var branch_company_name      = $('#branch_company_name').val();
       // var register_name            = $('#register_name').val();
       var branch_phone             = $('#branch_phone').val();
       var company_name             = $('#company_name').val();
       var company_address          = $('#company_address').val();
       var company_phone            = $('#company_phone').val();
       var business_unit            = $('#business_unit').val();
       var insurance_default        = $('#insurance_default').attr('id1');

       // Validasi
       if(insurance_number == ''){
              alert('Insurance number cannot empty!');
              return;
       }else if(insurance_name == ''){
              alert('Insurance name cannot empty!');
              return;
       }else if(insurance_date == ''){
              alert('Insurance date cannot empty!');
              return;
       }else if(branch_code == ''){
              alert('Branch code cannot empty!');
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
              //   formData.append('branch_company_name', branch_company_name);
              //   formData.append('register_name', register_name);
                formData.append('branch_phone', branch_phone);
                formData.append('company_name', company_name);
                formData.append('company_address', company_address);
                formData.append('company_phone', company_phone);
                formData.append('business_unit', business_unit);
                formData.append('insurance_default', insurance_default);

       $.ajax({
                     type: 'POST',
                     url: "ajax_addinsurance.php",
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
            //   window.close();
            window.location.href = '../hrm{sys=org_setting_company}';   
	});

      
});
</script>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#insurance_date').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#modal_leave_end').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
              });
              </script>

<script>
// Get the modals
var modals = document.getElementById("mymodals");
var span = document.getElementsByClassName("closed")[0];
span.onclick = function() {
  modals.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modals) {
    modals.style.display = "none";
  }
}
</script>