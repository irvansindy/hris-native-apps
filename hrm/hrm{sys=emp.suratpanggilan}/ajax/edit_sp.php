<?php 
include "../../../application/session/session_ess.php";

$rc             = $_POST['rc'];

$sql_edit_letter    = mysqli_query($connect, "SELECT
a.to_empno,
CONCAT(b.Full_Name, ' [', b.emp_no, ' ]') AS toempno,
a.noref,
a.tanggal,
a.waktu,
a.tempat,
a.masalah,
a.signee_by,
CONCAT(c.Full_Name, ' [', c.emp_no, ' ]') AS signeeby
FROM hrddisciplineshistory a 
LEFT JOIN view_employee b ON b.emp_no = a.to_empno
LEFT JOIN view_employee c ON c.emp_no = a.signee_by
WHERE a.noref = '$rc'");

$username = $_SESSION['username'];

$sql_get_worklocation = mysqli_query($connect, "SELECT 
a.worklocation_code
FROM view_employee a WHERE a.emp_no = '$username'");

$get_worklocation = mysqli_fetch_assoc($sql_get_worklocation);

// Validasi view_all
$sql_view_all = mysqli_query($connect, "SELECT 
a.view_all
FROM hrmconselor a 
LEFT JOIN view_employee b ON a.pos_code = b.pos_code
WHERE b.emp_no = '$username'");

$view_all = mysqli_fetch_assoc($sql_view_all);

if($view_all['view_all'] == '1'){
    $sql_consellor      = mysqli_query($connect, "SELECT 
    b.emp_no,
    b.Full_Name
    FROM hrmconselor a 
    LEFT JOIN view_employee b ON a.pos_code = b.pos_code
    WHERE a.`status` = '1'
    AND b.emp_no IS NOT NULL
    AND (b.end_date = '0000-00-00 00:00:00' OR b.end_date > CURDATE())");
}else{
    $sql_consellor      = mysqli_query($connect, "SELECT 
    b.emp_no,
    b.Full_Name
    FROM hrmconselor a 
    LEFT JOIN view_employee b ON a.pos_code = b.pos_code
    WHERE a.worklocation = '$get_worklocation[worklocation_code]'
    AND a.`status` = '1'
    AND b.emp_no IS NOT NULL
    AND (b.end_date = '0000-00-00 00:00:00' OR b.end_date > CURDATE())");
}

$data_edit_letter   = mysqli_fetch_assoc($sql_edit_letter);

$sql_penalty_type   = mysqli_query($connect, "SELECT 
a.penalty_id,
a.penalty_name
FROM hrmpenaltytype a ");

$sql_data_konseling = mysqli_query($connect, "SELECT
a.coounseling_date,
a.conselor,
a.penalty_type,
a.penalty_date,
a.`status`,
a.letter_no 
FROM hrmcouseling a
WHERE a.noref = '$rc'");

$data_konseling     = mysqli_fetch_assoc($sql_data_konseling);

// Validasi
$sql_validasi_konseling = mysqli_query($connect, "SELECT 
a.letter_no
FROM hrmcouseling a WHERE a.noref = '$rc'");

$validasi           = mysqli_num_rows($sql_validasi_konseling);

if($validasi > 0){

if($data_konseling['coounseling_date'] == '0000-00-00 00:00:00'){
    $konseling_date = '';
}else{
    $konseling_date = $data_konseling['coounseling_date'];
}

if($data_konseling['penalty_date'] == '0000-00-00 00:00:00'){
    $penalty_date = '';
}else{
    $penalty_date = $data_konseling['penalty_date'];
}

}

$waktu_start = substr($data_edit_letter['waktu'], 0, 5);
$waktu_end   = substr($data_edit_letter['waktu'], 6, 5);

?>

<style>
            
            
            input[type=text] {
                
            }
            input[type=text]:focus {
                border: 2px solid #757575;
            	outline: none;
            }
            .autocomplete-suggestions {
                border: 1px solid #999;
                background: #FFF;
                overflow: auto;
            }
            .autocomplete-suggestion {
                padding: 2px 5px;
                white-space: nowrap;
                overflow: hidden;
            }
            .autocomplete-selected {
                background: #F0F0F0;
            }
            .autocomplete-suggestions strong {
                font-weight: normal;
                color: #3399FF;
            }
            .autocomplete-group {
                padding: 2px 5px;
            }
            .autocomplete-group strong {
                display: block;
                border-bottom: 1px solid #000;
            }
        </style>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<script src="vendor/jquery.autocomplete.min.js"></script>

<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->            
            <fieldset id="fset_1">
                <legend>ENTRY ADDITIONAL DATA</legend>
                    <div class="form-row">
                        <div class="col-3 name">To *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" id1="<?php echo $data_edit_letter['to_empno'] ?>"
                                                                name="letter_to" id="letter_to" type="Text" value="<?php echo $data_edit_letter['toempno']; ?>"
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Tanggal *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input type="text" id="letter_tanggal" class="input--style-6 letter_tanggal"
                                                                                    name="letter_tanggal" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    "
                                                                                    value="<?php echo $data_edit_letter['tanggal'] ;?>"
                                                                                    autocomplete="off"/>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Waktu *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="form-row" style="padding-left:0px; padding-bottom:0px">
                                <div class="col-sm-5">
                                    <div class="input-group">
                                    <input type="text" id="letter_waktu_start" class="input--style-6 letter_waktu_start"
                                                                                    name="letter_waktu_start" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    "
                                                                                    value="<?php echo $waktu_start;?>"
                                                                                    autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-sm-2" style="text-align:center">
                                    To
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                    <input type="text" id="letter_waktu_end" class="input--style-6 letter_waktu_end"
                                                                                    name="letter_waktu_end" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    "
                                                                                    value="<?php echo $waktu_end;?>"
                                                                                    autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Tempat *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="letter_tempat" id="letter_tempat" type="Text" value="<?php echo $data_edit_letter['tempat']; ?>"
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="" disabled>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Masalah *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <textarea class="textarea--style-6" id="letter_masalah" name="letter_masalah" placeholder=""><?php echo $data_edit_letter['masalah']; ?></textarea>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Signee By *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" id1="<?php echo $data_edit_letter['signee_by']; ?>"
                                                                name="letter_signee" id="letter_signee" type="Text" value="<?php echo $data_edit_letter['signeeby']; ?>"
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="" disabled>
                            </div>
                            
                        </div>
                    </div>
</fieldset>
<fieldset id="fset_1">
                <legend>ENTRY CONSELING DATA</legend>
                <?php 
                    if($validasi > 0){
                ?>
                    <div class="form-row">
                        <div class="col-3 name">Tanggal Konseling *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input type="text" id="konseling_tanggal" class="input--style-6 konseling_tanggal"
                                                                                    name="konseling_tanggal" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " autocomplete="off" value="<?php echo $konseling_date; ?>"/>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Konselor *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <select class="input--style-6" name="konseling_conselor" id="konseling_conselor" style="width: ;height: 30px;">
                                    <option value="0">-- Select one --</option>
                                    <?php 
                                        while($data_js  = mysqli_fetch_assoc($sql_consellor)){
                                    ?>
                                        <option value="<?php echo $data_js['emp_no'] ?>" <?php if($data_konseling['conselor'] == $data_js['emp_no']){ echo 'selected';} ?>><?php echo $data_js['Full_Name'] ?></option>
                                    <?php } ?>
                          
                                                    </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Tipe Sanksi *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <select class="input--style-6" name="konseling_penaltytype" id="konseling_penaltytype" style="width: ;height: 30px;">
                                    <option value="0">-- Select one --</option>
                                    <?php 
                                        while($data_pt  = mysqli_fetch_assoc($sql_penalty_type)){
                                    ?>
                                        <option value="<?php echo $data_pt['penalty_id'] ?>" <?php if($data_konseling['penalty_type'] == $data_pt['penalty_id']){ echo 'selected';} ?>><?php echo $data_pt['penalty_name'] ?></option>
                                    <?php } ?>
                          
                                                    </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Tanggal Sanksi *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input type="text" id="konseling_penaltydate" class="input--style-6 konseling_penaltydate"
                                                                                    name="sanksi_tanggal" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " value="<?php echo $penalty_date; ?>"
                                                                                    autocomplete="off"/>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Status *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <select class="input--style-6" name="konseling_status" id="konseling_status" style="width: ;height: 30px;">
                                    <option value="">-- Select one --</option>
                                    <option value="0" <?php if($data_konseling['status'] == '0'){ echo 'selected';} ?>>Open</option>
                                    <option value="1" <?php if($data_konseling['status'] == '1'){ echo 'selected';} ?>>Closed</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="col-3 name">No Surat *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="konseling_letterno" id="konseling_letterno" type="Text" value="<?php echo $data_konseling['letter_no'] ?>"
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="" disabled>
                            </div>
                            
                        </div>
                    </div> -->
                    <?php }else{ ?>

                        <div class="form-row">
                        <div class="col-3 name">Tanggal Konseling *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input type="text" id="konseling_tanggal" class="input--style-6 konseling_tanggal"
                                                                                    name="konseling_tanggal" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " autocomplete="off" value=""/>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Konselor *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <select class="input--style-6" name="konseling_conselor" id="konseling_conselor" style="width: ;height: 30px;">
                                    <option value="0">-- Select one --</option>
                                    <?php 
                                        while($data_js  = mysqli_fetch_assoc($sql_consellor)){
                                    ?>
                                        <option value="<?php echo $data_js['emp_no'] ?>"><?php echo $data_js['Full_Name'] ?></option>
                                    <?php } ?>
                          
                                                    </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Tipe Sanksi *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <select class="input--style-6" name="konseling_penaltytype" id="konseling_penaltytype" style="width: ;height: 30px;">
                                    <option value="0">-- Select one --</option>
                                    <?php 
                                        while($data_pt  = mysqli_fetch_assoc($sql_penalty_type)){
                                    ?>
                                        <option value="<?php echo $data_pt['penalty_id'] ?>"><?php echo $data_pt['penalty_name'] ?></option>
                                    <?php } ?>
                          
                                                    </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Tanggal Sanksi *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input type="text" id="konseling_penaltydate" class="input--style-6 konseling_penaltydate"
                                                                                    name="konseling_penaltydate" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " value=""
                                                                                    autocomplete="off"/>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Status *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <select class="input--style-6" name="konseling_status" id="konseling_status" style="width: ;height: 30px;">
                                    <option value="">-- Select one --</option>
                                    <option value="0">Open</option>
                                    <option value="1">Closed</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="col-3 name">No Surat *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="konseling_letterno" id="konseling_letterno" type="Text" value=""
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="" disabled>
                            </div>
                            
                        </div>
                    </div> -->

                    <?php } ?>
                   
</fieldset>
</div>

            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                                    <button type="submit" id="delete_letter" id1="<?php echo $rc; ?>"
                                                                                    class="btn btn-danger btn-sm submit">Delete</button>
                                                                             
                                                                             <button type="submit" id="letter_submit" id1="<?php echo $rc; ?>" id2="<?php echo $validasi; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#konseling_tanggal').bootstrapMaterialDatePicker({
                            date: true,
                            time: false,
                            clearButton: true,
                            format: 'YYYY-MM-DD'
                     });

                     $('#konseling_penaltydate').bootstrapMaterialDatePicker({
                            date: true,
                            time: false,
                            clearButton: true,
                            format: 'YYYY-MM-DD'
                     });

                     $('#modal_leave_end').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: true,
                            time: true,
                            format: 'HH:mm:ss'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
              });
</script>

<script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#letter_to" ).autocomplete({
                    serviceUrl: "ajax/employee.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#letter_to" ).val("" + suggestion.value);
                        $( "#letter_to" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script>

<script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#letter_signee" ).autocomplete({
                    serviceUrl: "ajax/employee.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#letter_signee" ).val("" + suggestion.value);
                        $( "#letter_signee" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#letter_tanggal').bootstrapMaterialDatePicker({
                            date: true,
                            time: false,
                            clearButton: true,
                            format: 'YYYY-MM-DD',
                            locale:'id'
                     });

                     $('#meeting_time_end').bootstrapMaterialDatePicker({
                            date: true,
                            time: true,
                            clearButton: true,
                            format: 'YYYY-MM-DD HH:mm'
                     });

                     $('#modal_leave_end').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#letter_waktu_start').bootstrapMaterialDatePicker({
                            date: false,
                            time: true,
                            clearButton: true,
                            format: 'HH:mm',
                            locale:'id'
                     });

                     $('#letter_waktu_end').bootstrapMaterialDatePicker({
                            date: false,
                            time: true,
                            clearButton: true,
                            format: 'HH:mm',
                            locale:'id'
                     });
              });
</script>