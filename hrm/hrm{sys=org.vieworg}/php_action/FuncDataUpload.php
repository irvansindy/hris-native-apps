<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

if ($_POST) {
    $validator = array('success' => false, 'messages' => array());

    $SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");

    $temp = "../../../asset/request.file.attachment/";
    if (!file_exists($temp))
        mkdir($temp);

    $inp_Attachment_request_no  = $_POST['nama_file'];
    $inp_Attachment_emp_no      = $_POST['inp_Attachment_emp_no'];
    $nama_file                  = $_POST['nama_file']."_".$SFnumber;
    $fileupload                 = $_FILES['fileupload']['tmp_name'];
    $ImageName                  = $_FILES['fileupload']['name'];
    $ImageType                  = $_FILES['fileupload']['type'];
    $ImageSize 		            = $_FILES['fileupload']['size'];

    if (!empty($fileupload)) {
        $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt       = str_replace('.', '', $ImageExt); // Extension
        $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $newFilenaming   = str_replace(' ', '', $nama_file . '.' . $ImageExt);

        move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp . $newFilenaming); // Menyimpan file

        $query = "INSERT INTO `hrmattachment` 
                                    (
                                        `request_no`,
                                        `file_name`,
                                        `original_filenames`,
                                        `file_size`,
                                        `file_type`,
                                        `created_date`,
                                        `created_by`,
                                        `modified_date`,
                                        `modified_by`
                                    ) VALUES
                                        (
                                            '$inp_Attachment_request_no',
                                            '$newFilenaming',
                                            '$ImageName',
                                            '$ImageSize',
                                            '$ImageExt',
                                            '$SFdatetime',
                                            '$inp_Attachment_emp_no',
                                            '$SFdatetime',
                                            '$inp_Attachment_emp_no'
                                        )";
        
        $query_1 = $connect->query($query);

        $validator['success'] = false;
        $validator['code'] = "success_message";
        $validator['messages'] = "Successfully attach file";
    } else {
        $validator['success'] = false;
        $validator['code'] = "failed_message";
        $validator['messages'] = "Failed attach file";
    }
    // condition ends

    // close the database connection
    $connect->close();
    echo json_encode($validator);
}