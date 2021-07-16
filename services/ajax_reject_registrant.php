<?php
//New Registrant Reject script
//Called from tec_regadmin.php
//Last Updated 2020/12/09
if ( isset($_POST['Selected']) ) {
    require('../tec_dbconnect.php');
    include('../includes/event_logs_update.php');
    include('tec_sendmail.php');
    $Selected2 = $_POST['Selected'];
    $Directory2 = $_POST['Directory'];
    $Login2 = $_POST['Login'];
    $Gender2 = $_POST['Gender'];
    $FirstName2 = $_POST['FirstName'];
    $LastName2 = $_POST['LastName'];
    $text = array();
    $regrejectloginquery = "UPDATE " . $_SESSION['logintablename'] . " SET active = '2'" .  " WHERE login_ID = '". $Login2 . "'";
    $regrejectlogin = $mysql->query($regrejectloginquery) or die("A database error occurred when trying to reject new Registrant info into Login table. See ajax_reject_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
    eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['user_id'], "Registrant Reject", "LoginID: " . $Login2 . " - Directory entry: " . $Directory2);

    $success = 'Reject Success';
    header('Content-type: application/json');
    echo json_encode($success);
}
else{
    $failed = 'Reject Failed';
    header('Content-type: application/json');
    echo json_encode($failed);
}
?>