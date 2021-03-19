<?php
    // $regmailsubject = "TEST - Registration Request to TEC Family Connections"."\n..";
    // $regmailmessage = "<html><body>";
    // $regmailmessage .= "<p style='background-color: #ff6933; font-size: 30px; font-weight: bold; color: white; padding: 25px; width=100%;'> Trinity Evangel Church</p>";
    // $regmailmessage .= "<p>Hello! </p>";
    // $regmailmessage .= "<p><strong>" . "DanTEST" . " " . "HoeglundTEST" . "</strong>";
    // $regmailmessage .= " has requested to be added to Trinity Evangel Church's Directory site.</p>";
    // $regmailmessage .= "<p>Login to our site using your admin credentials, select the <strong>Registration Admin</strong> menu item, and accept or reject this request " . "<a href='" . $regmaillink . "'>" . $regmaillink . "</a></p>";
    // $regmailmessage .= "</body></html>";
    // $regmailfrom = "newfamilyrequest@ourfamilyconnections.org";
    // $regmailheaders = "From:" . $regmailfrom . "\r\n";
    // $regmailheaders .= "MIME-Version: 1.0\r\n";
    // $regmailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    // mail($regmailto,$regmailsubject,$regmailmessage,$regmailheaders);
?>
<?PHP
$sender = 'newfamilyrequest@ourfamilyconnections.org';
// $recipient = 'dhoegl@microsoft.com';
// $recipient = 'firebird@hoeglund.com';
$recipient = 'danruthann@gmail.com';

$subject = "php mail test";
$message = "php test message";
$headers = "From:" . $sender . "\r\n";
// $headers = "From:" . $sender;
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted to: " . $recipient;
}
else
{
    echo "Error: Message not accepted to: " . $recipient;
}
?>