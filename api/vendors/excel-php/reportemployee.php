<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "dbaccountability";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");

if(isset($_POST['export']))
  {
  $empno=mysql_real_escape_string($_POST['employeeno']);
  
  }
mysql_query("SET NAMES utf8");  
mysql_query("SET CHARACTER_SET utf8"); 
$sqlname="SELECT * FROM tblemployees WHERE emp_no = '$empno'";
		$resultname=mysql_query($sqlname);
		$rowsname=mysql_fetch_array($resultname);
		$lastname=$rowsname['lastname'];
		$firstname=$rowsname['firstname'];
		$middlename=$rowsname['middlename'];
		$position=$rowsname['position'];
		$department=$rowsname['department'];
		$datehired=$rowsname['date_hired'];
		
$sqlname2="SELECT * FROM tblclearance WHERE emp_no = '$empno'";
		$resultname2=mysql_query($sqlname2);
		$rowsname2=mysql_fetch_array($resultname2);
		$clearancedate=$rowsname2['date_clearance'];
		$cleared=$rowsname2['cleared'];		
		
		if ($cleared == 0){
			$clearancedate = "N/A";
			$cleared = "No";	
		}
		else
			$cleared = "Yes";

		//date_default_timezone_set('Asia/Kolkata');
		require_once 'PHPExcel/Classes/PHPExcel.php';
		
		$filename = "$lastname $firstname $middlename"; //your file name
		$objPHPExcel = new PHPExcel();
		/*********************Add column headings START**********************/

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Accountability Per Employee');		
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Employee No: ');
		$objPHPExcel->getActiveSheet()->setCellValue('B2', $empno);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Name:');
		$objPHPExcel->getActiveSheet()->setCellValue('B3', $lastname.', '.$firstname.' '.$middlename);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Position:');
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $position);
		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Department:');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', $department);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Date Hired:');
		$objPHPExcel->getActiveSheet()->setCellValue('B6', $datehired);
		$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Cleared:');
		$objPHPExcel->getActiveSheet()->setCellValue('B7', $cleared);
		$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Clearance Date:');
		$objPHPExcel->getActiveSheet()->setCellValue('B8', $clearancedate);
		$objPHPExcel->getActiveSheet()->setCellValue('A10', 'Category');
		$objPHPExcel->getActiveSheet()->setCellValue('B10', 'Item');
		
		
		/*********************Add column headings END**********************/
		
		// You can add this block in loop to put all ur entries.Remember to change cell index i.e "A2,A3,A4" dynamically 
		/*********************Add data entries START**********************/
$n=11;

//$qry=executeQuery("select * from tblgaaccountability");
$sql="select * from tblgaaccountability where emp_no = '$empno' ORDER BY category";
$qry=mysql_query($sql);		
		
		while($d= mysql_fetch_array($qry)){
 $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['category']);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['item']);
 //$objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['email']);
 //$objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['contact_no']); 
  $n++;
}   
		/*********************Add data entries END**********************/
		
		/*********************Autoresize column width depending upon contents START**********************/
        foreach(range('A','B') as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}
		/*********************Autoresize column width depending upon contents END***********************/
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:A8')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A10:B10')->getFont()->setBold(true); //Make heading font bold
		
		/*********************Add color to heading START**********************/
		$objPHPExcel->getActiveSheet()
					->getStyle('A1')
					->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
					->getStartColor()
					->setARGB('99ff99');
		
		$objPHPExcel->getActiveSheet()
					->getStyle('A10:B10')
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
			->getStyle('A10')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$objPHPExcel->getActiveSheet()
			->getStyle('B10')
			->getAlignment()
			->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
		/*********************Add Alignment 'Center' to heading END***********************/
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:B1');
		
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