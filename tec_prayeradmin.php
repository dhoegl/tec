<?php 
//Last Updated 05/28/2021: Admin accept/reject script for prayer requests
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
$sessname = session_name();
$sessid = session_id();
$profileID = $_SESSION['idDirectory'];
require_once('tec_dbconnect.php');


//Query for users requesting to register but not yet approved
// $sqlquery = "SELECT * FROM " . $_SESSION['logintablename'] . " WHERE active = 0";
// $result = $mysql->query($sqlquery) or die("A database error occurred when trying to select registrants for Dir and Login Table. See tec_regadmin.php. Error : " . $mysql->errno . " : " . $mysql->error);

// Mysql_num_row is count of table rows returned. Expect at least 1
// $count = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- BOOTSTRAP 4 - Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >
    <title></title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/MDBootstrap4191/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
    <!-- Test custom styles (Includes tec style details) -->
    <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">

    <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


    <!-- Call Moment js for date calc functions -->
    <script src="js/moment.js"></script>
    <!-- JQuery -->
    <!-- <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.1.0.min.js"></script>



<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->

<?php
// Get Unapproved Prayer List
   include('/includes/tec_view_unapprovedprayerlist.php');
   
// Get Unapproved Prayer jQuery
//    include('/includes/tec_get_unapprovedprayer_jquery.php');

// Get All Prayer List
//    include('/includes/tec_view_allprayerlist.php');
   
// Get All Prayer jQuery
//    include('/includes/tec_get_allprayer_jquery.php');
   
?>

<!--***************************** New Prayer Scripts ***********************************-->
<!--***************************** New Prayer Scripts ***********************************-->

<!-- Detect 'New Prayer' button click -->
<script type="text/javascript">
 var $firstname = + <?php echo "'" . $_SESSION['firstname'] . "'"; ?>;
 var jQ4 = jQuery.noConflict();
	jQ4(document).ready(function() {
//		jQ4("#prayer_new_button").on("click", "button", function () {
		jQ4("#prayer_new_button").click(function () {
			console.log("New Prayer Button clicked");
			console.log("Session First Name = " + $firstname);
// Launch New Prayer Popup
// http://dev.vast.com/jquery-popup-overlay/
		jQ4("#my_popup").popup({
		background: true, focusdelay: 400, transition: 'all 0.3s', vertical: 'top', outline: true, keepfocus: true, blur: false, color: "#D1E0B2",
		onopen: function () {
			console.log("Popup Opened for New Prayer");
		}
		});
	});
 });
</script>


<!-- Get Which Prayer Item's 'View' button was clicked -->
 <script type="text/javascript">
var $clickbuttonid = "NA";
var jQ9 = jQuery.noConflict();
jQ9(document).ready(function () {
	jQ9("#unapprovedprayertable tbody").on("click", 'tr', function () {
		jQ9("tr.praytable_even").show();
		jQ9("tr.praytable_odd").show();
		jQ9("tr.praytable_text").show();
		jQ9("#updatePrayer").show();
		var prayerID = jQ9(this).closest('tr').find(".indexcol").text();
		$clickbuttonid = prayerID;
		console.log("$prayerid clicked = " + $clickbuttonid);
		var prayerDate = jQ9(this).closest('tr').find(".prayer_update").text();
		var prayerWho = jQ9(this).closest('tr').find(".prayer_who").text();
		var prayerTitle = jQ9(this).closest('tr').find(".prayer_title").text();
		var prayerType = jQ9(this).closest('tr').find(".prayer_type").text();
		var prayerText = jQ9(this).closest('tr').find(".full_text").text();
// Launch Unapproved Prayer Popup
	jQ9("#my_popup2").popup({
		background: true, outline: true, keepfocus: true, blur: false, color: "#D1E0B2",
		});
	});
});

</script>

<!-- Get Which Prayer Item's 'Approve' button was clicked -->
 <script type="text/javascript">
