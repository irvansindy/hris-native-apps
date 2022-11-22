<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-hover table-bordered table-head-fixed table-striped" id="tbl_posts">
       <thead>
              <tr>
                     <th style="text-align: center;" rowspan="2">Year </th>
                     <th style="text-align: center;" rowspan="2">Period</th>
                     <th style="text-align: center;" rowspan="2">Attachment</th>
                     <!-- <th style="text-align: center;" rowspan="2">Upload</th> -->
                     <th style="text-align: center;" rowspan="2">Remarks</th>
              </tr>
       </thead>


       <?php
                                                                      include "../../../application/config.php";
                                                                      $rfid = $_GET['rfid'];
                                                                      $sfid = $_GET['kpi_pers_spv_up'];
                                                                      //$modal_id = '1';
                                                                      $no = 1;
                                                                      $modal=mysqli_query($connect, "SELECT
                                                                                                                a.*,
                                                                                                                c.ipp_reqno,
                                                                                                                d.period_code,
                                                                                                                YEAR(d.period_start) AS data,
                                                                                                                b.remark,
                                                                                                                b.filename,
                                                                                                                '$sfid' as kpi_pers_spv_up
                                                                                                         FROM
                                                                                                         hrmperf_target a
                                                                                                         LEFT JOIN hrmperf_iprecord b ON a.reference = b.document_reference AND b.ipp_reqno = '$rfid' AND b.document_reference = 'appraisal.effident' AND a.target_name = b.target AND b.ipp_id = '$sfid'
                                                                                                         LEFT JOIN hrmperf_ipprequest c ON c.ipp_reqno = '$rfid'
                                                                                                         LEFT JOIN hrmperf_set_period d ON c.ip_period = d.period_id
                                                                                                         ");
                                                                                                         
                                                                      while($row_performance = mysqli_fetch_array($modal)){

                                                                             $data = $row_performance['filename'];
                                                                             if($data != ''){
                                                                                    $dataOn = '<a href="../../../asset/request.file.appraisal.attachment/'.$row_performance['filename'].'"><img style="width: 100%;" src="../../../asset/request.file.appraisal.attachment/excel.png" height="425" width="425" class="img-thumbnail"/></a>';
                                                                             } else {
                                                                                    $dataOn = '<span id="uploaded_image'.$row_performance['kpi_pers_spv_up'].''.$row_performance['target_name'].'" style="15%";></span>';
                                                                             }
                                                               ?>
       <tbody id="tbl_posts_body">
              <tr id="rec-1" style="display:none;">
                     <td style="text-align: center;"><input type="text"
                                   value="<?php echo $row_performance['ip_period']; ?>"
                                   name="inp_performance_spvup_approver0[]"></td>
                     <td style="text-align: center;"><input type="text"
                                   value="<?php echo $row_performance['ipp_reqno']; ?>"
                                   name="inp_performance_spvup_approver1[]"></td>
                     <td style="text-align: center;"><input type="text"
                                   value="<?php echo $row_performance['kpi_pers_spv_up']; ?>"
                                   name="inp_performance_spvup_approver2[]"></td>
              </tr>
              <tr id="rec-1">
                     <td style="text-align: center;"><?php echo $row_performance['data']; ?></td>
                     <td nowrap="nowrap" align="left"><?php echo $row_performance['target_name_init']; ?></td>
                     <td align="center" style="width: 10px;"><?php echo $dataOn; ?></span></td>
                     <!-- <td align="center">
                            <form action="#">
                                   <div class="input-file-container">
                                          <input required class="input-file"
                                                 id="file<php echo $row_performance['kpi_pers_spv_up']; ?><php echo $row_performance['target_name']; ?>"
                                                 name="file<php echo $row_performance['kpi_pers_spv_up']; ?><php echo $row_performance['target_name']; ?>" type="file">
                                          <br>
                                   </div>
                                   <p class="file-return"></p>
                            </form>

                            <span class="badge badge-Fully-Approved"
                                   style="width: 100%;background: #ffc107;font-weight: bold;color: black;text-align: left;font-size: 10px;">1.
                                   Only for Excel and document type (.xls)<br>2. 3MB Max file size</span>
                     </td> -->
                     <td><textarea class="form-control" type="text" value="" name="remark<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>" id="remark<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>" style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['remark']; ?></textarea></td>

              </tr>
              <script>
              $(document).ready(function() {
                     $(document).on("change", "#file<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>",
                            function() {
                                   var name = document.getElementById("file<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>").files[0].name;
                                                 var form_data = new FormData();
                                                 var ext = name.split(".").pop().toLowerCase();
                                                 var oFReader = new FileReader();
                                                 oFReader.readAsDataURL(document.getElementById("file<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>"
                                                 ).files[0]);
                                                 var f = document.getElementById(
                                                               "file<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>").files[0];
                                                 var fsize = f.size || f.fileSize;
                                                 if (jQuery.inArray(ext, ["xls"]) == -1) {
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML ="Invalid type of file";
                                                        document.getElementById("file<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>"
                                                        ).value = "";
                                                 } else if (fsize > 2000000) {
                                                        modals.style.display = "block";
                                                        document.getElementById("msg").innerHTML =
                                                               "File to large, size : " + fsize +
                                                               " is not allowed";
                                                        document.getElementById("file<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>"
                                                        ).value = "";
                                                 } else {
                                                        form_data.append("file<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>",
                                                               document.getElementById("file<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>").files[0]);
                                          $.ajax({
                                                 url: "uploader/index.php?&code=22&&token=<?php echo $sfid; ?><?php echo $row_performance['target_name']; ?>&req_no=<?php echo $rfid; ?>&target=<?php echo $row_performance['target_name']; ?>",
                                                 method: "POST",
                                                 data: form_data,
                                                 contentType: false,
                                                 cache: false,
                                                 processData: false,
                                                 beforeSend: function() {
                                                        mymodalss.style
                                                               .display =
                                                               "block";
                                                 },
                                                 success: function(data) {
                                                        mymodalss.style
                                                               .display =
                                                               "none";
                                                        $("#uploaded_image<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>")
                                                               .html(data);
                                                 }
                                          });
                                   }
                            });
              });
              </script>

              <script>
                     $(document).ready(function(){
                     
                 
                     // Save data
                     $("#remark<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>").focusout(function(){
                     
                     var remark<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?> = $("#remark<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?>").val();

                     $.ajax({
                     url: 'php_action/FuncDataCreateRemark.php',
                     type: 'post',
                     data: { field: remark<?php echo $row_performance['kpi_pers_spv_up']; ?><?php echo $row_performance['target_name']; ?> , req_no: '<?php echo $rfid; ?>' , target : '<?php echo $row_performance['target_name']; ?>' , ipp_id : '<?php echo $sfid; ?>'},
                     success:function(response){
                     if(response == 1){
                            console.log('Save successfully'); 
                     }else{
                            console.log("Not saved.");
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML ="Please upload file first";
                     }
                     }
                     });
                     
                     });

                     });
              </script>
       </tbody>
       <?php } ?>
</table>


</div>

<script>
function onlyNumberKey(evt) {

       // Only ASCII character in that range allowed
       var ASCIICode = (evt.which) ? evt.which : evt.keyCode
       if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
              return false;
       return true;
}
</script>