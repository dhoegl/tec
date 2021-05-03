/* global all_req_fields */
// Last updated 20210407 - Updated to fix ajax $ to noConflict.

//Check that all Registration fields have been correctly filled in

var subJQ = jQuery.noConflict();
subJQ(document).ready(function()
{
    var required_fields = 'N';
    var all_req_fields = 'N';
    var churchcodeset = 'N';
    var churchcodelen = 'N';
    var usernameset = 'N';
    var passwordset = 'N';
    var repeatpasswordset = 'N';
    var firstnameset = 'N';
    var lastnameset = 'N';
    var genderset = 'N';
    var emailset = 'N';
    var repeatemailset = 'N';
    subJQ('#register_submit').prop('disabled', true); 

// <editor-fold desc="Check whether Church Code received from church admin">
    subJQ('.churchcodecheck').click(function(){
        if(subJQ('input[name=confirmcode]').prop('checked') == true){
            console.log('YES Clicked');
            console.log('all_req_fields = ' + all_req_fields);
            subJQ('#churchcodelabel').show(); 
            subJQ('#churchcode').show(); 
            churchcodeset = 'Y';
            console.log("churchcodecheck = YES");
            console.log("churchcodeset = " + churchcodeset);
            console.log("churchcodelen = " + churchcodelen);
        }
        else{
            console.log('NO Clicked');
            console.log('all_req_fields = ' + all_req_fields);
            subJQ('#churchcodelabel').hide(); 
            subJQ('#churchcode').hide(); 
            churchcodeset = 'N';
            console.log("churchcodecheck = NO");
            console.log("churchcodeset = " + churchcodeset);
            console.log("churchcodelen = " + churchcodelen);
        }
        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('all_req_fields = ' + all_req_fields);
        }
    });
    subJQ('#churchcodelabel').hide();
    subJQ('#churchcode').hide(); 

// </editor-fold>

// <editor-fold desc="Check for church registration code - from ofc_register_confirmcode.js">
//    subJQ('.churchcodecheck').click(function(){
//        console.log("Confirm Code Selection clicked");
//    var confval = subJQ('input[name=confirmcode]').prop('checked'); 
//    if(confval)
//    { 
//        console.log('YES Clicked');
//        subJQ('#churchcodelabel').show(); 
//        subJQ('#churchcode').show(); 
//    }
//    else
//    {
//        console.log('NO Clicked');
//        subJQ('#churchcodelabel').hide(); 
//        subJQ('#churchcode').hide(); 
//    };
//    });
//    subJQ('#churchcodelabel').show(); 
//    subJQ('#churchcode').show(); 

// </editor-fold>

// <editor-fold desc="Validate Church Code - from ofc_confirmcode_check.js">

    subJQ('#churchcode').keyup(function(){
        var churchcode = subJQ('#churchcode').val();
        var confirm_code_len = subJQ('#confirm_code_len').html();
        subJQ('#confirm_code_len').html(checkCode(subJQ('#churchcode').val()));
        if(subJQ('#confirm_code_len').html() == 'Code Available') {
            churchcodelen = 'Y';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            churchcodelen = 'N';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log('all_req_fields = ' + all_req_fields);
        }
        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('all_req_fields = ' + all_req_fields);
        }
        function checkCode(churchcode){
        if (churchcode.length != 5) { 
            subJQ('#confirm_code_len').removeClass(); 
            subJQ('#confirm_code_len').addClass('short'); 
            subJQ('#confirm_code_len').html = 'Incorrect Code';
            return 'Incorrect Code'; 
        }
        else {
            subJQ('#confirm_code_len').removeClass(); 
            subJQ('#confirm_code_len').addClass('available'); 
            subJQ('#confirm_code_len').html = 'Code Available';
            return 'Code Available'; 
            }
        };
    });

// </editor-fold>

