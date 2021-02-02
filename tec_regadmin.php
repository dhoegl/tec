<?php
//Last Updated 12/09/2020: Admin accept/reject script for unregistered applicants
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
$sessname = session_name();
$sessid = session_id();
$profileID = $_SESSION['idDirectory'];
require_once('tec_dbconnect.php');


//Query for users requesting to register but not yet approved
$sqlquery = "SELECT * FROM " . $_SESSION['logintablename'] . " WHERE active = 0";
$result = $mysql->query($sqlquery) or die("A database error occurred when trying to select registrants for Dir and Login Table. See tec_regadmin.php. Error : " . $mysql->errno . " : " . $mysql->error);

// Mysql_num_row is count of table rows returned. Expect at least 1
$count = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- BOOTSTRAP 4 - Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/MDBootstrap4191/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
    <!-- Test custom styles (Includes tec style details) -->
    <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">

    <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


    <!-- Call Moment js for date calc functions -->
    <script src="js/moment.js"></script>
    <!-- JQuery -->
    <!-- <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.1.0.min.js"></script>

<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->
    <?php
// Get User Login details
    include('includes/tec_get_loggedinuser.php');
    // Get Unregistered Applicant List
    include('includes/tec_view_unregisteredapplicantslist.php');
    // Get Approved Members List
    include('includes/tec_view_approvedmembers.php');
    // Get Approve Registrant Script
    // include('/services/ofc_approve_registrant.php');
    ?>
    <!-- Tenant Configuration JavaScript Call -->
    <!-- <script type="text/javascript" src="/js/ofc_config_ajax_call.js"></script> -->

<!-- ********************* Get Which Registrant Item's 'Approve/Reject/Send Email' button was clicked ******************* -->
<!-- ********************* Get Which Registrant Item's 'Approve/Reject/Send Email' button was clicked ******************* -->
<!-- ********************* Get Which Registrant Item's 'Approve/Reject/Send Email' button was clicked ******************* -->
<script type="text/javascript">
    function reportError(data) {

        //var $result = data.responseText;
        var $result = data,
            $status = $result.Status,
            $script = $result.script,
            $line = $result.line;

        alert("A problem has occurred with your registrant approval/rejection. Please notify your administrator with the following error: 'tec_regadmin: Error = " + $result + "'");
        console.log("data = " + $result);
        console.log("Status = " + $status);
        console.log("Script = " + $script);
        console.log("Line = " + $line);
    };
    </script>
    <script type="text/javascript">
        //var jQA = jQuery.noConflict();
        //jQA(document).ready(function () {
        function RegistrantUpdate(data1, data2, data3, data4, data5, data6, data7) {
            var Selected = "Select = " + data1;
            var DirID = "Directory = " + data2;
            var LoginID = "Login = " + data3;
            var Gender = "Gender = " + data4;
            var First = "FirstName = " + data5;
            var Last = "LastName = " + data6;
            var Email = "Email = " + data7;
            var $Response = Selected + " " + DirID + " " + LoginID + " " + Gender + " " + First + " " + Last + " " + Email;
            console.log("tec_approve_registrant : Response = " + $Response);
            jQ10.ajax({
                url: '../services/ajax_update_new_registrant.php',
                type: 'POST',
                //dataType: 'json',
                dataType: 'text',
                data: { Selected: data1, Directory: data2, Login: data3, Gender: data4, FirstName: data5, LastName: data6, Email: data7 }
            })
                .done(function (jqXHR, textStatus) {
                    //  Get the result
                    var result = "success";
                    var teststat = textStatus;
                    teststat2 = jqXHR.responseText;
                    // console.log("ajax response data = " + teststat);
                    // console.log("ajax response text = " + teststat2);
                    alert("Updates have been made. Registrant has been notified.");
                    location.reload();
                    return result;
                })
                .fail(function (jqXHR, textStatus) {
                    //  Get the result
                    //result = (rtnData === undefined) ? null : rtnData.d;
                    var result = "fail";
                    var teststat = textStatus;
                    var teststat2 = jqXHR.responseText;
                    // console.log("ajax response data = " + teststat);
                    // console.log("ajax response text = " + teststat2);
                    reportError(teststat);
                    //alert("A problem has occurred with your approval - ofc_approve_registrant. Please copy this error and contact your OurFamilyConnections administrator for details.");
                    location.reload();
                    return result;
                });
        };

