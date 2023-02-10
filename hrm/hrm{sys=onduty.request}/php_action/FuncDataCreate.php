<?php
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    if ($_POST) {
        // directory file
        $directoryFile = '../../../asset/request.file.attachment/';

        // allowed file types
        $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'ods');

        $response = [
            'success' => false,
            'message' => []
        ];

        // set time
        $SFdate = date("Y-m-d");
        $SFtime = date('h:i:s');
        $SFdatetime = date("Y-m-d H:i:s");
        $SFnumber = date("YmdHis");

        if (!empty($_FILES['fileupload'])) {
            // set file upload
            $file_name = $_FILES['fileupload']['name'];
            $file_upload = $_FILES['fileupload']['tmp_name'];
            
            // get uploaded file's extension
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // can upload same image using rand function
            $final_image = rand(1000,1000000).$file_name;

            // check allowed file types
            if (in_array($ext, $allowTypes)) {
                $directoryFile = $directoryFile.strtolower($final_image);

                $info_file = getimagesize($file_upload);

                // if ($info_file['mime'] == 'image/jpeg') {
                //     $image = imagecreatefromjpeg($file_upload);
                // } elseif ($info_file['mime'] == 'image/jpg') {
                //     $image = imagecreatefromjpg($file_upload);
                // } elseif ($info_file['mime'] == 'image/png') {
                //     $image = imagecreatefrompng($file_upload);
                // }

                // $uploadDataFile = imagejpeg($image, $directoryFile, 60);

                // upload to directory
                $uploadDataFile = move_uploaded_file($file_upload, $directoryFile);
                // $uploadDataFile = move_uploaded_file($image, $directoryFile);

                if ($uploadDataFile) {
                    // master
                    $inp_request_no = 'ODR'.$SFnumber;
                    $inp_purpose_type = $_POST['inp_purpose_type'];
                    $inp_emp_no = $_POST['inp_emp_no'];
                    $modal_emp = $_POST['modal_emp'];
                    $inp_remark = $_POST['inp_remark'];
                    $fileupload = $_POST['fileupload'];

                    // detail
                    $inp_onduty_purpose = $_POST['inp_onduty_purpose']; //destination
                    $city = $_POST['city']; //destination
                    $input_destination_detail = $_POST['input_destination_detail']; //destination
                    $formDestinationDetail = $_POST['formDestinationDetail']; //destination
                    
                    $date_onduty = $_POST['date_onduty'];
                    $inp_add_startdate = $_POST['inp_add_startdate'];
                    $inp_add_enddate = $_POST['inp_add_enddate'];

                    $requestenddate = $inp_add_enddate.' '.$SFtime;

                    $inp_hours_starttime = $_POST['inp_hours_starttime'];
                    $inp_hours_endtime = $_POST['inp_hours_endtime'];

                    // send data to work formula
                    $SFnumbercon = $inp_request_no;
                    $SFReqtype = 'Attendance.leave';
                    $inp_requestfor     = $inp_emp_no;
                    $inp_emp_no = $inp_emp_no;
                    
                    // for on duty master
                    $queryOnDutyMaster = "INSERT INTO `hrdondutyrequest`
                    (
                        `request_no`,
                        `company_id`,
                        `requestedby`,
                        `requestfor`,
                        `requestdate`,
                        `requestenddate`,
                        `purpose_code`,
                        `total_destination`,
                        `remark`,
                        `created_by`,
                        `created_date`,
                        `modified_by`,
                        `modified_date`,
                        `cancelsts`,
                        `upload_filename`
                    ) VALUES (
                        '$inp_request_no',
                        '13576',
                        '$inp_emp_no',
                        '$modal_emp',
                        '$SFdatetime',
                        '$requestenddate',
                        '$inp_purpose_type',
                        1,
                        '$inp_remark',
                        '$inp_emp_no',
                        '$SFdatetime',
                        '$inp_emp_no',
                        '$SFdatetime',
                        '1',
                        '$directoryFile'
                        -- '$image'
                    )";
                    $executeQueryMaster = $connect->query($queryOnDutyMaster);

                    // fetch file work formula 
                    require_once '../../set{sys=system_function_authorization}/workflow_formula.php';

                    // for on duty detail
                    for ($index = 0; $index  < count($inp_hours_starttime) ; $index ++) {
                        $date_onduty_data = $date_onduty[$index];
                        $data_hour_start = $inp_hours_starttime[$index]; 
                        $data_hour_end = $inp_hours_endtime[$index];
                        
                        $result_starttime = $date_onduty_data.' '.$data_hour_start;
                        $result_endtime = $date_onduty_data.' '.$data_hour_end;
                        
                        $queryOnDutyDetail = "INSERT INTO `hrdondutyrequestdtl` 
                        (
                            `request_no`,
                            `company_id`,
                            `destination_no`,
                            `destination_detail`,
                            `startdate`,
                            `enddate`
                        ) VALUES (
                            '$inp_request_no',
                            '13576',
                            '$inp_onduty_purpose',
                            '$input_destination_detail',
                            '$result_starttime',
                            '$result_endtime'
                        )";
            
                        $executeQueryDetail = $connect->query($queryOnDutyDetail);
                    }
                    $response['success'] = false;
                    $response['code'] = "failed_message";
                    $response['messages'] = 'On duty request successfully added';
                } else {
                    $response['success'] = false;
                    $response['code'] = "failed_message";
                    $response['messages'] = 'On duty request failed to add';
                }
            }
        }

        $connect->close();
        echo json_encode($response);
    }

?>