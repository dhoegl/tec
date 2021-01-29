<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
require_once('tec_dbconnect.php');

// 	if (isset($_GET['action']) )
//	{
/* Populate DataTable */
/*Query directory listing: visible = 3 (all) and status = 1 */
$familyquery = $mysql->query("SELECT * FROM " . $_SESSION['dirtablename'] . " WHERE church_ID = '1' and idDirectory = " . "") or die(" SQL query error at select family. Error:" . mysql_errno() . " " . mysql_error());
$familyquerycount = $familyquery->num_rows;

$listarray = array();

if ($familyquerycount == 0)
{
    echo "no prayer data";
}
while($activerow = $familyquery->fetch_assoc()) {
    $prayerupdate = date("M-d-Y", strtotime($activerow['prayerupdatedate']));
    $prayerid = $activerow['prayerid'];
    $prayer_title = $activerow['prayertitle'];
    $prayer_text = $activerow['prayertext'];
    $fullname = $activerow['fullname'];
    $glance = "<a data-toggle='modal' data-target='#ModalPrayerInfo' class='faux_hyperlink'>" . $prayer_title . " </a><br />" . substr($activerow['prayertext'],0,100) . "...";
    $praypraise = $activerow['praypraise'];
    $prayanswer = $activerow['answered'];
    if($activerow['prayanswer'] == '1') {
        $prayanswer = "Answered";
    }
    else {
        $prayanswer = " ";
    }
    $detail_button = "Details";

    // Stores each database record to an array
    //					$buildjson = array('prayerdate' => $prayerupdate, 'id' => $prayerid, 'title' => $prayer_title, 'prayertext' => $prayer_text, 'fullname' => $fullname, 'glance' => $glance);
    $buildjson = array($prayerid, $prayerupdate, $fullname, $praypraise, $prayanswer, $glance, $detail_button, $prayer_text);
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


