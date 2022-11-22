<?php 
include "../../../application/session/session_ess.php";

$username   = $_SESSION['username'];

$req_id     = $_POST['req_id'];

// Ambil data req
$sql_data_req   = mysqli_query($connect, "SELECT 
a.request_no,
CONCAT('[ ', a.request_by, ' ] ', b.Full_Name) AS req_by,
DATE_FORMAT(a.request_date, '%d %M %Y') AS req_date,
a.request_division,
a.request_department,
c.pos_name_en AS req_div,
d.pos_name_en AS req_dept,
a.position_name,
a.status_approval,
e.`type`,
a.request_status,
a.request_remark
FROM hrmorgessrequest a 
LEFT JOIN view_employee b ON a.request_by = b.emp_no
LEFT JOIN hrmorgstruc c ON a.request_division = c.position_id
LEFT JOIN hrmorgstruc d ON a.request_department = d.position_id
LEFT JOIN hrmorgessrequesttype e ON e.type_id = a.request_type
WHERE a.request_no = '$req_id'");

$data_req   = mysqli_fetch_assoc($sql_data_req);
// Ambil data req

// Ambil data approval

$sql_data_approval   = mysqli_query($connect, "SELECT 
a.`status`,
a.request_status
FROM hrmrequestapprovalessod a 
WHERE a.request_no = '$req_id'
AND a.approval_list IN (SELECT 
a.pos_code
FROM view_employee a WHERE a.emp_no = '$username')");

$data_aproval       = mysqli_fetch_assoc($sql_data_approval);

// Ambil data approval

// Ambil data attachment

$sql_data_attch_2     = mysqli_query($connect, "SELECT 
a.created_by,
b.Full_Name AS upload_by,
a.request_id,
a.file_name,
DATE_FORMAT(a.modified_date, '%d %M %Y') AS tanggal,
d.message AS remarks
FROM hrmorgesschatattachment a 
LEFT JOIN view_employee b ON a.created_by = b.emp_no
LEFT JOIN hrmorgesschat d ON a.chat_id = d.id_chat
WHERE a.request_id = '$req_id'
AND a.file_place = '2'");

$sql_data_attch_3     = mysqli_query($connect, "SELECT 
a.created_by,
b.Full_Name AS upload_by,
a.request_id,
a.file_name,
DATE_FORMAT(a.modified_date, '%d %M %Y') AS tanggal,
d.message AS remarks
FROM hrmorgesschatattachment a 
LEFT JOIN view_employee b ON a.created_by = b.emp_no
LEFT JOIN hrmorgesschat d ON a.chat_id = d.id_chat
WHERE a.request_id = '$req_id'
AND a.file_place = '3'");

// Ambil data attachment

// Mengambil history revision
$sql_revision   = mysqli_query($connect, "SELECT 
DATE_FORMAT(a.created_date, '%d %M %Y') AS rev_date,
b.Full_Name,
a.remarks
FROM hrmorgessreqrevisiondetail a
LEFT JOIN view_employee b ON a.created_by = b.emp_no
WHERE a.req_no = '$req_id'");
// Mengambil history revision
?>

<input type="hidden" id="stat_app_od" value="<?php echo $data_req['status_approval']; ?>">
<div class="modal-body">
    <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;">
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request No</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['request_no']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['request_no']; ?></b> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request By</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['req_by']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['req_by']; ?></b> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Date</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['req_date']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['req_date']; ?></b> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Division</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id1="<?php echo $data_req['request_division'] ?>"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['req_div']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['req_div']; ?></b> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Department</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id1="<?php echo $data_req['request_department'] ?>"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['req_dept']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['req_dept']; ?></b> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Position</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['position_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['position_name']; ?></b> -->
                    </div>
                </div>
		<div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Remarks</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['request_remark']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""  disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['position_name']; ?></b> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Discussiont History</b></div>
                    <div class="col-sm-9" style="margin-top:10px">
                        <!-- <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['position_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                        </div> -->
                        <?php 
                            if($data_req['request_status'] != '0'){
                        ?>
                        <a href='../hrm{sys=org.essorg_nonod}/{chat}.php?param=<?php echo $data_req['request_no'] ?>' target='_blank'><img src='../../asset/img/icons/acticon-note.png'></a>
                        <?php }else{ ?>
                            <a href='#'><img src='../../asset/img/icons/acticon-note.png'></a>
                        <?php } ?>                    </div>
                </div>
                <!-- <a href='#' id1='' id2='' class='' data-toggle='modal' id='' data-target='#modal-view-od-1'><img src='../../asset/img/icons/glasses.png'></a> -->
                
            </fieldset>

            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-5 name"><b style="font-weight:bold">Draft & Revision Documents</b></div>
                </div>
                <div class="form-row">
                    <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 98.8%; margin: 5px;overflow: scroll;">
                        <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                               <!-- <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th> -->
                                                               <th class="fontCustom" style="z-index: 1;">Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Upload By</th>
                                                               <th class="fontCustom" style="z-index: 1;">File</th>
                                                               <th class="fontCustom" style="z-index: 1;">Remarks</th>
                                                               <!-- <th class="fontCustom" style="z-index: 1;">Career Path Map</th>     -->

                                                        </tr>
                                                     

                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        while($data_attch = mysqli_fetch_assoc($sql_data_attch_2)){
                                                    ?>
                                                        <tr>
                                                            <td class='fontCustom'><?php echo $data_attch['tanggal']; ?></td>
                                                            <td class='fontCustom'><?php echo $data_attch['upload_by']; ?></td>
                                                            <td class='fontCustom'><a href="../../asset/upload/attachmentessod/<?php echo $data_attch['file_name']; ?>"><?php echo $data_attch['file_name']; ?></a></td>
                                                            <td class='fontCustom'><?php echo $data_attch['remarks'] ?></td>


                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                       

                        </table>
                    </div>
                </div>
            </fieldset>

            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-5 name"><b style="font-weight:bold">MOM Documents</b></div>
                </div>
                <div class="form-row">
                    <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 98.8%; margin: 5px;overflow: scroll;">
                        <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                               <!-- <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th> -->
                                                               <th class="fontCustom" style="z-index: 1;">Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Upload By</th>
                                                               <th class="fontCustom" style="z-index: 1;">File</th>
                                                               <th class="fontCustom" style="z-index: 1;">Meeting Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Remarks</th>
                                                               <!-- <th class="fontCustom" style="z-index: 1;">Career Path Map</th>     -->

                                                        </tr>
                                                     

                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        while($data_attch = mysqli_fetch_assoc($sql_data_attch_3)){
                                                    ?>
                                                        <tr>
                                                            <td class='fontCustom'><?php echo $data_attch['tanggal']; ?></td>
                                                            <td class='fontCustom'><?php echo $data_attch['upload_by']; ?></td>
                                                            <td class='fontCustom'><a href="../../asset/upload/attachmentessod/<?php echo $data_attch['file_name']; ?>"><?php echo $data_attch['file_name']; ?></a></td>
                                                            <td class='fontCustom'><?php echo $data_attch['tanggal']; ?></td>
                                                            <td class='fontCustom'><?php echo $data_attch['remarks'] ?></td>


                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                       

                        </table>
                    </div>
                </div>
            </fieldset>


                            <fieldset id="fset_1">
                                <div class="form-row">
                                    <div class="col-5 name"><b style="font-weight:bold">Revision History</b></div>
                                </div>
                                <div class="form-row">
                                    <div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">
                                                                <thead>
                                                                        <tr>
                                                                            <!-- <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th> -->
                                                                            <th class="fontCustom" style="z-index: 1;">Date</th>
                                                                            <th class="fontCustom" style="z-index: 1;">Rev. By</th>
                                                                            <th class="fontCustom" style="z-index: 1;">Rev. Desc</th>
                                                                           
                                                                            <!-- <th class="fontCustom" style="z-index: 1;">Career Path Map</th>     -->

                                                                        </tr>
                                                                    

                                                                </thead>
                                                                <tbody>
                                                                        <?php while($data_rev   = mysqli_fetch_assoc($sql_revision)){ ?>
                                                                        <tr>
                                                                            <td class='fontCustom'><?php echo $data_rev['rev_date']; ?></td>
                                                                            <td class='fontCustom'><?php echo $data_rev['Full_Name'] ?></td>
                                                                            <td class='fontCustom'><?php echo $data_rev['remarks']; ?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                </tbody>
                                                                    

                                        </table>
                                    </div>
                                </div>
                            </fieldset>
                           
            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                            <?php 
                                                                            if($data_aproval['request_status'] == '5' || $data_req['status_approval'] == '4'){
                                                                                echo '';
                                                                            }else{
                                                                                if($data_aproval['status'] != '1'){
                                                                            ?>
                                                                             <button type="button" id1="<?php echo $req_id; ?>"
                                                                                    class="btn btn-danger btn-sm" id="approval_reject_od"
                                                                                    data-dismiss="modal">Reject</button>

                                                                             <button type="submit" id="revision"
                                                                                    class="btn btn-warning btn-sm submit" id1='<?php echo $req_id; ?>' id2='' data-toggle='modal' data-target='#modal-view-od-1'>Revision</button>

                                                                             <button type="submit" id="od_approve" id1="<?php echo $req_id; ?>"
                                                                                    class="btn btn-success btn-sm submit" data-dismiss="modal">Approved</button>
                                                                            <?php }}?>                                                                      </div>
                                                               </div>
</div>
</div>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){

    $(document).on('click', '#revision', function(){
        var id      = $(this).attr('id1');
            //   alert(id);

        $('#title_view_od-1').html('Revisi Pengajuan Perubahan Struktur');


        $.ajax({
                     url: "ajax/revision.php",
                     type: "POST",
                            data: {
                                   id: id,
                            },
                            success: function(ajaxData) {

                                $('#tampil_view_od-1').html(ajaxData);
                                

                            }
                     });
              
       });


    
});
</script>