var $approveclickbuttonid = "NA";
var $approveURL = "NA";
var jQ10 = jQuery.noConflict();
jQ10(document).ready(function () {
	jQ10("#unapprovedprayertable tbody").on("click", '.prayer_approve_button', function () {
		var prayerID = jQ10(this).closest('tr').find(".indexcol").text();
		$approveclickbuttonid = prayerID;
		console.log("$approve prayerid clicked = " + $approveclickbuttonid);
		var prayerWho = jQ10(this).closest('tr').find(".prayer_who").text();
		var prayerTitle = jQ10(this).closest('tr').find(".prayer_title").text();
		$approveURL = "tecnewprayeraccept.php?prayerid=" + $approveclickbuttonid;
		console.log("approveURL = " + $approveURL);
//		window.open($approveURL);
		window.location.href = $approveURL;
	});
});

</script>

<!-- Get Which Prayer Item's 'Reject' button was clicked -->
 <script type="text/javascript">
var $rejectclickbuttonid = "NA";
var $rejectURL = "NA";
var jQ11 = jQuery.noConflict();
jQ11(document).ready(function () {
	jQ11("#unapprovedprayertable tbody").on("click", '.prayer_reject_button', function () {
		var prayerID = jQ11(this).closest('tr').find(".indexcol").text();
		$rejectclickbuttonid = prayerID;
		console.log("$reject prayerid clicked = " + $rejectclickbuttonid);
		var prayerWho = jQ11(this).closest('tr').find(".prayer_who").text();
		var prayerTitle = jQ11(this).closest('tr').find(".prayer_title").text();
		$rejectURL = "tecnewprayerreject.php?prayerid=" + $rejectclickbuttonid;
		console.log("rejectURL = " + $rejectURL);
//		window.open($rejectURL);
		window.location.href = $rejectURL;
	});
});

</script>

<!-- Process the Send Email buttons click action -->
<!-- Process the Send Email buttons click action -->
 <script type="text/javascript">
	var jQ30 = jQuery.noConflict();
	jQ30(document).ready(function() {

// Send Email using client email application
	jQ30("#sendMail").click(function () {
		console.log("Send Email button clicked");
		var sendaddress = 'tec_get_prayer_email_address.php';
		jQ30.getJSON(sendaddress, {prayerID: $clickbuttonid
		}, function (data) {
			console.log(data);
			jQ30.each(data.prayerdata, function (i, rep) {
			console.log("Prayer ID: " + rep.prayerid);
			console.log("Prayer owner email: " + rep.prayeremail);
			window.location.href = "mailto:" + rep.prayeremail + "?subject=About your prayer request...";
			});
		});
    });
});

</script>

<!--***************************** Update Prayer Requests ***********************************-->
<!--***************************** Update Prayer Requests ***********************************-->
<!--***************************** Update Prayer Requests ***********************************-->

<!-- Detect 'Update Prayer' button click -->
<script type="text/javascript">
 var jQ50 = jQuery.noConflict();
	jQ50(document).ready(function() {
				jQ50("#church_prayer_button").click(function () {
				console.log("Update Church Prayer Button clicked");
				jQ50("tr.praytable_even").hide();
				jQ50("tr.praytable_odd").hide();
				jQ50("tr.praytable_text").hide();
				jQ50("#updatePrayer").hide();
// Launch Church Prayer Popup
// http://dev.vast.com/jquery-popup-overlay/
		jQ50("#my_popup4").popup({
		background: true, focusdelay: 400, transition: 'all 0.3s', vertical: 'top', autozindex: true, outline: true, keepfocus: true, blur: false, color: "#D1E0B2",
		onopen: function () {
			console.log("Popup4 Opened for Update Church Prayer");
		}
		});
	});
});
</script>



<!-- Get Which Prayer Items 'Update' button was clicked -->
 <script type="text/javascript">
var $clickbuttonid = "NA";
var prayerWho = "NA";
var prayerTitle = "NA";
var jQ109 = jQuery.noConflict();
jQ109(document).ready(function () {
	jQ109("#allprayertable tbody").on("click", 'tr', function () {
		var prayerID = jQ9(this).closest('tr').find(".indexcol").text();
		$clickbuttonid = prayerID;
		console.log("$clickbuttonid (jQ9) = " + $clickbuttonid);
		var prayerDate = jQ109(this).closest('tr').find(".prayer_update").text();
		prayerWho = jQ109(this).closest('tr').find(".prayer_who").text();
		prayerTitle = jQ109(this).closest('tr').find(".prayer_title").text();
		var prayerType = jQ109(this).closest('tr').find(".type").text();
		var prayerText = jQ109(this).closest('tr').find(".full_text").text();
	});
});

