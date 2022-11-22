<table border="1">
<tr>
	<td>Request no</td>
	<td>Total real day</td>
</tr>

     	<?php
			include "../config.php";
			$no = 0;
			$SFdatetime             = date("Y-m-d H:i:s");
			$var=mysqli_query($connect, "SELECT 
			a.* 
			FROM hrmleaverequest a
			LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
			WHERE (d.code IN ('0','1','2','4'))
			-- 0	Draft
			-- 1	Unverified
			-- 2	Partially Approved
			-- 3	Fully Approved
			-- 4	Revised
			-- 5	Rejected
			-- 8	Cancelled
			-- 9	Closed

			");
			while($r=mysqli_fetch_array($var)){
			$no++;	
		?>

    <?php		
		$req_app 						= $r['request_no'];
		$leave_code 					= $r['leave_code'];
		$val_leave_approve              = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleave WHERE leave_code = '$leave_code'"));
		$val_leave_max_approved      	= $val_leave_approve['max_apvr_day'];
	?>

    

			<?php
				$no = 0;
				$var_loop=mysqli_query($connect, "SELECT 
				a.*,
				b.emp_no,
				d.name_en,
				CURDATE() as today,
				DATE(requestdate) as req_date,
				DATEDIFF(CURDATE(),requestdate) as compare
				FROM hrmleaverequest a
				LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
				LEFT JOIN VIEW_EMPLOYEE b on a.emp_id=b.emp_id
				WHERE 
				a.request_no = '$req_app'

				");
				while($r_var_loop=mysqli_fetch_array($var_loop)){
				$no++;	
			?>

			<?php		
				$compare_req_no 				= $r_var_loop['request_no'];
				$compare 						= $r_var_loop['compare'];
				$compare_status					= $r_var_loop['name_en'];
				$compare_today					= $r_var_loop['today'];
				$compare_req_date				= $r_var_loop['req_date'];
				$compare_emp_no					= $r_var_loop['emp_no'];
			?>

			<?php
			$var_day_total      	= mysqli_fetch_array(mysqli_query($connect, "SELECT 
																			count(a.daytype) as total
																			FROM hrdattendance a
																			LEFT JOIN teodempcompany b on a.emp_id=b.emp_id
																			WHERE 
																			b.emp_no = '$compare_emp_no' and
																			a.daytype IN ('WD','PHWD') and
																			DATE(a.shiftstarttime) between '$compare_req_date' and '$compare_today'"));
			$total_day      	= $var_day_total['total'];
			?>
			   

				<?php
					$var_exec=mysqli_query($connect, "SELECT 
					a.*,
					$total_day as total_hari_kerja_in_wd_phwd
					FROM hrmleaverequest a
					WHERE 
					a.request_no = '$req_app' and $total_day > $val_leave_max_approved
			
					");
					while($r_exec=mysqli_fetch_array($var_exec)){
					$no++;	
				?>

				<tr>
					<td>
						<?php echo $r_exec['request_no'];?> 
					</td>
					<td>
						<?php echo $r_exec['total_hari_kerja_in_wd_phwd'];?>
					</td>
				</tr>

				<?php
				$data1 		= $r_exec['request_no'];
				$data2 		= $r_exec['total_hari_kerja_in_wd_phwd'];

				$varpo=mysqli_query($connect, "UPDATE hrmrequestapproval
				SET 
				request_status 		= '5',
				revised_remark 		= 'auto_reject_sys @$SFdatetime'
				WHERE request_no 	= '$data1 '");
				?>

		<?php } ?>
	<?php } ?>
<?php } ?>
</table>