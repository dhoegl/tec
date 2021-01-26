<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tecapp_welcome.php");
	exit();
}

   require_once('tecapp_dbconnect.php');

$profileaddr = $_GET['id'];
$sqlquery = "SELECT * FROM $dir_tbl_name WHERE idDirectory = '$profileaddr'";
$result = $mysql->query($sqlquery) or die(" SQL query error Calendar table. Error:" . $mysql->errno . " : " . $mysql->error);

$count = $result->num_rows;

    while($row = $result->fetch_assoc()){
	if($row['Internet_Restrict']<>1)
	{

		$recordID = $row['idDirectory'];
		$recordFirstHim = $row['Name_1'];
		$recordFirstHer = $row['Name_2'];
		$recordLast = $row['Surname'];
		$recordBDay1 = $row['BDay_1_Date'];
		$recordBDay2 = $row['BDay_2_Date'];
		$recordAnniv = $row['Anniv_Date'];
		$recordL2L = $row['L2L_ID'];
		$recordChild_1_Name = $row['Child_1_Name'];
		$recordChild_1_BDay = $row['Child_1_Bday_Date'];
		$recordChild_2_Name = $row['Child_2_Name'];
		$recordChild_2_BDay = $row['Child_2_Bday_Date'];
		$recordChild_3_Name = $row['Child_3_Name'];
		$recordChild_3_BDay = $row['Child_3_Bday_Date'];
		$recordChild_4_Name = $row['Child_4_Name'];
		$recordChild_4_BDay = $row['Child_4_Bday_Date'];
		$recordChild_5_Name = $row['Child_5_Name'];
		$recordChild_5_BDay = $row['Child_5_Bday_Date'];
		$recordChild_6_Name = $row['Child_6_Name'];
		$recordChild_6_BDay = $row['Child_6_Bday_Date'];
		$recordChild_7_Name = $row['Child_7_Name'];
		$recordChild_7_BDay = $row['Child_7_Bday_Date'];
		$recordChild_8_Name = $row['Child_8_Name'];
		$recordChild_8_BDay = $row['Child_8_Bday_Date'];

        }
}

	$LoginQuery = "SELECT l.access_level FROM " . $_SESSION['logintablename'] . " l JOIN directory d ON d.idDirectory = l.idDirectory WHERE l.idDirectory = '" . $_SESSION['idDirectory'] . "'";
    $Loginresult = $mysql->query($LoginQuery) or die(" SQL query error at SELECT Login validation. Error:" . $mysql->errno . " : " . $mysql->error);
	$Logincount = $Loginresult->num_rows;

            while($Loginrow = $Loginresult->fetch_assoc()){
		$recordLogin_Access = $Loginrow['access_level'];
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title></title>

<!-- Bootstrap 4 BETA CSS -->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">-->
    <!-- <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css"> -->
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
<!--    <link href="css/signin.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <!-- <link href="css/jumbotron.css" rel="stylesheet"> -->
    <!-- Extended styles for this page -->
    <!-- <link href="css/tecapp_css_style.css" rel="stylesheet"> -->
    
<!-- Initialize jquery js script -->
<!--    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>-->
<!-- <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script> -->

<!-- jQuery (necessary for Bootstrap's (BOOTSTRAP 4 BETA) JavaScript plugins) -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->
    


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/MDBootstrap4191/style.css" rel="stylesheet">

  <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
<!-- <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"> -->

  <!-- Call Moment js for date calc functions -->
  <script src="/js/moment.js"></script>
  <!-- JQuery -->
  <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script>


<!--*****************************EDIT FULLCALENDAR Script***********************************-->
<!-- <link rel='stylesheet' type='text/css' href='/js/fullcalendar-1.5.4/fullcalendar/fullcalendar.css' />
<script type='text/javascript' src='/js/fullcalendar-1.5.4/jquery/jquery-1.8.1.min.js'></script>
<script type='text/javascript' src='/js/fullcalendar-1.5.4/jquery/jquery-ui-1.8.23.custom.min.js'></script>
<script type='text/javascript' src='/js/fullcalendar-1.5.4/fullcalendar/fullcalendar.min.js'></script> -->

<link rel='stylesheet' type='text/css' href='/fullcalendar-5.4.0/lib/main.css' />
<script type='text/javascript' src='/fullcalendar-5.4.0/lib/main.js'></script>


<!-- Custom styles for this template -->
<link href="css/jumbotron.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
  <!-- Test custom styles (Includes TECAPP style details) -->
  <link href="css/tecapp_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">


    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tecapp_config_ajax_call.js"></script>

<!--Get Calendar Data from ofc_get_calendar_data-->
<script type='text/javascript'>
    var getdataJQ = jQuery.noConflict();
    getdataJQ(document).ready(function() {

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

        getdataJQ('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				right: 'title'
			},
			events: '/includes/tecapp_get_calendar_data.php',
			
			eventClick: function(event) {
				if(event.url) {
					window.open(event.url);
					return false;
					}
				}			

		});
	
	});
</script>


<!--*****************************EDIT FULLCALENDAR Script***********************************-->


</head>

<body>

    <!--Navbar-->
    <?php
        $activeparam = '4';
        require_once('tecapp_nav.php');
        require_once('includes/tecapp_footer.php');
    ?>

    <!-- Intro Section -->
<div class="container-fluid profile_bg bottom-buffer">
    <div class="row pt-2">
        <div class="col-sm-12">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Using this calendar
                </button>
            </p>
        </div> <!-- col sm-12 -->
    </div> <!-- row -->
    <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Navigation</h4>
                        <ul class="card-text">
                            <li>Use Banner Arrow buttons to navigate between months</li>
                            <li>Click on a <span style="background-color:red; color:white;">Birthday</span>/<span style="background-color:green; color:white;">Anniversary</span> item to view the family's Directory information</li>
                        </ul>
                    </div>
            </div> <!-- col-sm-6 -->
            <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Color Definition</h4>
                        <ul class="card-text">
                            <li>
                                Anniversaries are highlighted in
                                <span style="background-color:green; color:white;">GREEN</span>
                            </li>
                            <li>
                                Adults' Birthdays highlighted in
                                <span style="background-color:red; color:white;">RED</span>; Kids' Birthdays highlighted in
                                <span style="background-color:yellow; color:black;">YELLOW</span>
                            </li>
                        </ul>
                    </div>
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
        <br>
    </div> <!-- collapse --> 
<!--*****************************Calendar***********************************-->
    <div class="row justify-content-center">
        <div class="col-sm-10 bg-light">
            <div id='calendar' style='margin:3em 0;font-size:13px;border:solid'></div>
        </div> <!-- col-sm-12 --> 
    </div> <!-- row -->
</div> <!-- container -->

  <!-- SCRIPTS -->
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
  <!-- Tenant Configuration JavaScript Call in tecapp_nav -->
  <!-- Datatables JavaScript plugins - Bootstrap-specific -->
    <!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tecapp_config_ajax_call.js"></script>
    <!-- Call Image Verify jQuery script -->
    <script src="/js/image_verify.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <!-- <script type="text/javascript" src="/js/tecapp_config_ajax_call.js"></script> -->

</body>
</html>