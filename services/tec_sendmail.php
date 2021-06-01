<?php
// Send Mail scripts
// 'approved_member' from ajax_update_new_registrant.php
// Updated 20210407
// Getting error when this script is 'include'd in ajax_update_new_registrant.php
// Error resolved. Include statement at ajax_update_new_registrant is sufficient - removed the include from this file.
session_start();
if(!$_SESSION['logged in']) {
	header("location:../tec_welcome.php");
	exit();
}
// This function will send email to alert users and admins
function sendmail($mailtype, $param1, $param2, $param3, $param4, $param5, $param6) { // params based on each call to sendmail
    //$mailtype = type of email to send
    //$param1 = 'Selected' - which family the approved member is being added to
    //$param2 = 'Directory' - Registration Admin's idDirectory entry
    //$param3 = 'Login' - approved member's user login id
    //$param4 = 'FirstName' - approved member's first name
    //$param5 = 'LastName' - approved member's last name
    //$param6 = 'Email' - approved member's email address

    Switch ($mailtype){
        case 'approved_member': // From ajax_update_new_registrant.php
            $regmaillink = "https://tec.ourfamilyconnections.org";
            $regmailto = $param6;
            $regmailsubject = "Approved access to TEC Family Connections"."\n..";
            $regmailmessage = "<html><body>";
            $regmailmessage .= "<p style='background-color: #ff6933; font-size: 30px; font-weight: bold; color: white; padding: 25px; width=100%;'> Trinity Evangel Church</p>";
            $regmailmessage .= "<p>Hello <strong>" . $param4 . " " . $param5 . "</strong></p>";
            $regmailmessage .= "<p>You have been approved to access Trinity Evangel Church's directory site!</p>";
            $regmailmessage .= "<p>Click on the link below to login<br /></p>";
            $regmailmessage .= "<p><a href='" . $regmaillink . "'>" . $regmaillink . "</a></p>";
            $regmailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
            $regmailmessage .= "</body></html>";
            $regmailfrom = "noreply@ourfamilyconnections.org";
            $regmailheaders = "From:" . $regmailfrom . "\r\n";
            $regmailheaders .= "Reply-To:" . $regmailfrom . "\r\n";
            $regmailheaders .= "MIME-Version: 1.0\r\n";
            $regmailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $emailworks = mail($regmailto,$regmailsubject,$regmailmessage,$regmailheaders);
            if($emailworks){
                    eventLogUpdate('mail', "User: " .  $param4 . " " . $param5, "Registrant Approve email", "LoginID = ". $param3);
                    }
                else {
                    eventLogUpdate('mail', "User: " .  $param4 . " " . $param5, "Registrant Approve email", "FAILED");
                }
    
            break;
            case 'prayer_request_user': // from prayer_request_to_sendmail.js
        default:
    }
};


?>