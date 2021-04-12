<?php
session_start();
if(!$_SESSION['logged in']) {
	header("location:../tec_welcome.php");
	exit();
}

require_once('../tec_dbconnect.php');
include_once('../includes/event_logs_update.php');



/* Process profile update -CONTACT INFO: Called from tec_profile.php */
if(isset($_POST['submitcontact']))
	{
	$his_first = filter_input(INPUT_POST, 'hisfirstname');
	$her_first = filter_input(INPUT_POST, 'herfirstname');
	$last_name = filter_input(INPUT_POST, 'mylastname');
	$street_address1 = filter_input(INPUT_POST, 'myaddr1');
	$street_address2 = filter_input(INPUT_POST, 'myaddr2');
	$my_city = filter_input(INPUT_POST, 'mycity');
	$my_state = substr(filter_input(INPUT_POST, 'mystate'),0,2);
	$my_zip = filter_input(INPUT_POST, 'myzip');
	$my_homephone = filter_input(INPUT_POST, 'myhomephone');
	$his_cell = filter_input(INPUT_POST, 'hiscell');
	$her_cell = filter_input(INPUT_POST, 'hercell');
    $his_email = filter_input(INPUT_POST, 'hisemail'); // email address change enabled
	$her_email = filter_input(INPUT_POST, 'heremail'); // email address change enabled

	// $contactupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Name_1 = '" . $his_first . "', Name_2 = '" . $her_first . "', Surname = '" . $last_name . "', Address = '" . $street_address1 . "', Address2 = '" . $street_address2 . "', City = '" . $my_city . "', State = '" . $my_state . "', Zip = '" . $my_zip . "', Phone_Home = '" . $my_homephone . "', Phone_Cell1 = '" . $his_cell . "', Phone_Cell2 = '" . $her_cell . "', Email_1 = '" . $his_email . "', Email_2 = '" . $her_email . "' WHERE idDirectory = '". $_SESSION['idDirectory'] . "'";
	$contactupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Name_1 = '" . $his_first . "', Name_2 = '" . $her_first . "', Surname = '" . $last_name . "', Address = '" . $street_address1 . "', Address2 = '" . $street_address2 . "', City = '" . $my_city . "', State = '" . $my_state . "', Zip = '" . $my_zip . "', Phone_Home = '" . $my_homephone . "', Phone_Cell1 = '" . $his_cell . "', Phone_Cell2 = '" . $her_cell . "', Email_1 = '" . $his_email . "', Email_2 = '" . $her_email . "' WHERE idDirectory = '". 	$_SESSION["Famview_Profile"] . "'";
	$contactupdate = $mysql->query($contactupdatequery) or die("A database error occurred when trying to update contact info. See tec_profile_contact_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
	eventLogUpdate('profile_update', $last_name . " : " . $his_first . " : " . $her_first . " : " . $street_address1 . " : " . $street_address2 . " : " . $my_city . " : " . $my_state . " : " . $my_zip . " : " . $my_homephone . " : " . $his_cell . " : " . $her_cell . " : " . $his_email . " : " . $her_email, 'Profile Update-Contact' , 'username= ' . $_SESSION['username']);

    $loginemailupdatequery_him = "UPDATE " . $_SESSION['logintablename'] . " SET email_addr = '" . $his_email . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND gender = 'M'";
	$loginemailupdate_him = $mysql->query($loginemailupdatequery_him) or die("A database error occurred when trying to update login email info. See tec_profile_contact_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
	$loginemailupdatequery_her = "UPDATE " . $_SESSION['logintablename'] . " SET email_addr = '" . $her_email . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND gender = 'F'";
	$loginemailupdate_her = $mysql->query($loginemailupdatequery_her) or die("A database error occurred when trying to update login email info. See tec_profile_contact_update.php. Error : " . $mysql->errno . " : " . $mysql->error);

    }
    else {
	echo "isset didn't work";
	}

header("location:../tec_profile.php?id=" . $_SESSION["Famview_Profile"]);
?>