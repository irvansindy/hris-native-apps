<?php include "../config2.php";?>
<?php
$userid     = $_GET['userid'];

    $data = mysqli_fetch_array(mysqli_query($con, "SELECT *, CASE 
                                                        WHEN gender = '1' then 'Laki-laki' 
                                                        ELSE 'Perempuan'
                                                        END AS 'jk'
                                                        FROM view_employee where emp_no='$userid'"));
    $data_fname         = $data['Full_Name'];
    $data_email         = $data['email'];
    $data_jenis_kelamin = $data['jk'];
    $data_no_hp         = $data['phone'];
    $data_tempatlahir   = $data['birthplace'];
    $data_alamat        = $data['address'];


?>

<link rel="stylesheet" href="asset/style.css" />
<link rel="stylesheet" href="asset/developer_hris_form.css" />

              


<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Profile </h4>
                     <div class="toolbar sprite-toolbar-close" aria-label="Close" onclick='return stopload()' data-dismiss="modal" id="SEARCH"
                                                                      title="Search"></div>
              </div>
              <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"
                     onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                         

                 
                            
                            <div class="form-row">
                                   <div class="col-4 name">Nama*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input name="id" type="hidden" class="hidden" value="<?php echo $userid; ?>">
                                                 <input class="input--style-6"
                                                        autocomplete="off" autofocus="on" id="modal_name"
                                                        name="modal_name" type="Text" value="<?php echo $data_fname; ?>"
                                                        onfocus="hlentry(this)" size="30" maxlength="50" 
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title=""
                                                        required>
                                          </div>
                                   </div>
                            </div>
                            
                            <div class="form-row">
                                   <div class="col-4 name">Email*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        autocomplete="off" autofocus="on" id="modal_email"
                                                        name="modal_email" type="Text" value="<?php echo $data_email; ?>"
                                                        onfocus="hlentry(this)" size="30" maxlength="50" 
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title=""
                                                        required>
                                          </div>
                                   </div>
                            </div>
                            
                            <div class="form-row">
                                   <div class="col-4 name">Jenis Kelamin*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                          <select class="input--style-6 modal_leave" name="modal_gender"
                                                        style="height: 30px;" id="modal_gender"
                                                        onchange="isi_otomatis_leave()">

                                               
                                                                                    <option value="<?php echo $data_jenis_kelamin;?>"><?php echo $data_jenis_kelamin; ?>
                                                                                    </option>
                                                                                    <option value="Laki-laki">Laki-laki</option>
                                                                                    <option value="Perempuan">Perempuan</option>
                                                                             </select>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">No Handphone*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        autocomplete="off" autofocus="on" id="modal_hp"
                                                        name="modal_hp" type="Text" value="<?php echo $data_no_hp; ?>"
                                                        onfocus="hlentry(this)" size="30" maxlength="50" 
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title=""
                                                        required>
                                          </div>
                                   </div>
                            </div>

                            <div class="form-row">
                                   <div class="col-4 name">Tempat Lahir*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <input class="input--style-6"
                                                        autocomplete="off" style="height: 30px;"  autofocus="on" id="modal_tempatlahir"
                                                        name="modal_tempatlahir" type="Text" value="<?php echo $data_tempatlahir; ?>"
                                                        onfocus="hlentry(this)" size="30" maxlength="50" 
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title=""
                                                        required>
                                          </div>
                                   </div>
                            </div>

                            <!--<div class="form-row">-->
                            <!--       <div class="col-4 name">Tanggal Lahir*</div>-->
                            <!--       <div class="col-sm-8">-->
                            <!--              <div class="input-group">-->
                            <!--                     <input class="input--style-6"-->
                            <!--                     style="height: 30px;"   autocomplete="off" autofocus="on" id="modal_tanggallahir"-->
                            <!--                            name="modal_tanggallahir" type="date" value="<?php echo $data_tanggallahir; ?>"-->
                            <!--                            onfocus="hlentry(this)" size="30" maxlength="50" -->
                            <!--                            validate="NotNull:Invalid Form Entry"-->
                            <!--                            onchange="formodified(this);" title=""-->
                            <!--                            required>-->
                            <!--              </div>-->
                            <!--       </div>-->
                            <!--</div>-->

                            <hr>

                            
                            
                            <div class="form-row">
                                   <div class="col-4 name">Alamat*</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">
                                                 <textarea class="textarea--style-6" id="inp_remark" name="inp_address"
                                                        placeholder="Alamat"><?php echo $data_alamat; ?></textarea>
                                          </div>
                                   </div>
                            </div>

                            
                           

                    

                            <div class="form-row">
                                   <div class="col-4 name">User Photos </div>
                                   <div class="col-sm-8">
                                          <div class="input-group js-input-file">
                                                 <input class="input-file" id="inp_refdoc" name="inp_refdoc[]"
                                                        type="File" value="" onfocus="hlentry(this)" size="30"
                                                        accept="image/png, image/gif, image/jpeg"
                                                        maxlength="50" style="float: left; margin: -3px;"
                                                        onchange="formodified(this);" title="">
                                          </div>
                                          <div class="label--desc">Update your Photos </div>
                                   </div>
                            </div>

                          
                     </fieldset>


                     <tr>
                            <td colspan="3" align="right" width="100%">
                                   <div class="modal-footer">
                                          <div class="form-group">
                                                 

                                                 <script language="javascript" type="text/javascript">
                                                 var modal_emp = document.getElementById("modal_emp").value;

                                                 function OpenPopupCenter(val, pageURL,
                                                        title, w, h) {
                                                        var left = (screen.width - w) / 2;
                                                        var top = (screen.height - h) /
                                                               50; // for 25% - devide by 4  |  for 33% - devide by 3
                                                        var targetWin = window.open(
                                                               'window_approver?rfid=' +
                                                               modal_emp, title,
                                                               'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' +
                                                               w + ', height=' + h +
                                                               ', top=' + 50 +
                                                               ', left=' + left);
                                                 }
                                                 </script>
                                                 </head>


                                                 <script>
                                                 $(function() {
                                                        var $src = $(
                                                                      '#modal_emp'),
                                                               $dst = $(
                                                                      '#four'
                                                               );
                                                        $src.on('input',
                                                               function() {
                                                                      $dst.val($src
                                                                             .val());
                                                               });
                                                 });
                                                 </script>


                                                 <button type="submit" name="submit_add" id="submit_add"
                                                        class="btn btn-warning">Submit
                                                    </button>
                                                <button class="btn btn-warning button_bot" type="button" name="submit_add2"
                                                         id="submit_add2" style="display:none; cursor: no-drop;" disabled>
                                                         <img src="../../asset/dist/img/Rolling-0.6s-200px.gif" width="30">
                                                  </button>

                                            
                                          </div>
                                   </div>
                            </td>
                     </tr>

              </form>
              
                <script>
                function HrmsValidationForm() {
                       $('#submit_add').hide();
                       $('#submit_add2').show();
                }
                </script>

<?php include "controller_save.php"; ?>
              