// <editor-fold desc="Validate User Name is available - from tec_username_check.js">

    subJQ('#username').focusout(function(){
        var unique_user = subJQ('#unique_user').html();
        subJQ('#unique_user').html(checkAvail(subJQ('#username').val()));
        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('all_req_fields = ' + all_req_fields);
        }
        function checkAvail(username){
        if (username.length < 5) { 
            subJQ('#unique_user').removeClass(); 
            subJQ('#unique_user').addClass('short'); 
            subJQ('#username').val("");
            usernameset = 'S';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log('all_req_fields = ' + all_req_fields);
            return 'Username must contain at least 5 characters'; 
        }
        else {
    //length is ok, lets continue.  
    //if username already exists, alert user and disallow from continuing
    //check for existing username
            var username_check = subJQ.ajax({
                    url: 'services/tec_username_check.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { username: username }
            });
            username_check.done(function(data){
		if (data.username_status == 'NAME_USED'){ 
			console.log('username_check = ' + data.username_status);
			subJQ('#unique_user').removeClass(); 
			subJQ('#unique_user').addClass('used');
                        subJQ('#unique_user').html('Username taken');
                        subJQ('#username').val("");
                        usernameset = 'N';
                        console.log('churchcodeset = ' + churchcodeset);
                        console.log('confirm_code_len = ' + confirm_code_len);
                        console.log("churchcodelen = " + churchcodelen);
                        console.log("usernameset = " + usernameset);
                        console.log('all_req_fields = ' + all_req_fields);
			return 'Username taken'; 
		}
		else {
			console.log('username_check = ' + data.username_status);
			subJQ('#unique_user').removeClass(); 
			subJQ('#unique_user').addClass('available'); 
                        subJQ('#unique_user').html('Username available');
                        usernameset = 'Y';
                        console.log('churchcodeset = ' + churchcodeset);
                        console.log('confirm_code_len = ' + confirm_code_len);
                        console.log("churchcodelen = " + churchcodelen);
                        console.log("usernameset = " + usernameset);
                        console.log('all_req_fields = ' + all_req_fields);
			return 'Username available'; 
		}
            });
        }
    };

});
// </editor-fold>

// <editor-fold desc="Validate Password Strength - from ofc_password_check.js">
//Check for correct password strength
//Password strength criteria is as follows
//-- Length must be greater than 6 characters
//-- Characters shall include at least the following:
//---- Use lower case and upper case characters
//---- Use numbers and special characters
//  If password is less than 6 characters, don’t accept.
//  If the length of password is more than 6 characters, increase the strength value by +1.
//  If the password contains lower and uppercase characters, increase the strength value by +1.
//  If the password contains characters and numbers, increase the strength value by +1.
//  If the password contains one special character, increase the strength value by +1.
//  If the password contains two special characters, increase the strength value by +1.
// ---- Allow Passwords whose Strength is either "Good" or "Strong" (Strenght = 2 or greater)

    subJQ('#password').keyup(function(e){
        var code = e.keyCode || e.which; //Check for Tab key - don't call checkStrength until actual key is pressed
        if(code == '9'){
            console.log('Tab Key Pressed');
        }
        else {
            subJQ('#repeatpassword').val(""); 
            subJQ('#password_match').removeClass(); 
            subJQ('#password_match').addClass('nomatch'); 
            subJQ('#password_match').html('No Match'); 
            repeatpasswordset = 'N';
            subJQ('#register_result').html(checkStrength(subJQ('#password').val()));
        }

        if(subJQ('#register_result').html() == 'Good' || subJQ('#register_result').html() == 'Strong') {
            passwordset = 'Y';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else
        {
            passwordset = 'N';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log('all_req_fields = ' + all_req_fields);
        }


    function checkStrength(password){
    //initial strength 
    var strength = 0; 
    //if the password length is less than 6, return message. 
    if (password.length < 6) { 
        subJQ('#register_result').removeClass(); 
        subJQ('#register_result').addClass('short'); 
//        subJQ('#register_submit').prop('disabled', true);
        return 'Too short'; 
    } 
    //length is ok, lets continue. 
        //if length is 8 characters or more, increase strength value 
        if (password.length > 7) strength += 1; 
    
        //if password contains both lower and uppercase characters, increase strength value 
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1; 
    
        //if it has numbers and characters, increase strength value 
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1; 
        
        //if it has one special character, increase strength value 
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1; 
        
        //if it has two special characters, increase strength value 
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1; 
         
        //now we have calculated strength value, we can return messages 
        //if value is less than 2 
        if (strength < 2 ) {
            subJQ('#register_result').removeClass(); 
            subJQ('#register_result').addClass('weak');
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log('all_req_fields = ' + all_req_fields);
            return 'Weak'; 
        } 
        else if (strength == 2 ) { 
            subJQ('#register_result').removeClass(); 
            subJQ('#register_result').addClass('good'); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log('all_req_fields = ' + all_req_fields);
            return 'Good'; 
        } 
        else { 
            subJQ('#register_result').removeClass(); 
            subJQ('#register_result').addClass('strong'); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log('all_req_fields = ' + all_req_fields);
            return 'Strong'; 
        }; 
    };
});
// </editor-fold>
    
// <editor-fold desc="Validate Repeat Password Match - from ofc_password_match.js">
    
    subJQ('#repeatpassword').keyup(function(e){
        var code = e.keyCode || e.which; //Check for Tab key - don't call checkStrength until actual key is pressed
        if(code == '9'){
            console.log('Tab Key Pressed');
        }
        else {
            subJQ('#password_match').html(checkMatch(subJQ('#repeatpassword').val(), subJQ('#password').val()));
        }

        function checkMatch(repeatpassword, password){
            //initial check 
            var check = 0; 
            //if the password check does not match, return message. 
            if (repeatpassword == password) { 
                subJQ('#password_match').removeClass(); 
                subJQ('#password_match').addClass('match'); 
                repeatpasswordset = 'Y';
                console.log('churchcodeset = ' + churchcodeset);
                console.log('confirm_code_len = ' + confirm_code_len);
                console.log("churchcodelen = " + churchcodelen);
                console.log("usernameset = " + usernameset);
                console.log("passwordset = " + passwordset);
                console.log("repeatpasswordset = " + repeatpasswordset);
                console.log('all_req_fields = ' + all_req_fields);
                return 'Match'; 
            } 
            else { 
                subJQ('#password_match').removeClass(); 
                subJQ('#password_match').addClass('nomatch'); 
                repeatpasswordset = 'N';
                console.log('churchcodeset = ' + churchcodeset);
                console.log('confirm_code_len = ' + confirm_code_len);
                console.log("churchcodelen = " + churchcodelen);
                console.log("usernameset = " + usernameset);
                console.log("passwordset = " + passwordset);
                console.log("repeatpasswordset = " + repeatpasswordset);
                console.log('all_req_fields = ' + all_req_fields);
            return 'No Match'; 
            }; 
        };

        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log('all_req_fields = ' + all_req_fields);
        }
    });

