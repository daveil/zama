<?php

require_once(APP.DS.'vendors/excel-php/PHPExcel/Classes/PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setCellValue('A1',"$CATEGORY Plan");
$objPHPExcel->getActiveSheet()->setCellValue('A2',"For the month of $MONTH");

switch($type){
	case 'pareto':
		$row_ctr = 4;
		
		foreach($paretoDailies as $paretoDaily){
			$line_ctr=0;
			foreach($paretoDaily as $row=>$cols){
				foreach($cols as $col=>$value){
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row+$row_ctr ,$value);
				}
				$line_ctr++;
			}
			$row_ctr+=$line_ctr+2;
		}
	break;
	case 'plan':
		
		$row_ctr = 4;
		foreach($monthly as $row=>$cols){
			foreach($cols as $col=>$value){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row+$row_ctr ,$value);
			}
		}
		$row_ctr+=count($monthly);
		$last_col = count($monthly[0])-1;
		$last_row = $row_ctr;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($last_col-1,$last_row,'TOTAL PRODUCTION PLAN');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($last_col,$last_row,$monthlyTotal);

		$row_ctr+=2;
		
		foreach($daily as $row=>$cols){
			foreach($cols as $col=>$value){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row+$row_ctr,$value);
			}
		}
		$row_ctr+=count($daily);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$row_ctr,'TOTAL DAILY PLAN');
		foreach($dailyTotal as $col=>$total){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+2,$row_ctr,$total);
		}
	break;
}
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;Filename=$title_for_layout.xls");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;