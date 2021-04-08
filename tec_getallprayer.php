<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tecwelcome.php");
	exit();
}
   require_once('tec_dbconnect.php');

// Query all prayer listing (for prayer admin): visible = 3 (all), status = 1, approved = 1, and name = logged in user ($_SESSION['fullname'])
// Query used to populate My Prayer DataTable listing in Popup
			
		$myprayerquery = "SELECT p.create_date AS prayerupdatedate, p.name AS fullname, m.Name_1 AS firsthim, m.Name_2 AS firsther, m.Surname AS last, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updatereq, p.answer AS prayanswer FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['dirtablename'] . " m on m.idDirectory = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='1'" . " ORDER BY p.create_date DESC";
		$myprayerresult = $mysql->query($myprayerquery) or die(" SQL query error at select active prayers. Error #: " . $mysql->errno . " : " . $mysql->error);
		$myprayercount = $myprayerresult->num_rows;

		$mylistarray = array();

		if ($myprayercount == 0)
		{
//			echo "no prayer data";
			$noprayer = "no prayer data";
			$buildjson = array($noprayer, $noprayer, $noprayer, $noprayer, $noprayer, $noprayer);
			array_push($mylistarray, $buildjson); 
// Prepend array with parent element
			$mylistarray = array('data' => $mylistarray);

			header('Content-type: application/json');
			echo json_encode($mylistarray); 
		}
		else {
		while($myrow = $myprayerresult->fetch_assoc()) {
				$prayerupdate = date("M-d-Y", strtotime($myrow['prayerupdatedate']));
				$prayerid = $myrow['prayerid'];
				$prayer_title = $myrow['prayertitle'];
				$prayer_text = $myrow['prayertext'];
				$fullname = $myrow['fullname'];				
				$glance = "<strong>" . $prayer_title . " </strong><br />" . substr($myrow['prayertext'],0,50) . "...";
				$praypraise = $myrow['praypraise'];
				if($myrow['prayanswer'] == '1') {
					$prayanswer = "YES";
				}
				else {
					$prayanswer = "NO";
				}
				$detail_button = "Details";

				// Stores each database record to an array 
					$buildjson = array($prayerid, $prayerupdate, $fullname, $prayer_title, $prayanswer, $detail_button); 
 					// Adds each array into the container array 
 					array_push($mylistarray, $buildjson); 
			}
			// Prepend array with parent element
			$mylistarray = array('data' => $mylistarray);


			header('Content-type: application/json');
			echo json_encode($mylistarray); 
		}

?>


