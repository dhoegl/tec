<?php 
session_start();
if(!$_SESSION['logged in']) {
	header("location:../tec_welcome.php");
	exit();
}

require_once('../tec_dbconnect.php');
include_once('../includes/event_logs_update.php');



/* Process profile update - CALENDAR (anniversary/birthday) INFO: Called from tec_profile.php */
if(isset($_POST['submitcalendar']))
	{   
	$my_anniv = $_POST['myanniversary'];
	$his_bday = $_POST['hisbirthday'];
	$her_bday = $_POST['herbirthday'];
	$child_name = $_POST['lastname'];
	$calendarupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Anniv_Date = '" . $my_anniv . "', BDay_1_Date = '" . $his_bday . "', BDay_2_Date = '" . $her_bday . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'"; 
	$calendarupdate = $mysql->query($calendarupdatequery) or die("A database error occurred when trying to update calendar info. See ofc_profile_calendar_update.php. Error : " . mysql_errno() . mysql_error());		
	eventLogUpdate('profile_update', 'Anniv_Date = ' . $my_anniv . ', BDay_1_Date = ' . $his_bday . ', BDay_2_Date = ' . $her_bday, 'Profile Update-Calendar' , 'username= ' . $_SESSION['username']);
}
else {
	echo "isset didn't work";
	}

header("location:../tec_profile.php?id=" . $_SESSION["Famview_Profile"]);
?>