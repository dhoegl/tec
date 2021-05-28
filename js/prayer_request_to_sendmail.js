// Perform AJAX sendmail submittal for new Prayer Request
//JQuery
//Called from tec_newprayer.php
// Last Updated 20210525

function prayerrequestnew(prayerID, prayeremailfrom, prayerowner, prayername, LoginID, themename, themedomain, themetitle, themecolor, themeforecolor) {
    console.log("Made it to prayer_request_to_sendmail script ");
    // console.log("email address = " + email_addr);
    // console.log("first name = " + first_submit);
    // console.log("last name = " + last_submit);
    // console.log("user name = " + user_submit);
    // console.log("login ID = " + login_ID);
    // console.log("Theme Name = " + themename);
    // console.log("Theme Domain = " + themedomain);
    // console.log("Theme Title = " + themetitle);
    // console.log("Theme Color = " + themecolor);
    // console.log("Theme ForeColor = " + themeforecolor);

    // console.log("Made it to Register Request, just prior to ajax call to sendmail");

    //Updated
    var jQpwr = jQuery.noConflict();
    var request = jQpwr.ajax({
        url: '../services/tec_sendmail_new.php',
        type: 'POST',
        // dataType: 'json',
        data: { mailtype: 'prayer_request_church', prayer_ID: prayerID, prayer_email_address: prayeremailfrom, requestor_ID: prayerowner, full_name: prayername, login_id: LoginID, theme_name: themename, theme_domain: themedomain, theme_title: themetitle, theme_color: themecolor, theme_forecolor: themeforecolor}
    });
    request.done(function (data, textStatus, jqXHR) {
        //  Get the result
        var result = "success";
        var testdata = data;
        var teststat = textStatus;
        teststat2 = jqXHR.responseText;
        console.log("ajax response data for prayer request = " + teststat);
        console.log("ajax response text for prayer request = " + teststat2);
        alert("Your request has been successfully submitted.\nPlease allow 24-48 hours for our administrators to approve your request.");
        // $welcomepage = window.location.hostname;
		window.location.replace("../tec_myprayer.php");
        // window.location = $welcomepage;
        // window.location.reload();
        // window.location = "//tec.ourfamilyconnections.org/welcome.php";
        // location.reload();
        return result;
    });
    request.fail(function (jqXHR, textStatus) {
            //  Get the result
            //result = (rtnData === undefined) ? null : rtnData.d;
            var result = "fail";
            var teststat = textStatus;
            var teststat2 = jqXHR.responseText;
            console.log("ajax fail response data for prayer request = " + teststat);
            console.log("ajax fail response text for prayer request = " + teststat2);
            alert("Prayer Request Failure: " + teststat + " at " + teststat2);
            // reportError(teststat);
            //alert("A problem has occurred with your approval - ofc_approve_registrant. Please copy this error and contact your OurFamilyConnections administrator for details.");
            window.location.replace("../tec_myprayer.php");
            // window.location.reload();
            // location.reload();
            return result;
        });
};
function prayerrequesteldernew(prayerID, prayeremailfrom, prayerowner, prayername, LoginID, themename, themedomain, themetitle, themecolor, themeforecolor, prayertitle, prayertext) {
    console.log("Made it to prayer_request_to_sendmail script ");
    // console.log("email address = " + email_addr);
    // console.log("first name = " + first_submit);
    // console.log("last name = " + last_submit);
    // console.log("user name = " + user_submit);
    // console.log("login ID = " + login_ID);
    // console.log("Theme Name = " + themename);
    // console.log("Theme Domain = " + themedomain);
    // console.log("Theme Title = " + themetitle);
    // console.log("Theme Color = " + themecolor);
    // console.log("Theme ForeColor = " + themeforecolor);

    // console.log("Made it to Register Request, just prior to ajax call to sendmail");

    //Updated
    var jQpwr = jQuery.noConflict();
    var request = jQpwr.ajax({
        url: '../services/tec_sendmail_new.php',
        type: 'POST',
        // dataType: 'json',
        data: { mailtype: 'prayer_request_elder', prayer_ID: prayerID, prayer_email_address: prayeremailfrom, requestor_ID: prayerowner, full_name: prayername, login_id: LoginID, theme_name: themename, theme_domain: themedomain, theme_title: themetitle, theme_color: themecolor, theme_forecolor: themeforecolor, prayer_title: prayertitle, prayer_text: prayertext}
    });
    request.done(function (data, textStatus, jqXHR) {
        //  Get the result
        var result = "success";
        var testdata = data;
        var teststat = textStatus;
        teststat2 = jqXHR.responseText;
        console.log("ajax response data for prayer request = " + teststat);
        console.log("ajax response text for prayer request = " + teststat2);
        alert("Your request has been successfully submitted to our elders.\nPlease allow 24-48 hours for an elder to contact you.");
        // $welcomepage = window.location.hostname;
		window.location.replace("../tec_myprayer.php");
        // window.location = $welcomepage;
        // window.location = "//tec.ourfamilyconnections.org/welcome.php";
        // window.location.reload();
        // location.reload();
        return result;
    });
    request.fail(function (jqXHR, textStatus) {
            //  Get the result
            //result = (rtnData === undefined) ? null : rtnData.d;
            var result = "fail";
            var teststat = textStatus;
            var teststat2 = jqXHR.responseText;
            console.log("ajax fail response data for prayer request = " + teststat);
            console.log("ajax fail response text for prayer request = " + teststat2);
            alert("Prayer Request Failure: " + teststat + " at " + teststat2);
            // reportError(teststat);
            //alert("A problem has occurred with your approval - ofc_approve_registrant. Please copy this error and contact your OurFamilyConnections administrator for details.");
            window.location.replace("../tec_myprayer.php");
            // window.location.reload();
            // location.reload();
            return result;
        });
}