<?php
// Last Updated: 08/24/2019: Verified Post variables; initialized Directory table entries
// Last Updated: 09/01/2019: initialized Login table entries
    //// BUG NOTE - NEED TO FIX: "or die" statements on Mysql Insert do not flag errors properly.

//session_start();
//if(!$_SESSION['logged in']) {
//	header("location:../ofc_welcome.php");
//	exit();
//}

    require_once('../tecapp_dbconnect.php');
    // Event Log  trap
//    include('../includes/event_logs_update.php');
    // Verify we made it to this PHP file
    // echo "<script language='javascript'>";
    // echo "console.log('>>>Made it to tecapp_register_submit.php<<<');";
    // echo "</script>";


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
    // echo "<script language='javascript'>";
    // echo "console.log('church_code = " . $church_code . "');";
    // echo "console.log('user_name = " . $user_name . "');";
    // echo "console.log('pass_word = " . $pass_word . "');";
    // echo "console.log('first_name = " . $first_name . "');";
    // echo "console.log('last_name = " . $last_name . "');";
    // echo "console.log('gender = " . $gender . "');";
    // echo "console.log('email_address = " . $email_address . "');";
    // echo "console.log('full_name = " . $full_name . "');";
    // echo "</script>";
    //('Debug Objects: " . $output . "' );</script>";
    //	$contactupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Name_1 = '" . $his_first . "', Name_2 = '" . $her_first . "', Surname = '" . $last_name . "', Address = '" . $street_address1 . "', Address2 = '" . $street_address2 . "', City = '" . $my_city . "', State = '" . $my_state . "', Zip = '" . $my_zip . "', Phone_Home = '" . $my_homephone . "', Phone_Cell1 = '" . $his_cell . "', Phone_Cell2 = '" . $her_cell . "' WHERE idDirectory = '". $_SESSION['idDirectory'] . "'";
    //	$contactupdate = $mysql->query($contactupdatequery) or die("A database error occurred when trying to update contact info. See tec_profile_contact_update.php. Error : " . mysql_errno() . mysql_error());
    //	eventLogUpdate('profile_update', $last_name, 'Profile Update : Contact : DirectoryID = ', $_SESSION['idDirectory']);

/////////////////////////////Register the User

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
        // echo "<script language='javascript'>";
        // echo "console.log('Successful execution at mysql execute - tecapp_register_submit.php line 60');";
        // echo "</script>";
        // eventLogUpdate('report error', 'tecapp_register_submit.php', 'Error: ' . $mysql->error , 'Error #: ' . $mysql->errno);
    

    // or die("A database error occurred when trying to add new registrant in Dir Table. See tecapp_register_submit.php. Error : " . $mysql->errno . " : " . $mysql->error);
    // $regdirtableupdate = $mysql->query($regdirquery) or die("A database error occurred when trying to add new registrant in Dir Table. See tecapp_register_submit.php. Error : " . $mysql->errno . " : " . $mysql->error);
    $regInsert_DirID = $mysql->insert_id;
    // insert Registrant into Login table
    $regloginquery = "INSERT INTO " . $_SESSION['logintablename'] . " (church_ID, username, password, idDirectory, firstname, lastname, gender, email_addr, fullname) VALUES ('$church_code','$user_name','$pass_word','$regInsert_DirID','$first_name','$last_name','$gender','$email_address','$full_name')";
    $reglogintableupdate = $mysql->query($regloginquery) or die("A database error occurred when trying to add new registrant in Dir Table. See tecapp_register_submit.php. Error : " . $mysql->errno . " : " . $mysql->error);

    $regdirtableupdate->close();
    $reglogintableupdate->close();

    // Write Directory ID to console
    echo "<script language='javascript'>";
    echo "console.log('tecapp_register_submit.php - idDirectory = " . $regInsert_DirID . "');";
    echo "</script>";

    //////////////////////////////////////////////////////


    //$regentryquery = "SELECT username from " . $_SESSION['logintablename'] . " WHERE username = '" . $username . "'";
    //$regentryexist = @mysql_query($regentryquery) or die("A database error has occurred. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());

    //$regentrynumrows = @mysql_num_rows($regentryexist);
    //if($regentrynumrows == 0)
    //{
    //    if($gender == 'M')
    //    {
    //        $regquery = @mysql_query("INSERT INTO " . $_SESSION['dirtablename'] . " (Name_1, Surname, Email_1, Picture_Link, Picture_Taken) VALUES ('$firstname','$lastname','$emailaddr', 'x', 'N')") or die("Unable to create new user record in directory. Error : " . mysql_errno() . mysql_error());
    //    }
    //    else //$gender = 'F'
    //    {
    //        $regquery = @mysql_query("INSERT INTO " . $_SESSION['dirtablename'] . " (Name_2, Surname, Email_2, Picture_Link, Picture_Taken) VALUES ('$firstname','$lastname','$emailaddr', 'x', 'N')") or die("Unable to create new user record in directory. Error : " . mysql_errno() . mysql_error());
    //    }
    //    $regInsertID = @mysql_insert_id();
    //    $reglogliquery = @mysql_query("INSERT INTO " . $_SESSION['logintablename'] . " (username, password, idDirectory, firstname, lastname, gender, email_addr) VALUES ('$username','$password','$regInsertID','$firstname','$lastname','$gender','$emailaddr')") or die("Unable to create new login record in directory. Error : " . mysql_errno() . mysql_error());

//        $regmailadmins = @mysql_query("SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE admin_regnotify = '1'");
        $regmailadmins = "SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE admin_regnotify = '1'";
        $regmailquery = $mysql->query($regmailadmins) or die("A database error occurred when trying to select registration admins in Login Table. See tecapp_register_submit.php. Error : " . $mysql->errno . " : " . $mysql->error);
        $regmaillink = "http://tecapp.ourfamilyconnections.org";
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

    //echo "Got to RegisterSubmit";
    //echo "<script language='javascript'>";
    //echo "console.log('arrived at registersubmit - isset worked');";
    //echo "alert('Arrived at RegisterSubmit - isset worked');";
    //echo "</script>";
}
// 08/18/2019 - Comment out to test Clear function on OFC Register page
else {
    echo "<script language='javascript'>";
    echo "console.log('>>>Exited out of If(isset script in  tecapp_register_submit.php<<<');";
    echo "</script>";

    header("location:../tecapp_register.php");
}
//    echo "isset didn't work";
//        echo "<p id='test1'>Arrived again</p>";
//        echo "<script language='javascript'>";
//        echo "console.log('arrived at registersubmit - isset DID NOT work');";
//        echo "alert('Arrived at RegisterSubmit - isset DID NOT work');";
//        echo "</script>";
//    }

//header("location:../ofc_profile.php?id=" . $_SESSION['idDirectory']);
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
    <link href="../css/tecapp_css_style.css" rel="stylesheet">
    
<!-- Initialize jquery js script -->
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>

<!-- jQuery (necessary for Bootstrap's (BOOTSTRAP 4 BETA) JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="../tecapp_welcome.php">TEC Family Connections</a>
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
                                        <i class="white-text"></i>Click <a href="http://tecapp.ourfamilyconnections.org/tecapp_welcome.php">HERE</a> to return to the Sign In page.
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