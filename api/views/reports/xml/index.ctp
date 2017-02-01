<?php

require_once(APP.DS.'vendors/excel-php/PHPExcel/Classes/PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$sheet =$objPHPExcel->getActiveSheet();
$objPHPExcel->getActiveSheet()->setCellValue('A1',"$CATEGORY Plan ");
$objPHPExcel->getActiveSheet()->setCellValue('A2',"For the month of $MONTH");

switch($type){
	case 'pareto':
		$offset =array('X'=>15);
		$row_ctr = 4;
		$percent_start = null;
		$percent_end = null;
		
		
		$_COL_OFFSET = 14;
		$_ROW_CTR = 4;
		$charts = array();
		foreach($report as $chartId=>$R){
			
			//Headers
			$graph_title = "";
			$_HEADER_ROW = $_ROW_CTR;
			foreach($R['pareto']['header'] as $col=>$hdr){
				if($col==0) $graph_title = $hdr;
				$sheet->setCellValueByColumnAndRow($col+$_COL_OFFSET,$_ROW_CTR,$hdr);
			}
			$_ROW_CTR++;
			
			//Entry
			foreach($R['pareto']['entry'] as $row=>$entry){
				foreach($entry as $col=>$cell){
					$sheet->setCellValueByColumnAndRow($col+$_COL_OFFSET,$row+$_ROW_CTR,$cell);
				}
			}
			$_ROW_CTR+=count($R['pareto']['entry']);
			
			//Percentage
			$_PERCENT_RANGE = array('row'=>$_ROW_CTR,'col'=>$_COL_OFFSET+count($R['pareto']['header']));
			foreach($R['pareto']['percentage'] as $row=>$percent){
				foreach($percent as $col=>$cell){
					if($col>0)
						$cell = (float)($cell)/100; 
					$sheet->setCellValueByColumnAndRow($col+$_COL_OFFSET,$row+$_ROW_CTR,$cell);
				}
			}
			$_HEADER_COUNT = count($R['pareto']['header']);
			$_PERCENT_COUNT  = count($R['pareto']['percentage']);
			
			$_FIRST_COL = PHPExcel_Cell::stringFromColumnIndex($_COL_OFFSET+1);
			$_LAST_COL = PHPExcel_Cell::stringFromColumnIndex($_COL_OFFSET-1+$_HEADER_COUNT);
			$_PERCENT_RANGE  = $_FIRST_COL;
			$_PERCENT_RANGE .=  $_ROW_CTR.':';
			$_PERCENT_RANGE .=  $_LAST_COL;
			$_PERCENT_RANGE .=  $_ROW_CTR+$_PERCENT_COUNT-1;
		 
			$sheet->getStyle($_PERCENT_RANGE)
			->getNumberFormat()
			->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE ); 
			
			$_LABEL_COL =  PHPExcel_Cell::stringFromColumnIndex($_COL_OFFSET);
			$_LABELS = array();
			//echo '<pre>';
			//echo 'Labels<br>';
		//	echo $_PERCENT_COUNT;
			if($_PERCENT_COUNT>1){
				for($i=1,$r =$_ROW_CTR+1;$i<$_PERCENT_COUNT;$i++,$r++){
					$source = 'Worksheet!$'.$_LABEL_COL .'$'.$r;
					//echo $source.'<br/>';
					array_push($_LABELS, new PHPExcel_Chart_DataSeriesValues('String', $source, null, 1));
				}
			}else{
				for($i=0,$r =$_ROW_CTR;$i<$_PERCENT_COUNT;$i++,$r++){
					$source = 'Worksheet!$'.$_LABEL_COL .'$'.$r;
					//echo $source.'--<br/>';
					array_push($_LABELS, new PHPExcel_Chart_DataSeriesValues('String', $source, null, 1));
				}
			}
			//echo 'Categeries<br>';
			$source = 'Worksheet!$'.$_FIRST_COL.'$'.$_HEADER_ROW.':$'.$_LAST_COL.'$'.$_HEADER_ROW;
			//echo $source.'<br/>';
			$_CATEGORIES = array(
				new PHPExcel_Chart_DataSeriesValues('String', $source, null, $_HEADER_COUNT-2),   
			);
			$_VALUES = array();
			//echo 'Values<br>';
			$_LAST_ROW = $_ROW_CTR+1;
			if($_PERCENT_COUNT>1){
				for($i=1,$r =$_ROW_CTR+1 ;$i<$_PERCENT_COUNT;$i++,$r++){
					$source = 'Worksheet!$'.$_FIRST_COL.'$'.$r.':$'.$_LAST_COL.'$'.$r;
					//echo $source.'<br/>';
					array_push($_VALUES,   new PHPExcel_Chart_DataSeriesValues('Number', $source, PHPExcel_Style_NumberFormat::FORMAT_NUMBER, 4));
					$_LAST_ROW = $r;
				}
			}else{
				for($i=0,$r =$_ROW_CTR ;$i<$_PERCENT_COUNT;$i++,$r++){
					$source = 'Worksheet!$'.$_FIRST_COL.'$'.$r.':$'.$_LAST_COL.'$'.$r;
					//echo $source.'<br/>';
					array_push($_VALUES,   new PHPExcel_Chart_DataSeriesValues('Number', $source, PHPExcel_Style_NumberFormat::FORMAT_NUMBER, 4));
					$_LAST_ROW = $r;
				}
			}
			$labels =  $_LABELS;
			$categories =  $_CATEGORIES;
			$values =  $_VALUES;
			$order = range(0, count($values)-1);
			
			$series = new PHPExcel_Chart_DataSeries(
			  PHPExcel_Chart_DataSeries::TYPE_BARCHART,     // plotType
			  PHPExcel_Chart_DataSeries::GROUPING_STACKED,  // plotGrouping
			  $order,                                     // plotOrder
			  $labels,                                        // plotLabel
			  $categories,                                    // plotCategory
			  $values                                         // plotValues
			);  
			
			$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
			$layout = new PHPExcel_Chart_Layout(); 
			$plotarea = new PHPExcel_Chart_PlotArea($layout, array($series));
			$title    = new PHPExcel_Chart_Title($graph_title);  
			$legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
			$xTitle   = null;
			$yTitle   = null;
			$chart    = new PHPExcel_Chart(
					  'chart'.$chartId,                                // name
					  $title,                                         // title
					  $legend,                                        // legend 
					  $plotarea,                                      // plotArea
					  true,                                           // plotVisibleOnly
					  0,                                              // displayBlanksAs
					  $xTitle,                                        // xAxisLabel
					  $yTitle                                         // yAxisLabel
					);     
					
			if($_PERCENT_COUNT==1) $_LAST_ROW+=5;
			$chart->setTopLeftPosition('A'.$_HEADER_ROW);
			$chart->setBottomRightPosition('N'.$_LAST_ROW);
			
			//echo $_HEADER_ROW;
			//echo $_LAST_ROW;
			//exit;
			array_push($charts,$chart);
			
			$_ROW_CTR+=$_PERCENT_COUNT;
			
			$_ROW_CTR+=2;
			if($_PERCENT_COUNT==1) $_ROW_CTR+=5;
			//echo $_ROW_CTR;
		}
		$sheet = $objPHPExcel->getActiveSheet();
		foreach($charts as $chart)
			$sheet->addChart($chart);
			
		
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
header("Content-Disposition: attachment;Filename=$title_for_layout.xlsx");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(true);
$objWriter->save('php://output');
exit;