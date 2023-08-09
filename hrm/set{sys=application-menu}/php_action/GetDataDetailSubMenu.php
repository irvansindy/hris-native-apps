<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    include "../../../application/session/sessionlv2.php";
    require_once '../../../application/config.php';

    // $menu_id = $_GET['menu_id'];
    $menu_id = $_POST['menu_id'];

    $query_detail_sub_menu = "SELECT * FROM hrmmenu WHERE submenu_id = '$menu_id';";

    $result_detail_sub_menu = mysqli_fetch_all(mysqli_query($connect, $query_detail_sub_menu), MYSQLI_ASSOC);

    $list_detail_sub_menu = [];

    $total_detail_sub_menu = count($result_detail_sub_menu);
    // var_dump($result_detail_sub_menu);
    for ($i=0; $i < $total_detail_sub_menu; $i++) { 
        $list_detail_sub_menu[] = [
            'menu_id' => $result_detail_sub_menu[$i]['menu_id'],
            'master_menu_id' => $result_detail_sub_menu[$i]['submenu_id'],
            'menu' => $result_detail_sub_menu[$i]['menu'],
            'module' => $result_detail_sub_menu[$i]['module'],
            // 'get_detail_sub_menu' => '<a type="button" nowrap="nowrap" id="get_list_detail_sub_menu" data-menuid = "' . $result_detail_sub_menu[$i]['menu_id'] . '" data-toggle="modal" data-target="#list_data_detail_sub_menu" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="List data detail sub menu" width="22px"/></a>',
            'edit_detail_sub_menu' => '<a type="button" nowrap="nowrap" id="edit_detail_sub_menu" data-menuid = "' . $result_detail_sub_menu[$i]['menu_id'] . '" data-toggle="modal" data-target="#form_edit_detail_sub_menu" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer"> <input type="image" src="../../asset/dist/img/icons/acticon-note.png" title="Edit data sub menu" width="22px"/></a>',
        ];
    }
    $response = [
        $list_detail_sub_menu
    ];

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($response);