<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-bordered table-hover table-head-fixed">
       <thead>
              <tr>
                     <th>No.</th>
                     <th>Attitude </th>
                     <th>Bobot (B)</th>
                     <th>Target</th>
                     <th>Target Mid Year</th>
                     <th>Full Year</th>
              </tr>
       </thead>
       <tbody>
<?php
       include "../../../application/config.php";
	$rfid = $_GET['rfid'];
	//$modal_id = '1';
       $no = 1;
	$modal=mysqli_query($connect, "SELECT 
                                          a.*,
                                          b.att_name
                                                 FROM 
                                          hrmperf_parequest_stfsc a
                                          LEFT JOIN hrmperf_set_attitude b on a.att_item=b.att_item
                                          WHERE a.pa_reqno = '$rfid'
                                          GROUP BY b.att_item");

	while($row_attitude = mysqli_fetch_array($modal)){
?>

              


              <div class="input-group">
                     <tr id="recs-1">
                            <td><?php echo $no++; ?>.</td>
                            <td align="center"><select id="sel_currency_code" class="form-control" name="inp_attitude_spvdown_approver0[]"
                                          onfocus="hlentry(this)" onchange="formodified(this);"
                                          style="width:undefined;width: 160px;border: 1px solid #cac2c2;text    -align: left;color: #484545;">
                                          <option value="<?php echo $row_attitude['att_item']; ?>"> <?php echo $row_attitude['att_name']; ?></option>
                                                 <?php
                                                        $sql = mysqli_query($connect, "SELECT att_item,att_name FROM hrmperf_set_attitude");
                                                        $row = mysqli_num_rows($sql);
                                                        while ($row = mysqli_fetch_array($sql)){
                                                        echo "<option value='". $row['att_item'] ."'>" .$row['att_name'] ."</option>" ;
                                                        }
                                                 ?>
                                   </select></td>
                            <td align="center"><input type="text" class="form-control" autocomplete="off" id="spv_down<?php echo $row_no; ?>"
                                          onchange="addspv_down()" value="<?php echo $row_attitude['kpi_bobot']; ?>" name="inp_attitude_spvdown_approver1[]"
                                          style="border: 1px solid #d7d7d7;text-align: right;"></td>
                            <td align="center"><textarea type="text" class="form-control" name="inp_attitude_spvdown_approver2[]"
                                          style="border: 1px solid #d7d7d7;"><?php echo $row_attitude['kpi_target']; ?></textarea></td>
                            <td align="center"><input type="text" class="form-control" autocomplete="off" value="<?php echo $row_attitude['kpi_midyear_trg']; ?>" name="inp_attitude_spvdown_approver3[]"
                                          style="border: 1px solid #d7d7d7;text-align: right;"></td>
                            <td align="center"><input type="text" class="form-control" autocomplete="off" value="<?php echo $row_attitude['kpi_fullyear_trg']; ?>" name="inp_attitude_spvdown_approver4[]"
                                          style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     </tr>
                     

       </tbody>

</div>


</div>
</div>
</div>
</div>
<?php } ?>
<tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                            <td colspan="2">Total</td>
                            <td align="center"><input class="form-control" type="text" id="spv_downGrandTotal" value="0"
                                          name="inp_attitude_spvdown_approver1[]" style="border: 1px solid #d7d7d7;text-align: right;">
                            </td>
                            <td colspan="3">&nbsp;</td>
                     </tr>
</table>