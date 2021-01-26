<?php
session_start();
	$host="localhost"; // Host name - LINUX required
	$username="db_tecapp"; // Mysql username
	$password="Thr33Bl!ndM!c3"; // Mysql password
	$db_name="db_tecapp"; // Database name
	$login_tbl_name="login"; // Master User Login Table name
	$admin_tbl_name="admins"; //Administration Table name
	$dir_tbl_name="directory"; // Members Table name
	$l2l_tbl_name="Life2Life"; //L2L Table name
	$prayer_tbl_name="prayer";
	$prayer_uid_tbl_name="prayer_uid";
	$prayer_follow_tbl_name="prayer_follow";
	$prayer_update_tbl_name="prayer_update";
	$access_log_tbl_name="access_log";
	$states_tbl_name="states";
	$event_tbl_name="Events";
	$grades_tbl_name="grades";
    $child_tbl_name="children";
    $event_log_profile_update="Event_Log_Profile";
    $local_schools="schools_wa_marysville";
	$event_log_admin_update="Event_Log_Admin";
	$event_log_error_update="Event_Log_Error";

	$_SESSION['logintablename'] = $login_tbl_name;
	$_SESSION['dirtablename'] = $dir_tbl_name;
	$_SESSION['l2ltablename'] = $l2l_tbl_name;
	$_SESSION['admintablename'] = $admin_tbl_name;
	$_SESSION['prayertable'] = $prayer_tbl_name;
	$_SESSION['prayerfollow'] = $prayer_follow_tbl_name;
	$_SESSION['prayerupdate'] = $prayer_update_tbl_name;
	$_SESSION['prayeruidtable'] = $prayer_uid_tbl_name;
	$_SESSION['accesslogtable'] = $access_log_tbl_name;
	$_SESSION['statestablename'] = $states_tbl_name;
	$_SESSION['eventtablename'] = $event_tbl_name;
	$_SESSION['gradestablename'] = $grades_tbl_name;
    $_SESSION['childtablename'] = $child_tbl_name;
    $_SESSION['eventlogprofileupdate'] = $event_log_profile_update;
	$_SESSION['eventlogadminupdate'] = $event_log_admin_update;
	$_SESSION['eventlogerrorupdate'] = $event_log_error_update;
    $_SESSION['localschools'] = $local_schools;


        $mysql = new mysqli($host, $username, $password, $db_name);
        if ($mysql->connect_error){
			echo "<script language='javascript'>";
			echo "console.log('Unable to establish connection to database')";
            echo "console.log('Error #: ' . $mysql->connect_errno . ' Description: ' . $mysql->connect_error)";
			echo "</script>";
        }
		else
		{
/* 			echo "<script language='javascript'>";
			echo "console.log('Database Connection Successful')";
			echo "</script>";
 */		}
?>
