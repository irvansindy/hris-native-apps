<?php
if (isset($_POST['submit_add_debug'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
$SFGet_token            = $_POST['get_token'];

$modal_emp              = $_POST['modal_emp'];
$modal_remark           = $_POST['inp_remark'];
$modal_leave            = $_POST['modal_leave'];

$inp_leavedaytype       = $_POST['inp_leavedaytype'];
if(empty($_POST['inp_hdtype_starttime'])){
      $modal_first_type_day   = '1';
} else {
      $modal_first_type_day   = $_POST['inp_hdtype_starttime'];
}

$modal_first_type_day2  = $_POST['inp_hdtype_starttime2'];

$inp_starttime          = $_POST['inp_starttime'];
$inp_endtime            = $_POST['inp_endtime'];

$inp_urgent             = $_POST['inp_urgent'];



if(empty( $_POST['inp_urgent_decl'])){
      $inp_urgent_decl   = '0';
} else {
      $inp_urgent_decl        = $_POST['inp_urgent_decl'];
}

$sel_inp_urgreason      = $_POST['sel_inp_urgreason'];

$modal_lvb              = $_POST['inp_leavebalance'];

$search                 = array(' :', ':');
$replace                = array('', '');
$modal_get_startdate    = str_replace($search, $replace, $_POST['modal_leave_start']);
$modal_get_enddate      = str_replace($search, $replace, $_POST['modal_leave_end']);

$modal_leave_start      = date ("Y-m-d", strtotime ($modal_get_startdate));
$modal_leave_end        = date ("Y-m-d", strtotime ($modal_get_enddate));

$modal_leave_startTime  = date ("Y-m-d ", strtotime ($_POST['modal_leave_start'])).$_POST['inp_starttime'].":00";
$modal_leave_endTime    = date ("Y-m-d ", strtotime ($_POST['modal_leave_end'])).$_POST['inp_endtime'].":00";

$var_emp_id             = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM view_employee WHERE emp_no = '$emp_print'"));

$var_validation_allow   = mysqli_query($connect, "SELECT * FROM hrdvalleave WHERE emp_id = '$modal_emp'");
$data_var_validation_allow = mysqli_num_rows($var_validation_allow);
$data_var_validation_allow_r = mysqli_fetch_array($var_validation_allow);
$data_var_validation_allow_request_access_code = $data_var_validation_allow_r['request_access'];

$inp_refdoc_arr         = array();
//looping data gambar
foreach($_FILES['inp_refdoc']['name'] as $key=>$val){
		$image_name       = $_FILES['inp_refdoc']['name'][$key]; //mengambil nama gambar
		$tmp_name 	      = $_FILES['inp_refdoc']['tmp_name'][$key]; //mengambil tpm/path
		$size 		= $_FILES['inp_refdoc']['size'][$key]; //mengambil size atau aukuran gambar
		$type 		= $_FILES['inp_refdoc']['type'][$key]; //mengambil type gambar
		$error 		= $_FILES['inp_refdoc']['error'][$key]; //menggambil error gambil bila ada

		$newfilename= date('dmYHis');

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//VALIDASI APAKAH FILE DIIJINKAN SECARA SIZE
//VALIDASI APAKAH FILE DIIJINKAN SECARA SIZE
$val_max_upload               = mysqli_fetch_array(mysqli_query($connect, "SELECT var2 FROM db_config_str WHERE id = '12'"));
$val_max_upload_print         = $val_max_upload['var2'];

$alert5                       = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '5'"));
$alert_print5                 = $alert5['alert'];


if($size > $val_max_upload_print)
            {
                  echo "<script type='text/javascript'>
                              window.alert('$alert_print5 your file Size $size KByte');     
                        </script>";   
           
} else {
//VALIDASI APAKAH FILE DIIJINKAN SECARA SIZE
//VALIDASI APAKAH FILE DIIJINKAN SECARA SIZE


/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
// VALIDASI APAKAH ADA ISRISAN PENGAJUAN LEAVE
// VALIDASI APAKAH ADA ISRISAN PENGAJUAN LEAVE

$SFMaxReqFrom           = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                  a.request_no,
                                                                  MIN(s.leavetime) as leavetime
                                                                  FROM hrdleaverequest a 
                                                                  LEFT JOIN hrmleaverequest b on a.request_no=b.request_no 
                                                                  LEFT JOIN ttamleavetype c on b.leave_code=c.leave_code
                                                                  LEFT JOIN view_employee d on d.emp_id=b.emp_id    
                                                                  LEFT JOIN (SELECT aX.request_no,aX.leave_starttime as leavetime FROM hrdleaverequest aX
                                                                                          LEFT JOIN hrmleaverequest bX on aX.request_no=bX.request_no 
                                                                                          LEFT JOIN ttamleavetype cX on bX.leave_code=cX.leave_code 
                                                                                          LEFT JOIN view_employee dX on bX.emp_id=dX.emp_id           
                                                                                          WHERE
                                                                                          dX.emp_no = '$modal_emp' AND
                                                                                          (aX.dayrequesttype in ('1','2','3') or aX.checkday = '3') 
                                                                                          
                                                                                          AND (SELECT request_status 
                                                                                          FROM hrmrequestapproval WHERE request_no = aX.request_no and request_status IN ('8','5') 
                                                                                          ORDER BY `request_status` ASC limit 1) IS NULL
                                                                                          ) AS s ON a.request_no=s.request_no
                                                                                          
                                                                  WHERE
                                                                  d.emp_no = '$modal_emp' AND
                                                                  DATE(s.leavetime) = '$modal_leave_start' AND
                                                                  (a.dayrequesttype in ('1','2','3') or a.checkday = '3') 

                                                                  AND (SELECT request_status 
                                                                                    FROM hrmrequestapproval 
                                                                                    WHERE 
                                                                                          request_no = a.request_no and 
                                                                                          request_status IN ('8','5')  ORDER BY `request_status` ASC limit 1) IS NULL"));

$SFMaxReqto             = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                  a.request_no,
                                                                  MAX(s.leavetime) as leavetime 
                                                                  FROM hrdleaverequest a 
                                                                  LEFT JOIN hrmleaverequest b on a.request_no=b.request_no 
                                                                  LEFT JOIN ttamleavetype c on b.leave_code=c.leave_code
                                                                  LEFT JOIN view_employee d on d.emp_id=b.emp_id    
                                                                  LEFT JOIN (SELECT aX.request_no,aX.leave_endtime as leavetime FROM hrdleaverequest aX
                                                                                          LEFT JOIN hrmleaverequest bX on aX.request_no=bX.request_no 
                                                                                          LEFT JOIN ttamleavetype cX on bX.leave_code=cX.leave_code 
                                                                                          LEFT JOIN view_employee dX on bX.emp_id=dX.emp_id           
                                                                                          WHERE
                                                                                          dX.emp_no = '$modal_emp' AND
                                                                                          (aX.dayrequesttype in ('1','2','3') or aX.checkday = '3') 
                                                                                          
                                                                                          AND (SELECT request_status 
                                                                                          FROM hrmrequestapproval WHERE request_no = aX.request_no and request_status IN ('8','5') 
                                                                                          ORDER BY `request_status` ASC limit 1) IS NULL
                                                                                          ) AS s ON a.request_no=s.request_no
                                                                                          
                                                                  WHERE
                                                                  d.emp_no = '$modal_emp' AND
                                                                  DATE(s.leavetime) = '$modal_leave_end' AND
                                                                  (a.dayrequesttype in ('1','2','3') or a.checkday = '3') 

                                                                  AND (SELECT request_status 
                                                                                    FROM hrmrequestapproval 
                                                                                    WHERE 
                                                                                          request_no = a.request_no and 

                                                                                       request_status IN ('8','5')  ORDER BY `request_status` ASC limit 1) IS NULL"));


$data1 = $SFMaxReqFrom['leavetime'];
$data2 = $SFMaxReqto['leavetime'];

// echo $data1."<br>";
// echo $data2."<br>";

// GET TIME
if(!empty($inp_starttime))
{
      $SFdatetimeStartP             = date("$modal_leave_start $inp_starttime:00");
} else {
      $SFdatetimeStartP             = $r_detail['shiftstarttime'];
}

if(!empty($inp_endtime))
{
      $SFdatetimeEndP               = date("$modal_leave_end $inp_endtime:00");
} else {
      $SFdatetimeEndP               = $r_detail['shiftstarttime'];
}
// GET TIME

$val_leave                          = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleave WHERE leave_code = '$modal_leave'"));

$val_leave_max_req                  = $val_leave['max_req_day'];

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
$val_leave                          = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleave WHERE leave_code = '$modal_leave'"));
$val_leave_max_req                  = $val_leave['max_req_day'];

$val_leave_urg                      = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleaveurgreason WHERE reason_code = '$sel_inp_urgreason'"));
$val_leave_urg_max_req              = $val_leave_urg['max_req_day'];

$alert3                             = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '3'"));
$alert_print3                       = $alert3['alert'];

$val_leave_to_current               = mysqli_fetch_array(mysqli_query($connect, "SELECT datediff('$modal_leave_start', current_date()) as days"));
$val_leave_to_current_print         = $val_leave_to_current['days'];

if($val_leave_to_current_print < $val_leave_max_req && $inp_urgent_decl == '1' && $data_var_validation_allow == '0'){
      echo "<script type='text/javascript'>
                  window.alert('$alert_print3 Max Leave Request $val_leave_max_req Days $inp_urgent_decl (REGULAR)');     
            </script>";
}else if($val_leave_to_current_print < $val_leave_urg_max_req && $data_var_validation_allow == '0'){
      echo "<script type='text/javascript'>
                  window.alert('$alert_print3 Max Leave Request $val_leave_urg_max_req Days $inp_urgent_decl (URGENT)');     
            </script>";
} else {
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
// VALIDASI APAKAH ADA ISRISAN PENGAJUAN LEAVE
// VALIDASI APAKAH ADA ISRISAN PENGAJUAN LEAVE
if($modal_first_type_day == '3' && $inp_leavedaytype == 'HD'){
      $sequel_sequence = "1";
      $sequel      = "SELECT 
                                                                              ax.request_no
                                                                              FROM hrmleaverequest a
                                                                              LEFT JOIN hrdleaverequest ax ON a.request_no = ax.request_no
                                                                              LEFT JOIN view_employee b on a.emp_id=b.emp_id
                                                                              INNER JOIN hrdleaverequest c on a.request_no=c.request_no
                                                                              WHERE 
                                                                              b.emp_no = '$modal_emp'
                                                                              AND DATE(c.leave_date) 
                                                                                    between 
                                                                                          '$modal_leave_start' and 
                                                                                          '$modal_leave_end'
                                                                              AND (c.dayrequesttype in ('1','2','3') or c.checkday = '3')
                                                                        
                                                                              AND (SELECT request_status 
                                                                                    FROM hrmrequestapproval 
                                                                                    WHERE 
                                                                                          request_no = a.request_no and 
                                                                                          request_status IN ('8','5') 
                                                                                          ORDER BY `request_status` ASC limit 1) IS NULL
                                                                              AND ax.cancelsts = 'N'";
      $having_leave_request   = mysqli_fetch_array(mysqli_query($connect, $sequel));  

} elseif ($modal_first_type_day == '1' && $inp_leavedaytype == 'HD') {
      $sequel_sequence = "2";
      $sequel      = "SELECT 
                                                                                    ax.request_no
                                                                                    FROM hrmleaverequest a
                                                                                    LEFT JOIN hrdleaverequest ax ON a.request_no = ax.request_no
                                                                                    LEFT JOIN view_employee b on a.emp_id=b.emp_id
                                                                                    INNER JOIN hrdleaverequest c on a.request_no=c.request_no
                                                                                    WHERE 
                                                                                    b.emp_no = '$modal_emp'
                                                                                    AND DATE(c.leave_date) 
                                                                                          between 
                                                                                                '$modal_leave_start' and 
                                                                                                '$modal_leave_end'
                                                                                    AND (c.dayrequesttype IN ('1','3') or c.checkday = '3')
                                                                              
                                                                                    AND (SELECT request_status 
                                                                                          FROM hrmrequestapproval 
                                                                                          WHERE 
                                                                                                request_no = a.request_no and 
                                                                                                request_status IN ('8','5') 
                                                                                                ORDER BY `request_status` ASC limit 1) IS NULL
                                                                                    AND ax.cancelsts = 'N'";
      $having_leave_request   = mysqli_fetch_array(mysqli_query($connect, $sequel));  


} elseif ($modal_first_type_day == '2' && $inp_leavedaytype == 'HD') {
      $sequel_sequence = "3";
      $sequel      = "SELECT 
                                                                              ax.request_no
                                                                              FROM hrmleaverequest a
                                                                              LEFT JOIN hrdleaverequest ax ON a.request_no = ax.request_no
                                                                              LEFT JOIN view_employee b on a.emp_id=b.emp_id
                                                                              INNER JOIN hrdleaverequest c on a.request_no=c.request_no
                                                                              WHERE 
                                                                              b.emp_no = '$modal_emp'
                                                                              AND DATE(c.leave_date) 
                                                                                    between 
                                                                                          '$modal_leave_start' and 
                                                                                          '$modal_leave_end'
                                                                              AND (c.dayrequesttype IN ('2','3') or c.checkday = '3')
                                                                        
                                                                              AND (SELECT request_status 
                                                                                    FROM hrmrequestapproval
                                                                                    WHERE
                                                                                          request_no = a.request_no and
                                                                                          request_status IN ('8','5')
                                                                                          ORDER BY `request_status` ASC limit 1) IS NULL
                                                                              AND ax.cancelsts = 'N'";
      $having_leave_request   = mysqli_fetch_array(mysqli_query($connect, $sequel));        

} elseif ($inp_leavedaytype == 'PD') {
      $sequel_sequence = "4";
      $sequel      = "SELECT 
                                                                              a.request_no,
                                                                              s.leavetime 
                                                                              FROM hrdleaverequest a 
                                                                              LEFT JOIN hrmleaverequest b on a.request_no=b.request_no 
                                                                              LEFT JOIN ttamleavetype c on b.leave_code=c.leave_code
                                                                              LEFT JOIN view_employee d on d.emp_id=b.emp_id    
                                                                              LEFT JOIN (SELECT aX.request_no,aX.leave_starttime as leavetime 
                                                                                                FROM hrdleaverequest aX
                                                                                                      LEFT JOIN hrmleaverequest bX on aX.request_no=bX.request_no 
                                                                                                      LEFT JOIN ttamleavetype cX on bX.leave_code=cX.leave_code 
                                                                                                      LEFT JOIN view_employee dX on bX.emp_id=dX.emp_id           
                                                                                                      WHERE
                                                                                                      dX.emp_no = '$modal_emp' AND
                                                                                                      (aX.dayrequesttype in ('1','2','3') or aX.checkday = '3') 
                                                                                                      
                                                                                                      AND (SELECT request_status 
                                                                                                      FROM hrmrequestapproval WHERE request_no = aX.request_no and request_status IN ('8','5') 
                                                                                                      ORDER BY `request_status` ASC limit 1) IS NULL
                                                                                                      
                                                                                                      UNION ALL
                                                                              
                                                                                                      SELECT a.request_no,a.leave_endtime as leavetime FROM hrdleaverequest a 
                                                                                                      LEFT JOIN hrmleaverequest b on a.request_no=b.request_no 
                                                                                                      LEFT JOIN ttamleavetype c on b.leave_code=c.leave_code 
                                                                                                      LEFT JOIN view_employee d on b.emp_id=d.emp_id           
                                                                                                      WHERE 
                                                                                                      d.emp_no = '$modal_emp' and
                                                                                                      (a.dayrequesttype in ('1','2','3') or a.checkday = '3') 
                                                                                                      
                                                                                                      AND (SELECT request_status 
                                                                                                      FROM hrmrequestapproval WHERE request_no = a.request_no and request_status IN ('8','5') 
                                                                                                      ORDER BY `request_status` ASC limit 1) IS NULL) AS s ON a.request_no=s.request_no
                                                                                                      
                                                                              WHERE
                                                                              d.emp_no = '$modal_emp' AND
                                                                              '$modal_leave_startTime' between '$SFMaxReqFrom[leavetime]' AND '$SFMaxReqto[leavetime]' AND
                                                                              s.leavetime between '$SFMaxReqFrom[leavetime]' AND '$SFMaxReqto[leavetime]' AND
                                                                              (a.dayrequesttype in ('1','2','3') or a.checkday = '3') 
                                                                              
                                                                              AND (SELECT request_status s
                                                                                                FROM hrmrequestapproval 
                                                                                                WHERE 
                                                                                                      request_no = a.request_no and 
                                                                                                      request_status IN ('8','5')  ORDER BY `request_status` ASC limit 1) IS NULL";

      $having_leave_request   = mysqli_fetch_array(mysqli_query($connect, $sequel));     

} elseif($inp_leavedaytype == 'FD'){
      $sequel_sequence = "5";
      $sequel = "SELECT 
                                                                              ax.request_no
                                                                              FROM hrmleaverequest a
                                                                              LEFT JOIN hrdleaverequest ax ON a.request_no = ax.request_no
                                                                              LEFT JOIN view_employee b on a.emp_id=b.emp_id
                                                                              INNER JOIN hrdleaverequest c on a.request_no=c.request_no
                                                                              WHERE 
                                                                              b.emp_no = '$modal_emp'
                                                                              AND DATE(c.leave_date) 
                                                                                    between 
                                                                                          '$modal_leave_start' and 
                                                                                          '$modal_leave_end'
                                                                              AND (c.dayrequesttype in ('1','2','3') or c.checkday = '3')
                                                                        
                                                                              AND (SELECT request_status 
                                                                                    FROM hrmrequestapproval 
                                                                                    WHERE 
                                                                                          request_no = a.request_no and 
                                                                                          request_status IN ('8','5') 
                                                                                          ORDER BY `request_status` ASC limit 1) IS NULL
                                                                              AND ax.cancelsts = 'N'";

      $having_leave_request   = mysqli_fetch_array(mysqli_query($connect, $sequel)); 
} else {
      $sequel_sequence = "6";
      $sequel = "nangadong";

}

echo $sequel_sequence;
echo $sequel;

$having_leave_requestno_print = $having_leave_request['request_no'];

$alert            = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '1'"));
$alert_print      = $alert['alert'];

$var1 = array("#request_no");
$var2 = array("$having_leave_requestno_print");
$conversion = str_replace($var1, $var2, $alert_print );

if(!empty($having_leave_requestno_print)){
      // echo $debug.$modal_first_type_day;
      echo '<script type="text/javascript">
                  window.alert("'.$conversion.'");     
            </script>';

            // echo $having_leave_request_print;
     
} else {
// VALIDASI APAKAH ADA ISRISAN PENGAJUAN LEAVE
// VALIDASI APAKAH ADA ISRISAN PENGAJUAN LEAVE


/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
// JIKA KEDUA VALIDASI DI ATAS SUDAH SESUAI DAN TIDAK MASALAH MAKA CEK BERAPA HARI LEAVE REQ
// JIKA KEDUA VALIDASI DI ATAS SUDAH SESUAI DAN TIDAK MASALAH MAKA CEK BERAPA HARI LEAVE REQ
$var_lv_total      = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                  count(a.daytype) as total
                                                                  FROM hrdattendance a
                                                                  LEFT JOIN view_employee b on a.emp_id=b.emp_id
                                                                  WHERE 
                                                                  b.emp_no = '$modal_emp' and
                                                                  a.daytype IN ('WD','PHWD') and
                                                                  a.dateforcheck between '$modal_leave_start' and '$modal_leave_end'"));

if($modal_first_type_day == '1'){
      $total_leave = $var_lv_total['total']-0.5;
} elseif($modal_first_type_day == '2' && $modal_first_type_day2 == '1'){
      $total_leave = $var_lv_total['total']-1;
} elseif($modal_first_type_day == '2' && $modal_first_type_day2 == '3'){
      $total_leave = $var_lv_total['total']-0.5;
} elseif($modal_first_type_day == '2' && $modal_first_type_day2 == 'undefined'){
      $total_leave = $var_lv_total['total']-0.5;
} elseif($modal_first_type_day == '3' && $modal_first_type_day2 == '1'){
      $total_leave = $var_lv_total['total']-0.5;
} else {
      $total_leave = $var_lv_total['total'];
}

$var_emp_id       = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM view_employee WHERE emp_no = '$modal_emp'"));
// JIKA KEDUA VALIDASI DI ATAS SUDAH SESUAI DAN TIDAK MASALAH MAKA CEK BERAPA HARI LEAVE REQ
// JIKA KEDUA VALIDASI DI ATAS SUDAH SESUAI DAN TIDAK MASALAH MAKA CEK BERAPA HARI LEAVE REQ

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//VALIDASI APAKAH LEAVE BALANCE AKTIF CUKUP
//VALIDASI APAKAH LEAVE BALANCE AKTIF CUKUP
$val_leave_balance   = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                        
                                                                        REPLACE(SUM(c.remaining),'.0000','') as remaining
                                                                        from view_employee a
                                                                        LEFT JOIN teomemppersonal b on a.emp_id=b.emp_id
                                                                        LEFT JOIN hrmempleavebal c on a.emp_id=c.emp_id
                                                                        WHERE a.emp_no='$modal_emp' and c.leave_code = '$modal_leave' and c.active_status = '1'"));
$val_leave_remaining_balance_print = $val_leave_balance['remaining'];

$alert2            = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '2'"));
$alert_print2      = $alert2['alert'];

$var1 = array("#leavebalance");
$var2 = array("$val_leave_remaining_balance_print");
$conversion2 = str_replace($var1, $var2, $alert_print2 );

if($val_leave_remaining_balance_print < $total_leave && $data_var_validation_allow == '0'){
      echo "<script type='text/javascript'>
                  window.alert('$conversion2');
            </script>";
} else {
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG





//MENCARI APPROVER DARI FORMULA LEAVE YANG ADA DI DB CONFIG
//MENCARI APPROVER DARI FORMULA LEAVE YANG ADA DI DB CONFIG
$get_approver_setting = mysqli_query($connect,"SELECT 
                                                      REPLACE(a.request_approval_formula, '*', '') as request_approval_formula,
                                                      a.position_id,
                                                      b.seq_id,
                                                      a.request_approval_name,
                                                      a.req,
                                                      a.ordering
                                                FROM tclcreqappsetting_final_fantasy_final a
                                                LEFT JOIN tclcreqappsetting_final b on a.seq_id=b.seq_id
                                                LEFT JOIN hrmorgstruc c on b.position_id=c.pos_code
                                                LEFT JOIN view_employee d on c.position_id=d.position_id

                                                WHERE d.emp_no='$modal_emp'
                                                and b.status_use = '1'");

$get_approver_setting_sf = mysqli_num_rows($get_approver_setting);
if($get_approver_setting_sf > 0){
      $modal_approval            = mysqli_query($connect, 
                                                      "SELECT 
                                                      REPLACE(a.request_approval_formula, '*', '') as request_approval_formula,
                                                      a.position_id,
                                                      b.seq_id,
                                                      a.request_approval_name,
                                                      a.req,
                                                      a.ordering
                                                      FROM tclcreqappsetting_final_fantasy_final a
                                                      LEFT JOIN tclcreqappsetting_final b on a.seq_id=b.seq_id
                                                      LEFT JOIN hrmorgstruc c on b.position_id=c.pos_code
                                                      LEFT JOIN view_employee d on c.position_id=d.position_id

                                                      WHERE d.emp_no='$modal_emp'
                                                      and b.status_use = '1'
                                                      ");   
} else {
      $modal_approval = mysqli_query($connect, 
                        "SELECT 
                        a.emp_no as seq_id,
                        a.empno_appvr1,
                        x2.position_id,
                        x2.pos_code as request_approval_formula,
                        'Notification' as req,
                        '0' as ordering
                        FROM tclcdreqappsetting a
                        LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                        LEFT JOIN view_employee x2 on a.empno_appvr1=x2.emp_no
                        WHERE a.emp_no = '$modal_emp' and
                              a.empno_appvr1 is not null and
                              a.empno_appvr1 <> ''
                        
                              UNION ALL
                              
                              SELECT 
                              a.emp_no as seq_id,
                              a.empno_appvr2,
                              x2.position_id,
                              x2.pos_code as request_approval_formula,
                              'Sequence' as req,
                              '0' as ordering
                              FROM tclcdreqappsetting a
                              LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                              LEFT JOIN view_employee x2 on a.empno_appvr2=x2.emp_no
                              WHERE a.emp_no = '$modal_emp' and
                                    a.empno_appvr2 is not null and
                                    a.empno_appvr2 <> ''
                              
                                    UNION ALL
                                    
                                    SELECT 
                                    a.emp_no as seq_id,
                                    a.empno_appvr3,
                                    x2.position_id,
                                    x2.pos_code as request_approval_formula,
                                    'Required' as req,
                                    '0' as ordering
                                    FROM tclcdreqappsetting a
                                    LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
                                    LEFT JOIN view_employee x2 on a.empno_appvr3=x2.emp_no
                                    WHERE a.emp_no = '$modal_emp' and
                                          a.empno_appvr3 is not null and
                                          a.empno_appvr3 <> ''
                        ");
            }
      
      while($r=mysqli_fetch_array($modal_approval)){  
      
?>



<?php
// $printf = mysqli_num_rows($modal);
$printf = mysqli_num_rows($modal_approval);
$total = $var_lv_total['total'];

//JIKA HARI YANG DI REQUEST LEBIH DARI 1 ATAU MISALKAN YANG DIREQUEST DI HARI KERJA MAKA BISA DI ENTRY
//JIKA HARI YANG DI REQUEST LEBIH DARI 1 ATAU MISALKAN YANG DIREQUEST DI HARI KERJA MAKA BISA DI ENTRY

if($total > 0){


      //JIKA TERDAPAT WORKFLOW APPROVAL FORMULA MAKA BERHASIL JIKA TIDAK MAKA ADA ALERT
      //JIKA TERDAPAT WORKFLOW APPROVAL FORMULA MAKA BERHASIL JIKA TIDAK MAKA ADA ALERT
      if($printf > 0)
            {
            $var1 = $r['request_approval_formula'];
            $var2 = mysqli_fetch_array(mysqli_query($connect, 
                                                "SELECT 
                                                b.pos_code 
                                                FROM 
                                                view_employee a 
                                                LEFT JOIN hrmorgstruc b on a.position_id=b.position_id 
                                                WHERE a.emp_no = '$username'"));
            
                  if ($var1 == $var2['pos_code']) {
                        $lvsts = '1';
                  } else {
                        $lvsts = '0';
                  }
            
            $var3 = mysqli_fetch_array(mysqli_query($connect, "SELECT
                                                a.emp_no,
                                                b.position_id,
                                                e.pos_code,
                                                c.seq_id,
                                                d.req,
                                                f.emp_no
                                                FROM view_employee a
                                                LEFT JOIN hrmorgstruc b on a.position_id=b.position_id
                                                LEFT JOIN tclcreqappsetting_final c on b.pos_code=c.position_id
                                                LEFT JOIN tclcreqappsetting_final_fantasy_final d on c.seq_id=d.seq_id and d.req IN ('Sequence','Required')
                                                LEFT JOIN hrmorgstruc e on REPLACE(d.request_approval_formula, '*', '')=e.pos_code
                                                LEFT JOIN view_employee f on e.position_id=f.position_id
                                                WHERE a.emp_no = '$modal_emp' and f.emp_no='$username'"));
            
            if ($var1 == $var3['pos_code']) {
                  $lvreqsts = '2';
            } else {
                  $lvreqsts = '1';
            }


            //APABILA URGENT REQUEST
            //APABILA URGENT REQUEST
            if ($inp_urgent_decl == '1') {
                  $inp_urgent_decl_print = 'N';
            } else {
                  $inp_urgent_decl_print = 'Y';
            }
            //APABILA URGENT REQUEST
            //APABILA URGENT REQUEST


            /**
             *
             * '||''|.                            '||
             *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
             *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
             *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
             * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
             *                                                  ||
             * --------------- By Display:inline ------------- '''' -----------
             */
            
            // $process_approval = mysqli_query($connect, "INSERT INTO hrmrequestapproval 
            //                                           (
            //                                                 `request_no`, 
            //                                                 `approval_list`,
            //                                                 `seq_id`,
            //                                                 `req`,
            //                                                 `status`,
            //                                                 `ordering`,
            //                                                 `request_status`,
            //                                                 `position_id`
            //                                           ) 
            //                                                 VALUES 
            //                                                       (
            //                                                             '$SFnumbercon', 
            //                                                             '$r[request_approval_formula]', 
            //                                                             '$r[seq_id]',  
            //                                                             '$r[req]',
            //                                                             '$lvsts',
            //                                                             '$r[ordering]',
            //                                                             '$lvreqsts',
            //                                                             '$r[position_id]' 
            //                                                       )");

            // $process_request = mysqli_query($connect, "INSERT INTO hrmleaverequest
            //                         (
            //                               `request_no`, 
            //                               `company_id`,
            //                               `requestedby`, 
            //                               `emp_id`, 
            //                               `requestdate`, 
            //                               `leave_code`,
            //                               `leave_startdate`, 
            //                               `leave_enddate`, 
            //                               `totaldays`, 
            //                               `remark`, 
            //                               `approval_status`, 
            //                               `created_by`, 
            //                               `created_date`,
            //                               `modified_by`, 
            //                               `modified_date`, 
            //                               `refdoc`,
            //                               `urgent_reason`,
            //                               `urgent_request`,
            //                               `request_access_code`,
            //                               `token`) 
            //                                     VALUES 
            //                                     (
            //                                           '$SFnumbercon', 
            //                                           '13576', 
            //                                           '$var_emp_id[emp_id]', 
            //                                           '$var_emp_id[emp_id]', 
            //                                           '$SFdatetime', 
            //                                           '$modal_leave', 
            //                                           '$modal_leave_start', 
            //                                           '$modal_leave_end', 
            //                                           '$total_leave', 
            //                                           '$modal_remark' , 
            //                                           '0', 
            //                                           '$username', 
            //                                           '$SFdatetime', 
            //                                           '$username', 
            //                                           '$SFdatetime', 
            //                                           '0',
            //                                           '$sel_inp_urgreason',
            //                                           '$inp_urgent_decl_print',
            //                                           '$data_var_validation_allow_request_access_code',
            //                                           '$SFGet_token')
            //                         ");

                                    /**
                                     *
                                     * '||''|.                            '||
                                     *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
                                     *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
                                     *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
                                     * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
                                     *                                                  ||
                                     * --------------- By Display:inline ------------- '''' -----------
                                     */

                                    // CEK APAKAH QUERY UNTUK INSERT LEAVE BERHASIL ATAU TIDAK
                                    // CEK APAKAH QUERY UNTUK INSERT LEAVE BERHASIL ATAU TIDAK

                                    $target_dir = "../../asset/request.file.attachment/"; // tempat menyimpan gambar yang telah di upload
                                    $target_file = $target_dir.$newfilename.$_FILES['inp_refdoc']['name'][$key]; //memanggil data di dalam tempat penyimpanan
                                    $target_file_save = $newfilename.$_FILES['inp_refdoc']['name'][$key]; //memanggil data di dalam tempat penyimpanan
                                    
                                    if(move_uploaded_file($_FILES['inp_refdoc']['tmp_name'][$key],$target_file)){
                                          $inp_refdoc_arr[] = $target_file; //menyimpan gambar yang telah di simpan ke dalam array $inp_refdoc_array
                        
                                          $query = "INSERT INTO hrmattachment (request_no,file_name,file_size,file_type) VALUES
                                                      ('$SFnumbercon','$target_file_save','$size','$type')";
                                          $result = mysqli_query($connect, $query);
                                    }
      
                                    


                                    if($process_request)
                                    {
                                                $leave_request_detail            = mysqli_query($connect, "SELECT 
                                                                                                      a.shiftstarttime,
                                                                                                      a.shiftendtime,
                                                                                                      DATE(a.shiftstarttime) as date_shift,
                                                                                                      MID(a.shiftstarttime,12,12) as shift_start,
                                                                                                      MID(a.shiftendtime,12,12) as shift_end
                                                                                                      FROM hrdattendance a
                                                                                                      LEFT JOIN view_employee b on a.emp_id=b.emp_id
                                                                                                      WHERE 
                                                                                                      b.emp_no = '$modal_emp' and
                                                                                                      a.daytype IN ('WD','PHWD') and
                                                                                                      a.dateforcheck between '$modal_leave_start' and '$modal_leave_end'");

                                                while($r_detail=mysqli_fetch_array($leave_request_detail)){
                                                      
                                                      if ($modal_leave_start == $r_detail['date_shift']) {
                                                            $inp_leavedaytype_print = $modal_first_type_day;
                                                            if($modal_first_type_day == '3'){
                                                                  $HDDeduction = 'N';
                                                            } else {
                                                                  $HDDeduction = 'Y';
                                                            }
                                                      }
                                                      else if ($modal_leave_end == $r_detail['date_shift']) {
                                                            $inp_leavedaytype_print = $modal_first_type_day2;
                                                            if($modal_first_type_day2 == '3'){
                                                                  $HDDeduction = 'N';
                                                            } else {
                                                                  $HDDeduction = 'Y';
                                                            }
                                                      }
                                                      else {
                                                            $inp_leavedaytype_print = '3';
                                                      }

                                                      $SFdatetimeConv                     = date ("Y-m-d", strtotime ($r_detail['shiftstarttime']));

                                                      // GET TIME
                                                      if(!empty($inp_starttime) && $inp_starttime != '00:00')
                                                      {
                                                            $SFdatetimeStart             = date("$SFdatetimeConv $inp_starttime:00");
                                                      } else {
                                                            $SFdatetimeStart             = $r_detail['shiftstarttime'];
                                                      }

                                                      if(!empty($inp_endtime) && $inp_endtime != '00:00')
                                                      {
                                                            $SFdatetimeEnd                = date("$SFdatetimeConv $inp_endtime:00");
                                                      } else {
                                                            $SFdatetimeEnd                = $r_detail['shiftendtime'];
                                                      }
                                                      // GET TIME

                                                      $SFdebug1                = $r_detail['shiftstarttime'];
                                                      $SFdebug2                = $r_detail['shiftendtime'];

                                                      // $process_detail = mysqli_query($connect, "INSERT INTO hrdleaverequest 
                                                      //                                                                   (
                                                      //                                                                         `request_no`, 
                                                      //                                                                         `company_id`, 
                                                      //                                                                         `leave_date`, 
                                                      //                                                                         `leave_starttime`, 
                                                      //                                                                         `leave_endtime`, 
                                                      //                                                                         `created_by`, 
                                                      //                                                                         `created_date`, 
                                                      //                                                                         `modified_by`, 
                                                      //                                                                         `modified_date`, 
                                                      //                                                                         `cancelsts`, 
                                                      //                                                                         `halfday_deduction`, 
                                                      //                                                                         `leave_start_halfday`, 
                                                      //                                                                         `leave_end_halfday`, 
                                                      //                                                                         `dayrequesttype`,
                                                      //                                                                         debug
                                                      //                                                                   ) 
                                                      //                                                                         VALUES 
                                                      //                                                                               (
                                                      //                                                                                     '$SFnumbercon', 
                                                      //                                                                                     '13576', 
                                                      //                                                                                     '$r_detail[shiftstarttime]',
                                                      //                                                                                     '$SFdatetimeStart',
                                                      //                                                                                     '$SFdatetimeEnd',
                                                      //                                                                                     '$username', 
                                                      //                                                                                     '$SFdatetime', 
                                                      //                                                                                     '$username', 
                                                      //                                                                                     '$SFdatetime', 
                                                      //                                                                                     'N', 
                                                      //                                                                                     '$HDDeduction', 
                                                      //                                                                                     '0000-00-00 00:00:00', 
                                                      //                                                                                     '0000-00-00 00:00:00', 
                                                      //                                                                                     '$inp_leavedaytype_print',
                                                      //                                                                                     '$inp_starttime | $SFdebug1 | $inp_endtime |$SFdebug2 '
                                                      //                                                                               )");
                                                }

                                                // if($process_detail)
                                                // {
                                                //       $leave_replace_halfday              = mysqli_query($connect, "SELECT 
                                                //                                                                               ax.request_no,
                                                //                                                                               ax.leave_date,
                                                //                                                                               ax.dayrequesttype,
                                                //                                                                                           count(ax.leave_date) AS var
                                                //                                                                               FROM hrdleaverequest ax
                                                //                                                                               LEFT JOIN hrmleaverequest bx on ax.request_no=bx.request_no
                                                //                                                                                           LEFT JOIN view_employee cx on bx.emp_id=cx.emp_id
                                                //                                                                                           WHERE ax.dayrequesttype IN ('1','2') 
                                                //                                                                                           AND cx.emp_no='$modal_emp'
                                                //                                                                               GROUP BY ax.leave_date
                                                //                                                                         ");

                                                //       while($r_detail_leave_replace_halfday =mysqli_fetch_array($leave_replace_halfday)){

                                                //       $print_leave_replace_halfday_req    = $r_detail_leave_replace_halfday['request_no'];
                                                //       $print_leave_replace_halfday_date   = $r_detail_leave_replace_halfday['leave_date'];

                                                //       $print_leave_replace_halfday_vars   = $r_detail_leave_replace_halfday['var'];

                                                //       if($print_leave_replace_halfday_vars > '1') 
                                                //             {
                                                //                   $process_leave_replace_halfday      = mysqli_query($connect, "UPDATE hrdleaverequest SET checkday='3' WHERE request_no = '$print_leave_replace_halfday_req'");
                                                //             }
                                                //       }

                                                // }
                                                
                                    }




if($leave_request_detail) 
      {

            echo "<script type='text/javascript'>
                        window.alert('Successfully Insert New Data Your Request is Complete'); 
                            
                  </script>";
            
                  $get_no = mysqli_fetch_array(mysqli_query($connect, "SELECT max(log_header_id)+1 AS header FROM TCLLMLOGACTIVITY LIMIT 1"));
                  mysqli_query($connect,"INSERT INTO `TCLLMLOGACTIVITY` 
                        (
                              `log_header_id`,
                              `table_name`, 
                              `record_key`, 
                              `activity_type`, 
                              `modified_date`, 
                              `modified_by`, 
                              `devices`, 
                              `sfpage`
                        ) 
                              VALUES 
                                    (
                                          '$get_no[header]', 
                                          'hrmleaverequest', 
                                          '$SFnumbercon', 
                                          'I', 
                                          '$SFdatetime', 
                                          '$username', 
                                          'Mobile',
                                          'con_leave_save.php'
                                    )");

            }
            else
            {
                  echo"<script type='text/javascript'>
                              window.alert('Wrong Approval Formula');     
                        </script>";
            } 
      }
                               
      
            
} else {
      echo"<script type='text/javascript'>
            window.alert('0 Days Request'); 
             
      </script>";
}
}

?><?php }}}}}} ?>