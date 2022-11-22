<?php 
include "../../application/session/session.php";

// Query ambil data bank
$sql_bank       = mysqli_query($connect, "SELECT a.bank_code, a.bank_name, a.bankgroup_code FROM tpymbank a");
// Query ambil data bank


?>


<div class="modal-body">
              <!-- <form method="post" id="myform"> -->
            <fieldset id="fset_1">
            <div class="form-row">
                                          <div class="col-sm-4 name">Bank Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="bank_name" id="bank_name" style="width: ;height: 30px;">
                                                        <option value="0">-- Select one --</option>
                                                        <?php 
                                                            while($data_bank = mysqli_fetch_assoc($sql_bank)){
                                                        ?>
                                                        <option value="<?php echo $data_bank['bank_code'] ?>" ><?php echo $data_bank['bank_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Bank Account *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="bank_account" id="bank_account" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Account Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                                
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                                name="account_name" id="account_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-sm-4 name">Alias *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="alias" id="alias" type="Text" value=""
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

                                                 <input class="form-check-input" type="checkbox" value="" id1="0" id="bank_default" >

                                                 </div>
                                          </div>
                                   </div>   
            </fieldset>

            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default" id="close"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit" id="add_bank"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>


<script>
$(document).ready(function() {
    $(document).on('click', '#add_bank', function(){
       var bank_name        = $('#bank_name').val();
       var bank_account     = $('#bank_account').val();
       var account_name     = $('#account_name').val();
       var alias            = $('#alias').val();
       var bank_default     = $('#bank_default').attr('id1');

       var number           = /^[0-9]+$/;


       // Validasi
       if(bank_name == ''){
              alert('Bank name cannot empty!');
              return;
       }else if(bank_account == ''){
              alert('Bank account cannot empty!');
              return;
       }else if(!bank_account.match(number)){
              alert('Bank account must number!');
              return;
       }else if(account_name == ''){
              alert('Bank account name cannot empty!');
              return;
       }else if(alias == ''){
              alert('Bank alias cannot empty!');
              return;
       }
       // Validasi

       let formData = new FormData();
                formData.append('bank_name', bank_name);
                formData.append('bank_account', bank_account);
                formData.append('account_name', account_name);
                formData.append('alias', alias);
                formData.append('bank_default', bank_default);

       $.ajax({
                     type: 'POST',
                     url: "ajax_addbank.php",
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


       $(document).on('change', '#bank_default', function(){
              var c   = $('#bank_default').attr('id1');
              // alert(c);
              if(c == '1'){
                     $('#bank_default').attr('id1', '0');
              }else if(c == '0'){
                     $('#bank_default').attr('id1', '1');  
              }
       });

       $(document).on('click', '#close', function(){
            //   window.close();
            window.location.href = '../hrm{sys=org_setting_company}';
	});

      
});
</script>   