<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->



<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<script type="text/javascript">
       $(document).ready(function() {
              $('#inp_add_startdate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_add_enddate').bootstrapMaterialDatePicker({
                     time: false,
                     clearButton: true
              });

              $('#inp_pdtype_starttime').bootstrapMaterialDatePicker({
                     date: false,
                     format: 'HH:mm'
              });

              $('#inp_pdtype_endtime').bootstrapMaterialDatePicker({
                     date: false,
                     format: 'HH:mm'
              });
       });
</script>




<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<div class="col-md-12">
       <fieldset id="fset_1">
              <legend>Filter</legend>
              <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">

              <form class="form-horizontal" method="POST" target="_self" id="FormDisplayCreate" action="preview" onkeydown="return event.key != 'Enter';">
                     <div class="form-row" id="frm_employee_no">
                            <div class="col-lg-3 name">Date Between <font color="red">*</font>
                            </div>
                            <div class="col-lg-3">
                                   <div class="input-group">
                                          <input type="text" id="inp_add_startdate" name="inp_add_startdate" class="input--style-6" placeholder="Start Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;" autocomplete="off" />
                                   </div>
                            </div>

                            <div class="col-lg-3">
                                   <div class="input-group">
                                          <input type="text" id="inp_add_enddate" name="inp_add_enddate" class="input--style-6" placeholder="End Date" style="background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                             background-size: 17px;
                                                                             background-position:right;   
                                                                             background-repeat:no-repeat; 
                                                                             padding-right:10px;" autocomplete="off" />
                                   </div>
                            </div>
                     </div>

                     <div class="form-row" id="show_employees">
                            <div class="col-3 name">Employee</div>
                            <div class="col-lg-8">
                                   <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;border:1px solid #d2d2d2;border-radius: 4px;">
                                          <div id="box_add_employee"></div>
                                   </div>
                            </div>
                     </div>

                     <div class="form-row" id="show_employees">
                            <div class="col-3 name"></div>
                            <div class="col-lg-8">
                            <button class="btn btn-primary" type="submit" name="submit_update" id="submit_update">
                                          Confirm
                                   </button>
                            </div>
                     </div>


              </div>
              </form>

       </fieldset>










              <script>
                     function RefreshPage() {
                            datatable.ajax.reload(null, true);

                            setTimeout(function() {
                                   mymodalss.style.display = "none";
                                   document.getElementById("msg").innerHTML = "Data refreshed";
                                   return false;
                            }, 2000);

                            mymodalss.style.display = "block";
                            document.getElementById("msg").innerHTML = "Data refreshed";
                            return false;
                     }
              </script>




              <!-- isi JSON -->
              <script type="text/javascript">
                     // global the manage memeber table 
                     $(document).ready(function() {



                            $("#box_add_employee").load("pages_relation/_pages_add_employee.php?rfid=",
                                   function(responseTxt, statusTxt, jqXHR) {
                                          if (statusTxt == "success") {
                                                 $("#box_add_employee").show();
                                                 if ($("#box_add_employee").show()) {
                                                        mymodalss.style.display = "none";
                                                 }
                                          }
                                          if (statusTxt == "error") {
                                                 alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                          }
                                   }
                            );


                     });
              </script>
              <!-- isi JSONs -->
              </body>

              </html>

              <script type="text/javascript">
                     $(document).ready(function() {
                            $('#inp_add_startdate').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#inp_add_enddate').bootstrapMaterialDatePicker({
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

                            $('#modal_revised_leave_start').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#modal_revised_leave_end').bootstrapMaterialDatePicker({
                                   time: false,
                                   clearButton: true
                            });

                            $('#inp_revised_starttime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });

                            $('#inp_revised_endtime').bootstrapMaterialDatePicker({
                                   date: false,
                                   format: 'HH:mm'
                            });
                     });
              </script>