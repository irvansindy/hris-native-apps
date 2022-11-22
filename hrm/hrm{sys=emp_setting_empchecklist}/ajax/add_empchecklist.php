<?php 
include "../../../application/session/session_ess.php";

$sql_empchecklist   = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_code,
a.pos_name_en,
CONCAT(a.pos_name_en, ' [', a.pos_code, ']') AS org_unit
FROM hrmorgstruc a
WHERE a.pos_active = '1'
AND a.pos_flag = '1'");


$sql_emp    = mysqli_query($connect, "SELECT 
a.emp_no,
CONCAT(a.Full_Name, ' [', a.emp_no, ']') AS nama
FROM view_employee a");

$sql_facility   = mysqli_query($connect, "SELECT 
a.facility_code,
a.facility_name
FROM teomfacility a");

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
                                                               name="tambah_cgc" id="tambah_cgc" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Checklist Group Name *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_cgm" id="tambah_cgm" type="Text" value=""
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
                                <select id="test-select-69" multiple="multiple" class="framework tambah_ou" name="framework[]" >
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
                                    <tr id="rowab" class="dynamic-added">
                                        
                                        <td>
                                            <div class="input-group">
                                            <select id="facility" class="input--style-6" name="facility[]" style="width: ;height: 30px;">
                                                    <?php 
                                                        while($data_facility = mysqli_fetch_assoc($sql_facility)){
                                                    ?>
                                                    <option value="<?php echo $data_facility['facility_code'] ?>"><?php echo $data_facility['facility_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td><input class="form-check-input" type="checkbox" value="0" id1="0" name="tambah_newhire[]" id="tambah_newhire"></td>
                                        <td><input class="form-check-input" type="checkbox" value="0" id1="0" name="tambah_exit[]" id="tambah_exit"></td>
                                        <td> 
                                            <div class="card-body table-responsive p-0" style="width: 100vw;height: 40vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                                <select id="test-select-ab" multiple="multiple" class="framework pic" name="pic[]" >
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
                                            <button type="button" name="add" id="add" class="btn btn-success btn-sm">+</button>
                                        </td>
                                    </tr>
                                    
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
                                                                           
                                                                                                                                                        
                                                                             <button type="submit" id="tambah_empchecklist" id1=""
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>

<script type="text/javascript">
       var tree4 = $("#test-select-69").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
       var tree5 = $("#test-select-ab").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>

<script type="text/javascript">

    $(document).ready(function(){  
        var i=0;     
        $('#add').click(function(){  

            i++; 

            // Loader
            mymodalss.style.display = "block";
            document.getElementById("msg").innerHTML = "Data refreshed";
            // Loader

            $.ajax({
                url: "ajax/append_empchecklist.php",
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


        $(document).on('click', '.btn_remove', function(){  

            var button_id = $(this).attr("id");   

            $('#row'+button_id+'').remove();  

            i--;  

            $('#count').val($i);

        });  

        $(document).on('click', '#tambah_newhire', function(){  

            var val = $(this).val();   

            if(val == '0'){
                $(this).val('1');
            }else if(val == '1'){
                $(this).val('0');
            }
 

        }); 

        $(document).on('click', '#tambah_exit', function(){  

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