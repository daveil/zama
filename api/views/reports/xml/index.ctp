<?php

require_once(APP.DS.'vendors/excel-php/PHPExcel/Classes/PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

$row_ctr = 2;
foreach($paretoDaily as $row=>$cols){
	foreach($cols as $col=>$value){
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row+$row_ctr ,$value);
	}
}
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;Filename=$title_for_layout.xls");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;