<?php include "../../application/session/session.php";?>

       <!-- <link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" /> -->
       <link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
       <script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
       <script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>










                     <script> 
                            $(document).ready(function(){
                            $('#modal_leave').on('blur', function() {

                                   var inp_leavedaytype        = document.getElementById("inp_leavedaytype").value;
                                
                                   if (inp_leavedaytype == 'HD')
                                   {  
                                          $("#HD").show();  
                            
                                          $("#inp_hdtype_starttime_full_day").show();
                                          $("#inp_starttime").hide(); 
                                          $("#inp_endtime").hide(); 
                                          
                                          $(document).ready(function(){
                                                 $("#hide").click(function(){
                                                        $("#inp_hdtype_starttime").show();
                                                        $("#inp_hdtype_starttime_full_day").hide();
                                                 
                                                        document.getElementById("inp_hdtype_starttime").setAttribute("name","inp_hdtype_starttime");
                                                        document.getElementById("inp_hdtype_starttime_full_day").setAttribute("name","hidden");
                                                        
                                                        $("#show").show();
                                                        $("#hide").hide();
                                                 });
                                                 $("#show").click(function(){
                                                        $("#inp_hdtype_starttime").hide();
                                                        $("#inp_hdtype_starttime_full_day").show();
                                                        
                                                        document.getElementById("inp_hdtype_starttime").setAttribute("name","hidden");
                                                        document.getElementById("inp_hdtype_starttime_full_day").setAttribute("name","inp_hdtype_starttime");

                                                        $("#show").hide();
                                                        $("#hide").show();
                                                 });

                                          
                                          });

                                   } else if (inp_leavedaytype == 'PD')
                                   {  
                                          $("#HD").hide(); 
                                          $("#inp_hdtype_starttime").hide();
                                          $("#inp_hdtype_starttime_full_day").hide();        
                                          $("#inp_starttime").show(); 
                                          $("#inp_endtime").show();                                          
                                   } else 
                                   {  
                                          $("#HD").hide(); 
                                          $("#inp_hdtype_starttime").hide();
                                          $("#inp_hdtype_starttime_full_day").hide();        
                                          $("#inp_starttime").hide(); 
                                          $("#inp_endtime").hide();                                          
                                   }
                                   

                                   });
                            });

                            //CEK APAKAH URGENT ATAU TIDAK
                            //CEK APAKAH URGENT ATAU TIDAK
                            $(document).ready(function(){
                                                 $("#inp_urgent_on").click(function(){
                                                        var inp_urgent_on      = document.getElementById("inp_urgent_on").value;
                                                        if (inp_urgent_on      == '1')
                                                               {
                                                                      $("#tr_inp_urgent_on").hide();
                                                                      $("#tr_inp_urgent_off").show();
                                                                      $("#tr_inp_urgent_reason").show();
                                                                      $('#inp_urgent_on').prop('checked', false); 
                                                                      document.getElementById("inp_urgent_on_back").setAttribute("name","hidden");

                                                                      
                                                               }
                                                 });
                                          });
                            $(document).ready(function(){
                                                 $("#inp_urgent_off").click(function(){
                                                        var inp_urgent_off     = document.getElementById("inp_urgent_off").value;
                                                        if (inp_urgent_off     == '0')
                                                               {
                                                                      $("#tr_inp_urgent_on").show();
                                                                      $("#tr_inp_urgent_off").hide();
                                                                      $("#tr_inp_urgent_reason").hide();
                                                                      $('#inp_urgent_off').prop('checked', true);
                                                                      document.getElementById("inp_urgent_on_back").setAttribute("name","inp_urgent_decl"); 
                                                               }
                                                 });
                                          });
                            //CEK APAKAH URGENT ATAU TIDAK
                            //CEK APAKAH URGENT ATAU TIDAK 
                            
                            $(document).ready(function(){
                            $('#modal_leave_start, #modal_leave_end, #button-2').on('change', function() {
                                   var modal_leave_starts      = document.getElementById("modal_leave_start").value;
                                   var modal_leave_ends        = document.getElementById("modal_leave_end").value;

                                   var inp_leavedaytype        = document.getElementById("inp_leavedaytype").value;
                                   var modal_leave             = document.getElementById("modal_leave").value;

                                   var from                    = new Date(modal_leave_starts).getTime();
                                   var to                      = new Date(modal_leave_ends).getTime();
                                
                                   if (from < to && inp_leavedaytype == 'HD')
                                   {
                                          $("#inp_hdtype_starttime_con2").show();
                                          $("#inp_hdtype_starttime2").show();

                                          $("#inp_hdtype_starttime_full_day").hide();
                                          $("#inp_hdtype_starttime").hide();

                                          $("#show").hide();

                                          document.getElementById("inp_hdtype_starttime2_declare").setAttribute("name","hidden");
                                          document.getElementById("inp_hdtype_starttime").setAttribute("name","hidden");
                                          document.getElementById("inp_hdtype_starttime_full_day").setAttribute("name","hidden");

                                   } else if (from == to && inp_leavedaytype == 'HD') {
                                          // $("#inp_hdtype_starttime2").show();
                                          // $("#inp_hdtype_starttime_con2").show();

                                          $("#inp_hdtype_starttime_con2").hide();
                                          $("#inp_hdtype_starttime2").hide();
                                          
                                          $("#inp_hdtype_starttime_full_day").show();
                                          $("#inp_hdtype_starttime2_declare").show();    

                                          $("#show").show();                
                                          
                                          document.getElementById("inp_hdtype_starttime_con2").setAttribute("name","hidden");
                                          document.getElementById("inp_hdtype_starttime").setAttribute("name","hidden");

                                   } else if (inp_leavedaytype == 'PD') {
                                          // $("#inp_hdtype_starttime2").show();
                                          // $("#inp_hdtype_starttime_con2").show();

                                          $("#inp_hdtype_starttime_con2").hide();
                                          $("#inp_hdtype_starttime2").hide();
                                          
                                          $("#inp_hdtype_starttime_full_day").hide();
                                          $("#inp_hdtype_starttime2_declare").hide();    

                                          $("#show").show();                
                                          
                                          document.getElementById("inp_hdtype_starttime_con2").setAttribute("name","hidden");
                                          document.getElementById("inp_hdtype_starttime").setAttribute("name","hidden");
                                   } else if (from > to)
                                   {
                                          $("#inp_hdtype_starttime_con2").hide();
                                          $("#inp_hdtype_starttime2").hide();

                                          $("#inp_hdtype_starttime_full_day").hide();
                                          $("#inp_hdtype_starttime").hide();

                                          $("#show").hide();

                                          document.getElementById("inp_hdtype_starttime2_declare").setAttribute("name","hidden");
                                          document.getElementById("inp_hdtype_starttime").setAttribute("name","hidden");
                                          document.getElementById("inp_hdtype_starttime_full_day").setAttribute("name","hidden");

                                   }
                                   });
                                   
                            });
                     </script>
                     <!-- stop list select -->

















