<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}

   require_once('../tec_dbconnect.php');

$sqlquery = "SELECT idDirectory, Name_1, Name_2, Surname, BDay_1_Date, BDay_2_Date, Anniv_Date, Child_1_Name, Child_1_Bday_Date, Child_2_Name, Child_2_Bday_Date, Child_3_Name, Child_3_Bday_Date, Child_4_Name, Child_4_Bday_Date, Child_5_Name, Child_5_Bday_Date, Child_6_Name, Child_6_Bday_Date, Child_7_Name, Child_7_Bday_Date, Child_8_Name, Child_8_Bday_Date FROM $dir_tbl_name WHERE Status = '1' AND Internet_Restrict IS NULL";
$result = $mysql->query($sqlquery) or die(" SQL query error Directory table. Error:" . mysql_errno() . " " . mysql_error());

$count = $result->num_rows;

$listarray = array();

	while($row1 = $result->fetch_assoc()) {
//		Gents Birthdays
		if($row1['Name_1'] && $row1['BDay_1_Date']){
			$todayYear = date("Y");

			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Name_1'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['BDay_1_Date'],5,2);
		 	$eventDay = substr($row1['BDay_1_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "red", 'textColor' => "white"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "red", 'textColor' => "white"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
}
//		Ladies Birthdays
		if($row1['Name_2'] && $row1['BDay_2_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Name_2'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['BDay_2_Date'],5,2);
		 	$eventDay = substr($row1['BDay_2_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "red", 'textColor' => "white"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "red", 'textColor' => "white"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}
//		Anniversaries

		if($row1['Anniv_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Surname'] . ", " . $row1['Name_1'] . " & " . $row1['Name_2'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Anniv_Date'],5,2);
		 	$eventDay = substr($row1['Anniv_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Anniversary";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "green", 'textColor' => "white"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "green", 'textColor' => "white"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}

//		Child 1 Birthdays
		if($row1['Child_1_Bday_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Child_1_Name'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Child_1_Bday_Date'],5,2);
		 	$eventDay = substr($row1['Child_1_Bday_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}

//		Child 2 Birthdays
		if($row1['Child_2_Bday_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Child_2_Name'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Child_2_Bday_Date'],5,2);
		 	$eventDay = substr($row1['Child_2_Bday_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}
 	
//		Child 3 Birthdays
		if($row1['Child_3_Bday_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Child_3_Name'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Child_3_Bday_Date'],5,2);
		 	$eventDay = substr($row1['Child_3_Bday_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}
 	
//		Child 4 Birthdays
		if($row1['Child_4_Bday_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Child_4_Name'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Child_4_Bday_Date'],5,2);
		 	$eventDay = substr($row1['Child_4_Bday_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}
 	
//		Child 5 Birthdays
		if($row1['Child_5_Bday_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Child_5_Name'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Child_5_Bday_Date'],5,2);
		 	$eventDay = substr($row1['Child_5_Bday_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}
 	
//		Child 6 Birthdays
		if($row1['Child_6_Bday_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Child_6_Name'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Child_6_Bday_Date'],5,2);
		 	$eventDay = substr($row1['Child_6_Bday_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}

//		Child 7 Birthdays
		if($row1['Child_7_Bday_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Child_7_Name'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Child_7_Bday_Date'],5,2);
		 	$eventDay = substr($row1['Child_7_Bday_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}

//		Child 8 Birthdays
		if($row1['Child_8_Bday_Date']){
			$eventID = $row1['idDirectory'];
		 	$eventtitle = $row1['Child_8_Name'] . " " . $row1['Surname'];
//		 	$eventYear = 2012;
			$eventYear = $todayYear;
			$eventYearPlusOne = $todayYear + 1;
		 	$eventMonth = substr($row1['Child_8_Bday_Date'],5,2);
		 	$eventDay = substr($row1['Child_8_Bday_Date'],8,2);
			$eventdate = $eventYear . "-" . $eventMonth . "-" . $eventDay;
			$eventdatePlusOne = $eventYearPlusOne . "-" . $eventMonth . "-" . $eventDay;
			$eventend = $eventdate;
			$eventendPlusOne = $eventdatePlusOne;
			$Description = $eventtitle . "'s Birthday";
			$eventURL = "tec_profile.php?id=" . $row1['idDirectory'];
			// Stores each database record to an array 
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdate, 'end' => "$eventend", 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			// Add a second entry for subsequent year
			$buildjson = array('id' => $eventID, 'title' => "$eventtitle", 'start' => $eventdatePlusOne, 'end' => $eventendPlusOne, 'url' => "$eventURL", 'description' => "$Description", 'color' => "yellow", 'textColor' => "black"); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 

			}

	}

	header('Content-type: application/json');
	
	echo json_encode($listarray);



?>
