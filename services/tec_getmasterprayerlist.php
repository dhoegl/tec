<?php
// ****************************** Get Master List of Actve Prayer Data **************************************
// Called by tec_prayer.php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('tec_dbconnect.php');

// 	if (isset($_GET['action']) ) 
//	{
/*Query master prayer listing: visible = 3 (all) and status = 1 */
		$masterprayerquery = "SELECT p.create_date AS createdate, m.fullname, m.firstname, m.lastname, p.prayer_id AS prayerid, p.title AS prayertitle, p.prayer_text AS prayertext, p.pray_praise AS praypraise, p.updated AS updated, p.answer AS prayanswer FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['logintablename'] . " m on m.login_ID = p.owner_id WHERE p.visible = '3' and p.status = '1' and p.approved='1' ORDER BY p.create_date DESC";
		$masterprayerresult = $mysql->query($masterprayerquery) or die(" SQL query error at select active prayers. Error #: " . $mysql->errno . " : " . $mysql->error);
		$masterprayercount = $masterprayerresult->num_rows;

		$listarray = array();
		$empty_list = array();

		if ($masterprayercount == 0)
		{
            $buildjson = array(" ", " ", " ", "no prayer data", " ", "no prayer data", " ", " ", " ", );
            array_push($listarray, $buildjson);
            $listarray = array('data' => $listarray);
            echo json_encode($listarray);
            exit;
		}
		while($masterrow = $masterprayerresult->fetch_assoc()) {
				$masterprayerid = $masterrow['prayerid'];
				$masterprayercreatedate = date("M-d-Y", strtotime($masterrow['createdate']));
				$masterfullname = $masterrow['m.fullname'];
				$masterfirstname = $masterrow['m.firstname'];
				$masterlastname = $masterrow['m.lastname'];
				$masterprayertitle = $masterrow['prayertitle'];
				$masterpraypraise = $masterrow['praypraise'];
				$masterprayanswer = $masterrow['prayanswer'];
				if($masterrow['prayanswer'] == '1') {
					$masterprayanswer = "YES";
				}
				else {
					$masterprayanswer = "NO";
				}
				$masterprayerupdate = $masterrow['updated'];
				$masterprayertext = $masterrow['prayertext'];

				// Stores each database record to an array 
					$buildjson = array($masterprayerid, $masterprayercreatedate, $masterfullname, $masterfirstname, $masterlastname, $masterprayertitle, $masterpraypraise, $masterprayanswer, $$masterprayerupdate, $masterprayertext); 
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