<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header" >
                     <h4 class="modal-title">Add Leave Request</h4>
                     <button type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" 
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data" onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                                   <legend>Leave Entry Form</legend>



                        
                            <!-- <div class="form-row">
                                   <div class="col-4 name">Employee no*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>    
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Employee Name*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>    
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Type of Leave*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>    
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Balance*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>    
                            </div>
                        
                        
                            <div class="form-row">
                                   <div class="col-4 name">Date of Leave*</div>
                                   <div class="col-sm-3">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>    
                                   <div class="col-sm-2 name">Start Date</div>
                                   <div class="col-sm-3">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">To</div>
                                   <div class="col-sm-3">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>    
                                   <div class="col-sm-2 name">Start Date</div>
                                   <div class="col-sm-3">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Remark*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                          <textarea class="textarea--style-6" name="message" placeholder="Message sent to the employer"></textarea>
                                          </div>
                                   </div>    
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Urgent? </div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6" type="email" name="email" placeholder="">
                                          </div>
                                   </div>    
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">File Attachment </div>
                                   <div class="col-sm-8">
                                          <div class="input-group js-input-file">
                                          <input class="input-file" type="file" name="file_cv" id="file">
                                          <label class="label--file" for="file">Choose file</label>
                                          <span class="input-file__info">No file chosen</span>
                                   </div>
                                   <div class="label--desc">Upload your Effident or any other relevant file. Max file size 50 MB, doc,jpg,ods,png,txt,doc,pdf </div>
                                   </div>    
                            </div> -->
                            




                                   <table style="width: 95%;">
                                          <tbody>
                                                 <tr>
                                                        <td width="40%"><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Emp No <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1">
                                                               <!-- <input type="text" onkeyup="isi_otomatis()" autofocus="on" class="form-control input-report" id="modal_emp" name="modal_emp" placeholder="Nip" autocomplete="off"> -->
                                                               <input class="form-control" style="margin-bottom: 2px;"
                                                                      onkeyup="isi_otomatis(), isi_otomatis_leave()"
                                                                      autocomplete="off"
                                                                      autofocus="on" id="modal_emp" name="modal_emp"
                                                                      type="Text" value="<?php echo $username; ?>" onfocus="hlentry(this)"
                                                                      size="30" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="">
                                                        </td>
                                                 </tr>
                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Name*</label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px;background-color: #fff3b4;"
                                                                      id="inp_nickname" name="inp_nickname" type="Text"
                                                                      value="<?php echo $nama; ?>" onfocus="hlentry(this)" size="20"
                                                                      maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="" readonly>
                                                        </td>
                                                 </tr>
                                                 <tr id="tr_inp_user_status" class="clTR1">
                                                        <td><label id="lbl_inp_user_status" for="inp_user_status"
                                                                      title="">Type of Leave <span
                                                                             class="required">*</span></label></td>
                                                        <td colspan="3" class="" id="tdb_1">
                                                        

                                                        <select 
                                                               name="modal_leave" 
                                                               style="margin-bottom: 2px; width: 50%;" 
                                                               id="modal_leave" 
                                                               onchange="isi_otomatis_leave()" class="modal_leave form-control">
                                                               <option value="0">--Select One--</option>
                                                               <?php
                                                               $sql = mysqli_query($connect,"select * from ttamleavetype");
                                                               while($row=mysqli_fetch_array($sql))
                                                               {
                                                               echo '<option value="'.$row['leave_code'].'">'.$row['leavename_en'].'</option>';
                                                               } 
                                                               ?>
                                                        </select>
                                                        
                                      
                                                        </td>
                                                 </tr>


                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Balance<span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><input class="form-control"
                                                                      style="margin-bottom: 2px;background-color: #fff3b4;"
                                                                      id="inp_leavebalance" name="inp_leavebalance"
                                                                      type="Text" value="" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title="" readonly>
                                                        </td>
                                                 </tr>

                                                 <input id="inp_leavedaytype" name="inp_leavedaytype" type="hidden" value="">






                                                 
                                                 
                                                 
                            
                                                




























                                               

