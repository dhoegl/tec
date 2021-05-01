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
			$accessquery = "INSERT INTO " . $_SESSION['prayerfollow'] . "(prayer_id, login_id, username, idDirectory) VALUES ('" . $follow_prayerID . "', '" . $_SESSION['user_id'] . "', '" . $follow_prayerWho . "', '" . $follow_prayerDir . "')";		
			$logresult = $mysql->query($accessquery) or die(" SQL query prayer follow table insert error. Error #: " . $mysql->errno . " : " . $mysql->error);
			eventLogUpdate('prayer', 'Prayer Following' , 'PrayerID: ' . $follow_prayerID, 'UserID: ' . $_SESSION['user_id']);
		}
		else { // unfollow - delete follow entry
 			$deletefollow = "DELETE from " . $_SESSION['prayerfollow'] . " WHERE prayer_id = '$follow_prayerID' and username = '$follow_prayerWho' and idDirectory = '$follow_prayerDir'";			
			$deletefollowexe = $mysql->query($deletefollow)or die("A database error has occurred when deleting prayer_follow entry. Please notify your administrator with the following. Error #: " . $mysql->errno . " : " . $mysql->error);
			eventLogUpdate('prayer', 'Prayer UnFollow' , 'PrayerID: ' . $follow_prayerID, 'UserID: ' . $_SESSION['user_id']);
		}

	}

?>