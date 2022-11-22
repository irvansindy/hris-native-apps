<script>
$(document).ready(function() {
       var sum = 0;
       $(".kpi_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal1").val(sum);
        document.getElementById("total_request_spv_down_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_request_spv_down_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_request_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpi_spv_down", function() {
       var sum = 0;
       $(".kpi_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal1").val(sum);
       document.getElementById("total_request_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgmidyear_spv_down", function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_request_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgfullyear_spv_down", function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_request_spv_down_print").innerHTML = sum;
});
</script>



<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-bordered table-hover table-head-fixed">
       <thead>
              <tr>
                     <th>No.</th>
                     <th>Attitude </th>
                     <th>Bobot (B)</th>
                     <th>Target</th>
                     <th>Target Mid Year</th>
                     <th style="background: #d6dce4;color: black;font-weight: bold;">Actual Mid Year</th>
                     <th>Target Full Year</th>
                     <th style="background: #d6dce4;color: black;font-weight: bold;">Actual Full Year</th>
                     <th>Attachment</th>
                     <th>Upload</th>
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
                                          b.att_name,
                                          c.filename
                                                 FROM
                                          hrmperf_parequest_stfsc a
                                          LEFT JOIN hrmperf_set_attitude b on a.att_item=b.att_item
                                          LEFT JOIN hrmperf_iprecord c ON a.pa_reqno=c.ipp_reqno AND a.att_item=c.ipp_id
                                          WHERE a.pa_reqno = '$rfid'
                                          GROUP BY b.att_item
                                          ORDER BY a.att_item ASC");
	while($row_attitude = mysqli_fetch_array($modal)){

              $data = $row_attitude['filename'];
              if($data != ''){
                     $dataOn = '<a href="../../../asset/request.file.appraisal.attachment/'.$row_attitude['filename'].'"><img style="width: 100%;" src="../../../asset/request.file.appraisal.attachment/excel.png" height="425" width="425" class="img-thumbnail"/></a>';
              } else {
                     $dataOn = '<span id="uploaded_image'.$row_attitude['att_item'].'" style="15%";></span>';
              }
       ?>


              <div class="input-group">
                     <tr id="recs-1">
                            <td><?php echo $no++; ?>.</td>
                            <td align="left"><?php echo $row_attitude['att_name']; ?></td>
                            <input readonly type="hidden" class="form-control kpi_spv_down" autocomplete="off" id="spv_down<?php echo $row_no; ?>"
                                          onchange="addspv_down()" value="<?php echo $row_attitude['kpi_bobot']; ?>">
                            <td align="right">
                                          <?php echo $row_attitude['kpi_bobot']; ?></td>
                            <td align="left"><?php echo $row_attitude['kpi_target']; ?></td>
                            <td align="right"><?php echo $row_attitude['kpi_midyear_trg']; ?></td>
                            <td align="center" style="background: #ffedcc;">
                                          <input type="hidden" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['pa_reqno']; ?>"
                                                 name="inp_attitude_spvdown_approver1[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;">
                                          
                                          <input type="hidden" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['att_item']; ?>"
                                                 id="inp_attitude_spvdown_approver2"
                                                 name="inp_attitude_spvdown_approver2[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;">

                                          <input required type="text" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['kpi_midyear_realisasi']; ?>"
                                                 name="inp_attitude_spvdown_approver3[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>

                            <td align="right"><?php echo $row_attitude['kpi_fullyear_trg']; ?></td>
                            <td align="center" style="background: #ffedcc;">
                                          
                                          <input required type="text" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['kpi_fullyear_realisasi']; ?>"
                                                 name="inp_attitude_spvdown_approver4[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>

                            <td align="right" style="width: 10px;"><?php echo $dataOn; ?></span></td>
                            <td align="center"><form action="#">
                                                 <div class="input-file-container">  
                                                 <input class="input-file" id="file<?php echo $row_attitude['att_item']; ?>" name="file<?php echo $row_attitude['att_item']; ?>" type="file">
                                                 <br>
                                                 </div>
                                                 <p class="file-return"></p>
                                                 </form>

                                                <span class="badge badge-Fully-Approved" style="width: 100%;background: #ffc107;font-weight: bold;color: black;text-align: left;font-size: 10px;">1. Only for Excel and document type (.xls)<br>2. 3MB Max file size</span>
                            </td>
                     </tr>
                  
                     <script>
                     $(document).ready(function(){
                     $(document).on("change", "#file<?php echo $row_attitude['att_item']; ?>", function(){
                     var name = document.getElementById("file<?php echo $row_attitude['att_item']; ?>").files[0].name;
                     var form_data = new FormData();
                     var ext = name.split(".").pop().toLowerCase();
                     var oFReader = new FileReader();
                     oFReader.readAsDataURL(document.getElementById("file<?php echo $row_attitude['att_item']; ?>").files[0]);
                     var f = document.getElementById("file<?php echo $row_attitude['att_item']; ?>").files[0];
                     var fsize = f.size||f.fileSize;
                     if(jQuery.inArray(ext, ["xls"]) == -1)
                     {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "Invalid type of file";
                            document.getElementById("file<?php echo $row_attitude['att_item']; ?>").value = "";
                     }
                     else if(fsize > 2000000)
                     {
                            modals.style.display = "block";
                            document.getElementById("msg").innerHTML = "File to large, size : " + fsize + " is not allowed";
                            document.getElementById("file<?php echo $row_attitude['att_item']; ?>").value = "";
                     }
                     else
                     {
                     form_data.append("file<?php echo $row_attitude['att_item']; ?>", document.getElementById("file<?php echo $row_attitude['att_item']; ?>").files[0]);
                     $.ajax({
                                          url:"uploader/index.php?&code=22&token=&token=<?php echo $row_attitude['att_item']; ?>&req_no=<?php echo $rfid; ?>",
                                                 method:"POST",
                                                 data: form_data,
                                                 contentType: false,
                                                 cache: false,
                                                 processData: false,
                                                 beforeSend:function(){
                                                        mymodalss.style.display = "block";
                                                 },
                                                 success:function(data)
                                                 {
                                                        mymodalss.style.display = "none";
                                                        $("#uploaded_image<?php echo $row_attitude['att_item']; ?>").html(data);
                                                 }
                                          });
                                   }
                            });
                     });
                     </script>
       </tbody>

       </div>
       </div>
       </div>
       </div>
       </div>
       <?php } ?>
                                   <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                          <td colspan="2" style="font-weight: bold;color: green;text-align: center;">Total</td>
                                          <td align="center">
                                                 <div id="total_request_spv_down_print" style="font-weight: bold;text-align: right;color: #056805;">0</div>
                                                 <input type="hidden" name="total_request_spv_down" id="total_request_spv_down"
                                                        class="form-control subTotal1 subTotal"
                                                        style="border: 1px solid #d7d7d7;text-align: right;">
                                          </td>
                                          <td colspan="7">&nbsp;</td>
                                   </tr>
</table>

