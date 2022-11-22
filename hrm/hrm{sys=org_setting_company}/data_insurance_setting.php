<?php 
include "../../application/session/session.php";

$id     = $_POST['id'];

if(isset($_POST['value_search'])){
    $value      = $_POST['value_search'];
    $sql_data   = mysqli_query($connect, "SELECT 
    b.company_name,
    a.register_no,
    c.institution_name,
    a.branch_code,
    a.branch_name,
    a.branch_account,
    a.register_date
    FROM teorcompinsurance a
    LEFT JOIN teomcompany b ON a.company_id = b.company_id
    LEFT JOIN tgeminsurance c ON a.institution_code = c.institution_code
    WHERE a.company_id = '$id'
    AND (b.company_name LIKE '%$value%'
    OR a.register_no LIKE '%$value%'
    OR c.institution_name LIKE '%$value%'
    OR a.branch_code LIKE '%$value%'
    OR a.branch_name LIKE '%$value%'
    OR a.branch_account LIKE '%$value%'
    OR a.register_date LIKE '%$value%')");
}else{
    $value      = '';
    $sql_data   = mysqli_query($connect, "SELECT 
    b.company_name,
    a.register_no,
    c.institution_name,
    a.branch_code,
    a.branch_name,
    a.branch_account,
    a.register_date
    FROM teorcompinsurance a
    LEFT JOIN teomcompany b ON a.company_id = b.company_id
    LEFT JOIN tgeminsurance c ON a.institution_code = c.institution_code
    WHERE a.company_id = '$id'");
}
?>
<div class="card-header d-flex align-items-center">
<input type="hidden" id="value" value="<?php echo $value; ?>">



                     <div class="card-actions ml-auto">
                            
                        <table>
                        <td><a href='#' onclick='' id="add_modal_insurance_1" class='' data-toggle='modal' id='modal_view_od' data-target='#modal-view-od'
 style="padding: 0 1px">
                                                               <div class="toolbar sprite-toolbar-add" id=""
                                                                      title="Add"></div>
                                                        </a></td>
                                        <td>
                                        
                                       
                                        <td><a href='#' onclick='' class='' style="padding: 0 1px">
                                                               <div class="toolbar sprite-toolbar-excel" id="export_insurance"
                                                                      title="Export"></div>
                                                        </a></td>
                                        <td>
                                        <a href='#' onclick=''>
                                                        <div class="toolbar sprite-toolbar-reload" id="reload_insurance"
                                                               title="Reload" onclick=";">
                                                        </div>
                                                        </a>
                                        </td>
                                        
                        </table>

                     </div>
              </div>
<table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Company Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Insurance Number</th>
                                                               <th class="fontCustom" style="z-index: 1;">Insurance Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Insurance Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Branch Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Branch Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Branch Account</th>


                                                        </tr>
                                                     

                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $no = 1;

                                                        while($data = mysqli_fetch_assoc($sql_data)){
                                                    ?>
                                                    <tr>
                                                        <td class='fontCustom'><?php echo $no ?></td>	
                                                        <td class='fontCustom'><?php echo $data['company_name'] ?></td>	
                                                        <td class='fontCustom'><a href='#' id1='<?php echo $data['register_no'] ?>' id="modal_insurance_1" class='' data-toggle='modal' data-target='#modal-view-od'><?php echo $data['register_no'] ?></a></td>
                                                        <!-- <td class='fontCustom'><a href='#' id1='<?php echo $data['register_no'] ?>' id="modal_insurance" class=''><?php echo $data['register_no'] ?></a></td>	 -->
                                                        <td class='fontCustom'><?php echo $data['institution_name'] ?></td>	
                                                        <td class='fontCustom'><?php echo $data['register_date'] ?></td>
                                                        <td class='fontCustom'><?php echo $data['branch_code'] ?></td>	
                                                        <td class='fontCustom'><?php echo $data['branch_name'] ?></td>	
                                                        <td class='fontCustom'><?php echo $data['branch_account'] ?></td>	
                                                    </tr>
                                                    <?php $no++; } ?>
                                                </tbody>
                                                       

</table>

<script>
$(document).ready(function() {
    $(document).on('click', '#modal_insurance', function(){
        var id  = $(this).attr('id1');
        $.post('modal_setting_insurance.php',{id:id}, function (data) {
                var w = window.open('modal_setting_insurance.php?id='+id+'','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true);
                w.document.open();
                w.document.write(data);
                w.document.close();
                // w.document.focus();
        });
    });


    $(document).on('click', '#modal_insurance_1', function(){
        var id  = $(this).attr('id1');
        
        $('#title_setting').html('Setting Data Insurance');
        
        $.ajax({
                url:"modal_setting_insurance_1.php",
                method:"POST",
                data:{id:id},
                success:function(data){

                    $('#tampil_setting').html(data);
                     
                   
     
                    
                    
                }

        })
    });

    $(document).on('click', '#add_modal_insurance_1', function(){
        var id  = $(this).attr('id1');
        
        $('#title_setting').html('Tambah Data Insurance');
        
        $.ajax({
                url:"modal_add_insurance_1.php",
                method:"POST",
                data:{id:id},
                success:function(data){

                    $('#tampil_setting').html(data);
                     
                   
     
                    
                    
                }

        })
    });


    // $(document).on('click', '#add_modal_insurance', function(){
    //     // var id  = $(this).attr('id1');
    //     $.post('modal_add_insurance.php', function (data) {
    //             var w = window.open('modal_add_insurance.php','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true);
    //             w.document.open();
    //             w.document.write(data);
    //             w.document.close();
    //             // w.document.focus();
    //     });
    // });

    $(document).on('click', '#export_insurance', function(){
       var value     = $('#value').val();

        window.open('export/excel_insurance.php?value='+value+'', '_blank');
    

    });
});
</script>