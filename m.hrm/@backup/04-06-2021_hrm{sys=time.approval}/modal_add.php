<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Add Leave Request</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>

              <form method="post" id="myform">
                     <div class="modal-body">
                            <table cellpadding="1" cellspacing="1" style="width:100%">
                                   <div id="divForm">
                                          <fieldset id="fset_1">
                                                 <legend>Personal Data</legend>
                                                 <table style="width: 95%;">
                                                        <tbody>
                                                               <tr id="tr_inp_identity_no" class="clTR1">
                                                                      <td class="label" width="30%"><label
                                                                                    id="modal_emp"
                                                                                    name="modal_emp"
                                                                                    for="modal_emp" title="">ID
                                                                                    Number
                                                                                    <span
                                                                                           class="required">*</span></label>
                                                                      </td>
                                                                      <td class="" id="tdb_1"><input
                                                                                    style="margin-bottom: 2px;"
                                                                                    id="three"
                                                                                    required="required"
                                                                                    name="modal_emp" type="Text"
                                                                                    value="" onfocus="hlentry(this)"
                                                                                    size="30" maxlength="50" 
                                                                                    validate="NotNull:Invalid Form Entry"
                                                                                    onchange="formodified(this);"
                                                                                    title="">
                                                                      </td>
                                                               </tr>
                                                               
                                                               <tr id="tr_inp_religion_code" class="clTR1">
                                                                      <td class="label" width="100%"><label
                                                                                    id="lbl_inp_religion_code"
                                                                                    for="inp_religion_code"
                                                                                    title="">Leave Request Type
                                                                                    <span
                                                                                           class="required">*</span></label>
                                                                      </td>
                                                                      <td class="" id="tdb_1"><select
                                                                                    style="margin-bottom: 2px; width: 100%;"
                                                                                    id="modal_leave_code"
                                                                                    name="modal_leave_code"
                                                                                    onfocus="hlentry(this)"
                                                                                    onchange="formodified(this);"
                                                                                    style="width:undefined">
                                                                                    <option value="">--Select One--
                                                                                    </option>
                                                                                    <option value="ANL">Cuti
                                                                                    </option>
                                                                                    <option value="ANLVHDLV">Cuti Setengah Hari
                                                                                    </option>
                                                                                    <option value="PERM">Ijin
                                                                                    </option>
                                                                                    <option value="SICK">Sakit
                                                                                    </option>
                                                                                    
                                                                             </select></td>
                                                               </tr>

                                                               <tr id="tr_inp_identity_no" class="clTR1">
                                                                      <td class="label" width="30%"><label
                                                                                    id="modal_emp"
                                                                                    name="modal_remark"
                                                                                    for="modal_emp" title="">ID
                                                                                    Number
                                                                                    <span
                                                                                           class="required">*</span></label>
                                                                      </td>
                                                                      <td class="" id="tdb_1"><textarea
                                                                                    style="margin-bottom: 2px; height: 127px;width: 100%;"
                                                                                    id="three"
                                                                                    required="required"
                                                                                    name="modal_remark" type="Text"
                                                                                    value="" onfocus="hlentry(this)"
                                                                                    size="100" maxlength="250" 
                                                                                    validate="NotNull:Invalid Form Entry"
                                                                                    onchange="formodified(this);"
                                                                                    title=""></textarea>
                                                                      </td>
                                                               </tr>

                                                        </tbody>


                                                 </table>

                                                 <br>
                                                 <tr>
                                                        <td colspan="2" align="right" width="100%">
                                                               <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>

                                                                             <script language="javascript" type="text/javascript">
                                                                                           function OpenPopupCenter(val, pageURL, title, w, h) {
                                                                                                  var left = (screen.width - w) / 2;
                                                                                                  var top = (screen.height - h) / 50;  // for 25% - devide by 4  |  for 33% - devide by 3
                                                                                                  var targetWin = window.open('window_approver.php?rfid=' + val, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + 50 + ', left=' + left);
                                                                                           } 
                                                                                    </script>
                                                                             </head>

                                                                             <body>
                                                                             <a id="four"  class="btn btn-primary" name="four" onclick="OpenPopupCenter(this.value, 'TEST!?', 450, 900);" target="_blank">Preview Approver</a>
                                                                            
                                                                             </body>


     
                                                                            
                                                                             <script>
                                                                             $(function () {
                                                                             var $src = $('#three'),
                                                                                    $dst = $('#four');
                                                                             $src.on('input', function () {
                                                                                    $dst.val($src.val());
                                                                             });
                                                                             });
                                                                             </script>

                                                                          
                                                                             <button type="submit"
                                                                                    name="submit_add"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
                                                        </td>
                                                 </tr>
                                          </fieldset>


                            </table>
                     </div>
              </form>
       </div>

</div>
</div>
</div>