<?php
/* Check existence of username already being used by another registrant; called from 'ofc_username_check.js */

//session_start();
//session_destroy();
error_reporting(E_ERROR);

require_once('../tec_dbconnect.php');

if(isset($_POST['username']) )
{
	$username_post = $_POST['username'];
        $response = "";
	$usernamecheckquery = $mysql->query("SELECT username FROM " . $_SESSION['logintablename'] . " WHERE username = '$username_post'") or die("Prayer Notify function failed at db SELECT. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());
	$usernamecheckcount = $usernamecheckquery->num_rows;
	if($usernamecheckcount > 0) {
            $response->username_status = "NAME_USED";
	} 
        else {
            $response->username_status = "USERNAME_AVAILABLE";
            }
}
$responseJSON = json_encode($response);
//    header('Content-type: application/json');
echo $responseJSON;
?>