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
        $following = "FOLLOWING";
        $notfollowing = "NOTFOLLOWING";
        // echo "<script language='javascript'>";
        // echo "console.log('Inside tec_check_unfollow_table.php. unfollowcount = " . $unfollowcount . "');";
        // echo "</script>";
    
		if ($unfollowcount == 0)
//      Value of '0' denotes that the user has NOT selected to unfollow the selected prayer rqeuest
//      (e.g., prayer_unfollow table does not contain entry corresponding to an unfollowed prayer request by user).
//      All prayer requests default to FOLLOW unless this table has a corresponding entry for the selected user.
		{
//      MessageYES indicates that prayer request is being followed by user
			$message = array('Message' => $messageYES, 'Status' => $following);
			array_push($unfollowarray, $message);
			$unfollowarray = array('unfollowmessage' => $unfollowarray); 
			header('Content-type: application/json');
			echo json_encode($unfollowarray); 
		}
		else {
//      MessageNO indicates that prayer request is NOT being followed by user
            $message = array('Message' => $messageNO, 'Status' => $notfollowing);
			array_push($unfollowarray, $message); 
			$unfollowarray = array('unfollowmessage' => $unfollowarray); 
			header('Content-type: application/json');
			echo json_encode($unfollowarray); 
 
		}
	}


?>

