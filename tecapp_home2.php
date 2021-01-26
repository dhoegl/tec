<?php
//Last Updated 11/27/2020
//TECAPP check if logged in

session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tecapp_welcome.php");
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
  <!-- Test custom styles (for home2 page) -->
  <link href="css/home2.css" rel="stylesheet">
</head>

<body>

  <!--  Start your project here-->

<header>
        <!--Navbar-->
        <?php
                $activeparam = '1'; // sets nav element highlight
                require_once('tecapp_navtest.php');
            ?>
</header>

<!-- <nav class="navbar navbar-expand-lg navbar-dark primary-color">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
</nav>   -->

<!--Mask-->
<div id="intro" class="view">
    <div class="mask rgba-black-strong">
        <div class="container-fluid d-flex align-items-center justify-content-center h-100">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-md-10">
                    <!-- Heading -->
                    <h2 class="display-4 font-weight-bold white-text pt-5 mb-2">Travel</h2>
                    <!-- Divider -->
                    <hr class="hr-light">
                    <!-- Description -->
                    <h4 class="white-text my-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti consequuntur.</h4>
                    <button type="button" class="btn btn-outline-white">Read more<i class="fa fa-book ml-2"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.Mask-->


<div style="height: 100vh">
    <div class="flex-center flex-column">
      <h1 class="animated fadeIn mb-2">Material Design for Bootstrap</h1>

      <h5 class="animated fadeIn mb-1">Thank you for using our product. We're glad you're with us.</h5>

      <p class="animated fadeIn text-muted">MDB Team</p>
    </div>
  </div>

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
  <!-- Tenant Configuration JavaScript Call in tecapp_nav -->
  <script type="text/javascript" src="/js/tecapp_config_ajax_call.js"></script>
</body>

</html>