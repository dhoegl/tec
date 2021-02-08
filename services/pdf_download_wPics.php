<?php
session_start();
require_once('../tec_dbconnect.php');
require_once('../fpdf/fpdf.php');

$output = "";

// Not sure why header is here.
// header('Content-Disposition:attachment;filename=TEC_Directory.pdf');
	// header('Cache-Control: no-cache, no-store, must-revalidate');
	// header('Pragma: no-cache');
	// header('Expires: 0');
	// $csvoutput = fopen('php://output', 'w');

    // NEW
    // function LoadData($dataset)
    // {
    // $dir_extract = "SELECT Surname as LAST, Name_1 as HIM, Name_2 as HER, Address as ADDRESS, Address2 as ADDRESS2, City as CITY, State as STATE, Zip as ZIP, Phone_Home as HOME_PHONE, Phone_Cell1 as HIS_CELL, Phone_Cell2 as HER_CELL, Email_1 as HIS_EMAIL, Email_2 as HER_EMAIL FROM " . $_SESSION['dirtablename'] . " where Surname = 'Hoeglund'";
    $dir_extract = "SELECT Surname as LAST, Name_1 as HIM, Name_2 as HER, Address as ADDRESS, Address2 as ADDRESS2, City as CITY, State as STATE, Zip as ZIP, Phone_Home as HOME_PHONE, Phone_Cell1 as HIS_CELL, Phone_Cell2 as HER_CELL, Email_1 as HIS_EMAIL, Email_2 as HER_EMAIL, ProfilePhoto_New as PIC FROM " . $_SESSION['dirtablename'] . " where Status = '1' order by Surname";
    $dir_extract_results = $mysql->query($dir_extract) or die("A database error has occurred while extracting the directory PDF file. Please notify your administrator with the following. Error : " . $mysql->errno . $mysql->error);
    $dir_extract_count = $dir_extract_results->num_rows;
    if($dir_extract_count > 0)
    {
        // echo "<script language='javascript'>";
        // echo "console.log('Inside PDF_Download2. dir_extract_count = " . $dir_extract_count . "');";
        // echo "</script>";    
        // $row = $dir_extract_results->fetch_assoc();		
        $headers = array_keys($row);
        $pdfoutput = array();
        $pdfoutput2 = array();
        $dataset = array();
        $cells = array();
        $i = 0;
        while($row = $dir_extract_results->fetch_assoc())
        {
            $pdfoutput[$i] = $row['LAST'] . ';' . $row['HIM'] . ';' . $row['HER'] . ';' . $row['ADDRESS'] . ';' . $row['ADDRESS2'] . ';' . $row['CITY'] . ';' . $row['STATE'] . ';' . $row['ZIP'] . ';' . $row['HOME_PHONE'] . ';' . $row['HIS_CELL'] . ';' . $row['HER_CELL'] . ';' . $row['HIS_EMAIL'] . ';' . $row['HER_EMAIL'] . ';' . $row['PIC'];
            // echo "<script language='javascript'>";
            // echo "console.log('[i] = " . $i . "')";
            // echo "console.log('pdfoutput[i] = " . $pdfoutput[$i] . "')";
            // echo "</script>";    
                $i++;
        }
        foreach($pdfoutput as $line)
            $dataset[] = explode(';',trim($line));
    //     return $dataset;
    // }
    }


class PDF extends FPDF
{

// Page header
function Header()
{
    // Logo
    $this->Image('../_tenant/images/tec_logo_new.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(30);
    // Set Fill Color to TEC Orange
    $this->SetFillColor(235, 115, 50);
    // Set Font Color to White
    $this->SetTextColor(255, 255, 255);
    // Title
    $this->Cell(220,10,'Directory - Trinity Evangel Church',0,0,'C',true);
    // Line break
    $this->Ln(20);
    // Restore Font Color to Black
    $this->SetTextColor(0, 0, 0);
}

// Directory Table
// function BasicTable($headers, $pdfoutput)
function BasicTable($headers, $dataset)
{
    $this->SetY(20);
    // Column widths
    $w = array(40, 20, 30, 20, 20, 10, 30, 30, 50);
    // Column Headings
    for($i=0; $i < count($headers); $i++)
        $this->Cell($w[$i],7,$headers[$i],1,0,'C');
        // $this->MultiCell($w[$i],7,$headers[$i],1,'C');
    $this->Ln();
    // Row Data
    $h=30; // Height increment to insert profile pic
    foreach($dataset as $row)
    {
            $profile='../profile_img/' . $row[13];
            $this->Cell($w[0],30,' ',0,1); // Pic Block
            $this->Image('../profile_img/' . $row[13],10,$h,30);
            $this->SetFont('Arial','B',12);
            $this->Cell($w[0],6,$row[0],0); // Last Name
            $this->SetFont('Arial','',8);
			$this->Cell($w[1],6,$row[1],0,0,'C'); // Him
			$this->Cell($w[2],6,$row[3],0,0); // Address1
			$this->Cell($w[3],6,$row[5],0,0,'C'); // City
			$this->Cell($w[4],6,$row[6],0,0,'C'); // State
			$this->Cell($w[5],6,$row[7],0,0); // Zip
			$this->Cell($w[6],6,$row[8],0,0); // Home Phone
			$this->Cell($w[7],6,$row[9],0,0); // His Cell
			$this->Cell($w[8],6,$row[11],0,1); // His Email
            $this->Cell($w[0],6,' ',0,0); // Spacer
            $this->Cell($w[1],6,$row[2],0,0,'C'); // Her
			$this->Cell($w[2],6,$row[4],0,0); // Address2
            $this->Cell($w[3],6,' ',0,0); // Spacer
            $this->Cell($w[4],6,' ',0,0); // Spacer
            $this->Cell($w[5],6,' ',0,0); // Spacer
            $this->Cell($w[6],6,' ',0,0); // Spacer
			$this->Cell($w[7],6,$row[10],0,0); // Her Cell
			$this->Cell($w[8],6,$row[12],0,0); // Her Email
			$this->Ln();
            $this->Cell(array_sum($w),0,'','T');
            $this->Ln();
            $h=$h+30;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');

}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
// $pdf = new FPDF('P','in','Letter');
$pdf = new PDF();
// $pdfoutput = $pdf->LoadData($dataset);
$headers = array('LAST','FIRST','ADDRESS','CITY','STATE','ZIP','HOME_PHONE','CELL_PHONE','EMAIL_ADDRESS');
$pdf->AliasNbPages();
// $pdf->AddPage(L, Letter);
// $pdf->AddPage(L, Letter);
// $pdf->SetFont('Arial','B',8);
// $pdf->Cell(40,10,'Hello World!');
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->AddPage(L, Letter);
$pdf->SetFont('Arial','',8);
$pdf->BasicTable($headers,$dataset);
$file_pdf = "TEC_Directory.pdf";    
$pdf->Output("I", $file_pdf);
// $pdf->Output();


?>