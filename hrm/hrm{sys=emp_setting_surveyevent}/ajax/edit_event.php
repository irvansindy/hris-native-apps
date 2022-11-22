<?php 
include "../../../application/session/session_ess.php";

date_default_timezone_set('Asia/Bangkok'); 
$year_now             = date("Y");
$year_after1           = $year_now+1;
$year_after2           = $year_now+2;
$year_after3           = $year_now+3;

$year_before1           = $year_now-1;
$year_before2           = $year_now-2;
$year_before3           = $year_now-3;

$id                   = $_POST['id'];

$sql_get_event        = mysqli_query($connect, "SELECT 
a.id,
a.id_event,
a.judul,
a.tahun,
a.divisi,
a.dept,
a.target,
a.`status`,
a.start_date,
a.end_date
FROM hrmsurveyevent a
WHERE a.id = '$id'");

$get_event            = mysqli_fetch_assoc($sql_get_event);

// ambil anggota
$user = mysqli_query($connect, "SELECT username, nama FROM users 
WHERE 
username NOT IN (SELECT 
a.nip
FROM hrmsurveyanggotaevent a WHERE a.id_event = '$get_event[id_event]')
order by username ASC");

$user_selected = mysqli_query($connect, "SELECT username, nama FROM users 
WHERE 
username IN (SELECT 
a.nip
FROM hrmsurveyanggotaevent a WHERE a.id_event = '$get_event[id_event]')
order by username ASC");
// End ambil anggota

// Ambil group pertanyaan
$sql_get_gpertanyaan    = mysqli_query($connect, "SELECT 
a.id_group,
a.tipejawaban,
a.`order`
FROM hrmsurveygrouppertanyaan a
WHERE 
a.id_event = '$get_event[id_event]'");
//End Ambil group pertanyaan

// Ambil group essay
$sql_get_gessay         = mysqli_query($connect, "SELECT 
a.id_group,
a.`order`
FROM hrmsurveygroupessay a 
WHERE a.id_event = '$get_event[id_event]'");

$count_gessay           = mysqli_num_rows($sql_get_gessay);

$val        = '0';
$check      = '';
$display    = 'none';
if($count_gessay > 0){
    $val        = '1';
    $check      = 'checked';
    $display    = '';
}
//End Ambil group essay

?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
<!-- <script src="../../asset/gt_developer/asset_use/jquery-1.11.3.min.js"></script> -->
<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>



<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Judul *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_judul" id="edit_judul" type="Text" value="<?php echo $get_event['judul']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Tahun *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="edit_tahun" id="edit_tahun" style="width: ;height: 27px;">
                                <option value="">--SELECT ONE--</option>
                                <option value="<?php echo $year_before3 ?>" <?php if($get_event['tahun'] == $year_before3){ echo 'selected'; } ?>><?php echo $year_before3 ?></option>
                                <option value="<?php echo $year_before2 ?>" <?php if($get_event['tahun'] == $year_before2){ echo 'selected'; } ?>><?php echo $year_before2 ?></option>
                                <option value="<?php echo $year_before1 ?>" <?php if($get_event['tahun'] == $year_before1){ echo 'selected'; } ?>><?php echo $year_before1 ?></option>
                                <option value="<?php echo $year_now ?>" <?php if($get_event['tahun'] == $year_now){ echo 'selected'; } ?>><?php echo $year_now ?></option>
                                <option value="<?php echo $year_after1 ?>" <?php if($get_event['tahun'] == $year_after1){ echo 'selected'; } ?>><?php echo $year_after1 ?></option>
                                <option value="<?php echo $year_after2 ?>" <?php if($get_event['tahun'] == $year_after2){ echo 'selected'; } ?>><?php echo $year_after2 ?></option>
                                <option value="<?php echo $year_after3 ?>" <?php if($get_event['tahun'] == $year_after3){ echo 'selected'; } ?>><?php echo $year_after3 ?></option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">PIC Divisi *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="edit_divisi" id="edit_divisi" style="width: ;height: 27px;">
                                    <option value="">--SELECT ONE--</option>
                                    <option value="HR" <?php if($get_event['divisi'] == 'HR'){ echo 'selected'; } ?>>HUMAN RESOURCE</option>
                                    <option value="ENG1" <?php if($get_event['divisi'] == 'ENG1'){ echo 'selected'; } ?>>ENGINEERING DIV 1</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">PIC Departemen *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="edit_departemen" id="edit_departemen" style="width: ;height: 27px;">
                                    <option value="">--SELECT ONE--</option>
                                    <option value="HR01" <?php if($get_event['dept'] == 'HR01'){ echo 'selected'; } ?>>HRIS</option>
                                    <option value="HR02" <?php if($get_event['dept'] == 'HR02'){ echo 'selected'; } ?>>HR Ops</option>
                                    <option value="HR03" <?php if($get_event['dept'] == 'HR03'){ echo 'selected'; } ?>>HROD</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Target (Index) *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="edit_target" id="edit_target" style="width: ;height: 27px;">
                                    <option value="">--SELECT ONE--</option>
                                    <option value="1" <?php if($get_event['target'] == '1'){ echo 'selected'; } ?>>1</option>
                                    <option value="2" <?php if($get_event['target'] == '2'){ echo 'selected'; } ?>>2</option>
                                    <option value="3" <?php if($get_event['target'] == '3'){ echo 'selected'; } ?>>3</option>
                                    <option value="4" <?php if($get_event['target'] == '4'){ echo 'selected'; } ?>>4</option>
                                    <option value="5" <?php if($get_event['target'] == '5'){ echo 'selected'; } ?>>5</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Periode *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <div class="form-row" style="padding-left:5px">
                                <div class="col-sm-5" style="padding-left:0px">
                                    <input type="text" id="edit_start" class="form-control"
                                                                        name="edit_start" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " value="<?php echo $get_event['start_date']; ?>"/>
                                </div>
                                <div class="col-sm-2" style="text-align:center">
                                    TO
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" id="edit_end" class="form-control"
                                                                        name="edit_end" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " value="<?php echo $get_event['end_date']; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Group Pertanyaan *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <table class="table table-bordered table-striped table-hover rowfy">
                                <thead>
                                    <tr>
                                        <th>Group Pertanyaan</th>
                                        <th>Tipe Jawaban</th>
                                        <th>Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        while($data_gpertanyaan = mysqli_fetch_assoc($sql_get_gpertanyaan)){
                                    ?>
                                    <tr>
                                        <td>
                                            <select id="edit_gpertanyaan" class="input--style-6" name="edit_gpertanyaan[]" style="width: ;height: 30px;">
                                                <?php
                                                    $group = mysqli_query($connect, "SELECT 
                                                    a.groupId,
                                                    a.groupName
                                                    FROM hrmsurveytgroup a 
                                                    WHERE a.status = '0'
                                                    AND a.groupId <> '$data_gpertanyaan[id_group]' 
                                                    order BY a.groupId asc");
                                                    while ($data = mysqli_fetch_array($group)){
                                                ?>
                                                    <option value="<?php echo $data['groupId'];?>"><?php echo $data['groupName'];?></option>
                                                <?php 
                                                }
                                                ?>
                                                <?php
                                                    $group_selected = mysqli_query($connect, "SELECT 
                                                    a.groupId,
                                                    a.groupName
                                                    FROM hrmsurveytgroup a 
                                                    WHERE a.status = '0'
                                                    AND a.groupId = '$data_gpertanyaan[id_group]'");
                                                    while ($data_selected = mysqli_fetch_array($group_selected)){
                                                ?>
                                                    <option value="<?php echo $data_selected['groupId'];?>" selected><?php echo $data_selected['groupName'];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="edit_tjawaban" name="edit_tjawaban[]">
                                                <option value="1" <?php if($data_gpertanyaan['tipejawaban'] == '1'){ echo 'selected'; } ?>>Skala 1 - 4</option>
                                                <option value="2" <?php if($data_gpertanyaan['tipejawaban'] == '2'){ echo 'selected'; } ?>>Skala 1 - 5</option>
                                                <option value="3" <?php if($data_gpertanyaan['tipejawaban'] == '3'){ echo 'selected'; } ?>>Yes Or No</option>
                                                <option value="4" <?php if($data_gpertanyaan['tipejawaban'] == '4'){ echo 'selected'; } ?>>Deskripsi</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="edit_porder" name="edit_porder[]">
                                                <option value="1" <?php if($data_gpertanyaan['order'] == '1'){ echo 'selected'; } ?>>1</option>
                                                <option value="2" <?php if($data_gpertanyaan['order'] == '2'){ echo 'selected'; } ?>>2</option>
                                                <option value="3" <?php if($data_gpertanyaan['order'] == '3'){ echo 'selected'; } ?>>3</option>
                                                <option value="4" <?php if($data_gpertanyaan['order'] == '4'){ echo 'selected'; } ?>>4</option>
                                                <option value="5" <?php if($data_gpertanyaan['order'] == '5'){ echo 'selected'; } ?>>5</option>
                                                <option value="6" <?php if($data_gpertanyaan['order'] == '6'){ echo 'selected'; } ?>>6</option>
                                                <option value="7" <?php if($data_gpertanyaan['order'] == '7'){ echo 'selected'; } ?>>7</option>
                                                <option value="8" <?php if($data_gpertanyaan['order'] == '8'){ echo 'selected'; } ?>>8</option>
                                                <option value="9" <?php if($data_gpertanyaan['order'] == '9'){ echo 'selected'; } ?>>9</option>
                                                <option value="10" <?php if($data_gpertanyaan['order'] == '10'){ echo 'selected'; } ?>>10</option>
                                                <option value="11" <?php if($data_gpertanyaan['order'] == '11'){ echo 'selected'; } ?>>11</option>
                                                <option value="12" <?php if($data_gpertanyaan['order'] == '12'){ echo 'selected'; } ?>>12</option>
                                                <option value="13" <?php if($data_gpertanyaan['order'] == '13'){ echo 'selected'; } ?>>13</option>
                                                <option value="14" <?php if($data_gpertanyaan['order'] == '14'){ echo 'selected'; } ?>>14</option>
                                                <option value="15" <?php if($data_gpertanyaan['order'] == '15'){ echo 'selected'; } ?>>15</option>
                                                <option value="16" <?php if($data_gpertanyaan['order'] == '16'){ echo 'selected'; } ?>>16</option>
                                                <option value="17" <?php if($data_gpertanyaan['order'] == '17'){ echo 'selected'; } ?>>17</option>
                                                <option value="18" <?php if($data_gpertanyaan['order'] == '18'){ echo 'selected'; } ?>>18</option>
                                                <option value="19" <?php if($data_gpertanyaan['order'] == '19'){ echo 'selected'; } ?>>19</option>
                                                <option value="20" <?php if($data_gpertanyaan['order'] == '20'){ echo 'selected'; } ?>>20</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"></div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <div class="form-row">
                                <div class="col-sm-1">
                                    <input type="checkbox" class="form-check-input" id="essay" name="essay" value="<?php echo $val; ?>" <?php echo $check; ?>>
                                </div>
                                <div class="col-sm-10" style="margin-top:2px">
                                    <label class="form-check-label" for="essay">Essay Survey</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row" id="essay-survey" style='display: <?php echo $display; ?>'>
                    <div class="col-3 name">Group Essay *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <table class="table table-bordered table-striped table-hover rowfy">
                                <thead>
                                    <tr>
                                        <th>Group Essay</th>
                                        <th>Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($val == 1){
                                        while($data_gessay  = mysqli_fetch_assoc($sql_get_gessay)){
                                    ?>
                                    <tr>
                                        <td>
                                            <select class="form-control" id="edit_gessay" name="edit_gessay[]">
                                                <?php
                                                $group = mysqli_query($connect, "SELECT 
                                                a.groupId,
                                                a.groupName
                                                FROM hrmsurveytgroup a 
                                                WHERE a.`status` = '1' 
                                                AND a.groupId <> '$data_gessay[id_group]'
                                                ORDER BY a.groupId ASC");
                                                while ($data = mysqli_fetch_assoc($group)){
                                                ?>
                                                    <option value="<?php echo $data['groupId'];?>"><?php echo $data['groupName'];?></option>
                                                <?php 
                                                }
                                                ?>
                                                <?php
                                                $group = mysqli_query($connect, "SELECT 
                                                a.groupId,
                                                a.groupName
                                                FROM hrmsurveytgroup a 
                                                WHERE a.`status` = '1' 
                                                AND a.groupId = '$data_gessay[id_group]'");
                                                while ($data = mysqli_fetch_assoc($group)){
                                                ?>
                                                    <option value="<?php echo $data['groupId'];?>" selected><?php echo $data['groupName'];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="edit_orderessay" name="edit_orderessay[]">
                                                <option value="1" <?php if($data_gessay['order'] == '1'){ echo 'selected'; } ?>>1</option>
                                                <option value="2" <?php if($data_gessay['order'] == '2'){ echo 'selected'; } ?>>2</option>
                                                <option value="3" <?php if($data_gessay['order'] == '3'){ echo 'selected'; } ?>>3</option>
                                                <option value="4" <?php if($data_gessay['order'] == '4'){ echo 'selected'; } ?>>4</option>
                                                <option value="5" <?php if($data_gessay['order'] == '5'){ echo 'selected'; } ?>>5</option>
                                                <option value="6" <?php if($data_gessay['order'] == '6'){ echo 'selected'; } ?>>6</option>
                                                <option value="7" <?php if($data_gessay['order'] == '7'){ echo 'selected'; } ?>>7</option>
                                                <option value="8" <?php if($data_gessay['order'] == '8'){ echo 'selected'; } ?>>8</option>
                                                <option value="9" <?php if($data_gessay['order'] == '9'){ echo 'selected'; } ?>>9</option>
                                                <option value="10" <?php if($data_gessay['order'] == '10'){ echo 'selected'; } ?>>10</option>
                                                <option value="11" <?php if($data_gessay['order'] == '11'){ echo 'selected'; } ?>>11</option>
                                                <option value="12" <?php if($data_gessay['order'] == '12'){ echo 'selected'; } ?>>12</option>
                                                <option value="13" <?php if($data_gessay['order'] == '13'){ echo 'selected'; } ?>>13</option>
                                                <option value="14" <?php if($data_gessay['order'] == '14'){ echo 'selected'; } ?>>14</option>
                                                <option value="15" <?php if($data_gessay['order'] == '15'){ echo 'selected'; } ?>>15</option>
                                                <option value="16" <?php if($data_gessay['order'] == '16'){ echo 'selected'; } ?>>16</option>
                                                <option value="17" <?php if($data_gessay['order'] == '17'){ echo 'selected'; } ?>>17</option>
                                                <option value="18" <?php if($data_gessay['order'] == '18'){ echo 'selected'; } ?>>18</option>
                                                <option value="19" <?php if($data_gessay['order'] == '19'){ echo 'selected'; } ?>>19</option>
                                                <option value="20" <?php if($data_gessay['order'] == '20'){ echo 'selected'; } ?>>20</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php }
                                    }else{ 
                                    ?>
                                    <tr>
                                        <td>
                                            <select class="form-control" id="edit_gessay" name="edit_gessay[]">
                                                <?php
                                                $group = mysqli_query($connect, "SELECT 
                                                a.groupId,
                                                a.groupName
                                                FROM hrmsurveytgroup a 
                                                WHERE a.`status` = '1' 
                                                ORDER BY a.groupId ASC");
                                                while ($data = mysqli_fetch_assoc($group)){
                                                ?>
                                                    <option value="<?php echo $data['groupId'];?>"><?php echo $data['groupName'];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="edit_orderessay" name="edit_orderessay[]">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">>10</option>
                                                <option value="11">>11</option>
                                                <option value="12">>12</option>
                                                <option value="13">>13</option>
                                                <option value="14">>14</option>
                                                <option value="15">>15</option>
                                                <option value="16">>16</option>
                                                <option value="17">>17</option>
                                                <option value="18">>18</option>
                                                <option value="19">>19</option>
                                                <option value="20">>20</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>     
                <div class="form-row">
                    <div class="col-3 name">Anggota Event *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <div class="form-row" style="padding-left:0px">
                                <div class="col-sm-1" style="padding-left:0px">
                                    <input type="checkbox" class="form-check-input" id="all_anggota" name="all_anggota" value="0">
                                </div>
                                <div class="col-sm-10" style="margin-top:2px">
                                    <label class="form-check-label" for="essay">All Employee</label>
                                </div>
                            </div>
                            <div class="form-row" style="padding-left:0px">
                                <div class="col-sm-12" style="padding-left:0px">
                                    <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <select id="test-select-4" multiple="multiple" class="framework edit_anggota" name="framework[]" >
                                            <?php while ($row = mysqli_fetch_assoc($user)) { ?>
                                                <option value="<?php echo $row['username'] ?>" data-section="" data-index="1"><?php echo $row['nama'] ?></option>
                                            <?php } ?>
                                            <?php while ($row1 = mysqli_fetch_assoc($user_selected)) { ?>
                                                <option value="<?php echo $row1['username'] ?>" data-section="" data-index="1" selected><?php echo $row1['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
               
                
                <!-- <a href='#' id1='' id2='' class='' data-toggle='modal' id='' data-target='#modal-view-od-1'><img src='../../asset/img/icons/glasses.png'></a> -->
                
            </fieldset>


            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                           
                                                                                                                                                        
                                                                             <button type="submit" id="edit_event" id1="<?php echo $get_event['id_event']; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<!-- Add Remove -->

<script type="text/javascript">
              $(document).ready(function() {
                     $('#edit_start').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#edit_end').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
              });
</script>

<script>
$(document).ready(function(){
    $(document).on('click', '#essay', function(){
		var c   = $(this).val();
       
        if(c == 1){
            const display = $("#essay-survey");
            display.css("display", "none");
            $(this).val('0');
        }else if(c == 0){
            const display = $("#essay-survey");
            display.css("display", "");
            $(this).val('1');
        }

    });
});
</script>

<script>
$(document).ready(function(){
    $(document).on('click', '#all_anggota', function(){
		var c   = $(this).val();
       
        if(c == 1){
            $(this).val('0');
        }else if(c == 0){
            $(this).val('1');
        }

    });
});
</script>

<script type="text/javascript">
       var tree4 = $("#test-select-4").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>