// Perform AJAX sendmail submittal for new Prayer Request
//JQuery
//Called from tec_newprayer.php
// Last Updated 20210525

function prayerrequestnew(email_addr, first_submit, last_submit, user_submit, login_ID, themename, themedomain, themetitle, themecolor, themeforecolor) {
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
        url: '../services/tec_sendmail.php',
        type: 'POST',
        // dataType: 'json',
        data: { mailtype: 'prayer_request_user', email_address: email_addr, first_name: first_submit, last_name: last_submit, user_name: user_submit, login_id: login_ID, theme_name: themename, theme_domain: themedomain, theme_title: themetitle, theme_color: themecolor, theme_forecolor: themeforecolor}
    });
    request.done(function (data, textStatus, jqXHR) {
        //  Get the result
        var result = "success";
        var testdata = data;
        var teststat = textStatus;
        teststat2 = jqXHR.responseText;
        console.log("ajax response data for registration request = " + teststat);
        console.log("ajax response text for registration request = " + teststat2);
        alert("Your request has been successfully submitted.\nPlease allow 24-48 hours for our administrators to approve your request.");
        $welcomepage = window.location.hostname;
        window.locaation = $welcomepage;
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
            console.log("ajax fail response data for registration request = " + teststat);
            console.log("ajax fail response text for registration request = " + teststat2);
            alert("Registration Request Failure: " + teststat + " at " + teststat2);
            // reportError(teststat);
            //alert("A problem has occurred with your approval - ofc_approve_registrant. Please copy this error and contact your OurFamilyConnections administrator for details.");
            // location.reload();
            return result;
        });
}
