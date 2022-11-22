<?php include "../../application/session/session.php";?>
<?php
        date_default_timezone_set('Asia/Bangkok'); 
        $datetime		    = date('Y-m-d H:i:s');
        $date   		    = date('Y-m-d');
        $dateprint 		    = date('d M Y');
        $time   		    = date('h:i:s');
        $request	        = date('Ydhis');
        $attend_id			= $username.$request;

        //mendefinisikan folder
        define('UPLOAD_DIR', '../../application/API/uploads/');


        $img            = $_POST['image'];
        $username       = $_POST['emp_no'];
        $emp_no         = $_POST['emp_no'];
        $geolocation    = $_POST['geolocation'];
        $geolocation2   = $_POST['geolocation2'];

        $tipe       = $_POST['tipe'];
        $whats = $_POST['tipe'] == '2' ? $getdata = '0' : $getdata = '1';
    
        $img        = str_replace('data:image/jpeg;base64,', '', $img);
        $img        = str_replace(' ', '+', $img);

        $data       = base64_decode($img);
        $file       = $_POST['emp_no'] . $request . uniqid() . '.png';
        file_put_contents(UPLOAD_DIR.$file, $data);

        if($emp_no == '' || $img == '' || $geolocation == '' || $geolocation2 == ''){
            echo"<script type='text/javascript'>
                        window.alert('failed'); 
                </script>";
        } else {
            
            //checking parameter
            
            $checkQuery= "SELECT (6371 * acos( 
                cos( radians(a.latitude) ) 
              * cos( radians($geolocation) ) 
              * cos( radians(a.longlatitude ) - radians($geolocation2) ) 
              + sin( radians(a.latitude) ) 
              * sin( radians($geolocation) )
                )) as distance 
                
            FROM users a
            LEFT JOIN teomdistance b on b.id = '1'

                    WHERE
                    a.username = '$username' and
                    
                    ROUND((6371 * acos( 
                                    cos( radians(a.latitude) ) 
                                  * cos( radians($geolocation) ) 
                                  * cos( radians(a.longlatitude ) - radians($geolocation2) ) 
                                  + sin( radians(a.latitude) ) 
                                  * sin( radians($geolocation) )
                                    )),1) <= b.distance_km";

            $query=mysqli_query($connect,$checkQuery);
            $check_query_count=mysqli_num_rows($query);

            $having_location = mysqli_fetch_array(mysqli_query($connect, "SELECT latitude FROM users WHERE username = '$username'"));
            $having_location_print = $having_location['latitude'];

            if(empty($check_query_count))
                {
                $checkQuery = mysqli_fetch_array(mysqli_query($connect, "SELECT (6371 * acos( 
                                                                        cos( radians(a.latitude) ) 
                                                                        * cos( radians($geolocation) ) 
                                                                        * cos( radians(a.longlatitude ) - radians($geolocation2) ) 
                                                                        + sin( radians(a.latitude) ) 
                                                                        * sin( radians($geolocation) )
                                                                        )) as distance 
                                                                    FROM users a WHERE a.username = '$username'"));
                                                                    $printcheckQuery = $checkQuery['distance'];

                $save_outzone = mysqli_query($connect, "INSERT INTO ttadattendancetemp (
                                                                attend_id,
                                                                latitude,
                                                                longlatitude,
                                                                emp_no,
                                                                status,
                                                                distance,
                                                                photos,
                                                                distance_flag,
                                                                created_date,
                                                                modified_date) value (
                                                                    '$attend_id',
                                                                    '$geolocation',
                                                                    '$geolocation2',
                                                                    '$username',
                                                                    '$tipe',
                                                                    '$printcheckQuery',
                                                                    '$file',
                                                                    'out',
                                                                    '$datetime',
                                                                    '$datetime')");
                
                $sql_attendancetemp = mysqli_query($connect, "SELECT *, DATE(a.attend_date) AS attend_date_process FROM hrdattendancetemp a 
										WHERE a.attendanceid = '$emp_no' AND 
										DATE(attend_date) BETWEEN '$date' AND '$date'");
                while($rSql_attendancetemp = mysqli_fetch_array($sql_attendancetemp)){
                        //echo $rSql_attendancetemp['attend_date'] . " | " . $rSql_attendancetemp['status'] ."<br>";

                        $rSql_attendancetemp_attendanceid = $rSql_attendancetemp['attendanceid'];
                        $rSql_attendancetemp_attend_date = $rSql_attendancetemp['attend_date_process'];
                        $rSql_attendancetemp_status	= $rSql_attendancetemp['status'];
                        $attenddate = $rSql_attendancetemp['attend_date'];

                        $sql_hrdattendance = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                        b.emp_no,
                                                        a.attend_id,
                                                        a.emp_id,
                                                        a.shiftdaily_code,
                                                        a.dateforcheck,
                                                        '$rSql_attendancetemp_status' as status_attendance,
                                                        DATE(a.shiftstarttime) AS date_start,
                                                        DATE(a.shiftstarttime) AS date_end
                                                    FROM hrdattendance a 
                                                    LEFT JOIN view_employee b on a.emp_id=b.emp_id
                                                    WHERE
                                                    b.emp_no = '$rSql_attendancetemp_attendanceid' AND
                                                    ((CASE 
                                                    WHEN '$rSql_attendancetemp_status'+1 = 1 THEN DATE(a.shiftendtime) = '$rSql_attendancetemp_attend_date' 
                                                    WHEN '$rSql_attendancetemp_status'+1 > 1 THEN DATE(a.shiftstarttime) = '$rSql_attendancetemp_attend_date' END))"));


                        $get_attendance_attend_id = $sql_hrdattendance['attend_id'];
                        $get_attendance_emp_no = $sql_hrdattendance['emp_no'];
                        $get_attendance_emp_id = $sql_hrdattendance['emp_id'];
                        $get_attendance_status_attendance = $sql_hrdattendance['status_attendance'];
                        $get_attendance_shiftdaily_code = $sql_hrdattendance['shiftdaily_code'];
                        $get_attendance_dateforcheck = $sql_hrdattendance['dateforcheck'];
                        $get_attendance_date_start = $sql_hrdattendance['date_start'];
                        $get_attendance_date_end = $sql_hrdattendance['date_end'];
                        $get_attendance_shiftstarttime = $sql_hrdattendance['get_attendance_shiftstarttime'];
                        $DataRows4 = $whats;

                        include "../set{sys=system_function_authorization}/attendance_process.php";
                        if($update_attendance) {
                            include "../set{sys=system_function_authorization}/attendance_formula.php";
                    }
                }
            

            } else {
                $checkQuery = mysqli_fetch_array(mysqli_query($connect, "SELECT (6371 * acos( 
                                                                            cos( radians(a.latitude) ) 
                                                                            * cos( radians($geolocation) ) 
                                                                            * cos( radians(a.longlatitude ) - radians($geolocation2) ) 
                                                                            + sin( radians(a.latitude) ) 
                                                                            * sin( radians($geolocation) )
                                                                            )) as distance 
                                                                        FROM users a WHERE a.username = '$username'"));
                                                                        $printcheckQuery = $checkQuery['distance'];

                $save = mysqli_query($connect, "
                                                    INSERT INTO ttadattendancetemp (
                                                        attend_id,
                                                        latitude,
                                                        longlatitude,
                                                        emp_no,
                                                        status,
                                                        distance,
                                                        photos,
                                                        distance_flag,
                                                        created_date,
                                                        modified_date) value (
                                                            '$attend_id',
                                                            '$geolocation',
                                                            '$geolocation2',
                                                            '$username',
                                                            '$tipe',
                                                            '$printcheckQuery',
                                                            '$file',
                                                            'in',
                                                            '$datetime',
                                                            '$datetime')");
            }


            $sql_attendancetemp = mysqli_query($connect, "SELECT *, DATE(a.attend_date) AS attend_date_process FROM hrdattendancetemp a 
										WHERE a.attendanceid = '$emp_no' AND 
										DATE(attend_date) BETWEEN '$date' AND '$date'");
                while($rSql_attendancetemp = mysqli_fetch_array($sql_attendancetemp)){
                        //echo $rSql_attendancetemp['attend_date'] . " | " . $rSql_attendancetemp['status'] ."<br>";

                        $rSql_attendancetemp_attendanceid = $rSql_attendancetemp['attendanceid'];
                        $rSql_attendancetemp_attend_date = $rSql_attendancetemp['attend_date_process'];
                        $rSql_attendancetemp_status	= $rSql_attendancetemp['status'];
                        $attenddate = $rSql_attendancetemp['attend_date'];

                        $sql_hrdattendance = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                        b.emp_no,
                                                        a.attend_id,
                                                        a.emp_id,
                                                        a.shiftdaily_code,
                                                        a.dateforcheck,
                                                        '$rSql_attendancetemp_status' as status_attendance,
                                                        DATE(a.shiftstarttime) AS date_start,
                                                        DATE(a.shiftstarttime) AS date_end
                                                    FROM hrdattendance a 
                                                    LEFT JOIN view_employee b on a.emp_id=b.emp_id
                                                    WHERE
                                                    b.emp_no = '$rSql_attendancetemp_attendanceid' AND
                                                    ((CASE 
                                                    WHEN '$rSql_attendancetemp_status'+1 = 1 THEN DATE(a.shiftendtime) = '$rSql_attendancetemp_attend_date' 
                                                    WHEN '$rSql_attendancetemp_status'+1 > 1 THEN DATE(a.shiftstarttime) = '$rSql_attendancetemp_attend_date' END))"));


                        $get_attendance_attend_id = $sql_hrdattendance['attend_id'];
                        $get_attendance_emp_no = $sql_hrdattendance['emp_no'];
                        $get_attendance_emp_id = $sql_hrdattendance['emp_id'];
                        $get_attendance_status_attendance = $sql_hrdattendance['status_attendance'];
                        $get_attendance_shiftdaily_code = $sql_hrdattendance['shiftdaily_code'];
                        $get_attendance_dateforcheck = $sql_hrdattendance['dateforcheck'];
                        $get_attendance_date_start = $sql_hrdattendance['date_start'];
                        $get_attendance_date_end = $sql_hrdattendance['date_end'];
                        $get_attendance_shiftstarttime = $sql_hrdattendance['get_attendance_shiftstarttime'];
                        $DataRows4 = $whats;

                        include "../set{sys=system_function_authorization}/attendance_process.php";
                        if($update_attendance) {
                            include "../set{sys=system_function_authorization}/attendance_formula.php";
                    }
                }
        }
        

     
            echo "SQLSuccess";

            exit();
    ?>