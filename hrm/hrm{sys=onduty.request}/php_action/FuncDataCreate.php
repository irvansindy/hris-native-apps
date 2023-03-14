<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    // directory file
    $directoryFile = '../../../asset/request.file.attachment/';

    // allowed file types
    $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'ods');

    $response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];

    // set time
    $SFdate = date("Y-m-d");
    $SFtime = date('h:i:s');
    $SFdatetime = date("Y-m-d H:i:s");
    $SFnumber = date("YmdHis");

    if($_POST) {
        /* can't make request when status unverified(1) - partially approved(2) - fully approved(3) can make request when status cancel(8) - reject(5 ) */
        // check data on duty request
        $queryCheckOndutyRequest = "SELECT 
            a.request_no, a.requestfor,
            b.startdate, b.enddate,
            c.name_en
        FROM hrdondutyrequest a
        INNER JOIN hrdondutyrequestdtl b
            ON a.request_no = b.request_no 
        LEFT JOIN hrmstatus c
            ON (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1) = c.code    
        WHERE 
            date_format(b.startdate, '%Y-%m-%d') BETWEEN '$_POST[inp_add_startdate]' AND '$_POST[inp_add_enddate]'
        ";
        $totalOnDutyRequest = mysqli_num_rows(mysqli_query($connect, $queryCheckOndutyRequest));

        if ($totalOnDutyRequest > 0) {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "failed_message";
            $response['messages'] = 'On duty request already exists';
        } else {
            if (isset($_POST['checkFileAttachment']) && $_POST['checkFileAttachment'] !== "" && !empty($_FILES['fileupload'])) {
                $file_name = $_FILES['fileupload']['name'];
                $file_upload = $_FILES['fileupload']['tmp_name'];
                
                // get uploaded file's extension
                $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
                // can upload same image using rand function
                $final_image = rand(1000,1000000).$file_name;
    
                if (in_array($ext, $allowTypes)) {
                    $finalFile = $directoryFile.strtolower($final_image);
            
                    $info_file = getimagesize($file_upload);
                }
                // destination upload file
                $uploadDataFile = move_uploaded_file($file_upload, $finalFile);
            }
    
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
    
            $requestStartDate = $inp_add_startdate.' '.$SFtime;
            $requestEndDate = $inp_add_enddate.' '.$SFtime;
    
            $inp_hours_starttime = $_POST['inp_hours_starttime'];
            $inp_hours_endtime = $_POST['inp_hours_endtime'];
    
            // send data to work formula
            $SFnumbercon = $inp_request_no;
            $SFReqtype = 'Attendance.leave';
            $inp_requestfor     = $inp_emp_no;
            $inp_emp_no = $inp_emp_no;
            
            // $finalDirecttoryFile != '' ? $finalDirecttoryFile : NULL;
            $finalFileAttachment = $finalFile != '' ? $finalFile : NULL;
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
                '$requestStartDate',
                '$requestEndDate',
                '$inp_purpose_type',
                1,
                '$inp_remark',
                '$inp_emp_no',
                '$SFdatetime',
                '$inp_emp_no',
                '$SFdatetime',
                '1',
                '$finalFileAttachment'
            )";
            $executeQueryMaster = $connect->query($queryOnDutyMaster);
    
            // fetch file work formula 
            require_once '../../set{sys=system_function_authorization}/workflow_formula.php';
    
            // for on duty detail
            for ($index = 0; $index  < count($inp_hours_starttime); $index++) {
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
            if ($executeQueryMaster == true && $executeQueryDetail == true) {
                http_response_code(200);
                $response['success'] = true;
                $response['code'] = "success_message";
                $response['messages'] = 'On duty request successfully added';
            } else {
                http_response_code(400);
                $response['success'] = false;
                $response['code'] = "success_message";
                $response['messages'] = 'On duty request failed to add';
            }
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }


