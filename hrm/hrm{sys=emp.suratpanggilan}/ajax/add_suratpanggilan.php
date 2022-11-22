<?php 
include "../../../application/session/session_ess.php";

$username = $_SESSION['username'];

$sql_get_worklocation = mysqli_query($connect, "SELECT 
a.worklocation_code
FROM view_employee a WHERE a.emp_no = '$username'");

$get_worklocation = mysqli_fetch_assoc($sql_get_worklocation);

// $sql_consellor      = mysqli_query($connect, "SELECT 
// b.emp_no,
// b.Full_Name
// FROM hrmconselor a 
// LEFT JOIN view_employee b ON a.pos_code = b.pos_code
// WHERE a.worklocation = '$get_worklocation[worklocation_code]'
// AND a.`status` = '1'
// AND b.emp_no IS NOT NULL
// AND (b.end_date = '0000-00-00 00:00:00' OR b.end_date > CURDATE())");

$sql_penalty_type   = mysqli_query($connect, "SELECT 
a.penalty_id,
a.penalty_name
FROM hrmpenaltytype a ");

$sql_signedby = mysqli_query($connect, "SELECT 
b.pos_code,
b.Full_Name,
b.emp_no,
CONCAT(b.Full_Name, ' [', b.emp_no,']') AS nama_tampil
FROM hrdsignedby a
LEFT JOIN view_employee b ON a.poscode = b.pos_code
WHERE a.worklocation LIKE '%$get_worklocation[worklocation_code]%'");

$data_signedby = mysqli_fetch_assoc($sql_signedby);

$sql_location = mysqli_query($connect, "SELECT 
a.location 
FROM hrmconselinglocation a
WHERE a.worklocation LIKE '%$get_worklocation[worklocation_code]%'");

$data_location = mysqli_fetch_assoc($sql_location);
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
                                                                autocomplete="off" autofocus="on" id1=""
                                                                name="add_letter_to" id="add_letter_to" type="Text" value=""
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                            </div>
                            
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="col-3 name">Hari *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="add_letter_hari" id="add_letter_hari" type="Text" value=""
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                            </div>
                            
                        </div>
                    </div> -->
                    <div class="form-row">
                        <div class="col-3 name">Tanggal *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input type="text" id="add_letter_tanggal" class="input--style-6 add_letter_tanggal"
                                                                                    name="add_letter_tanggal" style="
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
                        <div class="col-3 name">Waktu *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="form-row" style="padding-left:0px; padding-bottom:0px">
                                <div class="col-sm-5">
                                    <div class="input-group">
                                    <input type="text" id="add_letter_waktu_start" class="input--style-6 add_letter_waktu_start"
                                                                                    name="add_letter_waktu_start" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    "
                                                                                    autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-sm-2" style="text-align:center">
                                    To
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                    <input type="text" id="add_letter_waktu_end" class="input--style-6 add_letter_waktu_end"
                                                                                    name="add_letter_waktu_end" style="
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
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Tempat *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="add_letter_tempat" id="add_letter_tempat" type="Text" value="<?php echo $data_location['location']; ?>"
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
                                <textarea class="textarea--style-6" id="add_letter_masalah" name="add_letter_masalah" placeholder=""></textarea>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-3 name">Signee By *</div>
                        <div class="col-sm-9" style="padding-left:20px">
                            <div class="input-group">
                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" id1="<?php echo $data_signedby['emp_no'] ?>"
                                                                name="add_letter_signee" id="add_letter_signee" type="Text" value="<?php echo $data_signedby['nama_tampil'] ?>"
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="" disabled>
                            </div>
                            
                        </div>
                    </div>
</fieldset>
<div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                           
                                                                             
                                                                             <button type="submit" id="add_letter_submit"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#add_letter_to" ).autocomplete({
                    serviceUrl: "ajax/employee.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#add_letter_to" ).val("" + suggestion.value);
                        $( "#add_letter_to" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script>

<!-- <script type="text/javascript">
            $(document).ready(function() {
                // var id      = $('#save_otorisasi').val();
                // Selector input yang akan menampilkan autocomplete.
                $( "#add_letter_signee" ).autocomplete({
                    serviceUrl: "ajax/signee.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#add_letter_signee" ).val("" + suggestion.value);
                        $( "#add_letter_signee" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script> -->

<script type="text/javascript">
              $(document).ready(function() {
                     $('#add_letter_tanggal').bootstrapMaterialDatePicker({
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

                     $('#add_letter_waktu_start').bootstrapMaterialDatePicker({
                            date: false,
                            time: true,
                            clearButton: true,
                            format: 'HH:mm',
                            locale:'id'
                     });

                     $('#add_letter_waktu_end').bootstrapMaterialDatePicker({
                            date: false,
                            time: true,
                            clearButton: true,
                            format: 'HH:mm',
                            locale:'id'
                     });
              });
</script>