<?php
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
			*, 
			a.emp_id as emp_id,
			a.emp_no as emp_no,
			e.address as cur_address,
			a.phone,
			b.latitude,
			b.longlatitude,
			b.pin,
			e.country_id as cur_country_id,
			e.state_id as cur_state_id,
			e.city_id as cur_city_id,
			e.district as cur_district,
			e.subdistrict as cur_subdistrict,
			e.rt as cur_rt,
			e.rw as cur_rw,
			e.zipcode as cur_zipcode
		FROM view_employee a
		LEFT JOIN users b on a.emp_no=b.username
		LEFT JOIN hrmempbank c on a.emp_id=c.emp_id
		LEFT JOIN teodempmedical d ON a.emp_id=d.emp_id
		LEFT JOIN teodempaddress e ON a.emp_id=e.emp_id AND e.addresstype_code='A'
		WHERE a.emp_no = '$memberId'";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);
