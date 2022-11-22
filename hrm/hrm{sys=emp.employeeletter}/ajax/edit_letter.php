<?php 
include "../../../application/session/session_ess.php";
$letter_no = $_POST['nc'];

$sql_letter = mysqli_query($connect, "SELECT 
CONCAT(b.Full_Name, ' [', b.emp_no,']') AS reciever,
c.emp_id,
CONCAT(c.Full_Name, ' [', c.emp_no,']') AS signee,
a.template_code,
a.letter_no,
a.letter_date
FROM tclmletterdocument a 
LEFT JOIN view_employee b ON b.emp_id = a.letter_receiver
LEFT JOIN view_employee c ON c.emp_id = a.letter_signee
WHERE a.letter_no = '$letter_no'");

$letter = mysqli_fetch_assoc($sql_letter);

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
                <div class="form-row">
                    <div class="col-3 name">Receiver</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $letter['reciever']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Signed By *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id1="<?php echo $letter['emp_id']; ?>"
                                                               name="signed_edit" id="signed_edit" type="Text" value="<?php echo $letter['signee']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Letter Template</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $letter['template_code']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Letter Number</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $letter['letter_no']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Reference Date</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                        <input type="text" id="refdate_edit" class="input--style-6 refdate_edit"
                                                                                    name="refdate_edit" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " autocomplete="off" value="<?php echo $letter['letter_date']; ?>"/>
                        </div>
                        
                    </div>
                </div>
                
                <!-- <a href='#' id1='' id2='' class='' data-toggle='modal' id='' data-target='#modal-view-od-1'><img src='../../asset/img/icons/glasses.png'></a> -->
                
            </fieldset>


            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                           
                                                                                    <button type="button" id1="<?php echo $letter_no; ?>"
                                                                                    class="btn btn-danger btn-sm" id="delete_letter"
                                                                                    >Delete</button>                                                                   
                                                                             <button type="submit" id="edit_letter" id1="<?php echo $letter_no; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#refdate_edit').bootstrapMaterialDatePicker({
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

                $( "#signed_edit" ).autocomplete({
                    serviceUrl: "ajax/employee.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#signed_edit" ).val("" + suggestion.value);
                        $( "#signed_edit" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script>