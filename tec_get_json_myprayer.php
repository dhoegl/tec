<?php
// Call prayer and prayer_update tables
// Generate json text of prayers and corresponding prayer_update data
// Updated 20210523
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('tec_dbconnect.php');

// Query my prayer listing: visible = 3 (all), status = 1, and name = logged in user ($_SESSION['fullname'])
// Query used to populate My Prayer Details section of Popup
		$myprayerquery = "SELECT p.create_date AS prayerupdatedate, p.name AS fullname, m.Name_1 AS firsthim, m.Name_2 AS firsther, m.Surname AS last, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updatereq, p.answer AS prayanswer FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['dirtablename'] . " m on m.idDirectory = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='1' and p.name = '" . $_SESSION['fullname'] . "' ORDER BY p.create_date DESC";
		$myprayerresult = $mysql->query($myprayerquery) or die(" SQL query error at select My prayers. Error #: " . $mysql->errno . " : " . $mysql->error);
		$myprayercount = $myprayerresult->num_rows;

		$mylistarray = array();

		if ($myprayercount == 0)
		{
			echo "no prayer data";
//			echo json_encode($mylistarray);
//			return;
		}
		while($myrow = $myprayerresult->fetch_assoc()) {
				$prayerupdate = date("M-d-Y", strtotime($myrow['prayerupdatedate']));
				$prayerid = $myrow['prayerid'];
				$prayer_title = $myrow['prayertitle'];
				$prayer_text = $myrow['prayertext'];
// Append Prayer Update text to initial active prayer text
				$updateprayerquery = "SELECT * FROM " . $_SESSION['prayerupdate'] . " WHERE prayer_id = '" . $prayerid . "' order by update_id";
				$updateprayerresult = $mysql->query($updateprayerquery) or die(" SQL query error at select from prayerupdate. Error #: " . $mysql->errno . " : " . $mysql->error);
				$updateprayercount = $updateprayerresult->num_rows;
				if(!$updateprayercount == 0) {
					while($updateprayerrow = $updateprayerresult->fetch_assoc()) {
						$updateprayerdate = date("M-d-Y", strtotime($updateprayerrow['update_date']));
						$updateprayertext = $updateprayerrow['update_text'];
						$prayer_text .= "\r\n\r\n";
						$prayer_text .= "<STRONG>" . $updateprayerdate . "</STRONG>";
						$prayer_text .= "\r\n";
						$prayer_text .= $updateprayertext;
					}
				}
				$prayer_text .= "\r\n\r\n";
				$fullname = $myrow['fullname'];				
				$glance = $prayer_title . " :: " . substr($activerow['prayertext'],0,50) . "...";
				$praypraise = $myrow['praypraise'];
				if($myrow['prayanswer'] == '1') {
					$prayanswer = "YES";
				}
				else {
					$prayanswer = "NO";
				}
				$detail_button = "Details";

				// Stores each database record to an array 
					$buildjson = array('id' => $prayerid, 'prayerdate' => $prayerupdate, 'fullname' => $fullname, 'prayertitle' => $prayer_title, 'glance' => $glance, 'praypraise' => $praypraise, 'prayanswer' => $prayanswer, 'detailbutton' => $detail_button, 'prayertext' => $prayer_text); 
 					// Adds each array into the container array 
 					array_push($mylistarray, $buildjson); 
			}
			// Prepend array with parent element
			$mylistarray = array('prayerdata' => $mylistarray);



	header('Content-type: application/json');
	echo json_encode($mylistarray); 

?>

