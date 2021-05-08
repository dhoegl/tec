<?php 
session_start();
// Updated 20210406 - clean up for new TEC prayer module
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
    require_once('tec_dbconnect.php');
    require_once('fpdf/fpdf.php');
    // Event Log  trap
    include('includes/event_logs_update.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- BOOTSTRAP - Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >
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
  <!-- Test custom styles (Includes tec style details) -->
  <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">
    <!-- Datatables stylesheet - Bootstrap-specific -->
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


  <!-- Call Moment js for date calc functions -->
  <script src="js/moment.js"></script>
  <!-- JQuery -->
  <!-- <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script> -->
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->




<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->

<?php
// Get User Login details
    include('includes/tec_get_loggedinuser.php');

// Get Active Prayer List
    include('includes/tec_view_activeprayerlist2.php');
   
// Get My Prayer List
    include('includes/tec_view_myprayerlist.php');

// Get Active Prayer jQuery
//    include('includes/tec_get_activeprayer_jquery.php');
   
?>


<!--***************************** Process the Prayer 'Follow' button click action ***********************************-->
<!--***************************** Process the Prayer 'Follow' button click action ***********************************-->
<!--***************************** Process the Prayer 'Follow' button click action ***********************************-->
<script type="text/javascript">
	var jQ20 = jQuery.noConflict();
	jQ20(document).ready(function() {
// Follow button
	jQ20("#follow_button").click(function () {
		console.log("prayerFollow button was pressed for " + $clickbuttonid + ": I am this user " + $loggedusername + " with Login ID = " + $loggedinLoginID);

// Check if prayer is being followed by user - Toggle the follow_button text
		var checkfollow = 'services/tec_check_follow_table.php';
			jQ20.getJSON(checkfollow, {followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerLoginID : $loggedinLoginID
			}, function (data) {
				console.log(data);
				console.log("Data Message = " + data.followmessage);
			jQ20.each(data.followmessage, function (i, rep) {
				if ('yes' === rep.Message.toLowerCase()) {
					console.log("YES prayer is being followed");
                // Update prayer follow table - initialize to Follow as default state
                var $followselect = 'yes';
                        var request = jQ20.ajax({
                        url: 'services/tec_update_follow_table.php',
                        type: 'POST',
                        // dataType: 'json',
                        data: { followselect: $followselect, followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory, followprayerLoginID : $loggedinLoginID}
                        });
                    jQ20("#prayerFollow").html("NO");
					jQ20("#follow_button").html("Click to Follow");
				};
				if ('no' === rep.Message.toLowerCase()) {
					console.log("NO prayer is NOT being followed");
                // Update prayer follow table - initialize to Follow as default state
                var $followselect = 'no';
                        var request = jQ20.ajax({
                        url: 'services/tec_update_follow_table.php',
                        type: 'POST',
                        // dataType: 'json',
                        data: { followselect: $followselect, followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory, followprayerLoginID : $loggedinLoginID}
                        });
                    jQ20("#prayerFollow").html("YES");
					jQ20("#follow_button").html("Click to Unfollow");
				}
			});
		});

	});

// Update prayer follow table - initialize to Follow as default state
        // var $followselect = 'yes';
		// var request = jQ20.ajax({
		// url: 'services/tec_update_follow_table.php',
		// type: 'POST',
		// dataType: 'json',
		// data: { followselect: $followselect, followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory, followprayerLoginID : $loggedinLoginID}
		// });




// Unfollow button
	// jQ20("#unfollow_button").click(function () {
	// 	console.log("prayer unFollow button was pressed for " + $clickbuttonid + ": I am this user " + $loggedusername + " with ID = " + $loggedidDirectory);
	// 	var $followselect = 'unfollow';
	// 	var request = jQ20.ajax({
	// 	url: 'services/tec_update_follow_table.php',
	// 	type: 'POST',
	// 	dataType: 'json',
	// 	data: { followselect: $followselect, followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory}
	// 	});

// Check if prayer is being followed by user - Show/Hide the Follow/Unfollow buttons
		// var checkfollow = 'services/tec_check_follow_table.php';
		// 	jQ20.getJSON(checkfollow, {followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory
		// 	}, function (data) {
		// 		console.log(data);
		// 		console.log("Data Message = " + data.followmessage);
		// 	jQ20.each(data.followmessage, function (i, rep) {
		// 		if ('yes' === rep.Message.toLowerCase()) {
		// 			console.log("YES is the response");
		// 			jQ20("#follow_button").hide();
		// 			jQ20("#unfollow_button").show();
		// 		};
		// 		if ('no' === rep.Message.toLowerCase()) {
		// 			console.log("NO is the response");
		// 			jQ20("#follow_button").show();
		// 			jQ20("#unfollow_button").hide();
		// 		}
		// 	});
		// });
	});
// });
</script>

<!-- ******** LEFT OFF HERE -->
<!-- ******** LEFT OFF HERE -->
<!-- ******** LEFT OFF HERE -->

<!-- **************************** Process the Send Email buttons for selected prayer request ******************** -->
<!-- **************************** Process the Send Email buttons for selected prayer request ******************** -->
<!-- **************************** Process the Send Email buttons for selected prayer request ******************** -->
<!-- Send Email using client email application -->
<!-- NOTE: If nothing is returned from tec_get_prayer_email_address, script will fail - temporarily 'by design' until conditions are established to disable or hide Send Mail button -->
<script type="text/javascript">
    var response;
	var jQ30 = jQuery.noConflict();
	jQ30(document).ready(function() {
        jQ30("#prayer_outbound_email").click(function () {
		console.log("Send Email button clicked");
        var sendaddress = jQ30.ajax({
                url: 'services/tec_get_prayer_email_address.php',
                type: 'GET',
                dataType: 'json',
                data: { prayerID: $clickbuttonid }
            })
                .done(function (response) {
                    //  Get the result
                    // var obj = JSON.parse(response.responseText);
                    // teststat2 = response.responseText;
                    var email = response[0].prayeremail;
                    // for(var i=0; i<len; i++){
                    // var id = response[i].prayerid;
                    // var email = response[i].prayeremail;
                    // var teststat2 = response.prayeremail;
                    // console.log("ajax response text = " + id + " " + email);
                    // alert("Email address received: " + email);
                    console.log("ajax response email = " + email);
                    // alert("ajax response email = " + email);
                    window.location.href = "mailto:" + email + "?subject=Praying for you!";
                    // };
                })
                .fail(function (jqXHR, textStatus) {
                    //  Get the result
                    //result = (rtnData === undefined) ? null : rtnData.d;
                    var result = "fail";
                    var teststat = textStatus;
                    var teststat2 = jqXHR.responseText;
                    // console.log("ajax response data = " + teststat);
                    // console.log("ajax response text = " + teststat2);
                    // reportError(teststat);
                    alert("No email address found to send an email - ajax response text = " + teststat2);
                    // location.reload();
                    // return result;
                });


// jQ30("#prayer_outbound_email").click(function () {
// 		console.log("Send Email button clicked");
// 		var sendaddress = 'services/tec_get_prayer_email_address.php';
// 		jQ30.getJSON(sendaddress, {prayerID: $clickbuttonid
// 		}, function (data) {
// 			console.log(data);
// 			jQ30.each(data.prayerdata, function (i, rep) {
// 			console.log("Prayer ID: " + rep.prayerid);
// 			console.log("Prayer owner email: " + rep.prayeremail);
// 			});
// 		});
//     });
    });
});

</script>

<!--***************************** Get Which Prayer Item's 'Details' button was clicked ***********************************-->
<!--***************************** Get Which Prayer Item's 'Details' button was clicked ***********************************-->
<!--***************************** Get Which Prayer Item's 'Details' button was clicked ***********************************-->
<script type="text/javascript">
var $clickbuttonid = "NA";
var testforChild = "0";
var parentTable;
var prayerDate = "0";
var prayerAnswer = "0";
var prayerWho = "0";
var prayerTitle = "0";
var prayerType = "0";
var prayerText;
var prayerText2;
var siblingTable;
var gethiddencol = "0";
var jQ9 = jQuery.noConflict();
jQ9(document).ready(function () {
	// jQ9("#activeprayertable tbody").on("click", 'tr', function () {
    jQ9("#activeprayertable tbody").on("click", '.detailscolumn', function () {
        testforChild = jQ9(this).closest('tr');
        if (testforChild.hasClass("child")) {
            console.log("******** HAS CHILD ******")
            // var prayerID = jQ9(this).closest("tbody").find("tr.parent").find(".indexcol").text();
            var prayerID = testforChild.prev("tr").find(".indexcol").text();
            $clickbuttonid = prayerID;
            jQ9("#prayerID").html(prayerID);
            console.log("********** Details button clicked ************");
            console.log("$clickbuttonid (this jQ9 entry) = " + $clickbuttonid);
            prayerDate = testforChild.prev("tr").find(".prayer_update").text();
            jQ9("#prayerDate").html(prayerDate);
            prayerAnswer = testforChild.prev("tr").find(".prayer_answer").text();
            if(prayerAnswer == " Answered "){
                jQ9("#prayerAnswer").html("YES");
            }
            else{
                jQ9("#prayerAnswer").html("NO");
            }
            prayerWho = testforChild.prev("tr").find(".prayer_who").text();
            jQ9("#prayerWho").html(prayerWho);
            prayerTitle = testforChild.prev("tr").find(".prayer_title").text();
            jQ9("#prayerTitle").html(prayerTitle);
            prayerType = testforChild.prev("tr").find(".type").text();
            if(prayerType == "Prayer"){
                jQ9("#prayerType").html("Prayer Request");
            }
            else{
                jQ9("#prayerType").html("Praise");
            }
            var prayerIndex = prayerID-1;
            siblingTable = jQ9("td.full_text2").eq(prayerIndex).text();
            jQ9("#prayerText").html(siblingTable);
            console.log("prayerDate (this jQ9 entry) = " + prayerDate);
            console.log("prayerAnswer (this jQ9 entry) = " + prayerAnswer);
            console.log("prayerWho (this jQ9 entry) = " + prayerWho);
            console.log("prayerTitle (this jQ9 entry) = " + prayerTitle);
            console.log("prayerType (this jQ9 entry) = " + prayerType);
            console.log("prayerText (this jQ9 entry) = " + prayerText);
            console.log("prayerIndex (this jQ9 entry) = " + prayerIndex);
            console.log("prayerText2 (this jQ9 entry) = " + prayerText2);
            console.log("siblingTable (this jQ9 entry) = " + siblingTable);

// Check if prayer is being followed by user - Toggle the follow_button text
        var checkfollow = 'services/tec_check_follow_table.php';
        jQ9.getJSON(checkfollow, {followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerLoginID : $loggedinLoginID
			}, function (data) {
				console.log(data);
				console.log("Data Message = " + data.followmessage);
                jQ9.each(data.followmessage, function (i, rep) {
				if ('yes' === rep.Message.toLowerCase()) {
					console.log("YES prayer is being followed");
                    jQ9("#prayerFollow").html("YES");
                    jQ9("#follow_button").html("Click to Unfollow");
				};
				if ('no' === rep.Message.toLowerCase()) {
					console.log("NO prayer is NOT being followed");
                    jQ9("#prayerFollow").html("NO");
					jQ9("#follow_button").html("Click to Follow");
				}
			});
		});
    // Display the Prayer Request Details popup
    jQ9("#ModalPrayerView").modal('show');
         }
        else {
            console.log("******** NOT CHILD ******")
            var prayerID = jQ9(this).closest('tr').find(".indexcol").text();
            $clickbuttonid = prayerID;
            jQ9("#prayerID").html(prayerID);
            console.log("********** Details button clicked ************");
            console.log("$clickbuttonid (this jQ9 entry) = " + $clickbuttonid);
            prayerDate = jQ9(this).closest('tr').find(".prayer_update").text();
            jQ9("#prayerDate").html(prayerDate);
            prayerAnswer = jQ9(this).closest('tr').find(".prayer_answer").text();
            if(prayerAnswer == " YES "){
                jQ9("#prayerAnswer").html("YES");
            }
            else{
                jQ9("#prayerAnswer").html("NO");
            }
            prayerWho = jQ9(this).closest('tr').find(".prayer_who").text();
            jQ9("#prayerWho").html(prayerWho);
            prayerTitle = jQ9(this).closest('tr').find(".prayer_title").text();
            jQ9("#prayerTitle").html(prayerTitle);
            prayerType = jQ9(this).closest('tr').find(".type").text();
            if(prayerType == "Prayer"){
                jQ9("#prayerType").html("Prayer Request");
            }
            else{
                jQ9("#prayerType").html("Praise");
            }
            var prayerIndex = prayerID-1;
            siblingTable = jQ9("td.full_text2").eq(prayerIndex).text();
            jQ9("#prayerText").html(siblingTable);
            console.log("prayerDate (this jQ9 entry) = " + prayerDate);
            console.log("prayerAnswer (this jQ9 entry) = " + prayerAnswer);
            console.log("prayerWho (this jQ9 entry) = " + prayerWho);
            console.log("prayerTitle (this jQ9 entry) = " + prayerTitle);
            console.log("prayerType (this jQ9 entry) = " + prayerType);
            console.log("prayerText (this jQ9 entry) = " + prayerText);
            console.log("prayerIndex (this jQ9 entry) = " + prayerIndex);
            console.log("prayerText2 (this jQ9 entry) = " + prayerText2);
            console.log("siblingTable (this jQ9 entry) = " + siblingTable);

    // Check if prayer is being followed by user - Toggle the follow_button text
        var checkfollow = 'services/tec_check_follow_table.php';
        jQ9.getJSON(checkfollow, {followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerLoginID : $loggedinLoginID
			}, function (data) {
				console.log(data);
				console.log("Data Message = " + data.followmessage);
                jQ9.each(data.followmessage, function (i, rep) {
				if ('yes' === rep.Message.toLowerCase()) {
					console.log("YES prayer is being followed");
                    jQ9("#prayerFollow").html("YES");
                    jQ9("#follow_button").html("Click to Unfollow");
				};
				if ('no' === rep.Message.toLowerCase()) {
					console.log("NO prayer is NOT being followed");
                    jQ9("#prayerFollow").html("NO");
					jQ9("#follow_button").html("Click to Follow");
				}
			});
		});

    // Display the Prayer Request Details popup
    jQ9("#ModalPrayerView").modal('show');
        }
// ******** LEFT OFF HERE
// ******** LEFT OFF HERE
// ******** LEFT OFF HERE
// Check if prayer has been answered - disable follow/unfollow buttons if true
		// jQ9("#follow_button").hide();
		// jQ9("#unfollow_button").hide();
		// console.log("loggedidDirectory = " + $loggedidDirectory);
		// if (prayerAnswer != 'Answered' && $loggedidDirectory < 20000) {
// Check if prayer is being followed by user - Show/Hide the Follow/Unfollow buttons
			// console.log("Inside prayerAnswer check routing");
			// console.log("followprayerID = " + $clickbuttonid);
			// console.log("followprayerWho = " + $loggedusername);
			// console.log("followprayerDir = " + $loggedidDirectory);
			// var checkfollow = 'services/tec_check_follow_table.php';
			// 	jQ9.getJSON(checkfollow, {followprayerID: $clickbuttonid, followprayerWho : $loggedusername, followprayerDir : $loggedidDirectory
			// 	}, function (data) {
			// 		console.log(data);
			// 		console.log("Data Message = " + data.followmessage);
			// 	jQ9.each(data.followmessage, function (i, rep) {
			// 		if ('yes' === rep.Message.toLowerCase()) {
			// 			console.log("YES is the response");
			// 			jQ9("#follow_button").hide();
			// 			jQ9("#unfollow_button").show();
			// 		};
			// 		if ('no' === rep.Message.toLowerCase()) {
			// 			console.log("NO is the response");
			// 			jQ9("#follow_button").show();
			// 			jQ9("#unfollow_button").hide();
			// 		};
			// 	});
			// });
		// };
	});
});
</script>
</head>
<body>

<!--Navbar-->
<?php
$activeparam = '5'; // sets nav element highlight
require_once('tec_nav.php');
require_once('includes/tec_footer.php');
?>
<!-- Intro Section -->
<div class="container-fluid profile_bg bottom-buffer">
            <div class="row pt-2">
                <div class="col-xs-6">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        How to...
                    </button>
                </div><!-- col xs-6 -->
                <!-- <div class="col-xs-6">
                        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseRequests" aria-expanded="false" aria-controls="collapseRequests">
                            My Requests
                        </button>
                </div> -->
                <div class="col-xs-6">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Requests
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item" data-toggle="modal" data-target="#ModalPrayerNew" type="button">New Prayer Request</button>
                            <button class="dropdown-item" data-toggle="modal" data-target="#ModalExistingRequest" type="button">My Existing Requests</button>
                            <button class="dropdown-item" data-toggle="modal" data-target="#ModalEditExistingRequest" type="button">Edit My Existing Request</button>
                        </div>
                    </div><!-- dropdown -->
                </div><!-- col xs-6 -->
            </div><!-- row -->
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">
                            Viewing Prayer Requests 
                        </h4>
                        <ul class="card-text">
                            <li>The table below lists all recent prayer requests (and praises) from your church family</li>
                            <li>Click on a header arrow to sort columns ascending or descending</li>
                            <li>Use the Search box to locate a specific prayer request</li>
                            <li>Navigate pages using the Page Selector at the bottom of the page</li>
                            <li>Click the <span><img src="https://datatables.net/examples/resources/details_open.png"></img></span> icon to display more details</li>
                            <li>Click the <span class="btn btn-success btn-sm">Details</span> button on a row below to see more information about a specific prayer request</li>
                            <li>On the Prayer Request Details popup, click the <span class="btn btn-secondary btn-sm">Follow/Unfollow</span> button to follow or unfollow a prayer request (following will ensure you receive all updates to existing prayer requests)</li>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-6 -->
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Creating and Managing Your Prayer Requests</h4>
                        <ul class="card-text">
                            <li>Create your own prayer requests allowing your church family to pray with you</li>
                            <ul>
                                <li>Click the <span class="btn btn-secondary btn-sm">My Requests</span> button and select <u>'New Prayer Request'</u> to create a new prayer request</li>
                                <li>Enter your request details and click the <span class="btn btn-primary btn-sm">Submit</span> button send it out</li>
                                <li><u>PLEASE NOTE</u> that all prayer requests are reviewed by our church elders before they are posted to the site</li>
                            </ul>
                            <li>Manage your existing prayer requests</li>
                            <ul>
                                <li>Click the <span class="btn btn-secondary btn-sm">My Requests</span> button and select <u>'My Existing Requests'</u> to update an existing prayer request</li>
                                <li>On the Edit Prayer Request list popup:</li>
                                <ul>
                                    <li>Click the <span class="btn btn-primary btn-sm">Update</span> button on the selected prayer request to update with any new information</li>
                                    <li>Click the <span class="btn btn-success btn-sm">Answered</span> button on the selected prayer request to acknowledge an answered prayer</li>
                                    <li><u>PLEASE NOTE</u> Answered prayers are considered closed and cannot be further updated</li>
                                </ul>
                            </ul>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-6 -->
            </div><!-- row -->
        </div><!-- collapse -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-image"
                        style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                        <!-- Content -->
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                            <div class="w-100">
                                <h3 class="card-title pt-2"><strong>FAMILY PRAYER REQUESTS</strong></h3>
                                <p>View, follow, and manage prayer requests.</p>
                            </div>
                        </div>
                    </div><!-- Card -->
                </div><!-- Col-md-12 -->
            </div><!-- Row -->
<!-- ******************************* Active Prayer List Card ************************************** -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bg-light border-primary px-2 my-2 w-100">
                        <div class="card-body">
                            <div class="table-responsive-xs">
                                <!-- <table id="activeprayertable" class="table table-sm table-striped dt-responsive" cellspacing="0" border="0" width="100%"> -->
                                <table id="activeprayertable" class="table table-sm table-striped 'display responsive nowrap'" width="100%">
                                    <thead class="table-dark">
                                            <tr>
                                                <th class="dtr-prayercolumn"></th>
                                                <th>id</th>
                                                <th>Opened</th>
                                                <th>Family Member</th>
                                                <th>Type</th>
                                                <th>Answered</th>
                                                <th>Title</th>
                                                <th>Quick Glance</th>
                                                <th>Details</th>
                                                <th>Text</th>
                                            </tr>
                                    </thead>
                                    <tfoot class="table-dark">
                                            <tr>
                                                <th class="dtr-prayercolumn"></th>
                                                <th>id</th>
                                                <th>Opened</th>
                                                <th>Family Member</th>
                                                <th>Type</th>
                                                <th>Answered</th>
                                                <th>Title</th>
                                                <th>Quick Glance</th>
                                                <th>Details</th>
                                                <th>Text</th>
                                            </tr>
                                    </tfoot>
                                </table>
                            </div><!-- table-responsive -->
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col-sm-12 -->
            </div><!-- row -->

<!-- Make table hidden so that only Text column is accessible -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bg-light border-primary px-2 my-2 w-100">
                        <div class="card-body">
                            <div class="table-responsive-xs">
                                <div id="prayertexttablehide">
                                    <table id="prayertexttable">
                                        <thead class="table-dark">>
                                            <tr>
                                                <th class="dtr-prayercolumn"></th>
                                                <th>id</th>
                                                <th>Opened</th>
                                                <th>Family Member</th>
                                                <th>Type</th>
                                                <th>Answered</th>
                                                <th>Title</th>
                                                <th>Quick Glance</th>
                                                <th>Details</th>
                                                <th>Text</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="table-dark">
                                            <tr>
                                                <th class="dtr-prayercolumn"></th>
                                                <th>id</th>
                                                <th>Opened</th>
                                                <th>Family Member</th>
                                                <th>Type</th>
                                                <th>Answered</th>
                                                <th>Title</th>
                                                <th>Quick Glance</th>
                                                <th>Details</th>
                                                <th>Text</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- prayertexttablehide -->
                            </div><!-- table-responsive -->
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col-sm-12 -->
            </div> <!-- Row -->
</div> <!-- Container -->



<!--***************************** New Prayer Request MODAL ***********************************-->
<!--***************************** New Prayer Request MODAL ***********************************-->
<!--***************************** New Prayer Request MODAL ***********************************-->

<div class="modal fade" id="ModalPrayerNew" tabindex="-1" role="dialog" aria-labelledby="NewPrayerModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewPrayerModalLabel">New Prayer Request<br>Click <strong>Submit</strong> when done.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> <!-- modal-header -->
            <div class="modal-body">
                <form class="border border-light p-2" name='newprayer' method='post' action=''> 		
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-3">
                                    <label for="visibility">Select Visibility:</label>
                                </div>
                                <div class="col-9">
                                    <select class="custom-select" name="visibility" id="visibility">
                                        <option value="Elders">Elders Only</option>
                                        <option value="AllChurch" selected>Your Church Family (approval required)</option>
                                    </select>
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-3">
                                    <label for="visibility">Select Pray/Praise:</label>
                                </div>
                                <div class="col-9">
                                    <select class="custom-select" name="praypraise" id="praypraise">
                                        <option value="Prayer" selected>Prayer Request</option>
                                        <option value="Praise">Praise</option>
                                    </select>
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-3">
                                    <label for="praytitle">Title:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Title..." type="text" id="praytitle" name='praytitle' class="form-control" />
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-3">
                                    <label for="praydetails">Details:</label>
                                </div>
                                <div class="col-9">
                                    <textarea placeholder="Details..." id="details" name='details' class="form-control" rows="5"></textarea>
                                </div>
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="button" name="submitnewprayer" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- btn-group -->
                            </div><!-- row -->
                        </div> <!--Table Responsive-->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->


<!--***************************** Existing Prayer Request MODAL ***********************************-->
<!--***************************** Existing Prayer Request MODAL ***********************************-->
<!--***************************** Existing Prayer Request MODAL ***********************************-->

<div class="modal fade" id="ModalExistingRequest" tabindex="-1" role="dialog" aria-labelledby="ExistPrayerModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ExistPrayerModalLabel">My Prayer Requests<br>Select an existing Request and click <strong>Update</strong> or <strong>Answered</strong>.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h4>
                    My Existing Active Prayer Requests
                </h4>
                <h6>
                    Select from list of prayer requests below to update
                </h6>
                <form class="text-center border border-light p-2" name='existprayer' method='post' action=''>
                    <!-- <table id="myexistprayertable" class="table table-sm table-striped dt-responsive" cellpadding="0" cellspacing="0" border="0" width="100%"> -->
                    <div class="modaleditform text-center border border-light p-2">
                        <table id="myexistprayertable" class="table table-sm table-striped 'display responsive nowrap'" cellpadding="0" cellspacing="0" border="0" width="100%">
                        
                            <!-- <thead class="table-dark"> -->
                            <thead>
                                <tr>
                                    <th class="dtr-myprayercolumn"></th>
                                    <th>id</th>
                                    <th>Opened</th>
                                    <th>Title</th>
                                    <th>Update</th>
                                    <th>Answer</th>
                                    <th>Text</th>
                                </tr>
                            </thead>
                            <!-- <tfoot class="table-dark"> -->
                            <tfoot>
                                <tr>
                                <th class="dtr-myprayercolumn"></th>
                                    <th>id</th>
                                    <th>Opened</th>
                                    <th>Title</th>
                                    <th>Update</th>
                                    <th>Answer</th>
                                    <th>Text</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row px-4 d-flex">
                            <div class="col-sm-4">
                            </div><!-- col-sm-4 -->
                            <div class="col-sm-4">
                            </div><!-- col-sm-4 -->
                            <div class="col-sm-4">
                                <!-- <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons"> -->
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div><!-- col-sm-4 -->
                        </div><!-- row -->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->


<!--***************************** EDIT Existing Prayer Request MODAL ***********************************-->
<!--***************************** EDIT Existing Prayer Request MODAL ***********************************-->
<!--***************************** EDIT Existing Prayer Request MODAL ***********************************-->

<div class="modal fade" id="ModalEditExistingRequest" tabindex="-1" role="dialog" aria-labelledby="EditExistPrayerModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditExistPrayerModalLabel">Update My Prayer Request<br>Fill in stuff and click <strong>Update</strong> or <strong>Answered</strong>.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <form class="text-center border border-light p-2" name='editexistprayer' method='post' action=''>
                    <!-- <table id="myexistprayertable" class="table table-sm table-striped dt-responsive" cellpadding="0" cellspacing="0" border="0" width="100%"> -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2">
                                        <p class="mb-n1 text-left font-weight-bold">Type:</p>
                                        <p class="mb-n1 text-left font-weight-bold">Date:</p>
                                        <p class="mb-n1 text-left font-weight-bold">From:</p>
                                        <p class="mb-n1 text-left font-weight-bold">Title:</p>
                                    </div>
                                    <div class="col-10">
                                        <p class="mb-n1 text-left">Sed viverra ipsum nunc aliquet.</p>
                                        <p class="mb-n1 text-left">Sed viverra ipsum nunc aliquet. </p>
                                        <p class="mb-n1 text-left">Sed viverra ipsum nunc aliquet. </p>
                                        <p class="mb-n1 text-left">Sed viverra ipsum nunc aliquet.</p>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="card card-body">
                                        <h4 class="card-title">Prayer Request</h4>
                                        <p class="card-text">
                                            Non quam lacus suspendisse faucibus interdum posuere lorem ipsum dolor. Quam nulla porttitor massa id neque aliquam. Tortor vitae purus faucibus ornare suspendisse sed nisi lacus. Morbi tincidunt ornare massa eget egestas purus. Enim diam vulputate ut pharetra sit. Ut aliquam purus sit amet luctus venenatis lectus magna. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque. 
                                        </p>
                                    </div>
                                </div><!-- row -->
                                <div class="row">
                                    <textarea placeholder="Details..." id="prayer_text" name='prayer_text' class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div><!-- row -->
                            <!-- <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                    <div class="col-sm-4">
                                            <button type="button" name="updateexistingprayer" class="btn btn-primary btn-sm">Update</button>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" name="answerexistingprayer" class="btn btn-success btn-sm">Answered</button>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div> -->
                                    <!-- </div>
                            </div> -->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->


<!--***************************** View Prayer Request Details MODAL ***********************************-->
<!--***************************** View Prayer Request Details MODAL ***********************************-->
<!--***************************** View Prayer Request Details MODAL ***********************************-->

<div class="modal fade" id="ModalPrayerView" tabindex="-1" role="dialog" aria-labelledby="ViewPrayerDetailsModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewPrayerDetailsModalLabel">View Prayer Request Details<br>Click <strong>Close</strong> when done.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <form class="border border-light p-2" name='viewprayer' method='post' action=''> 		
                        <div class="modaleditform border border-light p-2">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">Date:</div>
                                    <div class="col-8 text-left"><span id="prayerDate"></span></div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">From:</div>
                                    <div class="col-8 text-left"><span id="prayerWho"></span></div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">Title:</div>
                                    <div class="col-8 text-left"><span id="prayerTitle"></span></div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">Updated:</div>
                                    <div class="col-2 text-left"><span id="prayerUpdate"></span></div>
                                    <div class="col-3 text-right font-weight-bold">Answered:</div>
                                    <div class="col-3 text-left"><span id="prayerAnswer"></span></div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold"></div>
                                    <div class="col-2 text-left"></div>
                                    <div class="col-3 text-right font-weight-bold">Following:</div>
                                    <div class="col-3 text-left"><span id="prayerFollow"></span></div>
                                </div><!-- row -->
                                <div  class="card">
                                    <div class="card-body" id="viewpraytable">
                                        <h5 class="card-title" id="prayerType"></h5>
                                        <p class="card-text"  id="prayerText"></p>
                                    </div><!-- card-body -->
                                </div><!-- card -->
                                <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <button type="button" name="closeprayermodal" class="btn btn-primary btn-sm">Close</button>
                                        <button type="button" class="btn btn-secondary btn-sm" id="follow_button">Follow</button>
                                        <button type="button" name="prayer_outbound_email" id="prayer_outbound_email" class="btn btn-success btn-sm">Email</button>
                                    </div><!-- btn-group -->
                                </div><!-- row -->
                            </div><!-- table-respomsive -->
                    </div><!-- modaleditform -->
                </form>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal-fade -->





<!-- ************************************* -->
<!-- View Prayer Details OVERLAY dialog            -->
<!-- ************************************* -->
 <!-- <div id="my_popup"> -->
	<!-- <h2>View Prayer Request Details</h2>
        <br />
        <br />
        <h3>View the details of this prayer request.</h3>
        <br />
        <hr> -->
			<!-- <form name='form1' method='post' action=''> 		 -->
				<!-- <table id="praytable" style="border: 3px solid powderblue;" width="100%" align='left' cellpadding='0' cellspacing='1' border="0">
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
				</table> -->
				<!-- <table style="border: 3px solid powderblue;" width="100%" align='left' cellpadding='0' cellspacing='1' border="0">
					<tr class="praytable_text">
						<td colspan="4">
							<div class="praytext" style="height: 200px; overflow: auto; white-space: pre-wrap;"></div>
						</td>
					</tr>
					<tr>
						<td>
 						</td>
 					</tr>
				</table> -->
				<!-- <table width="100%" align='left' cellpadding='0' cellspacing='1' border="0">
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
				</table> -->
 			<!-- </form> -->
			<!-- <br /> -->
    <!-- </div> -->

    <!-- SCRIPTS -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <!-- Datatables JavaScript plugins - Bootstrap-specific -->
    <!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/r-2.2.6/datatables.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.7/datatables.min.js"></script>
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>

</body>
</html>
