<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<?php
       include "../../../application/session/session_ess.php";
       $no = 1; 
	$rfid = $_POST['nc'];
       $username = $_SESSION['username'];
	//$modal_id = '1';
       $sql_approval = mysqli_query($connect, "SELECT 
                            a.position_id,
                            a.req,
                            b.emp_no,
                            b.Full_Name,
                            CASE 
                                   WHEN a.`status` = '1' THEN 'Has been approved'
                                   ELSE ''
                                   END AS req_status 
                            FROM hrmrequestapproval a
                            INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
                            AND a.request_no = '$rfid' AND a.req = 'Notification'

                            UNION ALL

                            SELECT 
                            a.position_id,
                            a.req,
                            b.emp_no,
                            b.Full_Name,
                            CASE 
                                   WHEN a.`status` = '1' THEN 'Has been approved'
                                   ELSE ''
                                   END AS req_status 
                            FROM hrmrequestapproval a
                            INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
                            AND a.request_no = '$rfid' AND a.req = 'Sequence'

                            UNION ALL

                            SELECT 
                            a.position_id,
                            a.req,
                            b.emp_no,
                            b.Full_Name,
                            CASE 
                                   WHEN a.`status` = '1' THEN 'Has been approved'
                                   ELSE ''
                                   END AS req_status 
                            FROM hrmrequestapproval a
                            INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
                            AND a.request_no = '$rfid' AND a.req = 'Required'");

       $sql_data_request = mysqli_query($connect, "SELECT 
       DISTINCT(a.request_no),
       b.name_en
       FROM hrmrequestapproval a 
       LEFT JOIN hrmstatus b ON a.request_status = b.code
       WHERE a.request_no = '$rfid'");

       $data_request = mysqli_fetch_assoc($sql_data_request);
?>
<div style="padding-left:5px; padding-right:5px">
<table cellpadding="1" cellspacing="1" style="width:100%">
  <tbody>
    <tr>
      <td style="font-weight: bold;font-size: x-small;">
        Request Number :
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small;">
        <?php echo $rfid; ?>                                   
      </td>
    </tr>
    <tr>
      <td style="font-weight: bold;font-size: x-small;">
        Request Status:
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small;">
        <span class="badge badge-secondary"><?php echo $data_request['name_en']; ?></span>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="font-weight: bold;font-size: x-small;">
        Waiting Approval From :
      </td>
    </tr>
  </tbody>
</table>

<table cellpadding="1" cellspacing="1" style="width:100%">

<?php
                            
      	while($r=mysqli_fetch_array($sql_approval)){


?>
    <tr>
      <td nowrap="nowrap" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        Step <?php echo $no; ?> :
      </td>
      <td colspan="3" style="font-weight: bold;font-size: x-small; vertical-align: top;">
        <?php echo $r['Full_Name']; ?>, <?php echo $r['req']; ?>                  
      </td>
    </tr>
    <tr>
      <td>     
      </td>
      <td colspan="3" style="font-weight: bold; color:#ffa759;font-size: x-small; vertical-align: top;font-size: smaller;font-family: verdana;font-style: oblique;">
      <?php echo $r['req_status']; ?> 
      </td>
    </tr>
    <?php
    $no++;
    }
    ?>
   

</table>

<?php 

$sql_validasi_approval = mysqli_query($connect, "SELECT
distinct(a.request_no),
notif.reqnotif,
notif.statusnotif,
sec.reqseq,
sec.statusseq,
req.reqreq,
req.statusreq,
my.myreq,
my.mystatus,
case
   when my.myreq = 'Notification' AND my.mystatus = '0' AND sec.statusseq = '0' AND a.request_status <> '8' AND a.request_status <> '4' AND a.request_status <> '5' then '1'
   when my.myreq = 'Sequence' AND my.mystatus = '0' AND notif.statusnotif = '1' AND a.request_status <> '8' AND a.request_status <> '4' AND a.request_status <> '5' then '1'
   when my.myreq = 'Required' AND my.mystatus = '0' AND sec.statusseq = '1' AND a.request_status <> '8' AND a.request_status <> '4' AND a.request_status <> '5' then '1'
   ELSE '0'
END AS overal_status
FROM hrmrequestapproval a
LEFT JOIN ( SELECT b.request_no, b.status AS statusnotif,  b.req AS reqnotif
 FROM hrmrequestapproval b
 WHERE b.req = 'Notification'
) notif ON notif.request_no = a.request_no
LEFT JOIN ( SELECT c.request_no, c.status AS statusseq,  c.req AS reqseq
 FROM hrmrequestapproval c
 WHERE c.req = 'Sequence'
) sec ON sec.request_no = a.request_no
LEFT JOIN ( SELECT d.request_no, d.status AS statusreq,  d.req AS reqreq
 FROM hrmrequestapproval d
 WHERE d.req = 'Required'
) req ON req.request_no = a.request_no
LEFT JOIN (
SELECT 
e.request_no, e.`status` AS mystatus, e.req AS myreq
FROM hrmrequestapproval e WHERE e.approval_list = (SELECT pos_code FROM view_employee WHERE emp_no = '$username')
) my ON my.request_no = a.request_no
WHERE a.request_no = '$rfid'");

$data_validasi_approval = mysqli_fetch_assoc($sql_validasi_approval);

?>

<?php 
if($data_validasi_approval['overal_status'] == '1'){
?>
<div id="menu_approval">
<table width="100%">
       <tr>
              <td width="50%"></td>
              <td width="5%">
                    <a href='#' id="approve" id1="<?php echo $rfid; ?>"><img src='../../asset/img/icons/acticon-ok.png'></a>
              </td>
              <td width="5%">
                    <a href='#' id="revised"><img src='../../asset/img/icons/acticon-rev.png'></a>
              </td>
              <td width="5%">
                    <a href='#' id="rejected" id1="<?php echo $rfid; ?>"><img src='../../asset/img/icons/acticon-no.png'></a>
              </td>
       </tr>
</table>
<?php 
}
?>
</div>

<div id="menu_revised" style="display:none">
<hr style="margin-bottom:0px">
<table width="100%">
  <tr>
    <td>
      <p style="font-weight:bold">Write Revised Reason :</p>
    </td>
  </tr>
       <tr>
              <td width="100%">
                <table width="100%">
                  <tr>
                    <td>
                    <textarea class="textarea--style-6" id="revised_reason" name="revised_reason" placeholder=""></textarea>
                    </td>
                  </tr>
                </table>
              </td>
       </tr>
       <tr>
         <td width="100%">
           <table width="100%">
             <tr>
               <td width="50%"></td>
               <td width="5%"><button class="btn btn-primary btn-sm" id="cancel_reject">Cancel</button></td>
               <td width="5%"><button class="btn btn-warning btn-sm" id="submit_revised" id1="<?php echo $rfid; ?>">Submit</button></td>
             </tr>
           </table>
         </td>
       </tr>
</table>
</div>


</div>

<script>

$(document).ready(function() {
  $(document).on('click', '#revised', function(){
        const show_approval = $("#menu_approval");
        show_approval.css("display", "none");
        const show_revised = $("#menu_revised");
        show_revised.css("display", "");
  })

  $(document).on('click', '#cancel_reject', function(){
        const show_approval = $("#menu_approval");
        show_approval.css("display", "");
        const show_revised = $("#menu_revised");
        show_revised.css("display", "none");
  })

  $(document).on('click', '#submit_revised', function(){

var revised_reason       = $('#revised_reason').val();
var req_no               = $(this).attr('id1');  

if(revised_reason == ''){
alert('Revised reason is required!');
return;
}

let formData = new FormData();
formData.append('revised_reason', revised_reason);
formData.append('req_no', req_no);

$.ajax({
type: 'POST',
url: "ajax/submit_revised.php",
data: formData,
cache: false,
processData: false,
contentType: false,
success: function (msg) {
 
 dataTable.ajax.reload();

 modals.style.display ="block";
 mymodalss.style.display = "none";
 $('#msg').html(msg);

 $('#modal-default').modal('hide');  
 $("[data-dismiss=modal]").trigger({type: "click"});  

 
}

});

});

$(document).on('click', '#approve', function(){

var req_no               = $(this).attr('id1');  


let formData = new FormData();
formData.append('req_no', req_no);

$.ajax({
type: 'POST',
url: "ajax/submit_approve.php",
data: formData,
cache: false,
processData: false,
contentType: false,
success: function (msg) {
 
 dataTable.ajax.reload();

 modals.style.display ="block";
 mymodalss.style.display = "none";
 $('#msg').html(msg);

 $('#modal-default').modal('hide');  
 $("[data-dismiss=modal]").trigger({type: "click"});  

 
}

});

});

$(document).on('click', '#rejected', function(){

var req_no               = $(this).attr('id1');  


let formData = new FormData();
formData.append('req_no', req_no);

$.ajax({
type: 'POST',
url: "ajax/submit_rejected.php",
data: formData,
cache: false,
processData: false,
contentType: false,
success: function (msg) {
 
 dataTable.ajax.reload();

 modals.style.display ="block";
 mymodalss.style.display = "none";
 $('#msg').html(msg);

 $('#modal-default').modal('hide');  
 $("[data-dismiss=modal]").trigger({type: "click"});  

 
}

});

});
})
</script>




