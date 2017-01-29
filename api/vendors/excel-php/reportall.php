<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "dbaccountability";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");



		//date_default_timezone_set('Asia/Kolkata');
		require_once 'PHPExcel/Classes/PHPExcel.php';
		
		$filename = "All Accountability"; //your file name
		$objPHPExcel = new PHPExcel();
		/*********************Add column headings START**********************/
		/*$objPHPExcel->setActiveSheetIndex(0) 
					->setCellValue('A1', $empno)
					->setCellValue('A2', $name)
					->setCellValue('A3', $position)
					->setCellValue('A4', $department)
					->setCellValue('A5', $datehired)
					->setCellValue('A7', 'Category')
					->setCellValue('B7', 'Item');
					
		*/
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Accountability');		
		$objPHPExcel->getActiveSheet()->setCellValue('A2', '(All)');
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', 'Employee No');
		$objPHPExcel->getActiveSheet()->setCellValue('C4', 'Lastname');
		$objPHPExcel->getActiveSheet()->setCellValue('D4', 'Firstname');
		$objPHPExcel->getActiveSheet()->setCellValue('E4', 'Middlename');
		$objPHPExcel->getActiveSheet()->setCellValue('F4', 'Position');
		$objPHPExcel->getActiveSheet()->setCellValue('G4', 'Date Hired');
		$objPHPExcel->getActiveSheet()->setCellValue('H4', 'Category');
		$objPHPExcel->getActiveSheet()->setCellValue('I4', 'Item');
		
		
		/*********************Add column headings END**********************/
		
		// You can add this block in loop to put all ur entries.Remember to change cell index i.e "A2,A3,A4" dynamically 
		/*********************Add data entries START**********************/
$n=5;
$no=1;

mysql_query("SET NAMES utf8");  
mysql_query("SET CHARACTER_SET utf8"); 
//$qry=executeQuery("select * from tblgaaccountability");
$sql="SELECT a.id, a.emp_no, e.lastname, e.firstname, e.middlename, e.position, e.date_hired, a.category, a.item FROM tblgaaccountability a INNER JOIN tblemployees e ON a.emp_no = e.emp_no Order By e.lastname";
$qry=mysql_query($sql);		
		
		while($d= mysql_fetch_array($qry)){
 $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $no);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['emp_no']);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['lastname']);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['firstname']);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$n, $d['middlename']);
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$n, $d['position']);
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$n, $d['date_hired']);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$n, $d['category']);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$n, $d['item']);
 //$objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['email']);
 //$objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['contact_no']); 
  $n++;
  $no++;
}   
		/*********************Add data entries END**********************/
		
		/*********************Autoresize column width depending upon contents START**********************/
        foreach(range('A','I') as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}
		/*********************Autoresize column width depending upon contents END***********************/
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true); //Make heading font bold
		
		/*********************Add color to heading START**********************/
		$objPHPExcel->getActiveSheet()
					->getStyle('A1')
					->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()
					->setARGB('99ff99');
		
		$objPHPExcel->getActiveSheet()
					->getStyle('A4:I4')
					->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()
					->setARGB('99ff99');

		/*********************Add color to heading END***********************/
		
	
		/*********************Add Alignment 'Center' to heading START**********************/
		$objPHPExcel->getActiveSheet()
			->getStyle('A1')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('A2')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('A4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$objPHPExcel->getActiveSheet()
			->getStyle('B4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('C4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('D4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('E4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('F4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('G4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('H4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		$objPHPExcel->getActiveSheet()
			->getStyle('I4')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
		/*********************Add Alignment 'Center' to heading END***********************/
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:I1');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:I2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:I3');
		// Merge cell
		/*
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:B2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:B3');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:B4');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A5:B5');
		*/
		// End of Merge cell
		//$value = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 2)->getValue();
		
		$objPHPExcel->getActiveSheet()->setTitle('userReport'); //give title to sheet
		$objPHPExcel->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition: attachment;Filename=$filename.xls");
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		

?>