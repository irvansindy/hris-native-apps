<?php
    if($_FILES['upload']['name']) {
        if(!$_FILES['file']['error']) {
            $name = md5(rand(100, 200));
            $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
            $fileName = $name.'.'.$ext;
            $pathDirectory = '../file_upload_from_editor/';
            $location = $_FILES['upload']['tmp_name'];
            move_uploaded_file($location, $pathDirectory);
        }
    }