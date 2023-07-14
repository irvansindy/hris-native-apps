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

       <table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts_third">
              <thead>
                     <tr>
                            <th>No.</th>
                            <th>Per Hour</th>
                            <th>Value</th>
                            <th><a class="add-record_third" style="margin-right: 7px;" data-added="0"><img
                                                 src="../../asset/img/icons/acssadd.png"></a></th>
                     </tr>
              </thead>
              <tbody id="tbl_posts_body_third">
                     <?php 
                            $no = 0;
                            $modals=mysqli_query($connect, "SELECT 
                                                               a.*
                                                               FROM hrmovertimefactor a
                                                               WHERE a.overtime_code = '$overtime_code'");
                            while($rs=mysqli_fetch_array($modals)){
                            $no++;	
                     ?>
                            <tr id="rec-1">
                                   <td><span class="sn"><?php echo $no; ?></span>.</td>
                                   <td><input type="text" value="<?php echo $rs['step']; ?>" name="FactorHour[]"></td>
                                   <td><input type="text" value="<?php echo $rs['value']; ?>" name="FactorValue[]"></td>
                                   <td><a class="delete-record_third" data-added="0"><img src="../../asset/img/icons/minus.png"></a>
                                   </td>
                            </tr>
                     <?php } ?>
              </tbody>
       </table>
       <div style="display:none;">
              <table id="sample_table_third" class="table table-bordered table-striped table-hover table-head-fixed">
                     <tr id="" class="reset-delete-record">
                            <td><span class="sn"></span>.</td>
                            <td><input type="text" value="" name="FactorHour[]"></td>
                            <td><input type="text" value="" name="FactorValue[]"></td>
                            <td><a class="delete-record_third" data-added="0"><img src="../../asset/img/icons/minus.png"></a>
                            </td>
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