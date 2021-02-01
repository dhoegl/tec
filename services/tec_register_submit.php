<?php
// Last Updated: 12/08/2020: Stripped most code away to verify functions work

    require_once('../tec_dbconnect.php');
    // Event Log  trap
    require_once('../includes/event_logs_update.php');
    // Add Footer to page
    // require_once('includes/tec_footer.php');


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
    }
    else {
        $regdirquery = "INSERT INTO " . $_SESSION['dirtablename'] . " (church_ID, Name_2, Surname, Email_2, Picture_Link, Picture_Taken, ProfilePhoto_New) VALUES (?,?,?,?, 'x', 'N', 'x.jpg')";
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
    $regmailmessage = "<html><body>";
    $regmailmessage .= "<p style='background-color: #ff6933; font-size: 30px; font-weight: bold; color: white; padding: 25px; width=100%;'> Trinity Evangel Church</p>";
    $regmailmessage .= "<p>Hello! </p>";
    $regmailmessage .= "<p><strong>" . $first_name . " " . $last_name . "</strong>";
    $regmailmessage .= " has requested to be added to Trinity Evangel Church's Directory site.</p>";
    $regmailmessage .= "<p>Login to our site using your admin credentials, select the <strong>Registration Admin</strong> menu item, and accept or reject this request " . "<a href='" . $regmaillink . "'>" . $regmaillink . "</a></p>";
    $regmailmessage .= "</body></html>";
    $regmailfrom = "newfamilyrequest@ourfamilyconnections.org";
    $regmailheaders = "From:" . $regmailfrom . "\r\n";
    $regmailheaders .= "MIME-Version: 1.0\r\n";
    $regmailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    mail($regmailto,$regmailsubject,$regmailmessage,$regmailheaders);

    // Temp validation that report error is working
    eventLogUpdate('report error', 'tec_register_submit.php', 'Error: NONE', 'YAY!!');

}
else {
    // eventLogUpdate('report error', 'tec_register_submit.php', 'Error: ' . $mysql->error , 'Error #: ' . $mysql->errno);
    header("location:../tec_register.php"); // Clear button clicked
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registration Submitted</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../css/MDBootstrap4191/style.css" rel="stylesheet">

    <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
<!--    <link href="css/signin.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="../css/jumbotron.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <link href="../css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="../_tenant/css/tenant.css" rel="stylesheet">
    
<!-- Initialize jquery js script -->
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>

<!-- jQuery (necessary for Bootstrap's (BOOTSTRAP 4 BETA) JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


</head>
<body>
    <!-- Navbar for Registration cycle only-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark Orange Darken-4">
        <a class="navbar-brand font-weight-bolder" href="../tec_welcome.php">Trinity Evangel Church</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="basicExampleNav"></div>
    </nav>
    <!--/.Navbar for Registration cycle only-->

    <div class="jumbotron card card-image" style="background-image: url('../images/master_welcome3.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask rgba-gradient align-items-center">
            <div class="container">
                        <div class="row pt-2">
                            <div class="col-sm-12">
                                <div class="card bg-light border-primary p-3 mt-2">
                                    <div class="card-body text-center">
                                        <div class="text-center">
                                            <h2 class="font-weight-bolder">
                                                Thank you for registering!
                                            </h2>
                                            <h4 class="font-weight-bolder">
                                                Hello <?php echo $first_name . " " . $last_name ?>
                                            </h4>
                                            <h4 class="font-weight-bolder">
                                                Your registration details have been submitted to our administrators.
                                            </h4>
                                            <h4 class="font-weight-bolder">
                                                You will be notified by email
                                            </h4>
                                            <h4>
                                                <i><span style="color:blue;"><?php echo $email_address?></span></i>
                                            </h4>
                                            <h4>
                                                when our administrators have approved your registration.
                                            </h4>
                                            <h4 class="font-weight-bolder">
                                                Please allow 24-48 hours.
                                            </h4>
                                            <h4 class="font-weight-bold">
                                                Remember to check your Junk or Spam email folders.
                                            </h4>
                                            <h4></h4>
                                            <h4 class="font-weight-bolder">
                                                Click <a href="//tec.ourfamilyconnections.org/tec_welcome.php">HERE</a> to return to the Sign In page.
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