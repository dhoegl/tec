<?php
// Last Updated: 12/08/2020: Stripped most code away to verify functions work

    require_once('../tec_dbconnect.php');
    // Event Log  trap
    require_once('../includes/event_logs_update.php');


if(isset($_POST['registersubmit']))
{
	$church_code = filter_input(INPUT_POST, 'churchcodename');
	$user_name = filter_input(INPUT_POST, 'usernamename');
	$pass_word = filter_input(INPUT_POST, 'passwordname');
    $pass_word = md5($pass_word);
	$first_name = filter_input(INPUT_POST, 'firstnamename');
	$last_name = filter_input(INPUT_POST, 'lastnamename');
    $full_name = $first_name . ' ' . $last_name;
    $gender = filter_input(INPUT_POST, 'gendercode');
    $email_address = filter_input(INPUT_POST, 'emailaddressname');
    echo "<script language='javascript'>";
    echo "console.log('church_code = " . $church_code . "');";
    echo "console.log('user_name = " . $user_name . "');";
    echo "console.log('pass_word = " . $pass_word . "');";
    echo "console.log('first_name = " . $first_name . "');";
    echo "console.log('last_name = " . $last_name . "');";
    echo "console.log('gender = " . $gender . "');";
    echo "console.log('email_address = " . $email_address . "');";
    echo "console.log('full_name = " . $full_name . "');";
    echo "</script>";

    // insert Registrant into Directory table
    if($gender == 'Male'){
        $regdirquery = "INSERT INTO " . $_SESSION['dirtablename'] . " (church_ID, Name_1, Surname, Email_1, Picture_Link, Picture_Taken, ProfilePhoto_New) VALUES (?,?,?,?, 'x', 'N', 'x.jpg')";
        // $regdirquery = "INSERT INTO " . $_SESSION['dirtablename'] . " (church_ID, Name_1, Surname, Email_1, Picture_Link, Picture_Taken, ProfilePhoto_New) VALUES ('$church_code','$first_name','$last_name','$email_address', 'x', 'N', 'x.jpg')";
    }
    else {
        $regdirquery = "INSERT INTO " . $_SESSION['dirtablename'] . " (church_ID, Name_2, Surname, Email_2, Picture_Link, Picture_Taken, ProfilePhoto_New) VALUES (?,?,?,?, 'x', 'N', 'x.jpg')";
        // $regdirquery = "INSERT INTO " . $_SESSION['dirtablename'] . " (church_ID, Name_2, Surname, Email_2, Picture_Link, Picture_Taken, ProfilePhoto_New) VALUES ('$church_code','$first_name','$last_name','$email_address', 'x', 'N', 'x.jpg')";
    }
    $regdirtableupdate = $mysql->prepare($regdirquery);
    $regdirtableupdate->bind_param("ssss",$church_code,$first_name,$last_name,$email_address);
    $regdirtableupdate->execute();

    // Get Profile ID from above Insert
    $regInsert_DirID = $mysql->insert_id;
    echo "<script language='javascript'>";
    echo "console.log('tec_register_submit.php - idDirectory = " . $regInsert_DirID . "');";
    echo "</script>";
    
    // insert Registrant into Login table
    $regloginquery = "INSERT INTO " . $_SESSION['logintablename'] . " (church_ID, username, password, idDirectory, firstname, lastname, gender, email_addr, fullname) VALUES ('$church_code','$user_name','$pass_word','$regInsert_DirID','$first_name','$last_name','$gender','$email_address','$full_name')";
    $reglogintableupdate = $mysql->query($regloginquery) or die("A database error occurred when trying to add new registrant in Dir Table. See tec_register_submit.php. Error : " . $mysql->errno . " : " . $mysql->error);

    $regdirtableupdate->close();
    // DO NOT ATTEMPT TO CLOSE A NON-PARAMETERIZED QUERY 
    // $reglogintableupdate->close();

    // Send notification email to Admins for ACCEPT/REJECT
    $regmailadmins = "SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE admin_regnotify = '1'";
    $regmailquery = $mysql->query($regmailadmins) or die("A database error occurred when trying to select registration admins in Login Table. See tec_register_submit.php. Error : " . $mysql->errno . " : " . $mysql->error);
    $regmaillink = "https://tec.ourfamilyconnections.org";
    while ($regmailrow = $regmailquery->fetch_assoc())
    {
        $regmailtest = $regmailrow['email_addr'];
        $regmailto = $regmailtest . " , " . $regmailto;
    }
    $regmailsubject = "Registration Request to TEC Family Connections"."\n..";
    $regmailmessage = "Hello! " . "\n" . $first_name . " " . $last_name . " has requested to be added to TEC Family Connections.\n\nLogin to our site using your admin credentials, select the <strong>Registration Admin</strong> menu item, and accept or reject this request \n\n" . "<a href='" . $regmaillink . "'>" . $regmaillink . "</a>";
    $regmailfrom = "newfamilyrequest@ourfamilyconnections.org";
    $regmailheaders = "From:" . $regmailfrom . "\r\n";
    $regmailheaders .= "MIME-Version: 1.0\r\n";
    $regmailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    mail($regmailto,$regmailsubject,$regmailmessage,$regmailheaders);

    // Temp validation that report error is working
    eventLogUpdate('report error', 'tec_register_submit.php', 'Error: NONE', 'YAY!!');

}
else {
    echo "<script language='javascript'>";
    echo "alert('>>>Exited out of new user Registration. Contact your admin with error code #3001');";
    echo "</script>";
    // eventLogUpdate('report error', 'tec_register_submit.php', 'Error: ' . $mysql->error , 'Error #: ' . $mysql->errno);
    header("location:../tec_welcome.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Please Register</title>

    <!-- Bootstrap 4 BETA CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
<!--    <link href="css/signin.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="../css/jumbotron.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <link href="../css/tec_css_style.css" rel="stylesheet">
    
<!-- Initialize jquery js script -->
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>

<!-- jQuery (necessary for Bootstrap's (BOOTSTRAP 4 BETA) JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="../tec_welcome.php">TEC Family Connections</a>
        </div>
    </nav>
    <div class="view" style="background-image: url('../images/master_welcome3.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <!-- Mask & flexbox options-->
        <div class="mask rgba-gradient align-items-center">
            <!-- Content -->
            <div class="container">
                <!--Grid row-->
                <div class="row mt-5">
                    <!--Grid column-->
                    <!--Grid column-->
                    <div class="col-lg-6 mb-5 mt-lg-5 mt-5 white-text">
                        <!--Form-->
                        <!--<div class="card wow fadeInLeft" data-wow-delay="0.3s">-->
                        <div class="card">
                            <!-- <img src="../images/ourfamilyconnections4.png" class="card-img-top max-width: 100%" alt="..." /> -->
                            <div class="card-body text-center">
                                <!--Header-->
                                <!--<form class="form-inline" name="form1" method="post" action="ofc_checklogin2.php">-->
                                <div class="text-center">
                                    <h2 class="white-text">
                                        <i class="white-text"></i>Thank you for registering!
                                    </h2>
                                    <h4 class="white-text">
                                        <i class="white-text"></i>Hello <?php echo $first_name . " " . $last_name ?>
                                    </h4>
                                    <h4 class="white-text">
                                        <i class="white-text"></i>Your registration details have been submitted to our administrators.
                                    </h4>
                                    <h4 class="white-text">
                                        <i class="white-text"></i>You will be notified by email
                                    </h4>
                                    <h4>
                                        <i><span style="color:blue;"><?php echo $email_address?></span></i>
                                    </h4>
                                    <h4>
                                        <i class="white-text"></i>when our administrators have approved your registration.
                                    </h4>
                                    <h4 class="white-text">
                                        <i class="white-text"></i>Please allow 24-48 hours.
                                    </h4>
                                    <h4></h4>
                                    <h4 class="white-text text-center">
                                        <i class="white-text"></i>Click <a href="//tec.ourfamilyconnections.org/tec_welcome.php">HERE</a> to return to the Sign In page.
                                    </h4>
                                </div><!--text-center-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>