</script>

<!-- Detect 'Update' button click to open my_popup3 -->
<script type="text/javascript">
 var jQ51 = jQuery.noConflict();
	jQ51(document).ready(function() {
		jQ51("#updatePrayer").click(function () {
	console.log("Update button clicked to open my_popup3 - $clickbuttonID (jQ51) = " + $clickbuttonid);
	jQ51(".my_popup3title").text(" " + prayerTitle);
	jQ51("#updatetext").val('');
// Launch Update Prayer Popup
// http://dev.vast.com/jquery-popup-overlay/
		jQ51('#my_popup3').popup({
		background: true, focusdelay: 400, transition: 'all 0.3s', vertical: 'top', autozindex: true, outline: true, keepfocus: true, blur: false, color: "#D1E0B2",
		onopen: function () {
			console.log("Popup3 Opened for Update");
		}
		});
	});
 });
</script>

<!-- Detect 'Send' update button click -->
<script type="text/javascript" >
var jQ152 = jQuery.noConflict();
	jQ152(document).ready(function() {
		jQ152("#submitUpdate").click(function () {
			var $idDirectory = "<?php echo $_SESSION['idDirectory'] ?>";
			var $fullname = "<?php echo $_SESSION['fullname'] ?>";
			$answered = jQ152('input[name=answered]:checked', '#updateprayerform').val();
			var $updatetext = jQ152('#updatetext').val();
			console.log("title = " + prayerTitle);
			console.log("answered = " + $answered);
			console.log("updatetext = " + $updatetext);
			console.log("prayerID = " + $clickbuttonid);
			console.log("idDirectory = " + $idDirectory);
			console.log("fullname = " + $fullname);
			var submitUpdate = jQ152.ajax({
			url: 'tecupdateprayer_admin.php',
			type: 'POST',
			dataType: 'json',
			data: { requestorID : $idDirectory, fullname : $fullname, prayerID : $clickbuttonid, answered : $answered, requesttitle : prayerTitle, updatetext : $updatetext}
		});
		jQ152("input[name=answered]").prop('checked', function () {
			return this.getAttribute('checked') == 'checked';
		});
		jQ152("#updatetext").val('');
		jQ152("tr.praytable_even").hide();
		jQ152("tr.praytable_odd").hide();
		jQ152("tr.praytable_text").hide();
		jQ152("#updatePrayer").hide();

	});
});

</script>


</head>

<body>
    <!--Navbar-->
    <?php
    $activeparam = '11'; // sets nav element highlight
    require_once('tec_nav.php');
    require_once('includes/tec_footer.php');
    ?>
    <!-- Intro Section -->
    <div class="container-fluid profile_bg bottom-buffer">
    <!--<div class="container-fluid bottom-buffer" id="backsplash">-->
        <div class="row pt-2">
            <div class="col-sm-12">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Using the Prayer Admin page
                </button>
            </div><!-- col sm-12 -->
        </div><!-- row -->
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">
                            Click on the
                            <span class="btn btn-primary">View</span> button to view the entire prayer request
                        </h4>
                        <ul class="card-text">
                            <li>You can send an email to the registration request originator directly from your email client when it pops up</li>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-6 -->
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Approving and Rejecting Prayer Requests</h4>
                        <ul class="card-text">
                            <li>
                                Click on
                                <span class="btn btn-success">Approve</span> to approve the prayer request. The request will immediately be visible on the Prayer page.
                            </li>
                            <li>
                                Click on
                                <span class="btn btn-danger">Reject</span> to reject the prayer request. The request will remain in our database, but flagged as rejected and will no longer be visible or accessible.
                            </li>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-6 -->
            </div><!-- row -->
        </div><!-- collapse -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card bg-light border-primary px-2 my-2 w-100">
                    <div class="card-body">
                        <div class="table-responsive-xs">
							<table id="unapprovedprayertable" class="display" cellpadding="0" cellspacing="0" border="0">
								<thead class="table-dark">
									<tr>
										<th class="dtr-prayeradmincolumn"></th>
										<th>ID</th>
										<th>Date</th>
										<th>From</th>
										<th>Type</th>
										<th>Title</th>
										<th>Approve</th>
										<th>Reject</th>
										<th>View</th>
										<th>Text</th>
									</tr>
								
								</thead>
								<tfoot class="table-dark">
									<tr>
										<th class="dtr-prayeradmincolumn"></th>
										<th>ID</th>
										<th>Date</th>
										<th>From</th>
										<th>Type</th>
										<th>Title</th>
										<th>Approve</th>
										<th>Reject</th>
										<th>View</th>
										<th>Text</th>
									</tr>
								</tfoot>
							</table>
						</div> <!-- table-responsive -->
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col-sm-12 -->
        </div> <!-- Row -->
	</div> <!-- Container -->

