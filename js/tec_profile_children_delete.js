// ***************************************************************
// Process profile update - Remove CHILDREN (name, gender, birthdate, etc.) INFO: Called from tec_profile.php
// Last Updated: 12/30/2020: Working on pre-Delete prompt
function remove_child($number, $child_name, $profile_id) {
    console.log("Child Number = " + $number);
    console.log("Child Name = " + $child_name);
    console.log("Profile ID = " + $profile_id);
    var jQ07 = jQuery.noConflict();
        jQ07.ajax({
            url: '../services/tec_profile_children_delete.php',
            type: 'POST',
            dataType: 'json',
            data: { child_number : $number, child_name : $child_name, profile_id: $profile_id}
        })
        // The ajax call succeeded. 
        .done(function (data) {
            console.log("Child Delete JS script done");
    });
}