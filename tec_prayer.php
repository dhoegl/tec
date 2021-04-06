<?php 
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tecwelcome.php");
	exit();
}

   require_once('tec_dbconnect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
	<link href="css/ofcstyle.css" rel="stylesheet" type="text/css" />
	<title>TEC - Active Prayer Log</title>
<head>

<!-- Load the jquery libraries -->
<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>

<!-- Popup script from http://dev.vast.com/jquery-popup-overlay/ -->
<script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js"></script>

<!--*******************************DataTables stylesheet data**************************************-->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->

<?php
// Get User Login details
   include('/includes/tec_get_loggedinuser.php');

// Get Active Prayer List
   include('/includes/tec_view_activeprayerlist.php');
   
// Get Active Prayer jQuery
   include('/includes/tec_get_activeprayer_jquery.php');
   
?>


<!-- Process the Prayer 'Follow' and 'Unfollow' buttons click action -->
 <script type="text/javascript">
	var jQ20 = jQuery.noConflict();
	jQ20(document).ready(function() {

// Follow button
	jQ20("#follow_button").click(function () {
		console.log("prayerFollow button was pressed for " + $clickbuttonid + ": I am this user " + $loggedusername + " with ID = " + $loggedidDirectory);
		var $followselect = 'follow';
		var request = jQ20.ajax({
		url: 'tec_update_follow_table.php',
		type: 'POST',
		dataType: 'json',
		data: { followselect: $followselect, followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory}
		});

// Check if prayer is being followed by user - Show/Hide the Follow/Unfollow buttons
		var checkfollow = 'tec_check_follow_table.php';
			jQ20.getJSON(checkfollow, {followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory
			}, function (data) {
				console.log(data);
				console.log("Data Message = " + data.followmessage);
			jQ20.each(data.followmessage, function (i, rep) {
				if ('yes' === rep.Message.toLowerCase()) {
					console.log("YES is the response");
					jQ20("#follow_button").hide();
					jQ20("#unfollow_button").show();
				};
				if ('no' === rep.Message.toLowerCase()) {
					console.log("NO is the response");
					jQ20("#follow_button").show();
					jQ20("#unfollow_button").hide();
				}
			});
		});

	});

// Unfollow button
	jQ20("#unfollow_button").click(function () {
		console.log("prayerFollow button was pressed for " + $clickbuttonid + ": I am this user " + $loggedusername + " with ID = " + $loggedidDirectory);
		var $followselect = 'unfollow';
		var request = jQ20.ajax({
		url: 'tec_update_follow_table.php',
		type: 'POST',
		dataType: 'json',
		data: { followselect: $followselect, followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory}
		});

// Check if prayer is being followed by user - Show/Hide the Follow/Unfollow buttons
		var checkfollow = 'tec_check_follow_table.php';
			jQ20.getJSON(checkfollow, {followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory
			}, function (data) {
				console.log(data);
				console.log("Data Message = " + data.followmessage);
			jQ20.each(data.followmessage, function (i, rep) {
				if ('yes' === rep.Message.toLowerCase()) {
					console.log("YES is the response");
					jQ20("#follow_button").hide();
					jQ20("#unfollow_button").show();
				};
				if ('no' === rep.Message.toLowerCase()) {
					console.log("NO is the response");
					jQ20("#follow_button").show();
					jQ20("#unfollow_button").hide();
				}
			});
		});
	});
});
</script>

<!-- Process the Send Email buttons click action -->
<!-- Process the Send Email buttons click action -->
 <script type="text/javascript">
	var jQ30 = jQuery.noConflict();
	jQ30(document).ready(function() {

// Send Email using client email application
// NOTE: If nothing is returned from tec_get_prayer_email_address, script will fail - temporarily 'by design' until conditions are established to disable or hide Send Mail button
	jQ30("#sendMail").click(function () {
		console.log("Send Email button clicked");
		var sendaddress = 'tec_get_prayer_email_address.php';
		jQ30.getJSON(sendaddress, {prayerID: $clickbuttonid
		}, function (data) {
			console.log(data);
			jQ30.each(data.prayerdata, function (i, rep) {
			console.log("Prayer ID: " + rep.prayerid);
			console.log("Prayer owner email: " + rep.prayeremail);
			window.location.href = "mailto:" + rep.prayeremail + "?subject=Praying for you!";
			});
		});
    });
});

</script>


<!-- Get Which Prayer Item's 'Details' button was clicked -->
 <script type="text/javascript">
var $clickbuttonid = "NA";
var jQ9 = jQuery.noConflict();
jQ9(document).ready(function () {
	jQ9("#activeprayertable tbody").on("click", 'tr', function () {
		var prayerID = jQ9(this).closest('tr').find(".indexcol").text();
		$clickbuttonid = prayerID;
		console.log("$clickbuttonid (this jQ9 entry) = " + $clickbuttonid);
		var prayerDate = jQ9(this).closest('tr').find(".prayer_update").text();
		var prayerAnswer = jQ9(this).closest('tr').find(".prayer_answer").text();
		var prayerWho = jQ9(this).closest('tr').find(".prayer_who").text();
		var prayerTitle = jQ9(this).closest('tr').find(".prayer_title").text();
		var prayerType = jQ9(this).closest('tr').find(".type").text();
		var prayerText = jQ9(this).closest('tr').find(".full_text").text();
// Check if prayer has been answered - disable follow/unfollow buttons if true
		jQ9("#follow_button").hide();
		jQ9("#unfollow_button").hide();
		console.log("prayerAnswer = " + prayerAnswer);
		console.log("loggedidDirectory = " + $loggedidDirectory);
		if (prayerAnswer != 'Answered' && $loggedidDirectory < 20000) {
// Check if prayer is being followed by user - Show/Hide the Follow/Unfollow buttons
			console.log("Inside prayerAnswer check routing");
			console.log("followprayerID = " + $clickbuttonid);
			console.log("followprayerWho = " + $loggedusername);
			console.log("followprayerDir = " + $loggedidDirectory);
			var checkfollow = 'tec_check_follow_table.php';
				jQ9.getJSON(checkfollow, {followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory
				}, function (data) {
					console.log(data);
					console.log("Data Message = " + data.followmessage);
				jQ9.each(data.followmessage, function (i, rep) {
					if ('yes' === rep.Message.toLowerCase()) {
						console.log("YES is the response");
						jQ9("#follow_button").hide();
						jQ9("#unfollow_button").show();
					};
					if ('no' === rep.Message.toLowerCase()) {
						console.log("NO is the response");
						jQ9("#follow_button").show();
						jQ9("#unfollow_button").hide();
					};
				});
			});
		};
	});
});

</script>

<!-- Detect 'Details' button click -->
<script type="text/javascript">
 var jQ4 = jQuery.noConflict();
	jQ4(document).ready(function() {
		jQ4("#activeprayertable").on("click", "button", function () {
	var prayerDate = jQ4(this).closest('tr').find(".prayer_update").html();
	var prayerWho = jQ4(this).closest('tr').find(".prayer_who").html();
	});
// Launch Active Prayer Popup
// http://dev.vast.com/jquery-popup-overlay/
	jQ4("#my_popup").popup({
		background: true, focusdelay: 400, transition: 'all 0.3s', vertical: 'top', outline: true, keepfocus: true, blur: false, color: "#D1E0B2",
		onopen: function () {
			var prayerDate = jQ4(this).closest('tr').find(".prayer_update").html();
		}
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
			<li> <a href='/tecwelcome.php'>Home</a></li>
<?php
	require_once('tecmenu.php');

?>
		</ul>
	</div>

<div id="content">

<div id="prayerlogleft">
			<br>
			<h2>Active Prayer Requests</h2>
			<hr>
	<table id="profiletableleftprayer">
	<tr>
	<td class="headerdetail">How do I use this prayer list?</td>
	</tr>
	<tr>
		<td class="headercontent">
			<strong>Click on &quotDetails&quot to</strong>
		</td>
	</tr>
	<tr>
		<td class="headercontent">
			View more details about this prayer request		
		</td>
	</tr>
	<tr>
		<td class="headercontent">
			Follow this prayer request to receive updates and/or answers to it in email		
		</td>
	</tr>
	<tr>
		<td class="headercontent">
			Let the person know you care by sending an email		
		</td>
	</tr>
	<tr>
		<td class="headercontent">
			<br>
		</td>
	</tr>
	</table>




<table id="activeprayertable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Opened</th>
                <th>Family Member</th>
                <th>Type</th>
                <th>Answered</th>
                <th>Quick Glance</th>
                <th>Details</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>id</th>
                <th>Opened</th>
                <th>Family Member</th>
                <th>Type</th>
                <th>Answered</th>
                <th>Quick Glance</th>
                <th>Details</th>
            </tr>
        </tfoot>
    </table>
<p></p>
<p></p>
<p></p>
</div>
	<div id="footerline"></div>
	</div>
	
<?php
	require_once('/tecfooter.php');
?>

</div>


<!-- ************************************* -->
<!-- View Prayer Details OVERLAY dialog            -->
<!-- ************************************* -->
 <div id="my_popup">
	<h2>View Prayer Request Details</h2>
        <br />
        <br />
        <h3>View the details of this prayer request.</h3>
        <br />
        <hr>
			<form name='form1' method='post' action=''> 		
				<table id="praytable" style="border: 3px solid powderblue;" width="100%" align='left' cellpadding='0' cellspacing='1' border="0">
					<tr class="praytable_even">
						<td colspan="1"><strong>Type: </strong></td>
						<td colspan="2" class="praypraise"> </td>
						<td align="right" colspan="1"><strong>Answered: </strong></td>
						<td align="center" colspan="1" class="prayanswer"> </td>
					</tr>
					<tr class="praytable_odd">
						<td colspan="1"><strong>Date: </strong></td>
						<td colspan="4" class="praydate"> </td>
					</tr>
					<tr class="praytable_even">
						<td colspan="1"><strong>From: </strong></td>
						<td colspan="4" class="praywho"> </td>
					</tr>
					<tr class="praytable_odd">
						<td colspan="1"><strong>Title: </strong></td>
						<td colspan="4" class="praytitle"> </td>
					</tr>
					<tr>
						<td colspan="5">
						<hr />
						</td>
					</tr>
				</table>
				<table style="border: 3px solid powderblue;" width="100%" align='left' cellpadding='0' cellspacing='1' border="0">
					<tr class="praytable_text">
						<td colspan="4">
							<div class="praytext" style="height: 200px; overflow: auto; white-space: pre-wrap;"></div>
						</td>
					</tr>
					<tr>
						<td>
 						</td>
 					</tr>
				</table>
				<table width="100%" align='left' cellpadding='0' cellspacing='1' border="0">
					<tr class="praytable_buttons" style="border: 1px;">
   		 			<td align="left"><input type="button" class="button_flat_blue_small" id="sendMail" name="sendMail" value="Send Email" /></td>
   		 			<td align="left"><input type="button" class="button_flat_blue_small" id="unfollow_button" name="unfollow" value="Unfollow" /></td>
   		 			<td align="left"><input type="button" class="button_flat_blue_small" id="follow_button" name="follow" value="Follow" /></td>
   		 			<td align="right"><input type="button" class="my_popup_close button_flat_blue_small" name="cancel" value="Close" /></td>
  		 		 	</tr>
 		 		 	<tr>
 		 		 	</tr>
	 		 		 	<p>
 			 		 	<p>
				</table>
 			</form>
			
			<br />

</div>
</body>
</html>
