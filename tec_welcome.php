<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--SECOND TEST TO CONFIRM SAVE TO PC AND GITHUB-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Welcome to TEC Family Connections</title>
<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
    <link href="css/bootstrap453/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
    <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
    <link href="css/MDBootstrap4191/style.css" rel="stylesheet">
    <link href="css/tec_css_style.css" rel="stylesheet" />
    <link href="css/tec_welcome_style.css" rel="stylesheet" />

  <style type="text/css">
    /* Chart.js */
        @-webkit-keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }
            to {
                opacity: 1
            }
        }
        @keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }
            to {
                opacity: 1
            }
        }
        .chartjs-render-monitor {
            -webkit-animation: chartjs-render-animation 0.001s;
            animation: chartjs-render-animation 0.001s;
        }
    </style>

</head>
<body>
  <!--Footer-->
    <?php
        require_once('includes/tec_footer.php');
    ?>

    <header>
        <!-- Navbar -->
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-dark primary-color"> -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark orange darken-4">
    <a class="navbar-brand" href="tec_welcome.php">
        <img id="nav_logo" width="30" height="30" class="d-inline-block align-top" alt="Logo" />
        <span id="navbar_brand"></span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <?php
        if(!$_SESSION['logged in']) {
            session_destroy();
            echo '<ul class="navbar-nav mr-auto">';
            echo '</ul>';
            echo '<span class="nav-link">';
            // echo '<a class="btn btn-light" href="https://trinityevangelchurch.snappages.site/" role="button">Back to App</a>';
            echo '<a class="btn btn-light" href="http://trinityevangel.org/" role="button">Go to TEC website</a>';
            echo '</span>';
        }
        else
        {
            $homeurl = "location:tec_home.php";
            header($homeurl);
        }
    ?>
  </div>
</nav>  

        <div class="container-fluid">
            <div class="heavy-rain-gradient">
                <div class="row mt-5 pt-5 mx-auto">
                    <div class="card mx-auto mt-3 pt-5" style="width: 100%">
                        <div class="card mx-auto" style="width: 15rem;">
                            <img src="_tenant/images/TEC App Icon 08.png" class="card-img-top max-width: 100%" alt="..." />
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                        </div>
                        <div class="card-body text-center">
                            <div class="text-center">
                                <h3 class="white-text">
                                    <i class="white-text"></i> TEC Family Connections
                                </h3>
                                <h3 class="white-text">
                                    <i class="white-text"></i>Please sign in
                                </h3>
                            </div><!--text-center-->
                            <form name="form1" method="post" class="text-center" action="tec_checklogin.php">
                                <div class="md-form">
                                    <i class="white-text active"></i>
                                    <input type="text" id="form-user" name="myusername" class="white-text form-control" />
                                    <label for="form_user" class="active">username</label>
                                </div><!--md-form-->
                                <div class="md-form">
                                    <i class="white-text active"></i>
                                    <input type="password" id="form_pass" name="mypassword" class="white-text form-control" />
                                    <label for="form_pass" class="active">password</label>
                                </div><!--md-form-->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success">Sign-in</button>
                                </div><!--text-center-->
                            </form>
                            <div>
                                <!--btn-->
                                <span>
                                    <a class="btn btn-primary" href="tec_register.php" role="button">Register</a>
                                    <a class="btn btn-danger" href="tec_recover.php" role="button">Forgot Password</a>
                                </span>
                                <h6 class="text-center white-text">
                                    If you have not yet registered, click on the REGISTER button above, and fill out your information on the form
                                </h6>
                                <h6 class="text-center white-text">
                                    If you forgot your password, click on the FORGOT PASSWORD button above to be sent a temporary password to your email address on file
                                </h6>
                                <p class="fs-6 text-start white-text">
                                    (version tec_20210130.1)
                                </p>
                            </div><!--btn-->
                        </div><!--card-body-->
                    </div><!--card-->
                </div><!--Row-->
                <div class="row mt-4">
                    <div class="col-md-12 mb-5 mt-5 white-text">
                        <div class="card">
                            <div class="card-body">
                                <!--Header-->
                                <div class="text-center">
                                    <h3 class="white-text">
                                        <i class="white-text"></i> Newly designed!
                                    </h3>
                                </div><!--text-center-->
                                <div class="text-left">
                                    <p class="white-text">
                                        <i class="white-text"></i> Welcome to a much more mobile-friendly experience...
                                        <ul>
                                            <li>
                                                Now improved to work on all your mobile devices and computers
                                            </li>
                                            <li>
                                                Easy-to-navigate dropdown menus (when in mobile view, tap the 3-bars at the top of the screen)
                                            </li>
                                            <li>
                                                On busy pages, rotating your device will expose more information - especially on smaller (narrow) devices
                                            </li>
                                            <li>
                                                Helpful tips are included throughout
                                            </li>
                                        </ul>
                                    </p>
                                </div><!--text-left-->
                            </div><!--card-body-->
                        </div><!--card-->
                    </div><!--Grid column-->
                </div><!--row-->
            </div><!--gradient-->
        </div><!--container-->
    </header>
            <!--</div>-->
        <!--</div>-->

    <!--</main>-->
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
    <!--<script>
        new WOW().init();
    </script>-->

</body>
</html>