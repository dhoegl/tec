<?php 
//Version 08/18/2019 - Add Gender into registry (used to help determine Him/Her selection in Directory table
    session_start();
    require_once 'tec_dbconnect.php';
    // One-Time Session variable set - used for event_logs_update check at tec_register_submit.php
    $_SESSION['register_check'] = TRUE;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >
    <title>Please Register</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/MDBootstrap4191/style.css" rel="stylesheet">

    <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


    <!-- Bootstrap 4 BETA CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">     -->
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
<!--    <link href="css/signin.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">
    
<!-- Initialize jquery js script -->
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>

<!-- jQuery (necessary for Bootstrap's (BOOTSTRAP 4 BETA) JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<!-- Form field reset script - in case of back button usage to return to this form -->
<script type="text/javascript" src="js/reset_register_form.js"></script>
      
<!-- Registration submission check script -->
<script type="text/javascript" src="js/tec_register_submit_check.js"></script>

</head>

<body>
<?php
    $firstname = "";
    $lastname = "";
    $gender = "";
    $emailaddr = "";
    $repeatemailaddr = "";
    $gender = "";
    $username = "";
    $password = "";
    $repeatpassword = "";

// Add Footer to page
    require_once('includes/tec_footer.php');
?>

<!-- Navbar for Registration cycle only-->
<nav class="navbar navbar-dark orange darken-4 fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="tec_welcome.php">Trinity Evangel Church</a>
    </div>
</nav>
<div class="container-fluid profile_bg">
    <div class="row pt-2">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                How do I register
            </button>
        </p>
    </div> <!-- row -->
    <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Confirmation Code</h4>
                        <ul class="card-text">
                            <li>If your administrator may have provided a Code for you, select Yes and enter the 5-digit Confirmation Code.</li>
                        </ul>
                        <h4 class="card-title">User Name</h4>
                        <ul class="card-text">
                            <li>Select a unique User Name for your registration.</li>
                            <li>User Name must be 5 or more characters.</li>
                        </ul>
                        <h4 class="card-title">Password</h4>
                        <ul class="card-text">
                            <li>Password must be at least 7 characters, contain one uppercase letter, one lowercase letter, and one number (0-9) or one special character.</li>
                        </ul>
                    </div>
            </div> <!-- col-sm-6 -->
            <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">First and Last Name</h4>
                        <ul class="card-text">
                            <li>First and Last Name must contain at least one character.</li>
                        </ul>
                        <h4 class="card-title">Email Address</h4>
                        <ul class="card-text">
                            <li>Email address will be used to correspond with other church family members.</li>
                        </ul>
                        <h4 class="card-title">What happens next</h4>
                        <ul class="card-text">
                            <li>After completing this entry form, our administrators will verify and approve your request to access our site.</li>
                            <li>You will be notified via email (using the address at left) that your access has been granted.</li>
                            <li>If you don't receive an email notification within 48 hours <strong>(don't forget to check your Junk Mail folder)</strong>, please contact one of our church elders for assistance.</li>
                        </ul>
                    </div>
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
        <br>
    </div> <!-- collapse --> 
    <div class="row">
        <div class="col-sm-12">
<!--            <div class="card bg-light border-primary m-3">-->
            <div class="card bg-light border-primary p-3">
                <h2 class="text-center">WELCOME</h2>
                <h3 class="text-center">Please Register</h3>
                <h4 align="center"><strong><font color="red">* All fields MUST be filled in</font></strong></h4>