<!--***************************** Create new Prayer Request POPUP ***********************************-->
<!--***************************** Create new Prayer Request POPUP ***********************************-->
<!--***************************** Create new Prayer Request POPUP ***********************************-->
<div id="my_popup">
	<h2>New Prayer Request</h2>
        <br />
        <br />
        <h3>Enter details about this prayer request and click Send</h3>
        <br />
        <br />
		<form name='newprayerform' method='post' action='tecnewprayer.php'> 		
        <table id="praytable" style="border: 3px solid powderblue;" width="100%" align="left" cellpadding="0" cellspacing="1" border="0">
 		 		 <tr>
 		 		 	<td><input type="hidden" name='visible' value='3'></input></td>
 		 		 </tr>
				<tr>
					<td>&nbsp</td>
					<td>&nbsp</td>
				</tr>
	 			<tr>
	 		 		<td width='25%' align='right'><strong>On Behalf of:</strong></td>
	 		 		<td width='75%'><input name='onbehalfof' type='text' id='onbehalfof' size="40"></td>
	 			</tr>
				<tr>
					<td>&nbsp</td>
					<td>&nbsp</td>
				</tr>
				<tr>
					<td align="right"><strong>Praise :</strong></td> 		 		 
					<td><input type="radio" name="prayer" value="Prayer" checked="checked">Prayer</input></td> 		 		 
 		 		</tr>
 		 		 <tr>
 		 		 	<td width="25%">&nbsp</td>
 		 		 	<td><input type="radio" name="prayer" value="Praise">Praise</input></td>
 		 		 </tr>
        </table>
			<table id="praytable" style="border: 3px solid powderblue;" width="100%" align="left" cellpadding="0" cellspacing="1" border="0" >
	 			<tr>
	 		 		<td><br /></td>
	 			</tr>
	 			<tr>
	 		 		<td width='25%' align='right'><strong>Title:</strong></td>
	 		 		<td width='75%'><input name='requesttitle' type='text' id='requesttitle' size="40"></td>
	 			</tr>
	 			<tr>
	 				<td>&nbsp</td>
	 			</tr>
	 			<tr>
	 		 		<td width='25%' align='right'><strong>Details:</strong></td>
	 		 		<td><textarea name="requesttext" rows="6" cols="40" ></textarea>
	 			</tr>
	 			<tr>
	 				<td>&nbsp</td>
<?php				
					$fullname = $_SESSION['firstname'] . " " . $recordLast; 
 					echo "<td><input type='hidden' name='fullname' value= '" . $fullname . "' /></td>";
					if($_SESSION['gender'] == 'M') 
					{
	 					echo "<td><input type='hidden' name='email' value= '" . $recordEmail1 . "' /></td>";
	 				}
	 				else //SESSION = F 
	 				{
 						echo "<td><input type='hidden' name='email' value= '" . $recordEmail2 . "' /></td>";
 					}
?>
	 			</tr>
	 			<tr>
<!-- 	 		 		<td>&nbsp</td>
 -->
<?php	 		
 					
 					echo "<td><input type='hidden' name='requestorID' value= '" . $_SESSION['idDirectory'] . "' /></td>";
?>
				</tr>
			</table>
			<table>
				<tr>
					<td align="right"><input type="submit" class="button_flat_blue_small" name='submitrequest' value='Send' /></td>
	 		 		<td width='25%' align="right"><input type="reset" class="my_popup_close button_flat_blue_small" name="cancel" value="Cancel" /></td>
	 			</tr>
	 			<tr>
	 				<td>&nbsp</td>
	 			</tr>
	 			<tr>
	 				<td colspan="3" align="center">New prayer requests from this page require Elder approval.<br />Once sent, click on Prayer Admin tab to approve.<br />Church family will be notified as soon as it's approved.</td>
	 			</tr>   
 		 	</table>
		</form>
