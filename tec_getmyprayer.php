<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
   require_once('tec_dbconnect.php');

// Query my prayer listing: visible = 3 (all), status = 1, approved = 1, and name = logged in user ($_SESSION['fullname'])
// Query used to populate My Prayer DataTable listing in Popup
			
		$myprayerquery = "SELECT p.create_date AS prayerupdatedate, p.name AS fullname, m.Name_1 AS firsthim, m.Name_2 AS firsther, m.Surname AS last, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updatereq, p.answer AS prayanswer FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['dirtablename'] . " m on m.idDirectory = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='1' and p.name = '" . $_SESSION['fullname'] . "' ORDER BY p.create_date DESC";
		$myprayerresult = $mysql->query($myprayerquery) or die(" SQL query error at select active prayers. Error #: " . $mysql->errno . " : " . $mysql->error);
		$myprayercount = $myprayerresult->num_rows;

		$mylistarray = array();

		if ($myprayercount == 0)
		{
//			echo "no prayer data";
			$noprayer = " ";
			$buildjson = array($noprayer, $noprayer, $noprayer, $noprayer, $noprayer, $noprayer, $noprayer);
			array_push($mylistarray, $buildjson); 
// Prepend array with parent element
			$mylistarray = array('data' => $mylistarray);

			header('Content-type: application/json');
			echo json_encode($mylistarray); 
		}
		else {
		while($myrow = $myprayerresult->fetch_assoc()) {
				$myprayercontrol = "<tr><td></td>";
				$prayerupdate = "<td>" . date("M-d-Y", strtotime($myrow['prayerupdatedate'])) . "</td>";
				$prayerid = "<td>" . $myrow['prayerid'] . "</td>";
				$prayer_title = "<td>" . $myrow['prayertitle'] . "</td>";
				// $prayer_text = "<td>" . $myrow['prayertext'] . "</td>";
				$fullname = "<td>" . $myrow['fullname'] . "</td>";				
				$praypraise = "<td>" . $myrow['praypraise'] . "</td>";
				if($myrow['prayanswer'] == '1') {
					$prayanswer = "<td>YES</td>";
				}
				else {
					$prayanswer = "<td>NO</td>";
				}
				$update_button = "<td><a class='btn btn-success btn-sm' href='#'>Update</a></td>";
				$prayer_text = "<td>" . $myrow['prayertext'] . "</td></tr>";

				// Stores each database record to an array 
					$buildjson = array($myprayercontrol, $prayerid, $prayerupdate, $prayer_title, $update_button, $prayanswer, $prayer_text); 
 					// Adds each array into the container array 
 					array_push($mylistarray, $buildjson); 
			}
			// Prepend array with parent element
			$mylistarray = array('data' => $mylistarray);


			header('Content-type: application/json');
			echo json_encode($mylistarray); 
		}

?>


