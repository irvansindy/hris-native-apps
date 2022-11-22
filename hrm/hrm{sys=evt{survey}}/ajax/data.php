<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$data1              = $_GET['id'];


$output = array('data' => array());

if($data1 == 1){
    $sql = "SELECT
    b.*,
    DATE_FORMAT(b.start_date, '%d-%m-%Y') as mulai,
    DATE_FORMAT(b.end_date, '%d-%m-%Y') as selesai,
    DATE_FORMAT(b.start_date, '%d %b %Y') as tanggal_mulai,
    DATE_FORMAT(b.end_date, '%d %b %Y') as tanggal_selesai,
    a.aksi,
    case
           when 
                                  ((current_date() >= b.start_date)
                                   AND 
                                  (current_date() <= b.end_date))
                            then 'YES'
           ELSE 'NO'
    END AS status
    FROM hrmsurveyanggotaevent a
    LEFT JOIN hrmsurveyevent b ON b.id_event = a.id_event
     
             WHERE (a.nip = '$username' AND a.aksi <> '1')
             AND b.status = '1' 
             
             AND (current_date() <= b.end_date AND current_date() >= b.start_date)
                    

                  GROUP BY b.id_event                  
             ORDER BY b.start_date asc

             ";
}elseif($data1 == 2){
    $sql = "SELECT
    b.*,
    DATE_FORMAT(b.start_date, '%d-%m-%Y') as mulai,
    DATE_FORMAT(b.end_date, '%d-%m-%Y') as selesai,
    DATE_FORMAT(b.start_date, '%d %b %Y') as tanggal_mulai,
    DATE_FORMAT(b.end_date, '%d %b %Y') as tanggal_selesai,
    a.aksi,
    case
           when 
                                  (NOW() >= b.start_date)
                                   AND 
                                  (NOW() <= b.end_date) 
                            then 'YES'
           ELSE 'NO'
    END AS status
    FROM hrmsurveyanggotaevent a
    LEFT JOIN hrmsurveyevent b ON b.id_event = a.id_event
     
             WHERE a.nip = '$username' 
             AND (b.status = '1' AND NOW() <= b.start_date)

 GROUP BY b.id_event                  
             ORDER BY tanggal_mulai asc 

";
}elseif($data1 == 3){
    $sql = "(SELECT
    b.*,
    DATE_FORMAT(b.start_date, '%d-%m-%Y') as mulai,
    DATE_FORMAT(b.end_date, '%d-%m-%Y') as selesai,
    DATE_FORMAT(b.start_date, '%d %b %Y') as tanggal_mulai,
    DATE_FORMAT(b.end_date, '%d %b %Y') as tanggal_selesai,
    a.aksi,
    case
           when 
                                  (NOW() >= b.start_date)
                                   AND 
                                  (NOW() <= b.end_date) 
                            then 'YES'
           ELSE 'NO'
    END AS status
    FROM hrmsurveyanggotaevent a
    LEFT JOIN hrmsurveyevent b ON b.id_event = a.id_event
     
             WHERE (a.nip = '$username')
             AND (b.status = '1' AND NOW() > b.end_date))
UNION
(SELECT
    b.*,
    DATE_FORMAT(b.start_date, '%d-%m-%Y') as mulai,
    DATE_FORMAT(b.end_date, '%d-%m-%Y') as selesai,
    DATE_FORMAT(b.start_date, '%d %b %Y') as tanggal_mulai,
    DATE_FORMAT(b.end_date, '%d %b %Y') as tanggal_selesai,
    a.aksi,
    case
           when 
                                  (NOW() >= b.start_date)
                                   AND 
                                  (NOW() <= b.end_date) 
                            then 'YES'
           ELSE 'NO'
    END AS status
    FROM hrmsurveyanggotaevent a
    LEFT JOIN hrmsurveyevent b ON b.id_event = a.id_event
     
             WHERE (a.nip = '$username' AND a.aksi = '1' AND b.`status` = '1'))
              
    

             ";
}


$query = mysqli_query($connect, $sql);

$no    = 1;
while ($row = mysqli_fetch_assoc($query)) {


    if($row['aksi'] == '0'){ 
        if($row['status'] == 'YES'){
               $button = "<a href='../hrm{sys=evt{evt}}?id={$row["id_event"]}&survey=1'><img src='../../asset/dist/img/icons/acticon-note.png' data-toggle='tooltip' title=''></a>";   
        }else{
               $button = "<a href='#'><img src='../../asset/dist/img/icons/acticon-note.png' data-toggle='tooltip' title=''></a>";   
        }
         $aksi   = 'New'; 
     }else{ 
         $aksi   = 'Done'; 
         $button = "<a href='../hrm{sys=evt{evt}}?id={$row["id_event"]}'><img src='../../asset/dist/img/icons/glasses.png' data-toggle='tooltip' title=''></a>";
     }

	$output['data'][] = array(
        $no,
		$row['id_event'],
        $row['judul'],
        $row['tahun'],
        $row['tanggal_mulai'],
        $row['tanggal_selesai'],
        $row['divisi'],
        $row['dept'],
        $aksi,
        $button
	);

	$no++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>