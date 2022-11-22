<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";	
}
?>

<link rel="stylesheet" href="../../../asset/gt_developer/developer_hris_form.css" />

<?php
       include "../../../application/config.php";
       $id = $_GET['rfid'];
	$modal=mysqli_query($connect, 
	"SELECT 
	a.*,
       b.emp_no,
       b.Full_name
	FROM hrmleaverequest a
       LEFT JOIN view_employee b on a.emp_id=b.emp_id
	WHERE a.request_no='$id'
	GROUP BY a.request_no
	");
	while($r=mysqli_fetch_array($modal)){
?>






<table border="1" width="80%" class="table table-bordered table-striped table-hover table-head-fixed">
       <thead>
              <tr>

                     <th class="fontCustom">Doc Number</th>
                     <th class="fontCustom">File Name</th>

              </tr>
       </thead>
       <?php
                                                        $sql = mysqli_query($connect, "SELECT `request_no`,`file_name`,DATE_FORMAT(`created_date`, '%d %M %Y %H:%i:%s') as `created_date` FROM hrmattachment where `request_no` = '$id' order by created_date desc");
                                                        $no = 0;
                                                        $no++;
                                                        while ($r = mysqli_fetch_array($sql)) {
                                                        ?>
       <tr>
              <td href='#'><?php echo $r['request_no']; ?></td>
              <td class='fontCustom'>

                     <button type="button" id="mymodal" class="btn btn-primary" data-toggle="modal"
                            data-target='#FormDisplayAttachmentPreviewRequest' onclick='PreviewAttachment(`<?php echo $r[request_no] ?>`) '>
                            see file 
                     </button>



              </td>

              <?php
                                                 }                    
                                                 ?>
</table>



<?php } ?>