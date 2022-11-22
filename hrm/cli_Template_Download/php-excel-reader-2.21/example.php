<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'excel_reader2.php';
$data = new Spreadsheet_Excel_Reader("example.xls");
?>

<?php
// Load file koneksi.php

// Load plugin PHPExcel nya


// Panggil class PHPExcel nya
$excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('')
					   ->setLastModifiedBy('');

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
	'font' => array('bold' => true), // Set font nya jadi bold
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

$fontStyle = [
    'font' => [
        'size' => 16
    ]
];

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		
	)
);

$excel->getActiveSheet()->getStyle('A1:E1')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('45b7c6');
$excel->getActiveSheet()->getStyle('A1:E1')
    ->getFont()->setSize(10)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);    

$excel->getActiveSheet()->getStyle('C1:E1')->getFill()
    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
    ->getStartColor()->setARGB('afafaf');
$excel->getActiveSheet()->getStyle('C1:E1')
    ->getFont()->setSize(10)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); 

	
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(false); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A1', "nip"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B1', "name"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('C1', "work payment"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('D1', "meal payment"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->setActiveSheetIndex(0)->setCellValue('E1', "adjustment"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
// $excel->setActiveSheetIndex(0)->setCellValue('F1', "off_prev"); // Set kolom E3 dengan tulisan "TELEPON"
// $excel->setActiveSheetIndex(0)->setCellValue('G1', "adj"); // Set kolom E3 dengan tulisan "TELEPON"
// $excel->setActiveSheetIndex(0)->setCellValue('H1', "adj_prev"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('I1', "permission"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('J1', "transport"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('K1', "salary"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('L1', "Work Location"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('M1', "Family"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('N1', "Email"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('O1', "Bank"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('P1', "Branch"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('Q1', "Account No"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('R1', "Name"); // Set kolom F3 dengan tulisan "ALAMAT"
// $excel->setActiveSheetIndex(0)->setCellValue('S1', "Salary"); // Set kolom F3 dengan tulisan "ALAMAT"




// Add comment // Add comment // Add comment // Add comment // Add comment // Add comment // Add comment // Add comment // Add comment 

$objCommentRichText = $excel->getActiveSheet()->getComment('A1')->getText()->createTextRun('Consolidation Booking :');
$objCommentRichText->getFont()->setBold(true)->setSize(10);
$excel->getActiveSheet()->getComment('A1')->getText()->createTextRun("\r\n");
$objCommentRichFields =  $excel->getActiveSheet()->getComment('A1')->getText()->createTextRun('Values example : M21-XXXX');
$objCommentRichFields->getFont()->setBold(false)->setSize(10);
$excel->getActiveSheet()->getComment('A1')->setWidth('200pt');
$excel->getActiveSheet()->getComment('A1')->setHeight('60pt');
$excel->getActiveSheet()->getComment('A1')->setMarginLeft('150pt');
$excel->getActiveSheet()->getComment('A1')->getFillColor()->setRGB('EEEEEE');


$objCommentRichText = $excel->getActiveSheet()->getComment('C1')->getText()->createTextRun('Consolidation Booking :');
$objCommentRichText->getFont()->setBold(true)->setSize(10);
$excel->getActiveSheet()->getComment('C1')->getText()->createTextRun("\r\n");
$objCommentRichFields =  $excel->getActiveSheet()->getComment('C1')->getText()->createTextRun('Fill without comma');
$objCommentRichFields->getFont()->setBold(false)->setSize(10);
$excel->getActiveSheet()->getComment('C1')->setWidth('400pt');
$excel->getActiveSheet()->getComment('C1')->setHeight('100pt');
$excel->getActiveSheet()->getComment('C1')->setMarginLeft('150pt');
$excel->getActiveSheet()->getComment('C1')->getFillColor()->setRGB('EEEEEE');


$objCommentRichText = $excel->getActiveSheet()->getComment('D1')->getText()->createTextRun('Consolidation Booking :');
$objCommentRichText->getFont()->setBold(true)->setSize(10);
$excel->getActiveSheet()->getComment('D1')->getText()->createTextRun("\r\n");
$objCommentRichFields =  $excel->getActiveSheet()->getComment('D1')->getText()->createTextRun('Fill without comma');
$objCommentRichFields->getFont()->setBold(false)->setSize(10);
$excel->getActiveSheet()->getComment('D1')->setWidth('400pt');
$excel->getActiveSheet()->getComment('D1')->setHeight('60pt');
$excel->getActiveSheet()->getComment('D1')->setMarginLeft('150pt');
$excel->getActiveSheet()->getComment('D1')->getFillColor()->setRGB('EEEEEE');


$objCommentRichText = $excel->getActiveSheet()->getComment('E1')->getText()->createTextRun('Consolidation Booking :');
$objCommentRichText->getFont()->setBold(true)->setSize(10);
$excel->getActiveSheet()->getComment('E1')->getText()->createTextRun("\r\n");
$objCommentRichFields =  $excel->getActiveSheet()->getComment('E1')->getText()->createTextRun('Fill without comma');
$objCommentRichFields->getFont()->setBold(false)->setSize(10);
$excel->getActiveSheet()->getComment('E1')->setWidth('400pt');
$excel->getActiveSheet()->getComment('E1')->setHeight('120pt');
$excel->getActiveSheet()->getComment('E1')->setMarginLeft('150pt');
$excel->getActiveSheet()->getComment('E1')->getFillColor()->setRGB('EEEEEE');


// $objCommentRichText = $excel->getActiveSheet()->getComment('G1')->getText()->createTextRun('Consolidation Booking :');
// $objCommentRichText->getFont()->setBold(true)->setSize(10);
// $excel->getActiveSheet()->getComment('G1')->getText()->createTextRun("\r\n");
// $objCommentRichFields =  $excel->getActiveSheet()->getComment('G1')->getText()->createTextRun('Fill without comma
// ');
// $objCommentRichFields->getFont()->setBold(false)->setSize(10);
// $excel->getActiveSheet()->getComment('G1')->setWidth('200pt');
// $excel->getActiveSheet()->getComment('G1')->setHeight('400pt');
// $excel->getActiveSheet()->getComment('G1')->setMarginLeft('150pt');
// $excel->getActiveSheet()->getComment('G1')->getFillColor()->setRGB('EEEEEE');


// $objCommentRichText = $excel->getActiveSheet()->getComment('H1')->getText()->createTextRun('Consolidation Booking :');
// $objCommentRichText->getFont()->setBold(true)->setSize(10);
// $excel->getActiveSheet()->getComment('H1')->getText()->createTextRun("\r\n");
// $objCommentRichFields =  $excel->getActiveSheet()->getComment('H1')->getText()->createTextRun('Fill without comma');
// $objCommentRichFields->getFont()->setBold(false)->setSize(10);
// $excel->getActiveSheet()->getComment('H1')->setWidth('200pt');
// $excel->getActiveSheet()->getComment('H1')->setHeight('100pt');
// $excel->getActiveSheet()->getComment('H1')->setMarginLeft('150pt');
// $excel->getActiveSheet()->getComment('H1')->getFillColor()->setRGB('EEEEEE');


// $objCommentRichText = $excel->getActiveSheet()->getComment('I1')->getText()->createTextRun('Consolidation Booking :');
// $objCommentRichText->getFont()->setBold(true)->setSize(10);
// $excel->getActiveSheet()->getComment('I1')->getText()->createTextRun("\r\n");
// $objCommentRichFields =  $excel->getActiveSheet()->getComment('I1')->getText()->createTextRun('Fill without comma');
// $objCommentRichFields->getFont()->setBold(false)->setSize(10);
// $excel->getActiveSheet()->getComment('I1')->setWidth('200pt');
// $excel->getActiveSheet()->getComment('I1')->setHeight('100pt');
// $excel->getActiveSheet()->getComment('I1')->setMarginLeft('150pt');
// $excel->getActiveSheet()->getComment('I1')->getFillColor()->setRGB('EEEEEE');


// $objCommentRichText = $excel->getActiveSheet()->getComment('J1')->getText()->createTextRun('Consolidation Booking :');
// $objCommentRichText->getFont()->setBold(true)->setSize(10);
// $excel->getActiveSheet()->getComment('J1')->getText()->createTextRun("\r\n");
// $objCommentRichFields =  $excel->getActiveSheet()->getComment('J1')->getText()->createTextRun('Fill without comma');
// $objCommentRichFields->getFont()->setBold(false)->setSize(10);
// $excel->getActiveSheet()->getComment('J1')->setWidth('200pt');
// $excel->getActiveSheet()->getComment('J1')->setHeight('100pt');
// $excel->getActiveSheet()->getComment('J1')->setMarginLeft('150pt');
// $excel->getActiveSheet()->getComment('J1')->getFillColor()->setRGB('EEEEEE');


// $objCommentRichText = $excel->getActiveSheet()->getComment('K1')->getText()->createTextRun('Consolidation Booking :');
// $objCommentRichText->getFont()->setBold(true)->setSize(10);
// $excel->getActiveSheet()->getComment('K1')->getText()->createTextRun("\r\n");
// $objCommentRichFields =  $excel->getActiveSheet()->getComment('K1')->getText()->createTextRun('Fill without comma');
// $objCommentRichFields->getFont()->setBold(false)->setSize(10);
// $excel->getActiveSheet()->getComment('K1')->setWidth('200pt');
// $excel->getActiveSheet()->getComment('K1')->setHeight('100pt');
// $excel->getActiveSheet()->getComment('K1')->setMarginLeft('150pt');
// $excel->getActiveSheet()->getComment('K1')->getFillColor()->setRGB('EEEEEE');


// $objCommentRichText = $excel->getActiveSheet()->getComment('L1')->getText()->createTextRun('Consolidation Booking :');
// $objCommentRichText->getFont()->setBold(true)->setSize(10);
// $excel->getActiveSheet()->getComment('L1')->getText()->createTextRun("\r\n");
// $objCommentRichFields =  $excel->getActiveSheet()->getComment('L1')->getText()->createTextRun('Values example :
// GT MANAGEMENT OFFICE
// KARAWANG
// PLANT A
// PLANT B
// PLANT C
// PLANT D
// PLANT E
// PLANT H
// PLANT I
// PLANT K
// PLANT M
// PLANT R
// POLITEKNIK
// WISMA HAYAM WURUK
// ');
// $objCommentRichFields->getFont()->setBold(false)->setSize(10);
// $excel->getActiveSheet()->getComment('L1')->setWidth('200pt');
// $excel->getActiveSheet()->getComment('L1')->setHeight('400pt');
// $excel->getActiveSheet()->getComment('L1')->setMarginLeft('150pt');
// $excel->getActiveSheet()->getComment('L1')->getFillColor()->setRGB('EEEEEE');



// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('P1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('R1')->applyFromArray($style_col);
// $excel->getActiveSheet()->getStyle('S1')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(15);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(15);

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
// $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('H')->setWidth(10); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('I')->setWidth(10); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('J')->setWidth(10); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('L')->setWidth(15); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('M')->setWidth(15); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('N')->setWidth(15); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('O')->setWidth(10); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('P')->setWidth(10); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(17); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('R')->setWidth(15); // Set width kolom F
// $excel->getActiveSheet()->getColumnDimension('S')->setWidth(15); // Set width kolom F

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Helper");
$excel->setActiveSheetIndex(0);

// Proses file excel
header("Content-type: application/vnd-ms-excel");


$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
