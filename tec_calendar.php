<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}

   require_once('tec_dbconnect.php');

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

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/MDBootstrap4191/style.css" rel="stylesheet">
  <!-- Call Moment js for date calc functions -->
  <script src="/js/moment.js"></script>
  <!-- JQuery -->
  <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script>

    <!-- Call Fullcalendar CSS & JS scripts -->
    <link href='fullcalendar-5.4.0/lib/main.css' rel='stylesheet' />
    <script src='fullcalendar-5.4.0/lib/main.js'></script>

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
    <!-- Test custom styles (Includes TEC style details) -->
    <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          height: 700,
          events: {
            url: '/includes/tec_get_calendar_data.php',
            method: 'POST'
          }
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <!--Navbar-->
    <?php
        $activeparam = '4';
        require_once('tec_nav.php');
        require_once('includes/tec_footer.php');
    ?>
    <!-- Intro Section -->
    <div class="container-fluid profile_bg bottom-buffer">
    <div class="row pt-2">
        <div class="col-sm-12">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Click here to learn about the Calendar
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
                                <span style="background-color:red; color:white;">RED</span>
                            </li>
                            <li>
                                Kids' Birthdays highlighted in
                                <span style="background-color:yellow; color:black;">YELLOW</span>
                            </li>
                        </ul>
                    </div>
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
        <br>
    </div> <!-- collapse --> 
    <div class="row">
            <div class="col-sm-12">
                <div class="card card-image"
                    style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                    <!-- Content -->
                    <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                        <div class="w-100">
                            <h3 class="card-title pt-2"><strong>BIRTHDAYS and ANNIVERSARIES</strong></h3>
                            <p>Celebrate with us.</p>
                        </div>
                    </div>
                </div><!-- Card -->
            </div><!-- Col-md-12 -->
        </div><!-- Row -->
<!--*****************************Calendar***********************************-->

<div class="row">
    <div class="col-sm-12">
        <div class="card bg-white border-primary px-1 w-100">
            <div class="card-body">
                <div id='calendar' class='px-1' style='margin:1em 0;font-size:13px;border:solid'></div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
  </body>
</html>