<?php
$rfid       = $_GET['rfid'];
$emp_id		= $_GET['emp_id'];
$lcode		= $_GET['lcode'];
?>

Active Leave Balance
<table id="datatable" width="100%" border="1" align="left" class="table table-bordered table-striped table-hover table-head-fixed">
	<thead>
		<tr>
			<th scope="col">
				<div>Type Of Leave</div>
			</th>
			<th scope="col">
				<div>Valid Start Date</div>
			</th>
			<th scope="col">
				<div>Valid End Date</div>
			</th>
			<th scope="col">
				<div>Entitlement</div>
			</th>
			<th scope="col">
				<div>Used</div>
			</th>
			<th scope="col">
				<div>Remaining</div>
			</th>
		</tr>
	</thead>
	<?php
	include "../../../application/config.php";
	$modal = mysqli_query($connect, "SELECT 
												*,
								
												DATE_FORMAT(a.startvaliddate , '%d %b %Y') as startvaliddate,
												DATE_FORMAT(a.endvaliddate , '%d %b %Y') as endvaliddate,
												a.leave_code,
												ROUND(sum(a.remaining/a.entitlement)*100) AS percent
											FROM 
											hrmempleavebal a
											WHERE a.emp_id = '$emp_id' and a.leave_code = '$lcode'
											GROUP BY a.empgetleave_id");
	while ($row = mysqli_fetch_array($modal)) {
	?>
		<tr>
			<td><?php echo $row['leave_code']; ?></td>
			<td><?php echo $row['startvaliddate']; ?></td>
			<td><?php echo $row['endvaliddate']; ?></td>
			<td><?php echo $row['entitlement']; ?></td>
			<td><?php echo $row['used']; ?></td>
			<td><?php echo $row['remaining']; ?></td>
		</tr>

		<tr>
			<td colspan="6">
				<div class="progress">
					<div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row['percent']; ?>%;cursor: pointer;" data-toggle="modal" data-target="#LeaveBalances" data-backdrop="static" onclick="BalancesDetail(`ANL`)">
					</div>
				</div>
			</td>
		</tr>
	<?php } ?>

</table>


<br>

Leave Balance Transaction
<?php


$sql = "SELECT 
			a.leave_request_no, 
			a.empgetleave_bal, 
			SUM(a.total_usage) AS total,
			DATE_FORMAT(b.leave_startdate , '%d %b %Y') as leave_startdate,
			DATE_FORMAT(b.leave_enddate , '%d %b %Y') as leave_enddate,
			b.leave_code,
			CONCAT('<b style=font-weight:bold>' , b.request_no , '</b>' , ' <br>' ,b.remark) as remark,
			c.request_status,
			a.total_usage,
			REPLACE(a.last_remaining , '.0000' , '') AS last_remaining,
			a.current_remaining
        FROM sys_deducted_leave a
		LEFT JOIN hrmleaverequest b ON a.leave_request_no=b.request_no
		LEFT JOIN 
				(
					SELECT
					sub1.request_no,
					MAX(sub1.request_status) AS request_status
					FROM hrmrequestapproval sub1
					GROUP BY sub1.request_no
				) c ON b.request_no=c.request_no
		WHERE b.emp_id = '$emp_id' and b.leave_code = '$lcode'
        GROUP BY 
			a.leave_request_no, 
			a.empgetleave_bal";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table id="datatable" width="100%" border="1" align="left"
class="table table-bordered table-striped table-hover table-head-fixed">

<thead>
        <tr>
        <th scope="col">
            <div>Type Of Leave</div>
        </th>
        <th scope="col">
            <div>Remark</div>
        </th>
        <th scope="col">
            <div>Start Date</div>
        </th>
        <th scope="col">
            <div>End Date</div>
        </th>
        <th scope="col">
            <div>Eligible</div>
        </th>
        <th scope="col">
            <div>Used</div>
        </th>
        <th scope="col">
            <div>Remaining</div>
        </th>
        </tr>
		</thead>
		<tbody>';

$subtotal_plg = $subtotal_thn = $total = 0;
foreach ($result as $key => $row) {
	$subtotal_plg += $row['total'];
	$subtotal_thn += $row['total'];

	echo '<tr>
			<td>' . $row['leave_code'] . '</td>
			<td>' . $row['remark'] . '</td>
			<td>' . $row['leave_startdate'] . '</td>
			<td>' . $row['leave_enddate'] . '</td>
			<td style="text-align: right;">' . $row['last_remaining'] . '</td>
			<td style="text-align: right;" class="right">' . $row['total'] . '</td>
			<td style="text-align: right;">' . $row['current_remaining'] . '</td>
		</tr>';

	if (@$result[$key + 1]['leave_request_no'] != $row['leave_request_no']) {
		echo '<tr class="subtotal">
			<td style="font-family: verdana;font-weight: bold;color: #9a9a9a;" colspan="5">SUB TOTAL ' . $row['thn_byr'] . '</td>
			<td style="font-family: verdana;font-weight: bold;color: #9a9a9a;font-size: 11px;text-align: right;" class="right">' . $subtotal_thn . '</td>
			<td></td>
		</tr>';
		$subtotal_thn = 0;
	}
	$total += $row['total'];
}

// GRAND TOTAL
echo '<tr class="total">
		<td style="font-family: verdana;font-weight: bold;color: #9a9a9a;" colspan="5">GRAND TOTAL</td>
		<td style="font-family: verdana;font-weight: bold;color: #9a9a9a;font-size: 11px;text-align: right;" class="right"> ' . $total . '</td>
		<td></td>
	</tr>
	</tbody>
</table>
</body>
</html>';
