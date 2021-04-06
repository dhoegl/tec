<?php 
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tecwelcome.php");
	exit();
}

require_once('tec_dbconnect.php');
//include_once('/includes/newprayernotify.php');

// $verifyacceptcountdirysql_real_escape = 0;
$prayer_id = $_GET['prayerid'];

$newprayerquery = "SELECT * FROM $prayer_tbl_name p INNER JOIN $dir_tbl_name d on p.owner_id = d.idDirectory WHERE p.prayer_id = '$prayer_id' AND d.Status=1";
$newprayerresult = @mysql_query($newprayerquery) or die(" Prayer query error. Error:" . mysql_errno() . " " . mysql_error());

$row = @mysql_fetch_assoc($newprayerresult);
	if($row['approved']==0)
	{

		$recordID = $row['owner_id'];
		$prayerfrom = $row['name'];
		$prayertitle = mysql_real_escape_string($row['title']);
		$prayerdate = $row['create_date'];
		$prayertext = mysql_real_escape_string($row['prayer_text']);
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<link href="css/ofcstyle.css" rel="stylesheet" type="text/css" />
<title>Approve Prayer Request to Our Family Connections</title>

<!-- Load the jquery libraries -->
<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>

<!-- Listen for Accept click - then execute newprayernotify.php -->
<script type="text/javascript">
	$(document).ready(function() {
		$("#approvePrayer").click(function () {
		console.log("Prayer Approval initiated - notification email sending...");
		var $prayer_ID = <?php echo "'" . $prayer_id . "'"; ?>;
		var $record_ID = <?php echo "'" . $recordID . "'"; ?>;
		var $prayerDate = <?php echo "'" . $prayerdate . "'"; ?>;
		var $prayerFrom = <?php echo "'" . $prayerfrom . "'"; ?>;
		var $prayerTitle = <?php echo "'" . $prayertitle . "'"; ?>;
		var $prayerText = <?php echo "'" . $prayertext . "'"; ?>;
		console.log('Made it into Listen for Accept click script');

		var request = $.ajax({
			url: 'includes/newprayernotify.php',
			type: 'POST',
			dataType: 'json',
			data: { prayer_ID : $prayer_ID, recordID : $record_ID, prayerDate : $prayerDate, prayerFrom : $prayerFrom, prayerTitle : $prayerTitle, prayerText : $prayerText }
		});
		request.done(function () {
			alert('Prayer Request has been uploaded - church family has been notified');
			window.location.href= 'https://trinityevangel.ourfamilyconnections.org/tecprayeradmin.php';
		});
	});
});


</script>


</head>

<body>
<div id="container">
	<div id="header">

		<div id="header_text">
			<p>Bringing</p>
			<p>our Family</p>
			<p>Together</p>
		</div>
		<ul>
			<li> <a href='/tecwelcome.php'>Welcome</a></li>
<?php
	require_once('tecmenu.php');

?>

		</ul>
	</div>
	<div id="content">

	<div id="left">
			<h2>Approve Prayer Request</h2>
			<p>
			<h3>APPROVE this prayer?</h3>

<?php
		
	$submit = $_POST['submit'];
	$clear = $_POST['clear'];

	
if($clear)
	{
		header("location:tecprayeradmin.php");
//		echo "Clear was clicked";
	}
if ($submit)
	{
			$acceptquerydir = "UPDATE " . $_SESSION['prayertable'] . " SET approved = '1'" . " WHERE prayer_id = '$prayer_id'";			
			$acceptresultdir = @mysql_query($acceptquerydir)or die("A prayer request database error has occurred - UPDATE. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());

			$verifyacceptquerydir = "SELECT * FROM " . $_SESSION['prayertable'] . " WHERE prayer_id = '$prayer_id' and approved = '1'";

// Verify prayer approval - then send email notification
 
			$verifyacceptresultdir = @mysql_query($verifyacceptquerydir);
			$verifyacceptcountdir = @mysql_num_rows($verifyacceptresultdir);

			if($verifyacceptcountdir == 1)
				{
//					echo "<p id='approve_flag'>Approved</p>";
					echo "<script language='javascript'>";
					echo "alert('Approval completed')";
					echo "</script>";

// This synchronous script is causing delayed server response
// 					newprayernotify($prayer_id, $recordID, $prayerdate, $prayerfrom, $prayertitle, $prayertext);
//					header("location:tecprayeradmin.php");

// Detect Approve button click - send notification email (async)

				}
				else 
				{
					echo "<strong><font color='Red'>Approval failed</font></strong>";
				}
	}
?>

<form action="" method="POST">
	<table>
		<tr>
			<td class="key">From:</td>
			<td colspan="2" class="strong">
				<?php echo $prayerfrom ?>
			</td>
		</tr>
		<tr>
			<td class="key">Title:</td>
			<td colspan="2" class="strong"><?php echo $prayertitle ?></td>
		</tr>
		<tr>
			<td class="key">Date:</td>
			<td colspan="2" class="strong"><?php echo $prayerdate ?></td>
		</tr>
		<tr>
			<td>&nbsp</td>
		</tr>
		<tr>
			<td>
			<input type='submit' id="approvePrayer" class="button_flat_blue" name='submit' value="YES - Approve">
			</td>
			<td>&nbsp &nbsp</td>
			<td>
			<input type='submit' class="button_flat_blue" name='clear' value="NO - Cancel">
			</td>
		</tr>
	</table>
	<p>
	<br />
	

</form>
</div>

	<div id="right">
		<h2>Instructions</h2>
		<p>Click YES to approve this prayer request from Our Family Connections.</p> 
		<p style="color:red"><strong>Request will be immediately available on the Active Prayer page of our website.</strong></p>
		<p>Press NO to reject this request. <strong>NOTE: </strong> Request will remain in our database, but not publicly visible.</p>
		</div>
		<div id="footerline"></div>
	</div>
	
<?php
	require_once('/tecfooter.php');
?>

</div>
</body>
</html>
