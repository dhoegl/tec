// New Registrant Accept Listener
// Detect new Registrant Accept click
// From tec_newregistrantaccept.php
// Last Updated: 2020/12/09
// Used to re-direct admin user back to calling page
// But is disabled at the moment

var $approveclickbuttonid = "NA";
var $approveURL = "NA";
var jQ150 = jQuery.noConflict();
jQ150(document).ready(function () {
    // #acceptRegistrant is the Form ID where Approve button resides
    // #approveRegistrant is the Button ID for the Approve button
    jQ150("#acceptRegistrant").click("#approveRegistrant", function () {
        $approveclickbuttonid = registerid;
        console.log("Approve Registrant button clicked");
        console.log("$approve registerid clicked = " + $approveclickbuttonid);
        $approveURL = "tec_newregistrantaccept.php?registerid=" + $approveclickbuttonid;
        //		$approveURL = "bing.com";
        console.log("approveURL = " + $approveURL);
        //		window.open($approveURL);
        //		window.location.href = $approveURL;

    });
});

