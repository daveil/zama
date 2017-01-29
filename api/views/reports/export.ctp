<?php

require_once(APP.DS.'vendors/excel-php/PHPExcel/Classes/PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setCellValue('A1','Assembly Plan');
$objPHPExcel->getActiveSheet()->setCellValue('A2',"For the month of $MONTH");
$row_ctr = 4;
foreach($monthly as $row=>$cols){
	foreach($cols as $col=>$value){
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row+$row_ctr ,$value);
	}
}

$row_ctr+=count($monthly)+1;


foreach($daily as $row=>$cols){
	foreach($cols as $col=>$value){
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row+$row_ctr,$value);
	}
}
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;Filename=$filename.xls");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;