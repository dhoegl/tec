<?php
// Event Logging scripts
// Updated 2020/12/30


session_start();
if(!$_SESSION['logged in'] && !$_SESSION['register_check']) {
// Check entry into this file
echo '<script language="javascript">';
echo "console.log('Entered into event_logs_update.php. Register_Check = " . $_SESSION['register_check'] . "');";
echo '</script>';
	// header("location:../tec_welcome.php");
    header("location:tec_welcome.php");
    exit();
}
// *********************************************
// *********************************************
// This function will log events into corresponding event log tables as outlined below:
// $logpointer='admin_update' = event_log_admin_update
// $logpointer='mail' = event_log_mail
// $logpointer='prayer' = event_log_prayer
// $logpointer='profile_update' = event_log_profile_update
// $logpointer='report_error' = event_log_error_update


	function eventLogUpdate($logpointer, $logwho, $logwhat, $logmetric) {
        require('../tec_dbconnect.php');

        if($logpointer == "admin_update") {
            $eventlogquery = "INSERT INTO " . $_SESSION['eventlogadminupdate'] . "(log_admin_update_who, log_admin_update_what, log_admin_update_metric) VALUES ('$logwho', '$logwhat', '$logmetric')";
            $eventlogresult = $mysql->query($eventlogquery)or die("Event Log Admin Update function failed at db INSERT. Please notify your administrator with the following. Error : " . $mysql->error);
        }
        elseif($logpointer == "mail") {

            //$eventlogquery = "INSERT INTO " . $_SESSION['eventlogmail'] . "(log_mail_who, log_mail_what, log_mail_metric) VALUES ('$logwho', '$logwhat', '$logmetric')";
            //$eventlogresult = $mysql->query($eventlogquery)or die("Event Log Mail function failed at db INSERT. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());
        }
        elseif($logpointer == "prayer") {

            //$eventlogquery = "INSERT INTO " . $_SESSION['eventlogprayer'] . "(log_prayer_who, log_prayer_what, log_prayer_metric) VALUES ('$logwho', '$logwhat', '$logmetric')";
            //$eventlogresult = $mysql->query($eventlogquery)or die("Event Log Prayer function failed at db INSERT. Please notify your administrator with the following. Error : " . mysql_errno() . mysql_error());
        }
        if($logpointer == "profile_update") {
            $eventlogquery = "INSERT INTO " . $_SESSION['eventlogprofileupdate'] . " (log_profile_update_who, log_profile_update_what, log_profile_update_metric) VALUES ('$logwho', '$logwhat', '$logmetric')";
            $eventlogresult = $mysql->query($eventlogquery) or die("Event Log Insert function failed at db INSERT into Event_Log_Profile table. Please notify your administrator with the following. Error : " . $mysql->error);
            //$eventlogresultcount = $eventlogresult->num_rows;
        }
        if($logpointer == "report error") {
            $eventlogquery = "INSERT INTO " . $_SESSION['eventlogerrorupdate'] . " (log_error_update_who, log_error_update_what, log_error_update_metric) VALUES ('$logwho', '$logwhat', '$logmetric')";
            $eventlogresult = $mysql->query($eventlogquery) or die("Event Log Insert function failed at db INSERT into Event_Log_error table. Please notify your administrator with the following. Error : " . $mysql->error);
            //$eventlogresultcount = $eventlogresult->num_rows;
        }

}
?>