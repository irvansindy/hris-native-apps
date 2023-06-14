<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    // directory file
    $directoryFile = '../../../asset/request.file.attachment/';

    // allowed file types
    $allow_types = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'ods');

    // status
    $denied_status = ['Unverified', 'Fully Approved', 'Partially Approved'];

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
    $modal_emp = $_POST['modal_emp'];

    if ($_POST) {
        // check data 
        $query_check_attendance_correct = "SELECT 
            a.request_no, a.emp_id,
            b.startdate, b.enddate,
            c.name_en
        FROM hrmattcorrection a
        INNER JOIN hrdattcorrection b
            ON a.request_no = b.request_no 
        LEFT JOIN hrmstatus c
            ON (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no 
            ORDER BY `request_status` DESC limit 1) = c.code    
        WHERE 
            DATE_FORMAT(b.startdate, '%Y-%m-%d') BETWEEN '$_POST[inp_add_startdate]' AND '$_POST[inp_add_enddate]'
            AND a.requestfor = '$modal_emp'
            ORDER BY a.created_date DESC LIMIT 1
        ";
        $total_attendance_correct = mysqli_num_rows(mysqli_query($connect, $query_check_attendance_correct));

        $check_status = mysqli_fetch_assoc(mysqli_query($connect, $query_check_attendance_correct));

        if ($total_attendance_correct > 0 && in_array($check_status['name_en'], $denied_status)) {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "failed_message";
            $response['messages'] = 'Attendance correct request already exists';
        } else {
            // when file attachment filled
            // var_dump($_FILES['fileupload']);
            if (!empty($_FILES['fileupload'])) {
                $file_name = $_FILES['fileupload']['name'];
                $file_upload = $_FILES['fileupload']['tmp_name'];
                
                // get uploaded file's extension
                $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
                // can upload same image using rand function
                $final_image = rand(1000,1000000).$file_name;
    
                if (in_array($ext, $allow_types)) {
                    $final_file = $directoryFile.strtolower($final_image);
            
                    $info_file = getimagesize($file_upload);
                }
                // destination upload file
                $upload_data_file = move_uploaded_file($file_upload, $final_file);
            }
            // var_dump([
            //     $ext,
            //     $final_image
            // ]);
            // master
            $request_no = 'ATR'.$SFnumber;
            $inp_emp_no = $_POST['inp_emp_no'];
            $inp_reason = $_POST['inp_reason'];
            $requestby = $_POST['modal_emp'];
            $fileupload = $_POST['fileupload'];
    
            // detail
            $date_attendance = $_POST['date_attendance'];
            $inp_add_startdate = $_POST['inp_add_startdate'];
            $inp_add_enddate = $_POST['inp_add_enddate'];
            $inp_hours_starttime = $_POST['inp_hours_starttime'];
            $inp_hours_endtime = $_POST['inp_hours_endtime'];
            $request_start_date = $inp_add_startdate.' '.$SFtime;
            $request_end_date = $inp_add_enddate.' '.$SFtime;
    
            // send data to work formula
            $SFnumbercon = $request_no;
            $SFReqtype = 'Attendance.leave';
            $inp_requestfor = $inp_emp_no;
            $inp_emp_no = $inp_emp_no;

            // final file attachment
            $final_file_attachment = $final_file != '' ? $final_file : NULL;

            // var_dump($final_file_attachment);
            // die();

            // create data master
            $query_master = "INSERT INTO `hrmattcorrection` (
                `request_no`,
                `requestby`,
                `emp_id`,
                `reason`,
                `attachment`,
                `requestdate`,
                `created_by`,
                `created_date`,
                `modified_by`,
                `modified_date`
            ) VALUES (
                '$request_no',
                '$inp_emp_no',
                '$requestby',
                '$inp_reason',
                '$final_file_attachment',
                '$request_start_date',
                '$requestby',
                '$request_start_date',
                '$requestby',
                '$request_start_date'
            )";

            $execute_query_master = $connect->query($query_master);

            // create data detail
            for ($i=0; $i < count($inp_hours_starttime) ; $i++) { 
                // set variable
                $data_date_attendance = $date_attendance[$i];
                $data_hour_start = $inp_hours_starttime[$i]; 
                $data_hour_end = $inp_hours_endtime[$i];
                $result_starttime = $data_date_attendance.' '.$data_hour_start;
                $result_endtime = $data_date_attendance.' '.$data_hour_end;

                $quey_detail = "INSERT INTO `hrdattcorrection` (
                    `request_no`,
                    `startdate`,
                    `enddate`,
                    `starttime`,
                    `endtime`,
                    `created_by`,
                    `created_date`,
                    `modified_by`,
                    `modified_date`
                ) VALUES (
                    '$request_no',
                    '$result_starttime',
                    '$result_endtime',
                    '$result_starttime',
                    '$result_endtime',
                    '$requestby',
                    '$request_start_date',
                    '$requestby',
                    '$request_start_date'
                )";

                $execute_query_detail = $connect->query($quey_detail);
            }

            // fetch file work formula 
            $make_approval = require_once '../../set{sys=system_function_authorization}/workflow_formula.php';

            // validation response JSON
            if ($execute_query_master == true && $execute_query_detail == true) {
                http_response_code(200);
                $response['success'] = true;
                $response['code'] = "success_message";
                $response['messages'] = 'Attendance correction request successfully added';
            } else {
                http_response_code(400);
                $response['success'] = false;
                $response['code'] = "success_message";
                $response['messages'] = 'Attendance correction request failed to add';
            }

        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);

    }
