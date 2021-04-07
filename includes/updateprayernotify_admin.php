<?php
/* Send email to members with 'prayer_follow = '1' for the updated prayer'; called from 'tecupdateprayer_admin.php */

function updateprayernotify_admin ($prayer_ID, $prayer_name, $prayer_answered, $prayer_title, $update_text){
	$praymaillink = "https://trinityevangel.ourfamilyconnections.org";								
//	$prayernotifyquery = "SELECT l.email_addr AS emailaddr FROM " . $_SESSION['logintablename'] . " l INNER JOIN " . $_SESSION['prayerfollow'] . " f ON l.login_ID = f.login_id WHERE f.prayer_id = '" . $prayer_ID . "'";			
	$prayernotifyquery = "SELECT l.email_addr AS emailaddr FROM " . $_SESSION['logintablename'] . " l WHERE l.update_prayer_notify = '1'";			
	$prayernotifyresult = @mysql_query($prayernotifyquery)or die("Prayer Notify function failed at db SELECT. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());
	$prayernotifyresultcount = @mysql_num_rows($prayernotifyresult);
	if($prayernotifyresultcount > 0) {	
	while($prayernotifyrow = @mysql_fetch_assoc($prayernotifyresult)) {
		$praymailto = $prayernotifyrow['emailaddr'];
		$praymailsubject = "Updated Prayer Request from " . $prayer_name . " on behalf of " . $fullname . " \n..";
		$praymailmessage = "(this message has been sent from an unmonitored mailbox)<br /><br />";
		$praymailmessage .= " Hello! " . "<br /><strong>" . $prayer_name . "</strong> has updated their prayer request.<br />Details are below...<br /><br />" . "<table><tr><td><strong>TITLE: </strong> " . $prayer_title . "</td></tr><tr><td><strong>UPDATE: </strong> " . $update_text . "</td></tr></table><br /><br />Login to our website for more information<br />" . $praymaillink;
		$praymailfrom = "prayerupdate@ourfamilyconnections.org";
		$praymailheaders = "From:" . $praymailfrom . "\r\n";
		$praymailheaders .= "MIME-Version: 1.0\r\n";
		$praymailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($praymailto,$praymailsubject,$praymailmessage,$praymailheaders);
		}
	}
	else {
		$praymailto = "firebird@hoeglund.com";
		$praymailtest = "";
		while($prayernotifyrow = @mysql_fetch_assoc($prayernotifyresult)) {
			$praymailtest .= $prayernotifyrow['emailaddr'];
			$praymailtest .= ", ";
		}
		$praymailmessage = "SQL Query for Prayer Updates failed to find prayer update requests - check updateprayernotify_admin.php for details. There are " . $prayernotifyresultcount . " followers (" . $praymailtest . ") for prayer " . $prayer_ID . ".";
		$praymailsubject = "Updated Prayer Request from Our Family Connections"."\n..";
		$praymailfrom = "prayererror@ourfamilyconnections.org";
		$praymailheaders = "From:" . $praymailfrom . "\r\n";
		$praymailheaders .= "MIME-Version: 1.0\r\n";
		$praymailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($praymailto,$praymailsubject,$praymailmessage,$praymailheaders);
	}
}
?>