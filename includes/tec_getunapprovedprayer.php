<?php
// Last Updated 05/31/2021:
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:../tec_welcome.php");
	exit();
}
   require_once('../tec_dbconnect.php');

/* Populate DataTable */
/* Query unapproved prayer listing: visible = 3 (all) and approved = 0 */
		// $unapprovedprayerquery = "SELECT * FROM $prayer_tbl_name p INNER JOIN $dir_tbl_name d on p.owner_id = d.idDirectory WHERE p.approved = 0 AND p.visible = '3'";
		$unapprovedprayerquery = "SELECT p.create_date AS prayerupdatedate, m.fullname AS full_name, m.firstname AS first_name, m.lastname AS last_name, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updatereq FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['logintablename'] . " m on m.login_ID = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='0' ORDER BY p.create_date DESC";
		$unapprovedprayerresult = $mysql->query($unapprovedprayerquery) or die(" Unapproved Prayer Request table query error. Error:" . $mysql->error);
		$unapprovedprayercount = $unapprovedprayerresult->num_rows;
		$listarray = array();
		if ($unapprovedprayercount == 0)
		{
			$noprayer = 'no prayer data';
		}
		else {
		while($unapprovedrow = $unapprovedprayerresult->fetch_assoc()) {
			$praycontrol = "<tr><td></td>";
			$prayerid = "<td>" . $unapprovedrow['prayerid'] . "</td>";
			$prayerupdate = "<td>" . date("M d, Y", strtotime($unapprovedrow['prayerupdatedate'])) . "</td>";
			$fullname = "<td>" . $unapprovedrow['full_name'] . "</td>";				
			$praypraise = "<td>" . $unapprovedrow['praypraise'] . "</td>";
			$prayer_title = "<td>" . $unapprovedrow['prayertitle'] . "</td>";
			$approve_button = "<td><button type='button' class='btn btn-success btn-sm' href='#'>Approve</button></td>";
			$reject_button = "<td><button type='button' class='btn btn-danger btn-sm' href='#'>Reject</button></td>";
			$view_button = "<td><button type='button' class='btn btn-primary btn-sm' href='#'>View</button></td>";
			$prayer_text = "<td>" . $unapprovedrow['prayertext'] . "</td></tr>";
		
			// Stores each database record to an array 
			$buildjson = array($praycontrol, $prayerid, $prayerupdate, $fullname, $praypraise, $prayer_title, $approve_button, $reject_button, $view_button, $prayer_text); 
			// $buildjson = array('id' => $prayerid, 'prayerdate' => $prayerupdate, 'fullname' => $fullname, 'prayertitle' => $prayer_title, 'glance' => $glance, 'praypraise' => $praypraise, 'detailbutton' => $detail_button, 'prayertext' => $prayer_text); 
 			// Adds each array into the container array 
 			array_push($listarray, $buildjson); 
			}
			// Prepend array with parent element
			$listarray = array('data' => $listarray);
	header('Content-type: application/json');
	echo json_encode($listarray); 
}
?>

