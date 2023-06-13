<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    // directory file
    $directoryFile = '../../../asset/request.file.attachment/';

    // allowed file types
    $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'ods');

    $response = [
        'success' => false,
        'message' => []
    ];

    if ($_POST) {
        if ($_FILES['fileupload']) {
            // set file upload
            $file_name = $_FILES['fileupload']['name'];
            $file_upload = $_FILES['fileupload']['tmp_name'];

            // default size
            $width_size = 480;

            // directory file save
            $file_save = $directoryFile . $file_name;
            move_uploaded_file($file_upload, $file_save);

            // get uploaded file's extension
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // image file
            $final_file_name = 'LVR'. '-'.rand(1000,1000000).$ext;
            // $final_file_name = 'LVR'. '-'.rand(1000,1000000).'jpeg';

            // get file resize
            list($width, $height) = getimagesize($file_save);

            // calculate the new size
            $divisor_value = $width / $width_size;
            $new_width = $width / $divisor_value;
            $new_heigth = $height / $divisor_value;

            // make new file data
            if ($ext == 'jpeg' || $ext == 'jpg') {
                # code...
                $thumb = imagecreatetruecolor($new_width, $new_heigth);
                $source = imagecreatefromjpeg($file_save);

                // men-resize new file
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_heigth, $width, $height);

                // save file image
                imagejpeg($thumb, $resize_image);

                imagedestroy($thumb);
                imagedestroy($source);
            } else if ($ext == 'png') {
                $thumb = imagecreatetruecolor($new_width, $new_heigth);
                $source = imagecreatefrompng($file_save);

                // men-resize new file
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_heigth, $width, $height);

                // save file image
                imagepng($thumb, $resize_image);

                imagedestroy($thumb);
                imagedestroy($source);
            }

        }
    }