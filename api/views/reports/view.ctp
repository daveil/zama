<?php

require_once(APP.DS.'vendors/excel-php/PHPExcel/Classes/PHPExcel.php');
$filename = "Test ".rand();
$workbook = new PHPExcel();
    $sheet = $workbook->getActiveSheet();
    $sheet->fromArray(  
            array(
                array('Courses','A','B','C','D'),
                array('PHP','130','170','90','30'),  
                array('JAVA','100','50','110','80'),  
                array('ASP.NET','110','200','40','140'),  
                array('C#','60','80','60','40'),
                array('Python','120','130','150','100'),
                array('Perl','160','180','160','140'),
                )  
        );
    $labels = array(
      new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$B$1', null, 1),
      new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$C$1', null, 1), 
      new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$D$1', null, 1), 
      new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$E$1', null, 1), 
    );
    $categories = array(
      new PHPExcel_Chart_DataSeriesValues('String', 'Worksheet!$A$2:$A$7', null, 6),   
    );
    $values = array(
      new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$B$2:$B$7', null, 4),
      new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$C$2:$C$7', null, 4),  
      new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$D$2:$D$7', null, 4),  
      new PHPExcel_Chart_DataSeriesValues('Number', 'Worksheet!$E$2:$E$7', null, 4),  
    );
    $series = new PHPExcel_Chart_DataSeries(
      PHPExcel_Chart_DataSeries::TYPE_BARCHART,     // plotType
      PHPExcel_Chart_DataSeries::GROUPING_STACKED,  // plotGrouping
      array(0,1,2,3),                                     // plotOrder
      $labels,                                        // plotLabel
      $categories,                                    // plotCategory
      $values                                         // plotValues
    );  

    $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
    $layout1 = new PHPExcel_Chart_Layout();    // Create object of chart layout to set data label 
/*    $layout1->setShowVal(TRUE);                   
    $layout1->setManual3dAlign(true);
    $layout1->setXRotation(20);
    $layout1->setYRotation(20);
    $layout1->setPerspective(15);                                              
    $layout1->setRightAngleAxes(TRUE);  
    */
    $plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
    $title    = new PHPExcel_Chart_Title('3-D Chart');  
    $legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
    $xTitle   = new PHPExcel_Chart_Title('3-D Chart');
    $yTitle   = new PHPExcel_Chart_Title('Languages');
    $chart    = new PHPExcel_Chart(
      'chart1',                                       // name
      $title,                                         // title
      $legend,                                        // legend 
      $plotarea,                                      // plotArea
      true,                                           // plotVisibleOnly
      0,                                              // displayBlanksAs
      $xTitle,                                        // xAxisLabel
      $yTitle                                         // yAxisLabel
    );                      
    $chart->setTopLeftPosition('B12');
    $chart->setBottomRightPosition('K32');
    $sheet->addChart($chart);
	 $writer = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
    $writer->setIncludeCharts(TRUE);
	header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;Filename=$filename.xlsx");
header('Cache-Control: max-age=0');
  $writer->save('php://output');
exit;
//Initialize worksheet
$ea = new PHPExcel();
$ews = $ea->getSheet(0);
$ews->setTitle('Data');

//Add Header
$ews->setCellValue('A1', 'ID');
$ews->setCellValue('B1', 'Value');
$data = array();


//Add Data
for($i=1;$i<=15;$i++){
	$data[$i] = $i*15;
}
$index=2;
foreach($data as $id=>$value){
	$ews->setCellValue('A'.$index, $id);
	$ews->setCellValue('B'.$index, $value);
	$index++;
	
}

//Stylize header
$header = 'A1:B1';
$ews->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
$style = array(
    'font' => array('bold' => true,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
    );
$ews->getStyle($header)->applyFromArray($style);

for ($col = ord('a'); $col <= ord('b'); $col++)
{
    $ews->getColumnDimension(chr($col))->setAutoSize(true);
}

//Prepare graph data
$dsl=array(
                new \PHPExcel_Chart_DataSeriesValues('String', 'Data!$B$1', NULL, 1),
                
            );
$xal=array(
                new \PHPExcel_Chart_DataSeriesValues('String', 'Data!$A$2:$A$15', NULL, 15),
            );
$dsv=array(
                new \PHPExcel_Chart_DataSeriesValues('Number', 'Data!$B$2:$B$15', NULL, 15),
            );
$ds=new \PHPExcel_Chart_DataSeries(
                    \PHPExcel_Chart_DataSeries::TYPE_LINECHART,
                    \PHPExcel_Chart_DataSeries::GROUPING_STANDARD,
                    range(0, count($dsv)-1),
                    $dsl,
                    $xal,
                    $dsv
                    );
$layout=new \PHPExcel_Chart_Layout();
$layout->setWidth(500);
$layout->setWidth(500);

pr($layout);
$pa=new \PHPExcel_Chart_PlotArea($layout, array($ds));
$legend=new \PHPExcel_Chart_Legend(\PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
$title=new \PHPExcel_Chart_Title('Any literal string');
$chart= new \PHPExcel_Chart(
                    'chart1',
                    $title,
                    $legend,
                    $pa,
                    true,
                    0,
                    NULL, 
                    NULL
                    );

$chart->setTopLeftPosition('K1');
$chart->setBottomRightPosition('M5');

$ews->addChart($chart);

exit;
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;Filename=$filename.xlsx");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($ea, 'Excel2007');
$objWriter->setIncludeCharts(true);
$objWriter->save('php://output');
exit;