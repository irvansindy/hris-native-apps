<form class="form-horizontal" action="php_action/FuncDataCreateSPVUP.php" method="POST" id="FormDisplayCreateSPVUP">

                            <fieldset id="fset_1">
                                   <legend>&nbsp;Employee Information&nbsp;</legend>
                                   <input id="inp_emp_no" name="inp_emp_no" type="" value="<?php echo $username; ?>"><!--FROM SESSION -->
                                   </fieldset>
                                   </div>
                            </fieldset>
                                   

                            <div class="modal-footer">
                                   <button type="reset" class="btn btn-primary1" 
                                          data-dismiss="modal" aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn btn-warning" type="submit" name="submit_add_SPVUP" id="submit_add_SPVUP">
                                          Confirm
                                   </button>
                                   <button class="btn btn-warning" type="button" name="submit_add_SPVUP2"
                                          id="submit_add_SPVUP2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>      
</form>


<?php
                                                               include "../../../application/config.php";
                                                               ?>


              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 99.1%; margin: 5px;overflow: scroll;">


                     <label><?php echo $src_emp_no_ori; ?></label>
                     <table id="datatable" width="100%"
                            class="table table-bordered table-striped table-hover table-head-fixed">
                            <thead>
                                   <tr bordercolor="#000000">
                                          <td rowspan="3" class="header-data" nowrap="nowrap" align="center"
                                                 style="vertical-align: inherit;background: #999;font-weight: bold;color: white;border: 1px solid white;">
                                                 Date</td>
                                          <td rowspan="3" class="header-data" align="center"
                                                 style="vertical-align: inherit;background: #999;font-weight: bold;color: white;border: 1px solid white;">
                                                 Shift</td>
                                          <td rowspan="2" colspan="2" class="header-data" align="center"
                                                 style="vertical-align: inherit;background: #999;font-weight: bold;color: white;border: 1px solid white;">
                                                 Shift Daily</td>
                                          <td colspan="4" class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 Actual Time</td>

                                          <td rowspan="3" class="header-data" align="center"
                                                 style="vertical-align: inherit;background: #999;font-weight: bold;color: white;border: 1px solid white;">
                                                 Status</td>
                                          <!-- <td rowspan="3" class="header-data" align="center">Other Status</td> -->
                                          <td rowspan="3" class="header-data" align="center"
                                                 style="vertical-align: inherit;background: #999;font-weight: bold;color: white;border: 1px solid white;">
                                                 Remark</td>
                                          <td rowspan="3" class="header-data" align="center"
                                                 style="vertical-align: inherit;background: #999;font-weight: bold;color: white;border: 1px solid white;">
                                                 Update
                                                 <input id='checkAll' name="inp_chkAll" type="checkbox"
                                                        onclick="checkAll();" align="middle">
                                          </td>
                                   </tr>
                                   <tr bordercolor="#000000">
                                          <td colspan="2" class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 in </td>
                                          <td colspan="2" class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 Out</td>
                                   </tr>
                                   <tr bordercolor="#000000">
                                          <td class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 in </td>
                                          <td class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 Out</td>
                                          <td class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 Time</td>
                                          <td class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 +/-Minute(s)</td>
                                          <td class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 Time</td>
                                          <td class="header-data" align="center"
                                                 style="background: #ccc;font-weight: bold;color: white;border: 1px solid white;">
                                                 +/-Minute(s)</td>

                                   </tr>

                            </thead>

                            <?php
                            $qListRender_srvside = "SELECT 
                                          a.*,
                                          c.*,
                                          b.status,
                                          DATE_FORMAT(a.start_date, '%d %b %Y') as join_date,

                                          (SELECT GROUP_CONCAT(attend_code) 
                                          FROM hrdattstatusdetail
                                          WHERE attend_id = c.attend_id
                                          GROUP BY attend_id) as attdetaillist,
                                          REPLACE(c.attend_id, '-', '') as key_att,

                                          TIME_FORMAT(c.shiftstarttime, '%H:%i') as shiftstarttime,
                                          TIME_FORMAT(c.shiftendtime, '%H:%i') as shiftendtime,
                                          TIME_FORMAT(c.starttime, '%H:%i') as starttime,
                                          TIME_FORMAT(c.endtime, '%H:%i') as endtime

                                          FROM view_employee a
                                          LEFT JOIN teodempcompany b on a.emp_id=b.emp_id
                                          LEFT JOIN hrdattendance c on a.emp_id=c.emp_id

                                          WHERE (a.emp_no LIKE '%13-0299%') and c.dateforcheck BETWEEN '2022-01-09' and '2022-01-09' 

                                          ORDER BY a.Full_name";
                            ?>
                     
                     

                            <?php 
                                   $data_attendance = mysqli_query($connect, $qListRender_srvside);
                                   while($r=mysqli_fetch_array($data_attendance)){
                            ?>

                            

                            <tr id="<?php echo $r["key_att"]; ?>">
                                   <input id="inp_attend_id_<?php echo $r['s_att']; ?>" name="inp_attend_id_<?php echo $r['key_att']; ?>" type="hiddens" readonly="true" size="4" value="<?php echo $r['attend_id']; ?>" style="background:yellow">
                                   <input id="keyss" name="keyss" type="" size="4" value="" style="background:red">
                                   <td> <?php echo $r['dateforcheck']; ?> </td>
                                   <td> <select id="sel_shiftdaily_code_<?php echo $r['key_att']; ?>"
                                                 class="input--style-6"
                                                 name="sel_shiftdaily_code[]"
                                                 onfocus="hlentry(this)"
                                                 onchange="myFunction_kodestart_<?php echo $r['key_att']; ?>()"
                                                 style="border: 1px solid #d9bfbf;font-size: 12px;width: 100%;padding: 4px;background: #d9d9d9;">
                                                 <option value="<?php echo $r['shiftdaily_code']; ?>" selected>
                                                        <?php echo $r['shiftdaily_code']; ?></option>
                                                 <?php
                                                                                    $sql = mysqli_query($connect,"SELECT shiftdailycode FROM hrmttamshiftdaily ");
                                                                                    while($row=mysqli_fetch_array($sql))
                                                                                    {
                                                                                           echo '<option value="'.$row['shiftdailycode'].'">'.$row['shiftdailycode'].'</option>';
                                                                                    } 
                                                                             ?>
                                          </select> </td>

                                   <td align="center">
                                          <p id="shiftstarttime_<?php echo $r['key_att']; ?>">
                                                 <?php echo $r['shiftstarttime']; ?></p>
                                          <input id="inp_shiftstart_1" name="inp_shiftstart_1" type="hidden" readonly="true" size="4" value="<?php echo $r['shiftstarttime']; ?>" style="background:yellow">
                                   </td>
                                   <td align="center">
                                          <p id="shiftendtime_<?php echo $r['key_att']; ?>">
                                                 <?php echo $r['shiftendtime']; ?></p>
                                          <input id="inp_shiftend_1" name="inp_shiftend_1" type="hidden" readonly="true" size="4" value="<?php echo $r['shiftendtime']; ?>" style="background:yellow">
                                   </td>
                                   <td> <?php echo $r['starttime']; ?> </td>
                                   <td> <?php echo $r['actual_in']; ?> </td>
                                   <td> <?php echo $r['endtime']; ?> </td>
                                   <td> <?php echo $r['actual_out']; ?> </td>
                                   <td> <input type="text" value="<?php echo $r['attdetaillist']; ?>"
                                                 style="border: 1px solid #d9bfbf;font-size: 12px;width: 100%;padding: 4px;">
                                   </td>
                                   <td> <input type="text" value="<?php echo $r['remark']; ?>"
                                                 style="border: 1px solid #d9bfbf;font-size: 12px;width: 100%;padding: 4px;">
                                   </td>
                                   <td style="text-align:center;"><input type='checkbox' id="cek<?php echo $r['key_att']; ?>" name='update[]'
                                                 value='<?php echo $r['key_att']; ?>'>
                                   </td>
                            </tr>

                            <script>
                            function myFunction_kodestart_<?php echo $r['key_att']; ?>() {

                                   var x = document.getElementById("sel_shiftdaily_code_<?php echo $r['key_att']; ?>")
                                          .value;
                                   //  alert(x);

                                   $.ajax({
                                          url: 'php_action/getData_Shiftdetail.php',
                                          type: 'post',
                                          data: {
                                                 shift_id: x
                                          },
                                          dataType: 'json',
                                          success: function(response) {
  
                                                 document.getElementById("shiftstarttime_<?php echo $r['key_att']; ?>").innerHTML = response.shiftstarttime;
                                                 document.getElementById("shiftendtime_<?php echo $r['key_att']; ?>").innerHTML = response.shiftendtime;
                                                 $("#revised_request_no").val(response.shiftstarttime);
                                          } // /success
                                   }); // /fetch selected member info
                            }
                            </script>

                            <?php } ?>

                     </table>
                     <div class="col-sm-12" style="text-align: right;">
                            <button type="submit" id="but_update" name="but_update" style="width: 97px;margin-top: 5px;background: grey;border: 1px solid;" value="Upload" class="btn btn-rounded btn-warning btn-sm text-white d-inline-block">Submit</button>                     
                     </div>

                     </form>
              </div>

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
              </div>
       </div>
</div>