// </editor-fold>

// <editor-fold desc="Validate First Name entry (len>0)">

    subJQ('#firstname').keyup(function(){
        var fnhtml = subJQ('#firstname').val();
        var fnlen = fnhtml.length;
        if(fnlen > 0){
            firstnameset = 'Y';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            firstnameset = 'N';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log('all_req_fields = ' + all_req_fields);
        }
    });
// </editor-fold>

// <editor-fold desc="Validate Last Name entry (len>0)">
    subJQ('#lastname').keyup(function(){
        var lnhtml = subJQ('#lastname').val();
        var lnlen = lnhtml.length;
        if(lnlen > 0){
            lastnameset = 'Y';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            lastnameset = 'N';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log('all_req_fields = ' + all_req_fields);
        }
    });
// </editor-fold>

    // <editor-fold desc="Check for Gender">
    subJQ('.gendercheckmale').click(function () {
//            alert("We're Here Male");
            console.log('Male Clicked');
            genderset = 'Male';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("gendercheck = Male");
            console.log("genderset = " + genderset);
            if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
                subJQ('#register_submit').removeClass('disabled');
                subJQ('#register_submit').prop('disabled', false); 
                all_req_fields = 'Y';
                console.log('churchcodeset = ' + churchcodeset);
                console.log('confirm_code_len = ' + confirm_code_len);
                console.log("churchcodelen = " + churchcodelen);
                console.log("usernameset = " + usernameset);
                console.log("passwordset = " + passwordset);
                console.log("repeatpasswordset = " + repeatpasswordset);
                console.log("firstnameset = " + firstnameset);
                console.log("lastnameset = " + lastnameset);
                console.log("gendercheck = Male");
                console.log("genderset = " + genderset);
                console.log('all_req_fields = ' + all_req_fields);
            }
            else {
                all_req_fields = 'N';
                subJQ('#register_submit').addClass('disabled');
                subJQ('#register_submit').prop('disabled', true); 
                console.log('churchcodeset = ' + churchcodeset);
                console.log('confirm_code_len = ' + confirm_code_len);
                console.log("churchcodelen = " + churchcodelen);
                console.log("usernameset = " + usernameset);
                console.log("passwordset = " + passwordset);
                console.log("repeatpasswordset = " + repeatpasswordset);
                console.log("firstnameset = " + firstnameset);
                console.log("lastnameset = " + lastnameset);
                console.log("gendercheck = Male");
                console.log("genderset = " + genderset);
                console.log('all_req_fields = ' + all_req_fields);
            }
        //}
    });
    subJQ('.gendercheckfemale').click(function () {
//        alert("We're Here Female");
        console.log('Female Clicked');
        genderset = 'Female';
        console.log('churchcodeset = ' + churchcodeset);
        console.log('confirm_code_len = ' + confirm_code_len);
        console.log("churchcodelen = " + churchcodelen);
        console.log("usernameset = " + usernameset);
        console.log("passwordset = " + passwordset);
        console.log("repeatpasswordset = " + repeatpasswordset);
        console.log("firstnameset = " + firstnameset);
        console.log("lastnameset = " + lastnameset);
        console.log("gendercheck = Female");
        console.log("genderset = " + genderset);
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            subJQ('#register_submit').removeClass('disabled');
            subJQ('#register_submit').prop('disabled', false); 
            all_req_fields = 'Y';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("genderset = " + genderset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled');
            subJQ('#register_submit').prop('disabled', true); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("genderset = " + genderset);
            console.log('all_req_fields = ' + all_req_fields);
        }
    });


