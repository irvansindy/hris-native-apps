<?php 
require_once '../../../application/config.php';

$shift_id = $_POST['shift_id'];

//$memberId = 'DO170048';

$sql = "SELECT TIME_FORMAT(starttime, '%H:%i') as shiftstarttime,
                TIME_FORMAT(endtime, '%H:%i') as shiftendtime
              FROM hrmttamshiftdaily WHERE shiftdailycode = '$shift_id'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);