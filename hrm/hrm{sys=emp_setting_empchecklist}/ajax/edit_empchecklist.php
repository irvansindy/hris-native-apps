<?php 
include "../../../application/session/session_ess.php";

$id = $_POST['eic'];

$sql_get_empchecklist = mysqli_query($connect, "SELECT 
a.checklistheader_code as Checklist_Group_Code,
a.checklistgrp_name as Checklist_Group_Name,
b.dept_id
FROM hrmchecklistheader a
LEFT JOIN tgemchecklistorgunit b ON b.checklistheader_code = a.checklistheader_code
WHERE a.checklistheader_code = '$id'");

$data_empchecklist = mysqli_fetch_assoc($sql_get_empchecklist);

$sql_empchecklist   = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_code,
a.pos_name_en,
CONCAT(a.pos_name_en, ' [', a.pos_code, ']') AS org_unit
FROM hrmorgstruc a
WHERE a.pos_active = '1'
AND a.pos_flag = '1'
AND a.position_id <> '$data_empchecklist[dept_id]'");

$sql_empchecklist_select   = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_code,
a.pos_name_en,
CONCAT(a.pos_name_en, ' [', a.pos_code, ']') AS org_unit
FROM hrmorgstruc a
WHERE a.position_id = '$data_empchecklist[dept_id]'");




?>
<link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
<script src="../../asset/gt_developer/asset_use/jquery-1.11.3.min.js"></script>
<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
<script src="vendor/rowfy.js"></script>

<div class="modal-body">
    <input type="hidden" id="count" name="count" value="0">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Checklist Group Code *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_cgc" id="edit_cgc" type="Text" value="<?php echo $data_empchecklist['Checklist_Group_Code'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Checklist Group Name *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="edit_cgm" id="edit_cgm" type="Text" value="<?php echo $data_empchecklist['Checklist_Group_Name'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Organization Unit</div>
                    <div class="col-sm-9" style="padding-left:15px">
                        <div class="input-group">
                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                <select id="test-select-4" multiple="multiple" class="framework edit_ou" name="framework[]" >
                                    <?php while ($row_select = mysqli_fetch_array($sql_empchecklist_select)) { ?>
                                        <option value="<?php echo $row_select['position_id'] ?>" data-section="" data-index="1" selected><?php echo $row_select['pos_name_en'] ?></option>
                                    <?php } ?>
                                    <?php while ($row = mysqli_fetch_array($sql_empchecklist)) { ?>
                                        <option value="<?php echo $row['position_id'] ?>" data-section="" data-index="1"><?php echo $row['pos_name_en'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                
                <!-- <a href='#' id1='' id2='' class='' data-toggle='modal' id='' data-target='#modal-view-od-1'><img src='../../asset/img/icons/glasses.png'></a> -->
                
            </fieldset>

            <fieldset id="fset_1">
                <legend>Employee Check List</legend>

                <div class="form-row">
                    
                    <div class="col-sm-12" >
                        <div class="input-group">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <!-- <th style="width:10%">Company Facility</th> -->
                                        <th style="width:22%">Item</th>
                                        <th style="width:6%">New Hire</th>
                                        <th style="width:4%">Exit</th>
                                        <th>PIC</th>
                                        <!-- <th style="width:6%">Order</th> -->
                                        <th style="width:3%"></th>
                                    </tr>
                                </thead>
                                <tbody id="dynamic_field">
                                    <?php 
                                    $no = 1;
                                    $sql_get_facility = mysqli_query($connect, "SELECT 
                                    DISTINCT(a.checklist_code),
                                    newhire.checklistgroup_code AS newhire,
                                    exite.checklistgroup_code AS exite,
                                    CASE
                                       WHEN newhire.checklistgroup_code IS NOT NULL then '1'
                                       ELSE '0'
                                    END AS status_newhire,
                                    CASE
                                       WHEN exite.checklistgroup_code IS NOT NULL then '1'
                                       ELSE '0'
                                    END AS status_exite
                                    FROM tgemchecklist a
                                    LEFT JOIN ( 
                                    SELECT g.checklistgroup_code, g.checklistheader_code, g.checklist_code
                                    FROM tgemchecklist g WHERE g.checklistgroup_code = 'NEWHIRE') newhire ON newhire.checklistheader_code = a.checklistheader_code AND newhire.checklist_code = a.checklist_code 
                                    LEFT JOIN ( 
                                    SELECT h.checklistgroup_code, h.checklistheader_code, h.checklist_code
                                    FROM tgemchecklist h WHERE h.checklistgroup_code = 'EXIT') exite ON exite.checklistheader_code = a.checklistheader_code AND exite.checklist_code = a.checklist_code
                                    WHERE a.checklistheader_code = '$id'");

                                    $count_get_facility = mysqli_num_rows($sql_get_facility);

                                    if($count_get_facility == '0'){
                                        $count_validasi = 1;
                                        $counte = 1;
                                    }else{
                                        $count_validasi = $count_get_facility;
                                        $counte = $count_get_facility;
                                    }

                                    if($count_get_facility > '0'){

                                    while($facility = mysqli_fetch_assoc($sql_get_facility)){

                                        if($no == '1'){
                                            $button = '<button type="button" name="add" id="add" class="btn btn-success btn-sm">+</button>';
                                        }else{
                                            $button = '<button type="button" name="remove" id1="'.$no.'" class="btn btn-danger btn_removerb btn-sm">X</button>';
                                        }

                                        $sql_facility   = mysqli_query($connect, "SELECT 
                                        a.facility_code,
                                        a.facility_name
                                        FROM hrmfacility a");

                                        if($facility['status_newhire'] == '1'){
                                            $checked_newhire = 'checked';
                                        }else{
                                            $checked_newhire = '';
                                        }

                                        if($facility['status_exite'] == '1'){
                                            $checked_exite = 'checked';
                                        }else{
                                            $checked_exite = '';
                                        }

                                        $sql_emp    = mysqli_query($connect, "SELECT 
                                        a.emp_no,
                                        CONCAT(a.Full_Name, ' [', a.emp_no, ']') AS nama
                                        FROM view_employee a
                                        WHERE a.emp_no NOT IN (SELECT 
                                        a.pic 
                                        FROM tgemchecklistpic a 
                                        WHERE a.checklistheader_code = '$id'
                                        AND a.checklist_code = '$facility[checklist_code]')");

                                        $sql_emp_selected    = mysqli_query($connect, "SELECT 
                                        a.emp_no,
                                        CONCAT(a.Full_Name, ' [', a.emp_no, ']') AS nama
                                        FROM view_employee a
                                        WHERE a.emp_no IN (SELECT 
                                        a.pic 
                                        FROM tgemchecklistpic a 
                                        WHERE a.checklistheader_code = '$id'
                                        AND a.checklist_code = '$facility[checklist_code]')");
                                    ?>
                                    <tr id="rowab<?php echo $no; ?>" class="dynamic-added">
                                        <td>
                                            <div class="input-group">
                                            <select id="edit_facility" class="input--style-6" name="edit_facility[]" style="width: ;height: 30px;">
                                                    <?php 
                                                        while($data_facility = mysqli_fetch_assoc($sql_facility)){
                                                    ?>
                                                    <option value="<?php echo $data_facility['facility_code'] ?>" <?php if($data_facility['facility_code'] == $facility['checklist_code']){ echo 'selected'; } ?>><?php echo $data_facility['facility_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td><input class="form-check-input" type="checkbox" value="<?php echo $facility['status_newhire']; ?>" id1="<?php echo $facility['status_newhire']; ?>" name="edit_newhire[]" id="edit_newhire" <?php echo $checked_newhire ?>></td>
                                        <td><input class="form-check-input" type="checkbox" value="<?php echo $facility['status_exite']; ?>" id1="<?php echo $facility['status_exite']; ?>" name="edit_exit[]" id="edit_exit" <?php echo $checked_exite ?>></td>
                                        <td> 
                                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                                <select id="test-select-ab<?php echo $no; ?>" multiple="multiple" class="framework edit_pic" name="edit_pic[]" >
                                                    <?php 
                                                        while($data_emp_selected = mysqli_fetch_assoc($sql_emp_selected)){
                                                    ?>
                                                    <option value="<?php echo $data_emp_selected['emp_no'] ?>" selected><?php echo $data_emp_selected['nama'] ?></option>
                                                    <?php } ?>
                                                    <?php 
                                                        while($data_emp = mysqli_fetch_assoc($sql_emp)){
                                                    ?>
                                                    <option value="<?php echo $data_emp['emp_no'] ?>"><?php echo $data_emp['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>    
                                        </td>
                                        <!-- <td>Doe</td> -->
                                        <td>
                                            <?php echo $button; ?>
                                        </td>
                                    </tr>
                                    <?php $no++; } }else{ ?>
                                        <tr id="rowab" class="dynamic-added">
                                        
                                        <td>
                                            <div class="input-group">
                                            <select id="edit_facility" class="input--style-6" name="edit_facility[]" style="width: ;height: 30px;">
                                                    <?php 
                                                    $sql_facility   = mysqli_query($connect, "SELECT 
                                                    a.facility_code,
                                                    a.facility_name
                                                    FROM hrmfacility a");

                                                        while($data_facility = mysqli_fetch_assoc($sql_facility)){
                                                    ?>
                                                    <option value="<?php echo $data_facility['facility_code'] ?>"><?php echo $data_facility['facility_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td><input class="form-check-input" type="checkbox" value="0" id1="0" name="edit_newhire[]" id="edit_newhire"></td>
                                        <td><input class="form-check-input" type="checkbox" value="0" id1="0" name="edit_exit[]" id="edit_exit"></td>
                                        <td> 
                                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                                <select id="test-select-ab1" multiple="multiple" class="framework edit_pic" name="edit_pic[]" >
                                                    <?php 
                                                    $sql_emp    = mysqli_query($connect, "SELECT 
                                                    a.emp_no,
                                                    CONCAT(a.Full_Name, ' [', a.emp_no, ']') AS nama
                                                    FROM view_employee a");

                                                        while($data_emp = mysqli_fetch_assoc($sql_emp)){
                                                    ?>
                                                    <option value="<?php echo $data_emp['emp_no'] ?>"><?php echo $data_emp['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>    
                                        </td>
                                        <!-- <td>Doe</td> -->
                                        <td>
                                            <button type="button" name="add" id="add" class="btn btn-success btn-sm">+</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </fieldset> 

            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                           
                                                                                                                                                        
                                                                             <button type="submit" id="edit_empchecklist" id1="<?php echo $id; ?>" id2="<?php echo $counte; ?>"
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<script type="text/javascript">
       var tree4 = $("#test-select-4").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
       var count_facility = '<?php echo $count_validasi ?>';
       for(var i = 1; i<=count_facility; i++){
       var tree5 = $("#test-select-ab"+i+"").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
    }
</script>

<script type="text/javascript">

    $(document).ready(function(){  
        var i='<?php echo $count_validasi ?>';     
        $('#add').click(function(){  

            i++; 

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $.ajax({
                url: "ajax/append_editempchecklist.php",
                type: "POST",
                        data: {
                                i: i,
                        },
                        success: function(ajaxData) {
                                $("#dynamic_field").append(ajaxData);

                                $("#test-select-"+i+"").treeMultiselect({
                                        allowBatchSelection: true,
                                        enableSelectAll: true,
                                        searchable: true,
                                        sortable: true,
                                        startCollapsed: false,
                                });

                                mymodalss.style.display = "none";
                                document.getElementById("msg").innerHTML = "Data refreshed";
                                return false;

                        }
                });

             

            $('#count').val($i);

        });

        $(document).on('click', '.btn_removerb', function(){  

var button_id = $(this).attr("id1");   

$('#rowab'+button_id+'').remove();  

// i--;  

// $('#count').val($i);

});  

        $(document).on('click', '.btn_remove', function(){  

            var button_id = $(this).attr("id");   

            $('#row'+button_id+'').remove();  

            i--;  

            $('#count').val($i);

        });  

        $(document).on('click', '#edit_newhire', function(){  

            var val = $(this).val();   

            if(val == '0'){
                $(this).val('1');
            }else if(val == '1'){
                $(this).val('0');
            }
 

        }); 

        $(document).on('click', '#edit_exit', function(){  

            var val = $(this).val();   

            if(val == '0'){
                $(this).val('1');
            }else if(val == '1'){
                $(this).val('0');
            }


        }); 

        // $(document).on('click', '#facility', function(){  

        //      var id     = $(this).attr('id1');


        // }); 
    });
</script>