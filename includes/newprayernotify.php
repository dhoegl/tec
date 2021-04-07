<?php
/* Send email to members with 'new_prayer_notify = '1''; called from 'tecnewprayeraccept.php */

session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tecwelcome.php");
	exit();
}

require_once('../tec_dbconnect.php');

if(isset($_POST['prayer_ID']) && isset($_POST['recordID']) && isset($_POST['prayerDate']) && isset($_POST['prayerFrom']) && isset($_POST['prayerTitle']) && isset($_POST['prayerText']))
{
	$prayer_id = $_POST['prayer_ID'];
	$recordID = $_POST['recordID'];
	$prayerdate = $_POST['prayerDate'];
	$prayerfrom = $_POST['prayerFrom'];
	$prayertitle = $_POST['prayerTitle'];
	$prayertext = $_POST['prayerText'];

/* TESTING PRAYER LOG ENTRY SCRIPTS */
/*	$prayer_log = array();
*/
	$praymailfrom = "newprayer@ourfamilyconnections.org";
	$praymailto = $praymailfrom;
	$praymailheaders = "From:" . $praymailfrom . "\r\n" . "Bcc:" . $praymailfrom;
	$praymaillink = "https://trinityevangel.ourfamilyconnections.org";								
	$prayernotifyquery = "SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE new_prayer_notify = '1'";			
	$prayernotifyresult = @mysql_query($prayernotifyquery)or die("Prayer Notify function failed at db SELECT. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());
	$prayernotifyresultcount = @mysql_num_rows($prayernotifyresult);
/* TESTING PRAYER LOG ENTRY SCRIPTS */
/*	$log_count = 0;
*/
	while($prayernotifyrow = @mysql_fetch_assoc($prayernotifyresult)) {
		$praymailheaders .= ', ' . $prayernotifyrow['email_addr'];
/* TESTING PRAYER LOG ENTRY SCRIPTS */
/*		$prayer_log[] = array($log_count => $prayernotifyrow['email_addr');
		$log_count++;
*/
		}
/* TESTING PRAYER LOG ENTRY SCRIPTS */
/*	echo "<script type='text/javascript'>";
	echo "console.log('Prayer Log = ' + <?php echo '"' . $log_count . '"'; ?>);";
	echo "</script>";
*/	
	$praymailsubject = "New Prayer Request from " . $prayerfrom ."\n..";
	$praymailmessage = "(this message has been sent from an unmonitored mailbox)<br /><br />";
	$praymailmessage .= "Hello! " . "<br /><strong>" . $prayerfrom . "</strong> is requesting prayer.<br />Details are below...<br /><br />" . "<table><tr><td><strong>TITLE: </strong> " . $prayertitle . "</td></tr><tr><td><strong>REQUEST: </strong> " . $prayertext . "</td></tr></table><br /><br />Login to our website for more information<br />" . "<a href='" . $praymaillink . "'>" . $praymaillink . "</a>";
	$praymailheaders .= "\r\n"; 
	$praymailheaders .= "MIME-Version: 1.0\r\n";
	$praymailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	mail($praymailto,$praymailsubject,$praymailmessage,$praymailheaders);
}
else {
	echo "<script type='text/javascript'>";
	echo "alert('New Prayer Mailer failure. Contact the program admin for assistance.')";
	echo "</script>";
}	
/*
	}
*/

//		echo "$praymailto . ' ' . $praymailsubject . ' ' . $praymailmessage . ' ' . $praymailheaders";
//		echo "<script language='javascript'>";
//		echo "alert($praymailto . ' ' . $praymailsubject . ' ' . $praymailmessage . ' ' . $praymailheaders)";
//		echo "</script>";


?>