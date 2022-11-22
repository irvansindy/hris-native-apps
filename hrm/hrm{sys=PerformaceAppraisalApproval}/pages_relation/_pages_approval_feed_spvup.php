<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-hover table-bordered table-head-fixed table-striped" id="tbl_posts">
       <thead>
              <tr>
                     <th style="text-align: center;">Positive Feedback</th>
                     <th style="text-align: center;">Feedback for Improvements</th>
                     <th style="text-align: center;">Coaching</th>
              </tr>
       </thead>


       <?php
                                                                      include "../../../application/config.php";
                                                                      $rfid = $_GET['rfid'];
                                          
                                                                      $no = 1;
                                                                      $row_performance = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                                                         a.*
                                                                                                         FROM hrmperf_parequest_feed a 
                                                                                                         WHERE a.ipp_reqno = '$rfid'"));

                                                            

                                                               ?>
       <tbody id="tbl_posts_body">
              <tr id="rec-1" style="display:none;">
                     <td style="text-align: center;">
                            <input type="text" value="<?php echo $rfid; ?>"
                                   name="inp_performance_feed_spvup_approver0[]">
                     </td>
              </tr>
              <tr id="rec-1">
                     <td align="center"><textarea required class="form-control" rows="5"
                                   name="inp_performance_feed_spvup_approver1[]"
                                   style="border: 1px solid #d7d7d7;width: 100%;"><?php echo $row_performance['feedback_positive']; ?></textarea>
                     </td>
                     <td align="center"><textarea required class="form-control" rows="5"
                                   name="inp_performance_feed_spvup_approver2[]"
                                   style="border: 1px solid #d7d7d7;width: 100%;"><?php echo $row_performance['feedback_Improvement']; ?></textarea>
                     </td>
                     <td align="center"><textarea required class="form-control" rows="5"
                                   name="inp_performance_feed_spvup_approver3[]"
                                   style="border: 1px solid #d7d7d7;width: 100%;"><?php echo $row_performance['coaching']; ?></textarea>
                     </td>
              </tr>
       </tbody>

</table>
</div>