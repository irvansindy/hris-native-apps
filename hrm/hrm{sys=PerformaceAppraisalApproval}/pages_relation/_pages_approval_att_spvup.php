<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-hover table-bordered table-head-fixed table-striped" id="tbl_posts">
       <thead>
              <tr>
                     <th style="text-align: center;">Item</th>
                     <th style="text-align: center;">Bobot KPI / KPI Weight (%) (B)</th>
                     <th style="text-align: center;">Reviewer Rating (RR)</th>
                     <th style="text-align: center;">Total Rating (B x RR)</th>
                     <th style="text-align: center;">Remarks</th>
              </tr>
       </thead>


       <?php
                                                                      include "../../../application/config.php";
                                                                      $rfid = $_GET['rfid'];
                                                                      //$modal_id = '1';
                                                                      $no = 1;
                                                                      $modal=mysqli_query($connect, "SELECT 
                                                                                                         a.*,
                                                                                                         a.att_item as att,
                                                                                                         b.*
                                                                                                         FROM hrmperf_set_attitude a 
                                                                                                         LEFT JOIN hrmperf_parequest_att b on a.att_item = b.att_item AND b.ipp_reqno = '$rfid'
                                                                                                         WHERE a.kpi_perspektif_type = '2' AND a.att_item BETWEEN '4' AND '7'");

                                                                      while($row_performance = mysqli_fetch_array($modal)){

                                                               ?>
       <tbody id="tbl_posts_body">
              <tr id="rec-1" style="display:none;">
                     <td style="text-align: center;">
                                   <input type="text" value="<?php echo $row_performance['att']; ?>" name="inp_performance_att_spvup_approver[]">
                                   <input type="text" value="<?php echo $rfid; ?>" name="inp_performance_att_spvup_approver0[]">
                            
                            </td>
              </tr>
              <tr id="rec-1">
                     <td nowrap="nowrap" align="left"><?php echo $row_performance['att_name']; ?></td>
                     <td><input required type="text" class="form-control" value="<?php echo $row_performance['kpi_bobot']; ?>"
                                   name="inp_performance_att_spvup_approver1[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input required type="text" class="form-control" value="<?php echo $row_performance['rr']; ?>"
                                   name="inp_performance_att_spvup_approver2[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input required type="text" class="form-control" value="<?php echo $row_performance['brr']; ?>"
                                   name="inp_performance_att_spvup_approver3[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td align="center"><textarea required class="form-control" rows="5"
                                   name="inp_performance_att_spvup_approver4[]"
                                   style="border: 1px solid #d7d7d7;width: 100%;"><?php echo $row_performance['remark']; ?></textarea></td>
              </tr>
       </tbody>
       <?php } ?>
</table>


</div>