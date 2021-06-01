<?php 
//Last Updated 05/31/2021: Admin accept/reject script for prayer requests
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
   include('includes/tec_view_unapprovedprayerlist.php');
   
// Get Unapproved Prayer jQuery
//    include('/includes/tec_get_unapprovedprayer_jquery.php');

// Get All Prayer List
//    include('/includes/tec_view_allprayerlist.php');
   
// Get All Prayer jQuery
//    include('/includes/tec_get_allprayer_jquery.php');
   
?>



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
							<table id="unapprovedprayertable" class="table table-sm table-striped 'display responsive nowrap'" width="100%">
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/r-2.2.6/datatables.min.js"></script>
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
    <!-- Call Image Verify jQuery script -->
    <script src="js/image_verify.js"></script>


</body>
</html>