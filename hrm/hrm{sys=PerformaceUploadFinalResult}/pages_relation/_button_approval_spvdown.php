<?php
include "../../../application/config.php";
       !empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
	if($getdata == 0) {
		include "../../../application/session/sessionlv2.php";
	} else {
		include "../../../application/session/mobile.session.php";	
	}
	$rfid = $_GET['rfid'];
	
       $get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
	$get_data_print_0    = $get_data_0['position_id'];

       // CARI UDAH APPROVED BELUM DIA
	$get_approver               = mysqli_query($connect, "SELECT 
                                          a.*
                                                 FROM 
                                          hrmrequestapproval a
                                          WHERE 
                                                 a.request_no = '$rfid' AND
                                                 a.position_id='$get_data_print_0' AND
                                                 a.status = '0'");
       $is_any = mysqli_num_rows($get_approver);
       if($is_any == 0){
              $button_status_hide_or_no = 'display:none;';
       } else {
              $button_status_hide_or_no = '';
       }
       // CARI UDAH APPROVED BELUM DIA
?>

       <button type="reset" class="btn btn-primary1" style="background: #e1e1e1;" data-dismiss="modal"
              aria-hidden="true" data-backdrop="false">
              &nbsp;Cancel&nbsp;
       </button>
       <a style="<?php echo $button_status_hide_or_no; ?>; color: white;" class="btn btn-warning" name="submit_reject_spvdown" id="submit_reject_spvdown" data-toggle="modal" data-target="#FormDisplayRejectSPVDOWN">
              &nbsp;&nbsp;Reject&nbsp;&nbsp;
       </a>
        <a style="<?php echo $button_status_hide_or_no; ?>; color: white;" class="btn btn-warning" name="submit_revision_spvdown"  id="submit_revision_spvdown" data-toggle="modal" data-target="#FormDisplayrevisionSPVDOWN">
              &nbsp;Revision&nbsp;
       </a>
       <button class="btn btn-warning" type="submit" name="submit_approval_spvdown" id="submit_approval_spvdown">
              Approved
       </button>
       <button class="btn btn-warning" type="button" name="submit_approval_spvdown2"
              id="submit_approval_spvdown2" style='display:none;' disabled>
              <span class="spinner-grow spinner-grow-sm" role="status"
                     aria-hidden="true"></span>
              &nbsp;&nbsp;Processing..
       </button>
