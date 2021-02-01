<?php
//Last Updated 01/01/2021
// Added SuperUser capability to allow role to update other's profile information
session_start();
if(!$_SESSION['logged in']) 
{
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
else 
{
    if(isset($_GET['id']) ) {
        $profileID = $_GET['id'];
        echo "<script language='javascript'>";
        echo "console.log('At tec_profile - profileID = " . $profileID . "');";
        echo "console.log('SuperUser Status = " . $_SESSION['super_admin'] . "');";
        echo "</script>";
    $_SESSION["Famview_Profile"] = $profileID;
        if(($_SESSION['idDirectory'] == $profileID) || $_SESSION['super_admin']) 
        {
        	$MyView = 'Y';
        }
        else 
        {
		    $MyView = 'N';
        }
        require_once('tec_dbconnect.php');
    }
    else 
    {
        echo "<script language='javascript'>";
        echo "console.log('At tec_profile - wrong profileID = " . $profileID . "');";
        echo "</script>";
        session_destroy();
        header("location:tec_welcome.php");
        exit();
    }

/*Get children info for Grade and School - I'm using this method to extract value to determine 'selected' on Modal popup */
 		$profilequery = $mysql->query("SELECT * FROM $dir_tbl_name WHERE idDirectory = '" . $profileID . "'");
                while ($staterow = $profilequery->fetch_assoc())
                {
                    $recordState = $staterow['State'];
                    $record_1_Grade = $staterow['Child_1_Grade'];
                    $record_2_Grade = $staterow['Child_2_Grade'];
                    $record_3_Grade = $staterow['Child_3_Grade'];
                    $record_4_Grade = $staterow['Child_4_Grade'];
                    $record_5_Grade = $staterow['Child_5_Grade'];
                    $record_6_Grade = $staterow['Child_6_Grade'];
                    $record_7_Grade = $staterow['Child_7_Grade'];
                    $record_8_Grade = $staterow['Child_8_Grade'];
                    $record_1_School = $staterow['Child_1_School'];
                    $record_2_School = $staterow['Child_2_School'];
                    $record_3_School = $staterow['Child_3_School'];
                    $record_4_School = $staterow['Child_4_School'];
                    $record_5_School = $staterow['Child_5_School'];
                    $record_6_School = $staterow['Child_6_School'];
                    $record_7_School = $staterow['Child_7_School'];
                    $record_8_School = $staterow['Child_8_School'];
                }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- BOOTSTRAP - Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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
  <!-- Test custom styles (Includes tec style details) -->
  <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">
    <!-- Datatables stylesheet - Bootstrap-specific -->
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


  <!-- Call Moment js for date calc functions -->
  <script src="js/moment.js"></script>
  <!-- JQuery -->
  <!-- <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script> -->
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--******************************* Calculate Dates for Birthdays and Anniversaries **************************************-->
<script type="text/javascript">
        function calculate_age(dob) 
        {
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear() - 1970);
        }
    </script>
    <script type="text/javascript">
        function dateConvert(dateval)
        {
            var m_names = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            var curr_date = dateval.getUTCDate();
            var curr_month = dateval.getMonth();
            var curr_year = dateval.getFullYear();
            var newdateval = m_names[curr_month] + " " + curr_date + ", " + curr_year;
            return newdateval;
        }
    </script>
    <script type="text/javascript">
        function dateConvertNoYear(dateval)
        {
            var m_names = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            var curr_date = dateval.getUTCDate();
            var curr_month = dateval.getMonth();
            // console.log("dateval = " + dateval);
            // console.log("curr_date = " + curr_date);
            // console.log("curr_month = " + curr_month);
            var curr_year = dateval.getFullYear();
            var newdatevalnoyear = m_names[curr_month] + " " + curr_date;
            return newdatevalnoyear;
        }
    </script>

<!--******************************* Copy Address to Clipboard **************************************-->

<!--******************************* Extract Family Data **************************************-->
<script type="text/javascript" charset="utf-8">
        var $profile_id = <?php echo "'" . $profileID . "'"; ?>;
        var $fullname = <?php echo "'" . $_SESSION['fullname'] . "'"; ?>;
        var $idDirectory = <?php echo "'" . $_SESSION['idDirectory'] . "'"; ?>;
        console.log('At tec_profile Extract Family Data - profile_id = ' + $profile_id);
    </script>


<!--******************************* Extract Profile Info **************************************-->
<script type="text/javascript" charset="utf-8">
        var jQ05 = jQuery.noConflict();
        jQ05(document).ready(function() {
            var request = jQ05.ajax({
		url: 'services/tec_get_profile.php',
		type: 'POST',
		dataType: 'json',
		data: { profile_id: $profile_id}
            });
            // The ajax call succeeded. 
            request.done(function (data) {
                var $c1a = "";
                var years;
                var $profile_pic_img = "src=profile_img/" + data[0].piclink2;
                profileinfo = [];
                profilechildren = [];
                // console.log('Profile Info Zip = ' + data[0].zip);
                // console.log('Picture file = ' + data[0].piclink2);
/////////////////// Load Profile Page Contact Data 
// Load Profile Card title with His/Her Name
                jQ05("#profile_card").empty();
                if ((data[0].hisname) && (!data[0].hername)) {
                    profileinfo.push(data[0].hisname + ' ' + data[0].lastname);
                }
                if ((!data[0].hisname) && (data[0].hername)) {
                    profileinfo.push(data[0].hername + ' ' + data[0].lastname);
                }
                if ((data[0].hisname) && (data[0].hername)) {
                    profileinfo.push(data[0].hisname + ' & ' + data[0].hername + ' ' + data[0].lastname);
                }
                jQ05("#profile_card").append(profileinfo.join(''));
                // Display Profile Pic
                jQ05("#profile_pic").attr("src", "profile_img/" + data[0].piclink2);
                jQ05("#profile_pic_edit").attr("src", "profile_img/" + data[0].piclink2);
                if (data[0].hisname) {
                    jQ05("#profile_email_him").html("<h6>" + data[0].hisname + " (or both): " + "<a href='mailto:" + data[0].email1 + "'>" + data[0].email1 + "</a></h6>");
                }
                if (data[0].hername) {
                    jQ05("#profile_email_her").html("<h6>" + data[0].hername + ": <a href='mailto:" + data[0].email2 + "'>" + data[0].email2 + "</a></h6>");
                }
                if (data[0].phonehome) {
                    jQ05("#profile_phone_home").html("<h6>Home phone: " + data[0].phonehome) + "</h6>";
                }
                if (data[0].hisname) {
                    jQ05("#profile_cell_him").html("<h6>" + data[0].hisname + " cell: <a href='tel:" + data[0].hiscell + "'>" + data[0].hiscell + "</a></h6>");
                }
                if (data[0].hername) {
                    jQ05("#profile_cell_her").html("<h6>" + data[0].hername + " cell: <a href='tel:" + data[0].hercell + "'>" + data[0].hercell + "</a></h6>");
                }
                if (data[0].addr1 && data[0].addr2) {
                    jQ05("#profile_addr").html(data[0].addr1 + "\r\n" + data[0].addr2 + "\r\n" + data[0].city + ", " + data[0].state + " " + data[0].zip);
                }
                if (data[0].addr1 && !data[0].addr2) {
                    jQ05("#profile_addr").html(data[0].addr1 + "\r\n" + data[0].city + ", " + data[0].state + " " + data[0].zip);
                }
                if (data[0].anniv) {
                    var myanniv_moment = moment(data[0].anniv).format("MMMM D, YYYY");
                    // console.log('myanniv_moment = ' + myanniv_moment);
                        jQ05("#profile_anniv").html("<h6>Anniversary: " + myanniv_moment + "</h6>");
                }
                if (data[0].hisname) {
                    if (data[0].hisbday) {
                        var hisbday_moment = moment(data[0].hisbday).format("MMMM D");
                        // console.log('hisbday_moment = ' + hisbday_moment);
                        jQ05("#profile_hisbday").html("<h6>" + data[0].hisname + "'s Birthday: " + hisbday_moment + "</h6>");
                    }
                }
                if(data[0].hername){
                    if (data[0].herbday) {
                        var herbday_moment = moment(data[0].herbday).format("MMMM D");
                        // console.log('herbday_moment = ' + herbday_moment);
                        jQ05("#profile_herbday").html("<h6>" + data[0].hername + "'s Birthday: " + herbday_moment + "</h6>");
                    }
                }
//********************* Load Contact Edit Modal **************************
                jQ05("#hisfirstname").attr("value",data[0].hisname);
                jQ05("#herfirstname").attr("value",data[0].hername);
                jQ05("#mylastname").attr("value",data[0].lastname);
                jQ05("#myaddr1").attr("value",data[0].addr1);
                jQ05("#myaddr2").attr("value",data[0].addr2);
                jQ05("#mycity").attr("value",data[0].city);
                jQ05("#mystate").attr("value",data[0].state);
                jQ05("#myzip").attr("value",data[0].zip);
                if(data[0].phonehome){
                    jQ05("#myhomephone").attr("value",data[0].phonehome);
                }
                jQ05("#hiscell").attr("value",data[0].hiscell);
                jQ05("#hercell").attr("value",data[0].hercell);
                jQ05("#hisemail").attr("value",data[0].email1);
                jQ05("#heremail").attr("value",data[0].email2);
                // Load Calendar Edit Modal
                jQ05("#myanniversary").val(data[0].anniv);
                jQ05("#hisbirthday").val(data[0].hisbday);
                jQ05("#herbirthday").val(data[0].herbday);
                jQ05("#lastnameforcalendar").attr("value",data[0].lastname);
//////////////////////////// Load Child Edit Data
//******************* CHILD DATA ***********
// Load Profile Page Children Data
// Child 1
                    if(data[0].child_1_name)
                    {
                        jQ05("#c1n").html(data[0].child_1_name);
                        jQ05("#child1_name").attr("value",data[0].child_1_name);
                        var dob2 = dateConvert(new Date(data[0].child_1_bday));
                        jQ05("#c1b").html(dob2);
                        jQ05("#child1_bday").val(data[0].child_1_bday);
                        jQ05("#c1g").html(data[0].child_1_gender);
                        jQ05("#child1_gender").attr("value",data[0].child_1_gender);
                        if(data[0].child_1_gender == 'F'){
                            var genval = 1;
                            jQ05('#child1_gender > option').eq(genval).attr('selected','selected');
                        } 
                        else {
                            var genval = 0;
                            jQ05('#child1_gender > option').eq(genval).attr('selected','selected');
                        }
                        var age2 = calculate_age(new Date(data[0].child_1_bday));
                        jQ05("#c1a").html(age2);
                        jQ05("#child1_email").attr("value",data[0].child_1_email);
                        jQ05("#child1_school").attr("value",data[0].child_1_school);
                        jQ05("#child1_grade").attr("value",data[0].child_1_grade);
////////////////////////////
// **************************** Alert user when Remove Child button clicked ********************
                        jQ05("#remove1child").on("click", function () {
                            var remove_confirm = confirm("Are you sure you want to remove - " + data[0].child_1_name + " - from your list of children?");
                            if (remove_confirm) {
                                var child_nbr = '1'
                                remove_child(child_nbr, data[0].child_1_name, $profile_id);1
                                location.reload();
                            }
                        });
                    }
// Child 2
                    if(data[0].child_2_name)
                    {
                        jQ05("#c2n").html(data[0].child_2_name);
                        jQ05("#child2_name").attr("value",data[0].child_2_name);
                        var dob2 = dateConvert(new Date(data[0].child_2_bday));
                        jQ05("#c2b").html(dob2);
                        jQ05("#child2_bday").val(data[0].child_2_bday);
                        jQ05("#c2g").html(data[0].child_2_gender);
                        jQ05("#child2_gender").attr("value",data[0].child_2_gender);
                        if(data[0].child_2_gender == 'F'){
                            var genval = 1;
                            jQ05('#child2_gender > option').eq(genval).attr('selected','selected');
                        } 
                        else {
                            var genval = 0;
                            jQ05('#child2_gender > option').eq(genval).attr('selected','selected');
                        }
                        var age2 = calculate_age(new Date(data[0].child_2_bday));
                        jQ05("#c2a").html(age2);
                        jQ05("#child2_email").attr("value",data[0].child_2_email);
                        jQ05("#child2_grade").attr("value",data[0].child_2_grade);
                        jQ05("#child2_school").attr("value",data[0].child_2_school);
////////////////////////////
// **************************** Alert user when Remove Child button clicked ********************
                        jQ05("#remove2child").on("click", function () {
                            var remove_confirm = confirm("Are you sure you want to remove - " + data[0].child_2_name + " - from your list of children?");
                            if (remove_confirm) {
                                var child_nbr = '2'
                                remove_child(child_nbr, data[0].child_2_name, $profile_id);
                                location.reload();
                            }
                        });
                    }
// Child 3
                    if(data[0].child_3_name)
                    {
                        jQ05("#c3n").html(data[0].child_3_name);
                        jQ05("#child3_name").attr("value",data[0].child_3_name);
                        var dob2 = dateConvert(new Date(data[0].child_3_bday));
                        jQ05("#c3b").html(dob2);
                        jQ05("#child3_bday").val(data[0].child_3_bday);
                        jQ05("#c3g").html(data[0].child_3_gender);
                        jQ05("#child3_gender").attr("value",data[0].child_3_gender);
                        if(data[0].child_3_gender == 'F'){
                            var genval = 1;
                            jQ05('#child3_gender > option').eq(genval).attr('selected','selected');
                        } 
                        else {
                            var genval = 0;
                            jQ05('#child3_gender > option').eq(genval).attr('selected','selected');
                        }
                        var age2 = calculate_age(new Date(data[0].child_3_bday));
                        jQ05("#c3a").html(age2);
                        jQ05("#child3_email").attr("value",data[0].child_3_email);
                        jQ05("#child3_grade").attr("value",data[0].child_3_grade);
                        jQ05("#child3_school").attr("value",data[0].child_3_school);
////////////////////////////
// **************************** Alert user when Remove Child button clicked ********************
                        jQ05("#remove3child").on("click", function () {
                            var remove_confirm = confirm("Are you sure you want to remove - " + data[0].child_3_name + " - from your list of children?");
                            if (remove_confirm) {
                                var child_nbr = '3'
                                remove_child(child_nbr, data[0].child_3_name, $profile_id);
                                location.reload();
                            }
                        });
                    }
// Child 4
                    if(data[0].child_4_name)
                    {
                        jQ05("#c4n").html(data[0].child_4_name);
                        jQ05("#child4_name").attr("value",data[0].child_4_name);
                        var dob2 = dateConvert(new Date(data[0].child_4_bday));
                        jQ05("#c4b").html(dob2);
                        jQ05("#child4_bday").val(data[0].child_4_bday);
                        jQ05("#c4g").html(data[0].child_4_gender);
                        jQ05("#child4_gender").attr("value",data[0].child_4_gender);
                        if(data[0].child_4_gender == 'F'){
                            var genval = 1;
                            jQ05('#child4_gender > option').eq(genval).attr('selected','selected');
                        } 
                        else {
                            var genval = 0;
                            jQ05('#child4_gender > option').eq(genval).attr('selected','selected');
                        }
                        var age2 = calculate_age(new Date(data[0].child_4_bday));
                        jQ05("#c4a").html(age2);
                        jQ05("#child4_email").attr("value",data[0].child_4_email);
                        jQ05("#child4_grade").attr("value",data[0].child_4_grade);
                        jQ05("#child4_school").attr("value",data[0].child_4_school);
////////////////////////////
// **************************** Alert user when Remove Child button clicked ********************
                        jQ05("#remove4child").on("click", function () {
                            var remove_confirm = confirm("Are you sure you want to remove - " + data[0].child_4_name + " - from your list of children?");
                            if (remove_confirm) {
                                var child_nbr = '4'
                                remove_child(child_nbr, data[0].child_4_name, $profile_id);
                                location.reload();
                            }
                        });
                    }
// Child 5
                    if(data[0].child_5_name)
                    {
                        jQ05("#c5n").html(data[0].child_5_name);
                        jQ05("#child5_name").attr("value",data[0].child_5_name);
                        var dob2 = dateConvert(new Date(data[0].child_5_bday));
                        jQ05("#c5b").html(dob2);
                        jQ05("#child5_bday").val(data[0].child_5_bday);
                        jQ05("#c5g").html(data[0].child_5_gender);
                        jQ05("#child5_gender").attr("value",data[0].child_5_gender);
                        if(data[0].child_5_gender == 'F'){
                            var genval = 1;
                            jQ05('#child5_gender > option').eq(genval).attr('selected','selected');
                        } 
                        else {
                            var genval = 0;
                            jQ05('#child5_gender > option').eq(genval).attr('selected','selected');
                        }
                        var age2 = calculate_age(new Date(data[0].child_5_bday));
                        jQ05("#c5a").html(age2);
                        jQ05("#child5_email").attr("value",data[0].child_5_email);
                        jQ05("#child5_grade").attr("value",data[0].child_5_grade);
                        jQ05("#child5_school").attr("value",data[0].child_5_school);
////////////////////////////
// **************************** Alert user when Remove Child button clicked ********************
                        jQ05("#remove5child").on("click", function () {
                            var remove_confirm = confirm("Are you sure you want to remove - " + data[0].child_5_name + " - from your list of children?");
                            if (remove_confirm) {
                                var child_nbr = '5'
                                remove_child(child_nbr, data[0].child_5_name, $profile_id);
                                location.reload();
                            }
                        });
                    }
// Child 6
                    if(data[0].child_6_name)
                    {
                        jQ05("#c6n").html(data[0].child_6_name);
                        jQ05("#child6_name").attr("value",data[0].child_6_name);
                        var dob2 = dateConvert(new Date(data[0].child_6_bday));
                        jQ05("#c6b").html(dob2);
                        jQ05("#child6_bday").val(data[0].child_6_bday);
                        jQ05("#c6g").html(data[0].child_6_gender);
                        jQ05("#child6_gender").attr("value",data[0].child_6_gender);
                        if(data[0].child_6_gender == 'F'){
                            var genval = 1;
                            jQ05('#child6_gender > option').eq(genval).attr('selected','selected');
                        } 
                        else {
                            var genval = 0;
                            jQ05('#child6_gender > option').eq(genval).attr('selected','selected');
                        }
                        var age2 = calculate_age(new Date(data[0].child_6_bday));
                        jQ05("#c6a").html(age2);
                        jQ05("#child6_email").attr("value",data[0].child_6_email);
                        jQ05("#child6_grade").attr("value",data[0].child_6_grade);
                        jQ05("#child6_school").attr("value",data[0].child_6_school);
////////////////////////////
// **************************** Alert user when Remove Child button clicked ********************
                        jQ05("#remove6child").on("click", function () {
                            var remove_confirm = confirm("Are you sure you want to remove - " + data[0].child_6_name + " - from your list of children?");
                            if (remove_confirm) {
                                var child_nbr = '6'
                                remove_child(child_nbr, data[0].child_6_name, $profile_id);
                                location.reload();
                            }
                        });
                    }
// Child 7
                    if(data[0].child_7_name)
                    {
                        jQ05("#c7n").html(data[0].child_7_name);
                        jQ05("#child7_name").attr("value",data[0].child_7_name);
                        var dob2 = dateConvert(new Date(data[0].child_7_bday));
                        jQ05("#c7b").html(dob2);
                        jQ05("#child7_bday").val(data[0].child_7_bday);
                        jQ05("#c7g").html(data[0].child_7_gender);
                        jQ05("#child7_gender").attr("value",data[0].child_7_gender);
                        if(data[0].child_7_gender == 'F'){
                            var genval = 1;
                            jQ05('#child7_gender > option').eq(genval).attr('selected','selected');
                        } 
                        else {
                            var genval = 0;
                            jQ05('#child7_gender > option').eq(genval).attr('selected','selected');
                        }
                        var age2 = calculate_age(new Date(data[0].child_7_bday));
                        jQ05("#c7a").html(age2);
                        jQ05("#child7_email").attr("value",data[0].child_7_email);
                        jQ05("#child7_grade").attr("value",data[0].child_7_grade);
                        jQ05("#child7_school").attr("value",data[0].child_7_school);
////////////////////////////
// **************************** Alert user when Remove Child button clicked ********************
                        jQ05("#remove7child").on("click", function () {
                            var remove_confirm = confirm("Are you sure you want to remove - " + data[0].child_7_name + " - from your list of children?");
                            if (remove_confirm) {
                                var child_nbr = '7'
                                remove_child(child_nbr, data[0].child_7_name, $profile_id);
                                location.reload();
                            }
                        });
                    }
// Child 8
                    if(data[0].child_8_name)
                    {
                        jQ05("#c8n").html(data[0].child_8_name);
                        jQ05("#child8_name").attr("value",data[0].child_8_name);
                        var dob2 = dateConvert(new Date(data[0].child_8_bday));
                        jQ05("#c8b").html(dob2);
                        jQ05("#child8_bday").val(data[0].child_8_bday);
                        jQ05("#c8g").html(data[0].child_8_gender);
                        jQ05("#child8_gender").attr("value",data[0].child_8_gender);
                        if(data[0].child_8_gender == 'F'){
                            var genval = 1;
                            jQ05('#child8_gender > option').eq(genval).attr('selected','selected');
                        } 
                        else {
                            var genval = 0;
                            jQ05('#child8_gender > option').eq(genval).attr('selected','selected');
                        }
                        var age2 = calculate_age(new Date(data[0].child_8_bday));
                        jQ05("#c8a").html(age2);
                        jQ05("#child8_email").attr("value",data[0].child_8_email);
                        jQ05("#child8_grade").attr("value",data[0].child_8_grade);
                        jQ05("#child8_school").attr("value",data[0].child_8_school);
////////////////////////////
// **************************** Alert user when Remove Child button clicked ********************
                        jQ05("#remove8child").on("click", function () {
                            var remove_confirm = confirm("Are you sure you want to remove - " + data[0].child_8_name + " - from your list of children?");
                            if (remove_confirm) {
                                var child_nbr = '8'
                                remove_child(child_nbr, data[0].child_8_name, $profile_id);
                                location.reload();
                            }
                        });
                    }
            });
            // The ajax call failed
            request.fail(function(xhr, status, errorThrown) {
                console.log('Profile Info Failed');
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                alert('Failed to obtain profile data. Please re-load page.');
            });

    });
    </script>

<!-- ********************* Detect and perform profile 'Edit' actions ********* -->
<script type="text/javascript" >
var jQ53 = jQuery.noConflict();
	jQ53(document).ready(function() {
        // console.log('At jQ53');
		jQ53("#contactEdit").click(function () {
			jQ53("#my_popup4").popup({
				background: true, focusdelay: 400, transition: 'all 0.3s', vertical: 'top', autozindex: true, outline: true, keepfocus: true, blur: false, color: "#D1E0B2"
			});		
		});
		jQ53("#calendarEdit").click(function () {
			jQ53("#my_popup5").popup({
				background: true, focusdelay: 400, transition: 'all 0.3s', vertical: 'top', autozindex: true, outline: true, keepfocus: true, blur: false, color: "#D1E0B2"
			});		
		});
});
</script>

<!-- ********************************** Load Profile Modal Page Child Data ******** -->
<!-- Load Child POPUP -->
<script type="text/javascript" >
var jQ55 = jQuery.noConflict();
	jQ55(document).ready(function() {
        // console.log('At jQ55');
        jQ55("#Children_Info_Click").click(function (){
            // console.log('Children_Info_Click Click invoked');
            jQ55('#child1select').css('background-color', '#8FBC8F');
			jQ55('#child2select').css('background-color', '#0800ff');
			jQ55('#child3select').css('background-color', '#0800ff');
			jQ55('#child4select').css('background-color', '#0800ff');
			jQ55('#child5select').css('background-color', '#0800ff');
			jQ55('#child6select').css('background-color', '#0800ff');
			jQ55('#child7select').css('background-color', '#0800ff');
			jQ55('#child8select').css('background-color', '#0800ff');
			jQ55('#child1edit').css('display', 'inline-block');
			jQ55('#child2edit').css('display', 'none');
			jQ55('#child3edit').css('display', 'none');
			jQ55('#child4edit').css('display', 'none');
			jQ55('#child5edit').css('display', 'none');
			jQ55('#child6edit').css('display', 'none');
			jQ55('#child7edit').css('display', 'none');
			jQ55('#child8edit').css('display', 'none');
                });
            jQ55('.childselectbutton').on('click', function(){
                var childselected = jQ55(this).attr('name');
                // console.log('childselectbutton ' + childselected + ' has been clicked');
                switch(childselected) {
// Child 1 Select
                case 'child1select':
					jQ55('#child1select').css('background-color', '#8FBC8F');
					jQ55('#child1edit').css('display', 'inline-block');
					jQ55('#child2select').css('background-color', '#0800ff');
					jQ55('#child2edit').css('display', 'none');
					jQ55('#child3select').css('background-color', '#0800ff');
					jQ55('#child3edit').css('display', 'none');
					jQ55('#child4select').css('background-color', '#0800ff');
					jQ55('#child4edit').css('display', 'none');
					jQ55('#child5select').css('background-color', '#0800ff');
					jQ55('#child5edit').css('display', 'none');
					jQ55('#child6select').css('background-color', '#0800ff');
					jQ55('#child6edit').css('display', 'none');
					jQ55('#child7select').css('background-color', '#0800ff');
					jQ55('#child7edit').css('display', 'none');
					jQ55('#child8select').css('background-color', '#0800ff');
					jQ55('#child8edit').css('display', 'none');
				break;
// Child 2 Select
				case 'child2select':
					jQ55('#child1select').css('background-color', '#0800ff');
					jQ55('#child1edit').css('display', 'none');
					jQ55('#child2select').css('background-color', '#8FBC8F');
					jQ55('#child2edit').css('display', 'inline-block');
					jQ55('#child3select').css('background-color', '#0800ff');
					jQ55('#child3edit').css('display', 'none');
					jQ55('#child4select').css('background-color', '#0800ff');
					jQ55('#child4edit').css('display', 'none');
					jQ55('#child5select').css('background-color', '#0800ff');
					jQ55('#child5edit').css('display', 'none');
					jQ55('#child6select').css('background-color', '#0800ff');
					jQ55('#child6edit').css('display', 'none');
					jQ55('#child7select').css('background-color', '#0800ff');
					jQ55('#child7edit').css('display', 'none');
					jQ55('#child8select').css('background-color', '#0800ff');
					jQ55('#child8edit').css('display', 'none');
				break;
// Child 3 Select
				case 'child3select':
					jQ55('#child1select').css('background-color', '#0800ff');
					jQ55('#child1edit').css('display', 'none');
					jQ55('#child2select').css('background-color', '#0800ff');
					jQ55('#child2edit').css('display', 'none');
					jQ55('#child3select').css('background-color', '#8FBC8F');
					jQ55('#child3edit').css('display', 'inline-block');
					jQ55('#child4select').css('background-color', '#0800ff');
					jQ55('#child4edit').css('display', 'none');
					jQ55('#child5select').css('background-color', '#0800ff');
					jQ55('#child5edit').css('display', 'none');
					jQ55('#child6select').css('background-color', '#0800ff');
					jQ55('#child6edit').css('display', 'none');
					jQ55('#child7select').css('background-color', '#0800ff');
					jQ55('#child7edit').css('display', 'none');
					jQ55('#child8select').css('background-color', '#0800ff');
					jQ55('#child8edit').css('display', 'none');
				break;
// Child 4 Select
				case 'child4select':
					jQ55('#child1select').css('background-color', '#0800ff');
					jQ55('#child1edit').css('display', 'none');
					jQ55('#child2select').css('background-color', '#0800ff');
					jQ55('#child2edit').css('display', 'none');
					jQ55('#child3select').css('background-color', '#0800ff');
					jQ55('#child3edit').css('display', 'none');
					jQ55('#child4select').css('background-color', '#8FBC8F');
					jQ55('#child4edit').css('display', 'inline-block');
					jQ55('#child5select').css('background-color', '#0800ff');
					jQ55('#child5edit').css('display', 'none');
					jQ55('#child6select').css('background-color', '#0800ff');
					jQ55('#child6edit').css('display', 'none');
					jQ55('#child7select').css('background-color', '#0800ff');
					jQ55('#child7edit').css('display', 'none');
					jQ55('#child8select').css('background-color', '#0800ff');
					jQ55('#child8edit').css('display', 'none');
				break;
// Child 5 Select
				case 'child5select':
					jQ55('#child1select').css('background-color', '#0800ff');
					jQ55('#child1edit').css('display', 'none');
					jQ55('#child2select').css('background-color', '#0800ff');
					jQ55('#child2edit').css('display', 'none');
					jQ55('#child3select').css('background-color', '#0800ff');
					jQ55('#child3edit').css('display', 'none');
					jQ55('#child4select').css('background-color', '#0800ff');
					jQ55('#child4edit').css('display', 'none');
					jQ55('#child5select').css('background-color', '#8FBC8F');
					jQ55('#child5edit').css('display', 'inline-block');
					jQ55('#child6select').css('background-color', '#0800ff');
					jQ55('#child6edit').css('display', 'none');
					jQ55('#child7select').css('background-color', '#0800ff');
					jQ55('#child7edit').css('display', 'none');
					jQ55('#child8select').css('background-color', '#0800ff');
					jQ55('#child8edit').css('display', 'none');
				break;
// Child 6 Select
				case 'child6select':
					jQ55('#child1select').css('background-color', '#0800ff');
					jQ55('#child1edit').css('display', 'none');
					jQ55('#child2select').css('background-color', '#0800ff');
					jQ55('#child2edit').css('display', 'none');
					jQ55('#child3select').css('background-color', '#0800ff');
					jQ55('#child3edit').css('display', 'none');
					jQ55('#child4select').css('background-color', '#0800ff');
					jQ55('#child4edit').css('display', 'none');
					jQ55('#child5select').css('background-color', '#0800ff');
					jQ55('#child5edit').css('display', 'none');
					jQ55('#child6select').css('background-color', '#8FBC8F');
					jQ55('#child6edit').css('display', 'inline-block');
					jQ55('#child7select').css('background-color', '#0800ff');
					jQ55('#child7edit').css('display', 'none');
					jQ55('#child8select').css('background-color', '#0800ff');
					jQ55('#child8edit').css('display', 'none');
				break;
// Child 7 Select
				case 'child7select':
					jQ55('#child1select').css('background-color', '#0800ff');
					jQ55('#child1edit').css('display', 'none');
					jQ55('#child2select').css('background-color', '#0800ff');
					jQ55('#child2edit').css('display', 'none');
					jQ55('#child3select').css('background-color', '#0800ff');
					jQ55('#child3edit').css('display', 'none');
					jQ55('#child4select').css('background-color', '#0800ff');
					jQ55('#child4edit').css('display', 'none');
					jQ55('#child5select').css('background-color', '#0800ff');
					jQ55('#child5edit').css('display', 'none');
					jQ55('#child6select').css('background-color', '#0800ff');
					jQ55('#child6edit').css('display', 'none');
					jQ55('#child7select').css('background-color', '#8FBC8F');
					jQ55('#child7edit').css('display', 'inline-block');
					jQ55('#child8select').css('background-color', '#0800ff');
					jQ55('#child8edit').css('display', 'none');
				break;
// Child 8 Select
				case 'child8select':
					jQ55('#child1select').css('background-color', '#0800ff');
					jQ55('#child1edit').css('display', 'none');
					jQ55('#child2select').css('background-color', '#0800ff');
					jQ55('#child2edit').css('display', 'none');
					jQ55('#child3select').css('background-color', '#0800ff');
					jQ55('#child3edit').css('display', 'none');
					jQ55('#child4select').css('background-color', '#0800ff');
					jQ55('#child4edit').css('display', 'none');
					jQ55('#child5select').css('background-color', '#0800ff');
					jQ55('#child5edit').css('display', 'none');
					jQ55('#child6select').css('background-color', '#0800ff');
					jQ55('#child6edit').css('display', 'none');
					jQ55('#child7select').css('background-color', '#0800ff');
					jQ55('#child7edit').css('display', 'none');
					jQ55('#child8select').css('background-color', '#8FBC8F');
					jQ55('#child8edit').css('display', 'inline-block');
				break;
			}
			jQ55(this).css('background-color', '#8FBC8F');
		});

		jQ55("#NewPhoto").click(function () {
            // console.log('NewPhoto Click invoked');
			jQ55("#my_popup7").popup({
			background: true, focusdelay: 400, transition: 'all 0.3s', vertical: 'top', autozindex: true, outline: true, keepfocus: true, blur: false, color: "#D1E0B2"
		});
	});
});
</script>

<!--******************************* Include family list extract **************************************-->
<?php
    // echo "<script language='javascript'>";
    // echo "console.log('ARRIVED at script to include familylist, childlist, studentlist');";
    // echo "</script>";
// Get Family Details List
    //    include('includes/tec_view_familylist.php');
// Get Child List
       include('includes/tec_view_childlist.php');
// Get Student List
    //    include('/includes/tec_view_studentlist.php');
// Setup for child delete script
    // include('services/tec_profile_children_delete.php');
?>



<!--******************************* /Extract Profile Info **************************************-->
</head>
<body>
  <!--Navbar-->
            <?php
            $activeparam = '2'; // sets nav element highlight
            require_once('tec_nav.php');
            require_once('includes/tec_footer.php');
            ?>

<!-- Start Here -->
<div class="container-fluid bottom-buffer" id="backsplash">
<!-- ******************************* Display "Edit Profile" dropdown on profile match ************************************** -->
<?php
    if($MyView == 'Y')
    {
        // echo 
        // '<div class="row">'
        //         . '<div class="col-sm-12">'
        //             . '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">'
        //                 . '<div class="btn-group mr-2 pt-2" role="group" aria-label="Button group with nested dropdown">'
        //                     . '<div class="dropdown">'
        //                         . '<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Edit Profile</button>'
        //                         . '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'
        //                             . '<button class="dropdown-item" data-toggle="modal" data-target="#ModalProfilePic" type="button">New Photo</button>'
        //                             . '<button class="dropdown-item" data-toggle="modal" data-target="#ModalContactInfo" type="button">Contact Info</button>'
        //                             . '<button class="dropdown-item" data-toggle="modal" id="Children_Info_Click" data-target="#ModalChildrenInfo" type="button">Children</button>'
        //                             . '<button class="dropdown-item" data-toggle="modal" data-target="#ModalCalendarInfo" type="button">Anniversary/Birthdays</button>'
        //                         . '</div>'
        //                     . '</div>'
        //                 . '</div>'
        //             . '</div>'
        //         . '</div>'
        //     . '</div>';
            echo
            '<div class="row">'
            . '<div class="col-sm-12 mr-2 pt-2">'
                // . '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">'
                //     . '<div class="btn-group mr-2 pt-2" role="group" aria-label="Button group with nested dropdown">'
                        . '<div class="dropdown">'
                            .   '<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                .   'Edit Profile'
                            .   '</button>'
                            . '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'
                                . '<button class="dropdown-item" data-toggle="modal" data-target="#ModalProfilePic" type="button">New Photo</button>'
                                . '<button class="dropdown-item" data-toggle="modal" data-target="#ModalContactInfo" type="button">Contact Info</button>'
                                . '<button class="dropdown-item" data-toggle="modal" id="Children_Info_Click" data-target="#ModalChildrenInfo" type="button">Children</button>'
                                . '<button class="dropdown-item" data-toggle="modal" data-target="#ModalCalendarInfo" type="button">Anniversary/Birthdays</button>'
                            . '</div>'
                        . '</div>'
                //     . '</div>'
                // . '</div>'
            . '</div>'
        . '</div>';
}
?>
<!-- ******************************* Profile Photo Card ************************************** -->
    <div class="row pt-2">
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="card bg-light border-primary p-3 mt-2">
                    <img class="card-img-top" id="profile_pic" style="width: 100%; align-self: center" alt="Card image cap">
            </div> <!-- card -->
        </div><!--col-xs-6-->
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="card bg-light p-3 mt-2">
<!-- ******************************* Profile Contact Details Card ************************************** -->
                    <h4 class="card-title text-center text-capitalize" id="profile_card">Name</h4>
                    <h5 class="card-text"><u>Address</u></h5>
                    <h6 class="card-text" id="profile_addr"></h6>
                    <h5 class="card-text"><u>Phone</u></h5>
                    <p class="card-text" id="profile_phone_home"></p>
                    <p class="card-text" id="profile_cell_him"></p>
                    <p class="card-text" id="profile_cell_her"></p>
                    <h5 class="card-text"><u>Email</u></h5>
                    <p class="card-text" id="profile_email_him"></p>
                    <p class="card-text" id="profile_email_her"></p>
                <!-- </div>  card-body -->
            </div> <!-- card -->
       </div><!--col-xs-6-->
<!-- ******************************* Students in xxx School Card ************************************** -->
      <!-- <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="card bg-light p-3 mt-2">
                    <h4 class="card-title text-center text-capitalize" id="profile_card">Students in <span id="nickname"></span></h4>
                    <div class="table-responsive-xs">
                        <table id="studentdata" class="table table-sm table-striped dt-responsive" width="100%">
                            <thead>
                                <tr>
                                    <th class="strong">Name</th>
                                    <th class="strong">ChildNbr</th>
                                    <th class="strong">Grade</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="strong">Name</th>
                                    <th class="strong">ChildNbr</th>
                                    <th class="strong">Grade</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

            </div>
        </div> -->
<!-- ******************************* Celebrate With Us Card ************************************** -->
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="card bg-light p-3 mt-2">
                            <h4 class="card-title text-center text-capitalize">Celebrate with Us</h4>
                            <h5 class="card-text"><u>Anniversary</u></h5>
                            <p class="card-text" id="profile_anniv"></p>
                            <h5 class="card-text"><u>Birthdays</u></h5>
                            <p class="card-text" id="profile_hisbday"></p>
                            <p class="card-text" id="profile_herbday"></p>
            </div> <!-- card -->
        </div> <!-- col-xs-12 -->
    </div><!--row-->
    <div class="row">
<!-- ******************************* Children in Family Card ************************************** -->
        <div class="col-sm-12">
            <div class="card bg-light border-primary px-2 my-2 w-100">
                <div class="card-body">
                    <h4 class="card-title text-center text-capitalize">Our Children</h4>
                    <div class="table-responsive-xs">
                        <!-- <table id="childdata" class="table table-sm table-striped dt-responsive" width="100%"> -->
                        <table id="childdata" class="table table-sm table-striped 'display responsive nowrap'" width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class = "dtr-childcolumn"
                                    ></th>
                                    <th class="strong">Name</th>
                                    <th class="strong">Birthdate</th>
                                    <th class="strong">Gender</th>
                                    <th class="strong">Age</th>
                                    <th class="strong">Email</th>
                                    <th class="strong">School</th>
                                    <th class="strong">Grade</th>
                                </tr>
                            </thead>
                            <tfoot class="table-dark">
                                <tr>
                                    <th class = "dtr-childcolumn"></th>
                                    <th class="strong">Name</th>
                                    <th class="strong">Birthdate</th>
                                    <th class="strong">Gender</th>
                                    <th class="strong">Age</th>
                                    <th class="strong">Email</th>
                                    <th class="strong">School</th>
                                    <th class="strong">Grade</th>
                                </tr>
                            </tfoot>
                        </table>
                   </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
</div><!-- container-->

<!--***************************** Edit Picture MODAL ***********************************-->
<!--***************************** Edit Picture MODAL ***********************************-->
<!--***************************** Edit Picture MODAL ***********************************-->

<div class="modal fade" id="ModalProfilePic" tabindex="-1" role="dialog" aria-labelledby="ModalProfilePicLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalProfilePicLabel">Upload New Family Photo<br>Click <strong>Save Changes</strong> when done.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<p><strong>NOTE:</strong> Photo must be less than 4MB, and in one of the following formats:</p> 
            <ul>
                <li>
                    .bmp; .jpg; .png
                </li>
            </ul>
        <hr>
                <form id="uploadImage" enctype="multipart/form-data" action="" method="post">
                    <div id="image_preview">
                        <img id="profile_pic_edit" width="200" height="auto" />
                    </div>
                    <input type="hidden" name="MAX_FILE_SIZE" value="4000000" />
                    <input name="file" type="file" id="file" required />
            <div id="message">

            </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Save changes" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!--***************************** Edit Contact Info MODAL ***********************************-->
<!--***************************** Edit Contact Info MODAL ***********************************-->
<!--***************************** Edit Contact Info MODAL ***********************************-->

<div class="modal fade" id="ModalContactInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Contact Info<br>Click <strong>Save Changes</strong> when done.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="text-center border border-light p-2" name='editcontact' method='post' action='/services/tec_profile_contact_update.php'> 		
                    <table id="editprofiletable" border='0' cellpadding='0' cellspacing='1' >
                        <div class="modaleditform text-center border border-light p-2">
                            <div class="table-responsive">
                            <div class="row">
                                <div class="col-3">
                                    <label for="hisfirstname">His Name:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Enter first name" type="text" id="hisfirstname" name='hisfirstname' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="herfirstname">Her Name:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Enter first name" type="text" id="herfirstname" name='herfirstname' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="mylastname">Last Name:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Enter last name" type="text" id="mylastname" name='mylastname' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="myaddr1">Street Address:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Enter street address" type="text" id="myaddr1" name='myaddr1' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="myaddr2">Apt. or PO:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Enter apartment # or PO Box" type="text" id="myaddr2" name='myaddr2' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="mycity">City:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Enter city" type="text" id="mycity" name='mycity' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="mystate">State/Province:</label>
                                </div>
                                <div class="col-9">
                                    <select class="custom-select" name="mystate" id="mystate">
                                        <?php
                                            $states_query = "SELECT * from " . $_SESSION['statestablename'];
                                            $statesresult = $mysql->query($states_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                                            while($states_row = $statesresult->fetch_assoc())
                                            {
                                                $states_optionvalue = $states_row['state_abbrev'] . " - " . $states_row['state_name'];
                                                $selectedstate = $states_row['state_abbrev'];		
                                                echo "<option value='" . $states_optionvalue . "'";
                                                if($selectedstate == $recordState)
                                                {
                                                    echo " selected='selected'";
                                                }
                                            echo ">" . $states_optionvalue . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div> <!--Row-->
                            <div class="row">
                                <div class="col-3">
                                    <label for="myzip">Zip Code:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Enter zip code" type="text" id="myzip" name='myzip' class="form-control" />
                                </div>
                            </div> <!--Row-->
                            <div class="row">
                                <div class="col-3">
                                    <label for="myhomephone">Home Phone:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Home phone (format ###-###-####)" type="text" id="myhomephone" name='myhomephone' pattern="^\d{3}-\d{3}-\d{4}$" class="form-control" />
                                </div>
                            </div> <!--Row-->
                            <div class="row">
                                <div class="col-3">
                                    <label for="hiscell">His Cell:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="His cell phone (format ###-###-####)" type="text" id="hiscell" name='hiscell' pattern="^\d{3}-\d{3}-\d{4}$" class="form-control" />
                                </div>
                            </div> <!--Row-->
                            <div class="row">
                                <div class="col-3">
                                    <label for="hercell">Her Cell:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Her cell phone (format ###-###-####)" type="text" id="hercell" name='hercell' pattern="^\d{3}-\d{3}-\d{4}$" class="form-control" />
                                </div>
                            </div> <!--Row-->
                            <div class="row">
                                <div class="col-3">
                                    <label for="hisemail">His Email:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="His email address" type="email" id="hisemail" name='hisemail' class="form-control" />
                                </div>
                            </div> <!--Row-->
                            <div class="row">
                                <div class="col-3">
                                    <label for="heremail">Her Email:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Her email address" type="email" id="heremail" name='heremail' class="form-control" />
                                </div>
                            </div> <!--Row-->
                            </div> <!--Table Responsive-->
                        </div> <!-- text-center -->
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="3" align='right'>
                                <button type="submit" name="submitcontact" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<!--***************************** Edit Calendar Info MODAL ***********************************-->
<!--***************************** Edit Calendar Info MODAL ***********************************-->
<!--***************************** Edit Calendar Info MODAL ***********************************-->

<div class="modal fade" id="ModalCalendarInfo" tabindex="-1" role="dialog" aria-labelledby="ModalCalendar" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalCalendar">Edit Anniversary and Birthdays<br>Click <strong>Save Changes</strong> when done.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="text-center border border-light p-2" name='editcalendar' method='post' action='services/tec_profile_calendar_update.php'> 		
                    <table id="editcalendartable" border='0' cellpadding='0' cellspacing='1' >
                        <div class="border border-light p-2">
                            <div class="md-form">
                                <div class="h3-responsive lead text-center">Anniversary and Birthdays</div>
                            </div>
                        </div>
                        <div class="modaleditform text-center border border-light p-2">
                            <div class="table-responsive">
                            <div class="row">
                                <div class="col-4">
                                    <label for="myanniversary">Anniversary:</label>
                                </div>
                                <div class="col-8">
                                    <input type="date" id="myanniversary" name='myanniversary' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="hisbirthday">His Birthday:</label>
                                </div>
                                <div class="col-8">
                                    <input type="date" id="hisbirthday" name='hisbirthday' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="herbirthday">Her Birthday:</label>
                                </div>
                                <div class="col-8">
                                    <input type="date" id="herbirthday" name='herbirthday' class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="lastname" id="lastnameforcalendar"></td>
                            </div>
                        </div>
                        <p>
                        <p>
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="3" align='right'>
                                <button type="submit" name="submitcalendar" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>            
<!--***************************** Edit Children Info MODAL ***********************************-->
<!--***************************** Edit Children Info MODAL ***********************************-->
<!--***************************** Edit Children Info MODAL ***********************************-->
            
<div class="modal fade" id="ModalChildrenInfo" tabindex="-1" role="dialog" aria-labelledby="ModalChildren" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalChildren">Edit Children Info<br>Click <strong>Save Changes</strong> when done.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <div class="modal-body">
<form class="text-center border border-light p-2" name='editchildren' method='post' action='services/tec_profile_children_update.php'>
<!-- CHILD TABS -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-3"><input type="button" class="childselectbutton button_flat_blue_small" name='child1select' id='child1select' value='Child 1'></div>
                <div class="col-3"><input type="button" class="childselectbutton button_flat_blue_small" name='child2select' id='child2select' value='Child 2'></div>
                <div class="col-3"><input type="button" class="childselectbutton button_flat_blue_small" name='child3select' id='child3select' value='Child 3'></div>
                <div class="col-3"><input type="button" class="childselectbutton button_flat_blue_small" name='child4select' id='child4select' value='Child 4'></div>
            </div>
            <div class="row">
                <div class="col-3"><input type="button" class="childselectbutton button_flat_blue_small" name='child5select' id='child5select' value='Child 5'></div>
                <div class="col-3"><input type="button" class="childselectbutton button_flat_blue_small" name='child6select' id='child6select' value='Child 6'></div>
                <div class="col-3"><input type="button" class="childselectbutton button_flat_blue_small" name='child7select' id='child7select' value='Child 7'></div>
                <div class="col-3"><input type="button" class="childselectbutton button_flat_blue_small" name='child8select' id='child8select' value='Child 8'></div>
            </div>
            <div class="small-screen-alert badge badge-primary text-wrap" style="width: 100%;">small screen? scroll or rotate device</div>
        </div>

<!-- CHILD 1 EDIT -->
<div id="child1edit" class="table-responsive">
    <table border='0' cellpadding='3' cellspacing='1'>
    <div class="border border-light p-2">
            <div class="md-form">
                <div class="h1-responsive lead text-center">CHILD 1</div>
                <div class="h6-responsive red-text font-weight-bold text-center">REMEMBER: click Save Changes before moving to next child</div>
            </div>
    </div>
    <div class="modaleditform text-center border border-light p-2">
        <div class="table-responsive">
            <div class="row">
                <div class="col-3">
                    <label for="child1_name">Name:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter name" type="text" id="child1_name" name='child1_name' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child1_bday">Birthday:</label>
                </div>
                <div class="col-9">
                    <input type="date" id="child1_bday" name='child1_bday' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child1_gender">Gender:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child1_gender" id="child1_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child1_email">Email:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter email address (if applicable)" type="text" id="child1_email" name='child1_email' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child1_school">School:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child1_school" id="child1_school">
                        <?php
                            $schools_query = "SELECT * from " . $_SESSION['localschools'] . " order by school_name";
                            $schoolsresult = $mysql->query($schools_query) or die(" SQL query error looking up local schools. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($schools_row = $schoolsresult->fetch_assoc())
                            {
                                $schools_optionvalue = $schools_row['school_name'];
                                $selectedschool = $schools_row['school_name'];		
                                echo "<option value='" . $schools_optionvalue . "'";
                                if($selectedschool == $record_1_School)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $schools_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child1_grade">Grade:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child1_grade" id="child1_grade">
                        <?php
                            $grades_query = "SELECT * from " . $_SESSION['gradestablename'] . " order by display_order";
                            $gradesresult = $mysql->query($grades_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($grades_row = $gradesresult->fetch_assoc())
                            {
                                $grades_optionvalue = $grades_row['grades_abbr'] . " - " . $grades_row['grades_name'];
                                $selectedgrade = $grades_row['grades_abbr'];		
                                echo "<option value='" . $grades_optionvalue . "'";
                                if($selectedgrade == $record_1_Grade)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $grades_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <tr>
            <td><br /></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" align='right'>
                <button type="submit" name="submit1children" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="remove1children" id="remove1child" class="btn btn-danger">Delete Child</button> 
            </td>
        </tr>
    </div>
    </table> <!-- child1edit -->
</div>
<!-- CHILD 2 EDIT -->
<div id="child2edit" class="table-responsive">
    <table border='0' cellpadding='3' cellspacing='1'>
    <div class="border border-light p-2">
            <div class="md-form">
                <div class="h1-responsive lead text-center">CHILD 2</div>
                <div class="h6-responsive red-text font-weight-bold text-center">REMEMBER: click Save Changes before moving to next child</div>
            </div>
    </div>
    <div class="modaleditform text-center border border-light p-2">
        <div class="table-responsive">                                          
            <div class="row">
                <div class="col-3">
                    <label for="child2_name">Name:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter name" type="text" id="child2_name" name='child2_name' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child2_bday">Birthday:</label>
                </div>
                <div class="col-9">
                    <input type="date" id="child2_bday" name='child2_bday' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child2_gender">Gender:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child2_gender" id="child2_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child2_email">Email:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter email address (if applicable)" type="text" id="child2_email" name='child2_email' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child2_school">School:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child2_school" id="child2_school">
                        <?php
                            $schools_query = "SELECT * from " . $_SESSION['localschools'] . " order by school_name";
                            $schoolsresult = $mysql->query($schools_query) or die(" SQL query error looking up local schools. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($schools_row = $schoolsresult->fetch_assoc())
                            {
                                $schools_optionvalue = $schools_row['school_name'];
                                $selectedschool = $schools_row['school_name'];		
                                echo "<option value='" . $schools_optionvalue . "'";
                                if($selectedschool == $record_2_School)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $schools_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child2_grade">Grade:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child2_grade" id="child2_grade">
                        <?php
                            $grades_query = "SELECT * from " . $_SESSION['gradestablename'] . " order by display_order";
                            $gradesresult = $mysql->query($grades_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($grades_row = $gradesresult->fetch_assoc())
                            {
                                $grades_optionvalue = $grades_row['grades_abbr'] . " - " . $grades_row['grades_name'];
                                $selectedgrade = $grades_row['grades_abbr'];		
                                echo "<option value='" . $grades_optionvalue . "'";
                                if($selectedgrade == $record_2_Grade)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $grades_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <tr>
            <td><br /></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" align='right'>
                <button type="submit" name="submit2children" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="remove2children" id="remove2child" class="btn btn-danger">Delete Child</button> 
            </td>
        </tr>
    </div>
    </table> <!-- child2edit -->
</div>
<!-- CHILD 3 EDIT -->
<div id="child3edit" class="table-responsive">
    <table border='0' cellpadding='3' cellspacing='1'>
    <div class="border border-light p-2">
            <div class="md-form">
                <div class="h1-responsive lead text-center">CHILD 3</div>
                <div class="h6-responsive red-text font-weight-bold text-center">REMEMBER: click Save Changes before moving to next child</div>
            </div>
    </div>
    <div class="modaleditform text-center border border-light p-2">
        <div class="table-responsive">                                          
            <div class="row">
                <div class="col-3">
                    <label for="child3_name">Name:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter name" type="text" id="child3_name" name='child3_name' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child3_bday">Birthday:</label>
                </div>
                <div class="col-9">
                    <input type="date" id="child3_bday" name='child3_bday' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child3_gender">Gender:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child3_gender" id="child3_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child3_email">Email:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter email address (if applicable)" type="text" id="child3_email" name='child3_email' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child3_school">School:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child3_school" id="child3_school">
                        <?php
                            $schools_query = "SELECT * from " . $_SESSION['localschools'] . " order by school_name";
                            $schoolsresult = $mysql->query($schools_query) or die(" SQL query error looking up local schools. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($schools_row = $schoolsresult->fetch_assoc())
                            {
                                $schools_optionvalue = $schools_row['school_name'];
                                $selectedschool = $schools_row['school_name'];		
                                echo "<option value='" . $schools_optionvalue . "'";
                                if($selectedschool == $record_3_School)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $schools_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child3_grade">Grade:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child3_grade" id="child3_grade">
                        <?php
                            $grades_query = "SELECT * from " . $_SESSION['gradestablename'] . " order by display_order";
                            $gradesresult = $mysql->query($grades_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($grades_row = $gradesresult->fetch_assoc())
                            {
                                $grades_optionvalue = $grades_row['grades_abbr'] . " - " . $grades_row['grades_name'];
                                $selectedgrade = $grades_row['grades_abbr'];		
                                echo "<option value='" . $grades_optionvalue . "'";
                                if($selectedgrade == $record_3_Grade)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $grades_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <tr>
            <td><br /></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" align='right'>
                <button type="submit" name="submit3children" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="remove3children" id="remove3child" class="btn btn-danger">Delete Child</button> 
            </td>
        </tr>
    </div>
    </table> <!-- child3edit -->
</div>
<!-- CHILD 4 EDIT -->
<div id="child4edit" class="table-responsive">
    <table border='0' cellpadding='3' cellspacing='1'>
    <div class="border border-light p-2">
            <div class="md-form">
                <div class="h1-responsive lead text-center">CHILD 4</div>
                <div class="h6-responsive red-text font-weight-bold text-center">REMEMBER: click Save Changes before moving to next child</div>
            </div>
    </div>
    <div class="modaleditform text-center border border-light p-2">
        <div class="table-responsive">                                          
            <div class="row">
                <div class="col-3">
                    <label for="child4_name">Name:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter name" type="text" id="child4_name" name='child4_name' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child4_bday">Birthday:</label>
                </div>
                <div class="col-9">
                    <input type="date" id="child4_bday" name='child4_bday' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child4_gender">Gender:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child4_gender" id="child4_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child4_email">Email:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter email address (if applicable)" type="text" id="child4_email" name='child4_email' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child4_school">School:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child4_school" id="child4_school">
                        <?php
                            $schools_query = "SELECT * from " . $_SESSION['localschools'] . " order by school_name";
                            $schoolsresult = $mysql->query($schools_query) or die(" SQL query error looking up local schools. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($schools_row = $schoolsresult->fetch_assoc())
                            {
                                $schools_optionvalue = $schools_row['school_name'];
                                $selectedschool = $schools_row['school_name'];		
                                echo "<option value='" . $schools_optionvalue . "'";
                                if($selectedschool == $record_4_School)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $schools_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child4_grade">Grade:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child4_grade" id="child4_grade">
                        <?php
                            $grades_query = "SELECT * from " . $_SESSION['gradestablename'] . " order by display_order";
                            $gradesresult = $mysql->query($grades_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($grades_row = $gradesresult->fetch_assoc())
                            {
                                $grades_optionvalue = $grades_row['grades_abbr'] . " - " . $grades_row['grades_name'];
                                $selectedgrade = $grades_row['grades_abbr'];		
                                echo "<option value='" . $grades_optionvalue . "'";
                                if($selectedgrade == $record_4_Grade)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $grades_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <tr>
            <td><br /></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" align='right'>
                <button type="submit" name="submit4children" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="remove4children" id="remove4child" class="btn btn-danger">Delete Child</button> 
            </td>
        </tr>
    </div>
    </table> <!-- child4edit -->
</div>
<!-- CHILD 5 EDIT -->
<div id="child5edit" class="table-responsive">
    <table border='0' cellpadding='3' cellspacing='1'>
    <div class="border border-light p-2">
            <div class="md-form">
                <div class="h1-responsive lead text-center">CHILD 5</div>
                <div class="h6-responsive red-text font-weight-bold text-center">REMEMBER: click Save Changes before moving to next child</div>
            </div>
    </div>
    <div class="modaleditform text-center border border-light p-2">
        <div class="table-responsive">                                          
            <div class="row">
                <div class="col-3">
                    <label for="child5_name">Name:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter name" type="text" id="child5_name" name='child5_name' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child5_bday">Birthday:</label>
                </div>
                <div class="col-9">
                    <input type="date" id="child5_bday" name='child5_bday' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child5_gender">Gender:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child5_gender" id="child5_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child5_email">Email:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter email address (if applicable)" type="text" id="child5_email" name='child5_email' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child5_school">School:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child5_school" id="child5_school">
                        <?php
                            $schools_query = "SELECT * from " . $_SESSION['localschools'] . " order by school_name";
                            $schoolsresult = $mysql->query($schools_query) or die(" SQL query error looking up local schools. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($schools_row = $schoolsresult->fetch_assoc())
                            {
                                $schools_optionvalue = $schools_row['school_name'];
                                $selectedschool = $schools_row['school_name'];		
                                echo "<option value='" . $schools_optionvalue . "'";
                                if($selectedschool == $record_5_School)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $schools_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child5_grade">Grade:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child5_grade" id="child5_grade">
                        <?php
                            $grades_query = "SELECT * from " . $_SESSION['gradestablename'] . " order by display_order";
                            $gradesresult = $mysql->query($grades_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($grades_row = $gradesresult->fetch_assoc())
                            {
                                $grades_optionvalue = $grades_row['grades_abbr'] . " - " . $grades_row['grades_name'];
                                $selectedgrade = $grades_row['grades_abbr'];		
                                echo "<option value='" . $grades_optionvalue . "'";
                                if($selectedgrade == $record_5_Grade)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $grades_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <tr>
            <td><br /></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" align='right'>
                <button type="submit" name="submit5children" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="remove5children" id="remove5child" class="btn btn-danger">Delete Child</button> 
            </td>
        </tr>
    </div>
    </table> <!-- child5edit -->
</div>
<!-- CHILD 6 EDIT -->
<div id="child6edit" class="table-responsive">
    <table border='0' cellpadding='3' cellspacing='1'>
    <div class="border border-light p-2">
            <div class="md-form">
                <div class="h1-responsive lead text-center">CHILD 6</div>
                <div class="h6-responsive red-text font-weight-bold text-center">REMEMBER: click Save Changes before moving to next child</div>
            </div>
    </div>
    <div class="modaleditform text-center border border-light p-2">
        <div class="table-responsive">                                          
            <div class="row">
                <div class="col-3">
                    <label for="child6_name">Name:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter name" type="text" id="child6_name" name='child6_name' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child6_bday">Birthday:</label>
                </div>
                <div class="col-9">
                    <input type="date" id="child6_bday" name='child6_bday' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child6_gender">Gender:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child6_gender" id="child6_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child6_email">Email:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter email address (if applicable)" type="text" id="child6_email" name='child6_email' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child6_school">School:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child6_school" id="child6_school">
                        <?php
                            $schools_query = "SELECT * from " . $_SESSION['localschools'] . " order by school_name";
                            $schoolsresult = $mysql->query($schools_query) or die(" SQL query error looking up local schools. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($schools_row = $schoolsresult->fetch_assoc())
                            {
                                $schools_optionvalue = $schools_row['school_name'];
                                $selectedschool = $schools_row['school_name'];		
                                echo "<option value='" . $schools_optionvalue . "'";
                                if($selectedschool == $record_6_School)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $schools_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child6_grade">Grade:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child6_grade" id="child6_grade">
                        <?php
                            $grades_query = "SELECT * from " . $_SESSION['gradestablename'] . " order by display_order";
                            $gradesresult = $mysql->query($grades_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($grades_row = $gradesresult->fetch_assoc())
                            {
                                $grades_optionvalue = $grades_row['grades_abbr'] . " - " . $grades_row['grades_name'];
                                $selectedgrade = $grades_row['grades_abbr'];		
                                echo "<option value='" . $grades_optionvalue . "'";
                                if($selectedgrade == $record_6_Grade)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $grades_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <tr>
            <td><br /></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" align='right'>
                <button type="submit" name="submit6children" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="remove6children" id="remove6child" class="btn btn-danger">Delete Child</button> 
            </td>
        </tr>
    </div>
    </table> <!-- child6edit -->
</div>
<!-- CHILD 7 EDIT -->
<div id="child7edit" class="table-responsive">
    <table border='0' cellpadding='3' cellspacing='1'>
    <div class="border border-light p-2">
            <div class="md-form">
                <div class="h1-responsive lead text-center">CHILD 7</div>
                <div class="h6-responsive red-text font-weight-bold text-center">REMEMBER: click Save Changes before moving to next child</div>
            </div>
    </div>
    <div class="modaleditform text-center border border-light p-2">
        <div class="table-responsive">                                          
            <div class="row">
                <div class="col-3">
                    <label for="child7_name">Name:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter name" type="text" id="child7_name" name='child7_name' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child7_bday">Birthday:</label>
                </div>
                <div class="col-9">
                    <input type="date" id="child7_bday" name='child7_bday' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child7_gender">Gender:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child7_gender" id="child7_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child7_email">Email:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter email address (if applicable)" type="text" id="child7_email" name='child7_email' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child7_school">School:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child7_school" id="child7_school">
                        <?php
                            $schools_query = "SELECT * from " . $_SESSION['localschools'] . " order by school_name";
                            $schoolsresult = $mysql->query($schools_query) or die(" SQL query error looking up local schools. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($schools_row = $schoolsresult->fetch_assoc())
                            {
                                $schools_optionvalue = $schools_row['school_name'];
                                $selectedschool = $schools_row['school_name'];		
                                echo "<option value='" . $schools_optionvalue . "'";
                                if($selectedschool == $record_7_School)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $schools_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child7_grade">Grade:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child7_grade" id="child7_grade">
                        <?php
                            $grades_query = "SELECT * from " . $_SESSION['gradestablename'] . " order by display_order";
                            $gradesresult = $mysql->query($grades_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($grades_row = $gradesresult->fetch_assoc())
                            {
                                $grades_optionvalue = $grades_row['grades_abbr'] . " - " . $grades_row['grades_name'];
                                $selectedgrade = $grades_row['grades_abbr'];		
                                echo "<option value='" . $grades_optionvalue . "'";
                                if($selectedgrade == $record_7_Grade)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $grades_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <tr>
            <td><br /></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" align='right'>
                <button type="submit" name="submit7children" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="remove7children" id="remove7child" class="btn btn-danger">Delete Child</button> 
            </td>
        </tr>
    </div>
    </table> <!-- child7edit -->
</div>
<!-- CHILD 8 EDIT -->
<div id="child8edit" class="table-responsive">
    <table border='0' cellpadding='3' cellspacing='1'>
    <div class="border border-light p-2">
            <div class="md-form">
                <div class="h1-responsive lead text-center">CHILD 8</div>
                <div class="h6-responsive red-text font-weight-bold text-center">REMEMBER: click Save Changes before moving to next child</div>
            </div>
    </div>
    <div class="modaleditform text-center border border-light p-2">
        <div class="table-responsive">                                          
            <div class="row">
                <div class="col-3">
                    <label for="child8_name">Name:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter name" type="text" id="child8_name" name='child8_name' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child8_bday">Birthday:</label>
                </div>
                <div class="col-9">
                    <input type="date" id="child8_bday" name='child8_bday' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child8_gender">Gender:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child8_gender" id="child8_gender">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child8_email">Email:</label>
                </div>
                <div class="col-9">
                    <input placeholder="Enter email address (if applicable)" type="text" id="child8_email" name='child8_email' class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child8_school">School:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child8_school" id="child8_school">
                        <?php
                            $schools_query = "SELECT * from " . $_SESSION['localschools'] . " order by school_name";
                            $schoolsresult = $mysql->query($schools_query) or die(" SQL query error looking up local schools. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($schools_row = $schoolsresult->fetch_assoc())
                            {
                                $schools_optionvalue = $schools_row['school_name'];
                                $selectedschool = $schools_row['school_name'];		
                                echo "<option value='" . $schools_optionvalue . "'";
                                if($selectedschool == $record_8_School)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $schools_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="child8_grade">Grade:</label>
                </div>
                <div class="col-9">
                    <select class="custom-select" name="child8_grade" id="child8_grade">
                        <?php
                            $grades_query = "SELECT * from " . $_SESSION['gradestablename'] . " order by display_order";
                            $gradesresult = $mysql->query($grades_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                            while($grades_row = $gradesresult->fetch_assoc())
                            {
                                $grades_optionvalue = $grades_row['grades_abbr'] . " - " . $grades_row['grades_name'];
                                $selectedgrade = $grades_row['grades_abbr'];		
                                echo "<option value='" . $grades_optionvalue . "'";
                                if($selectedgrade == $record_8_Grade)
                                {
                                    echo " selected='selected'";
                                }
                                echo ">" . $grades_optionvalue . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <tr>
            <td><br /></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" align='right'>
                <button type="submit" name="submit8children" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" name="remove8children" id="remove8child" class="btn btn-danger">Delete Child</button> 
            </td>
        </tr>
    </div>
    </table> <!-- child8edit -->
</div>

                <p>
                <p>
            </td>
        </tr>
    </table> <!--  editchildrentable -->
    </div>
</form>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>

  <!-- SCRIPTS -->
<!-- JQuery -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- NEW Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


  <!-- OLD Bootstrap tooltips -->
  <!-- <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script> -->
  <!-- Bootstrap core JavaScript -->
  <!-- <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script> -->
  <!-- MDB core JavaScript -->
  <!-- <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script> -->
  <!-- Tenant Configuration JavaScript Call in tec_nav -->
  <!-- Datatables JavaScript plugins -->
    <!-- Jan31 Attempt -->
    <!-- Copied from https://www.datatables.net/download/index -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.7/datatables.min.js"></script>
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

  <!-- Call config details based on Tenant Config info -->
  <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
  <!-- Call Image Verify jQuery script -->
  <script src="js/image_verify.js"></script>
  <!-- Setup for child delete script -->
  <script type="text/javascript" src="/js/tec_profile_children_delete.js"></script>

</body>
</html>