<?php
// Updated 20210406 - cleaned up for new TEC prayer module
// Updated 20210430 - Add LoginID, verify eventLogUpdate functions correctly
// Initiated from tec_prayer.php
// Updated 20210524 - Swap prayer_follow to prayer_unfollow
// Logic is: All prayer requests will be automatically followed unless explicitly unfollowed by user in tec_prayer.php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}

    require_once('../tec_dbconnect.php');
    include('../includes/event_logs_update.php');

	if ( !isset($_POST['unfollowselect']) || !isset($_POST['unfollowprayerID']) || !isset($_POST['unfollowprayerWho']) || !isset($_POST['unfollowprayerDir'] )) {
		 echo 'Required data is missing';
		 return;
	}
	else {
		$unfollowselect =  $_POST['unfollowselect'];
		$unfollow_prayerID = $_POST['unfollowprayerID'];
		$unfollow_prayerWho = $_POST['unfollowprayerWho'];
		$unfollow_prayerDir = $_POST['unfollowprayerDir'];
		$unfollow_prayerLoginID = $_POST['followprayerLoginID'];
		if($unfollowselect == 'yes') {
			echo "<script language='javascript'>";
			echo "console.log('NO I am NOT following this prayer request');";
			echo "</script>";
		// If YES, and Unfollow button clicked, this means that user no longer wants to follow this prayer request
 			$deletefollow = "DELETE from " . $_SESSION['prayerunfollow'] . " WHERE prayer_id = '$unfollow_prayerID' and login_id = '$unfollow_prayerLoginID'";			
			$deletefollowexe = $mysql->query($deletefollow)or die("A database error has occurred when deleting prayer_follow entry. Please notify your administrator with the following. Error #: " . $mysql->errno . " : " . $mysql->error);
			eventLogUpdate('prayer', 'UserID: ' . $_SESSION['user_id'], 'User requested to Unfollow Prayer Request' , 'PrayerID: ' . $unfollow_prayerID);
		}
		else { // unfollow - delete follow entry
			echo "<script language='javascript'>";
			echo "console.log('NO I am NOT following this prayer request');";
			echo "</script>";
		// If NO, and Follow button clicked, this means that user wants to follow this prayer request
			$accessquery = "INSERT INTO " . $_SESSION['prayerunfollow'] . "(prayer_id, login_id, username, idDirectory) VALUES ('" . $unfollow_prayerID . "', '" . $_SESSION['user_id'] . "', '" . $unfollow_prayerWho . "', '" . $unfollow_prayerDir . "')";		
			$logresult = $mysql->query($accessquery) or die(" SQL query prayer follow table insert error. Error #: " . $mysql->errno . " : " . $mysql->error);
			eventLogUpdate('prayer', 'UserID: ' . $_SESSION['user_id'], 'User requested to Follow Prayer Request' , 'PrayerID: ' . $unfollow_prayerID);
		}

	}

?>