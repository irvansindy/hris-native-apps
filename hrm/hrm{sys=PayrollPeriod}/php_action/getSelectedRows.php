<?php
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT a.*,
		DATE_FORMAT(a.pay_date, '%d %b %Y') as pay_date,
        DATE_FORMAT(a.start_date, '%d %b %Y') as date_start,
        DATE_FORMAT(a.end_date, '%d %b %Y') as date_end,

		DATE_FORMAT(a.pay_date, '%Y-%m-%d') as paydate,
        DATE_FORMAT(a.start_date, '%Y-%m-%d') as datestart,
        DATE_FORMAT(a.end_date, '%Y-%m-%d') as dateend

		FROM pay_period a
		WHERE a.period_id = '$memberId'
		ORDER BY a.period_id asc";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);
