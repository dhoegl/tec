<?php 
session_start();
// Updated 20210522 - clean up for new TEC prayer module
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

<!--***************************** Get Master Prayer List  ***********************************-->
<!--***************************** Get Master Prayer List  ***********************************-->
<!--***************************** Get Master Prayer List  ***********************************-->
<script type="text/javascript">
	var jQ19 = jQuery.noConflict();
    var loginID = <?php echo $_SESSION['user_id']; ?>;
    var masterresponse;
    var obj = [];
    var id = 0;
    var p_text = [];
    var p_type = [];
    var p_fullname = [];
    var activeprayercount;
	jQ19(document).ready(function() {
		var masterprayer = jQ19.ajax({
        url: 'services/tec_getmasterprayerlist.php',
		type: 'POST',
		dataType: 'json',
		data: {login_ID: loginID}
		})
        masterprayer.done(function (masterresponse) {
                    //  Get the details for all active prayer requests
                    activeprayercount = masterresponse.length;
                    console.log('number of active prayer requests = ' + activeprayercount);
                    var i = 0;
                    while (masterresponse[i]) {
                        obj[i] = masterresponse[i].prayer_id;
                        // console.log('obj[i] = ' + obj[i]);
                        id = obj[i];
                        p_text[id] = masterresponse[i].prayer_text;
                        p_type[id] = masterresponse[i].pray_praise;
                        p_fullname[id] = masterresponse[i].fullname;
                        i++
                        // console.log('prayer_text = ' + p_text[id]);
                    }
                    // for (id = 0; i < activeprayercount; id++) {
                    //     obj[id] = masterresponse[id].prayer_id;
                        // console.log('entry ' + i + ' = ' + obj);
                    // } 
                })

    });


</script>

<!--***************************** Process the Prayer 'Follow' button click action ***********************************-->
<!--***************************** Process the Prayer 'Follow' button click action ***********************************-->
<!--***************************** Process the Prayer 'Follow' button click action ***********************************-->
<script type="text/javascript">
	var jQ20 = jQuery.noConflict();
    var unfollowresponse;
	jQ20(document).ready(function() {
// Follow button
        jQ20("#follow_button").click(function () {
            console.log("prayerFollow button was pressed for " + $clickbuttonid + ": I am this user " + $loggedusername + " with Login ID = " + $loggedinLoginID);

// Check if prayer is being followed by user - Toggle the follow_button text
// Update prayer unfollow table - All prayer requests default to being followed unless entry is added to prayer_unfollow table
            var checkunfollow = 'services/tec_check_unfollow_table.php';
                jQ20.getJSON(checkunfollow, {unfollowprayerID: $clickbuttonid, unfollowprayerWho : $loggedusername, unfollowprayerLoginID : $loggedinLoginID
                }, function (data) {
                    console.log(data);
                    console.log("Data Message = " + data.unfollowmessage);
                jQ20.each(data.unfollowmessage, function (i, rep) {
                    if ('yes' === rep.Message.toLowerCase()) {
// IF prayer is being followed (DEFAULT) and Follow button is clicked, this means that the user wishes to UNFOLLOW the prayer request
                        console.log("YES prayer is being followed");
                        if ('following' === rep.Status.toLowerCase()) {
                        console.log("Status = FOLLOWING");
                        };
                    var $unfollowselect = 'donotfollow';
                            var request = jQ20.ajax({
                            url: 'services/tec_update_unfollow_table.php',
                            type: 'POST',
                            // dataType: 'json',
                            data: { unfollowselect: $unfollowselect, unfollowprayerID: $clickbuttonid, unfollowprayerWho : $loggedusername, unfollowprayerDir : $loggedidDirectory, unfollowprayerLoginID : $loggedinLoginID}
                            });
                            request.done(function (unfollowresponse) {
                                jQ20("#prayerFollow").html("NO");
                                jQ20("#follow_button").html("Click to Follow");
                            })
                    };
                    if ('no' === rep.Message.toLowerCase()) {
// IF prayer is NOT being followed (Entry exists in prayer_unfollow table) and Follow button is clicked, this means that the user wishes to FOLLOW the prayer request
                        console.log("NO prayer is NOT being followed");
                        if ('notfollowing' === rep.Status.toLowerCase()) {
                            console.log("Status = NOTFOLLOWING");
                        };
// Update prayer unfollow table - initialize to Follow as default state
                    var $unfollowselect = 'dofollow';
                            var request = jQ20.ajax({
                            url: 'services/tec_update_unfollow_table.php',
                            type: 'POST',
                            // dataType: 'json',
                            data: { unfollowselect: $unfollowselect, unfollowprayerID: $clickbuttonid, unfollowprayerWho : $loggedusername, unfollowprayerDir : $loggedidDirectory, unfollowprayerLoginID : $loggedinLoginID}
                            });
                            request.done(function (unfollowresponse) {
                                jQ20("#prayerFollow").html("YES");
                                jQ20("#follow_button").html("Click to Unfollow");
                            })
                    };
                });
            });
        });
	});
</script>


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
                    var email = response[0].prayeremail;
                    console.log("ajax response email = " + email);
                    window.location.href = "mailto:" + email + "?subject=Praying for you!";
                })
                .fail(function (jqXHR, textStatus) {
                    //  Get the result
                    var result = "fail";
                    var teststat = textStatus;
                    var teststat2 = jqXHR.responseText;
                    alert("No email address found to send an email - ajax response text = " + teststat2);
                });
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
// ************************ p_text extracted from jQ19 above ****************************
            prayerText = p_text[prayerID];
            jQ9("#prayerText").html(prayerText);
            // console.log("prayerID (this jQ9 entry) = " + prayerID);
            // console.log("prayerDate (this jQ9 entry) = " + prayerDate);
            // console.log("prayerAnswer (this jQ9 entry) = " + prayerAnswer);
            // console.log("prayerWho (this jQ9 entry) = " + prayerWho);
            // console.log("prayerTitle (this jQ9 entry) = " + prayerTitle);
            // console.log("prayerType (this jQ9 entry) = " + prayerType);
            // console.log("prayerText (this jQ9 entry) = " + prayerText);

