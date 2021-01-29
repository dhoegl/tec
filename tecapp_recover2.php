<?php 
session_start();
require_once 'tec_dbconnect.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Recover Password</title>

    <!-- Bootstrap 4 BETA CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
<!--    <link href="css/signin.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <link href="css/ofc_css_style.css" rel="stylesheet">
    
<!-- Initialize jquery js script -->
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>

<!-- jQuery (necessary for Bootstrap's (BOOTSTRAP 4 BETA) JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    
<!-- Registration submission check script -->
<script type="text/javascript" src="js/ofc_register_submit_check.js"></script>

</head>

<body>
<?php
    $firstname = "";
    $lastname = "";
    $gender = "";
    $emailaddr = "";
    $repeatemailaddr = "";
    $username = "";
    $password = "";
    $repeatpassword = "";
?>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="tec_welcome.php">OurFamilyConnections</a>
    </div>
</nav>
<div class="container-fluid profile_bg">
    <div class="row">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                How do I reset my password
            </button>
        </p>
    </div> <!-- row -->
    <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Password Reset</h4>
                        <ul class="card-text">
                            <li>In the box below, enter your username, and click the 'Reset Password' button. An email will be sent to the address provided with your username and a link to reset your password.</li>
                            <li>Check your mailbox for the email requesting you to reset your password (don't forget to check your Junk or Spam folder).</li>
                            <li>Click on the hyperlink in the email and enter a new password at the Password Reset page.</li>
                            <li>If you don't receive an email notification within a few minutes, please contact one of your administrators for assistance.</li>
                            <br />
                            <li><strong>NOTE: </strong>Password must be at least 7 characters, contain one uppercase letter, one lowercase letter, and one number (0-9) or one special character.</li>
                        </ul>
                    </div>
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
        <br>
    </div> <!-- collapse --> 
    <div class="row">
        <div class="col-sm-6">
<!--            <div class="card bg-light border-primary m-3">-->
            <div class="card bg-light border-primary p-3">
                <h3 class="text-center">Please enter your username below</h3>
                <form name='passwordreset' id="reset" action='services/tec_recover_submit.php' method="POST">
                    <div class="form-group">
                        <label for="emailaddress">
                            Enter your username:
                            <strong>
                                <font color="red">*</font>
                            </strong>
                            <span id="username_unconfirmed"></span>
                            <span id="username_confirmed"></span>
                            <!--<span id="unique_user"></span>-->
                        </label>
                        <input type="text" class="form-control" name="username" id="usernameID" aria-describedby="username" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-secondary" name="clear" value="Clear" />
                        <input type="submit" class="btn btn-primary disabled" name="password_reset" id="reset_submit" value="Reset Password" />
                    </div>
                </form>
            </div> <!--card-->
        </div> <!--col-sm-6-->
        <div class="col-sm-6">
            <div class="card bg-light border-primary text-center p-3">
                <img class="card-img-top" src="images/ourfamilyconnections4.png" style="width: 75%; align-self: center" alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title">What happens next</h3>
                    <p>After entering your username, you will receive a notification in the mailbox setup in your account.</p>
                    <p>If you don't receive an email notification within a few minutes <strong>(don't forget to check your Junk or Spam folder)</strong>, please contact one of your administrators for assistance.</p>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col-sm-6 -->
    </div> <!-- row -->
</div> <!-- container -->

<?php
		
    $submit = $_POST['submit'];
    $clear = $_POST['clear'];

    $username = strip_tags($_POST['usernamename']);
	
    if($clear)
    {
        $username = "";
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
//        if($username&&$emailaddr&&$firstname&&$lastname&&$password&&$gender)
//        {
//            if($emailaddr==$repeatemailaddr)
//            {
//                if($password==$repeatpassword)
//                {
//                    if(strlen($password)<7||strlen($password)>19)
//                    {
//                    echo "<strong><font color='Red'>Password must be at least 7 characters and less than 20 characters in length.</font> Please retry</strong>";
//                    }
//                        else 
//                        {
//                            //Register the User
//                            $password = md5($password);
//                            $repeatpassword = md5($repeatpassword);
//                            $regentryquery = "SELECT username from " . $_SESSION['logintablename'] . " WHERE username = '" . $username . "'";
//                            $regentryexist = $mysql->query($regentryquery) or die("A database error has occurred. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());
//                            $regentrynumrows = $regentryexist->num_rows;
//                            if($regentrynumrows == 0)
//                            {
//                                if($gender == 'M') 
//                                {
//                                        $regquery = $mysql->query("INSERT INTO " . $_SESSION['dirtablename'] . " (Name_1, Surname, Email_1, Picture_Link, Picture_Taken) VALUES ('$firstname','$lastname','$emailaddr', 'x', 'N')") or die("Unable to create new user record in directory. Error : " . mysql_errno() . mysql_error());
//                                }
//                                else //$gender = 'F'
//                                {
//                                        $regquery = $mysql->query("INSERT INTO " . $_SESSION['dirtablename'] . " (Name_2, Surname, Email_2, Picture_Link, Picture_Taken) VALUES ('$firstname','$lastname','$emailaddr', 'x', 'N')") or die("Unable to create new user record in directory. Error : " . mysql_errno() . mysql_error());
//                                }
//                                $regInsertID = $mysql->insert_id;
//                                $reglogliquery = $mysql->query("INSERT INTO " . $_SESSION['logintablename'] . " (username, password, idDirectory, firstname, lastname, gender, email_addr) VALUES ('$username','$password','$regInsertID','$firstname','$lastname','$gender','$emailaddr')") or die("Unable to create new login record in directory. Error : " . mysql_errno() . mysql_error());
//                                if(!$regquery) {
//                                    if ($mysql->errno==1062) { //unable to add Directory entry due to duplicate username record in logintable
//                                        echo "<strong><font color='Red'>Someone else with that Username is already a member.</font> Please retry</strong>";
//                                    }
//                                    else {
//                                        die("A database error has occurred. Please notify your administrator with the following. Error : ".mysql_errno().mysql_error());
//                                    }
//                                }
//                                else {
//                                    $regmailadmins = $mysql->query("SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE admin_regnotify = '1'");
//                                    $regmaillink = "http://ofctest.ourfamilyconnections.org";								
//                                    while($regmailrow = $regmailadmins->fetch_assoc()) {
//                                        $regmailtest = $regmailrow['email_addr'];									
//                                        $regmailto = $regmailtest . " , " . $regmailto;
//                                    }									
//                                    $regmailsubject = "Membership Request to (OFC_TEST) Our Family Connections"."\n..";
//                                    $regmailmessage = "Hello (OFC_TEST)! " . "\n" . $firstname . " " . $lastname . " has requested to be added to Our Family Connections.\n\nLogin to our site using your admin credentials, select the <strong>Access Admin</strong> menu item, and accept or reject this request \n\n" . $regmaillink;
//                                    $regmailfrom = "newfamilyrequest@ourfamilyconnections.org";
//                                    $regmailheaders = "From:" . $regmailfrom . "\r\n";
//                                    $regmailheaders .= "MIME-Version: 1.0\r\n";
//                                    $regmailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//                                    mail($regmailto,$regmailsubject,$regmailmessage,$regmailheaders);
//                                    echo "<center><table id='profiletable'><tr><td class='strong'>Hi " . $firstname . "!  <br><br>(OFC_TEST) You should receive a welcome email within 48 hours<br>Thank you for your patience!<br><br><a href='tecwelcome.php'>Return to Login Page</a></td></tr></table></center>";
//                                        }
//
//                                }
//                                else 
//                                {
//                                        echo "<strong><font color='Red'>Someone else with that Username is already a member.</font> Please retry</strong>";
//                                }
//                            }
//                        }
//                        else
//                        {
//                                echo "<strong><font color='Red'>Your passwords do not match.</font> Please retry</strong>";
//                        } 
//                }
//                else  
//                {
//                echo "<strong><font color='Red'>Your email addresses do not match.</font> Please retry</strong>";	
//                $repeatemailaddr = "";				
//                }
//            }
//            else 
//            {
//            echo "<strong><font color='Red'>Please fill in all fields.</font> Please retry</strong>";
//            }
//    }
?>

</body>
</html>