</script>

<!-- **************************** Get Which Registrant's Item's 'Approve' button was clicked ******************** -->
<!-- **************************** Get Which Registrant's Item's 'Approve' button was clicked ******************** -->
<!-- **************************** Get Which Registrant's Item's 'Approve' button was clicked ******************** -->
<script type="text/javascript">
var sname = "<?php echo $sessname ?>;";
var sid = "<?php echo $sessid ?>;";
var loggedin = "<?php echo $_SESSION['logged in'] ?>;";
var $approveclickbuttonid = "NA";
var $approveURL = "NA";
var testforSelect = "0";
var jQ10 = jQuery.noConflict();
jQ10(document).ready(function () {
    jQ10("#unregisteredapplicant tbody").off("click", '.applicant_approve');
    jQ10("#unregisteredapplicant tbody").on("click", '.applicant_approve', function () {
        // console.log("Session Name = " + sname);
        // console.log("Session ID = " + sid);
        // console.log("Logged in status = " + loggedin);
        var testforChild = "0";
        var LoginID = "0";
        var DirID = "0";
        var ChurchCode = "0";
        var UserName = "0";
        var Email = "0";
        var Gender = "0";
        var FirstName = "0";
        var LastName = "0";
        testforChild = jQ10(this).closest('tr');
        if (testforChild.hasClass("child")) {
            // console.log("Child IS closest TR class");
            LoginID = testforChild.prev("tr").find(".loginid").text();
            // console.log("LoginID = " + LoginID);
            jQ10("#loginidApprove").html("<h6> LoginID: " + LoginID + "</h6>");
            DirID = testforChild.prev("tr").find(".dirid").text();
            // console.log("DirID = " + DirID);
            jQ10("#diridApprove").html("<h6> DirectoryID: " + DirID + "</h6>");
            ChurchCode = testforChild.prev("tr").find(".churchcode").text();
            // console.log("ChurchCode = " + ChurchCode);
            jQ10("#churchcodeApprove").html("<h6> Church Code: " + ChurchCode + "</h6>");
            UserName = testforChild.prev("tr").find(".username").text();
            // console.log("UserName = " + UserName);
            jQ10("#usernameApprove").html("<h6> UserName: " + UserName + "</h6>");
            FirstName = testforChild.prev("tr").find(".firstname").text();
            // console.log("FirstName = " + FirstName);
            jQ10("#firstnameApprove").html("<h6> First Name: " + FirstName + "</h6>");
            LastName = testforChild.prev("tr").find(".lastname").text();
            // console.log("LastName = " + LastName);
            jQ10("#lastnameApprove").html("<h6> Last Name: " + LastName + "</h6>");
            jQ10("#fullnameApprove").html("<h6> Name: " + FirstName + " " + LastName + "</h6>");
            Email = testforChild.prev("tr").find(".email").text();
            // console.log("Email = " + Email);
            jQ10("#emailApprove").html("<h6> Email: " + Email + "</h6>");
            Gender = testforChild.prev("tr").find(".gender").text();
            // console.log("Gender = " + Gender);
            jQ10("#genderApprove").html("<h6> Gender: " + Gender + "</h6>");

    // Display the Approve popup
    jQ10("#ModalApproveRegistrant").modal('show');
        }
        else {
            // console.log("Child IS NOT closest TR class");
            LoginID = jQ10(this).closest('tr').find(".loginid").text();
            // console.log("LoginID = " + LoginID);
            jQ10("#loginidApprove").html("<h6> LoginID: " + LoginID + "</h6>");
            DirID = jQ10(this).closest('tr').find(".dirid").text();
            // console.log("DirID = " + DirID);
            jQ10("#famidApprove").html("<h6> DirectoryID: " + DirID + "</h6>");
            ChurchCode = jQ10(this).closest('tr').find(".churchcode").text();
            // console.log("ChurchCode = " + ChurchCode);
            jQ10("#churchcodeApprove").html("<h6> Church Code: " + ChurchCode + "</h6>");
            UserName = jQ10(this).closest('tr').find(".username").text();
            // console.log("UserName = " + UserName);
            jQ10("#usernameApprove").html("<h6> UserName: " + UserName + "</h6>");
            FirstName = jQ10(this).closest('tr').find(".firstname").text();
            // console.log("FirstName = " + FirstName);
            jQ10("#firstnameApprove").html("<h6> FirstName: " + FirstName + "</h6>");
            LastName = jQ10(this).closest('tr').find(".lastname").text();
            // console.log("LastName = " + LastName);
            jQ10("#lastnameApprove").html("<h6> Last Name: " + LastName + "</h6>");
            jQ10("#fullnameApprove").html("<h6> Name: " + FirstName + " " + LastName + "</h6>");
            Email = jQ10(this).closest('tr').find(".email").text();
            // console.log("Email = " + Email);
            jQ10("#emailApprove").html("<h6> Email: " + Email + "</h6>");
            Gender = jQ10(this).closest('tr').find(".gender").text();
            // console.log("Gender = " + Gender);
            jQ10("#genderApprove").html("<h6> Gender: " + Gender + "</h6>");

    // Display the Approve popup
    jQ10("#ModalApproveRegistrant").modal('show');
        }
		$approveclickbuttonid = LoginID;
		// console.log("$approve loginID clicked = " + $approveclickbuttonid);
		$approveURL = "tec_newregistrantaccept.php?registerid=" + $approveclickbuttonid;
        // console.log("approveURL = " + $approveURL);

// **************************** Get Which Approved Member SELECT button was selected ********************
// **************************** Get Which Approved Member SELECT button was selected ********************
// **************************** Get Which Approved Member SELECT button was selected ********************
        var testforSelect = "";
        // Visually present which row SELECT button is clicked, while also extinguishing the previously-clicked row SELECT button
        jQ10("#approvedmemberslist tbody").off("click", '.Select', function () {
        });
        jQ10("#approvedmemberslist tbody").on("click", '.Select', function () {
            // Extinguish previous SELECT selection to ensure only one approved member is selected
            // See https://www.bitdegree.org/learn/jquery-children
            jQ10("#approvedmemberslist tbody").children("tr").css({"background": "white", "border": "2px solid black"});
            // Highlight the selected SELECT row
            jQ10(this).closest("tr").css({"background": "lightgreen", "border": "2px solid red"});
            testforSelect = "0";
            testforSelect = jQ10(this).closest("tr").find("td.idDirectory").text();
            console.log("Selected = " + testforSelect); // which family will have the new member applied to
            // console.log("DirectoryID = " + DirID);
            // console.log("LoginID = " + LoginID);
            // console.log("Email = " + Email);
            // console.log("Gender = " + Gender);
            // console.log("Firstname = " + FirstName);
            // console.log("Lastname = " + LastName);
	    });
        jQ10("#modal_approve_submit").off("click");
        jQ10("#modal_approve_submit").on("click", function () {
            // console.log("Approve Submit clicked");
            // console.log("Selected = " + testforSelect);
            // console.log("Directory ID = " + DirID);
            // console.log("LoginID = " + LoginID);
            // console.log("Gender = " + Gender);
            // console.log("Firstname = " + FirstName);
            // console.log("Lastname = " + LastName);
           //jQ10("#ModalApproveRegistrant").fadeOut('slow');
	    });

// When Approve clicked on popup, process the info and extinguish the Approve popup
            jQ10("#modal_approve_submit").click(function () {
                if (!testforSelect) { // no existing member selected - force user to select 'new family'
                    alert("You haven't selected a Family. If no family exists, click 'new family'");
                }
                else {
                    RegistrantUpdate(testforSelect, DirID, LoginID, Gender, FirstName, LastName, Email);
                    jQ10("#ModalApproveRegistrant").fadeOut('slow');
                    jQ10("#ModalApproveRegistrant").modal('hide');
                }
            });
// When Cancel clicked on popup, extinguish the Approve popup
            jQ10("#modal_cancel").click(function () {
                jQ10("#ModalApproveRegistrant").fadeOut('slow');
                location.reload();
            });
    });
});

