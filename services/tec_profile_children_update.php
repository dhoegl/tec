<?php
// ***************************************************************
// Process profile update - CHILDREN (name, gender, birthdate, etc.) INFO: Called from tec_profile.php
// Called ffrom ofc_profile.php form submit for Children entry
// Last Updated: 12/26/2020: Working on pre-Delete prompt
session_start();
if(!$_SESSION['logged in']) {
	header("location:../tec_welcome.php");
	exit();
}

require('../tec_dbconnect.php');
// Event Log Update trap
include('../includes/event_logs_update.php');

// *******************************************************************************
// ***************************** 20201231 Update Children ************************
// *******************************************************************************

$submit_child = true;
switch ($submit_child)
{
// ***************************************************************
// ***************************** 20201231 Child 1 ************************
// ***************************************************************
// *********** Submit Child Update to Directory and Children tables **************/
    case isset($_POST['submit1children']):
        $child_name = $_POST['lastname'];
	    $child_name = stripslashes($_POST['child1_name']);
	    $child_bday = $_POST['child1_bday'];
	    if(!$child_bday) {
		    $child_bday == NULL;
	    }
	    $child_gender = $_POST['child1_gender'];
	    $child_email = stripslashes($_POST['child1_email']);

        // *********** ADD SCHOOL + GRADE **************/
	    $child_school = $_POST['child1_school'];
        if(!$child_school) {
            $child_school == NULL;
        }
        $child_grade = substr($_POST['child1_grade'],0,2);
        if(!$child_grade) {
            $child_grade == NULL;
        }
        // *********** Update Directory table **************/
	    $childupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_1_Name = '" . $child_name . "', Child_1_BDay_Date = '" . $child_bday . "', Child_1_Gender = '" . $child_gender . "', Child_1_Email = '" . $child_email . "', Child_1_School = '" . $child_school . "', Child_1_Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childupdate = $mysql->query($childupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 1 in directory table:' , 'username= ' . $_SESSION['username']);


        // *********** Add/Update children table **************/
        // Check if child exists in children table
        $childtablecheckquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '1'";
        $childtablecheck = $mysql->query($childtablecheckquery) or die("A database error occurred when trying to check whether child exists in childtable. See tec_profile_children_update.php. Error #: " . $mysql->errno . " : " . $mysql->error);
        $childtablecheckcount = $childtablecheck->num_rows;

        if ($childtablecheckcount == 0)
        // If child doesn't exist
        {
            $childtableinsertquery = "INSERT INTO " . $_SESSION['childtablename'] . " (idDirectory, child_entry_chron, Name, Birthdate, Gender, Email, School, Grade)" . " VALUES(" . $_SESSION["Famview_Profile"] . ", '1' , " . "'" . $child_name . "','" . $child_bday . "','" . $child_gender . "','" . $child_email . "','" . $child_school . "','" . $child_grade . "')";
            $childtableinsert = $mysql->query($childtableinsertquery) or die("A database error occurred when trying to INSERT new child in childtable. Error #: " . $mysql->errno . " : " . $mysql->error);
        // Add child table entry ID to Directory Table
            $ChildInsert_DirID = $mysql->insert_id;
            $childtableupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_1_ChildID = '" . $ChildInsert_DirID . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child ID in Directory table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
    	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Add-Child 1 in children table:' , 'username= ' . $_SESSION['username']);
        }
        else
        {
            // If child does exist
            $childtableupdatequery = "UPDATE " . $_SESSION['childtablename'] . " SET Name = '" . $child_name . "', Birthdate = '" . $child_bday . "', Gender = '" . $child_gender . "', Email = '" . $child_email . "', School = '" . $child_school . "', Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '1'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
            $chronvar = "1";
            $childUpdate_IDquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE child_entry_chron = " . $chronvar;
            $childUpdate_ID = $mysql->query($childUpdate_IDquery) or die("A database error occurred when trying to get child ID when updating children table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
            while($activerow = $childUpdate_ID->fetch_assoc()){
                $childUpdate_IDvalue = $activerow['childID'];
            }
            eventLogUpdate('profile_update', $childUpdate_IDvalue . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 1 in children table:' , 'username= ' . $_SESSION['username']);
        }
    break;


    // ***************************************************************
    // ***************************** 20201231 Child 2 ************************
    // ***************************************************************
    // *********** Submit Child Update to Directory and Children tables **************/
    case isset($_POST['submit2children']):
        $child_name = $_POST['lastname'];
	    $child_name = stripslashes($_POST['child2_name']);
	    $child_bday = $_POST['child2_bday'];
	    if(!$child_bday) {
		    $child_bday == NULL;
	    }
	    $child_gender = $_POST['child2_gender'];
	    $child_email = stripslashes($_POST['child2_email']);

        // *********** ADD SCHOOL + GRADE **************/
	    $child_school = $_POST['child2_school'];
        if(!$child_school) {
            $child_school == NULL;
        }
        $child_grade = substr($_POST['child2_grade'],0,2);
        if(!$child_grade) {
            $child_grade == NULL;
        }
        // *********** Update Directory table **************/
	    $childupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_2_Name = '" . $child_name . "', Child_2_BDay_Date = '" . $child_bday . "', Child_2_Gender = '" . $child_gender . "', Child_2_Email = '" . $child_email . "', Child_2_School = '" . $child_school . "', Child_2_Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childupdate = $mysql->query($childupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 2 in directory table:' , 'username= ' . $_SESSION['username']);


        // *********** Add/Update children table **************/
        // Check if child exists in children table
        $childtablecheckquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '2'";
        $childtablecheck = $mysql->query($childtablecheckquery) or die("A database error occurred when trying to check whether child exists in childtable. See tec_profile_children_update.php. Error #: " . $mysql->errno . " : " . $mysql->error);
        $childtablecheckcount = $childtablecheck->num_rows;

        if ($childtablecheckcount == 0)
        // If child doesn't exist
        {
            $childtableinsertquery = "INSERT INTO " . $_SESSION['childtablename'] . " (idDirectory, child_entry_chron, Name, Birthdate, Gender, Email, School, Grade)" . " VALUES(" . $_SESSION["Famview_Profile"] . ", '2' , " . "'" . $child_name . "','" . $child_bday . "','" . $child_gender . "','" . $child_email . "','" . $child_school . "','" . $child_grade . "')";
            $childtableinsert = $mysql->query($childtableinsertquery) or die("A database error occurred when trying to INSERT new child in childtable. Error #: " . $mysql->errno . " : " . $mysql->error);
            // Add child table entry ID to Directory Table
            $ChildInsert_DirID = $mysql->insert_id;
            $childtableupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_2_ChildID = '" . $ChildInsert_DirID . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child ID in Directory table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
    	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Add-Child 2 in children table:' , 'username= ' . $_SESSION['username']);
        }
        else
        {
            // If child does exist
            $childtableupdatequery = "UPDATE " . $_SESSION['childtablename'] . " SET Name = '" . $child_name . "', Birthdate = '" . $child_bday . "', Gender = '" . $child_gender . "', Email = '" . $child_email . "', School = '" . $child_school . "', Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '2'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
            $chronvar = "2";
            $childUpdate_IDquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE child_entry_chron = " . $chronvar;
            $childUpdate_ID = $mysql->query($childUpdate_IDquery) or die("A database error occurred when trying to get child ID when updating children table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
            while($activerow = $childUpdate_ID->fetch_assoc()){
                $childUpdate_IDvalue = $activerow['childID'];
            }
            eventLogUpdate('profile_update', $childUpdate_IDvalue . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 2 in children table:' , 'username= ' . $_SESSION['username']);
        }
        break;

    // ***************************************************************
    // ***************************** 20201231 Child 3 ************************
    // ***************************************************************
    // *********** Submit Child Update to Directory and Children tables **************/
    case isset($_POST['submit3children']):
        $child_name = $_POST['lastname'];
	    $child_name = stripslashes($_POST['child3_name']);
	    $child_bday = $_POST['child3_bday'];
	    if(!$child_bday) {
		    $child_bday == NULL;
	    }
	    $child_gender = $_POST['child3_gender'];
	    $child_email = stripslashes($_POST['child3_email']);

        // *********** ADD SCHOOL + GRADE **************/
	    $child_school = $_POST['child3_school'];
        if(!$child_school) {
            $child_school == NULL;
        }
        $child_grade = substr($_POST['child3_grade'],0,2);
        if(!$child_grade) {
            $child_grade == NULL;
        }
        // *********** Update Directory table **************/
	    $childupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_3_Name = '" . $child_name . "', Child_3_BDay_Date = '" . $child_bday . "', Child_3_Gender = '" . $child_gender . "', Child_3_Email = '" . $child_email . "', Child_3_School = '" . $child_school . "', Child_3_Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childupdate = $mysql->query($childupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 3 in directory table:' , 'username= ' . $_SESSION['username']);


        // *********** Add/Update children table **************/
        // Check if child exists in children table
        $childtablecheckquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '3'";
        $childtablecheck = $mysql->query($childtablecheckquery) or die("A database error occurred when trying to check whether child exists in childtable. See tec_profile_children_update.php. Error #: " . $mysql->errno . " : " . $mysql->error);
        $childtablecheckcount = $childtablecheck->num_rows;

        if ($childtablecheckcount == 0)
        // If child doesn't exist
        {
            $childtableinsertquery = "INSERT INTO " . $_SESSION['childtablename'] . " (idDirectory, child_entry_chron, Name, Birthdate, Gender, Email, School, Grade)" . " VALUES(" . $_SESSION["Famview_Profile"] . ", '3' , " . "'" . $child_name . "','" . $child_bday . "','" . $child_gender . "','" . $child_email . "','" . $child_school . "','" . $child_grade . "')";
            $childtableinsert = $mysql->query($childtableinsertquery) or die("A database error occurred when trying to INSERT new child in childtable. Error #: " . $mysql->errno . " : " . $mysql->error);
            // Add child table entry ID to Directory Table
            $ChildInsert_DirID = $mysql->insert_id;
            $childtableupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_3_ChildID = '" . $ChildInsert_DirID . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child ID in Directory table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
    	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Add-Child 3 in children table:' , 'username= ' . $_SESSION['username']);
        }
        else
        {
            // If child does exist
            $childtableupdatequery = "UPDATE " . $_SESSION['childtablename'] . " SET Name = '" . $child_name . "', Birthdate = '" . $child_bday . "', Gender = '" . $child_gender . "', Email = '" . $child_email . "', School = '" . $child_school . "', Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '3'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
            $chronvar = "3";
            $childUpdate_IDquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE child_entry_chron = " . $chronvar;
            $childUpdate_ID = $mysql->query($childUpdate_IDquery) or die("A database error occurred when trying to get child ID when updating children table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
            while($activerow = $childUpdate_ID->fetch_assoc()){
                $childUpdate_IDvalue = $activerow['childID'];
            }
            eventLogUpdate('profile_update', $childUpdate_IDvalue . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 3 in children table:' , 'username= ' . $_SESSION['username']);
        }
        break;

    // ***************************************************************
    // ***************************** 20201231 Child 4 ************************
    // ***************************************************************

    // *********** Submit Child Update to Directory and Children tables **************/
    case isset($_POST['submit4children']):
        $child_name = $_POST['lastname'];
	    $child_name = stripslashes($_POST['child4_name']);
	    $child_bday = $_POST['child4_bday'];
	    if(!$child_bday) {
		    $child_bday == NULL;
	    }
	    $child_gender = $_POST['child4_gender'];
	    $child_email = stripslashes($_POST['child4_email']);

        // *********** ADD SCHOOL + GRADE **************/
	    $child_school = $_POST['child4_school'];
        if(!$child_school) {
            $child_school == NULL;
        }
        $child_grade = substr($_POST['child4_grade'],0,2);
        if(!$child_grade) {
            $child_grade == NULL;
        }
        // *********** Update Directory table **************/
	    $childupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_4_Name = '" . $child_name . "', Child_4_BDay_Date = '" . $child_bday . "', Child_4_Gender = '" . $child_gender . "', Child_4_Email = '" . $child_email . "', Child_4_School = '" . $child_school . "', Child_4_Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childupdate = $mysql->query($childupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 4 in directory table:' , 'username= ' . $_SESSION['username']);


        // *********** Add/Update children table **************/
        // Check if child exists in children table
        $childtablecheckquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '4'";
        $childtablecheck = $mysql->query($childtablecheckquery) or die("A database error occurred when trying to check whether child exists in childtable. See tec_profile_children_update.php. Error #: " . $mysql->errno . " : " . $mysql->error);
        $childtablecheckcount = $childtablecheck->num_rows;

        if ($childtablecheckcount == 0)
        // If child doesn't exist
        {
            $childtableinsertquery = "INSERT INTO " . $_SESSION['childtablename'] . " (idDirectory, child_entry_chron, Name, Birthdate, Gender, Email, School, Grade)" . " VALUES(" . $_SESSION["Famview_Profile"] . ", '4' , " . "'" . $child_name . "','" . $child_bday . "','" . $child_gender . "','" . $child_email . "','" . $child_school . "','" . $child_grade . "')";
            $childtableinsert = $mysql->query($childtableinsertquery) or die("A database error occurred when trying to INSERT new child in childtable. Error #: " . $mysql->errno . " : " . $mysql->error);
            // Add child table entry ID to Directory Table
            $ChildInsert_DirID = $mysql->insert_id;
            $childtableupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_4_ChildID = '" . $ChildInsert_DirID . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child ID in Directory table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
    	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Add-Child 4 in children table:' , 'username= ' . $_SESSION['username']);
        }
        else
        {
            // If child does exist
            $childtableupdatequery = "UPDATE " . $_SESSION['childtablename'] . " SET Name = '" . $child_name . "', Birthdate = '" . $child_bday . "', Gender = '" . $child_gender . "', Email = '" . $child_email . "', School = '" . $child_school . "', Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '4'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
            $chronvar = "4";
            $childUpdate_IDquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE child_entry_chron = " . $chronvar;
            $childUpdate_ID = $mysql->query($childUpdate_IDquery) or die("A database error occurred when trying to get child ID when updating children table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
            while($activerow = $childUpdate_ID->fetch_assoc()){
                $childUpdate_IDvalue = $activerow['childID'];
            }
            eventLogUpdate('profile_update', $childUpdate_IDvalue . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 4 in children table:' , 'username= ' . $_SESSION['username']);
        }
        break;


    // ***************************************************************
    // ***************************** 20201231 Child 5 ************************
    // ***************************************************************

    // *********** Submit Child Update to Directory and Children tables **************/
    case isset($_POST['submit5children']):
        $child_name = $_POST['lastname'];
	    $child_name = stripslashes($_POST['child5_name']);
	    $child_bday = $_POST['child5_bday'];
	    if(!$child_bday) {
		    $child_bday == NULL;
	    }
	    $child_gender = $_POST['child5_gender'];
	    $child_email = stripslashes($_POST['child5_email']);

        // *********** ADD SCHOOL + GRADE **************/
	    $child_school = $_POST['child5_school'];
        if(!$child_school) {
            $child_school == NULL;
        }
        $child_grade = substr($_POST['child5_grade'],0,2);
        if(!$child_grade) {
            $child_grade == NULL;
        }
        // *********** Update Directory table **************/
	    $childupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_5_Name = '" . $child_name . "', Child_5_BDay_Date = '" . $child_bday . "', Child_5_Gender = '" . $child_gender . "', Child_5_Email = '" . $child_email . "', Child_5_School = '" . $child_school . "', Child_5_Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childupdate = $mysql->query($childupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 5 in directory table:' , 'username= ' . $_SESSION['username']);


        // *********** Add/Update children table **************/
        // Check if child exists in children table
        $childtablecheckquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '5'";
        $childtablecheck = $mysql->query($childtablecheckquery) or die("A database error occurred when trying to check whether child exists in childtable. See tec_profile_children_update.php. Error #: " . $mysql->errno . " : " . $mysql->error);
        $childtablecheckcount = $childtablecheck->num_rows;

        if ($childtablecheckcount == 0)
        // If child doesn't exist
        {
            $childtableinsertquery = "INSERT INTO " . $_SESSION['childtablename'] . " (idDirectory, child_entry_chron, Name, Birthdate, Gender, Email, School, Grade)" . " VALUES(" . $_SESSION["Famview_Profile"] . ", '5' , " . "'" . $child_name . "','" . $child_bday . "','" . $child_gender . "','" . $child_email . "','" . $child_school . "','" . $child_grade . "')";
            $childtableinsert = $mysql->query($childtableinsertquery) or die("A database error occurred when trying to INSERT new child in childtable. Error #: " . $mysql->errno . " : " . $mysql->error);
            // Add child table entry ID to Directory Table
            $ChildInsert_DirID = $mysql->insert_id;
            $childtableupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_5_ChildID = '" . $ChildInsert_DirID . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child ID in Directory table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
    	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Add-Child 5 in children table:' , 'username= ' . $_SESSION['username']);
        }
        else
        {
            // If child does exist
            $childtableupdatequery = "UPDATE " . $_SESSION['childtablename'] . " SET Name = '" . $child_name . "', Birthdate = '" . $child_bday . "', Gender = '" . $child_gender . "', Email = '" . $child_email . "', School = '" . $child_school . "', Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '5'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
            $chronvar = "5";
            $childUpdate_IDquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE child_entry_chron = " . $chronvar;
            $childUpdate_ID = $mysql->query($childUpdate_IDquery) or die("A database error occurred when trying to get child ID when updating children table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
            while($activerow = $childUpdate_ID->fetch_assoc()){
                $childUpdate_IDvalue = $activerow['childID'];
            }
            eventLogUpdate('profile_update', $childUpdate_IDvalue . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 5 in children table:' , 'username= ' . $_SESSION['username']);
        }
        break;

    // ***************************************************************
    // ***************************** 20201231 Child 6 ************************
    // ***************************************************************

    // *********** Submit Child Update to Directory and Children tables **************/
    case isset($_POST['submit6children']):
        $child_name = $_POST['lastname'];
	    $child_name = stripslashes($_POST['child6_name']);
	    $child_bday = $_POST['child6_bday'];
	    if(!$child_bday) {
		    $child_bday == NULL;
	    }
	    $child_gender = $_POST['child6_gender'];
	    $child_email = stripslashes($_POST['child6_email']);

        // *********** ADD SCHOOL + GRADE **************/
	    $child_school = $_POST['child6_school'];
        if(!$child_school) {
            $child_school == NULL;
        }
        $child_grade = substr($_POST['child6_grade'],0,2);
        if(!$child_grade) {
            $child_grade == NULL;
        }
        // *********** Update Directory table **************/
	    $childupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_6_Name = '" . $child_name . "', Child_6_BDay_Date = '" . $child_bday . "', Child_6_Gender = '" . $child_gender . "', Child_6_Email = '" . $child_email . "', Child_6_School = '" . $child_school . "', Child_6_Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childupdate = $mysql->query($childupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 6 in directory table:' , 'username= ' . $_SESSION['username']);


        // *********** Add/Update children table **************/
        // Check if child exists in children table
        $childtablecheckquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '6'";
        $childtablecheck = $mysql->query($childtablecheckquery) or die("A database error occurred when trying to check whether child exists in childtable. See tec_profile_children_update.php. Error #: " . $mysql->errno . " : " . $mysql->error);
        $childtablecheckcount = $childtablecheck->num_rows;

        if ($childtablecheckcount == 0)
        // If child doesn't exist
        {
            $childtableinsertquery = "INSERT INTO " . $_SESSION['childtablename'] . " (idDirectory, child_entry_chron, Name, Birthdate, Gender, Email, School, Grade)" . " VALUES(" . $_SESSION["Famview_Profile"] . ", '6' , " . "'" . $child_name . "','" . $child_bday . "','" . $child_gender . "','" . $child_email . "','" . $child_school . "','" . $child_grade . "')";
            $childtableinsert = $mysql->query($childtableinsertquery) or die("A database error occurred when trying to INSERT new child in childtable. Error #: " . $mysql->errno . " : " . $mysql->error);
            // Add child table entry ID to Directory Table
            $ChildInsert_DirID = $mysql->insert_id;
            $childtableupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_6_ChildID = '" . $ChildInsert_DirID . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child ID in Directory table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
    	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Add-Child 6 in children table:' , 'username= ' . $_SESSION['username']);
        }
        else
        {
            // If child does exist
            $childtableupdatequery = "UPDATE " . $_SESSION['childtablename'] . " SET Name = '" . $child_name . "', Birthdate = '" . $child_bday . "', Gender = '" . $child_gender . "', Email = '" . $child_email . "', School = '" . $child_school . "', Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '6'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
            $chronvar = "6";
            $childUpdate_IDquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE child_entry_chron = " . $chronvar;
            $childUpdate_ID = $mysql->query($childUpdate_IDquery) or die("A database error occurred when trying to get child ID when updating children table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
            while($activerow = $childUpdate_ID->fetch_assoc()){
                $childUpdate_IDvalue = $activerow['childID'];
            }
            eventLogUpdate('profile_update', $childUpdate_IDvalue . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 6 in children table:' , 'username= ' . $_SESSION['username']);
        }
        break;


    // ***************************************************************
    // ***************************** 20201231 Child 7 ************************
    // ***************************************************************

    // *********** Submit Child Update to Directory and Children tables **************/
    case isset($_POST['submit7children']):
        $child_name = $_POST['lastname'];
	    $child_name = stripslashes($_POST['child7_name']);
	    $child_bday = $_POST['child7_bday'];
	    if(!$child_bday) {
		    $child_bday == NULL;
	    }
	    $child_gender = $_POST['child7_gender'];
	    $child_email = stripslashes($_POST['child7_email']);

        // *********** ADD SCHOOL + GRADE **************/
	    $child_school = $_POST['child7_school'];
        if(!$child_school) {
            $child_school == NULL;
        }
        $child_grade = substr($_POST['child7_grade'],0,2);
        if(!$child_grade) {
            $child_grade == NULL;
        }
        // *********** Update Directory table **************/
	    $childupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_7_Name = '" . $child_name . "', Child_7_BDay_Date = '" . $child_bday . "', Child_7_Gender = '" . $child_gender . "', Child_7_Email = '" . $child_email . "', Child_7_School = '" . $child_school . "', Child_7_Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childupdate = $mysql->query($childupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 7 in directory table:' , 'username= ' . $_SESSION['username']);


        // *********** Add/Update children table **************/
        // Check if child exists in children table
        $childtablecheckquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '7'";
        $childtablecheck = $mysql->query($childtablecheckquery) or die("A database error occurred when trying to check whether child exists in childtable. See tec_profile_children_update.php. Error #: " . $mysql->errno . " : " . $mysql->error);
        $childtablecheckcount = $childtablecheck->num_rows;

        if ($childtablecheckcount == 0)
        // If child doesn't exist
        {
            $childtableinsertquery = "INSERT INTO " . $_SESSION['childtablename'] . " (idDirectory, child_entry_chron, Name, Birthdate, Gender, Email, School, Grade)" . " VALUES(" . $_SESSION["Famview_Profile"] . ", '7' , " . "'" . $child_name . "','" . $child_bday . "','" . $child_gender . "','" . $child_email . "','" . $child_school . "','" . $child_grade . "')";
            $childtableinsert = $mysql->query($childtableinsertquery) or die("A database error occurred when trying to INSERT new child in childtable. Error #: " . $mysql->errno . " : " . $mysql->error);
            // Add child table entry ID to Directory Table
            $ChildInsert_DirID = $mysql->insert_id;
            $childtableupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_7_ChildID = '" . $ChildInsert_DirID . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child ID in Directory table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
    	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Add-Child 7 in children table:' , 'username= ' . $_SESSION['username']);
        }
        else
        {
            // If child does exist
            $childtableupdatequery = "UPDATE " . $_SESSION['childtablename'] . " SET Name = '" . $child_name . "', Birthdate = '" . $child_bday . "', Gender = '" . $child_gender . "', Email = '" . $child_email . "', School = '" . $child_school . "', Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '7'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
            $chronvar = "7";
            $childUpdate_IDquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE child_entry_chron = " . $chronvar;
            $childUpdate_ID = $mysql->query($childUpdate_IDquery) or die("A database error occurred when trying to get child ID when updating children table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
            while($activerow = $childUpdate_ID->fetch_assoc()){
                $childUpdate_IDvalue = $activerow['childID'];
            }
            eventLogUpdate('profile_update', $childUpdate_IDvalue . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 7 in children table:' , 'username= ' . $_SESSION['username']);
        }
        break;


    // ***************************************************************
    // ***************************** 20201231 Child 8 ************************
    // ***************************************************************

    // *********** Submit Child Update to Directory and Children tables **************/
    case isset($_POST['submit8children']):
        $child_name = $_POST['lastname'];
	    $child_name = stripslashes($_POST['child8_name']);
	    $child_bday = $_POST['child8_bday'];
	    if(!$child_bday) {
		    $child_bday == NULL;
	    }
	    $child_gender = $_POST['child8_gender'];
	    $child_email = stripslashes($_POST['child8_email']);

        // *********** ADD SCHOOL + GRADE **************/
	    $child_school = $_POST['child8_school'];
        if(!$child_school) {
            $child_school == NULL;
        }
        $child_grade = substr($_POST['child8_grade'],0,2);
        if(!$child_grade) {
            $child_grade == NULL;
        }
        // *********** Update Directory table **************/
	    $childupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_8_Name = '" . $child_name . "', Child_8_BDay_Date = '" . $child_bday . "', Child_8_Gender = '" . $child_gender . "', Child_8_Email = '" . $child_email . "', Child_8_School = '" . $child_school . "', Child_8_Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
	    $childupdate = $mysql->query($childupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 8 in directory table:' , 'username= ' . $_SESSION['username']);


        // *********** Add/Update children table **************/
        // Check if child exists in children table
        $childtablecheckquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '8'";
        $childtablecheck = $mysql->query($childtablecheckquery) or die("A database error occurred when trying to check whether child exists in childtable. See tec_profile_children_update.php. Error #: " . $mysql->errno . " : " . $mysql->error);
        $childtablecheckcount = $childtablecheck->num_rows;

        if ($childtablecheckcount == 0)
        // If child doesn't exist
        {
            $childtableinsertquery = "INSERT INTO " . $_SESSION['childtablename'] . " (idDirectory, child_entry_chron, Name, Birthdate, Gender, Email, School, Grade)" . " VALUES(" . $_SESSION["Famview_Profile"] . ", '8' , " . "'" . $child_name . "','" . $child_bday . "','" . $child_gender . "','" . $child_email . "','" . $child_school . "','" . $child_grade . "')";
            $childtableinsert = $mysql->query($childtableinsertquery) or die("A database error occurred when trying to INSERT new child in childtable. Error #: " . $mysql->errno . " : " . $mysql->error);
            // Add child table entry ID to Directory Table
            $ChildInsert_DirID = $mysql->insert_id;
            $childtableupdatequery = "UPDATE " . $_SESSION['dirtablename'] . " SET Child_8_ChildID = '" . $ChildInsert_DirID . "'  WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child ID in Directory table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
    	    eventLogUpdate('profile_update', $ChildInsert_DirID . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Add-Child 8 in children table:' , 'username= ' . $_SESSION['username']);
        }
        else
        {
            // If child does exist
            $childtableupdatequery = "UPDATE " . $_SESSION['childtablename'] . " SET Name = '" . $child_name . "', Birthdate = '" . $child_bday . "', Gender = '" . $child_gender . "', Email = '" . $child_email . "', School = '" . $child_school . "', Grade = '" . $child_grade . "' WHERE idDirectory = '". $_SESSION["Famview_Profile"] . "' AND child_entry_chron = '8'";
            $childtableupdate = $mysql->query($childtableupdatequery) or die("A database error occurred when trying to update child info. See tec_profile_children_update.php. Error : " . $mysql->errno . " : " . $mysql->error);
            $chronvar = "8";
            $childUpdate_IDquery = "SELECT * FROM " . $_SESSION['childtablename'] . " WHERE child_entry_chron = " . $chronvar;
            $childUpdate_ID = $mysql->query($childUpdate_IDquery) or die("A database error occurred when trying to get child ID when updating children table. See tec_profile_children_update.php. Error:" . $mysql->errno . " : " . $mysql->error);
            while($activerow = $childUpdate_ID->fetch_assoc()){
                $childUpdate_IDvalue = $activerow['childID'];
            }
            eventLogUpdate('profile_update', $childUpdate_IDvalue . " : " . $child_name . " : " . $child_bday . " : " . $child_gender . " : " . $child_email . " : " . $child_school . " : " . $child_grade, 'Profile Update-Child 8 in children table:' , 'username= ' . $_SESSION['username']);
        }
        break;
}
header("location:../tec_profile.php?id=" . $_SESSION["Famview_Profile"]);
?>