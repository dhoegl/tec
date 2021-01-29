<?php
session_start();
require_once('../tec_dbconnect.php');
/* Download OFC Directory to CSV file; called from 'tec_family.php */
$output = "";

//if(isset($_POST['export_csv']))
//{
	header('Content-Type: text/csv');
	header('Content-Disposition:attachment;filename=TEC_Directory.csv');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');
	$csvoutput = fopen('php://output', 'w');
	
	$dir_extract = "SELECT Surname as LAST, Name_1 as HIM, Name_2 as HER, Address as ADDRESS, Address2 as ADDRESS2, City as CITY, State as STATE, Zip as ZIP, Phone_Home as HOME_PHONE, Phone_Cell1 as HIS_CELL, Phone_Cell2 as HER_CELL, Email_1 as HIS_EMAIL, Email_2 as HER_EMAIL FROM directory where status = 1 order by Surname";

	$dir_extract_results = $mysql->query($dir_extract) or die("A database error has occurred while extracting the church directory Excel file. Please notify your administrator with the following. Error : " . $mysql->errno . $mysql->error);
        $dir_extract_count = $dir_extract_results->num_rows;
        
	if($dir_extract_count > 0)
	{
		$row = $dir_extract_results->fetch_assoc();		
		$headers = array_keys($row);
		fputcsv($csvoutput, $headers);
		fputcsv($csvoutput, $row);
		While($row = $dir_extract_results->fetch_assoc()) 
		{
			fputcsv($csvoutput, $row);
		}
		fclose($csvoutput);
		exit;
	}
//}


?>