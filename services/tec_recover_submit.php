<?php
// Last Updated: 01/07/2021:

//session_start();
//if(!$_SESSION['logged in']) {
//	header("location:../ofc_welcome.php");
//	exit();
//}

require_once('../tec_dbconnect.php');
//include_once('/includes/event_logs_update.php');

if(isset($_POST['password_reset']))
{
    $user_name = filter_input(INPUT_POST, 'username');
    echo "<script language='javascript'>";
    echo "console.log('user_name = " . $user_name . "');";
    echo "</script>";
    echo "<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>";
    // echo "<script type='text/javascript' src='../js/error_handler.js'></script>";
    echo "<script type='text/javascript' src='../js/forgot_password_submit.js'></script>";
    // echo "<script type='text/javascript'>src='../js/forgot_password_submit.js'</script>";
    //////////////////////////////////////////////////////

    try {
        $stmt = $mysql->prepare("SELECT * FROM " . $_SESSION['logintablename'] . " WHERE username = ?");
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0)
        {
            echo "<script language='javascript'>";
            echo "alert('You must select a valid username. Please re-enter your username.');";
            echo "window.location(//tec.ourfamilyconnections.org/tec_recover.php";
            echo "</script>";
            // exit('No rows');
            header("location:../tec_recover.php");
        } // exit('No rows');
        while($row = $result->fetch_assoc()) {
            $LoginID = $row['login_ID'];
            $emailaddr = $row['email_addr'];
            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
        }
        echo "<script language='javascript'>";
        echo "console.log('Login = " . $LoginID . "');";
        echo "console.log('Email = " . $emailaddr . "');";
        echo "console.log('User Name = " . $username . "');";
        echo "console.log('First = " . $firstname . "');";
        echo "console.log('Last = " . $lastname . "');";
        echo "</script>";
        $stmt->close();
//        echo "<center><strong><font color='Blue'>An email has been sent to " . $emailaddr . ".</font><br />Please check this email mailbox for further instructions</strong></center>";
        echo "
		    <script type='text/javascript'>
			    resetrequest('$emailaddr', '$firstname', '$lastname', '$username', '$LoginID');
		    </script>
		    ";

    }
   catch(Exception $e)
    {
        echo "<script language='javascript'>";
        echo "alert('ERROR at tec_recover_submit.php');";
        echo "</script>";
    }
}
elseif (isset($_POST['clear'])) { // Clear button clicked
    header("location:../tec_recover.php");
}
elseif (isset($_POST['login'])) { // Login button clicked
    header("location:../tec_welcome.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--<title></title>-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../css/MDBootstrap4191/style.css" rel="stylesheet">


  <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css">


<!-- Custom styles for this template -->
<link href="../css/jumbotron.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
  <!-- Test custom styles (Includes tec style details) -->
  <link href="../css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="../_tenant/css/tenant.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-dark orange darken-4 fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="../tec_welcome.php">Trinity Evangel Church</a>
    </div>
</nav>
<div class="container-fluid profile_bg">
    <?php
        // header("Location: //tec.ourfamilyconnections.org");
    ?>
    <p>
    </p>
    <div class="row">
    	<div class="col-sm-12">
            <div class="card bg-light border-primary p-3">
                <h3 class="text-center">Click Login to return to the Login page</h3>
                <form name='returnhome' id="return_home" action='' method="POST">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="login" value="Login" />
                    </div>
                </form>
            </div> <!--card-->
        </div> <!--col-sm-12-->
    </div> <!-- row -->
</div> <!-- container-fluid -->
</body>
</html>