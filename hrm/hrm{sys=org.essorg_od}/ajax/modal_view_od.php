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
a.request_remark,
f.costcenter_code,
f.lstworklocation,
f.jobtitle_code,
f.jobstatuscode
FROM hrmorgessrequest a 
LEFT JOIN view_employee b ON a.request_by = b.emp_no
LEFT JOIN hrmorgstruc c ON a.request_division = c.position_id
LEFT JOIN hrmorgstruc d ON a.request_department = d.position_id
LEFT JOIN hrmorgessrequesttype e ON e.type_id = a.request_type
LEFT JOIN hrmorgessrequeststruc f ON f.req_no = a.request_no
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

// Get division

$get_division   = mysqli_query($connect, "SELECT 
*
FROM hrmorgstruc a 
WHERE 
a.org_level = 'DIV'
AND a.pos_flag = '1'
AND a.position_id <> '$data_req[request_division]'
ORDER BY a.pos_level ASC");

$get_division_selected   = mysqli_query($connect, "SELECT 
*
FROM hrmorgstruc a 
WHERE 
a.org_level = 'DIV'
AND a.pos_flag = '1'
AND a.position_id = '$data_req[request_division]'
ORDER BY a.pos_level ASC");

// Get division

// Get departement

$get_department   = mysqli_query($connect, "SELECT 
*
FROM hrmorgstruc a 
WHERE 
a.org_level = 'DEP'
AND a.pos_flag = '1'
AND a.parent_path LIKE '%$data_req[request_division]%'
AND a.position_id <> '$data_req[request_department]'
ORDER BY a.pos_level ASC");

$get_department_selected   = mysqli_query($connect, "SELECT 
*
FROM hrmorgstruc a 
WHERE 
a.org_level = 'DEP'
AND a.pos_flag = '1'
AND a.parent_path LIKE '%$data_req[request_division]%'
AND a.position_id = '$data_req[request_department]'
ORDER BY a.pos_level ASC");

// Cost center
$get_costcenter     = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a
WHERE a.costcenter_code <> '$data_req[costcenter_code]'");

$get_costcenter_selected     = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a
WHERE a.costcenter_code = '$data_req[costcenter_code]'");

// Worklocation
$get_worklocation           = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a 
WHERE a.worklocation_code <> '$data_req[lstworklocation]'");

$get_worklocation_selected           = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a 
WHERE a.worklocation_code = '$data_req[lstworklocation]'");

// Job Status
$get_jobstatus          = mysqli_query($connect, "SELECT 
a.jobstatuscode,
a.jobstatusname_en
FROM teomjobstatus a 
WHERE a.jobstatuscode <> '$data_req[jobstatuscode]'");

$get_jobstatus_selected          = mysqli_query($connect, "SELECT 
a.jobstatuscode,
a.jobstatusname_en
FROM teomjobstatus a 
WHERE a.jobstatuscode = '$data_req[jobstatuscode]'");

// Job title
$get_jobtitle           = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en
FROM teomjobtitle a
WHERE a.jobtitle_code <> '$data_req[jobtitle_code]'");

$get_jobtitle_selected           = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en
FROM teomjobtitle a
WHERE a.jobtitle_code = '$data_req[jobtitle_code]'");

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

<script src="jquery.autocomplete.min.js"></script>
<script src="../hrm{sys=org.essorg}/vendor/select2.min.js"></script>
<link href="../hrm{sys=org.essorg}/vendor/select2.min_2.css" rel="stylesheet" />
<link rel="stylesheet" href="../hrm{sys=org.essorg}/vendor/select2-bootstrap4.min.css">




<style>
            
            
            input[type=text] {
                
            }
            input[type=text]:focus {
                border: 2px solid #757575;
            	outline: none;
            }
            .autocomplete-suggestions {
                border: 1px solid #999;
                background: #FFF;
                overflow: auto;
            }
            .autocomplete-suggestion {
                padding: 2px 5px;
                white-space: nowrap;
                overflow: hidden;
            }
            .autocomplete-selected {
                background: #F0F0F0;
            }
            .autocomplete-suggestions strong {
                font-weight: normal;
                color: #3399FF;
            }
            .autocomplete-group {
                padding: 2px 5px;
            }
            .autocomplete-group strong {
                display: block;
                border-bottom: 1px solid #000;
            }
        </style>

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
                            <select class="input--style-6" name="view_div_req" id="view_div_req" style="width: ;height: 30px;" >
                            <?php 
                                while($data_div = mysqli_fetch_assoc($get_division)){
                            ?>
                            <option value="<?php echo $data_div['position_id'] ?>"><?php echo $data_div['pos_name_en'] ?></option>
                            <?php } ?>
                            <?php 
                                while($data_div_select = mysqli_fetch_assoc($get_division_selected)){
                            ?>
                            <option value="<?php echo $data_div_select['position_id'] ?>" selected><?php echo $data_div_select['pos_name_en'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['req_div']; ?></b> -->
                    </div>
                </div>
               
                
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Department</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <select class="input--style-6" name="view_dept_req" id="view_dept_req" style="width: ;height: 30px;" >
                            <?php 
                                while($data_dept = mysqli_fetch_assoc($get_department)){
                            ?>
                            <option value="<?php echo $data_dept['position_id'] ?>"><?php echo $data_dept['pos_name_en'] ?></option>
                            <?php } ?>
                            <?php 
                                while($data_dept_select = mysqli_fetch_assoc($get_department_selected)){
                            ?>
                            <option value="<?php echo $data_dept_select['position_id'] ?>" selected><?php echo $data_dept_select['pos_name_en'] ?></option>
                            <?php } ?>
                            </select>
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
                                                               name="view_req_position" id="view_req_position" type="Text" value="<?php echo $data_req['position_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_req['position_name']; ?></b> -->
                    </div>
                </div>

		<div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Cost Center</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <select class="input--style-6" name="view_cc" id="view_cc" style="width: ;height: 30px;" >
                            <?php 
                                while($data_cc = mysqli_fetch_assoc($get_costcenter)){
                            ?>
                            <option value="<?php echo $data_cc['costcenter_code'] ?>"><?php echo $data_cc['costcenter_name_en'] ?></option>
                            <?php } ?>
                            <?php 
                                while($data_cc_select = mysqli_fetch_assoc($get_costcenter_selected)){
                            ?>
                            <option value="<?php echo $data_cc_select['costcenter_code'] ?>" selected><?php echo $data_cc_select['costcenter_name_en'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Work Location</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <select class="input--style-6" name="view_worklocation" id="view_worklocation" style="width: ;height: 30px;" >
                            <?php 
                                while($data_worklocation = mysqli_fetch_assoc($get_worklocation)){
                            ?>
                            <option value="<?php echo $data_worklocation['worklocation_code'] ?>"><?php echo $data_worklocation['worklocation_name'] ?></option>
                            <?php } ?>
                            <?php 
                                while($data_worklocation_select = mysqli_fetch_assoc($get_worklocation_selected)){
                            ?>
                            <option value="<?php echo $data_worklocation_select['worklocation_code'] ?>" selected><?php echo $data_worklocation_select['worklocation_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Job Status</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <select class="input--style-6" name="view_jobstatus" id="view_jobstatus" style="width: ;height: 30px;" >
                            <?php 
                                while($data_jobstatus = mysqli_fetch_assoc($get_jobstatus)){
                            ?>
                            <option value="<?php echo $data_jobstatus['jobstatuscode'] ?>"><?php echo $data_jobstatus['jobstatusname_en'] ?></option>
                            <?php } ?>
                            <?php 
                                while($data_jobstatus_select = mysqli_fetch_assoc($get_jobstatus_selected)){
                            ?>
                            <option value="<?php echo $data_jobstatus_select['jobstatuscode'] ?>" selected><?php echo $data_jobstatus_select['jobstatusname_en'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Job Title</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <select class="input--style-6" name="view_jobtitle" id="view_jobtitle" style="width: ;height: 30px;" >
                            <?php 
                                while($data_jobtitle = mysqli_fetch_assoc($get_jobtitle)){
                            ?>
                            <option value="<?php echo $data_jobtitle['jobtitle_code'] ?>"><?php echo $data_jobtitle['jobtitle_name_en'] ?></option>
                            <?php } ?>
                            <?php 
                                while($data_jobtitle_select = mysqli_fetch_assoc($get_jobtitle_selected)){
                            ?>
                            <option value="<?php echo $data_jobtitle_select['jobtitle_code'] ?>" selected><?php echo $data_jobtitle_select['jobtitle_name_en'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Remarks</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_req['request_remark']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
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
                            <a href='../hrm{sys=org.essorg_od}/{chat}.php?param=<?php echo $data_req['request_no']; ?>' target='_blank'><img src='../../asset/img/icons/acticon-note.png'></a>
                        <?php }else{ ?>
                            <a href='#'><img src='../../asset/img/icons/acticon-note.png'></a>
                        <?php } ?>
                    </div>
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
                                                                            if($data_aproval['request_status'] != '5'){
                                                                                if($data_aproval['status'] != '1'){
                                                                                    if($data_req['status_approval'] == '2'){
                                                                            ?>
                                                                             <button type="button" id1="<?php echo $req_id; ?>"
                                                                                    class="btn btn-danger btn-sm" id="approval_reject_od"
                                                                                    data-dismiss="modal">Reject</button>

                                                                             <button type="submit" id="revision"
                                                                                    class="btn btn-warning btn-sm submit" id1='<?php echo $req_id; ?>' id2='' data-toggle='modal' data-target='#modal-view-od-1'>Revision</button>
                                                                            
                                                                          
                                                                             <button type="submit" id="od_approve" id1="<?php echo $req_id; ?>"
                                                                             
                                                                                    class="btn btn-success btn-sm submit" data-dismiss="modal">Approved</button>
                                                                                
                                                                            <?php }}}?>
                                                                      </div>
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


       $(document).on('change', '#view_div_req', function(){
            var position_id     = $(this).val();

            $.ajax({
                    url:"ajax/get_division.php",
                    method:"POST",
                    data:{position_id:position_id},
                    success:function(data1){

                        // $('#view_dept_req').empty();
                        // $('#view_dept_req').select2({
                        //     data: data
                        // });
                        $('#view_dept_req').html(data1);
                        // $('#view_dept_req').val(null).trigger('change.select2');
                    }

            });

            
              
       });


    
});
</script>

<!-- Mengambil Division -->
<script type="text/javascript">
            // $(document).ready(function() {
            //     // var id      = $('#save_otorisasi').val();
            //     // Selector input yang akan menampilkan autocomplete.
            //     $( "#view_div_req" ).autocomplete({
            //         serviceUrl: "ajax/get_division.php?",   // Kode php untuk prosesing data.
            //         dataType: "JSON",           // Tipe data JSON.
            //         data: {
            //             position_id : $("#view_div_req").val()
            //         },
            //         onSelect: function (suggestion) {
            //             $( "#view_div_req" ).val("" + suggestion.value);
            //             $( "#view_div_req" ).attr('id1', suggestion.parent);

            //             const tampil_div_req = $("#display_change_div_req");
            //             tampil_div_req.css("display", "");
            //         }
            //     });
            // })
$(document).ready(function() {
            $("#view_div_req").autocomplete({
                source: function(request, response) {
                    $.getJSON("ajax/get_division.php", { position_id: $('#view_div_req').val() }, 
                            response);
                },
                minLength: 2,
                // select: function(event, ui){
                //     //action
                // }
                        onSelect: function (suggestion) {
                        $( "#view_div_req" ).val("" + suggestion.value);
                        $( "#view_div_req" ).attr('id1', suggestion.parent);

                        const tampil_div_req = $("#display_change_div_req");
                        tampil_div_req.css("display", "");
                    }
            });
 });
</script>
<!-- Mengambil Division -->

<script>
            $(document).ready(function () {
                $("#view_div_req").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
    
                $("#view_dept_req").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
            });
</script>







