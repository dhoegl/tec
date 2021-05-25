<?php
session_start();
// Updated 20210406 - clean up for new TEC prayer module
// Updated 20210524 - Swap prayer_follow to prayer_unfollow
// Logic is: All prayer requests will be automatically followed unless explicitly unfollowed by user in tec_prayer.php
// Initiated from tec_prayer.php
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:../tec_welcome.php");
	exit();
}

    require_once('../tec_dbconnect.php');

// Check Follow/Unfollow status - called from tecprayer.php    
	if ( !isset($_GET['unfollowprayerID']) || !isset($_GET['unfollowprayerWho']) || !isset($_GET['unfollowprayerLoginID'] )) {
		 echo 'Required data is missing';
		 return;
	}
	else {
		$unfollow_prayerID = $_GET['unfollowprayerID'];
		$unfollow_prayerWho = $_GET['unfollowprayerWho'];
		$unfollow_prayerLoginID = $_GET['unfollowprayerLoginID'];
		$unfollowprayerquery = "SELECT * FROM " . $_SESSION['prayerunfollow'] . " WHERE prayer_id = '" . $unfollow_prayerID . "' and login_id = '" . $unfollow_prayerLoginID . "' and username = '" . $unfollow_prayerWho . "'";
		$unfollowresult = $mysql->query($unfollowprayerquery) or die(" SQL query prayer unfollow table check error. Error #: " . $mysql->errno . " : " . $mysql->error);
		$unfollowcount = $unfollowresult->num_rows;

		$unfollowarray = array();
//		$messageYES = "YES - Prayer is being followed by user";
//		$messageNO = "NO - Prayer is NOT being followed by user";
		$messageYES = "YES";
		$messageNO = "NO";
		if ($unfollowcount == 0)
//      Denotes that the user has NOT selected to unfollow the selected prayer rqeuest (e.g., prayer_unfollow table does not contain entry corresponding to an unfollowed prayer request by user).
		{
			$message = array('Message' => $messageYES);
			array_push($unfollowarray, $message);
			$unfollowarray = array('unfollowmessage' => $unfollowarray); 
			header('Content-type: application/json');
			echo json_encode($unfollowarray); 
		}
		else {
			$message = array('Message' => $messageNO);
			array_push($unfollowarray, $message); 
			$unfollowarray = array('unfollowmessage' => $unfollowarray); 
			header('Content-type: application/json');
			echo json_encode($unfollowarray); 
 
		}
	}


?>

