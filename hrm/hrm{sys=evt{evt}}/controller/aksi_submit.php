<link href="css/bootstrap.min.css" rel="stylesheet">
<?php
date_default_timezone_set('Asia/Bangkok');
// session_start();
// error_reporting(0);
// include "../../../application/config.php";
include "../../../application/session/session_ess.php";

// Mengambil data session
$nama	= $_SESSION['nama_user'];
$divisi = 'GTMO';
// Mengambil data session

// Mengambil data EVENT
$id				= $_POST['id'];
$nip			= $_SESSION['username'];
// $sql_diri		= mysqli_query($connect, "SELECT * FROM tuser WHERE username = '$nip'");
// $data_diri		= mysqli_fetch_assoc($sql_diri);
// $divisi			= $data_diri['plant'];
// Mengambil data EVENT

// Mengambil data Tanggal
$date			= date('Y-m-d H:m:s');
// Mengambil date Tanggal

// Mengambil data POST Kuesioner
// $jawaban		= $_POST['jawaban'];
// $countjawaban	= count($jawaban);
// Mengambil data POST Kuesioner

// Mengambil data POST Sugesstion
// $suggestion			= $_POST['suggestion'];
// $countsuggestion	= count($suggestion);
// Mengambil data POST Sugesstion

// Validasi

$validasi_midtemp	= 1;

