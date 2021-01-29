<?php
// List all unregistered applicants in json format - those who have requested to register but have not been approved
// Last Updated: 2020/12/10
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
require_once('../tec_dbconnect.php');
/* Populate DataTable */
/* Query unregistered applicant listing from Login table: active = 0 */
$unregisteredquery = "SELECT login_ID AS loginID, church_ID AS churchcode, idDirectory AS idDirectory, username AS user, gender AS gender, register_date AS regdate, lastname AS lastname, firstname AS firstname, email_addr AS email FROM " . $_SESSION['logintablename'] . " WHERE active = '0'";
$unregisteredqueryresult = $mysql->query($unregisteredquery) or die(" Unregistered Applicant table query error. Error:" . $mysql->error);
$unregisteredquerycount = $unregisteredqueryresult->num_rows;
$listarray = array();
if ($unregisteredquerycount == 0)
{
    $unregistered = 'no unregistered applicant requests';
    $listarray = array('data' => $unregistered);
}
else {
    $regcount = 0;
    while($unregisteredqueryrow = $unregisteredqueryresult->fetch_assoc()) {
        ++$regcount; // similar to $regcount = $regcount + 1
        $regdate = date("M d, Y", strtotime($unregisteredqueryrow['regdate']));
        $regcontrol = "<tr><td></td>";
        $loginid = "<td>" . $unregisteredqueryrow['loginID'] . "</td>";
        $directoryid = "<td>" . $unregisteredqueryrow['idDirectory'] . "</td>";
        $churchcode = "<td>" . $unregisteredqueryrow['churchcode'] . "</td>";
        $firstname = "<td>" . $unregisteredqueryrow['firstname'] . "</td>";
        $lastname = "<td>" . $unregisteredqueryrow['lastname'] . "</td>";
        $username = "<td>" . $unregisteredqueryrow['user'] . "</td>";
        $gender = "<td>" . $unregisteredqueryrow['gender'] . "</td>";
        $email = "<td>" . $unregisteredqueryrow['email'] . "</td>";
        $approve_button = "Approve";
        $reject_button = "Reject";
        $email_button = "Send Email";


        // Stores each database record to an array
        $buildjson = array($regcontrol, $churchcode, $firstname, $lastname, $gender, $username, $email, $regdate, $approve_button, $reject_button, $email_button, $loginid, $directoryid, $regcount);
        // Adds each array into the container array
        array_push($listarray, $buildjson);
    }
}
// Prepend array with parent element
$listarray = array('data' => $listarray);
header('Content-type: application/json');
echo json_encode($listarray);
?>