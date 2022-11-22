<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>
<?php $pageauthorized = "9";?>
<?php
    include "../../application/session/session.php";


    $id_event   = $_POST['id1'];
    $id_group   = $_POST['id2'];
    $descriptionId     = $_POST['id3'];
    $data_anggota   = $_POST['id4'];
    $description    = $_POST['id5'];

    $query_essay    = mysqli_query($connect, "SELECT * FROM hrmsurveytansweressay WHERE groupId = '$id_group' AND descriptionId = '$descriptionId' AND id_event = '$id_event'");
    $data_pertanyaan    = mysqli_fetch_assoc($query_essay);
    $data_actual        = mysqli_num_rows($query_essay);
?>







<div class="modal-dialog modal-bg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">DETAIL DESC</h4>
            <button type="button" onclick='return stopload()' class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="panel-body">
                    <table>
                        <!-- <thead>
                            <th></th>
                            <th style="margin-left:20px"></th>
                            <th></th>
                        </thead> -->
                        <tbody>
                            <tr>
                                <td width="150px" ><b>Target</b></td>
                                <td width="20px"><b>:</b></td>
                                <td><?php echo $data_anggota ?></td>
                            </tr>
                            <tr height="50px">
                                <td><b>Actual</b></td>
                                <td><b>:</b></td>
                                <td><?php echo $data_actual ?></td>
                            </tr>
                        </tbody>
                    </table>
			</div>

            <div class="row">
<div class="col-sm-10"></div>
<div class="col-sm-2">
<form action="export/desc_preview_export.php" method="POST" target="_blank">
                                          
                                          <input type="hidden" name="id_event" value="<?php echo $id_event; ?>">
                                          <input type="hidden" name="id_group" value="<?php echo $id_group; ?>">
                                          <input type="hidden" name="descriptionId" value="<?php echo $descriptionId; ?>">
                                          <input type="hidden" name="description" value="<?php echo $description; ?>">
                                          <input type="hidden" name="data_anggota" value="<?php echo $data_anggota; ?>">


                                                
                                                        <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="print_excel" value="submit" >
                                                        </button>
														&nbsp
														<button type="submit" class="toolbar sprite-toolbar-print" id="EXCEL" style="border: 0;background-color: white;" name="print_cetak" value="submit" >
                                                        </button>


                                                  
                                          </form>
</div>
</div>

            <div class="card-body table-responsive p-0" style="width: 100vw; width: 98.8%; margin: 5px;">
                <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <td colspan="" bgcolor='#1f65b5' class="fontCustom"><p align="center"><b style="color:white;">NO</b></p></td>
                            <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">PERTANYAAN</b></p></td>
                            <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">EMP NO</b></p></td>  
                            <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">FULLNAME</b></p></td>
                            <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">PERNYATAAN</b></p></td>
                        </tr>

                    </thead>
                    <tbody>
                        <?php 
                        $query_essay    = mysqli_query($connect, "SELECT a.*,
                        b.nama 
                        FROM hrmsurveytansweressay a 
                        LEFT JOIN users b  ON a.nip = b.username
                        WHERE groupId = '$id_group' AND descriptionId = '$descriptionId' AND id_event = '$id_event'");
                        $no = 1;
                        $no1 = substr($description,0,2);
                        $des = substr($description,3);
                        while($data_essay = mysqli_fetch_assoc($query_essay)){
                            if($no > 1){ $no1 = ''; $des = ''; }
                        
                        ?>
                        <tr>
                            <td align="center" class="fontCustom"><?php echo $no1; ?></td>
                            <td class="fontCustom"><?php echo $des; ?></td>
                            <td align="center" class="fontCustom"><?php echo $data_essay['nip'] ?></td>
                            <td class="fontCustom"><?php echo $data_essay['nama'] ?></td>
                            <td class="fontCustom"><?php echo $data_essay['jawaban'] ?></td>
                        </tr>
                       <?php $no++; } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal-footer">
            <div class="form-group">
                <button onclick='return stopload()' type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
            
    </div>
</div>


