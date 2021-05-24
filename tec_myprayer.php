<?php 
session_start();
// Updated 20210522 - My Prayer Requests split out from All church Prayer Requests (at tec_prayer.php)
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

// Get My Prayer List
    include('includes/tec_view_myprayerlist.php');

// Get My Prayer jQuery
// include('includes/tec_get_myprayer_jquery.php');

// Get Active Prayer jQuery
//    include('includes/tec_get_activeprayer_jquery.php');
   
?>

<!--***************************** Get Master Prayer List for Logged In User ***********************************-->
<!--***************************** Get Master Prayer List for Logged In User ***********************************-->
<!--***************************** Get Master Prayer List for Logged In User ***********************************-->
<!--******************* NECESSARY FOR EXTRACTION OF HIDDEN FIELDS pulled from tec_getmyprayer script ***********************-->
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
        url: 'services/tec_getmasterprayerlistforuser.php',
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
                    }
                })
    });
</script>

<!--***************************** Get Which MyPrayer Item's 'Update' button was clicked ***********************************-->
<!--***************************** Get Which MyPrayer Item's 'Update' button was clicked ***********************************-->
<!--***************************** Get Which MyPrayer Item's 'Update' button was clicked ***********************************-->
<script type="text/javascript">
var myclickbuttonid = "NA";
var mytestforChild = "0";
var parentTable;
var myprayerID = "0";
var myprayerDate = "0";
var myprayerAnswer = "0";
var myprayerWho = "0";
var myprayerTitle = "0";
var myprayerType = "0";
var myprayerText = "0";
var prayerText;
var gethiddencol = "0";
var jQ10 = jQuery.noConflict();
jQ10(document).ready(function () {
    jQ10("#myexistprayertable tbody").on("click", '.updatecolumn', function () {
        console.log("********** Update button clicked ************");
        mytestforChild = jQ10(this).closest('tr');
        if (mytestforChild.hasClass("child")) {
            console.log("******** HAS CHILD ******")
            myprayerID = mytestforChild.prev("tr").find(".indexcol").text();
            myclickbuttonid = myprayerID;
            jQ10("#ModalEditprayerID").html(myprayerID);
            console.log("myclickbuttonid (this jQ10 entry) = " + myclickbuttonid);
            myprayerDate = mytestforChild.prev("tr").find(".myprayer_update").text();
            jQ10("#ModalEditprayerDate").html(myprayerDate);
            myprayerAnswer = mytestforChild.prev("tr").find(".myprayer_answer").text();
            if(myprayerAnswer == " Answered "){
                jQ10("#ModalEditprayerAnswer").html("YES");
            }
            else{
                jQ10("#ModalEditprayerAnswer").html("NO");
            }
            myprayerTitle = mytestforChild.prev("tr").find(".myprayer_title").text();
            jQ10("#ModalEditprayerTitle").html(myprayerTitle);
// ************************ p_fullname, p_text, p_type extracted from jQ19 above ****************************
            myprayerWho = p_fullname[myprayerID];
            jQ10("#ModalEditprayerWho").html(myprayerWho);
            myprayerText = p_text[myprayerID];
            jQ10("#ModalEditprayerText").html(myprayerText);
            myprayerType = p_type[myprayerID];
            if(myprayerType == "Prayer"){
                jQ10("#ModalEditprayerType").html("Prayer Request");
            }
            else{
                jQ10("#ModalEditprayerType").html("Praise");
            }
            // Display My Existing Prayer Request Details popup
            jQ10("#ModalEditExistingRequest").modal('show');
        }
        else {
            console.log("******** NOT CHILD ******")
            myprayerID = jQ10(this).closest('tr').find(".indexcol").text();
            myclickbuttonid = myprayerID;
            jQ10("#ModalEditprayerID").html(myprayerID);
            console.log("********** Details button clicked ************");
            console.log("myclickbuttonid (this jQ10 entry) = " + myclickbuttonid);
            myprayerDate = jQ10(this).closest('tr').find(".myprayer_update").text();
            jQ10("#ModalEditprayerDate").html(myprayerDate);
            myprayerAnswer = jQ10(this).closest('tr').find(".myprayer_answer").text();
            if(myprayerAnswer == " Answered "){
                jQ10("#ModalEditprayerAnswer").html("YES");
            }
            else{
                jQ10("#ModalEditprayerAnswer").html("NO");
            }
            myprayerWho = mytestforChild.closest("tr").find(".myprayer_who").text();
            jQ10("#ModalEditprayerWho").html(myprayerWho);
            myprayerTitle = jQ10(this).closest('tr').find(".myprayer_title").text();
            jQ10("#ModalEditprayerTitle").html(myprayerTitle);
// ************************ p_fullname, p_text, p_type extracted from jQ19 above ****************************
            myprayerWho = p_fullname[myprayerID];
            jQ10("#ModalEditprayerWho").html(myprayerWho);
            myprayerText = p_text[myprayerID];
            jQ10("#ModalEditprayerText").html(myprayerText);
            myprayerType = p_type[myprayerID];
            if(myprayerType == "Prayer"){
                jQ10("#ModalEditprayerType").html("Prayer Request");
            }
            else{
                jQ10("#ModalEditprayerType").html("Praise");
            }
            // Display My Existing Prayer Request Details popup
            // jQ10("#ModalExistingRequest").modal('hide');
            jQ10("#ModalEditExistingRequest").modal('show');
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
                <div class="col-xs-6">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Requests
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item" data-toggle="modal" data-target="#ModalPrayerNew" type="button">New Prayer Request</button>
                        </div>
                    </div><!-- dropdown -->
                </div><!-- col xs-6 -->
            </div><!-- row -->
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-body">
                        <h4 class="card-title">Creating and Managing Your Prayer Requests</h4>
                        <ul class="card-text">
                            <li><u>Create new prayer requests</u> allowing your church family to pray with you</li>
                            <ul>
                                <li>Click the <span class="btn btn-secondary btn-sm">My Requests</span> button and select <u>'New Prayer Request'</u> to create a new prayer request</li>
                                <li>Enter your request details and click the <span class="btn btn-primary btn-sm">Submit</span> button send it out</li>
                                <li><u>PLEASE NOTE</u> that all prayer requests are reviewed by our church elders before they are posted to the site</li>
                            </ul>
                            <li><u>Manage your existing prayer requests</u></li>
                            <ul>
                                <li>Select an active prayer request from the list below and click the <span class="btn btn-success btn-sm">Update</span> button to modify an existing prayer request</li>
                                <li>On the prayer request details popup:</li>
                                <ul>
                                    <li>Click the <span class="btn btn-success btn-sm">Update</span> button on the selected prayer request to update with any new information</li>
                                    <li>Click the <span class="btn btn-primary btn-sm">Answered</span> button on the selected prayer request to acknowledge an answered prayer</li>
                                    <li><u>PLEASE NOTE</u> Answered prayers are considered closed and cannot be further updated</li>
                                </ul>
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
                                <h3 class="card-title pt-2"><strong>MY ACTIVE PRAYER REQUESTS</strong></h3>
                                <p>Update and manage your active prayer requests.</p>
                            </div>
                        </div>
                    </div><!-- Card -->
                </div><!-- Col-md-12 -->
            </div><!-- Row -->
<!-- ******************************* My Prayer List Card ************************************** -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bg-light border-primary px-2 my-2 w-100">
                        <div class="card-body">
                            <div class="table-responsive-xs">
                                <!-- <table id="activeprayertable" class="table table-sm table-striped dt-responsive" cellspacing="0" border="0" width="100%"> -->
                                <table id="myexistprayertable" class="table table-sm table-striped 'display responsive nowrap'" width="100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="dtr-myprayercolumn"></th>
                                            <th>id</th>
                                            <th>Opened</th>
                                            <th>Title</th>
                                            <th>Update</th>
                                            <th>Answer</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Text</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="table-dark">
                                        <tr>
                                            <th class="dtr-myprayercolumn"></th>
                                            <th>id</th>
                                            <th>Opened</th>
                                            <th>Title</th>
                                            <th>Update</th>
                                            <th>Answer</th>
                                            <th>Name</th>
                                            <th>Type</th>
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
                    <div class="modaleditform border border-light p-2">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">Prayer ID:</div>
                                    <div class="col-8 text-left"><span id="ModalEditprayerID"></span></div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">Date:</div>
                                    <div class="col-8 text-left"><span id="ModalEditprayerDate"></span></div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">From:</div>
                                    <div class="col-8 text-left"><span id="ModalEditprayerWho"></span></div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">Title:</div>
                                    <div class="col-8 text-left"><span id="ModalEditprayerTitle"></span></div>
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-4 text-right font-weight-bold">Updated:</div>
                                    <div class="col-2 text-left"><span id="ModalEditprayerUpdate"></span></div>
                                    <div class="col-3 text-right font-weight-bold">Answered:</div>
                                    <div class="col-3 text-left"><span id="ModalEditprayerAnswer"></span></div>
                                </div><!-- row -->
                                <div  class="card">
                                    <div class="card-body" id="ModalEditviewpraytable">
                                        <h5 class="card-title" id="ModalEditprayerType"></h5>
                                        <p class="card-text text-sm-left"  id="ModalEditprayerText"></p>
                                    </div><!-- card-body -->
                                </div><!-- card -->
                                <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-xs-4">
                                            <button type="button" name="ModalEditupdateexistingprayer" id="ModalEditupdateexistingprayer" class="btn btn-success btn-sm">Update</button>
                                        </div>
                                        <div class="col-xs-4">
                                            <button type="button" name="ModalEditanswerexistingprayer" id="ModalEditanswerexistingprayer" class="btn btn-primary btn-sm">Answered</button>
                                        </div>
                                        <div class="col-xs-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- btn-group -->
                                </div><!-- row -->
                            </div><!-- table-respomsive -->
                    </div><!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->




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
