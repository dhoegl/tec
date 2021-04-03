<?php 
session_start();

require_once('tec_dbconnect.php');

if(!isset($_GET['a']) && ($_GET['email']) && ($_GET['u']))
{
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- BOOTSTRAP - Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/MDBootstrap4191/style.css" rel="stylesheet">


  <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css">


<!-- Custom styles for this template -->
<link href="css/jumbotron.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
  <!-- Test custom styles (Includes tec style details) -->
  <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">


<title>Password Reset</title>

<!--Set Focus on User Name Entry textbox-->
<!-- <script type="text/javascript">
function focus_on_start()
 {
 document.form1.username.focus();
 }
</script> -->
<!-- Load the jquery libraries -->
<script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> -->

<!-- Password Strength Check script -->
<script type="text/javascript" src="js/tec_password_check.js"></script>

</head>

<body>
<?php
    require_once('includes/tec_footer.php');
	
	if (isset($_GET['a']) && ($_GET['a'] == 'recover') && ($_GET['email'] != "") && ($_GET['u'] != "")) 
	{
		$email_key = $_GET['email'];
		$username = urldecode(base64_decode($_GET['u']));
		$curDate = date("Y-m-d H:i:s");
			// echo
			// "
			// 	<script type='text/javascript'>
			// 		var mailkey = '$email_key';
			// 		alert('mailkey = ');
			// 		alert(mailkey);
			// 		var uname = '$username';
			// 		var curdate2 = '$curDate';
			// 		alert('username = ');
			// 		alert(uname);
			// 		alert('curdate = ');
			// 		alert(curdate2);
			// 	</script>
			// ";
	
	/* Enable existing user to create new password - called via direct URL from password_reset_sendmail.php */
        $passrenewquery = $mysql->prepare("SELECT * FROM " . $_SESSION['logintablename'] . " WHERE username = ?");
        $passrenewquery->bind_param("s", $username);
        $passrenewquery->execute();
		$passrenewquery_result = $passrenewquery->get_result();
		$passrenewquery_count = $passrenewquery_result->num_rows;
		echo "<script language='javascript'>";
		echo "console.log('User Name = " . $username . "');";
		echo "console.log('Password Reset Query Count = " . $passrenewquery_count . "');";
		echo "</script>";		
		while($row = $passrenewquery_result->fetch_assoc())
		{
			if($row['temp_pass_key'] != $email_key) 
			{
				echo
				"
					<script type='text/javascript'>
						alert('Invalid Password Reset Key. Please check your email and try again');
						window.open('//tec.ourfamilyconnections.org', '_self');
					</script>
				";
			}
			if(!$row['temp_pass_expire'] >= $curDate) 
			{
				echo
				"
					<script type='text/javascript'>
						alert('You have waited longer than 3 days to reset your password. Return to the Home Page and request to reset your password');
						var curdate1 = '$curDate';
						alert('curdate = ');
						alert(curdate1);
						window.open('//tec.ourfamilyconnections.org', '_self');
					</script>
				";
			}
		}
	
		if($passrenewquery_count != 1)
		{
			echo
			"
				<script type='text/javascript'>
					alert('Your username does not exist in our system. Return to the Home Page and request to reset your password');
					// window.open('//tec.ourfamilyconnections.org', '_self');
				</script>
			";
		}
	}
	else 
	{
			echo
			"
				<script type='text/javascript'>
					alert('You have improperly accessed this page. Returning to the Home Page.');
					window.open('//tec.ourfamilyconnections.org', '_self');
				</script>
			";
	}	
	?>
<nav class="navbar navbar-dark orange darken-4 fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="tec_welcome.php">Trinity Evangel Church</a>
    </div>
</nav>
<div class="container-fluid profile_bg">
    <div class="row">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			Click for Password Strength details
            </button>
        </p>
    </div> <!-- row -->
    <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="col-sm-6">
                    <div class="card card-body">
					<h4 class="card-title">Check for correct password strength</h4>
                        <ul class="card-text">
                            <li>Password length must be greater than 7 characters</li>
                            <li>Characters shall include at least the following:</li>
							<ul>
								<li>one lower case and one upper case character</li>
								<li>one number or one special character</li>
							</ul>
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
            	<h3 class="text-center">Reset your Password</h3>
				<form name='resetform' id="password_reset_form" action='' method="POST">
					<div class="form-group">
        				<label for="password">Choose a Password: <strong><font color="red">*   </font><span id="password_result"></span></strong></label>
        				<input type="password" class="form-control" name="passwordname" id="password" aria-describedby="emailHelp" placeholder="StrongPassword">
        				</input>
						<p>
						</p>
        				<label for="repeatpassword">Re-enter your Password: <strong><font color="red">*   </font><span id="password_match"></span></strong></label>
        				<input type="password" class="form-control" name="repeatpasswordname" id="repeatpassword" aria-describedby="emailHelp" placeholder="StrongPassword">
        				</input>
					</div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-secondary" name="clear" value="Clear" />
                        <input type="submit" class="btn btn-primary disabled" name="resetsubmit" id="reset_submit" value="Reset" />
                    </div>
 				</form>
            </div> <!--card-->
        </div> <!--col-sm-12-->
    </div> <!-- row -->
</div> <!-- container -->

<?php
	$submit = $_POST['resetsubmit'];
	$clear = $_POST['clear'];

	if($clear) //		echo "Clear was clicked";
	{
		$password = "";
		$repeatpassword = "";
	}
	if ($submit) //		echo "Submit was clicked";
	{
		$password = $_POST['passwordname'];
		$repeatpassword = $_POST['repeatpasswordname'];
		$date = date("Y-m-d");
		if($password==$repeatpassword)
		{
			echo "<script language='javascript'>";
			echo "console.log('User Name = " . $username . "');";
			echo "console.log('Password = " . $password . "');";
			echo "</script>";		
			//Update user password
			$password = md5($password);
			// $password_update_query = "UPDATE " . $_SESSION['logintablename'] . " SET password = '" . $password . "', temp_pass_key = '', temp_pass_expire = '' WHERE username = '" . $username . "'";
			$password_update_query = "UPDATE " . $_SESSION['logintablename'] . " SET password = ?, temp_pass_key = '', temp_pass_expire = '' WHERE username = '" . $username . "'";
			echo "<script language='javascript'>";
			echo "console.log('password_update_query = " . $password_update_query . "');";
			echo "</script>";		
			$password_update = $mysql->prepare($password_update_query);
			$password_update->bind_param("s",$password);
			$password_update->execute();
			$password_update->close();
			// DO NOT ATTEMPT TO CLOSE A NON-PARAMETERIZED QUERY 

			// Access Log entry
			$client_ip = stripslashes($_SERVER['REMOTE_ADDR']);
			$client_browser = stripslashes($_SERVER['HTTP_USER_AGENT']);
			$accessquery = $mysql->query("INSERT INTO " . $_SESSION['accesslogtable'] . "(type, member_id, user_id, client_ip, client_browser) VALUES ('Password Reset', '" . $username . "', '" . $username . "', '" . $client_ip . "', '" . $client_browser . "')");
			if($accessquery->error) {
				echo " SQL query access log entry error. Error:" . $accessquery->errno . " " . $accessquery->error;
			}

			// Alert user that password has been reset
			echo
			"
				<script type='text/javascript'>
					alert('You have successfully reset your password. You will now be re-directed to the Home Page to login with your new password.');
					window.open('//tec.ourfamilyconnections.org', '_self');
				</script>
			";
		}
		else {
			$password = "";
			$repeatpassword = "";
			echo
			"
				<script type='text/javascript'>
					alert('Your passwords do not match. Re-check your entry and try again.');
					document.getElementById('resetform').reset();
					location.reload(false);
				</script>
			";
		}
	}
?> 

  <!-- SCRIPTS -->
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>

</body>
</html>