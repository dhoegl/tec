<?php 
// Process new prayer request and upload to prayer table
// Updated 20210523
// Called from tec_myprayer.php (for prayer originator) and tec_prayeradmin.php (for prayer submital on behalf of user)
session_start();
if(!$_SESSION['logged in']) {
	header("location:../tec_welcome.php");
	echo "<script language='javascript'>";
	echo "console.log('Made it to tec_newprayer script');";
	echo "</script>";
	exit();
}
	require_once('../tec_dbconnect.php');
    // Event Log  trap
    require_once('../includes/event_logs_update.php');
	// Embed jquery script to enable prayer_request_to_sendmail.js
	echo "<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>";
	// Enable sendmail script to notify Admins re: register request
	echo "<script type='text/javascript' src='../js/prayer_request_to_sendmail.js'></script>";
	// Extract email theme elements from config.xml
	if (file_exists("../_tenant/Config.xml")) {
		$xml = simplexml_load_file("../_tenant/Config.xml");
		$themename = $xml->customer->name;
		$themedomain = $xml->customer->domain;
		$themetitle = $xml->customer->hometitle;
		$themecolor = $xml->customer->banner_color;
		$themeforecolor = $xml->customer->banner_forecolor;
	} else {
		echo "<script language='javascript'>";
		echo "console.log('Failed to open ../_tenant/Config.xml');";
		echo "</script>";
		// exit("Failed to open ../_tenant/Config.xml.");
	}    

	if(isset($_POST['submitnewprayer'])) 
	{
		// Process new Prayer Request: 
		$LoginID = $_SESSION['user_id'];
		$prayer_owner = $_POST['requestorID'];
		$prayer_name = $_POST['fullname'];
		$prayer_onbehalfof = $_POST['onbehalfof'];
// convert to ensure copy/paste doesn't expose special characters
		$prayer_onbehalfof = mb_convert_encoding($prayer_onbehalfof, "UTF-8"); 
		$prayer_email_from = $_POST['email'];
		$prayer_visible = $_POST['visible'];
		$prayer_praise = $_POST['praypraise'];
		$prayer_title = $_POST['praytitle'];
		$prayer_text = $_POST['praytext'];
		$prayer_title = mb_convert_encoding($prayer_title, "UTF-8"); // convert to ensure copy/paste doesn't expose special characters
		$prayer_text = mb_convert_encoding($prayer_text, "UTF-8"); // convert to ensure copy/paste doesn't expose special characters
		// If PrayerAdmin sends out a prayer request, use On Behalf Of as the name of the prayer requestor 
		if($prayer_onbehalfof) {
			$prayer_name = $prayer_onbehalfof;
		}
		$newprayerquery = "INSERT INTO " . $_SESSION['prayertable'] . "(owner_id, name, title, pray_praise, visible, prayer_text) VALUES (?,?,?,?,?,?)";
		$newprayerupdate = $mysql->prepare($newprayerquery);
		$newprayerupdate->bind_param("ssssss",$prayer_owner,$prayer_name,$prayer_title,$prayer_praise,$prayer_visible,$prayer_text);
		$newprayerupdate->execute();
		// Get Prayer ID from above Insert
		$newprayerID = $mysql->insert_id;
		echo "<script language='javascript'>";
		echo "console.log('New Prayer Request ID = " . $newprayerID . "');";
		echo "</script>";
		if($newprayerupdate->error) {
			echo " SQL query New Prayer submit error. Error:" . $newprayerupdate->errno . " " . $newprayerupdate->error;
		}
		else {
			eventLogUpdate('prayer', "UserID: " .  $prayer_owner, "New Prayer Request submitted", "PrayerID: " . $newprayerID);
			if($prayer_visible == '3') //All Church
			{
			// send prayer request email to administrators for approval
			echo "
				<script type='text/javascript'>
				prayerrequestnew('$prayer_email_from', '$prayer_owner', '$prayer_name', '$LoginID', '$themename', '$themedomain', '$themetitle', '$themecolor', '$themeforecolor');
				</script>
		    ";

			

			// $praymailadmins = @mysql_query("SELECT admin_email FROM " . $_SESSION['admintablename'] . " WHERE prayernotify = '1'");
			// $praymailadmins = @mysql_query("SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE admin_praynotify = '1'");
			// $praymaillink = "https://trinityevangel.ourfamilyconnections.org";								
			// while($praymailrow = @mysql_fetch_assoc($praymailadmins))
			// 	{
			// 		$praymailtest = $praymailrow['email_addr'];									
			// 		$praymailto = $praymailtest . " , " . $praymailto;
			// 	}									
			// $praymailsubject = "Prayer Request submitted to Our Family Connections"."\n..";
			// $praymailmessage = "Hello! " . "<br /><strong>" . $prayer_name . "</strong> has requested approval to post a prayer request.<br /><br />Login to our site using your admin credentials, select the " . "<strong>Prayer Admin</strong>" . " menu item, and accept or reject their prayer request. <br />Details are below...<br />" . $praymaillink . "<br /><br /><strong>TITLE: </strong> " . $prayer_title . "<br /><br /><strong>REQUEST: </strong>" . $prayer_text . "." . "<br /><br />To send an email directly, use the following address:<br /><br />" . $prayer_email_from;
			// $praymailfrom = "prayerrequest@ourfamilyconnections.org";
			// $praymailheaders = "From:" . $praymailfrom . "\r\n";
			// $praymailheaders .= "MIME-Version: 1.0\r\n";
			// $praymailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			// mail($praymailto,$praymailsubject,$praymailmessage,$praymailheaders);

			/* send prayer request email to requester */
			// if($prayer_email_from) { // If new prayer request is created by Admin, do not send an email to requester
			// 	$praymaillink = "https://trinityevangel.ourfamilyconnections.org";								
			// 	$praymailto = $prayer_email_from;		
			// 	$praymailsubject = "Your Request has been submitted for approval"."\n..";
			// 	$praymailmessage = "(this message has been sent from an unmonitored mailbox)<br /><br />";
			// 	$praymailmessage .= "Hello " . "<br /><strong>" . $prayer_name . "</strong>!";
			// 	$praymailmessage .= "<br /><br />Your request has been submitted to our administrators for approval before it is available for viewing.<br />Please allow time for approval before it shows up on our site.";
			// 	$praymailmessage .= "<br /><br />You will receive an email when your prayer request has been approved. Login to our site to view it.<br /><br /><strong>TITLE: </strong> " . $prayer_title . "<br /><br /><strong>REQUEST: </strong>" . $prayer_text . ".";
			// 	$praymailfrom = "no-reply@ourfamilyconnections.org";
			// 	$praymailheaders = "From:" . $praymailfrom . "\r\n";
			// 	$praymailheaders .= "MIME-Version: 1.0\r\n";
			// 	$praymailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			// 	mail($praymailto,$praymailsubject,$praymailmessage,$praymailheaders);
			// }
			}
			if($prayer_visible == '1') //Elders Only
			{
				/* send prayer request to all Elders */
				// $elderpraymail = @mysql_query("SELECT * FROM " . $_SESSION['logintablename'] . " WHERE elder = 'Y'");
				// $elderpraylink = "https://trinityevangel.ourfamilyconnections.org";								
				// while($elderprayrow = @mysql_fetch_assoc($elderpraymail))
				// 	{
				// 		$elderpraytest = $elderprayrow['email_addr'];									
				// 		$elderprayto = $elderpraytest . " , " . $elderprayto;
				// 	}									
				// $elderpraysubject = "Prayer Request to Elders"."\n..";
				// $elderpraymessage = "Hello Elders! " . "<br /><strong>" . $prayer_name . "</strong> has sent you a prayer request with the following details.<br /><br /><strong>TITLE:</strong> " . $prayer_title . "<br />" . $prayer_text . "." . "<br /><br />To send an email response, use the following email address:<br /><br />" . $prayer_email_from;
				// $elderprayfrom = "elderprayer@ourfamilyconnections.org";
				// $elderprayheaders = "From:" . $elderprayfrom .  "\r\n";
				// $elderprayheaders .= "MIME-Version: 1.0\r\n";
				// $elderprayheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				// mail($elderprayto,$elderpraysubject,$elderpraymessage,$elderprayheaders);
			}
		}
	}
	$mysql -> close();
	switch($prayer_visible) {
		case "3":
			echo "<script language='javascript'>";
			echo "alert('Your Prayer Request has been submitted. Once approved by our church elders, it will be posted for your church family to view and follow.');";
			echo "window.location = '../tec_myprayer.php';";
			echo "</script>";
			break;
		case "1":
			echo "<script language='javascript'>";
			echo "alert('Your Prayer Request has been sent to our church elders. Someone will get back to you shortly. Please watch your email.');";
			echo "window.location = '../tec_myprayer.php';";
			echo "</script>";
			break;
		default:
		echo "<script language='javascript'>";
		echo "alert('Unknown prayer request visibility. Please re-submit your request');";
		echo "window.location = '../tec_myprayer.php';";
		echo "</script>";
	}
// echo "<script language='javascript'>";
// echo "alert('Bad request to new prayer request script. Alert your Ourfamilyconnections admin with this error message.');";
// echo "window.location = '../tec_myprayer.php';";
// echo "</script>";
// header("location:../tec_myprayer.php");
?>

