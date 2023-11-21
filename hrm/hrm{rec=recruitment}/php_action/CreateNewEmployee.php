<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    // response json
    $response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];

    // create employee id
    $query_employee_id 		= "SELECT
			code_pattern,
			seq_number+1 AS last_no,
			CASE 
				WHEN seq_number+1 < 10 THEN CONCAT('000' , seq_number+1)
				WHEN seq_number+1 >= 10 AND seq_number+1 < 100 THEN CONCAT('00' , seq_number+1)
				WHEN seq_number+1 >= 100 AND seq_number+1 < 1000 THEN CONCAT('0' , seq_number+1)
				WHEN seq_number+1 >= 1000 AND seq_number+1 < 10000 THEN CONCAT('0' , seq_number+1)
				ELSE seq_number+1
			END AS new_sequence
		FROM tclmdocnumber WHERE code_type = 'EMP_ID'";
	$result1       = $connect->query($query_employee_id);
	$row1          = $result1->fetch_array(MYSQLI_ASSOC);
	$arr_1_0       = $row1["code_pattern"];
	$arr_1_1       = $row1["new_sequence"];
	$arr_1_2       = $row["last_no"];
	$var1          = array("xxxx", "yy", "[", "]" , "m1" , "m2");
	$var2          = array($arr_1_1, $years_numbering, "", "" , $month1 , $month2);
	$employee_id   = str_replace($var1, $var2, $arr_1_0);

	$user_id   = $row1["sequence_id"];

    // create employee number
    $query_employee_no = "SELECT
            code_pattern, 
            seq_number+1 AS last_no,
            CASE 
                WHEN seq_number+1 < 10 THEN CONCAT('000' , seq_number+1)
                WHEN seq_number+1 >= 10 AND seq_number+1 < 100 THEN CONCAT('00' , seq_number+1)
                WHEN seq_number+1 >= 100 AND seq_number+1 < 1000 THEN CONCAT('0' , seq_number+1)
            END AS new_sequence
        FROM tclmdocnumber WHERE code_type   = 'EMP_NO'";
	$result         = $connect->query($query_employee_no);
	$row            = $result->fetch_array(MYSQLI_ASSOC);
	$arr_0_0        = $row["code_pattern"];
	$arr_0_1        = $row["new_sequence"];
	$arr_0_2        = $row["last_no"];
	$var1           = array("xxxx", "yy", "[", "]" , "m1" , "m2");
	$var2           = array($arr_0_1, $years_numbering, "", "" , $month1 , $month2);
	$employee_no    = str_replace($var1, $var2, $arr_0_0);

	// query create new employee
	$query_create_new_employee = "INSERT INTO `view_employee` (
		`emp_id`, -- 1
		`first_name`, -- 2
		`middle_name`, -- 3
		`last_name`, -- 4
		`Full_Name`, -- 5
        `lastreqno`, -- 6
        `emp_no`, -- 7
        `address` -- 8
	) VALUES (
		'$employee_id', -- 1
		'', -- 2
		'', -- 3
		'', -- 4
		'$full_name', -- 5
		'$employee_no', -- 6
		'$employee_no', -- 7
		'$address' -- 8
	)";

	// duplicate query to table user
	$add_password = addslashes('$2y$10$J5szzn9EZTHRy6YJgdlUWeClckG3qZP65wil3SKlENo.qYoijIRDS');
	$query_create_user = "REPLACE INTO `users` 
		(
			`idu`,
			`nama`, 
			`username`, 
			`password`, 
			`hak_akses`, 
			`function_authorized`, 
			`access_group`, 
			`access_employee`, 
			`user_type`, 
			`user_status`, 
			`avatar`, 
			`position`, 
			`login`, 
			`latitude`, 
			`longlatitude`,
			`pin`,
			`att_type`,
			`timesheet`,
			`timesheet_type`
		) 
		VALUES 
			(
				'$employee_id',
				-- '$inp_first_name $inp_middle_name $inp_last_name', 
				'$full_name',
				'$employee_no', 
				'$add_password', 
				'pc.index{tsc=information}', 
				'4', 
				'1', 
				'0', 
				'Passive', 
				'1', 
				'', 
				'', 
				'1', 
				'', 
				'',
				'',
				'',
				'Sales',
				'Others'
			)";
	// print_r($query_create_new_employee);
	// print_r($query_create_user);
	$exe_query_create_employee = $connect->query($query_create_new_employee);
	$exe_query_create_user = $connect->query($query_create_user);