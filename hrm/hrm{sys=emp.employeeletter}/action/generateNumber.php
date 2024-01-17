<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $pattern_group = $_GET['pattern_group'];
    // $pattern_group = 'SK';
    // $pattern_group = 'DISCIPLINE_HISTORY';
    // $pattern_group = 'BRANCHMOVEMENTLETTER';
    // $pattern_group = 'MOVEMENTLETTER';
    // $pattern_group = 'SURAT';
    // $pattern_group = 'FormPenyerahanKaryawan';

    // generate month romawi
    $month = date("m");
    $month_romawi = '';
    switch ($month) {
        case '01':
            $month_romawi = 'I';
            break;
        case '02':
            $month_romawi = 'II';
            break;
        case '03':
            $month_romawi = 'III';
            break;
        case '04':
            $month_romawi = 'IV';
            break;
        case '05':
            $month_romawi = 'V';
            break;
        case '06':
            $month_romawi = 'VI';
            break;
        case '07':
            $month_romawi = 'VII';
            break;
        case '08':
            $month_romawi = 'VIII';
            break;
        case '09':
            $month_romawi = 'IX';
            break;
        case '10':
            $month_romawi = 'X';
            break;
        case '11':
            $month_romawi = 'XI';
            break;
        case '12':
            $month_romawi = 'XII';
            break;
        default:
            $month_romawi = '';
            break;
    }

    $year = date('Y');

    if ($pattern_group == 'SK') {
        // get data format pattern number for SK
        $query_get_format_number = "SELECT code_type, code_pattern, seq_number, reset_flag FROM tclmdocnumber WHERE code_type = '$pattern_group'";
    
        $result_format_number = mysqli_fetch_assoc(mysqli_query($connect, $query_get_format_number));
    
        $pattern_number = $result_format_number["code_pattern"];
    
        $pattern_number = str_replace(['[', ']'], '', $pattern_number);
    
        $substring = substr($pattern_number, 4, 18);
        
        $numbering_length = strlen($result_format_number['seq_number']);

        // generate first number
        $first_number = '';
        $current_first_number_decree = $result_format_number['seq_number'] + 1;
        if ($numbering_length == 1) {
            $first_number = '000'.$current_first_number_decree;
        } else if ($numbering_length == 2) {
            $first_number = '00'.$current_first_number_decree;
        } else if ($numbering_length == 3) {
            $first_number = '0'.$current_first_number_decree;
        } else if ($numbering_length == 4) {
            $first_number = $current_first_number_decree;
        }

        $result_decree_number = $first_number.$substring.$month_romawi.'/'.$year;
    
    } elseif ($pattern_group == 'DISCIPLINE_HISTORY') {
        $query_get_format_number = "SELECT code_type, code_pattern, seq_number, reset_flag FROM tclmdocnumber WHERE code_type = '$pattern_group'";
        $result_format_number = mysqli_fetch_assoc(mysqli_query($connect, $query_get_format_number));
    
        $pattern_number = $result_format_number["code_pattern"];
    
        $pattern_number = str_replace(['[', ']'], '', $pattern_number);
    
        $substring = substr($pattern_number, 0,3);
        
        $numbering_length = strlen($result_format_number['seq_number']);

        // generate first number
        $first_number = '';
        $current_first_number_decree = $result_format_number['seq_number'] + 1;
        if ($numbering_length == 1) {
            $first_number = '0000'.$current_first_number_decree;
        } else if ($numbering_length == 2) {
            $first_number = '000'.$current_first_number_decree;
        } else if ($numbering_length == 3) {
            $first_number = '00'.$current_first_number_decree;
        } else if ($numbering_length == 4) {
            $first_number = '0'.$current_first_number_decree;
        } else if ($numbering_length == 5) {
            $first_number = $current_first_number_decree;
        }
        
        $result_decree_number = $substring.'/'.$year.'/'.$month_romawi.'/'.$first_number;

    } elseif ($pattern_group == 'BRANCHMOVEMENTLETTER') {
        $query_get_format_number = "SELECT code_type, code_pattern, seq_number, reset_flag FROM tclmdocnumber WHERE code_type = '$pattern_group'";
        $result_format_number = mysqli_fetch_assoc(mysqli_query($connect, $query_get_format_number));
    
        $pattern_number = $result_format_number["code_pattern"];
    
        $pattern_number = str_replace(['[', ']'], '', $pattern_number);
    
        $substring = substr($pattern_number, 0,3);
        
        $numbering_length = strlen($result_format_number['seq_number']);

        // generate first number
        $first_number = '';
        $current_first_number_decree = $result_format_number['seq_number'] + 1;
        if ($numbering_length == 1) {
            $first_number = '000000'.$current_first_number_decree;
        } else if ($numbering_length == 2) {
            $first_number = '00000'.$current_first_number_decree;
        } else if ($numbering_length == 3) {
            $first_number = '0000'.$current_first_number_decree;
        } else if ($numbering_length == 4) {
            $first_number = '000'.$current_first_number_decree;
        } else if ($numbering_length == 5) {
            $first_number = '00'.$current_first_number_decree;
        } else if ($numbering_length == 6) {
            $first_number = '0'.$current_first_number_decree;
        } else if ($numbering_length == 7) {
            $first_number = $current_first_number_decree;
        }

        $result_decree_number = $substring.'/'.$year.'/'.$month_romawi.'/'.$first_number;
    } elseif ($pattern_group == 'MOVEMENTLETTER') {
        $query_get_format_number = "SELECT code_type, code_pattern, seq_number, reset_flag FROM tclmdocnumber WHERE code_type = '$pattern_group'";
        $result_format_number = mysqli_fetch_assoc(mysqli_query($connect, $query_get_format_number));
    
        $pattern_number = $result_format_number["code_pattern"];
    
        $pattern_number = str_replace(['[', ']'], '', $pattern_number);
    
        $substring = substr($pattern_number, 0,2);
        
        $numbering_length = strlen($result_format_number['seq_number']);

        // generate first number
        $first_number = '';
        $current_first_number_decree = $result_format_number['seq_number'] + 1;
        if ($numbering_length == 1) {
            $first_number = '000000'.$current_first_number_decree;
        } else if ($numbering_length == 2) {
            $first_number = '00000'.$current_first_number_decree;
        } else if ($numbering_length == 3) {
            $first_number = '0000'.$current_first_number_decree;
        } else if ($numbering_length == 4) {
            $first_number = '000'.$current_first_number_decree;
        } else if ($numbering_length == 5) {
            $first_number = '00'.$current_first_number_decree;
        } else if ($numbering_length == 6) {
            $first_number = '0'.$current_first_number_decree;
        } else if ($numbering_length == 7) {
            $first_number = $current_first_number_decree;
        }

        $result_decree_number = $substring.'/'.$year.'/'.$month_romawi.'/'.$first_number;
    } elseif ($pattern_group == 'SURAT') {
        $query_get_format_number = "SELECT code_type, code_pattern, seq_number, reset_flag FROM tclmdocnumber WHERE code_type = '$pattern_group'";
        $result_format_number = mysqli_fetch_assoc(mysqli_query($connect, $query_get_format_number));
    
        $pattern_number = $result_format_number["code_pattern"];
    
        $pattern_number = str_replace(['[', ']'], '', $pattern_number);
    
        $substring = substr($pattern_number, 5,6);
        
        $numbering_length = strlen($result_format_number['seq_number']);

        // generate first number
        $first_number = '';
        $current_first_number_decree = $result_format_number['seq_number'] + 1;
        if ($numbering_length == 1) {
            $first_number = '000'.$current_first_number_decree;
        } else if ($numbering_length == 2) {
            $first_number = '00'.$current_first_number_decree;
        } else if ($numbering_length == 3) {
            $first_number = '0'.$current_first_number_decree;
        } else if ($numbering_length == 4) {
            $first_number = $current_first_number_decree;
        }

        $result_decree_number = $first_number.'/'.$substring.'/'.$month_romawi.'/'.$year;
    } elseif ($pattern_group == 'FormPenyerahanKaryawan') {
        $query_get_format_number = "SELECT code_type, code_pattern, seq_number, reset_flag FROM tclmdocnumber WHERE code_type = '$pattern_group'";
        // $query_get_format_number = "SELECT code_type, code_pattern, seq_number, reset_flag FROM tclmdocnumber WHERE code_type = 'FormPenyerahanKaryawan'";
        $result_format_number = mysqli_fetch_assoc(mysqli_query($connect, $query_get_format_number));
    
        $pattern_number = $result_format_number["code_pattern"];
    
        $pattern_number = str_replace(['[', ']'], '', $pattern_number);
    
        $substring = substr($pattern_number, 5,6);
        
        $numbering_length = strlen($result_format_number['seq_number']);

        // generate first number
        $first_number = '';
        $current_first_number_decree = $result_format_number['seq_number'] + 1;
        if ($numbering_length == 1) {
            $first_number = '000'.$current_first_number_decree;
        } else if ($numbering_length == 2) {
            $first_number = '00'.$current_first_number_decree;
        } else if ($numbering_length == 3) {
            $first_number = '0'.$current_first_number_decree;
        } else if ($numbering_length == 4) {
            $first_number = $current_first_number_decree;
        }

        $result_decree_number = $first_number.'/'.$substring.$month_romawi.'/'.$year;
    }
    // var_dump($result_decree_number);

    $response_json = [
        $result_decree_number, //0 for decree number
        $current_first_number_decree, //1 for data increment counter decree number
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($response_json);