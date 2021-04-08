<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('tec_dbconnect.php');

// 	if (isset($_GET['action']) ) 
//	{
/*Query unapproved prayer listing: visible = 3 (all) and status = 0 */
		$unapprovedprayerquery = "SELECT p.create_date AS prayerupdatedate, p.name AS fullname, m.Name_1 AS firsthim, m.Name_2 AS firsther, m.Surname AS last, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updatereq FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['dirtablename'] . " m on m.idDirectory = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='0' ORDER BY p.create_date DESC";
		$unapprovedprayerresult = $mysql->query($unapprovedprayerquery) or die(" SQL query error at select active prayers. Error #: " . $mysql->errno . " : " . $mysql->error);
		$unapprovedprayercount = $unapprovedprayerresult->num_rows;

		$listarray = array();

		if ($unapprovedprayercount == 0)
		{
			echo "no prayer data";
			exit();
		}
		while($unapprovedrow = $unapprovedprayerresult->fetch_assoc()) {
				$prayerupdate = date("M-d-Y", strtotime($unapprovedrow['prayerupdatedate']));
				$prayerid = $unapprovedrow['prayerid'];
				$prayer_title = $unapprovedrow['prayertitle'];
				$prayer_text = $unapprovedrow['prayertext'];
				$fullname = $unapprovedrow['fullname'];				
				$glance = $prayer_title . " :: " . substr($unapprovedrow['prayertext'],0,50) . "...";
				$praypraise = $unapprovedrow['praypraise'];
				$detail_button = "Details";

				// Stores each database record to an array 
//					$buildjson = array('prayerdate' => $prayerupdate, 'id' => $prayerid, 'title' => $prayer_title, 'prayertext' => $prayer_text, 'fullname' => $fullname, 'glance' => $glance); 
					$buildjson = array('id' => $prayerid, 'prayerdate' => $prayerupdate, 'fullname' => $fullname, 'prayertitle' => $prayer_title, 'glance' => $glance, 'praypraise' => $praypraise, 'detailbutton' => $detail_button, 'prayertext' => $prayer_text); 
 					// Adds each array into the container array 
 					array_push($listarray, $buildjson); 
			}
			// Prepend array with parent element
//			$listarray = array('ActivePrayerList' => $listarray);
			$listarray = array('prayerdata' => $listarray);

//	}

	header('Content-type: application/json');
	echo json_encode($listarray); 

?>

