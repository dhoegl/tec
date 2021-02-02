<?php 
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
    require_once('tec_dbconnect.php');
    require_once('fpdf/fpdf.php');
    // Event Log  trap
    include('../includes/event_logs_update.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- BOOTSTRAP - Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

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
  <!-- Test custom styles (Includes TEC style details) -->
  <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">
  <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

  <!-- Call Moment js for date calc functions -->
  <script src="/js/moment.js"></script>
    <!-- JQuery -->
    <!-- <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script> -->
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.1.0.min.js"></script>


    
<!--******************************* Include family list extract **************************************-->
<?php
    // echo "<script language='javascript'>";
    // echo "console.log('ARRIVED at script to include familylist2');";
    // echo "</script>";
    // Get Family Details List
    include('includes/tec_view_familylist2.php');
?>
    

</head>

<body>
    <!--Navbar-->
    <?php
        $activeparam = '3'; // sets nav element highlight
        require_once('tec_nav.php');
        require_once('includes/tec_footer.php');
    ?>
    
    <!-- Intro Section -->
    <div class="container-fluid profile_bg bottom-buffer">
        <div class="row pt-2">
            <div class="col-sm-6">
                <p>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Using and downloading the directory
                    </button>
                </p>
            </div><!-- col sm-6 -->
            <!-- <div class="col-sm-3">
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2 pt-2" role="group" aria-label="Button group with nested dropdown">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Download</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" data-toggle="modal" data-target="#ModalProfilePic" type="button">PDF</button>
                                <button class="dropdown-item" data-toggle="modal" data-target="#ModalContactInfo" type="button">CSV</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-sm-3">
                <p>
                    <a href="services/pdf_download2.php" class="btn btn-primary" type="button">Download PDF</a>
                </p>
            </div>
            <div class="col-sm-3">
                <p>
                    <a href="services/csv_download.php" class="btn btn-primary" type="button">Download Spreadsheet</a>
                </p>
            </div> -->
        </div><!-- row -->
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Sorting, Searching, and Paging</h4>
                        <ul class="card-text">
                            <li>Click on a header arrow to sort columns ascending or descending</li>
                            <li>Use the Search box to find a family member's information</li>
                            <li>Navigate pages using the Page Selector at the bottom of the page</li>
                            <li>Click the <span><img src="https://datatables.net/examples/resources/details_open.png"></img></span> icon to display more details</li>
                        </ul>
                    </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Actions </h4>
                        <ul class="card-text">
                            <li class="card-text">
                                Click the <span class="btn btn-success">View</span> button on a row below to see more information about a Family member
                            </li>
                            <li class="card-text">
                                Click an '<u>email address</u>' to launch your own email service and send a word of encouragement!
                            </li>
                        </ul>
                        <h4 class="card-title">Download</h4>
                        <ul>
                            <li class="card-text">
                                Click <a href='services/pdf_download2.php'class='btn btn-info' role='button'>PDF HERE</a> to download a PDF copy of your Family Directory
                            </li>
                            <li class="card-text">
                                Click <a href='services/csv_download.php'class='btn btn-info' role='button'>CSV HERE</a> to download a spreadsheet copy of your Family Directory
                            </li>
                        </ul>
                    </div>
                </div><!-- col-sm-12 -->
            </div><!-- row -->
        </div><!--  collapse -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-image"
                    style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                    <!-- Content -->
                    <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                        <div class="w-100">
                            <h3 class="card-title pt-2"><strong>CHURCH DIRECTORY</strong></h3>
                            <p>Keep in touch with your church family.</p>
                        </div>
                    </div>
                </div><!-- Card -->
            </div><!-- Col-md-12 -->
        </div><!-- Row -->

<!-- ******************************* Church Directory Card ************************************** -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card bg-light border-primary px-2 my-2 w-100">
                    <div class="card-body">
                        <div class="table-responsive-xs">
                        <table id="familytable2" class="table table-sm table-striped 'display responsive nowrap'" width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="dtr-familycolumn"></th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone Numbers **</th>
                                    <th>Email Address</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                // Get Active Family List
                                // include('includes/tec_getfamilylist2.php');
                            ?>
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <th class="dtr-familycolumn"></th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone Numbers **</th>
                                    <th>Email Address</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col-sm-12 -->
        </div><!-- row -->
    </div> <!-- Container -->

  <!-- SCRIPTS -->
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
  <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <!-- ***** THESE ARE BEING TESTED -->
    <!-- Jan31 Attempt -->
    <!-- Copied from https://www.datatables.net/download/index -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.7/datatables.min.js"></script>
    <!-- Works kind of -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/r-2.2.6/datatables.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->

    <!-- Works but not responsive -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
    <!-- Call Image Verify jQuery script -->
    <script src="/js/image_verify.js"></script>
    
</body>
</html>
