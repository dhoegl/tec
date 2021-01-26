// JavaScript source code
// If back button used to return to this form, reset all form fields
$(window).bind("pageshow", function () {
    $("#register")[0].reset();
});
