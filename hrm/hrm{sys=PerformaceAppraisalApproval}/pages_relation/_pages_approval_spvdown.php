<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-bordered table-hover table-head-fixed">
       <thead>
              <tr>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;">No.</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;">Attitude </th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;">Bobot (B)</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Target&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                     <th style="vertical-align: middle; text-align: center; vertical-align: middle; text-align: center;">Target Mid Year</th>
                     <th nowrap="nowrap" align="center" style="background: #557c80; vertical-align: middle; text-align: center;">Actual Mid Year</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;">Target Full Year</th>
                     <th nowrap="nowrap" align="center" style="background: #557c80; vertical-align: middle; text-align: center;">Actual Full Year</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;">Attachment</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">Reviewer 1<br>Rating</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">Reviewer 2<br>Rating</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">Reviewer 3<br>Rating</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">Final Rating<br>(FR)</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(FRxB)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rating 4 (Melebihi)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rating 3 (Memenuhi)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rating 2 (Kurang Memenuhi)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                     <th nowrap="nowrap" align="center" style="vertical-align: middle; text-align: center;background: darkgray;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rating 1 (Tidak Memenuhi)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                                                 c.filename,
                                                 d.level1,
                                                 d.level2,
                                                 d.level3,
                                                 d.level4
                                          FROM
                                          hrmperf_parequest_stfsc a
                                          LEFT JOIN hrmperf_set_attitude b ON a.att_item=b.att_item
                                          LEFT JOIN hrmperf_iprecord c ON a.pa_reqno=c.ipp_reqno AND a.att_item=c.ipp_id
                                          LEFT JOIN hrdperf_set_attitude d ON a.att_item=d.att_item
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
                            <td align="right"><?php echo $row_attitude['kpi_bobot']; ?></td>
                            <td align="left"><?php echo $row_attitude['kpi_target']; ?></td>
                            <td align="right"><?php echo $row_attitude['kpi_midyear_trg']; ?></td>
                            <td align="right" style="background: #ffedcc;font-weight: bold;color: #055e05;">
                                          <?php echo $row_attitude['kpi_midyear_realisasi']; ?>
                                          <input type="hidden" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['pa_reqno']; ?>"
                                                 name="inp_attitude_spvdown_approver1[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;">
                                          
                                          <input type="hidden" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['att_item']; ?>"
                                                 id="inp_attitude_spvdown_approver2"
                                                 name="inp_attitude_spvdown_approver2[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;">

                                          <input type="hidden" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['kpi_midyear_realisasi']; ?>"
                                                 name="inp_attitude_spvdown_approver3[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>

                            <td align="right"><?php echo $row_attitude['kpi_fullyear_trg']; ?></td>
                            <td align="right" style="background: #ffedcc;font-weight: bold;color: #055e05;">

                                          <?php echo $row_attitude['kpi_fullyear_realisasi']; ?>
                                          <input type="hidden" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['kpi_fullyear_realisasi']; ?>"
                                                 name="inp_attitude_spvdown_approver4[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>

                            <td align="center" style="width: 10px;"><?php echo $dataOn; ?></span></td>

                            <td align="center" style="background: #ffedcc;">
                                          
                                          <input type="text" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['r1_rating']; ?>"
                                                 onkeypress="return onlyNumberKey(event)"
                                                 name="inp_attitude_spvdown_approver5[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>

                            <td align="center" style="background: #ffedcc;">
                                          
                                          <input type="text" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['r2_rating']; ?>"
                                                 onkeypress="return onlyNumberKey(event)"
                                                 name="inp_attitude_spvdown_approver6[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>

                            <td align="center" style="background: #ffedcc;">
                                          
                                          <input type="text" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['r3_rating']; ?>"
                                                 onkeypress="return onlyNumberKey(event)"
                                                 name="inp_attitude_spvdown_approver7[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>

                            <td align="center" style="background: #ffedcc;">
                                          
                                          <input type="text" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['final_rating']; ?>"
                                                 onkeypress="return onlyNumberKey(event)"
                                                 name="inp_attitude_spvdown_approver8[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>

                            <td align="center" style="background: #ffedcc;">
                                          
                                          <input type="text" class="form-control" autocomplete="off"
                                                 value="<?php echo $row_attitude['frb']; ?>"
                                                 name="inp_attitude_spvdown_approver9[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>


                            <td align="left"><?php echo $row_attitude['level1']; ?></td>
                            <td align="left"><?php echo $row_attitude['level2']; ?></td>
                            <td align="left"><?php echo $row_attitude['level3']; ?></td>
                            <td align="left"><?php echo $row_attitude['level4']; ?></td>
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
</table>

<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>