// </editor-fold>
// <editor-fold desc="Validate Email Entry - from ofc_email_check.js">

    subJQ('#emailaddress').focusout(function(e){
        var code = e.keyCode || e.which; //Check for Tab key - don't call checkStrength until actual key is pressed
        if(code == '9'){
            console.log('Tab Key Pressed');
        }
        else {
            subJQ('#repeatemailaddress').val(""); 
            subJQ('#email_match').removeClass(); 
            subJQ('#email_match').addClass('nomatch'); 
            subJQ('#email_match').html('No Match'); 
            repeatemailset = 'N';
            subJQ('#email_choose').removeClass(); 
            subJQ('#email_choose').addClass('short'); 
            subJQ('#email_choose').html(checkEmailValidity(subJQ('#emailaddress').val()));
        }
        if(subJQ('#email_choose').html() == 'Email Accepted') {
            emailset = 'Y';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("genderset = " + genderset);
            console.log("emailset = " + emailset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else
        {
            emailset = 'N';
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("genderset = " + genderset);
            console.log("emailset = " + emailset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("genderset = " + genderset);
            console.log("emailset = " + emailset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("genderset = " + genderset);
            console.log("emailset = " + emailset);
            console.log('all_req_fields = ' + all_req_fields);
        }
    
        function checkEmailValidity(emailaddress){
        //email format validation
            var emailmatch = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
            //if email is correct, return Email Accepted message. 
            if(emailaddress.match(emailmatch)){
                subJQ('#email_choose').removeClass(); 
                subJQ('#email_choose').addClass('available'); 
                subJQ('#email_choose').html == 'Email Accepted'; 
                console.log('churchcodeset = ' + churchcodeset);
                console.log('confirm_code_len = ' + confirm_code_len);
                console.log("churchcodelen = " + churchcodelen);
                console.log("usernameset = " + usernameset);
                console.log("passwordset = " + passwordset);
                console.log("repeatpasswordset = " + repeatpasswordset);
                console.log("firstnameset = " + firstnameset);
                console.log("lastnameset = " + lastnameset);
                console.log("genderset = " + genderset);
                console.log("emailset = " + emailset);
                console.log('all_req_fields = ' + all_req_fields);
                return 'Email Accepted'; 
            }
            else {
                subJQ('#email_choose').removeClass(); 
                subJQ('#email_choose').addClass('short'); 
                subJQ('#email_choose').html == 'Incorrect Email Format'; 
                console.log('churchcodeset = ' + churchcodeset);
                console.log('confirm_code_len = ' + confirm_code_len);
                console.log("churchcodelen = " + churchcodelen);
                console.log("usernameset = " + usernameset);
                console.log("passwordset = " + passwordset);
                console.log("repeatpasswordset = " + repeatpasswordset);
                console.log("firstnameset = " + firstnameset);
                console.log("lastnameset = " + lastnameset);
                console.log("genderset = " + genderset);
                console.log("emailset = " + emailset);
                console.log('all_req_fields = ' + all_req_fields);
                return 'Incorrect Email Format'; 
            }
        };
    });

// </editor-fold>

// <editor-fold desc="Validate Repeat Email Match - from ofc_email_match.js">

    subJQ('#repeatemailaddress').keyup(function(e){
        var code = e.keyCode || e.which; //Check for Tab key - don't call checkStrength until actual key is pressed
        if(code == '9'){
            console.log('Tab Key Pressed');
        }
        else {
            subJQ('#email_match').html(checkMatch(subJQ('#repeatemailaddress').val(), subJQ('#emailaddress').val()));
        }
        function checkMatch(repeatemailaddress, emailaddress){
            //initial check 
            var check = 0; 
            //if the password check does not match, return message. 
            if (repeatemailaddress == emailaddress) { 
                subJQ('#email_match').removeClass(); 
                subJQ('#email_match').addClass('match'); 
                repeatemailset = 'Y';
                console.log('churchcodeset = ' + churchcodeset);
                console.log('confirm_code_len = ' + confirm_code_len);
                console.log("churchcodelen = " + churchcodelen);
                console.log("usernameset = " + usernameset);
                console.log("passwordset = " + passwordset);
                console.log("repeatpasswordset = " + repeatpasswordset);
                console.log("firstnameset = " + firstnameset);
                console.log("lastnameset = " + lastnameset);
                console.log("genderset = " + genderset);
                console.log("emailset = " + emailset);
                console.log("repeatemailset = " + repeatemailset);
                console.log('all_req_fields = ' + all_req_fields);
                return 'Match'; 
            } 
            else { 
                subJQ('#email_match').removeClass(); 
                subJQ('#email_match').addClass('nomatch'); 
                repeatemailset = 'N';
                console.log('churchcodeset = ' + churchcodeset);
                console.log('confirm_code_len = ' + confirm_code_len);
                console.log("churchcodelen = " + churchcodelen);
                console.log("usernameset = " + usernameset);
                console.log("passwordset = " + passwordset);
                console.log("repeatpasswordset = " + repeatpasswordset);
                console.log("firstnameset = " + firstnameset);
                console.log("lastnameset = " + lastnameset);
                console.log("genderset = " + genderset);
                console.log("emailset = " + emailset);
                console.log("repeatemailset = " + repeatemailset);
                console.log('all_req_fields = ' + all_req_fields);
            return 'No Match'; 
            }; 
        };

        //if((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y'){
        if ((churchcodeset == 'N' || (churchcodeset == 'Y' && churchcodelen == 'Y')) && usernameset == 'Y' && passwordset == 'Y' && repeatpasswordset == 'Y' && firstnameset == 'Y' && lastnameset == 'Y' && emailset == 'Y' && repeatemailset == 'Y' && (genderset == 'Male' || genderset == 'Female')) {
            all_req_fields = 'Y';
            subJQ('#register_submit').removeClass('disabled'); 
            subJQ('#register_submit').prop('disabled', false); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("genderset = " + genderset);
            console.log("emailset = " + emailset);
            console.log("repeatemailset = " + repeatemailset);
            console.log('all_req_fields = ' + all_req_fields);
        }
        else {
            all_req_fields = 'N';
            subJQ('#register_submit').addClass('disabled'); 
            subJQ('#register_submit').prop('disabled', true); 
            console.log('churchcodeset = ' + churchcodeset);
            console.log('confirm_code_len = ' + confirm_code_len);
            console.log("churchcodelen = " + churchcodelen);
            console.log("usernameset = " + usernameset);
            console.log("passwordset = " + passwordset);
            console.log("repeatpasswordset = " + repeatpasswordset);
            console.log("firstnameset = " + firstnameset);
            console.log("lastnameset = " + lastnameset);
            console.log("genderset = " + genderset);
            console.log("emailset = " + emailset);
            console.log("repeatemailset = " + repeatemailset);
            console.log('all_req_fields = ' + all_req_fields);
        }
    });
// </editor-fold>

});
