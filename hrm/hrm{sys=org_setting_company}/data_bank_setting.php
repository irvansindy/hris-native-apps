<?php 
include "../../application/session/session.php";

$id     = $_POST['id'];

if(isset($_POST['value_search'])){
    $value      = $_POST['value_search'];
    $sql_data   = mysqli_query($connect, "SELECT 
    a.bank_code,
    b.company_name,
    c.bank_name,
    a.bank_account,
    a.account_name
    FROM teorcompbank a
    LEFT JOIN teomcompany b ON a.company_id = b.company_id
    LEFT JOIN tpymbank c ON a.bank_code = c.bank_code
    WHERE a.company_id = '$id' AND
    ( a.bank_code LIKE '%$value%'
    OR b.company_name LIKE '%$value%'
    OR c.bank_name LIKE '%$value%'
    OR a.bank_account LIKE '%$value%'
    OR a.account_name LIKE '%$value%')
    ");

}else{
    $value      = '';
    $sql_data   = mysqli_query($connect, "SELECT 
    a.bank_code,
    b.company_name,
    c.bank_name,
    a.bank_account,
    a.account_name
    FROM teorcompbank a
    LEFT JOIN teomcompany b ON a.company_id = b.company_id
    LEFT JOIN tpymbank c ON a.bank_code = c.bank_code
    WHERE a.company_id = '$id'");
}

?>
<div class="card-header d-flex align-items-center">
<input type="hidden" id="value" value="<?php echo $value; ?>">

                     <div class="card-actions ml-auto">
                            
                        <table>
                            <tr>
                                        <td><a href='#' onclick='' id="add_modal_bank_1" class='' data-toggle='modal' id='modal_view_od' data-target='#modal-view-od'
 style="padding: 0 1px">
                                                               <div class="toolbar sprite-toolbar-add" id=""
                                                                      title="Add"></div>
                                                        </a></td>

                                                        
                                        <td><a href='#' onclick='' class='' style="padding: 0 1px">
                                                               <div class="toolbar sprite-toolbar-excel" id="export_bank"
                                                                      title="Export"></div>
                                                        </a></td>
                                        <!-- <td>
                                        <a href='#'  id="open_search" id1="0">
                                                               <div class="toolbar sprite-toolbar-search" id=""
                                                                      title="Search"></div>
                                                        </a>
                                        </td> -->
                                       
                                        <!-- <td>
                                          <form action="../rfid=repository/cli_Template_Download/ta/TaDownloadGTTGRLeaveReqExport" method="POST">
                                          
                                          <input type="hidden" name="inp_req" value="<?php echo $inp_req; ?>">
                                          <input type="hidden" name="inp_date" value="<?php echo $inp_date; ?>">
                                          <input type="hidden" name="inp_enddate" value="<?php echo $inp_enddate; ?>">

                                                
                                                        <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit">
                                                        </button>


                                                  
                                          </form>
                                       
                                       
                                        </td>  -->
                                        <td>
                                        <a href='#' onclick=''>
                                                        <div class="toolbar sprite-toolbar-reload" id="reload_bank"
                                                               title="Reload" onclick=";">
                                                        </div>
                                                        </a>
                                        </td>
                                        </tr>
                                       
                        </table>
                       
                     </div>
              </div>
<div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px; margin: 5px;overflow: scroll;">  

<table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Company Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Bank Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Bank Account</th>
                                                               <th class="fontCustom" style="z-index: 1;">Account Name</th>
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
                                                        <td class='fontCustom'><?php echo $data['bank_name'] ?></td>	
                                                        <td class='fontCustom'><a href='#' id1='<?php echo $data['bank_account'] ?>' id="modal_bank_1" class='' data-toggle='modal' id='modal_view_od' data-target='#modal-view-od'><?php echo $data['bank_account'] ?></a></td>
                                                        <!-- <td class='fontCustom'><a href='#' id1='<?php echo $data['bank_account'] ?>' id="modal_bank_1" class='' data-toggle='modal' id='modal_view_od' data-target='#modal-view-od'><img src='../../asset/img/icons/glasses.png'></a></td>	 -->
                                                        <td class='fontCustom'><?php echo $data['account_name'] ?></td>	
                                                    </tr>
                                                    <?php $no++; } ?>
                                                </tbody>
                                                       

</table>
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '#modal_bank', function(){
        var id  = $(this).attr('id1');
        $.post('modal_setting_bank.php',{id:id}, function (data) {
                var w = window.open('modal_setting_bank.php?id='+id+'','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true);
                w.document.open();
                w.document.write(data);
                w.document.close();
                // w.document.focus();
        });
    });

    $(document).on('click', '#modal_bank_1', function(){
        var id  = $(this).attr('id1');
        
        $('#title_setting').html('Setting Data Bank');
        
        $.ajax({
                url:"modal_setting_bank_1.php",
                method:"POST",
                data:{id:id},
                success:function(data){

                    $('#tampil_setting').html(data);
                     
                   
     
                    
                    
                }

        })
    });


    $(document).on('click', '#add_modal_bank_1', function(){
        var id  = $(this).attr('id1');
        
        $('#title_setting').html('Tambah Data Bank');
        
        $.ajax({
                url:"modal_add_bank_1.php",
                method:"POST",
                data:{id:id},
                success:function(data){

                    $('#tampil_setting').html(data);
                     
                   
     
                    
                    
                }

        })
    });


    $(document).on('click', '#add_modal_bank', function(){
        // var id  = $(this).attr('id1');
        $.post('modal_add_bank.php', function (data) {
                var w = window.open('modal_add_bank.php','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true);
                w.document.open();
                w.document.write(data);
                w.document.close();
                // w.document.focus();
        });
    });

    $(document).on('click', '#open_search', function(){
        var id  = $(this).attr('id1');
        const show_search = $("#show_search");
        if(id == '0'){
            
            show_search.css("display", "");
            $('#open_search').attr('id1', '1');
        }else if(id == '1'){
            show_search.css("display", "none");
            $('#open_search').attr('id1', '0');

        }
        
    });

   

    $(document).on('click', '#export_bank', function(){
       var value     = $('#value').val();

        window.open('export/excel_bank.php?value='+value+'', '_blank');
    

    });
});
</script>