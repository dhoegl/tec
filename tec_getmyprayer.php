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
			
		$myprayerquery = "SELECT p.create_date AS prayerupdatedate, p.name AS fullname, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updatereq, p.answer AS prayanswer FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['logintablename'] . " m on m.login_ID = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='1' and p.owner_id = '" . $_SESSION['user_id'] . "' ORDER BY p.create_date DESC";
		// $myprayerquery = "SELECT p.create_date AS prayerupdatedate, p.name AS fullname, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updatereq, p.answer AS prayanswer FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['logintablename'] . " m on m.login_ID = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='1' and p.owner_id = '" . $_SESSION['user_id'] . "'";
		$myprayerresult = $mysql->query($myprayerquery) or die(" SQL query error at select active prayers. Error #: " . $mysql->errno . " : " . $mysql->error);
		$myprayercount = $myprayerresult->num_rows;

		$mylistarray = array();

		if ($myprayercount == 0)
		{
//			echo "no prayer data";
			$noprayer = " ";
			$noprayerecho = "no data";
			$buildjson = array($noprayer, $noprayer, $noprayerecho, $noprayer, $noprayer, $noprayer, $noprayer, $noprayer, $noprayer);
			array_push($mylistarray, $buildjson); 
// Prepend array with parent element
			$mylistarray = array('data' => $mylistarray);

			header('Content-type: application/json');
			echo json_encode($mylistarray); 
		}
		else {
		while($myrow = $myprayerresult->fetch_assoc()) {
				$myprayercontrol = "<tr><td></td>";
				$myprayerid = "<td>" . $myrow['prayerid'] . "</td>";
				$myprayerupdate = "<td>" . date("M d, Y", strtotime($myrow['prayerupdatedate'])) . "</td>";
				$myprayer_title = "<td>" . $myrow['prayertitle'] . "</td>";
				// $prayer_text = "<td>" . $myrow['prayertext'] . "</td>";
				$fullname = "<td>" . $myrow['fullname'] . "</td>";				
				$mypraypraise = "<td>" . $myrow['praypraise'] . "</td>";
				if($myrow['prayanswer'] == '1') {
					$myprayanswer = "<td>YES</td>";
				}
				else {
					$myprayanswer = "<td>NO</td>";
				}
				$myupdate_button = "<td><a class='btn btn-success btn-sm' href='#'>Update</a></td>";
				$myprayer_text = "<td>" . $myrow['prayertext'] . "</td></tr>";

				// Stores each database record to an array 
					$buildjson = array($myprayercontrol, $myprayerid, $myprayerupdate, $myprayer_title, $myupdate_button, $myprayanswer, $fullname, $mypraypraise, $myprayer_text); 
 					// Adds each array into the container array 
 					array_push($mylistarray, $buildjson); 
			}
			// Prepend array with parent element
			$mylistarray = array('data' => $mylistarray);


			header('Content-type: application/json');
			echo json_encode($mylistarray); 
		}

?>


