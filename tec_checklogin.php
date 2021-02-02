<?php
session_start();
    require_once('tec_dbconnect.php');

// Load the jquery libraries
echo "<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>";

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

//$mysql_cstat = @mysql_connect($host, $username, $password)or die("cannot connect. Error #" . mysql_errno() . " " . mysql_error());
//$mysql_sstat = @mysql_select_db($db_name)or die("cannot select DB. Error:" . mysql_errno() . " " . mysql_error());


// To protect MySQL injection
$myusername2 = stripslashes($myusername);
$mypassword2 = stripslashes($mypassword);
// $myusername3 = mysqli_real_escape_string($mysql, $myusername2);
// $mypassword3 = mysqli_real_escape_string($mysql, md5($mypassword2));
$myusername3 = mysqli_real_escape_string($mysql, $myusername2);
$mypassword3 = mysqli_real_escape_string($mysql, md5($mypassword2));
// echo "Username = " . $myusername3;
// echo "Password = " . $mypassword3;
// Get user details
// $sqlquery = $mysql->prepare("SELECT * FROM $login_tbl_name WHERE username = ? AND password = ?");
// $sqlquery = $mysql->query("SELECT * FROM $login_tbl_name WHERE username = " + $myusername3 + " AND password = " + $mypassword3) or die(" SQL query error. Error:" . $mysql->errno() . " " . $mysql->error());
//// https://dzone.com/articles/ceate-a-login-system-using-html-php-and-mysql

$sqlquery = $mysql->prepare("SELECT * FROM " . $_SESSION['logintablename'] . " WHERE username = ? AND password = ?");
// $sqlquery = "SELECT * FROM " . $_SESSION['logintablename'] . " WHERE username = '" . $myusername3 . "'";
// $user_cred_verify = mysqli_query($mysql, $sqlquery);
$sqlquery->bind_param("ss", $myusername3, $mypassword3);
// echo ' Arrived at the offending checklogin mysql execute line';
$sqlquery->execute() or die (" Failed to execute!");
// echo ' Made it past execute';
$result = $sqlquery->get_result();
// echo ' Made it past get_result - PHP updated to include nd_mysqli and disabled mysqli';

