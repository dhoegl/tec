<?php
//Last Updated 11/27/2020
//TEC check if logged in

session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
else {
  echo "<script language='javascript'>";
  echo "console.log('Login successful - SESSION[logged in] = " . $_SESSION['logged in'] . "');";
  echo "</script>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
  <!-- Test custom styles (Includes TEC style details) -->
  <link href="css/tec_home.css" rel="stylesheet">
</head>

<body>

<!-- <header> -->
        <!--Navbar-->
        <?php
                $activeparam = '1'; // sets nav element highlight
                require_once('tec_nav.php');
                require_once('includes/tec_footer.php');
            ?>
<!-- </header> -->

<!--Mask-->
<div id="intro" class="view">
    <div class="mask rgba-black-strong">
        <div class="container-fluid d-flex align-items-center justify-content-center h-100">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-md-10">
                    <!-- Heading -->
                    <h2 class="display-4 font-weight-bold white-text pt-5 mb-2">TEC Family Connections</h2>
                    <!-- Divider -->
                    <hr class="hr-light">
                    <!-- Description -->
                    <h4 class="white-text my-4">Access to your church family starts here!</h4>
                    <h6 class="white-text my-4">Click on the navigation bar above to go to your desired page.</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.Mask-->


  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
  <!-- Tenant Configuration JavaScript Call in tec_nav -->
  <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
</body>

</html>