<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>
<!-- LOADER -->
<div onclick='return stopload()' id="loading-circle"></div>
<!-- LOADER -->



<?php  
       
       
       // jika nip dan nama terisi
       $id_event     = !empty($_POST['tevent']) ? $_POST['tevent'] : '';
       $treport      = !empty($_POST['treport']) ? $_POST['treport'] : '';
       $tdisplay     = !empty($_POST['tdisplay']) ? $_POST['tdisplay'] : '';

       if (!empty($_POST['nip']) && !empty($_POST['full_name'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empnip :"."'".$mynip."' ,empname :"."'".$myname."'";
       // jika nip saja yang terisi
       } elseif (!empty($_POST['nip'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empnip :"."'".$mynip."'";
       // jika nama saja yang terisi
       } elseif (!empty($_POST['full_name'])) {
              $mynip = $_POST['nip'];
              $myname = $_POST['full_name'];
              $frameworks = ",empname :"."'".$myname."'";
       // jika tidak ada yang terisi
       } else { 
              $frameworks = "";
       }
?>





<div class="col-md-12">
       <div class="card">
              <div class="card-header">
                     <form method="post" action="" onSubmit="return validasi(this)" class="form-horizontal" >
                            <br>
                            <div class="form-row">
                                   <div class="col-sm-2">Event Survey</div>
                                   <div class="col-sm-5">
                                          <div class="input-group">
                                                 <select name="tevent" id="tevent" class="input--style-6 urgent_reason"
                                                        style="margin-bottom: 2px; width: 100%;height: 30px;">
                                                        <option>--Pilih Event Survey--</option>
                                                        <?php 
                                                               $query_event  = mysqli_query($connect, "SELECT * FROM hrmsurveyevent WHERE status = '1' AND id_event NOT IN (
										SELECT DISTINCT id_event FROM hrmsurveygrouppertanyaan WHERE tipejawaban IN('2','3','4'))");
                                                               while($data_event    = mysqli_fetch_assoc($query_event)){
                                                        ?>
                                                        <option value="<?php echo $data_event['id_event'] ?>" <?php if($id_event == $data_event['id_event']){ echo 'selected';} ?>><?php echo $data_event['judul']; ?></option>
                                                        <?php } ?>
                                                 </select>
                                          </div>
                                   </div>
                            </div>
                            <div class="form-row">
                                   <div class="col-sm-2">Type of Report</div>
                                   <div class="col-sm-5">
                                          <div class="input-group">
                                                 <select name="treport" id="treport" class="input--style-6 urgent_reason"
                                                        style="margin-bottom: 2px; width: 100%;height: 30px;">
                                                        <option>--Pilih Tipe Report--</option>
                                                        <option value="scale" <?php if($treport == 'scale'){ echo 'selected';} ?>>SCALE</option>
                                                        <option value="desc" <?php if($treport == 'desc'){ echo 'selected';} ?>>DESC</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>
                            <div class="form-row">
                                   <div class="col-sm-2">Type of Display</div>
                                   <div class="col-sm-5">
                                          <div class="input-group">
                                                 <select name="tdisplay" id="tdisplay" class="input--style-6 urgent_reason"
                                                        style="margin-bottom: 2px; width: 100%;height: 30px;">
                                                        <option>--Pilih Tipe Display--</option>
                                                        <option value="summary" <?php if($tdisplay == 'summary'){ echo 'selected';} ?>>SUMMARY</option>
                                                        <option value="all" <?php if($tdisplay == 'all'){ echo 'selected';} ?>>ALL</option>
                                                 </select>
                                          </div>
                                   </div>
                            </div>
                            <br>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                   <div class="form-group">        
                                          &nbsp&nbsp<button type="submit" name="submit_tampilkan" class="btn btn-info">Tampilkan</button>
                                   </div>
                            </div>
                     </form>
                       

                     <!-- <div class="card-actions ml-auto">
                                        
                     </div> -->
              </div>

              <div class="card-body table-responsive p-0" style="width: 100vw; width: 98.8%; margin: 5px;">
                                        <!-- <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;"  nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Nama Group</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Group ID</th>
                                                               <th class="fontCustom" style="z-index: 1;" >Aksi</th>
                                                        </tr>

                                                </thead>
                     
                                        </table> -->
                     
                     <?php if($treport == 'scale' && $tdisplay == 'summary') { ?>
                            
                            <?php include "report_scale_summary.php"; ?>

                     <?php } ?>

                     <?php if($treport == 'scale' && $tdisplay == 'all') { ?>
                            
                            <?php include "report_scale_all.php"; ?>

                     <?php } ?>

                     <?php if($treport == 'desc' && $tdisplay == 'summary') { ?>
                            
                            <?php include "report_desc_summary.php"; ?>

                     <?php } ?>

                     <?php if($treport == 'desc' && $tdisplay == 'all') { ?>
                            
                            <?php include "report_desc_all.php"; ?>

                     <?php } ?>


                                        

              </div>

              
       </div>
</div>
                            <!-- Column -->


<?php 
// include "controller/aksi_edit.php";
?>

                            

        


<script type="text/javascript">
$(document).ready(function() {
       bsCustomFileInput.init();
});
</script>


<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                   aria-hidden="true">
                            </div>