</script>

<!-- **************************** Get Which Registrant Item's 'Reject' button was clicked ******************** -->
<!-- **************************** Get Which Registrant Item's 'Reject' button was clicked ******************** -->
<!-- **************************** Get Which Registrant Item's 'Reject' button was clicked ******************** -->
<script type="text/javascript">
var sname = "<?php echo $sessname ?>;";
var sid = "<?php echo $sessid ?>;";
var loggedin = "<?php echo $_SESSION['logged in'] ?>;";
var $rejectclickbuttonid = "NA";
var $rejectURL = "NA";
var testforSelect = "0";
var jQ11 = jQuery.noConflict();
jQ11(document).ready(function () {
    jQ11("#unregisteredapplicant tbody").off("click", '.applicant_reject');
    jQ11("#unregisteredapplicant tbody").on("click", '.applicant_reject', function () {
        // console.log("Session Name = " + sname);
        // console.log("Session ID = " + sid);
        // console.log("Logged in status = " + loggedin);
        var testforChild = "0";
        var LoginID = "0";
        var DirID = "0";
        var ChurchCode = "0";
        var UserName = "0";
        var Email = "0";
        var Gender = "0";
        var FirstName = "0";
        var LastName = "0";
        var testforChild = jQ11(this).closest('tr');
        if (testforChild.hasClass("child")) {
            // console.log("Child IS closest TR class");
            LoginID = testforChild.prev("tr").find(".loginid").text();
            // console.log("LoginID = " + LoginID);
            jQ11("#loginidReject").html("<h6> LoginID: " + LoginID + "</h6>");
            DirID = testforChild.prev("tr").find(".dirid").text();
            // console.log("DirID = " + DirID);
            jQ11("#diridApprove").html("<h6> DirectoryID: " + DirID + "</h6>");
            ChurchCode = testforChild.prev("tr").find(".churchcode").text();
            // console.log("ChurchCode = " + ChurchCode);
            jQ11("#churchcodeReject").html("<h6> Church Code: " + ChurchCode + "</h6>");
            UserName = testforChild.prev("tr").find(".username").text();
            // console.log("UserName = " + UserName);
            jQ11("#usernameReject").html("<h6> UserName: " + UserName + "</h6>");
            FirstName = testforChild.prev("tr").find(".firstname").text();
            // console.log("FirstName = " + FirstName);
            jQ11("#firstnameReject").html("<h6> First Name: " + FirstName + "</h6>");
            LastName = testforChild.prev("tr").find(".lastname").text();
            // console.log("LastName = " + LastName);
            jQ11("#lastnameReject").html("<h6> Last Name: " + LastName + "</h6>");
            jQ11("#fullnameReject").html("<h6> Name: " + FirstName + " " + LastName + "</h6>");
            Email = testforChild.prev("tr").find(".email").text();
            // console.log("Email = " + Email);
            jQ11("#emailReject").html("<h6> Email: " + Email + "</h6>");
            Gender = testforChild.prev("tr").find(".gender").text();
            // console.log("Gender = " + Gender);
            jQ11("#genderReject").html("<h6> Gender: " + Gender + "</h6>");

            // Display the Reject popup
            jQ11("#ModalRejectRegistrant").modal('show');
        }
        else {
            // console.log("Child IS NOT closest TR class");
            LoginID = jQ11(this).closest('tr').find(".loginid").text();
            // console.log("LoginID = " + LoginID);
            jQ11("#loginidReject").html("<h6> LoginID: " + LoginID + "</h6>");
            ChurchCode = jQ11(this).closest('tr').find(".churchcode").text();
            // console.log("ChurchCode = " + ChurchCode);
            jQ11("#churchcodeReject").html("<h6> Church Code: " + ChurchCode + "</h6>");
            UserName = jQ11(this).closest('tr').find(".username").text();
            // console.log("UserName = " + UserName);
            jQ11("#usernameReject").html("<h6> UserName: " + UserName + "</h6>");
            FirstName = jQ11(this).closest('tr').find(".firstname").text();
            // console.log("FirstName = " + FirstName);
            jQ11("#firstnameReject").html("<h6> FirstName: " + FirstName + "</h6>");
            LastName = jQ11(this).closest('tr').find(".lastname").text();
            // console.log("LastName = " + LastName);
            jQ11("#lastnameReject").html("<h6> Last Name: " + LastName + "</h6>");
            jQ11("#fullnameReject").html("<h6> Name: " + FirstName + " " + LastName + "</h6>");
            Email = jQ11(this).closest('tr').find(".email").text();
            // console.log("Email = " + Email);
            jQ11("#emailReject").html("<h6> Email: " + Email + "</h6>");
            Gender = jQ11(this).closest('tr').find(".gender").text();
            // console.log("Gender = " + Gender);
            jQ11("#genderReject").html("<h6> Gender: " + Gender + "</h6>");

            // Display the Reject popup
            jQ11("#ModalRejectRegistrant").modal('show');
        }
        $rejectclickbuttonid = LoginID;
        // console.log("$reject loginID clicked = " + $rejectclickbuttonid);
        $rejectURL = "tec_newregistrantreject.php?registerid=" + $rejectclickbuttonid;
        // console.log("rejectURL = " + $rejectURL);

        // **************************** Get Which Rejected Member 'Reject Yes' button was selected ********************
        // **************************** Get Which Rejected Member 'Reject Yes' button was selected ********************
        // **************************** Get Which Rejected Member 'Reject Yes' button was selected ********************
        jQ11("#modal_reject_submit").off("click");
        jQ11("#modal_reject_submit").on("click", function () {
            // console.log("Reject Yes clicked");
            // console.log("Selected = " + testforSelect);
            // console.log("Directory ID = " + DirID);
            // console.log("LoginID = " + LoginID);
            // console.log("Gender = " + Gender);
            // console.log("Firstname = " + FirstName);
            // console.log("Lastname = " + LastName);
            jQ11.ajax({
                url: '../services/ajax_reject_registrant.php',
                type: 'POST',
                dataType: 'text',
                data: { Selected: testforSelect, Directory: DirID, Login: LoginID, Gender: Gender, FirstName: FirstName, LastName: LastName }
            })
                .done(function (jqXHR, textStatus) {
                    //  Get the result
                    var result = "success";
                    var teststat = textStatus;
                    teststat2 = jqXHR.responseText;
                    // console.log("ajax reject response data = " + teststat);
                    // console.log("ajax reject response text = " + teststat2);
                    alert("Registrant has been disabled in the database.");
                    location.reload();
                    return result;
                })
                .fail(function (jqXHR, textStatus) {
                    //  Get the result
                    //result = (rtnData === undefined) ? null : rtnData.d;
                    var result = "fail";
                    var teststat = textStatus;
                    var teststat2 = jqXHR.responseText;
                    // console.log("ajax response data = " + teststat);
                    // console.log("ajax response text = " + teststat2);
                    reportError(teststat);
                    location.reload();
                    return result;
                });
        });
    });
});
    </script>



