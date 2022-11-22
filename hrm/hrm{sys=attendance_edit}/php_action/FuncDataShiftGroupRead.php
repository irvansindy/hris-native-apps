<?php 
require_once '../../../application/config.php';
$rfid = $_GET['rfid'];

$output = array('data' => array());

$sql = "SELECT a.*,
	 b.*,
	 DATE_FORMAT(a.startshiftdate, '%d %b %Y') as startshiftdate,
	 DATE_FORMAT(a.startenddate, '%d %b %Y') as startenddate
	 FROM hrmempshiftgroup a
	 LEFT JOIN HRMTTAMSHIFTGROUP b on a.shiftgroupcode = b.shiftgroupcode 
	 WHERE a.emp_id = '$rfid'
	 ORDER BY a.startshiftdate DESC	";

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {


	$output['data'][] = array(
		$x,
		$row['shiftgroupcode'],
		$row['shiftgroupname'],
		$row['startshiftdate']
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP