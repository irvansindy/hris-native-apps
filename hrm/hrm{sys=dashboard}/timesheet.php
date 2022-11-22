<?php
require_once '../../application/config.php';

//if form is submitted
if ($_POST) {

   $validator = array('success' => false, 'messages' => array());
   $datetime            = date('Y-m-d H:i:s');
   $date               = date('Y-m-d');
   $dateprint             = date('d M Y');
   $time               = date('h:i:s');
   $request            = date('Ydhis');


   $username           = $_POST['emp_no'];
   $attend_id          = $username . $request;
   $emp_no             = $_POST['emp_no'];
   $geolocation        = $_POST['geolocation'];
   $geolocation2       = $_POST['geolocation2'];
   $inp_customre_name  = $_POST['inp_customre_name'];
   $inp_region         = $_POST['inp_region'];
   $inp_information    = $_POST['inp_information'];


   $checkbox1 = $_POST['timesheet'];
   $chk = "";
   foreach ($checkbox1 as $chk1) {
      $chk .= $chk1 . ",";
   }

   if ($emp_no == '' || $geolocation == '' || $geolocation2 == '' || $inp_customre_name == '' || $inp_region == '') {

   } else {

   $temp = "../../application/API/uploads/";
   if (!file_exists($temp))

   mkdir($temp);



   $inp_Attachment_request_no  = $attend_id;
   $inp_Attachment_emp_no      = $_POST['inp_Attachment_emp_no'];
   $nama_file                  = $attend_id."_".$SFnumber;
   $fileupload                 = $_FILES['fileupload']['tmp_name'];
   $ImageName                  = $_FILES['fileupload']['name'];
   $ImageType                  = $_FILES['fileupload']['type'];
   $ImageSize 		             = $_FILES['fileupload']['size'];

   if (!empty($fileupload)) {
        $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt       = str_replace('.', '', $ImageExt); // Extension
        $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $newFilenaming   = str_replace(' ', '', $nama_file . '.' . $ImageExt);

        move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp . $newFilenaming); // Menyimpan file

         $sql_0 = "INSERT INTO ttadatttimesheet (
                                    attend_id,
                                    latitude,
                                    longlatitude,
                                    emp_no,
                                    photos,
                                    created_date,
                                    modified_date,
                                    task,
                                    customer_name,
                                    region,
                                    information) value (
                                       '$attend_id',
                                       '$geolocation',
                                       '$geolocation2',
                                       '$username',    
                                       '$newFilenaming',
                                       '$datetime',
                                       '$datetime',
                                       '$chk',
                                       '$inp_customre_name',
                                       '$inp_region',
                                       '$inp_information')";

         $query_0 = $connect->query($sql_0);

         if ($query_0 == TRUE) {
            $validator['success'] = false;
            $validator['code'] = "success_message";
            $validator['messages'] = "Successfully submit request";
         } else {
            $validator['success'] = false;
            $validator['code'] = "failed_message";
            $validator['messages'] = "Wrong approval formula for some employee ";
         }
      }
   }

   // close the database connection
   $connect->close();
   echo json_encode($validator);
}