<br />
</div>

<!-- ************************************* -->
<!-- View Prayer Details POPUP dialog            -->
<!-- ************************************* -->
 <div id="my_popup2">
	<h2>Prayer Request Details</h2>
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
							</tr>
							<tr class="praytable_odd">
								<td colspan="1"><strong>Date: </strong></td>
								<td colspan="2" class="praydate"> </td>
							</tr>
							<tr class="praytable_even">
								<td colspan="1"><strong>From: </strong></td>
								<td colspan="2" class="praywho"> </td>
							</tr>
							<tr class="praytable_odd">
								<td colspan="1"><strong>Title: </strong></td>
								<td colspan="2" class="praytitle"> </td>
							</tr>
							<tr>
								<td colspan="3">
									<hr />
								</td>
							</tr>
			</table>
			<table style="border: 3px solid powderblue;" width="100%" align='left' cellpadding='0' cellspacing='1' border="0">
							<tr class="praytable_text">
								<td colspan="5">
									<div class="praytext" style="height: 200px; overflow: auto; white-space: pre-wrap;"></div>
								</td>
							</tr>
							<tr>
								<td>
 								</td>
 							</tr>
			</table>
	      <table width="100%" align="left" cellpadding="0" cellspacing="1" border="0">
 		 		 			<tr class="praytable_buttons" style="border: 1px;">
<!-- 		 		 		 		<td width="100"></td>
  		 		 		 		<td width="100"></td>
 -->
   		 		 		 		<td colspan="2" align="left"><input type="button" class="button_flat_blue_small" id="sendMail" name="sendMail" value="Send Email" /></td>
   		 		 		 		<td colspan="2" align="right"><input type="button" class="my_popup2_close button_flat_blue_small" name="cancel" value="Close" /></td>
  		 		 			</tr>
 		 		 			<tr>
 		 		 			</tr>
 		 		 		<p>
 		 		 		<p>
			</table>
 			</form>
			
			<br />

</div>


<!--***************************** Update Prayer Request POPUP ***********************************-->
<!--***************************** Update Prayer Request POPUP ***********************************-->
<!--***************************** Update Prayer Request POPUP ***********************************-->
<div id="my_popup3">
	<h2>Update Prayer Request</h2>
        <br />
        <br />
        <h3>Update your prayer request and click <strong>Send</strong> when done.</h3>
        <p><strong>Update Only</strong> keeps the prayer request open, allowing further updates as desired.</p> 
        <p><strong>Answer</strong> your prayer request will close the request - future updates will require a new prayer request.</p>
        <hr>
        <p id="updateTitle" class="my_popup3title"> </p>
		<form id="updateprayerform" name='updateprayerform' method='post' action=' '> 		
      	<table id="praytable" style="border: 3px solid powderblue;" width="100%" align="left" cellpadding="0" cellspacing="1" border="0">
<!--      		<tr>
      			<td align="right"><strong>Title : </strong></td>
      			<td width="5%"></td>
      			<td style="font-size: 14px" colspan="2" class="my_popup3title"></td>
				</tr>
-->      		<tr>
      			<td width="25%">&nbsp</td>
<!--      			<td colspan="2" class="my_popup3title"> </td>
-->      		</tr>
      		<tr>
      			<td></td>
      		</tr>
      		<tr>
					<td align="right"><strong>Update : </strong></td>
				</tr>
 		 		<tr>
 		 			<td width="25%">&nbsp</td>
 		 		 	<td><input type="radio" name='answered' value='0' checked="checked">Update Only</input></td>
 		 		</tr>
 		 		<tr>
 		 			<td width="25%">&nbsp</td>
 		 		 	<td><input type="radio" name='answered' value='1'>Answer/Close</input></td>
 		 		</tr>
				<tr>
					<td>&nbsp</td>
					<td>&nbsp</td>
				</tr>
<!--        </table>
			<table width="100%" align="left" cellpadding="0" cellspacing="1" border="0" >
