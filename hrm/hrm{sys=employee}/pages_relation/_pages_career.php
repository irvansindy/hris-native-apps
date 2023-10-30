<script>
       datatable_career = $("#datatable_career").DataTable({

              dom: "B<'row'<'col-sm-12 col-md-9'l><'col-sm-12 col-md-9'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-7'p>>",

              processing: true,
              // retrieve: true,
              searching: true,
              paging: true,
              order: [
                     [0, "asc"]
              ],
              pagingType: "simple",
              bPaginate: true,
              bLengthChange: false,
              bFilter: false,
              bInfo: true,
              bAutoWidth: true,
              language: {
                     "processing": "Please wait..",
              },
              columnDefs: [{
                     orderable: false,
                     targets: 0
              }],
              destroy: true
       });
</script>
<div class="MaximumFrameHeight card-body table-responsive p-0" style="width: 100vw;height: 50vh; width:99%; margin-right: 5px;overflow: scroll;overflow-x: scroll;">
       <div class="col-12 col-fit" style="margin-top: 17px;">
              <table id="datatable_career" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
                     <thead>
                            <tr>
                                   <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                   <th class="fontCustom" style="z-index: 1;">Transition No</th>
                                   <th class="fontCustom" style="z-index: 1;">Career Transition</th>
                                   <th class="fontCustom" style="z-index: 1;">Transition Type</th>
                                   <th class="fontCustom" style="z-index: 1;">Start Date</th>
                                   <th class="fontCustom" style="z-index: 1;">End Date</th>
                                   <th class="fontCustom" style="z-index: 1;">Employee No</th>
                                   <th class="fontCustom" style="z-index: 1;">Position</th>
                                   <th class="fontCustom" style="z-index: 1;">Cost Center</th>
                                   <th class="fontCustom" style="z-index: 1;">Grade</th>
                                   <th class="fontCustom" style="z-index: 1;">Employee Status</th>
                            </tr>
                     </thead>

       </div>
</div>
<?php
include "../../../application/config.php";
$rfid = $_GET['rfid'];
$no = 0;
$modal = mysqli_query($connect, "SELECT *, 
                                          DATE_FORMAT(a.effectivedt , '%d %b %Y') as effectivedt,
                                          CASE 
                                                 WHEN a.enddt IS NULL OR a.enddt = '0000-00-00 00:00:00' THEN ''
                                                 ELSE DATE_FORMAT(a.enddt , '%d %b %Y')
                                          END AS enddt
                                          FROM hrmemploymenthistory a
                                   WHERE emp_id = '$rfid'");

while ($row = mysqli_fetch_array($modal)) {

       $no++;

?>
       <tr>
              <td nowrap><?php echo $no; ?></td>
              <td nowrap><?php echo $row['history_no']; ?></td>
              <td nowrap><?php echo $row['careertransition_code']; ?></td>
              <td nowrap><?php echo $row['careertranstype']; ?></td>
              <td nowrap><?php echo $row['effectivedt']; ?></td>
              <td nowrap><?php echo $row['enddt']; ?></td>
              <td nowrap><?php echo $row['emp_no']; ?></td>
              <td nowrap><?php echo $row['position_code']; ?></td>
              <td nowrap><?php echo $row['costcenter_code']; ?></td>
              <td nowrap><?php echo $row['grade_code']; ?></td>
              <td nowrap><?php echo $row['employmentstatus_code']; ?></td>
       </tr>
<?php } ?>


</table>