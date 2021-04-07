<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('tec_dbconnect.php');

/* Populate DataTable */
/* Query unapproved prayer listing: visible = 3 (all) and approved = 0 */
		$unapprovedprayerquery = "SELECT * FROM $prayer_tbl_name p INNER JOIN $dir_tbl_name d on p.owner_id = d.idDirectory WHERE p.approved = 0 AND p.visible = '3'";
		$unapprovedprayerresult = @mysql_query($unapprovedprayerquery) or die(" Unapproved Prayer Request table query error. Error:" . mysql_errno() . " " . mysql_error());
		$unapprovedprayercount = mysql_num_rows($unapprovedprayerresult);

		$listarray = array();

		if ($unapprovedprayercount == 0)
		{
			echo "no prayer data";
		}
		while($unapprovedrow = @mysql_fetch_assoc($unapprovedprayerresult)) {
				$prayerupdate = date("M-d-Y", strtotime($unapprovedrow['prayerupdatedate']));
				$prayerid = $unapprovedrow['prayerid'];
				$prayer_title = $unapprovedrow['prayertitle'];
				$prayer_text = $unapprovedrow['prayertext'];
				$fullname = $unapprovedrow['fullname'];				
				$glance = "<strong>" . $prayer_title . " </strong><br />" . substr($unapprovedrow['prayertext'],0,50) . "...";
				$praypraise = $unapprovedrow['praypraise'];
				$detail_button = "Details";

				// Stores each database record to an array 
//					$buildjson = array($prayerid, $prayerupdate, $fullname, $glance, $praypraise, $detail_button, $prayer_text); 
					$buildjson = array('id' => $prayerid, 'prayerdate' => $prayerupdate, 'fullname' => $fullname, 'prayertitle' => $prayer_title, 'glance' => $glance, 'praypraise' => $praypraise, 'detailbutton' => $detail_button, 'prayertext' => $prayer_text); 
 					// Adds each array into the container array 
 					array_push($listarray, $buildjson); 
			}
			// Prepend array with parent element
			$listarray = array('data' => $listarray);


	header('Content-type: application/json');
	echo json_encode($listarray); 

?>

