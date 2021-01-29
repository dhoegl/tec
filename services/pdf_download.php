<?php
session_start();
require_once('../tec_dbconnect.php');
/* Download TEC Directory to PDF file; called from 'tec_family.php */
$output = "";

// Get Directory data
// function LoadDirData()
// {
//     $dir_extract = "SELECT Surname as LAST, Name_1 as HIM, Name_2 as HER, Address as ADDRESS, Address2 as ADDRESS2, City as CITY, State as STATE, Zip as ZIP, Phone_Home as HOME_PHONE, Phone_Cell1 as HIS_CELL, Phone_Cell2 as HER_CELL, Email_1 as HIS_EMAIL, Email_2 as HER_EMAIL FROM directory where status = 1 order by Surname";
//     $dir_extract_results = $mysql->query($dir_extract) or die("A database error has occurred while extracting the directory PDF file. Please notify your administrator with the following. Error : " . $mysql->errno . $mysql->error);
//     $dir_extract_count = $dir_extract_results->num_rows;
//     $row = $dir_extract_results->fetch_assoc();		
//     $lines = file($file);
//     $data = array();
//     while($row = $dir_extract_results->fetch_assoc())
//     {
//         $data[] = $row;
//     }
//     return $data;
// }
// Load Directory data into FPDF script
require_once('../fpdf/fpdf.php');

class PDF extends FPDF
{
// LoadData
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }
    

    // Simple table
function BasicTable($header, $data)
{
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

}
$pdf = new FPDF('P','mm','Letter');
$header = array('Surname', 'Him', 'Her', 'Address', 'Address2', 'City', 'State', 'Zip', 'Home_Phone', 'His_Cell', 'Her_Cell', 'His_Email', 'Her_Email');
// $data = $pdf->LoadDirData();
// $data = $pdf->LoadData('DirectoryPDFTest2.txt');
$data = $pdf->LoadData("Hoeglund;Dan;RuthAnn;12024 25th St SE;Lake Stevens;WA;98258;;206-601-1164;425-239-6567;firebird@hoeglund.com;coffeegirl60@gmail.com");
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->AddPage();
// $pdf->BasicTable($header,$data);
$file_pdf = "TestPDF.pdf";    
$pdf->Output("I", $file_pdf);


//if(isset($_POST['export_csv']))
//{
	// header('Content-Type: text/csv');
	// header('Content-Disposition:attachment;filename=TEC_Directory.csv');
	// header('Cache-Control: no-cache, no-store, must-revalidate');
	// header('Pragma: no-cache');
	// header('Expires: 0');
	// $csvoutput = fopen('php://output', 'w');
	
	// $dir_extract = "SELECT Surname as LAST, Name_1 as HIM, Name_2 as HER, Address as ADDRESS, Address2 as ADDRESS2, City as CITY, State as STATE, Zip as ZIP, Phone_Home as HOME_PHONE, Phone_Cell1 as HIS_CELL, Phone_Cell2 as HER_CELL, Email_1 as HIS_EMAIL, Email_2 as HER_EMAIL FROM directory where status = 1 order by Surname";

	// $dir_extract_results = $mysql->query($dir_extract) or die("A database error has occurred while extracting the church directory Excel file. Please notify your administrator with the following. Error : " . $mysql->errno . $mysql->error);
    //     $dir_extract_count = $dir_extract_results->num_rows;
        
	// if($dir_extract_count > 0)
	// {
	// 	$row = $dir_extract_results->fetch_assoc();		
	// 	$headers = array_keys($row);
	// 	fputcsv($csvoutput, $headers);
	// 	fputcsv($csvoutput, $row);
	// 	While($row = $dir_extract_results->fetch_assoc()) 
	// 	{
	// 		fputcsv($csvoutput, $row);
	// 	}
	// 	fclose($csvoutput);
	// 	exit;
	// }
//}


?>