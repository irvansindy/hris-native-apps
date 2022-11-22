<?php
    include "../../../application/config.php";
	$rfid = $_GET['rfid'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, "SELECT 
                                          *
                                          FROM hrmovertime a
                                          WHERE a.overtime_code='$rfid'
	");

	while($r=mysqli_fetch_array($modal)){

       $overtime_code =  $r['overtime_code'];
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<div class="input-group">

       <table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts_four">
              <thead>
                     <tr>
                            <th>No.</th>
                            <th>Overtime Other Type</th>
                            <th>Minute(s)</th>
                            <th>Value</th>
              
                            <th><a class="add-record_four" style="margin-right: 7px;" data-added="0"><img src="../../asset/img/icons/acssadd.png"></a></th>
                     </tr>
              </thead>
              <tbody id="tbl_posts_body_four">
                     <?php
                     $no = 0;
                            $get_hrmovertimeother = mysqli_query($connect, "SELECT *,
                                                                                    CASE 
                                                                                           WHEN type_code = 'OTMEAL' and `value` > 0 THEN `value`
                                                                                           WHEN type_code = 'OTTRANSPORT' and `value` > 0 THEN '0'
                                                                                    END AS total_OTMEAL,
                                                                                    CASE 
                                                                                           WHEN type_code = 'OTMEAL' and `value` > 0 THEN '0'
                                                                                           WHEN type_code = 'OTTRANSPORT' and `value` > 0 THEN `value`
                                                                                    END AS total_OTTRANSPORT

                                                                                    FROM hrmovertimeother WHERE overtime_code = '$overtime_code'");
                            while($rs = mysqli_fetch_array($get_hrmovertimeother)){
                            $no++;
                     ?>

                     <tr id="recfour-1">
                            <td><span class="sn"><?php echo $no; ?></span>.</td>
                            <td><select id="OTtypeother" class="" name="OTtypeother[]" onfocus="hlentry(this)"
                                          onchange="formodified(this);"
                                          style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: center;color: #484545;">
                                          <option value="<?php echo $rs['type_code']; ?>"><?php echo $rs['type_code']; ?></option>
                                          <option value="OTMEAL">OTMEAL</option>
                                          <option value="OTTRANSPORT">OTTRANSPORT</option>
                                   </select></td>
                            <td><input type="text" value="<?php echo $rs['step'];?>" name="OTminutes[]"></td>
                            <td><input type="text" value="<?php echo $rs['value'];?>" name="OTvalue[]"></td>
                            <td><a class="delete-record_four" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
                     </tr>

                     <?php } ?>

              </tbody>
       </table>
       <div style="display:none;">
              <table id="sample_table_four" class="table table-bordered table-striped table-hover table-head-fixed">
                     <tr id="" class="reset-delete-record">
                            <td><span class="sn"></span>.</td>
                            <td><select id="OTtypeother" class="" name="OTtypeother[]" onfocus="hlentry(this)"
                                          onchange="formodified(this);"
                                          style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: center;color: #484545;">
                                          <option value="">--Select One--</option>
                                          <option value="OTMEAL">OTMEAL</option>
                                          <option value="OTTRANSPORT">OTTRANSPORT</option>
                                   </select></td>
                            <td><input type="text" value="" name="OTminutes[]"></td>
                            <td><input type="text" value="<?php echo $rs['value'];?>" name="OTvalue[]"></td>
                            <td><a class="delete-record_four" data-added="0"><img
                                                 src="../../asset/img/icons/minus.png"></a></td>
                     </tr>
              </table>
       </div>

</div>

</fieldset>


</div>

</div>
</div>
</div>
<?php } ?>