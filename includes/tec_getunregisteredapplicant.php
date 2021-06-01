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
        $regcontrol = "<tr><td></td>";
        $regdate = "<td>" . date("M d, Y", strtotime($unregisteredqueryrow['regdate'])) . "</td>";
        $churchcode = "<td>" . $unregisteredqueryrow['churchcode'] . "</td>";
        $firstname = "<td>" . $unregisteredqueryrow['firstname'] . "</td>";
        $lastname = "<td>" . $unregisteredqueryrow['lastname'] . "</td>";
        $username = "<td>" . $unregisteredqueryrow['user'] . "</td>";
        $gender = "<td>" . $unregisteredqueryrow['gender'] . "</td>";
        $email = "<td>" . $unregisteredqueryrow['email'] . "</td>";
        $approve_button = "<td><button type='button' class='btn btn-success applicant_approve btn-sm' data-toggle='modal' data-target='#ModalRegApprove'>Approve</button></td>";
        $reject_button = "<td><button type='button' class='btn btn-danger applicant_reject btn-sm' data-toggle='modal' data-target='#ModalRegReject'>Reject</button></td>";
        $email_button = "<td><button type='button' class='btn btn-primary btn-sm applicant_email' data-toggle='modal' data-target='#ModalTBD'>Send Email</button></td>";
        $loginid = "<td>" . $unregisteredqueryrow['loginID'] . "</td>";
        $directoryid = "<td>" . $unregisteredqueryrow['idDirectory'] . "</td>";
        $regcount2 = "<td>" . $regcount  . "</td></tr>";

        // Stores each database record to an array
        $buildjson = array($regcontrol, $churchcode, $firstname, $lastname, $gender, $username, $email, $regdate, $approve_button, $reject_button, $email_button, $loginid, $directoryid, $regcount2);
        // Adds each array into the container array
        array_push($listarray, $buildjson);
    }
}
// Prepend array with parent element
$listarray = array('data' => $listarray);
header('Content-type: application/json');
echo json_encode($listarray);
?>