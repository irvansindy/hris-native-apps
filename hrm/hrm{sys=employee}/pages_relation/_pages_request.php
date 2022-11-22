<table width="100%">
       <?php
       include "../../../application/config.php";
       $rfid = $_GET['rfid'];
       //$modal_id = '1';
       $modal = mysqli_query($connect, "SELECT 
                                          a.request_no,
                                          b.sts_approval,
                                          c.name_en,
                                          DATE_FORMAT(a.created_date, '%d %b %Y') as _timestamp
                                   FROM mgtools_view_employee a
                                   LEFT JOIN 
                                          (
                                                 SELECT 
                                                        sub1.request_no,
                                                        MAX(sub1.request_status) AS sts_approval
                                                        FROM hrmrequestapproval sub1
                                                        GROUP BY sub1.request_no
                                          ) b ON a.request_no=b.request_no
                                          LEFT JOIN hrmstatus c on b.sts_approval=c.code
                                   WHERE a.emp_id = '$rfid'
                                   GROUP BY a.request_no
                                   ORDER BY a.request_no DESC");

       while ($row = mysqli_fetch_array($modal)) {

              $activebadge = '';
              if ($row['name_en'] == "Draft") {
                     $activebadge = "badge-draft";
              } elseif ($row['name_en'] == "Unverified") {
                     $activebadge = "badge-Unverified";
              } elseif ($row['name_en'] == "Partially Approved") {
                     $activebadge = "badge-Partially-Approved";
              } elseif ($row['name_en'] == "Fully Approved") {
                     $activebadge = "badge-Fully-Approved";
              } elseif ($row['name_en'] == "Revised") {
                     $activebadge = "badge-Revised";
              } elseif ($row['name_en'] == "Rejected") {
                     $activebadge = "badge-Rejected";
              } elseif ($row['name_en'] == "Cancelled") {
                     $activebadge = "badge-Cancelled";
              } else {
                     $activebadge = "badge-Closed";
              }
       ?>

              <tbody>
                     <tr>
                            <td><?php echo $row['request_no']; ?></td>
                            <td></td>
                            <td 
                                   data-toggle="modal" 
                                   data-target="#ApprovalForm" 
                                   data-backdrop="static" 
                                   style="text-align: right;color: blue; border: 5px; cursor:pointer" 
                                   onclick="ApprovalSubmission(`<?php echo $row['request_no']; ?>`)">&nbsp;
                                   <span class="badge <?php echo $activebadge; ?>">
                                   <?php echo $row['name_en']; ?></span>
                            </td>
                     </tr>
                     <tr>
                            <td><?php echo $row['_timestamp']; ?></td>
                            <td>&nbsp;</td>
                            <td 
                                   data-toggle="modal" 
                                   data-target="#PreviewForm" 
                                   data-backdrop="static" 
                                   style="text-align: right;color: blue; border: 5px; cursor:pointer;padding-top: 3px;" 
                                   onclick="PreviewChanges(`<?php echo $row['request_no']; ?>`)">&nbsp;
                                   <span style="color: #736c6c; background-color: #e2e2e2" class="badge <?php echo $activebadge; ?>">
                                   Preview Changes</span>
                            </td>
                     </tr>
                     <tr>
                            <td>Employee changes</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                     </tr>
                     <tr>
                            <td colspan="3">
                                   <hr>
                            </td>
                     </tr>
              </tbody>
       <?php } ?>
</table>