<!-- /**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */ -->
                                                 <tr class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Date of Leave<span
                                                                             class="required">*</span></label>
                                                        </td>

                                                        
                                                        <!-- <td nowrap='nowrap' width="20%"><input class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="modal_leave_start" name="modal_leave_start"
                                                                      type="date" value="" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></td> -->

                                                        <td nowrap='nowrap' width="20%">
                                                        <input type="text" id="modal_leave_start" name="modal_leave_start" style="height: 25px;
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat;   
                                                                      padding-left:17px;
                                                                      padding: 1px;
                                                                      padding-left: 1px;
                                                                      padding-left: 6px;
                                                                      font-size: 12px;
                                                                      line-height: 1.42857143;
                                                                      color: #555;
                                                                      background-color: rgb(249, 249, 249);
                                                                      
                                                                      border: 1px solid #ccc;
                                                                      border-radius: 0px;
                                                                      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                                                                      box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                                                                      -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                                                                      -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                                      transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;" />

                                                              
                                                        </td>

                                                                     
                                                                      <td nowrap='nowrap' >
                                                                             <select class="form-control" style='display:none;width: 100px;' id="inp_hdtype_starttime" name="inp_hdtype_starttime" onfocus="hlentry(this)" onchange="formodified(this);" >
                                                                                    <option value="1" style="display: none;">First Half</option>
                                                                                    <option value="1">First Half</option>
                                                                                    <option value="2">Second Half</option>
                                                                             </select>

                                                                             <select class="form-control" style='display:none;width: 100px;background-color: darkorange;' id="inp_hdtype_starttime_con2" name="inp_hdtype_starttime" onfocus="hlentry(this)" onchange="formodified(this);" >
                                                                                    <option value="3" style="display: none;">Full Day</option>
                                                                                    <option value="3">Full Day</option>
                                                                                    <option value="2">Second Half</option>
                                                                             </select>

                                                                             <select class="form-control" style='display:none;width: 100px;background-color: blanchedalmond;' id="inp_hdtype_starttime_full_day" name="inp_hdtype_starttime" onfocus="hlentry(this)" onchange="formodified(this);" >
                                                                                    <option value="3" style="display: none;">Full Day</option>
                                                                                    <option value="3">Full Day</option>
                                                                             </select>

                                                                             <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                                             <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                                             <input class="form-control" style="display:none; margin-bottom: 2px; width: 90px;" id="inp_starttime" name="inp_starttime" placeholder="HH:ii" value="00:00" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
                                                                             <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                                             <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                                             
                                                                      </td>

                                                                      <td id='HD' nowrap='nowrap' style='display:none;'>
                                                                             <div style='display:none;' id="hide" class="toolbar sprite-toolbar-add" id="add" title="Add"></div>
                                                                             <div id="show" class="toolbar sprite-toolbar-add" id="add" title="Add"></div>
                                                                      </td>

                                                                    

                                                 </tr>


                                                

  
                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">To <span
                                                                             class="required">*</span></label>
                                                        </td>

                                                        <!-- <td nowrap='nowrap' width="20%"><input class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="modal_leave_end" name="modal_leave_end"
                                                                      type="date" value="" onfocus="hlentry(this)"
                                                                      size="20" maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></td>
                                                        -->
                                                        <td nowrap='nowrap' width="20%"><input maxlength="10" type="text" style="height: 25px;
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);   
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat;   
                                                                      padding-left:17px;
                                                                      background-size: 17px;
                                                                      padding: 1px;
                                                                      padding-left: 1px;
                                                                      padding-left: 6px;
                                                                      font-size: 12px;
                                                                      line-height: 1.42857143;
                                                                      color: #555;
                                                                      background-color: rgb(249, 249, 249);
                                                                      
                                                                      border: 1px solid #ccc;
                                                                      border-radius: 0px;
                                                                      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                                                                      box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                                                                      -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                                                                      -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                                      transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;" id="modal_leave_end" name="modal_leave_end"/>
                                                                     
                                                        </td>

                                                                      <td id='HDD' name='HDD' nowrap='nowrap' style='display:none;'> 
                                                                             <img style='display:none;' id="hide2" src="../../asset/img/icons/icon_reset.png" onclick="AddTime(this);"  hspace="2" border="0" align="absmiddle">
                                                                             <img id="show2" src="../../asset/img/icons/icon_reset.png" onclick="AddTime(this);"  hspace="2" border="0" align="absmiddle">
                                                                             
                                                                      </td>
                                                                      <td nowrap='nowrap'>
                                                                             <select class="form-control" style='display:none;width: 100px;' id="inp_hdtype_starttime2" name="inp_hdtype_starttime2" onfocus="hlentry(this)" onchange="formodified(this);" >
                                                                                    <option value="1" style="display: none;">First Half</option>
                                                                                    <option value="1">First Half</option>
                                                                                    <option value="3">Full Day</option>
                                                                             </select>

                                                                             <input id="inp_hdtype_starttime2_declare" name="inp_hdtype_starttime2" type="hidden" value="undefined">

                                                                             <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                                             <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                                             <input class="form-control" style="display:none; margin-bottom: 2px; width: 90px;" id="inp_endtime" name="inp_endtime" placeholder="HH:ii"  value="00:00" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
                                                                             <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                                             <!-- UNTUK TIPE PART OF DAY / JAM JAMAN -->
                                                        </td>
                                                 </tr>


