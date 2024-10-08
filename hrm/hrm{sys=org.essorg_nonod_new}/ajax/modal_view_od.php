<?php 

include "../../../application/session/session_ess.php";

$id     = $_POST['req_id'];
$emp_no = $_SESSION['username'];


// Ambil data dari request requester
$sql_data_request   = mysqli_query($connect, "SELECT 
a.request_no,
a.request_by,
a.request_date,
a.request_division,
b.pos_name_en AS div_name,
a.request_department,
c.pos_name_en AS dept_name,
a.request_type,
CASE
   WHEN a.request_type = '1' THEN 'PENAMBAHAN'
   WHEN a.request_type = '2' THEN 'PENGHAPUSAN'
   WHEN a.request_type = '3' THEN 'PELEBURAN'
   WHEN a.request_type = '1' THEN 'PEMISAHAN'
END AS type_name,
a.status_approval,
a.request_status,
a.attch
FROM hrmorgessrequest a 
LEFT JOIN hrmorgstruc b ON b.position_id = a.request_division
LEFT JOIN hrmorgstruc c ON c.position_id = a.request_department
WHERE a.request_no = '$id'");

$data_request       = mysqli_fetch_assoc($sql_data_request);
// Ambil data dari request requester


// Ambil data dari hrmorgessrequeststruc

$sql_data_reqstruc  = mysqli_query($connect, "SELECT 
b.orgpos,
CASE
   WHEN b.orgpos = '1' THEN 'ORGUNIT'
   WHEN b.orgpos = '2' THEN 'POSITION'
END AS orgpos_name,
b.leader_pos,
b.pos_code,
g.pos_name_en AS pos_code_name,
c.pos_name_en AS leader_pos_name,
b.position_name,
b.cost_center,
b.work_location,
d.worklocation_name,
b.jobstatus_code,
e.jobstatusname_en,
b.jobtitle_code,
f.jobtitle_name_en,
b.request_reason,
b.request_remark,
h.Full_Name AS req_by,
DATE_FORMAT(b.request_date, '%d %M %Y') AS req_date
FROM hrmorgessrequest a
LEFT JOIN hrdorgessrequest b ON a.request_no = b.request_no
LEFT JOIN hrmorgstruc c ON c.position_id = b.leader_pos
LEFT JOIN teomworklocation d ON d.worklocation_code = b.work_location
LEFT JOIN teomjobstatus e ON e.jobstatuscode = b.jobstatus_code
LEFT JOIN teomjobtitle f ON f.jobtitle_code = b.jobtitle_code
LEFT JOIN hrmorgstruc g ON g.pos_code = b.pos_code
LEFT JOIN view_employee h ON h.emp_no = b.request_by
WHERE a.request_no = '$id'");

$count_data_reqstruc = mysqli_num_rows($sql_data_reqstruc);


// Ambil data dari hrmorgessrequeststruc

// Ambil data div dan dept 
$sql_parent_path     = mysqli_query($connect, "SELECT 
parent_path
FROM view_employee WHERE emp_no = '$emp_no'");

$data_parent_path   = mysqli_fetch_assoc($sql_parent_path);
$in_position        = str_replace(",", "','", $data_parent_path['parent_path']);
$final_inposition   = "'".$in_position."'";

$sql_ambil_div          = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en
FROM hrmorgstruc a 
WHERE a.position_id IN ($final_inposition)
AND (a.org_level = 'DIV')
ORDER BY a.pos_level ASC
");

$count_ambil_divisi     = mysqli_num_rows($sql_ambil_div);

$sql_ambil_dept          = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en
FROM hrmorgstruc a 
WHERE a.position_id IN ($final_inposition)
AND (a.org_level = 'DEP')
ORDER BY a.pos_level ASC
");

$count_ambil_dept     = mysqli_num_rows($sql_ambil_dept);

// Ambil data div dan dept 

// Ambil data cost center
$sql_cost_center        = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a");
// Ambil data cost center

// Ambil data work location
$sql_work_location      = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a");
// Ambil data work location

// Ambil data Job Status
$sql_job_status         = mysqli_query($connect, "SELECT 
a.jobstatuscode,
a.jobstatusname_en
FROM teomjobstatus a");
// Ambil data Job Status

// Ambil data Job Title
$sql_job_title          = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en
FROM teomjobtitle a");
// Ambil data Job Title

// Ambil data approval

$sql_data_approval   = mysqli_query($connect, "SELECT 
a.`status`,
a.request_status
FROM hrmrequestapprovalessod a 
WHERE a.request_no = '$id'
AND a.approval_list IN (SELECT 
a.pos_code
FROM view_employee a WHERE a.emp_no = '$username')");

$data_aproval       = mysqli_fetch_assoc($sql_data_approval);

// Ambil data approval

// setting disabled
if($data_request['status_approval'] != '0' || $data_request['status_approval'] == '1'){
    $disabled   = "";
}else{
    $disabled   = "none";
}
// setting disabled

// Mengambil history revision
$sql_revision   = mysqli_query($connect, "SELECT 
DATE_FORMAT(a.created_date, '%d %M %Y') AS rev_date,
b.Full_Name,
a.remarks
FROM hrmorgessreqrevisiondetail a
LEFT JOIN view_employee b ON a.created_by = b.emp_no
WHERE a.req_no = '$id'");
// Mengambil history revision


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>
<!-- Autocomplete -->
<script src="jquery.autocomplete.min.js"></script>

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



        <div class="modal-body">
        <div class="card-body table-responsive p-0" style="width: 100vw;height: 82vh; width: 98.8%; margin: 5px;overflow: scroll;">
              <!-- <form method="post" id="myform"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Request No</div>
                    <div class="col-sm-9">
                        <div class="input-group">

                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="" id="" type="Text" value="<?php echo $id; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Division</div>
                    <div class="col-sm-9">
                        <div class="input-group">

                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="" id="" type="Text" value="<?php echo $data_request['div_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Department</div>
                    <div class="col-sm-9">
                        <div class="input-group">

                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="" id="" type="Text" value="<?php echo $data_request['dept_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Type</div>
                    <div class="col-sm-9">
                        <div class="input-group">

                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="" id="" type="Text" value="<?php echo $data_request['type_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                                                   <div class="form-row">
                    <div class="col-3 name"><b >Discussiont History</b></div>
                    <div class="col-sm-9" style="margin-top:10px">

                        <?php 
                            if($data_request['request_status'] != '0'){
                        ?>
                        <a href='../hrm{sys=org.essorg_nonod}/{chat}.php?param=<?php echo $id ?>' target='_blank'><img src='../../asset/img/icons/acticon-note.png'></a>
                        <?php }else{ ?>
                            <a href='#'><img src='../../asset/img/icons/acticon-note.png'></a>
                        <?php } ?>
                    </div>
                </div>

            </fieldset>


            <fieldset id="fset_1" class="" style="display:">
                                   
            <div class="card-body table-responsive p-0" style="width: 100vw; height: 52vh; width: 98.9%; margin: 5px;overflow: scroll;">
<input type="hidden" id="parsing" value="<?php echo $data_request['request_department']; ?>">
<input type="hidden" id="req_no_penambahan" value="<?php echo $id; ?>">
<?php 
while($data_position = mysqli_fetch_assoc($sql_data_reqstruc)){ 
?>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request By</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['req_by']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Date</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['req_date']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_position['req_date']; ?></b> -->
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Position</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['position_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_position['position_name']; ?></b> -->
                    </div>
                </div>
                <?php 
                if($data_request['request_type'] =='1'){
                ?>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Organization/Position</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['orgpos_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_position['position_name']; ?></b> -->
                    </div>
                </div>
                <?php } ?>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Cost Center</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['cost_center']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Work Location</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['worklocation_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Job Status</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['jobstatusname_en']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Request Job Title</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['jobtitle_name_en']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Remarks</b></div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="view_peleburan_leader_pos" id="view_peleburan_leader_pos" type="Text" value="<?php echo $data_position['request_remark']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        <!-- <b style="font-weight:bold"><?php echo $data_position['position_name']; ?></b> -->
                    </div>
                </div>
                <hr>
                <?php } ?>
</div>

                                   
            </fieldset>
           
                                   
                                   
                            </fieldset>
                            <?php if($data_request['request_status'] != '0'){ ?>
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
                            <?php } ?>





                                                                        </div>
                        </div>
                        <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                            <?php 
                                                                            if($data_aproval['request_status'] == '5' || $data_request['status_approval'] == '4'){
                                                                                echo '';
                                                                            }else{
                                                                                if($data_aproval['status'] != '1'){
                                                                            ?>
                                                                             <button type="button" id1="<?php echo $id; ?>"
                                                                                    class="btn btn-danger btn-sm" id="approval_reject_od"
                                                                                    data-dismiss="modal">Reject</button>

                                                                             <button type="submit" id="revision"
                                                                                    class="btn btn-warning btn-sm submit" id1='<?php echo $id; ?>' id2='' data-toggle='modal' data-target='#modal-view-od-1'>Revision</button>

                                                                             <button type="submit" id="od_approve" id1="<?php echo $id; ?>"
                                                                                    class="btn btn-success btn-sm submit" data-dismiss="modal">Approved</button>
                                                                            <?php }}?>
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


    
});
</script>

 




