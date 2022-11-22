<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-hover table-bordered table-head-fixed table-striped" id="tbl_posts">
	<thead>
		<tr>
			<th style="text-align: center;" rowspan="2">Perspektif</th>
			<th style="text-align: center;" rowspan="2">KPI</th>
			<th style="text-align: center;" rowspan="2">Unit</th>
			<th style="text-align: center;" nowrap="nowrap" rowspan="2">Bobot KPI / KPI<br />
			Weight (%) (B)</th>
			<th style="text-align: center;" nowrap="nowrap" rowspan="2">Target Mid<br>Year</th>
			<th style="text-align: center;" nowrap="nowrap" rowspan="2">Target Full<br>Year</th>
			<th style="text-align: center;background: #fff2cc;color:black;font-weight:bold;" nowrap="nowrap" colspan="2" rowspan="1">Performance Review (Mid Year)</th>
			<th style="text-align: center;background: #d6dce4;color:black;font-weight:bold;" nowrap="nowrap" colspan="2" rowspan="1">Performance Review (Full Year)</th>
			<th style="text-align: center; background: #bdbdbd;" rowspan="2">Reviewer Rating<br>(RR)</th>
                     <th style="text-align: center; background: #bdbdbd;" rowspan="2">Total Rating<br>(B x RR))</th>
                     <th style="text-align: center;" rowspan="2">Periodical Review</th>
			<th style="text-align: center;" rowspan="2">Attachment</th>
			<!-- <th style="text-align: center;" rowspan="2">Upload</th> -->
			<th style="text-align: center;" rowspan="2">Remarks</th>
			<th style="text-align: center;" rowspan="2">LG</th>
		</tr>
		<tr>
			<th style="text-align: center;background: #fff2cc;black;font-weight:bold; " >Realisasi/ <br>Realization</th>
			<th style="text-align: center;background: #fff2cc;black;font-weight:bold;" >Realization <br>vs Target</th>
			<th style="text-align: center;background: #d6dce4;black;font-weight:bold;" >Realisasi/ <br>Realization</th>
			<th style="text-align: center;background: #d6dce4;black;font-weight:bold;" >Realization <br>vs Target</th>
		</tr>
	</thead>


                                                               <?php
                                                                      include "../../../application/config.php";
                                                                      $rfid = $_GET['rfid'];
                                                                      //$modal_id = '1';
                                                                      $no = 1;
                                                                      $modal=mysqli_query($connect, "SELECT
                                                                                                         a.*,
                                                                                                         b.perspektif_name,
                                                                                                         b.perspektif_code,
                                                                                                         c.kpiunit_name,
                                                                                                         d.orgkpitype_name,
                                                                                                         e.reviewperiod_name,
                                                                                                         f.filename,
                                                                                                         g.ip_period,
                                                                                                         h.pa_midyear_realisasi,
                                                                                                         h.pa_midyear_rvt,
                                                                                                         h.pa_fullyear_realisasi,
                                                                                                         h.pa_fullyear_rvt,
                                                                                                         h.pa_rr,
                                                                                                         h.pa_brr,
                                                                                                         i.var1
                                                                                                                FROM
                                                                                                                       hrdperf_ipprequest a
                                                                                                                       LEFT JOIN hrmperf_set_kpiperspektif b on a.kpi_perspektif_id=b.perspektif_id
                                                                                                                       LEFT JOIN hrmperf_set_kpiunit c on a.kpi_unit=c.kpiunit_id
                                                                                                                       LEFT JOIN hrmperf_set_orgkpitype d on a.kpi_type_id=d.orgkpitype_id
                                                                                                                       LEFT JOIN hrmperf_set_reviewperiod e on e.reviewperiod_id=a.kpi_reviewperiod_id
                                                                                                                       LEFT JOIN hrmperf_iprecord f ON a.ipp_reqno=f.ipp_reqno AND a.ipp_id=f.ipp_id
                                                                                                                       LEFT JOIN hrmperf_ipprequest g ON a.ipp_reqno=g.ipp_reqno
                                                                                                                       LEFT JOIN hrmperf_parequest h ON a.ipp_reqno=h.ipp_reqno AND a.kpi_perspektif_id=h.ipp_id
                                                                                                                       LEFT JOIN db_config_str i on a.kpi_lg=i.remark AND i.id IN ('15','16')
                                                                                                                       WHERE a.ipp_reqno = '$rfid'
                                                                                                                       GROUP BY a.ipp_id
                                                                                                                       ORDER BY a.ipp_id ASC");

                                                                      while($row_performance = mysqli_fetch_array($modal)){

                                                                             $data = $row_performance['filename'];
                                                                             if($data != ''){
                                                                                    $dataOn = '<a href="../../../asset/request.file.appraisal.attachment/'.$row_performance['filename'].'"><img style="width: 100%;" src="../../../asset/request.file.appraisal.attachment/excel.png" height="425" width="425" class="img-thumbnail"/></a>';
                                                                             } else {
                                                                                    $dataOn = '<span id="uploaded_image'.$row_performance['ipp_id'].'" style="15%";></span>';
                                                                             }
                                                               ?>
                                                               <tbody id="tbl_posts_body">
                                                                      <tr id="rec-1" style="display:none;">
                                                                             <td style="text-align: center;"><input type="text" value="<?php echo $row_performance['ip_period']; ?>" name="inp_performance_spvup_approver0[]"></td>       
                                                                             <td style="text-align: center;"><input type="text" value="<?php echo $row_performance['ipp_reqno']; ?>" name="inp_performance_spvup_approver1[]"></td>
                                                                             <td style="text-align: center;"><input type="text" value="<?php echo $row_performance['ipp_id']; ?>" name="inp_performance_spvup_approver2[]"></td>
                                                                      </tr>
                                                                      <tr id="rec-1">
                                                                             <td style="text-align: center;"><?php echo $row_performance['perspektif_name']; ?><br>( <?php echo $row_performance['perspektif_code']; ?> )</td>
                                                                             <td nowrap="nowrap" align="left"><?php echo $row_performance['kpi_name']; ?></td>
                                                                             <td align="center"><?php echo $row_performance['kpiunit_name']; ?></td>
                                                                             <td align="right"><?php echo $row_performance['kpi_bobot']; ?></td>
                                                                             <td align="right"><?php echo $row_performance['kpi_midyear_trg']; ?></td>
                                                                             <td align="right"><?php echo $row_performance['kpi_fullyear_trg']; ?></td>
                                                                             <td><input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" value="<?php echo $row_performance['pa_midyear_realisasi']; ?>" name="inp_performance_spvup_approver3[]" style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                                                             <td><input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" value="<?php echo $row_performance['pa_midyear_rvt']; ?>" name="inp_performance_spvup_approver4[]" style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                                                             <td><input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" value="<?php echo $row_performance['pa_fullyear_realisasi']; ?>" name="inp_performance_spvup_approver5[]" style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                                                             <td><input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" value="<?php echo $row_performance['pa_fullyear_rvt']; ?>" name="inp_performance_spvup_approver6[]" style="border: 1px solid #d7d7d7;text-align: right;"></td>

                                                                             <td align="center"><textarea class="form-control" rows="5" name="inp_performance_spvup_approver7[]" style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['pa_rr']; ?></textarea></td>
                                                                             <td align="center"><textarea class="form-control" rows="5" name="inp_performance_spvup_approver8[]" style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['pa_brr']; ?></textarea></td>
                                                                             <td align="center"><?php echo $row_performance['reviewperiod_name']; ?></td>
                                                                             

                                                                             <td align="center" style="width: 10px;"><?php echo $dataOn; ?></span></td>
                                                                             <!-- <td align="center"><form action="#">
                                                                                                  <div class="input-file-container">  
                                                                                                  <input class="input-file" id="file<php echo $row_performance['ipp_id']; ?>" name="file<php echo $row_performance['ipp_id']; ?>" type="file">
                                                                                                  <br>
                                                                                                  </div>
                                                                                                  <p class="file-return"></p>
                                                                                                  </form>
                                                                             </td> -->
                                                                             <td><?php echo $row_performance['remark']; ?></td>
                                                                             <td>
                                                                             <select readonly class="form-control" id="inp_performance_spvup_approver9" name="inp_performance_spvup_approver9[]"
                                                                                           onfocus="hlentry(this)" onchange="formodified(this);"
                                                                                           style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                                                                           <option value="<?php echo $row_performance['kpi_lg']; ?>"><?php echo $row_performance['var1']; ?></option>
                                                                                           <!-- <php
                                                                                                  $sql = mysqli_query($connect, "SELECT var1 FROM db_config_str WHERE var1 <> '$row_performance[var1]' AND id IN ('15','16')");
                                                                                                  $row = mysqli_num_rows($sql);
                                                                                                  while ($row = mysqli_fetch_array($sql)){
                                                                                                         echo "<option value='". $row['var1'] ."'>" .$row['var1'] ."</option>" ;
                                                                                                  }
                                                                                           ?> -->
                                                                                    </select>
                                                                      
                                                                             </td>
                                                                      </tr>
                                                                      <script>
                                                                      $(document).ready(function(){
                                                                      $(document).on("change", "#file<?php echo $row_performance['ipp_id']; ?>", function(){
                                                                      var name = document.getElementById("file<?php echo $row_performance['ipp_id']; ?>").files[0].name;
                                                                      var form_data = new FormData();
                                                                      var ext = name.split(".").pop().toLowerCase();
                                                                      var oFReader = new FileReader();
                                                                      oFReader.readAsDataURL(document.getElementById("file<?php echo $row_performance['ipp_id']; ?>").files[0]);
                                                                      var f = document.getElementById("file<?php echo $row_performance['ipp_id']; ?>").files[0];
                                                                      var fsize = f.size||f.fileSize;
                                                                      if(jQuery.inArray(ext, ["xls"]) == -1)
                                                                      {
                                                                             modals.style.display = "block";
                                                                             document.getElementById("msg").innerHTML = "Invalid type of file";
                                                                             document.getElementById("file<?php echo $row_performance['ipp_id']; ?>").value = "";
                                                                      }
                                                                      else if(fsize > 2000000)
                                                                      {
                                                                             modals.style.display = "block";
                                                                             document.getElementById("msg").innerHTML = "File to large, size : " + fsize + " is not allowed";
                                                                             document.getElementById("file<?php echo $row_performance['ipp_id']; ?>").value = "";
                                                                      }
                                                                      else
                                                                      {
                                                                      form_data.append("file<?php echo $row_performance['ipp_id']; ?>", document.getElementById("file<?php echo $row_performance['ipp_id']; ?>").files[0]);
                                                                      $.ajax({
                                                                                           url:"uploader/index.php?&code=22&token=&token=<?php echo $row_performance['ipp_id']; ?>&req_no=<?php echo $rfid; ?>",
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
                                                                                                         $("#uploaded_image<?php echo $row_performance['ipp_id']; ?>").html(data);
                                                                                                  }
                                                                                           });
                                                                                    }
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