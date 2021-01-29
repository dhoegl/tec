<?php
// tec_getapprovedmembers
// called from tec_view_approvedmembers
// Last Updated: 2020/12/10
session_start();
if(!$_SESSION['logged in']) {
    session_destroy();
    exit();
}
require_once('../tec_dbconnect.php');
/* Query registered members listing from Directory table: status = 1 */
$approvedmembersquery = "SELECT idDirectory, church_ID, Surname, Name_1, Name_2 FROM " . $_SESSION['dirtablename'] . " WHERE status = '1'";
$approvedmembersqueryresult = $mysql->query($approvedmembersquery) or die(" Approved members query error. Error:" . $mysql->error);
$approvedmembersquerycount = $approvedmembersqueryresult->num_rows;
$listarray = array();
$noID = '0';
$default_no_match = 'new family';
$null = ' ';
$select = "Select";
if ($approvedmembersquerycount == 0)
{
    $no_approved = 'no approved members';
    $listarray = array('data' => $no_approved);
}
else {
    $buildjson = array($select, $noID, $null, $default_no_match, $null, $null);
    //$buildjson = array($select, $noID, $default_no_match, $null, $null);
    array_push($listarray, $buildjson);
    while($approvedmembersqueryrow = $approvedmembersqueryresult->fetch_assoc()) {
        $idDirectory = $approvedmembersqueryrow['idDirectory'];
        $churchcode = $approvedmembersqueryrow['church_ID'];
        $lastname = $approvedmembersqueryrow['Surname'];
        $his_name = $approvedmembersqueryrow['Name_1'];
        $her_name = $approvedmembersqueryrow['Name_2'];
        // Stores each database record to an array
        $buildjson = array($select, $idDirectory, $churchcode, $lastname, $his_name, $her_name);
        //$buildjson = array($select, $idDirectory, $lastname, $his_name, $her_name);
        // Adds each array into the container array
        array_push($listarray, $buildjson);
    }
}
// Prepend array with parent element
$listarray = array('data' => $listarray);
header('Content-type: application/json');
echo json_encode($listarray);
?>