<?php 
include "../../../application/config.php";
    !empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
	if($getdata == 0) {
		include "../../../application/session/sessionlv2.php";
	} else {
		include "../../../application/session/mobile.session.php";	
	}
date_default_timezone_set('Asia/Bangkok'); 
?>

<?php
$token      = $_GET['token']; //NO IDENTITY
$req_no     = $_GET['req_no']; //NO REQUEST
$target     = $_GET['target']; //mid full
$period     = $_GET['period'];
$ipp_id     = $_GET['ipp_id']; //ipp_id
$data_file  = "file$token"; //NO BATCH UPLOAD

if($_GET['code'] == '22')
{
 $test      = explode('.', $_FILES["$data_file"]["name"]);
 $size      = $_FILES["$data_file"]["size"];
 $ext       = end($test);
 $ori       = $_FILES["$data_file"]["name"];
 $name = '01-'. $token . '-' . $ipp_id . '-' . $req_no . '.' . $ext;
 $location  = '../../../asset/request.file.appraisal.attachment/' . $name;  
        if(move_uploaded_file($_FILES["$data_file"]["tmp_name"], $location)){
            $process = mysqli_query($connect, "INSERT INTO `hrmperf_iprecord` 
                                                                (
                                                                    `ipp_reqno`, 
                                                                    `ipp_id`, 
                                                                    `kpi_perspektif_id`, 
                                                                    `ip_period`, 
                                                                    `filename`, 
                                                                    `remark`, 
                                                                    `view`, 
                                                                    `view_date`,
                                                                    `document_reference`,
                                                                    `target`,
                                                                    `created_date`, 
                                                                    `created_by`, 
                                                                    `modified_date`, 
                                                                    `modified_by`
                                                                ) 
                                                                        VALUES (
                                                                                    '$req_no', 
                                                                                    '$ipp_id', 
                                                                                    '$token', 
                                                                                    '$period', 
                                                                                    '$name', 
                                                                                    '1', 
                                                                                    '1', 
                                                                                    '0000-00-00 00:00:00',
                                                                                    'appraisal.effident',
                                                                                    '$target',
                                                                                    '$SFdatetime', 
                                                                                    '$username', 
                                                                                    '$SFdatetime',
                                                                                    '$username'
                                                                                ) ON DUPLICATE KEY UPDATE 
                                                                                    
                                                                                    `modified_date` = '$SFdatetime',
                                                                                    `modified_by`   = '$username'");

            if($process){
                echo '<a href="../../../asset/request.file.appraisal.attachment/'.$name.'"><img style="width: 100%;" src="../../../asset/request.file.appraisal.attachment/excel.png" height="425" width="425" class="img-thumbnail" /></a>';
            } else {
                echo '<a href="#"><img style="width: 100%;" src="../../../asset/request.file.appraisal.attachment/notallowed.png" height="425" width="425" class="img-thumbnail" /></a>';
            }

            // 
        } else {
           
        }
}
?>