-->
	 			<tr>
	 		 		<td><br /></td>
	 			</tr>
	 			<tr>
	 		 		<td width='25%' align='right'><strong>Update Details:</strong></td>
	 		 		<td colspan="2"><textarea id="updatetext" name="requesttext" rows="6" cols="40" ></textarea></td>
	 			</tr>
	 			<tr>
	 				<td>&nbsp</td>
<?php				
					$fullname = $_SESSION['firstname'] . " " . $recordLast; 
 					echo "<td><input type='hidden' name='fullname' value= '" . $fullname . "' /></td>";
//					if($_SESSION['gender'] == 'M') 
//					{
//	 					echo "<td><input type='hidden' name='email' value= '" . $recordEmail1 . "' /></td>";
//	 				}
//	 				else //SESSION = F 
//	 				{
// 						echo "<td><input type='hidden' name='email' value= '" . $recordEmail2 . "' /></td>";
// 					}
?>
	 			</tr>
	 			<tr>
<!-- 	 		 		<td>&nbsp</td>
 -->
 <?php	 		
 					
 					echo "<td><input type='hidden' name='requestorID' value= '" . $profileaddr . "' /></td>";
?>
				</tr>
			</table>
			<table width="100%" align="left" cellpadding="0" cellspacing="1" border="0" >
	 		 	<tr>
	 		 		<td align="right"><input type="button" id="submitUpdate" class="my_popup3_close button_flat_blue_small" name='submitrequest' value='Send' /></td>
	 		 		<td width='25%' align="right"><input type="reset" class="my_popup3_close button_flat_blue_small" name="cancel" value="Cancel" /></td>
	 			</tr>
	 			<tr>
	 				<td>&nbsp</td>
	 			</tr>
 		 	</table>
		</form>
<br />
</div>

<!--***************************** Update Church Prayer Requests POPUP ***********************************-->
<!--***************************** Update Church Prayer Requests POPUP ***********************************-->
<!--***************************** Update Church Prayer Requests POPUP ***********************************-->
<div id="my_popup4">
	<h2>All Church Prayer Requests</h2>
        <br />
        <br />
        <h3>Select a prayer request to update</h3>
        <br />
        <br />
		<table id="allprayertable" class="display" cellspacing="0" width="100%">
      	  <thead>
         	   <tr>
						<th>id</th>
						<th>Opened</th>
						<th>Name</th>
						<th>Title</th>
						<th>Update</th>
            	</tr>
        		</thead>
        		<tfoot>
            	<tr>
						<th>id</th>
						<th>Opened</th>
						<th>Name</th>
						<th>Title</th>
						<th>Update</th>
            	</tr>
        		</tfoot>
    	</table>

		<form name='myprayerform' method='post' action='tecchurchprayer.php'> 		
			<table id="praytable" style="border: 3px solid powderblue;" width="100%" align="left" cellpadding="0" cellspacing="1" border="0" >
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
			<table style="border: 3px solid powderblue;" width="100%" align="left" cellpadding="0" cellspacing="1" border="0" >
							<tr class="praytable_text">
								<td colspan="5">
									<div class="praytext" style="height: 200px; overflow: auto; white-space: pre-wrap;">
									</div>								
								 </td>
							</tr>
							<tr>
								<td>
 								</td>
 							</tr>
	 			<tr>
<!-- 	 		 		<td>&nbsp</td>
 -->
 <?php	 		
 					
 					echo "<td><input type='hidden' name='requestorID' value= '" . $profileaddr . "' /></td>";
?>
				</tr>        
			</table>
			<table width="100%" align="left" cellpadding="0" cellspacing="1" border="0" >
				<tr>
	 		 		<td align="right"><input type="button" class="my_popup3_open button_flat_blue_small" id="updatePrayer" name="update" value="Update" /></td>
	 		 		<td align="left"> </td>
	 		 		<td width='25%' align="right"><input type="submit" class="my_popup4_close button_flat_blue_small" name="cancel" value="Cancel" /></td>
	 			</tr>
	 			<tr>
	 				<td><strong>NOTE: </strong>Answered prayers are closed and cannot be updated. Submit a new prayer request to re-open.</td>
	 			</tr>
	 			<tr>
	 				<td>&nbsp</td>
	 			</tr>
 		 	</table>
		</form>
<br />
</div>



</body>
</html>