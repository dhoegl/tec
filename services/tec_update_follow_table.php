<?php
// Updated 20210406 - cleaned up for new TEC prayer module
// Updated 20210430 - Add LoginID, verify eventLogUpdate functions correctly
// Initiated from tec_prayer.php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}

    require_once('../tec_dbconnect.php');
    include('../includes/event_logs_update.php');

	if ( !isset($_POST['followselect']) || !isset($_POST['followprayerID']) || !isset($_POST['followprayerWho']) || !isset($_POST['followprayerDir'] )) {
		 echo 'Required data is missing';
		 return;
	}
	else {
		$followselect =  $_POST['followselect'];
		$follow_prayerID = $_POST['followprayerID'];
		$follow_prayerWho = $_POST['followprayerWho'];
		$follow_prayerDir = $_POST['followprayerDir'];
		$follow_prayerLoginID = $_POST['followprayerLoginID'];
		if($followselect == 'yes') {
			echo "<script language='javascript'>";
			echo "console.log('YES I am following this prayer request');";
			echo "</script>";
		// If YES, and Unfollow button clicked, this means that user no longer wants to follow this prayer request
 			$deletefollow = "DELETE from " . $_SESSION['prayerfollow'] . " WHERE prayer_id = '$follow_prayerID' and login_id = '$follow_prayerLoginID'";			
			$deletefollowexe = $mysql->query($deletefollow)or die("A database error has occurred when deleting prayer_follow entry. Please notify your administrator with the following. Error #: " . $mysql->errno . " : " . $mysql->error);
			eventLogUpdate('prayer', 'UserID: ' . $_SESSION['user_id'], 'User requested to Unfollow Prayer Request' , 'PrayerID: ' . $follow_prayerID);
		}
		else { // unfollow - delete follow entry
			echo "<script language='javascript'>";
			echo "console.log('NO I am NOT following this prayer request');";
			echo "</script>";
		// If NO, and Follow button clicked, this means that user wants to follow this prayer request
			$accessquery = "INSERT INTO " . $_SESSION['prayerfollow'] . "(prayer_id, login_id, username, idDirectory) VALUES ('" . $follow_prayerID . "', '" . $_SESSION['user_id'] . "', '" . $follow_prayerWho . "', '" . $follow_prayerDir . "')";		
			$logresult = $mysql->query($accessquery) or die(" SQL query prayer follow table insert error. Error #: " . $mysql->errno . " : " . $mysql->error);
			eventLogUpdate('prayer', 'UserID: ' . $_SESSION['user_id'], 'User requested to Follow Prayer Request' , 'PrayerID: ' . $follow_prayerID);
		}

	}

?>