<!-- /**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */ -->








































                                                 <tr id="tr_inp_nickname" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Remark <span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><textarea
                                                                      class="form-control"
                                                                      style="margin-bottom: 2px; width: 100%;"
                                                                      id="inp_remark" name="inp_remark" type="Text"
                                                                      value="" onfocus="hlentry(this)" size="20"
                                                                      maxlength="50" 
                                                                      validate="NotNull:Invalid Form Entry"
                                                                      onchange="formodified(this);" title=""></textarea>
                                                        </td>
                                                 </tr>

                                                 <tr id="tr_inp_urgent_on" class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Urgent ?<span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1">
                                                               <div class="vc-toggle-container">
                                                                      <label class="vc-switch">
                                                                             <input type="checkbox" name="inp_urgents" id="inp_urgent_on" value='1' class="vc-switch-input" />
                                                                             <input type="hidden" checked="checked" name="inp_urgent_decl" id="inp_urgent_on_back" value='1' class="vc-switch-input hidden" />
                                                                             <span class="vc-switch-label" data-on="Yes" data-off="No"></span>
                                                                             <span class="vc-handle"></span>
                                                                      </label>
                                                               </div>
                                                        </td>
                                                 </tr>

                                                 <tr id="tr_inp_urgent_off" style='display:none;'  class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Urgent ?<span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1">
                                                               <div class="vc-toggle-container">
                                                                      <label class="vc-switch">
                                                                             <input type="checkbox" checked="checked" name="inp_urgent" id="inp_urgent_off" value='0' class="vc-switch-input" />
                                                                             <span class="vc-switch-label" data-on="Yes" data-off="No"></span>
                                                                             <span class="vc-handle"></span>
                                                                      </label>
                                                               </div>
                                                               
                                                        </td>
                                                 </tr>

                                                 <tr id="tr_inp_urgent_reason" style='display:none;'  class="clTR1">
                                                        <td><label id="lbl_inp_nickname" for="inp_nickname"
                                                                      title="">Urgent Reason<span
                                                                             class="required">*</span></label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1">
                                                        
                                                        
                                                        <select name="sel_inp_urgreason" class="form-control urgent_reason" style="margin-bottom: 2px; width: 100%;">
                                                               <option>--Select One--</option>
                                                        </select>
                                                        
                                                        
                                                        </td>
                                                 </tr>

                                                 

                                                 <tr id="tr_inp_refdoc" class="selected">
                                                        <td><label id="lbl_inp_refdoc" for="inp_refdoc" title="">File
                                                                      Attachment</label>
                                                        </td>
                                                        <td colspan="3" class="" id="tdb_1"><span
                                                                      style="display:inline-block; margin:3px 0px">Max
                                                                      File : <span id="maxFile_refdoc" title=""
                                                                             style="cursor: default;">10000 KByte
                                                                      </span></span><br><input class="form-control"
                                                                      id="inp_refdoc" name="inp_refdoc[]" type="File"
                                                                      value="" onfocus="hlentry(this)" size="30"
                                                                      maxlength="50" style="float: left; margin: -3px;"
                                                                      onchange="formodified(this);" title=""></td>
                                                 </tr>

                                                 <tr id="tr_inp_file_ext" class="clTR1">
                                                        <td><label id="lbl_inp_file_ext" for="inp_file_ext"
                                                                      title="">File Extension</label>
                                                        </td>
                                                        <td colspan="3" class="label" id="tdb_1">doc,jpg,ods,png,txt,doc,pdf
                                                        </td>
                                                               </tr>
                                                 </tr>
                                          </tbody>
                                   </table>
                            </fieldset>


                            <tr>
                                   <td colspan="3" align="right" width="100%">
                                          <div class="modal-footer">
                                                 <div class="form-group">
                                                        <button onclick='return stopload()' type="button" class="btn btn-default"
                                                               data-dismiss="modal">Cancel</button>

                                                        <script language="javascript" type="text/javascript">
                                                        
                                                        var modal_emp = document.getElementById("modal_emp").value;
                                                        function OpenPopupCenter(val, pageURL,
                                                               title, w, h) {
                                                               var left = (screen.width - w) / 2;
                                                               var top = (screen.height - h) /
                                                                      50; // for 25% - devide by 4  |  for 33% - devide by 3
                                                               var targetWin = window.open(
                                                                      'window_approver?rfid=' +
                                                                      modal_emp, title,
                                                                      'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
                                                                      w + ', height=' + h +
                                                                      ', top=' + 50 +
                                                                      ', left=' + left);
                                                        }
                                                        </script>
                                                        </head>

                                                        <body>
                                                               <a id="four" class="btn btn-primary" style="color: cornsilk;" name="four"
                                                                      onclick="OpenPopupCenter(this.value, 'TEST!?', 450, 900);"
                                                                      target="_blank">Preview
                                                                      Approver</a>

                                                        </body>

                                                        <script>
                                                        $(function() {
                                                               var $src = $(
                                                                             '#modal_emp'),
                                                                      $dst = $(
                                                                             '#four'
                                                                      );
                                                               $src.on('input',
                                                                      function() {
                                                                             $dst.val($src
                                                                                    .val());
                                                                      });
                                                        });
                                                        </script>


                                                        <button type="submit" name="submit_add"
                                                             
                                                               class="btn btn-warning">Submit</button>
                                                 </div>
                                          </div>
                                   </td>
                            </tr>

              </form>
              
       
    






              

		<script type="text/javascript">
              $(document).ready(function() {
                     $('#modal_leave_start').bootstrapMaterialDatePicker({
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

























<script type="text/javascript">
function isi_otomatis() {
       var modal_emps = $("#modal_emp").val();
       $.ajax({
              url: 'ajax_cek.php',
              data: "modal_emp=" + modal_emps,
       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#inp_nickname').val(obj.nama);
              $('#nik').val(obj.nik);
       });
}
</script>

<script type="text/javascript">
function isi_otomatis_leave() {
       var modal_emps = $("#modal_emp").val();
       var modal_leave = $("#modal_leave").val();

       $.ajax({
              url: 'ajax_cek3_mysql.php',
              data: {
                     modal_emp: modal_emps,
                     modal_leave: modal_leave
              },

       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#inp_leavebalance').val(obj.lvb);
              $('#inp_leavedaytype').val(obj.ltp);
       });
}
</script>


<script type="text/javascript">
function log(message) {

}

window.onload = function() {
       document.querySelector('#datepicker1').addEventListener('datechanged', function(e) {
              console.log('New date', e.data, this.value)
       })

       duDatepicker('#datepicker1', {
              format: 'd mmmm yyyy',
              range: false,
              clearBtn: true,
              // disabledDays: ['Sat', 'Sun'],
              events: {
                     dateChanged: function(data) {
                            log('From: ' + data.dateFrom + '\nTo: ' + data.dateTo)
                     },
                     onRangeFormat: function(from, to) {
                            var fromFormat = 'd mmmm d, yyyy',
                                   toFormat = 'mmmm d, yyyy';

                            if (from.getMonth() === to.getMonth() && from.getFullYear() === to.getFullYear()) {
                                   fromFormat = 'd mmmm'
                                   toFormat = 'd, yyyy'
                            } else if (from.getFullYear() === to.getFullYear()) {
                                   fromFormat = 'd mmmm'
                                   toFormat = 'd mmmm, yyyy'
                            }

                            return from.getTime() === to.getTime() ?
                                   this.formatDate(from, 'd mmmm, yyyy') : [this.formatDate(
                                          from, fromFormat), this.formatDate(to,
                                          toFormat)].join('-');
                     }
              }
       })
}
</script>


              <script>
                     function HrmsValidationForm() {
                            var modal_emp               = document.getElementById("modal_emp").value;
                            var modal_leave             = document.getElementById("modal_leave").value;
                            var inp_leavebalance        = document.getElementById("inp_leavebalance").value;
                            var modal_leave_starts      = document.getElementById("modal_leave_start").value;
                            var modal_leave_ends        = document.getElementById("modal_leave_end").value;
                            var inp_remark              = document.getElementById("inp_remark").value;
                            var inp_leavedaytype        = document.getElementById("inp_leavedaytype").value;

                            var from                    = new Date(modal_leave_starts).getTime();
                            var to                      = new Date(modal_leave_ends).getTime();
              
                            
                            if(from > to) {
                                   alert("Entry Date: Enter Date in Proper Range");
                                   return false;
                            } else if(modal_emp == "") {
                                   alert("Employee Number invalid");
                                   return false;
                            } else if(modal_leave == "") {
                                   alert("Please select type of leave");
                                   return false;
                            } else if(inp_leavebalance == "") {
                                   alert("Something went wrong");
                                   return false;
                            } else if(modal_leave_starts == "") {
                                   alert("Start date Cant empty");
                                   return false;
                            } else if(modal_leave_ends == "") {
                                   alert("End date Cant empty");
                                   return false;
                            } else if(inp_remark == "") {
                                   alert("Remark Cant empty");
                                   return false;
                            } else if(inp_leavedaytype == "PD" && from < to) {
                                   alert("Partial Day Permit just allowing max 5 Hours");
                                   return false;
                            } if (modal_emp != "" && modal_leave_start!= "") {
                                   return true;
                            }
                     }
              </script>



<!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
<!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
<script type="text/javascript">
    $(document).ready(function()
       {
              $(".modal_leave").change(function()
              {
                     var leave_code=$(this).val();
                     var post_id = 'id='+ leave_code;

                            $.ajax
                            ({
                            type: "POST",
                            url: "ajax_cek4_leavetype.php",
                            data: post_id,
                            cache: false,
                            success: function(urgent_reason_print)
                            {
                            $(".urgent_reason").html(urgent_reason_print);
                            } 
              });
       });
    });
</script>
<!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->
<!-- JAVASCRIPT UNTUK GET LEAVE TYPE VS URGENT REASON -->