<!--                <h4 align="center"><strong>Note:</strong> Password must be at least 7 characters, contain one uppercase letter, one lowercase letter, and one number (0-9) or one special character.</h4>-->
                <!--<form name='registernew' id="register" method="POST">-->
                <form name='registernew' id="register" action='services/tec_register_submit.php' method="POST">
                    <div class="form-group">
                        <label for="confirmcode">I received a Confirmation Code:</label>
                        <div class="form-check churchcodecheck">
                            <input class="form-check-input" type="radio" name="confirmcode" id="codeyes" value="YES">
                                <label class="form-check-label" for="codeyes">YES</label>
                        </div>
                        <div class="form-check churchcodecheck">
                            <input class="form-check-input" type="radio" name="confirmcode" id="codeno" value="NO" checked>
                                <label class="form-check-label" for="codeno">NO</label>
                        </div>
                        <label id="churchcodelabel" for="churchcode">Enter your 5-digit Confirmation Code: <strong><font color="red">*</font></strong><span id="confirm_code_len"></span></label>
                        <input type="text" class="form-control" name="churchcodename" id="churchcode" aria-describedby="churchcode" placeholder="confirmation code">
                        </input>
                        <label for="username">Select a User Name: <strong><font color="red">*</font></strong><span id="unique_user"></span></label>
                        <input type="text" class="form-control" name="usernamename" id="username" aria-describedby="emailHelp" placeholder="UserName">
                        </input>
                        <label for="password">Choose a Password: <strong><font color="red">*   </font></strong><span id="register_result"></span></label>
                        <input type="password" class="form-control" name="passwordname" id="password" aria-describedby="emailHelp" placeholder="StrongPassword">
                        </input>
                        <label for="repeatpassword">Re-enter your Password: <strong><font color="red">*   </font></strong><span id="password_match"></span></label>
                        <input type="password" class="form-control" id="repeatpassword" aria-describedby="emailHelp" placeholder="StrongPassword">
                        </input>
                        <label for="firstname">Your First Name: <strong><font color="red">*</font></strong></label>
                        <input type="text" class="form-control" name="firstnamename" id="firstname" aria-describedby="emailHelp" placeholder="First Name">
                        </input>
                        <label for="lastname">Your Last Name: <strong><font color="red">*</font></strong></label>
                        <input type="text" class="form-control" name="lastnamename" id="lastname" aria-describedby="emailHelp" placeholder="Last Name">
                        </input>
                        <label for="gendercode">Your Gender: <strong><font color="red">*</font></strong></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input gendercheckmale" type="radio" name="gendercode" id="codemale" value="Male">
                                <label class="form-check-label" for="codemale">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input gendercheckfemale" type="radio" name="gendercode" id="codefemale" value="Female">
                                <label class="form-check-label" for="codefemale">Female</label>
                        </div>
                        <div class="label label-default">
                            <label for="emailaddress">Your Email Address: <strong><font color="red">*</font></strong><span id="email_choose"></span></label>
                        </div>
                        <input type="email" class="form-control" name="emailaddressname" id="emailaddress" aria-describedby="emailHelp" placeholder="Email Address">
                        <div class="label label-default">
                            <label for="repeatemailaddress">Re-enter your Email Address: <strong><font color="red">*</font></strong><span id="email_match"></span></label>
                            <input type="email" class="form-control" id="repeatemailaddress" aria-describedby="emailHelp" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-secondary" name="clear" value="Clear" />
                        <input type="submit" class="btn btn-primary disabled" name="registersubmit" id="register_submit" value="Register" />
                    </div>
                </form>
            </div> <!--card-->
        </div> <!--col-sm-6-->
    </div> <!-- row -->
</div> <!-- container -->

<?php
		
    $submit = $_POST['submit'];
    $clear = $_POST['clear'];

    $confirmcode = strip_tags($_POST['churchcodename']);
    $username = strip_tags($_POST['usernamename']);
    $password = strip_tags($_POST['passwordname']);
    $firstname = strip_tags($_POST['firstnamename']);
    $lastname = strip_tags($_POST['lastnamename']);
    $gender = strip_tags($_POST['gendercode']);
    $emailaddr = strip_tags($_POST['emailaddressname']);
    $date = date("Y-m-d");
	
    if($clear)
    {
        $confirmcode = "";
        $username = "";
        $password = "";
        $firstname = "";
        $lastname = "";
        $emailaddr = "";
        $gender = "";
    }
    if ($submit)
    {
        if(all_req_fields == 'Y'){
            echo '<script language="javascript">';
            echo 'alert("All Required Fields are correct")';
            echo '</script>';
        }
        else {
            echo '<script language="javascript">';
            echo 'alert("Missing Required Fields")';
            echo '</script>';
        }

    }
?>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>

</body>
</html>
