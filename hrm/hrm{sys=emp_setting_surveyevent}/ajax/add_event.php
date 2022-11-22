<?php 
include "../../../application/session/session_ess.php";

date_default_timezone_set('Asia/Bangkok'); 
$year_now             = date("Y");
$year_after1           = $year_now+1;
$year_after2           = $year_now+2;
$year_after3           = $year_now+3;

// ambil anggota
$user = mysqli_query($connect, "SELECT username, nama FROM users order by username ASC");
// End ambil anggota

// Ambil group pertanyaan
$sql_get_gpertanyaan    = mysqli_query($connect, "SELECT 
a.id_group,
a.tipejawaban,
a.`order`
FROM hrmsurveygrouppertanyaan a");
//End Ambil group pertanyaan

// Ambil group essay
$sql_get_gessay         = mysqli_query($connect, "SELECT 
a.id_group,
a.`order`
FROM hrmsurveygroupessay a");

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
                                                               name="add_judul" id="add_judul" type="Text" value=""
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
                            <select class="input--style-6" name="add_tahun" id="add_tahun" style="width: ;height: 27px;">
                                <option value="">--SELECT ONE--</option>
                                <option value="<?php echo $year_now ?>"><?php echo $year_now ?></option>
                                <option value="<?php echo $year_after1 ?>"><?php echo $year_after1 ?></option>
                                <option value="<?php echo $year_after2 ?>"><?php echo $year_after2 ?></option>
                                <option value="<?php echo $year_after3 ?>"><?php echo $year_after3 ?></option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">PIC Divisi *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="add_divisi" id="add_divisi" style="width: ;height: 27px;">
                                    <option value="">--SELECT ONE--</option>
                                    <option value="HR">HUMAN RESOURCE</option>
                                    <option value="ENG1">ENGINEERING DIV 1</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">PIC Departemen *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="add_departemen" id="add_departemen" style="width: ;height: 27px;">
                                    <option value="">--SELECT ONE--</option>
                                    <option value="HR01">HRIS</option>
                                    <option value="HR02">HR Ops</option>
                                    <option value="HR03">HROD</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Target (Index) *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <select class="input--style-6" name="add_target" id="add_target" style="width: ;height: 27px;">
                                    <option value="">--SELECT ONE--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
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
                                    <input type="text" id="add_start" class="form-control"
                                                                        name="add_start" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " value=""/>
                                </div>
                                <div class="col-sm-2" style="text-align:center">
                                    TO
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" id="add_end" class="form-control"
                                                                        name="add_end" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    " value=""/>
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
                                    <tr>
                                        <td>
                                            <select id="add_gpertanyaan" class="input--style-6" name="add_gpertanyaan[]" style="width: ;height: 30px;">
                                                <?php
                                                    $group = mysqli_query($connect, "SELECT 
                                                    a.groupId,
                                                    a.groupName
                                                    FROM hrmsurveytgroup a 
                                                    WHERE a.status = '0'
                                                    order BY a.groupId asc");
                                                    while ($data = mysqli_fetch_array($group)){
                                                ?>
                                                    <option value="<?php echo $data['groupId'];?>"><?php echo $data['groupName'];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="add_tjawaban" name="add_tjawaban[]">
                                                <option value="1">Skala 1 - 4</option>
                                                <option value="2">Skala 1 - 5</option>
                                                <option value="3">Yes Or No</option>
                                                <option value="4">Deskripsi</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" id="add_porder" name="add_porder[]">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name"></div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <div class="form-row" style="padding-left:0px">
                                <div class="col-sm-1" style="padding-left:0px">
                                    <input type="checkbox" class="form-check-input" id="essay1" name="essay1" value="0">
                                </div>
                                <div class="col-sm-10" style="margin-top:2px">
                                    <label class="form-check-label" for="essay">Essay Survey</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row" id="essay-survey1" style='display: none'>
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
                                    <tr>
                                        <td>
                                            <select class="form-control" id="add_gessay" name="add_gessay[]">
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
                                            <select class="form-control" id="add_orderessay" name="add_orderessay[]">
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
                                    <input type="checkbox" class="form-check-input" id="add_all_anggota" name="add_all_anggota" value="0">
                                </div>
                                <div class="col-sm-10" style="margin-top:2px">
                                    <label class="form-check-label" for="add_all_anggota">All Employee</label>
                                </div>
                            </div>
                            <div class="form-row" style="padding-left:0px">
                                <div class="col-sm-12" style="padding-left:0px">
                                    <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <select id="test-select-5" multiple="multiple" class="framework add_anggota" name="framework[]" >
                                            <?php while ($row = mysqli_fetch_assoc($user)) { ?>
                                                <option value="<?php echo $row['username'] ?>" data-section="" data-index="1"><?php echo $row['nama'] ?></option>
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
                                                                           
                                                                                                                                                        
                                                                             <button type="submit" id="add_event" id1=""
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<!-- Add Remove -->

<script type="text/javascript">
              $(document).ready(function() {
                     $('#add_start').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#add_end').bootstrapMaterialDatePicker({
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
    $(document).on('click', '#essay1', function(){
		var c   = $(this).val();
       
        if(c == 1){
            const display1 = $("#essay-survey1");
            display1.css("display", "none");
            $(this).val('0');
        }else if(c == 0){
            const display1 = $("#essay-survey1");
            display1.css("display", "");
            $(this).val('1');
        }

    });
});
</script>

<script>
$(document).ready(function(){
    $(document).on('click', '#add_all_anggota', function(){
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
       var tree4 = $("#test-select-5").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>