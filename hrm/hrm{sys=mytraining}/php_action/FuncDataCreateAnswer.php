<?php
require_once '../../../application/config.php';
$SFdate         		= date("Y-m-d");
$SFtime         		= date('h:i:s');
$SFdatetime     		= date("Y-m-d H:i:s");
$SFnumber       		= date("YmdHis");
$SFnumbercon    		= 'EMP' . $SFnumber;

//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$employee 					= $_POST['employee'];
	$requestno 					= $_POST['requestno'];
	$question_type				= $_POST['question_type'];
	$category					= $_POST['category'];

	$keys2 = explode("-", $q_answer);

	for ($iemg = 0; $iemg < count($_POST['update']); $iemg++) {
		$iemg_plus = $iemg + 1;
		$update	= $_POST['update'][$iemg];

		if ($update !== '') {
			$q_answer    	= $_POST['q_answer' . $update]; // starttime_in_ATDDO1775330906202220220404144802
			$keys 			= explode("-", $q_answer);

			//OBJECT ORIENTED STYLE
			$query 					= "SELECT * FROM trnmquestion WHERE `question_code` = '$keys[0]'";
			$result 				= $connect->query($query);
			$row 					= $result->fetch_array(MYSQLI_ASSOC);
			$arr_0 					= $row["question_answer"];
			$arr_1 					= $row["course_code"];
			//OBJECT ORIENTED STYLE

			if($arr_0 == $keys[1]) {
				$value=1;
			} else {
				$value=0;
			}

			//OBJECT ORIENTED STYLE
			$query 					= "SELECT COUNT(*) AS total FROM `trnmquestion` WHERE `course_code` = '$arr_1' AND `course_category` = '$category'";
			$result 				= $connect->query($query);
			$row 					= $result->fetch_array(MYSQLI_ASSOC);
			$arr_00 				= $row["total"];
			//OBJECT ORIENTED STYLE

			$sql_1  			= "INSERT INTO `trndanswer` 
									(
										`request_no`,
										`course_category`,
										`course_code`,
										`emp_id`,
										`question_code`,
										`question_type`,
										`question_index`,
										`question_answer`,
										`values`
									)
										VALUES
											(
												'$requestno',
												'$category',
												'$arr_1',
												'$employee', 
												'$keys[0]', 
												'$question_type', 
												'$keys[1]',
												'$arr_0', 
												'$value'
											)";

			// condition start
			$query_1 = $connect->query($sql_1);
			if ($query_1 == TRUE) {

				//OBJECT ORIENTED STYLE
				$query	 					= "SELECT 
													IFNULL(ROUND(COUNT(*)/$arr_00*100),0) AS total,
													CASE
														WHEN IFNULL(ROUND(COUNT(*)/$arr_00*100),0) < 70 THEN 'Failed'
														ELSE 'Passed'
													END AS res
												FROM `trndanswer` 
												WHERE
													`course_code` 		= '$arr_1' AND
													`question_type` 	= '$question_type' AND
													`course_category` 	= '$category' AND
													`emp_id` 			= '$employee' AND
													`values` 			= '1'";

				$arr_001q 					= mysqli_fetch_array(mysqli_query($connect, $query));
				$arr_000					= $arr_001q['total'];
				$arr_001					= $arr_001q['res'];

				$sql_2  					= "UPDATE `trndanswer` SET
													`total_value`		= '$arr_000',
													`final_result` 		= '$arr_001' 
												WHERE 
													`course_code` 		= '$arr_1' AND
													`question_type` 	= '$question_type' AND
													`course_category` 	= '$category' AND
													`emp_id` 			= '$employee'";

				$query_2 = $connect->query($sql_2);
				
				$validator['success'] = true;
				$validator['code'] = "success_message_update";
				$validator['messages'] = "Successfully saved data";
			} else {
				$validator['success'] = true;
				$validator['code'] = "failed_message_update";
				$validator['messages'] = "You have submitted answer";
			}
		}
	} 
}

$connect->close();
echo json_encode($validator);