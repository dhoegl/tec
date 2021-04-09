<?php
// ****************************** Get Actve Prayer Data **************************************
// Called by tec_view_activeprayerlist2.php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('tec_dbconnect.php');

// 	if (isset($_GET['action']) ) 
//	{
/*Query active prayer listing: visible = 3 (all) and status = 1 */
		$activeprayerquery = "SELECT p.create_date AS prayerupdatedate, p.name AS fullname, m.Name_1 AS firsthim, m.Name_2 AS firsther, m.Surname AS last, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updatereq, p.answer AS prayanswer FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['dirtablename'] . " m on m.idDirectory = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='1' ORDER BY p.create_date DESC";
		$activeprayerresult = $mysql->query($activeprayerquery) or die(" SQL query error at select active prayers. Error #: " . $mysql->errno . " : " . $mysql->error);
		$activeprayercount = $activeprayerresult->num_rows;

		$listarray = array();
		$empty_list = array();

		if ($activeprayercount == 0)
		{
            $buildjson = array("no prayer data", " ", " ", " ", " ", " ", " ", " ", );
            array_push($listarray, $buildjson);
            $listarray = array('data' => $listarray);
            echo json_encode($listarray);
            exit;
		}
		while($activerow = $activeprayerresult->fetch_assoc()) {
				$activeprayercontrol = "<tr><td></td>";
				$prayerid = "<td>" . $activerow['prayerid'] . "</td>";
				$prayerupdate = "<td>" . date("M-d-Y", strtotime($activerow['prayerupdatedate'])) . "</td>";
				$fullname = "<td>" . $activerow['fullname'] . "</td>";				
				$praypraise = "<td>" . $activerow['praypraise'] . "</td>";
				$prayanswer = $activerow['answered'];
				if($activerow['prayanswer'] == '1') {
					$prayanswer = "<td> Answered </td>";
				}
				else {
					$prayanswer = "<td> </td>";
				}
				$prayer_title = "<td>" . $activerow['prayertitle'] . "</td>";
				$glance = "<td><b>" . $prayer_title . " </b><br />" . substr($activerow['prayertext'],0,50) . "...</td>";
				$detail_button = "<td class='btn btn-success'>Details</td>";
				$prayer_text = "<td>" . $activerow['prayertext'] . "</td></tr>";

				// Stores each database record to an array 
//					$buildjson = array('prayerdate' => $prayerupdate, 'id' => $prayerid, 'title' => $prayer_title, 'prayertext' => $prayer_text, 'fullname' => $fullname, 'glance' => $glance); 
					$buildjson = array($activeprayercontrol, $prayerid, $prayerupdate, $fullname, $praypraise, $prayanswer, $prayer_title, $glance, $detail_button, $prayer_text); 
 					// Adds each array into the container array 
 					array_push($listarray, $buildjson); 
			}
			// Prepend array with parent element
//			$listarray = array('ActivePrayerList' => $listarray);
			$listarray = array('data' => $listarray);

//	}

	header('Content-type: application/json');
	echo json_encode($listarray); 

?>