// Check if prayer is being followed by user - Toggle the follow_button text
        var checkunfollow = 'services/tec_check_unfollow_table.php';
        jQ9.getJSON(checkunfollow, {unfollowprayerID: $clickbuttonid, unfollowprayerWho : $loggedusername, unfollowprayerLoginID : $loggedinLoginID
			}, function (data) {
				console.log(data);
				console.log("Data Message = " + data.unfollowmessage);
                jQ9.each(data.unfollowmessage, function (i, rep) {
				if ('yes' === rep.Message.toLowerCase()) {
					console.log("YES prayer is being followed");
                    jQ9("#prayerFollow").html("YES");
                    jQ9("#follow_button").html("Click to Unfollow");
				};
				if ('following' === rep.Status.toLowerCase()) {
					console.log("Status = FOLLOWING");
                };
				if ('no' === rep.Message.toLowerCase()) {
					console.log("NO prayer is NOT being followed");
                    jQ9("#prayerFollow").html("NO");
					jQ9("#follow_button").html("Click to Follow");
				}
				if ('notfollowing' === rep.Status.toLowerCase()) {
					console.log("Status = NOTFOLLOWING");
                };
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
// ************************ p_text extracted from jQ19 above ****************************
            prayerText = p_text[prayerID];
            jQ9("#prayerText").html(prayerText);
            // console.log("prayerDate (this jQ9 entry) = " + prayerDate);
            // console.log("prayerAnswer (this jQ9 entry) = " + prayerAnswer);
            // console.log("prayerWho (this jQ9 entry) = " + prayerWho);
            // console.log("prayerTitle (this jQ9 entry) = " + prayerTitle);
            // console.log("prayerType (this jQ9 entry) = " + prayerType);
            // console.log("prayerText (this jQ9 entry) = " + prayerText);

// Check if prayer is being followed by user - Toggle the follow_button text
var checkunfollow = 'services/tec_check_unfollow_table.php';
        jQ9.getJSON(checkunfollow, {unfollowprayerID: $clickbuttonid, unfollowprayerWho : $loggedusername, unfollowprayerLoginID : $loggedinLoginID
			}, function (data) {
				console.log(data);
				console.log("Data Message = " + data.unfollowmessage);
                jQ9.each(data.unfollowmessage, function (i, rep) {
				if ('yes' === rep.Message.toLowerCase()) {
					console.log("YES prayer is being followed");
                    jQ9("#prayerFollow").html("YES");
                    jQ9("#follow_button").html("Click to Unfollow");
				};
				if ('following' === rep.Status.toLowerCase()) {
					console.log("Status = FOLLOWING");
                };
				if ('no' === rep.Message.toLowerCase()) {
					console.log("NO prayer is NOT being followed");
                    jQ9("#prayerFollow").html("NO");
					jQ9("#follow_button").html("Click to Follow");
				}
				if ('notfollowing' === rep.Status.toLowerCase()) {
					console.log("Status = NOTFOLLOWING");
                };
			});
		});

    // Display the Prayer Request Details popup
    jQ9("#ModalPrayerView").modal('show');
        }
	});
});
</script>


</head>
<body>

<!-- ****************************** Navbar ********************************** -->
<!-- ****************************** Navbar ********************************** -->
<!-- ****************************** Navbar ********************************** -->
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
            </div><!-- row -->
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-sm-12">
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
                            <li>On the Prayer Request Details popup</li>
                            <ul>
                                <li>Click the <span class="btn btn-primary btn-sm">Follow/Unfollow</span> button to follow or unfollow a prayer request (following will ensure you receive all updates to existing prayer requests)</li>
                                <li>Click the <span class="btn btn-success btn-sm">Email</span> button to send a caring note to the requestor</li>
                            </ul>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-12 -->
            </div><!-- row -->
        </div><!-- collapse -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-image"
                        style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                        <!-- Content -->
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                            <div class="w-100">
                                <h3 class="card-title pt-2"><strong>CHURCH FAMILY PRAYER REQUESTS</strong></h3>
                                <p>View and Follow your church family's prayer requests.</p>
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
</div> <!-- Container -->





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
                                        <p class="card-text text-left"  id="prayerText"></p>
                                    </div><!-- card-body -->
                                </div><!-- card -->
                                <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                    </div><!-- btn-group -->
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-xs-4">
                                            <button type="button" name="prayer_outbound_email" id="prayer_outbound_email" class="btn btn-success btn-sm">Email</button>
                                        </div>
                                        <div class="col-xs-4">
                                            <button type="button" class="btn btn-primary btn-sm" id="follow_button">Follow</button>
                                        </div>
                                        <div class="col-xs-4">
                                            <button type="button" name="closeprayermodal" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- btn-group -->
                                </div><!-- row -->
                            </div><!-- table-respomsive -->
                    </div><!-- modaleditform -->
                </form>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal-fade -->

<!--***************************** SCRIPTS ***********************************-->
<!--***************************** SCRIPTS ***********************************-->
<!--***************************** SCRIPTS ***********************************-->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <!-- <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script> -->
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <!-- Datatables JavaScript plugins - Bootstrap-specific -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.7/datatables.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/r-2.2.6/datatables.min.js"></script>
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>

</body>
</html>
