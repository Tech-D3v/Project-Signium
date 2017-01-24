<?php
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
  die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'dependencies/PHPExcel.php';
require_once 'database.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("WCSIS")
               ->setLastModifiedBy("WCSIS")
               ->setTitle("Template Worksheet for Compatability")
               ->setSubject("Template Worksheet for Compatability")
               ->setDescription("An empty workbook with the correct formatting.")
               ->setKeywords("wcsis export template workbook")
               ->setCategory("Template Export");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Firstname')
            ->setCellValue('B1', 'Surname')
            ->setCellValue('C1', 'Nickname')
            ->setCellValue('D1', 'Yeargroup')
            ->setCellValue('E1', 'Usercode');


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Names');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="template.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
header("location:../mainpage.php");
?>
