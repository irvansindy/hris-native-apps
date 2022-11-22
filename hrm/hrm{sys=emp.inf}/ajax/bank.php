<?php 
include "../../../application/session/session_ess.php";
$username = $_POST['id'];

$sql_data_bank = mysqli_query($connect, "SELECT 
b.bank_code,
b.bank_account,
b.account_name
FROM view_employee a
LEFT JOIN mgtools_tpydempbank b ON b.emp_id = a.emp_id
WHERE a.emp_no = '$username'");

$data = mysqli_fetch_assoc($sql_data_bank);

?>

<fieldset id="fset_1">
    <legend>Bank Infromation</legend>    
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Bank Name :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['bank_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Account Number :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['bank_account']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Account Name :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['account_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</fieldset>