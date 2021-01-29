<?php
// ***************************************************************
// Process profile update - CHILDREN (name, gender, birthdate, etc.) INFO: Called from tec_profile_children_delete.js
// Called ffrom ofc_profile.php form submit for Children entry
// Last Updated: 12/26/2020: Working on pre-Delete prompt
session_start();
if(!$_SESSION['logged in']) {
	header("location:../tec_welcome.php");
	exit();
}
// Initialize dbconnect access
require_once('../tec_dbconnect.php');
// Event Log Update trap
include('../includes/event_logs_update.php');

// *********** Remove Child from Directory and Children tables **************/
$child_number = $_POST['child_number'];
$child_name = $_POST['child_name'];
// $profile_id = $_POST['profile_id'];
$profile_id = $_SESSION['idDirectory'];
$return_arr = array();

switch ($child_number)
    {
    case '1': // Child 1
        $childdirremovequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_1_ChildID = NULL, Child_1_Name = NULL, Child_1_BDay_Date = NULL, Child_1_Gender = NULL, Child_1_Email = NULL, Child_1_School = NULL, Child_1_Grade = NULL WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childdirremove = $mysql->query($childdirremovequery) or die("A database error occurred when trying to update child 1 info. See tec_profile_children_delete.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    $childrenremovequery = "DELETE FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '1'";
	    $childrenremove = $mysql->query($childrenremovequery) or die("A database error occurred when trying to update child 1 info. See tec_profile_children_delete.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $child_name, 'Profile Remove-Children 1:' , 'idDirectory= ' . $_SESSION["Famview_Profile"]);
    break;
    case '2':  // Child 2
	    $childdirremovequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_2_ChildID = NULL, Child_2_Name = NULL, Child_2_BDay_Date = NULL, Child_2_Gender = NULL, Child_2_Email = NULL, Child_2_School = NULL, Child_2_Grade = NULL WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childdirremove = $mysql->query($childdirremovequery) or die("A database error occurred when trying to update child 2 info. See tec_profile_children_delete.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    $childrenremovequery = "DELETE FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '2'";
	    $childrenremove = $mysql->query($childrenremovequery) or die("A database error occurred when trying to update child 2 info. See tec_profile_children_delete.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $child_name, 'Profile Remove-Children 2:' , 'idDirectory= ' . $_SESSION["Famview_Profile"]);
    break;
    case '3':  // Child 3
        $childdirremovequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_3_ChildID = NULL, Child_3_Name = NULL, Child_3_BDay_Date = NULL, Child_3_Gender = NULL, Child_3_Email = NULL, Child_3_School = NULL, Child_3_Grade = NULL WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childdirremove = $mysql->query($childdirremovequery) or die("A database error occurred when trying to update child 3 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    $childrenremovequery = "DELETE FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '3'";
	    $childrenremove = $mysql->query($childrenremovequery) or die("A database error occurred when trying to update child 3 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $child_name, 'Profile Remove-Children 3:' , 'idDirectory= ' . $_SESSION["Famview_Profile"]);
    break;
    case '4':  // Child 4
	    $childdirremovequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_4_ChildID = NULL, Child_4_Name = NULL, Child_4_BDay_Date = NULL, Child_4_Gender = NULL, Child_4_Email = NULL, Child_4_School = NULL, Child_4_Grade = NULL WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childdirremove = $mysql->query($childdirremovequery) or die("A database error occurred when trying to update child 4 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    $childrenremovequery = "DELETE FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '4'";
	    $childrenremove = $mysql->query($childrenremovequery) or die("A database error occurred when trying to update child 4 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $child_name, 'Profile Remove-Children 4:' , 'idDirectory= ' . $_SESSION["Famview_Profile"]);
    break;

    case '5':  // Child 5
	    $childdirremovequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_5_ChildID = NULL, Child_5_Name = NULL, Child_5_BDay_Date = NULL, Child_5_Gender = NULL, Child_5_Email = NULL, Child_5_School = NULL, Child_5_Grade = NULL WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childdirremove = $mysql->query($childdirremovequery) or die("A database error occurred when trying to update child 5 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    $childrenremovequery = "DELETE FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '5'";
	    $childrenremove = $mysql->query($childrenremovequery) or die("A database error occurred when trying to update child 5 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $child_name, 'Profile Remove-Children 5:' , 'idDirectory= ' . $_SESSION["Famview_Profile"]);
    break;

    case '6':  // Child 6
	    $childdirremovequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_6_ChildID = NULL, Child_6_Name = NULL, Child_6_BDay_Date = NULL, Child_6_Gender = NULL, Child_6_Email = NULL, Child_6_School = NULL, Child_6_Grade = NULL WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childdirremove = $mysql->query($childdirremovequery) or die("A database error occurred when trying to update child 6 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    $childrenremovequery = "DELETE FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '6'";
	    $childrenremove = $mysql->query($childrenremovequery) or die("A database error occurred when trying to update child 6 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $child_name, 'Profile Remove-Children 6:' , 'idDirectory= ' . $_SESSION["Famview_Profile"]);
    break;

    case '7':  // Child 7
	    $childdirremovequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_7_ChildID = NULL, Child_7_Name = NULL, Child_7_BDay_Date = NULL, Child_7_Gender = NULL, Child_7_Email = NULL, Child_7_School = NULL, Child_7_Grade = NULL WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childdirremove = $mysql->query($childdirremovequery) or die("A database error occurred when trying to update child 7 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    $childrenremovequery = "DELETE FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '7'";
	    $childrenremove = $mysql->query($childrenremovequery) or die("A database error occurred when trying to update child 7 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $child_name, 'Profile Remove-Children 7:' , 'idDirectory= ' . $_SESSION["Famview_Profile"]);
    break;

    case '8':  // Child 8
	    $childdirremovequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_8_ChildID = NULL, Child_8_Name = NULL, Child_8_BDay_Date = NULL, Child_8_Gender = NULL, Child_8_Email = NULL, Child_8_School = NULL, Child_8_Grade = NULL WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childdirremove = $mysql->query($childdirremovequery) or die("A database error occurred when trying to update child 8 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    $childrenremovequery = "DELETE FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '8'";
	    $childrenremove = $mysql->query($childrenremovequery) or die("A database error occurred when trying to update child 8 info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $child_name, 'Profile Remove-Children 8:' , 'idDirectory= ' . $_SESSION["Famview_Profile"]);
    break;
    };
// $return_arr[] = array("dirremove" => $childdirremove, "childremove" => $childrenremove);
// $buildjson = array('lastname' => $lastname, 'hisname' => $hisname, 'hername' => $hername, 'addr1' => $addr1, 'addr2' => $addr2, 'city' => $city, 'state' => $state, 'zip' => $zip, 'email1' => $email1, 'email2' => $email2, 'phonehome' => $phonehome, 'hiscell' => $hiscell, 'hercell' => $hercell, 'hisbday' => $hisbday, 'herbday' => $herbday, 'anniv' => $anniv, 'piclink' => $piclink, 'piclink2' => $piclink2, 'L2L_ID' => $L2L_ID, 'child_1_name' => $child_1_name, 'child_1_bday' => $child_1_bday, 'child_1_email' => $child_1_email, 'child_1_gender' => $child_1_gender, 'child_1_school' => $child_1_school, 'child_1_grade' => $child_1_grade, 'child_2_name' => $child_2_name, 'child_2_bday' => $child_2_bday, 'child_2_email' => $child_2_email, 'child_2_gender' => $child_2_gender, 'child_2_school' => $child_2_school, 'child_2_grade' => $child_2_grade, 'child_3_name' => $child_3_name, 'child_3_bday' => $child_3_bday, 'child_3_email' => $child_3_email, 'child_3_gender' => $child_3_gender, 'child_3_school' => $child_3_school, 'child_3_grade' => $child_3_grade, 'child_4_name' => $child_4_name, 'child_4_bday' => $child_4_bday, 'child_4_email' => $child_4_email, 'child_4_gender' => $child_4_gender, 'child_4_school' => $child_4_school, 'child_4_grade' => $child_4_grade, 'child_5_name' => $child_5_name, 'child_5_bday' => $child_5_bday, 'child_5_email' => $child_5_email, 'child_5_gender' => $child_5_gender, 'child_5_school' => $child_5_school, 'child_5_grade' => $child_5_grade, 'child_6_name' => $child_6_name, 'child_6_bday' => $child_6_bday, 'child_6_email' => $child_6_email, 'child_6_gender' => $child_6_gender, 'child_6_school' => $child_6_school, 'child_6_grade' => $child_6_grade, 'child_7_name' => $child_7_name, 'child_7_bday' => $child_7_bday, 'child_7_email' => $child_7_email, 'child_7_gender' => $child_7_gender, 'child_7_school' => $child_7_school, 'child_7_grade' => $child_7_grade, 'child_8_name' => $child_8_name, 'child_8_bday' => $child_8_bday, 'child_8_email' => $child_8_email, 'child_8_gender' => $child_8_gender, 'child_8_school' => $child_8_school, 'child_8_grade' => $child_8_grade);
// array_push($return_arr, $buildjson);
// header('Content-type: application/json');
// echo json_encode($return_arr);

?>    
