<?php
    !empty($_GET['rfid']) ? $getdata = '1' : $getdata = '0'; 
    if($getdata == 0) {
           include "../../application/session/session.php";
    } else {
           include "../../application/session/mobile.session.php";	
    }
    
	$rfid = $_GET['rfid'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, 
	"SELECT 
       c.seq_id
	FROM view_employee a
       LEFT JOIN hrmorgstruc b on a.position_id=b.position_id
       LEFT JOIN tclcreqappsetting_final c on b.pos_code=c.position_id
	WHERE a.emp_no='$rfid'
	GROUP BY a.emp_no
	");

	while($r=mysqli_fetch_array($modal)){

       $var1 =  $r['seq_id'];
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<style>
body {
       font-family: Arial;
}

/* Style the tab */
.tab {
       overflow: hidden;
       border: 1px solid #ccc;
       background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
       background-color: inherit;
       float: left;
       border: none;
       outline: none;
       cursor: pointer;
       padding: 14px 16px;
       transition: 0.3s;
       font-size: 12px;
}

/* Change background color of buttons on hover */
.tab button:hover {
       background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
       background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
       display: none;
       padding: 6px 12px;
       border: 1px solid #ccc;
       border-top: none;
}

/* Style the close button */
.topright {
       float: right;
       cursor: pointer;
       font-size: 28px;
}

.topright:hover {
       color: red;
}
</style>




<fieldset id="fset_1">
      <!-- <legend>Workflow List Approval <php echo $var1; ?> <php echo $rfid; ?></legend> -->
      <legend>Workflow List Approval</legend>


              <p>
              <table cellpadding="1" cellspacing="1" style="width:100%">
                     <tr>
                            <td style="font-weight: bold;font-size: x-small;">
                                   Workflow Name :
                            </td>
                            <td colspan="3" style="font-weight: bold;font-size: x-small;">
                                   <?php echo $rfid ?>
                            </td>
                     </tr>
                     <tr>


                     <tr>
                            <td style="vertical-align:top" align='center'>
                                   <table cellpadding="1" cellspacing="1" style="width:100%">
                                          <tbody>
                                                 <tr>
                                                        <td width="10px" align='center'
                                                               style="color:white; background-color: #a29e9e;">
                                                               Step1</td>
                                                 </tr>
                                                 <?php 
                                                               $no = 0;
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               a.emp_no as seq_id,
                                                               a.empno_appvr1,
                                                               x2.full_name,
                                                               x2.emp_no,
                                                               x2.position_id,
                                                               x2.pos_code as request_approval_formula,
                                                               'Notification' as req,
                                                               '0' as ordering
                                                               FROM tclcdreqappsetting a
                                                               LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                                                               LEFT JOIN view_employee x2 on a.empno_appvr1=x2.emp_no
                                                               where a.emp_no = '$rfid'
                                                               GROUP BY x2.emp_no");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>
                                                 <tr>
                                                        <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                               align='left'>
                                                               <?php echo $rs['request_approval_formula']; ?><br>
                                                               <?php echo $rs['full_name']; ?>
                                                               [<?php echo $rs['emp_no']; ?>]</td>
                                                 </tr>
                                                 <?php } ?>
                                          </tbody>
                                   </table>
                            </td>
                            <td style="vertical-align:top" align='center'>
                                   <table cellpadding="1" cellspacing="1" style="width:100%">
                                          <tbody>
                                                 <tr>
                                                        <td width="10px" align='center'
                                                               style="color:white; background-color: #a29e9e;">
                                                               Step2</td>
                                                 </tr>
                                                 <?php 
                                                               $no = 0;
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               a.emp_no as seq_id,
                                                               a.empno_appvr2,
                                                               x2.full_name,
                                                               x2.emp_no,
                                                               x2.position_id,
                                                               x2.pos_code as request_approval_formula,
                                                               'Sequence' as req,
                                                               '0' as ordering
                                                               FROM tclcdreqappsetting a
                                                               LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                                                               LEFT JOIN view_employee x2 on a.empno_appvr2=x2.emp_no
                                                               where a.emp_no = '$rfid'
                                                               GROUP BY x2.emp_no");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>
                                                 <tr>
                                                        <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                               align='left'>
                                                               <?php echo $rs['request_approval_formula']; ?><br>
                                                               <?php echo $rs['full_name']; ?>
                                                               [<?php echo $rs['emp_no']; ?>]</td>
                                                 </tr>
                                                 <?php } ?>
                                          </tbody>
                                   </table>
                            </td>

                            <td style="vertical-align:top" align='center'>
                                   <table cellpadding="1" cellspacing="1" style="width:100%">
                                          <tbody>
                                                 <tr>
                                                        <td width="10px" align='center'
                                                               style="color:white; background-color: #a29e9e;">
                                                               Step3</td>
                                                 </tr>
                                                 <?php 
                                                               $no = 0;
                                                               $modals=mysqli_query($connect, "SELECT 
                                                               a.emp_no as seq_id,
                                                               a.empno_appvr3,
                                                               x2.full_name,
                                                               x2.emp_no,
                                                               x2.position_id,
                                                               x2.pos_code as request_approval_formula,
                                                               'Sequence' as req,
                                                               '0' as ordering
                                                               FROM tclcdreqappsetting a
                                                               LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                                                               LEFT JOIN view_employee x2 on a.empno_appvr3=x2.emp_no
                                                               where a.emp_no = '$rfid'
                                                               GROUP BY x2.emp_no");

                                                               while($rs=mysqli_fetch_array($modals)){
                                                               $no++;	
                                                        ?>
                                                 <tr>
                                                        <td style="padding-left: 12px; font-weight: bold;font-size: x-small;"
                                                               align='left'>
                                                               <?php echo $rs['request_approval_formula']; ?><br>
                                                               <?php echo $rs['full_name']; ?>
                                                               [<?php echo $rs['emp_no']; ?>]</td>
                                                 </tr>
                                                 <?php } ?>
                                          </tbody>
                                   </table>
                            </td>
                     </tr>
              </table>
              </p>



</fieldset>


<script>
function openCity(evt, cityName) {
       var i, tabcontent, tablinks;
       tabcontent = document.getElementsByClassName(
              "tabcontent");
       for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
       }
       tablinks = document.getElementsByClassName(
              "tablinks");
       for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i]
                     .className.replace(" active", "");
       }
       document.getElementById(cityName).style.display =
              "block";
       evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>




</div>

</div>
</div>
</div>
<?php } ?>