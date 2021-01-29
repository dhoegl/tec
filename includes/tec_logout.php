<?php  
session_start();
    require_once('../tec_dbconnect.php');

/*		Access Log entry  */
	$client_ip = stripslashes($_SERVER['REMOTE_ADDR']);
	$client_browser = stripslashes($_SERVER['HTTP_USER_AGENT']);
	$accessquery = $mysql->query("INSERT INTO " . $_SESSION['accesslogtable'] . "(type, member_id, user_id, client_ip, client_browser) VALUES ('Logout', '" . $_SESSION['idDirectory'] . "', '" . $_SESSION['username'] . "', '" . $client_ip . "', '" . $client_browser . "')");
        if($accessquery->error) {
            echo " SQL query access log entry error. Error:" . $accessquery->errno . " " . $accessquery->error;
        }

/*		Access Log entry  */

session_destroy();
header("location:../tec_welcome.php");
?>
