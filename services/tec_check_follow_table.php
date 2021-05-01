<?php
session_start();
// Updated 20210406 - clean up for new TEC prayer module
// Updated 20210430 - Convert idDirectory to LoginID
// Initiated from tec_prayer.php
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:../tec_welcome.php");
	exit();
}

    require_once('../tec_dbconnect.php');

// Check Follow/Unfollow status - called from tecprayer.php    
	if ( !isset($_GET['followprayerID']) || !isset($_GET['followprayerWho']) || !isset($_GET['followprayerLoginID'] )) {
		 echo 'Required data is missing';
		 return;
	}
	else {
		$follow_prayerID = $_GET['followprayerID'];
		$follow_prayerWho = $_GET['followprayerWho'];
		$follow_prayerLoginID = $_GET['followprayerLoginID'];
		$followprayerquery = "SELECT * FROM " . $_SESSION['prayerfollow'] . " WHERE prayer_id = '" . $follow_prayerID . "' and login_id = '" . $follow_prayerLoginID . "' and username = '" . $follow_prayerWho . "'";
		$followresult = $mysql->query($followprayerquery) or die(" SQL query prayer follow table check error. Error #: " . $mysql->errno . " : " . $mysql->error);
		$followcount = $followresult->num_rows;

		$followarray = array();
//		$messageYES = "YES - Prayer is being followed by user";
//		$messageNO = "NO - Prayer is NOT being followed by user";
		$messageYES = "YES";
		$messageNO = "NO";
		if ($followcount == 0)
		{
			$message = array('Message' => $messageNO);
			array_push($followarray, $message);
			$followarray = array('followmessage' => $followarray); 
			header('Content-type: application/json');
			echo json_encode($followarray); 
		}
		else {
			$message = array('Message' => $messageYES);
			array_push($followarray, $message); 
			$followarray = array('followmessage' => $followarray); 
			header('Content-type: application/json');
			echo json_encode($followarray); 
 
		}
	}


?>

