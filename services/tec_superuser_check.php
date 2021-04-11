<?php
// Check that super user is logged in
// called from 'tec_config_ajax_call.js

//session_start();
//session_destroy();
error_reporting(E_ERROR);
require_once('../tec_dbconnect.php');

// if(isset($_POST['superuser']) )
// {
    $logged_in_user = $_SESSION['user_id'];
    $response = "";
	$superusercheckquery = $mysql->query("SELECT admin_superuser FROM " . $_SESSION['logintablename'] . " WHERE login_ID = '$logged_in_user'") or die("Super user check function failed at db SELECT. Please notify your administrator with the following. Error# : " . $mysql->errno . " : " . $mysql->error);
	while($superusercheckstat = $superusercheckquery->fetch_assoc()){
        $superuserstatus = $superusercheckstat['admin_superuser'];
        if($superuserstatus == '1'){
            $response="SUPERUSER";
        }
        else{
            $response="NONSUPER";
        }
    }
// }
// $responseJSON = json_encode($response);
//    header('Content-type: application/json');
echo $response;
?>