<!-- **************************** Get Which Approved Member radio button was selected ******************** -->
<!-- **************************** Get Which Approved Member radio button was selected ******************** -->
<!-- **************************** Get Which Approved Member radio button was selected ******************** -->
<!--<script type="text/javascript">
var jQ12 = jQuery.noConflict();
    jQ12(document).ready(function () {
    var testforSelect = "0";
    jQ12("#approvedmemberslist tbody").on("click", '.select', function () {
        var testforSelect = jQ12(this).closest("tr").find("td.idDirectory").text();
        console.log("Family ID = " + testforSelect);
        console.log("LoginID = " + LoginID);
	});
});
    </script>-->




<!-- **************************** Get Which Registrant Item's 'Send Email' button was clicked ******************** -->
<!-- **************************** Get Which Registrant Item's 'Send Email' button was clicked ******************** -->
<!-- **************************** Get Which Registrant Item's 'Send Email' button was clicked ******************** -->
<script type="text/javascript">
	var jQ30 = jQuery.noConflict();
	jQ30(document).ready(function() {
        // Send Email using client email application
        jQ30("#unregisteredapplicant tbody").off("click", '.applicant_email');
        jQ30("#unregisteredapplicant tbody").on("click", '.applicant_email', function () {
        // console.log("Session Name = " + sname);
        // console.log("Session ID = " + sid);
        // console.log("Logged in status = " + loggedin);
        var testforChild = "0";
        var LoginID = "0";
        var Email = "0";
        var testforChild = jQ30(this).closest('tr');
        if (testforChild.hasClass("child")) {
            // console.log("Child IS closest TR class");
            LoginID = testforChild.prev("tr").find(".loginid").text();
            // console.log("LoginID = " + LoginID);
            // jQ30("#loginidReject").html("<h6> LoginID: " + LoginID + "</h6>");
            Email = testforChild.prev("tr").find(".email").text();
            // console.log("Email = " + Email);
            // jQ30("#emailReject").html("<h6> Email: " + Email + "</h6>");
            // Display the Reject popup
            // jQ30("#ModalRejectRegistrant").modal('show');
            window.location.href = "mailto:" + Email + "?subject=About your registration request to TEC...";
        }
        else {
            // console.log("Child IS NOT closest TR class");
            LoginID = jQ30(this).closest('tr').find(".loginid").text();
            // console.log("LoginID = " + LoginID);
            jQ30("#loginidReject").html("<h6> LoginID: " + LoginID + "</h6>");
            Email = jQ30(this).closest('tr').find(".email").text();
            // console.log("Email = " + Email);
            jQ30("#emailReject").html("<h6> Email: " + Email + "</h6>");
            window.location.href = "mailto:" + Email + "?subject=About your registration request to TEC...";
        }


    		// console.log("Send Email button clicked");
    		var sendaddress = 'tec_get_registrant_email_address.php';
    		jQ30.getJSON(sendaddress, {registrantID: $clickbuttonid
    		}, function (data) {
    			// console.log(data);
    			jQ30.each(data.registrantdata, function (i, rep) {
    			// console.log("Prayer ID: " + rep.prayerid);
    			// console.log("Prayer owner email: " + rep.prayeremail);
    			window.location.href = "mailto:" + rep.registrantemail + "?subject=About your registration request to TEC...";
    			});
    		});
        });
    });
