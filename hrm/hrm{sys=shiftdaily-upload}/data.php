<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>


<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <h4 class="card-title mb-0">Shift Daily Upload </h4>


                     <div class="card-actions ml-auto">
                            <table>
                                   <td>
                                          <a href='#'>
                                          <div class="toolbar sprite-toolbar-reload" id="RELOAD" title="Reload"
                                                 onclick="RefreshPage();">
                                          </div>
                                          </a>
                                   </td>
                                   <!-- AgusPrass 02/03/2021 -->
                            </table>
                     </div>
              </div>
              

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 98%; margin: 5px;overflow: scroll;">
                     <script type="text/javascript">
                                                        function validateForm()
                                                        {
                                                               function hasExtension(inputID, exts) {
                                                               var fileName = document.getElementById(inputID).value;
                                                               return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
                                                               }
                                                               if(!hasExtension('filepegawaiall', ['.xls'])){
                                                               alert("Hanya file XLS (Excel 2003) yang diijinkan.");
                                                               return false;
                                                               }
                                                        }
                     </script>

                     <form name="myForm" id="myForm" enctype="multipart/form-data" action="php_action/FuncDataUpload.php" method="post" target="popupwindow" onsubmit=" return validateForm(), window.open('php_action/FuncDataUpload.php', 'popupwindow', 'scrollbars=yes,toolbar=no,width=800,height=400');"> 
                     
                     <fieldset id="fset_1">
                                   <legend>Employee Shift Upload</legend>
                                   <div class="form-row">
                                          <div class="col-4 name">Upload Excel File <span class="required">*</span></div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        
                                                        <input type="file" id="filepegawaiall" name="filepegawaiall" />
                                                              
                                                               <input name="date" class="hidden" type="hidden" value="<?php echo date('Y-m-d H:i:s') ?>">
                                                        
                                                        
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Upload Type </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group" style="margin-left: -15px;">                                          
                                                        <div class="form-check form-check-inline">
                                                               <div class="custom-control custom-radio">
                                                                      <input type="radio" name="inp_upload_type" value="SH" checked="checked" class="custom-control-input" id="customControlValidation2" name="radio-stacked">
                                                                      <label class="custom-control-label" for="customControlValidation2">Vertical</label>
                                                               </div>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                               <div class="custom-control custom-radio">
                                                                      <input type="radio" name="inp_upload_type" value="RM" class="custom-control-input" id="customControlValidation3" name="radio-stacked">
                                                                      <label class="custom-control-label" for="customControlValidation3">By Table</label>
                                                               </div>
                                                        </div>
                                                        <script>
                                                        $(document).ready(function(){
                                                               $("#customControlValidation3").click(function(){
                                                                      $("#SH").hide();
                                                                      $("#RM").show();
                                                                      $("#SHT").hide();
                                                                      $("#RMT").show();
                                                               });
                                                               $("#customControlValidation2").click(function(){
                                                                      $("#RM").hide();
                                                                      $("#SH").show();
                                                                      $("#RMT").hide();
                                                                      $("#SHT").show();
                                                               });
                                                        });
                                                        </script>
                                                 </div>
                                          </div>
                                   </div>

                                    <div class="form-row">
                                          <div class="col-4 name">Action Type </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group" style="margin-left: -15px;">
                                                        <div class="form-check form-check-inline">
                                                               <div class="custom-control custom-radio">
                                                                      <input type="radio" name="inp_action_type" value="AT" checked="checked" class="custom-control-input" id="customControlValidation2" name="radio-stacked">
                                                                      <label class="custom-control-label" for="customControlValidation2">Upload Shift Data</label>
                                                               </div>
                                                        </div>
                                                        
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row" id="SH">
                                          <div class="col-4 name">Download Template </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <a target="_blank" href="../../asset/upload/template_shiftupload.xls">template_shiftupload.xls</a>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row" id="RM" style="display:none;">
                                          <div class="col-4 name">Download Template </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <a target="_blank" href="../../asset/upload/template_shiftupload_bytable.xls">template_shiftupload_bytable.xls</a>
                                                 </div>
                                          </div>
                                   </div>
                                   

                                   <div class="form-row">
                                          <div class="col-4 name"> </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <button type="submit" name="submit" style="width: 135px;" value="Upload" class="btn btn-rounded btn-warning btn-sm text-white d-inline-block">Upload</button><br/>
                                                 </div>
                                          </div>
                                   </div>

                                    
                            </fieldset>
                            </form>


                            <fieldset id="SHT">
                                   <legend>Template</legend>

                                   <table style="width: 95%;"><tbody><tr id="tr_inp_templateupload" class="clTR1" ><td class="label" width="30%"><label id="lbl_inp_templateupload" for="inp_templateupload" title=""></label></td><td class="" id="tdb_1"><span id="inp_templateupload" title="" style="cursor: default;">
                                   <table cellspacing="0" cellpadding="0" border="0" bgcolor="#CDCDCD">
                                          <tbody><tr><td width="100%">
                                                 <div id="templateforupload" class="tableContainer">
                                                 <table width="100%" cellspacing="1" cellpadding="3" border="0">
                                                        
                                                        <tbody><tr class="colheaderrel">
                                                               <td colspan="5" align="center" style="background: grey;font-weight: bold;color: white;">Template for Upload</td>
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Name</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">EMPNO</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">DATE</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">SHIFTCODE</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">OLDSHIFTCODE</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Description</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Employee No</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Date</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Daily Code</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Old Shift Daily Code</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Data Type</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">date</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                        </tr>
                                                        
                                                 </tbody></table>
                                                 </div>
                                                 </td>
                                          </tr>
                                   </tbody></table>	
                                   </span></td></tr><tr id="tr_inp_tableupload" class="clTR1" style="display: none;"><td class="label" width="30%"><label id="lbl_inp_tableupload" for="inp_tableupload" title=""></label></td><td class="" id="tdb_1"><span id="inp_tableupload" title="" style="cursor: default;">
                                   <table cellspacing="0" cellpadding="0" border="0" bgcolor="#CDCDCD">
                                          <tbody><tr><td width="100%">
                                                 <div id="templateforupload" class="tableContainer">
                                                 <table width="100%" cellspacing="1" cellpadding="3" border="0">
                                                        
                                                        <tbody><tr class="colheaderrel">
                                                               <td colspan="5" align="center">Template for Upload</td>
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Name</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">EMPNO</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Date - 1</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">...</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Date - n</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Description</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Employee No</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Daily Code - 1</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">...</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Daily Code - n</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Data Type</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">...</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                        </tr>
                                                        
                                                 </tbody></table>
                                                 </div>
                                                 </td>
                                          </tr>
                                   </tbody></table>	
                                   </span></td></tr><tr id="tr_inp_tabledaytypechange" class="clTR1" style="display: none;"><td class="label" width="30%"><label id="lbl_inp_tabledaytypechange" for="inp_tabledaytypechange" title=""></label></td><td class="" id="tdb_1"><span id="inp_tabledaytypechange" title="" style="cursor: default;">
                                   <table cellspacing="0" cellpadding="0" border="0" bgcolor="#CDCDCD">
                                          <tbody><tr><td width="100%">
                                                 <div id="templateforupload" class="tableContainer">
                                                 <table width="100%" cellspacing="1" cellpadding="3" border="0">
                                                        
                                                        <tbody><tr class="colheaderrel">
                                                               <td colspan="3" align="center">Template for Upload</td>
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Name</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">EMPNO</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">DATE</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Description</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Employee No</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Holiday Date</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Data Type</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">date</td>
                                                               
                                                        </tr>
                                                        
                                                 </tbody></table>
                                                 </div>
                                                 </td>
                                          </tr>
                                   </tbody></table>	
                                   </span></td></tr></tbody>
                                   </table>

                                  
                            </fieldset>
                            
                            
                            
                            <fieldset id="RMT" style="display:none;">
                                   <legend>Template</legend>

                                   <table style="width: 95%;"><tbody><tr id="tr_inp_templateupload" class="clTR1" ><td class="label" width="30%"><label id="lbl_inp_templateupload" for="inp_templateupload" title=""></label></td><td class="" id="tdb_1"><span id="inp_templateupload" title="" style="cursor: default;">
                                   <table cellspacing="0" cellpadding="0" border="0" bgcolor="#CDCDCD">
                                          <tbody><tr><td width="100%">
                                                 <div id="templateforupload" class="tableContainer">
                                                 <table width="100%" cellspacing="1" cellpadding="3" border="0">
                                                        
                                                        <tbody><tr class="colheaderrel">
                                                               <td colspan="5" align="center" style="background: grey;font-weight: bold;color: white;">Template for Upload</td>
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Name</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">EMPNO</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Date - 1</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">...</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Date - n</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Description</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Employee No</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Daily Code - 1</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">...</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Shift Daily Code - n</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Data Type</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">...</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                        </tr>
                                                        
                                                 </tbody></table>
                                                 </div>
                                                 </td>
                                          </tr>
                                   </tbody></table>	
                                   </span></td></tr><tr id="tr_inp_tabledaytypechange" class="clTR1" style="display: none;"><td class="label" width="30%"><label id="lbl_inp_tabledaytypechange" for="inp_tabledaytypechange" title=""></label></td><td class="" id="tdb_1"><span id="inp_tabledaytypechange" title="" style="cursor: default;">
                                   <table cellspacing="0" cellpadding="0" border="0" bgcolor="#CDCDCD">
                                          <tbody><tr><td width="100%">
                                                 <div id="templateforupload" class="tableContainer">
                                                 <table width="100%" cellspacing="1" cellpadding="3" border="0">
                                                        
                                                        <tbody><tr class="colheaderrel">
                                                               <td colspan="3" align="center">Template for Upload</td>
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Name</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">EMPNO</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">DATE</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Column Description</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Employee No</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">Holiday Date</td>
                                                               
                                                        </tr>
                                                        <tr class="oddrow">
                                                               <td class="td_cdata_ardata_1_1_0" nowrap="">Data Type</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">varchar</td>
                                                               
                                                                      <td class="td_cdata_ardata_1_1_0" nowrap="">date</td>
                                                               
                                                        </tr>
                                                        
                                                 </tbody></table>
                                                 </div>
                                                 </td>
                                          </tr>
                                   </tbody></table>	
                                   </span></td></tr></tbody>
                                   </table>

                                  
                            </fieldset>
                   

              </div>
       </div>
</div>



















































                            

</body>

</html>

<script>
jQuery(function($) {
       $("#nip").mask("99-9999");
       $("#nik").mask("9999999999999999");
       $("#join").mask("9999-99-99");
       $("#date").mask("9999-99-99");
       $("#account").mask("9999-9-99999-9");
});
</script>

<script type="text/javascript">
function isi_otomatis() {
       var nip = $("#nip").val();
       $.ajax({
              url: 'ajax_cek.php',
              data: "nip=" + nip,
       }).success(function(data) {
              var json = data,
                     obj = JSON.parse(json);
              $('#nama').val(obj.nama);
              $('#nik').val(obj.nik);
              $('#org').val(obj.org);
              $('#emp').val(obj.emp);
              $('#join').val(obj.join);
              $('#account').val(obj.account);
              $('#norek').val(obj.norek);
              $('#approve').val(obj.approve);
              $('#grp').val(obj.grp);
              $('#jobstatus').val(obj.jobstatus);
       });
}
</script>



                           
      
                        
