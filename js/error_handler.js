// JavaScript source code

jQuery(document).ready(function ($) {
    function reportError(data) {

        var $result = data.responseText,
            $error = $result.error,
            $script = $result.script,
            $line = $result.line;

        console.log("A problem has occurred with your approval - ofc_approve_registrant. Please copy this error and contact your OurFamilyConnections administrator for details.");
        console.log("Error = " + $error);
        console.log("Script = " + $script);
        console.log("Line = " + $line);
    }
    window.reportError = reportError
});
