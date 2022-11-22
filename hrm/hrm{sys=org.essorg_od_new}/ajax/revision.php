<?php
include "../../../application/session/session_ess.php";

$req_id     = $_POST['id'];


?>
<input type="hidden" id="revision_reqid" value="<?php echo $req_id; ?>">

<div class="modal-body">
    <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name"><b style="font-weight:bold">Remarks *</b></div>
                    <!-- <div class="col-sm-9" >
                        <div class="input-group">
                            <textarea class="textarea--style-6" id="jt_desc_en" name="jt_desc_en" placeholder="Misi"></textarea>     
                        </div>
                       
                    </div> -->
                </div>
                <div class="form-row">
                    
                    <div class="col-sm-12" >
                        <div class="input-group">
                            <textarea class="textarea--style-6" id="revision_remarks" name="revision_remarks" placeholder="Remarks"></textarea>     
                        </div>
                       
                    </div>
                </div>
    </fieldset>
    <div class="modal-footer">
                                                                     

                                                                             <button type="submit" id="submit_revision" id1="1"
                                                                                    class="btn btn-success btn-sm submit" data-dismiss="modal">Submit</button>
                                                                      </div>
                                                               </div>
</div>

