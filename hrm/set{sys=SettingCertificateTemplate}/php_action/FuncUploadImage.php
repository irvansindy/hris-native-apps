<?php
    // define upload file
    $upload_directory = [
        'image' => 'uploads/'
    ];

    // allowed image properties
    $setup_image = [
        'maxSize' => 3000,
        'maxWidth' => 1024,
        'maxHeigth' => 800,
        'minWidth' => 10,
        'minHeigth' => 10,
        'type' => [
            'jpg', 'jpeg', 'png'
        ]
    ];

    // validate if file is exists
    define('RENAME_F', 1);

    /** 
     * Set filename 
     * If the file exists, and RENAME_F is 1, set "img_name_1" 
     * 
     * $p = dir-path, $fn=filename to check, $ex=extension $i=index to rename 
     */ 

    function setName($p, $fn, $ex, $i) {
        if(RENAME_F == 1 && file_exists($p .$fn .$ex)) {
            return setName($p, F_NAME . '-' . ($i + 1), $ex, ($i + 1));
        }
        return $fn .$ex;
    }

    $re = '';
    if (isset($_FILES['upload']) && strlen($_FILES['upload']['name']) > 1) {
        define('F_NAME', preg_replace('/\.(.+?)$/i', '', basename($_FILES['upload']['name'])));

        // get filename without extension
        $sepExt = explode('.', strtolower($_FILES['upload']['name']));
        $type = end($sepExt);

        // upload file directory
        $upload_directory = in_array($type, $setup_image['type']) ? $upload_directory['image'] : $upload_directory['audio'];
        $upload_directory = trim($upload_directory, '/') . '/';

        // validation file type
        if(in_array($type, $setup_image['type'])) {
            // image width and height
            list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);

            if (isset($width) && isset($height)) {
                if ($width > $setup_image['maxWidth'] || $height > $setup_image['maxHeigth']) {
                    $re .= '\\n Width x Height = ' . $width . ' x ' . $height .' \\n The maximum Width x Height must be: '. $setup_image['maxWidth'] . ' x ' . $setup_image['maxHeigth'];
                }
                
                if ($width < $setup_image['minWidth'] || $height < $setup_image['minHeigth']) {
                    $re .= '\\n Width x Height = ' . $width . ' x ' . $height .' \\n The minimum Width x Height must be: '. $setup_image['minWidth'] . ' x ' . $setup_image['minHeigth'];
                }

                if($_FILES['upload']['size'] > $setup_image['maxSize']*1000) {
                    $re .= '\\n Maximum file size must be: '. $setup_image['maxSize']. ' KB.'; 
                }
            } else {
                $re .= 'The file: '. $_FILES['upload']['name']. ' has not the allowed extension type.';
            }
        }

        // file upload path
        $f_name = setName($_SERVER['DOCUMENT_ROOT'] .'/'. $upload_directory, F_NAME, ".$type", 0); 
        // $f_name = setName($_SERVER['SERVER_ROOT'] .'/'. $upload_directory, F_NAME, ".$type", 0); 
        $uploadpath = $upload_directory . $f_name;

        // if no errors, upload the image, else, output the errors
        if($re='') {
            if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) {
                $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
                $url = 'ckeditor/'. $upload_dir . $f_name; 
                $msg = F_NAME .'.'. $type .' successfully uploaded: \\n- Size: '. number_format($_FILES['upload']['size']/1024, 2, '.', '') .' KB'; 
                $re = in_array($type, $setup_image['type']) ? "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>":'<script>var cke_ob = window.parent.CKEDITOR; for(var ckid in cke_ob.instances) { if(cke_ob.instances[ckid].focusManager.hasFocus) break;} cke_ob.instances[ckid].insertHtml(\' \', \'unfiltered_html\'); alert("'. $msg .'"); var dialog = cke_ob.dialog.getCurrent();dialog.hide();</script>'; 
            } else {
                $re = '<script>alert("Unable to upload the file")</script>';
            }
        } else {
            $re = '<script>alert(error)</script>';
        }
    }

    // output
    @header('Content-type: text/html; charset=utf-8');
    echo $re;