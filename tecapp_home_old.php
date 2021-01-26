<?php 
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tecapp_welcome.php");
	exit();
}
?> 

<!DOCTYPE html>
<html lang="en" class="full-height">

<head>
<!-- BOOTSTRAP 4 - Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
 -->    <title>Home</title>
    
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <!-- Google Fonts - Roboto -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> -->
    <!-- Bootstrap core CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">     -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">    Material Design Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap453/bootstrap.min.css">
    <!-- <link href="css/mdb459.min.css" rel="stylesheet"> -->
    <!-- Your custom styles (optional) -->
    <!--<link href="css/style.css" rel="stylesheet">-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <link href="css/ofc_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">

</head>

<body>

        <!--Main Navigation-->
        <header>
        <!--Navbar-->
            <?php
                $activeparam = '1'; // sets nav element highlight
                require_once('tecapp_nav.php');
            ?>


            <!-- Intro Section -->
            <div class="view hm-black-light jarallax" data-jarallax='{"speed": 0.2}' id="backsplash">
                <!--<div class="view" style="height: 100%; background-image: url('../images/master_welcome.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">-->
                <!--<div class="view" id="backsplash">-->
                <!--<div class="full-bg-img">-->

                <!--TEST-->
                <div class="container flex-center">
                    <div class="row pt-5 mt-3">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-3 wow fadeInDown" data-wow-delay="0.3s" id="custname">
                                    <strong></strong>
                                </h1>
                                <hr class="hr-light mt-4 wow fadeInDown" data-wow-delay="0.4s" />
                                <h5 class="text-uppercase mb-1 white-text wow fadeInDown" data-wow-delay="0.4s" id="TagLine">
                                    <strong>tagline</strong>
                                </h5>
                                <a class="btn btn-primary wow fadeInDown" data-wow-delay="0.4s" id="gotosite">To Our Home Page</a>




                                <!--Keep commented out--><!--<a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s">Upcoming classes</a>-->



                                <!--TEST-->
                                <a class="btn btn-primary wow fadeInDown" data-wow-delay="0.4s" id="contactus">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="row fixed-bottom">
                        <div class="col-md-12">
                            <div class="text-center">
                                <?php
                                require_once('/includes/tecapp_footer.php')
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- view -->

</header>
        <!--Main Navigation-->




<!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <!-- <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script> -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/poppernew.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="js/bootstrap453/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdbnew.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- Tenant Configuration JavaScript Call from tecapp_home -->
    <script type="text/javascript" src="/js/tecapp_config_ajax_call.js"></script>

</body>

</html>