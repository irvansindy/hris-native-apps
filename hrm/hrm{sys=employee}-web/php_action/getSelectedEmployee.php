<?php
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

// $memberId = '250284';

$sql = "SELECT 
			*,
			CONCAT(a.position_id , ' ' ,a.pos_name_en) as position,
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
			e.zipcode as cur_zipcode,
			f.customfield4,
			f.customfield5,
			
			sub1.value as kes,
			sub2.value as jkk,
			sub3.value as jkm,
			sub4.value as jht,
			sub5.value as jp,
			
			UC_Words(a.birthplace) as r_birthplace,
			CASE 
				WHEN a.birthdate = '0000-00-00 00:00:00' THEN ''
				ELSE a.birthdate
			END AS r_birthdate
		FROM view_employee a
		LEFT JOIN users b on a.emp_no=b.username
		LEFT JOIN hrmempbank c on a.emp_id=c.emp_id
		LEFT JOIN teodempmedical d ON a.emp_id=d.emp_id
		LEFT JOIN teodempaddress e ON a.emp_id=e.emp_id AND e.addresstype_code='A'
		LEFT JOIN mgtools_teodempcustomfield f ON a.emp_id=f.emp_id

		LEFT JOIN pay_insurance sub1 ON a.emp_id=sub1.emp_id AND sub1.component_id = 'BPJSKES'
        LEFT JOIN pay_insurance sub2 ON a.emp_id=sub2.emp_id AND sub2.component_id = 'BPJSJKK'
		LEFT JOIN pay_insurance sub3 ON a.emp_id=sub3.emp_id AND sub3.component_id = 'BPJSJKM'
        LEFT JOIN pay_insurance sub4 ON a.emp_id=sub4.emp_id AND sub4.component_id = 'BPJSJHT'
        LEFT JOIN pay_insurance sub5 ON a.emp_id=sub5.emp_id AND sub5.component_id = 'BPJSJP'

		WHERE a.emp_no = '$memberId'";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);