$query_validasi_1		= mysqli_query($connect, "SELECT
b.* 
FROM hrmsurveygrouppertanyaan a
LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
WHERE id_event = '$id'");
while($data_validasi_1 = mysqli_fetch_assoc($query_validasi_1)){
	$query_validasi_2	= mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_validasi_1[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
	$b		= 1;
	while($data_validasi_2	= mysqli_fetch_assoc($query_validasi_2)){
		$countvalidasi	= $data_validasi_1['groupId'].'jawaban'.$b;
		
		if(isset($_POST[$countvalidasi])){
			$validasi_data	= $_POST[$countvalidasi];
		   }else{
			
			$validasi_data	= '0';
		   }
		
		if($validasi_data == '0'){
		$validasi_midtemp		= 0;
			echo"<script type='text/javascript'>
        window.alert('Ada yang belum diisi!'); 
		window.location.replace('../../hrm{sys=evt{evt}}?id={$id}'); 
        </script>"; 	
		// exit;
		}

		$b++;
	}
}

$sql_essay = mysqli_query($connect, "SELECT
b.*
FROM hrmsurveygroupessay a
LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
WHERE a.id_event = '$id' ORDER BY a.order ASC");
while($data_essay = mysqli_fetch_array($sql_essay)){
	$id_essay = $data_essay['groupId'];
	$c 			= 1;
	$hasil_essay = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_essay[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
    while ($r_essay = mysqli_fetch_array($hasil_essay)){ 
		$countvalidasiessay		= '0';
		$countvalidasiessay		= $id_essay.'jawaban'.$c;
		// print_r($counthitungessay);
		// exit;
		if(isset($_POST[$countvalidasiessay])){
			$validasi_data_essay	= $_POST[$countvalidasiessay];
		   }else{
			
			$validasi_data_essay	= '0';
		   }

		// print_r($validasi_data_essay);
		// exit;

		if($validasi_data_essay == '0' || empty($validasi_data_essay)){
		$validasi_midtemp		= 0;
			echo"<script type='text/javascript'>
        window.alert('Ada yang belum diisi!'); 
		window.location.replace('../../hrm{sys=evt{evt}}?id={$id}'); 
        </script>"; 	
		// exit;
		}
		$c++;
	}
}



// 1. Cek ada jawaban yang kosong?
$sql_hitung = mysqli_query($connect, "SELECT
b.*,
a.tipejawaban 
FROM hrmsurveygrouppertanyaan a
LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
WHERE a.id_event = '$id'");
$data_sql_hitung = mysqli_fetch_assoc($sql_hitung);
$id_hitung 		 = $data_sql_hitung['groupId'];
$tipejawaban	 = $data_sql_hitung['tipejawaban'];
$hasil_hitung 	 = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup 
				   WHERE hrmsurveytdescription.groupId = '$id_hitung' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId"));
$counthitung	 = count($hasil_hitung);

// if($counthitung != $countjawaban){
// 	echo "<script lang=javascript>
// 		 		window.alert('Anda belum mengisi kuisioner atau ada kuisioner yang belum terisi..!');
// 		 		history.back();
// 		 		</script>";
//   			exit;
// }
// 1. Cek ada jawaban yang kosong?

// 2. Cek ada jawaban Essay kososng?

$sql_hitung_essay       = mysqli_query($connect, "SELECT
b.* 
FROM hrmsurveygroupessay a
LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
WHERE a.id_event = '$id'");
// $counthitungessay	 	= count($sql_hitung_essay);
// $data_sql_hitung_essay	= mysqli_fetch_assoc($sql_hitung_essay);
// $id_hitung_essay 		= $data_sql_hitung_essay['id_group'];
// $hasil_hitung_essay 	= mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup 
// 						  WHERE hrmsurveytdescription.groupId = '$id_hitung_essay' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId"));

$validasiessay			= mysqli_num_rows($sql_hitung_essay);

// print_r($id);
// echo '-';
// print_r($nip);
// echo '-';
// print_r($validasiessay);

// echo "<script lang=javascript>
// 			window.alert('$validasiessay');
// 		 		history.back();
// 	 		</script>";
//   	exit;
// if($validasiessay > '1'){
// 	// if($counthitungessay != $countsuggestion){
// 	// echo "<script lang=javascript>
// 	// 	 		window.alert('Anda belum mengisi kuisioner atau ada kuisioner yang belum terisi..!');
// 	// 	 		history.back();
// 	// 	 		</script>";
//   	// 		exit;
// 	// }
// }

// 2. Cek ada jawaban Essay kososng?
// Validasi




if($validasi_midtemp == 1){
	// Insert Data

	// 1. Insert data Tanpa Essay
	if($validasiessay == '0'){
        
		$answerkode	= $id.$nip;
		// Inser to table tjawaban
		mysqli_query($connect, "INSERT INTO hrmsurveytjawaban(nip,fullname,divisi,survey_date,id_event,answerId)
		VALUES('$nip','$nama','$divisi','$date','$id','$answerkode')");
		// Update aksi di table hrmsurveyanggotaevent
		mysqli_query($connect, "UPDATE hrmsurveyanggotaevent SET aksi = '1' WHERE id_event = '$id' and nip = '$nip'");

		$sql = mysqli_query($connect, "SELECT
			b.* 
			FROM hrmsurveygrouppertanyaan a
			LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
			WHERE id_event = '$id'");

		// Jika jawaban tipe 1
		if($tipejawaban == '1'){		
			while($data = mysqli_fetch_array($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_array($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;
					$name = $_POST[$couti];
					// echo "$i $asfa<br>";
					if ($name == 'A'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0','0','0')");
					}	
					elseif($name == 'B'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1','0','0')");
					}
					elseif($name == 'C'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','1','0')");
					}
					elseif($name == 'D'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','1')");
					}
					$i++;
				}
				echo "<br>";
			}
		// Jika jawaban tipe 2
		}elseif($tipejawaban == '2'){
			while($data = mysqli_fetch_array($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_array($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;
					$name = $_POST[$couti];
					// echo "$i $asfa<br>";
					if ($name == 'A'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0','0','0','0')");
					}	
					elseif($name == 'B'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1','0','0','0')");
					}
					elseif($name == 'C'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','1','0','0')");
					}
					elseif($name == 'D'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','1','0')");
					}elseif($name == 'E'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','0','1')");
					}
					$i++;
				}
				echo "<br>";
			}
			// Jika jawaban tipe 3
		}elseif($tipejawaban == '3'){
			while($data = mysqli_fetch_array($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_array($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;
					$name = $_POST[$couti];
					// echo "$i $asfa<br>";
					if ($name == '1'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0')");
					}	
					elseif($name == '0'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1')");
					}
					$i++;
				}
				echo "<br>";
			}
			// Jika jawaban tipe 4
		}elseif($tipejawaban == '4'){
			while($data = mysqli_fetch_array($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_array($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;
					$name = $_POST[$couti];
					// echo "$i $asfa<br>";
					
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer4(id_event,descriptionId,groupId,answerId,nip,jawaban)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','$name')");
					
					$i++;
				}
				echo "<br>";
			}
		}
	}else{
		$answerkode	= $id.$nip;
		
		// Inser to table tjawaban
		mysqli_query($connect, "INSERT INTO hrmsurveytjawaban(nip,fullname,divisi,survey_date,id_event,answerId)
		VALUES('$nip','$nama','$divisi','$date','$id','$answerkode')");
		// Update aksi di table hrmsurveyanggotaevent
		mysqli_query($connect, "UPDATE hrmsurveyanggotaevent SET aksi = '1' WHERE id_event = '$id' and nip = '$nip'");

		$sql = mysqli_query($connect, "SELECT
			b.* 
			FROM hrmsurveygrouppertanyaan a
			LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
			WHERE id_event = '$id'");

		// Jika jawaban tipe 1
		if($tipejawaban == '1'){		
			while($data = mysqli_fetch_assoc($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_assoc($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;
					$name = $_POST[$couti];
					// echo "$i $asfa<br>";
					if ($name == 'A'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0','0','0')");
					}	
					elseif($name == 'B'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1','0','0')");
					}
					elseif($name == 'C'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','1','0')");
					}
					elseif($name == 'D'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','1')");
					}
					$i++;
				}
				echo "<br>";
			}
		// Jika jawaban tipe 2
		}elseif($tipejawaban == '2'){
			while($data = mysqli_fetch_assoc($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_assoc($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;
					$name = $_POST[$couti];
					// echo "$i $asfa<br>";
					if ($name == 'A'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0','0','0','0')");
					}	
					elseif($name == 'B'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1','0','0','0')");
					}
					elseif($name == 'C'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','1','0','0')");
					}
					elseif($name == 'D'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','1','0')");
					}elseif($name == 'E'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','0','1')");
					}
					$i++;
				}
				echo "<br>";
			}
			// Jika jawaban tipe 3
		}elseif($tipejawaban == '3'){
			while($data = mysqli_fetch_assoc($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_assoc($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;
					$name = $_POST[$couti];
					// echo "$i $asfa<br>";
					if ($name == '1'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0')");
					}	
					elseif($name == '0'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3 (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1')");
					}
					$i++;
				}
				echo "<br>";
			}
			// Jika jawaban tipe 4
		}elseif($tipejawaban == '4'){
			while($data = mysqli_fetch_assoc($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_assoc($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;
					$name = $_POST[$couti];
					// echo "$i $asfa<br>";
					
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer4 (id_event,descriptionId,groupId,answerId,nip,jawaban)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','$name')");
					
					$i++;
				}
				echo "<br>";
			}
		}

		$sql_essay = mysqli_query($connect, "SELECT
			b.* 
			FROM hrmsurveygroupessay a
			LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
			WHERE id_event = '$id'");
		
		while($data_essay = mysqli_fetch_assoc($sql_essay)){
			$groupId_essay = $data_essay['groupId'];		
			$hasil_essay = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId_essay' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
			$i_essay = 1;
			while ($r_essay = mysqli_fetch_assoc($hasil_essay)){
				$groupidessay = $data_essay['groupId'];
				$coutiessay   = $groupId_essay.'jawaban'.$i_essay;
				$answerid = $id.$nip;
				$name_essay = $_POST[$coutiessay];
				// echo "$i $asfa<br>";
				
					mysqli_query($connect, "INSERT INTO hrmsurveytansweressay(id_event,descriptionId,groupId,answerId,nip,jawaban)
					VALUES('$id','$r_essay[descriptionId]','$r_essay[groupId]','$answerid','$nip','$name_essay')");
				
				$i_essay++;
			}
			echo "<br>";
		}
		
	}

		mysqli_query($connect, "DELETE FROM hrmsurveytjawabanmidtemp WHERE nip = '$_SESSION[username]'");
        mysqli_query($connect, "DELETE FROM hrmsurveytanswer1midtemp WHERE nip = '$_SESSION[username]'");
        mysqli_query($connect, "DELETE FROM hrmsurveytanswer2midtemp WHERE nip = '$_SESSION[username]'");
        mysqli_query($connect, "DELETE FROM hrmsurveytanswer3midtemp WHERE nip = '$_SESSION[username]'");
        mysqli_query($connect, "DELETE FROM hrmsurveytanswer4midtemp WHERE nip = '$_SESSION[username]'");
        mysqli_query($connect, "DELETE FROM hrmsurveytansweressaymidtemp WHERE nip = '$_SESSION[username]'");

	echo"<script type='text/javascript'>
        window.alert('Berhasil Input Data!'); 
        window.location.replace('../../hrm{sys=evt{survey}}'); 
        </script>"; 
		exit;

}elseif($validasi_midtemp == 0){

		mysqli_query($connect, "DELETE FROM hrmsurveytjawabanmidtemp WHERE nip = '$_SESSION[username]'");
		mysqli_query($connect, "DELETE FROM hrmsurveytanswer1midtemp WHERE nip = '$_SESSION[username]'");
		mysqli_query($connect, "DELETE FROM hrmsurveytanswer2midtemp WHERE nip = '$_SESSION[username]'");
		mysqli_query($connect, "DELETE FROM hrmsurveytanswer3midtemp WHERE nip = '$_SESSION[username]'");
		mysqli_query($connect, "DELETE FROM hrmsurveytanswer4midtemp WHERE nip = '$_SESSION[username]'");
		mysqli_query($connect, "DELETE FROM hrmsurveytansweressaymidtemp WHERE nip = '$_SESSION[username]'");

	// 1. Insert data Tanpa Essay
	if($validasiessay == '0'){
        
		$answerkode	= $id.$nip;
		// Inser to table tjawaban
		mysqli_query($connect, "INSERT INTO hrmsurveytjawabanmidtemp(nip,fullname,divisi,survey_date,id_event,answerId)
		VALUES('$nip','$nama','$divisi','$date','$id','$answerkode')");
		// Update aksi di table hrmsurveyanggotaevent
		// mysqli_query($connect, "UPDATE hrmsurveyanggotaevent SET aksi = '1' WHERE id_event = '$id' and nip = '$nip'");

		$sql = mysqli_query($connect, "SELECT
			b.* 
			FROM hrmsurveygrouppertanyaan a
			LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
			WHERE id_event = '$id'");

		// Jika jawaban tipe 1
		if($tipejawaban == '1'){		
			while($data = mysqli_fetch_array($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_array($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;

					if(isset($_POST[$couti])){
						$name 	= $_POST[$couti];
					}else{
						$name	= 'X';
					}

					// if($name == 'X'){
					// 	exit;
					// }
					
					// echo "$i $asfa<br>";
					if ($name == 'A'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0','0','0')");
					}	
					elseif($name == 'B'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1','0','0')");
					}
					elseif($name == 'C'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','1','0')");
					}
					elseif($name == 'D'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','1')");
					}
					elseif($name == 'X'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','0')");
					}
					$i++;
				}
				echo "<br>";

				
			}
		// Jika jawaban tipe 2
		}elseif($tipejawaban == '2'){
			while($data = mysqli_fetch_array($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_array($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;

					if(isset($_POST[$couti])){
						$name 	= $_POST[$couti];
					}else{
						$name	= 'X';
					}

					// if($name == 'X'){
					// 	exit;
					// }

					// echo "$i $asfa<br>";
					if ($name == 'A'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0','0','0','0')");
					}	
					elseif($name == 'B'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1','0','0','0')");
					}
					elseif($name == 'C'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','1','0','0')");
					}
					elseif($name == 'D'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','1','0')");
					}
					elseif($name == 'E'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','0','1')");
					}
					elseif($name == 'X'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','0','0')");
					}
					$i++;
				}
				echo "<br>";
			}
			// Jika jawaban tipe 3
		}elseif($tipejawaban == '3'){
			while($data = mysqli_fetch_array($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_array($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;

					if(isset($_POST[$couti])){
						$name 	= $_POST[$couti];
					}else{
						$name	= 'X';
					}

					// if($name == 'X'){
					// 	exit;
					// }

					// echo "$i $asfa<br>";
					if ($name == '1'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0')");
					}	
					elseif($name == '0'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1')");
					}
					elseif($name == 'X'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0')");
					}
					$i++;
				}
				echo "<br>";
			}
			// Jika jawaban tipe 4
		}elseif($tipejawaban == '4'){
			while($data = mysqli_fetch_array($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_array($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;

					if(isset($_POST[$couti])){
						$name 	= $_POST[$couti];
					}else{
						$name	= 'X';
					}

					// if($name == 'X'){
					// 	exit;
					// }
					// echo "$i $asfa<br>";
						if($name == 'X'){
							mysqli_query($connect, "INSERT INTO hrmsurveytanswer4midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban)
							VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','')");
						}else{
							mysqli_query($connect, "INSERT INTO hrmsurveytanswer4midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban)
							VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','$name')");
						}
					$i++;
				}
				echo "<br>";
			}
		}
	}else{
		$answerkode	= $id.$nip;
		
		// Inser to table tjawaban
		mysqli_query($connect, "INSERT INTO hrmsurveytjawabanmidtemp(nip,fullname,divisi,survey_date,id_event,answerId)
		VALUES('$nip','$nama','$divisi','$date','$id','$answerkode')");
		// Update aksi di table hrmsurveyanggotaevent
		// mysqli_query($connect, "UPDATE hrmsurveyanggotaevent SET aksi = '1' WHERE id_event = '$id' and nip = '$nip'");

		$sql = mysqli_query($connect, "SELECT
			b.* 
			FROM hrmsurveygrouppertanyaan a
			LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
			WHERE id_event = '$id'");

		// Jika jawaban tipe 1
		if($tipejawaban == '1'){		
			while($data = mysqli_fetch_assoc($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_assoc($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;

					if(isset($_POST[$couti])){
						$name 	= $_POST[$couti];
					}else{
						$name	= 'X';
					}

					// print_r($name);

					// if($name == 'X'){
					// 	exit;
					// }

					// echo "$i $asfa<br>";
					if ($name == 'A'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0','0','0')");
					}	
					elseif($name == 'B'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1','0','0')");
					}
					elseif($name == 'C'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','1','0')");
					}
					elseif($name == 'D'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','1')");
					}
					elseif($name == 'X'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer1midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4) 
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','0')");
					}
					$i++;
				}
				echo "<br>";
			}
		// Jika jawaban tipe 2
		}elseif($tipejawaban == '2'){
			while($data = mysqli_fetch_assoc($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_assoc($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;

					if(isset($_POST[$couti])){
						$name 	= $_POST[$couti];
					}else{
						$name	= 'X';
					}

					// print_r($name);

					// if($name == 'X'){
					// 	exit;
					// }


					// echo "$i $asfa<br>";
					if ($name == 'A'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0','0','0','0')");
					}	
					elseif($name == 'B'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1','0','0','0')");
					}
					elseif($name == 'C'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','1','0','0')");
					}
					elseif($name == 'D'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','1','0')");
					}elseif($name == 'E'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','0','1')");
					}
					elseif($name == 'X'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer2midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban2,jawaban3,jawaban4,jawaban5)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0','0','0','0')");
					}
					$i++;
				}
				echo "<br>";
			}
			// Jika jawaban tipe 3
		}elseif($tipejawaban == '3'){
			while($data = mysqli_fetch_assoc($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_assoc($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;

					if(isset($_POST[$couti])){
						$name 	= $_POST[$couti];
					}else{
						$name	= 'X';
					}

					// print_r($name);

					// if($name == 'X'){
					// 	exit;
					// }


					// echo "$i $asfa<br>";
					if ($name == '1'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','1','0')");
					}	
					elseif($name == '0'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','1')");
					}
					elseif($name == 'X'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer3midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban1,jawaban0)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','0','0')");
					}
					$i++;
				}
				echo "<br>";
			}
			// Jika jawaban tipe 4
		}elseif($tipejawaban == '4'){
			while($data = mysqli_fetch_assoc($sql)){
				$groupId = $data['groupId'];		
				$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
				$i = 1;
				while ($r = mysqli_fetch_assoc($hasil)){
					$groupid = $data['groupId'];
					$couti   = $groupid.'jawaban'.$i;
					$answerid = $id.$nip;

					if(isset($_POST[$couti])){
						$name 	= $_POST[$couti];
					}else{
						$name	= 'X';
					}

					// print_r($name);

					// if($name == 'X'){
					// 	exit;
					// }


					// echo "$i $asfa<br>";
					if($name == 'X'){
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer4midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','')");
					}else{
						mysqli_query($connect, "INSERT INTO hrmsurveytanswer4midtemp (id_event,descriptionId,groupId,answerId,nip,jawaban)
						VALUES('$id','$r[descriptionId]','$r[groupId]','$answerid','$nip','$name')");
					}
						
					
					$i++;
				}
				echo "<br>";
			}
		}

		$sql_essay = mysqli_query($connect, "SELECT
			b.* 
			FROM hrmsurveygroupessay a
			LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
			WHERE id_event = '$id'");
		
		while($data_essay = mysqli_fetch_assoc($sql_essay)){
			$groupId_essay = $data_essay['groupId'];		
			$hasil_essay = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$groupId_essay' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
			$i_essay = 1;
			while ($r_essay = mysqli_fetch_assoc($hasil_essay)){
				$groupidessay = $data_essay['groupId'];
				$coutiessay   = $groupId_essay.'jawaban'.$i_essay;
				$answerid = $id.$nip;

				if(isset($_POST[$coutiessay])){
					$name_essay 	= $_POST[$coutiessay];
				}else{
					$name_essay		= 'X';
				}

				// if($name_essay == 'X'){
				// 	exit;
				// }
				
				// echo "$i $asfa<br>";
					if($name_essay == 'X'){
						mysqli_query($connect, "INSERT INTO hrmsurveytansweressaymidtemp (id_event,descriptionId,groupId,answerId,nip,jawaban)
						VALUES('$id','$r_essay[descriptionId]','$r_essay[groupId]','$answerid','$nip','')");
					}else{
						mysqli_query($connect, "INSERT INTO hrmsurveytansweressaymidtemp (id_event,descriptionId,groupId,answerId,nip,jawaban)
						VALUES('$id','$r_essay[descriptionId]','$r_essay[groupId]','$answerid','$nip','$name_essay')");
					}
				
				$i_essay++;
			}
			echo "<br>";
		}
		
	}
	
	
	// exit;

}

		
	// 1. Insert data menggunakan Essay

	// Insert Data

	
	
	// echo "<center><font face='Tahoma' size='2'>
	// 		Dear Bapak Ibu,<br><br>
	// 		Terima kasih atas waktu yang telah diluangkan untuk melengkapi survey yang kami sediakan. <br>
	// 		Pendapat Anda sangat berarti bagi kami untuk meningkatkan pelayanan. <br><br>
	// 		Hormat kami, <br><br>
	// 		Departement<br>
	// 		HRIS PT Gajah Tunggal Tbk </font><br>
	// 		<a href='./view/master.php?module=kuisioner'>
	// 		<button  class='btn btn-lg btn-info'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</button>
	// 		</a>
	// 		</center>";
	
// }
	
?>