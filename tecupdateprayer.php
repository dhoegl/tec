<?php 
session_start();
if(!$_SESSION['logged in']) {
	header("location:tecwelcome.php");
	exit();
}

require_once('tec_dbconnect.php');


/* Process Prayer Request Update: Called from tecfamview.php */
   
	$prayer_ID = $_POST['prayerID'];
	$prayer_owner = $_POST['requestorID'];
	$prayer_name = $_POST['fullname'];
	$prayer_answered = $_POST['answered'];
	$prayer_title = addslashes($_POST['requesttitle']);
	$update_text = addslashes($_POST['updatetext']);
	$prayer_title = mb_convert_encoding($prayer_title, "UTF-8"); // convert to ensure copy/paste doesn't expose special characters
	$update_text = mb_convert_encoding($update_text, "UTF-8"); // convert to ensure copy/paste doesn't expose special characters

include_once('/includes/updateprayernotify.php');
// include_once('/includes/event_logs_update.php');

$updateprayerqueryselect = "INSERT INTO " . $_SESSION['prayerupdate'] . "(prayer_id, idDirectory, name, update_text) VALUES ('$prayer_ID', '$prayer_owner', '$prayer_name', '$update_text')";
$updateprayerquery = @mysql_query($updateprayerqueryselect) or die(" Prayer Update error into Prayer_Update table. Error:" . mysql_errno() . " " . mysql_error());		

$updateprayerqueryupdateselect = "UPDATE " . $_SESSION['prayertable'] . " SET updated = '1'";
if($prayer_answered == '1') {
	$updateprayerqueryupdateselect .= ", answer = '1'";
}
	 $updateprayerqueryupdateselect .= " WHERE prayer_id = '$prayer_ID'";


$updateprayerqueryupdate = @mysql_query($updateprayerqueryupdateselect) or die(" Error updating Prayer table after update. Error:" . mysql_errno() . " " . mysql_error());

if(!$updateprayerquery)
	{
		die("A database error has occurred when attempting to insert Prayer Update table after update. Please notify your administrator with the following. Error : ".mysql_errno().mysql_error());
	}
if(!$updateprayerqueryupdate)
	{
		die("A database error has occurred when attempting to modify Prayer table after update. Please notify your administrator with the following. Error : ".mysql_errno().mysql_error());
	}

updateprayernotify($prayer_ID, $prayer_name, $prayer_answered, $prayer_title, $update_text);


header("location:tecfamview.php?id=" . $prayer_owner);
?>

