<?php
// Updated 20210406 - clean up for new TEC prayer module
// Initiated from tec_prayer.php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
/* Get email address of selected prayer owner - called from tec_prayer.php */
    require_once('../tec_dbconnect.php');
    
	if ( !isset($_GET['prayerID'])) {
		echo 'Required data is missing';
		return;
	}
	else {
		$prayerID = $_GET['prayerID'];
		// $prayerquery = "SELECT p.prayer_id, l.email_addr FROM " . $_SESSION['logintablename'] . " l INNER JOIN " . $_SESSION['prayertable'] . " p on p.name = CONCAT(l.firstname, ' ' , l.lastname) WHERE p.prayer_id = '" . $prayerID . "'";
		$prayerquery = "SELECT p.prayer_id, l.email_addr FROM " . $_SESSION['logintablename'] . " l INNER JOIN " . $_SESSION['prayertable'] . " p on p.owner_id = l.login_ID WHERE p.prayer_id = '" . $prayerID . "'";
		$prayerresult = $mysql->query($prayerquery) or die(" SQL query prayer follow table check error. Error #: " . $mysql->errno . " : " . $mysql->error);
		$prayercount = $prayerresult->num_rows;
		$prayerarray = array();

		while($prayerrow = $prayerresult->fetch_assoc()) {
			$prayerIDfromSelect = $prayerrow['prayer_id'];
			$prayeremail = $prayerrow['email_addr'];
			$buildjson = array('prayerid' => $prayerIDfromSelect, 'prayeremail' => $prayeremail);
			array_push($prayerarray, $buildjson);
			}
			// $prayerarray = array('prayerdata' => $prayerarray);
			header('Content-type: application/json');
			echo json_encode($prayerarray); 
		}

?>

