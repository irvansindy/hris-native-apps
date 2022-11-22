<?php 
include "../../../application/session/session_ess.php";

$username = $_POST['id'];

$sql_letter_template = mysqli_query($connect, "SELECT 
a.template_code
FROM tsfmlettertemplate a");

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
                    <div class="col-3 name">Signed By *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id1=""
                                                               name="signed" id="signed" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Letter Template *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                        <select class="input--style-6" name="letter_template" id="letter_template" style="width: ;height: 30px;">
                                    <option value="">-- Select one --</option>
                                    <?php 
                                        while($letter_template  = mysqli_fetch_assoc($sql_letter_template)){
                                    ?>
                                        <option value="<?php echo $letter_template['template_code'] ?>"><?php echo $letter_template['template_code'] ?></option>
                                    <?php } ?>
                          
                                                    </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Reference Date *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                        <input type="text" id="refdate" class="input--style-6 refdate"
                                                                                    name="refdate" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " autocomplete="off" value=""/>
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
                                                                           
                                                                                                                                                        
                                                                             <button type="submit" id="add_letter" id1="<?php echo $username; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#refdate').bootstrapMaterialDatePicker({
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

                $( "#signed" ).autocomplete({
                    serviceUrl: "ajax/employee.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#signed" ).val("" + suggestion.value);
                        $( "#signed" ).attr('id1', suggestion.parent);
                    }
                });
            })
</script>