$row_count = $result->num_rows;
// echo "num_rows = " . $row_count;
if($row_count == 1)
// if($result->num_rows === 1)
    {
        $rowcount = 1;
        while ($row = $result->fetch_assoc())
//        while ($row = $sqlquery->fetch())
//        while ($row = $sqlquery->fetch_array(MYSQLI_ASSOC));
        {
//        $row = $result->fetch();
        // echo ' Made it past fetch_assoc';
        $userID = $row['idDirectory'];
        // echo " Active Status = " . $row['active'];
        if($row['active']==1)
        {
            $fullname = $row['firstname'] . " " . $row['lastname'];
            $_SESSION['user_id'] = $row['login_ID'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['fullname'] = $fullname;
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['email'] = $row['email_addr'];
            $_SESSION['idDirectory'] = $row['idDirectory'];
            $_SESSION['reg_admin'] = $row['admin_regnotify']; // Registration Administrator
            $_SESSION['pray_admin'] = $row['admin_praynotify']; // Prayer Administrator
            $_SESSION['super_admin'] = $row['admin_superuser']; // System SuperUser
            $_SESSION['accesslevel'] = $row['access_level'];
            $_SESSION['logged in'] = TRUE;

        /*		Access Log entry  */
            $client_ip = stripslashes($_SERVER['REMOTE_ADDR']);
            $client_browser = stripslashes($_SERVER['HTTP_USER_AGENT']);
        	$accessquery = $mysql->query("INSERT INTO " . $_SESSION['accesslogtable'] . "(type, member_id, user_id, client_ip, client_browser) VALUES ('Login', '" . $_SESSION['idDirectory'] . "', '" . $_SESSION['username'] . "', '" . $client_ip . "', '" . $client_browser . "')");
            if($accessquery->error){
                echo " SQL query access log entry error. Error:" . $accessquery->errno . " " . $accessquery->error;
            }

        /* Get user first name */
        //    $namequery = $mysql->query("SELECT * FROM " . $_SESSION['dirtablename'] . " WHERE idDirectory = " . $_SESSION['idDirectory']);
            $namequery = "SELECT * FROM " . $_SESSION['dirtablename'] . " WHERE idDirectory = " . $_SESSION['idDirectory'];
            $result2 = $mysql->query($namequery);
        //    if($namequery->error){
            if($result2->error){
                echo " Name Query error. Error:" . $result2->errno . " " . $result2->error;
            }
        //    $namerow = $namequery->fetch_assoc;
            $namerow = $result2->fetch_assoc;
            if($_SESSION['idDirectory'] <= 19999) //Shared Directory entries for generic users
            {
                if($_SESSION['gender'] == "M")
                    {
                        $_SESSION['firstname'] = $namerow['Name_1'];
                    }
                    elseif($_SESSION['gender'] == "F")
                    {
                        $_SESSION['firstname'] = $namerow['Name_2'];
                    }
                    else
                {
                    session_destroy();
                    header("location:tec_welcome.php");
                    /* Enter Error Handler */
                }
            }
            else
            {
                    $_SESSION['firstname'] = $_SESSION['username'];
            }
            mysqli_close($mysql);
            header("location:tec_login_success.php");
        }
        else
        {
            // Throw alert if user has not yet been activated
            mysqli_close($mysql);
            include('includes/tec_credalert2.php');
        }
    }
}
 else {
        $rowcount = 0;
	// Throw alert if improper login credentials attempted
	include('includes/tec_credalerts.php');
    }
// mysqli_free_result($user_cred_verify);
// $sqlquery->free();
// if($user_cred_verify != 1)
if($rowcount != 1)
    {
        $mysqlerror = mysqli_error($mysql);
        $mysqlerrno = mysqli_errno($mysql);
    }

?>

<script type='text/javascript'>
     var $login_table =  <?php echo "'" . $_SESSION['logintablename'] . "'"; ?>;
     var $userIDval =  <?php echo "'" . $_SESSION['idDirectory'] . "'"; ?>;
     var $countval =  <?php echo "'" . $rowcount . "'"; ?>;
     var $myusernameval =  <?php echo "'" . $myusername2 . "'"; ?>;
     var $mypasswordval =  <?php echo "'" . $mypassword3 . "'"; ?>;
     var $mysqlerrorval = <?php echo "'" . $mysqlerror . "'"; ?>;
     var $mysqlerrnoval = <?php echo "'" . $mysqlerrno . "'"; ?>;
     var $accesslevel = <?php echo "'" . $_SESSION['accesslevel'] . "'"; ?>;
        var jQ5 = jQuery.noConflict();
                jQ5(document).ready(function() {
                    if($countval == 1){
                        console.log("$login_tbl_name = " + $login_table);
                        console.log("$mysqlerror = " + $mysqlerrorval);
                        console.log("$mysqlerrno = " + $mysqlerrnoval);
                        console.log("User ID = " + $userIDval);
                        console.log("Access Level = " + $accesslevel);
                        console.log("Username and Password entered");
                        console.log("Rowcount = " + $countval);
                        console.log("Username = " + $myusernameval);
                        console.log("Password = " + $mypasswordval);
                    }
                    else {
                        console.log("$login_tbl_name = " + $login_table);
                        console.log("$mysqlerror = " + $mysqlerrorval);
                        console.log("$mysqlerrno = " + $mysqlerrnoval);
                        console.log("User ID = " + $userIDval);
                        console.log("Rowcount does not equal 1");
                        console.log("Rowcount = " + $countval);
                        console.log("Username = " + $myusernameval);
                        console.log("Password = " + $mypasswordval);
                    }

});

</script>