</script>


</head>

<body>
    <!--Navbar-->
    <?php
    $activeparam = '9'; // sets nav element highlight
    require_once('tec_nav.php');
    require_once('includes/tec_footer.php');
    ?>
    <!-- Intro Section -->
    <div class="container-fluid profile_bg bottom-buffer">
    <!--<div class="container-fluid bottom-buffer" id="backsplash">-->
        <div class="row pt-2">
            <div class="col-sm-12">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Using the Registration Admin page
                </button>
                <!--<button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#testalert" aria-expanded="false" aria-controls="testalert">
                Test Alert
            </button>-->
            </div><!-- col sm-12 -->
        </div><!-- row -->
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">
                            Click on the
                            <span class="btn btn-primary">Send Email</span> button to send an email to the registration request originator
                        </h4>
                        <ul class="card-text">
                            <li>You can send an email to the registration request originator directly from your email client when it pops up</li>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-6 -->
                <div class="col-sm-6">
                </div><!-- col-sm-6 -->
            </div><!-- row -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Approving and Rejecting Registration Requests</h4>
                        <ul class="card-text">
                            <li>
                                Click on
                                <span class="btn btn-success">Approve</span> to notify the registrant that he/she has been approved. Registrant will immediately be able to access the site.
                            </li>
                            <li>
                                Click on
                                <span class="btn btn-danger">Reject</span> to reject the registration request. Registrant's request will remain in our database, but he/she will be unable to access the site.
                            </li>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-6 -->
            </div><!-- row -->
        </div><!-- collapse -->


        <div class="row">
            <div class="col-sm-12">
                <div class="card card-image"
                    style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                    <!-- Content -->
                    <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                        <div class="w-100">
                            <h3 class="card-title pt-2"><strong>REGISTRATION ADMINISTRATION</strong></h3>
                            <p>Approve or Reject new registration requests.</p>
                        </div>
                    </div>
                </div><!-- Card -->
            </div><!-- Col-md-12 -->
        </div><!-- Row -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card bg-light border-primary px-2 my-2 w-100">
                    <div class="card-body">
                        <div class="table-responsive-xs">
                            <table id="unregisteredapplicant" class="table table-sm table-striped dt-responsive" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <thead class="table-dark">
                                    <tr>
                                    <th class="dtr-regcolumn"></th>
                                        <th>Code</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Username</th>
                                        <th>Email Address</th>
                                        <th>Request Date</th>
                                        <th>Approve</th>
                                        <th>Reject</th>
                                        <th>Email</th>
                                        <th>Login ID</th>
                                        <th>Directory ID</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tfoot class="table-dark">
                                    <tr>
                                    <th class="dtr-regcolumn"></th>
                                        <th>Code</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Username</th>
                                        <th>Email Address</th>
                                        <th>Request Date</th>
                                        <th>Approve</th>
                                        <th>Reject</th>
                                        <th>Email</th>
                                        <th>Login ID</th>
                                        <th>Directory ID</th>
                                        <th>Count</th>
                                    </tr>
                                </tfoot>
                            </table>
	                    </div>
                    </div>
                </div>
            </div>
        </div> <!-- Row -->


    <!--***************************** Approve Registrant MODAL ***********************************-->
    <!--***************************** Approve Registrant MODAL ***********************************-->
    <!--***************************** Approve Registrant MODAL ***********************************-->

    <div class="modal fade" id="ModalApproveRegistrant" tabindex="-1" role="dialog" aria-labelledby="ModalApproveReg" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalApproveReg">
                        Approve Registrant
                        <br />
                        Click
                        <strong>Approve Yes or Cancel</strong> when done.
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- modal-header -->
                <div class="modal-body">
                    <h6>
                        <span id="loginApprove"></span>
                        <span id="churchcodeApprove"></span>
                        <span id="usernameApprove"></span>
                        <!--<span id="firstnameApprove"></span>
                        <span id="lastnameApprove"></span>-->
                        <span id="fullnameApprove"></span>
                        <span id="genderApprove"></span>
                    </h6>
                    <hr />
                    <h4>
                        Connect Registrant to Family
                    </h4>
                    <h6>
                        If this registrant is part of an existing family, select from list below to correlate
                    </h6>
                    <table id="approvedmemberslist" class="table table-sm table-striped dt-responsive" cellpadding="0" cellspacing="0" border="0" width="100%">
                        <!--	<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">-->
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Last Name</th>
                                <th>His Name</th>
                                <th>Her Name</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Last Name</th>
                                <th>His Name</th>
                                <th>Her Name</th>
                            </tr>
                        </tfoot>
                    </table>
                    <form name='approvereg' method='post' action="javascript:void(0);">
                        <div class="modal-footer">
                            <input type="submit" name="approveregsubmit" id="modal_approve_submit" class="btn btn-primary" value="Approve Yes" />
                            <button type="button" id="modal_cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div><!-- modal-footer -->
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal-fade -->

    <!--***************************** Reject Registrant MODAL ***********************************-->
    <!--***************************** Reject Registrant MODAL ***********************************-->
    <!--***************************** Reject Registrant MODAL ***********************************-->

    <div class="modal fade" id="ModalRejectRegistrant" tabindex="-1" role="dialog" aria-labelledby="ModalRejectReg" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRejectReg">
                        Reject Registrant
                        <br />Click
                        <strong>Reject Yes or Cancel</strong> when done.
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- modal-header -->
                <div class="modal-body">
                    <h6>
                        <span id="loginReject"></span>
                        <span id="churchcodeReject"></span>
                        <span id="usernameReject"></span>
                        <!--<span id="firstnameReject"></span>
                        <span id="lastnameReject"></span>-->
                        <span id="fullnameReject"></span>
                        <span id="genderReject"></span>
                    </h6>
                    <form name='rejectreg' method='post' action=''>
                        <div class="modal-footer">
                            <input type="submit" name="rejectregsubmit" id="modal_reject_submit" class="btn btn-primary" value="Reject Yes" />
                            <button type="button" id="modal_cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div><!-- modal-footer -->
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal-fade -->

    <!-- SCRIPTS -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <!-- Datatables JavaScript plugins - Bootstrap-specific -->
    <!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/r-2.2.6/datatables.min.js"></script>
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
    <!-- Call Image Verify jQuery script -->
    <script src="js/image_verify.js"></script>


</body>
</html>