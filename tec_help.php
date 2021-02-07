<?php
//Last Updated 02/06/2021: Help Page for tec.ourfamilyconnections.org
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
$sessname = session_name();
$sessid = session_id();
$profileID = $_SESSION['idDirectory'];
require_once('tec_dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- BOOTSTRAP 4 - Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>

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
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
    <!-- Test custom styles (Includes tec style details) -->
    <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">

    <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


    <!-- Call Moment js for date calc functions -->
    <script src="js/moment.js"></script>
    <!-- JQuery -->
    <!-- <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.1.0.min.js"></script>
</head>

<body>
    <!--Navbar-->
    <?php
    $activeparam = '10'; // sets nav element highlight
    require_once('tec_nav.php');
    require_once('includes/tec_footer.php');
    ?>
    <!-- Intro Section -->
    <div class="container-fluid profile_bg bottom-buffer" id="backsplash">
        <div class="row pt-2">
            <div class="col-sm-12">
                <p>
                    
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-image"
                    style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                    <!-- Content -->
                    <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                        <div class="w-100">
                            <h3 class="card-title pt-2"><strong>WE'RE HERE TO HELP!</strong></h3>
                            <p>Here are some tips and tricks to help you learn more about our site.</p>
                        </div>
                    </div>
            </div><!-- Card -->
            </div><!-- Col-md-12 -->
        </div><!-- Row -->
<!-- ******************************* Help Topics card ************************************** -->
        <div class="row pt-2">
            <div class="col-xs-12 col-sm-6 col-lg-6">
                <div class="card bg-light border-primary p-3 mt-2 my-2">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold">HELP TOPICS</h4>
                        <h6 class="card-text font-weight-bold my-2">Navigating the Directory site</h6>
                        <p class="card-text">Our comprehensive Help Guide is the first place to go to find out how to navigate our site. </p>
                        <button class="btn btn-primary" onclick="window.location.href='User_Guide_Navigating_the_new_TEC_Directory.pdf';">
                            Click here to view the Help Guide
                        </button>
                        <h6 class="card-text font-weight-bold mt-4 my-2">Frequently Asked Questions</h6>
                        <p class="card-text">You may find what you're after by taking a look at these topics. Just tap on the question for an answer. Stay tuned for more questions as they come in!</p>

                        <div class="faq_container">
				            <div class="faq">
					            <div class="faq_question">Where do I go to download a printable directory?</div>
						        <div class="faq_answer_container">
							        <div class="faq_answer">Go to the <a href="tec_family.php">Directory</a> page and click on the blue button at the top-left of the page. You will find both a PDF version of the directory and a CSV version to copy into your favorite spreadsheet.</div>
                                </div>
                                <hr style="height:2px; color: DarkOrange">		
				            </div>
				            <div class="faq">
					            <div class="faq_question">Is there a way to print out the calendar?</div>
						        <div class="faq_answer_container">
							        <div class="faq_answer">Not at this time - stay tuned!</div>
                                </div>
                                <hr style="width:50%;text-align:left;margin-left:0">
                            </div>
				            <div class="faq">
					            <div class="faq_question">Who do I contact if I have questions or need more details on how to use this site?</div>
						        <div class="faq_answer_container">
							        <div class="faq_answer">A Contact Form is being developed - in the mean-time, reach out to <a href="mailto:firebird@hoeglund.com">Dan Hoeglund</a>.</div>
						        </div>		
				            </div>
			            </div>

                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div><!--col-xs-6-->
            <div class="col-xs-12 col-sm-6 col-lg-6">
                <div class="card bg-light border-primary p-3 mt-2 my-2">
                    <div class="card-body">
        <!--Section: Contact Form-->
        <section class="section contactus">
            <!--Section heading-->
            <h4 class="section-heading font-weight-bold">CONTACT US</h4>
                        <!-- <h4 class="card-title font-weight-bold">CONTACT US</h4>
                        <h6 class="card-text font-weight-bold my-2">Use the form below to send an email to our team. You should get a response within 24-48 hours.</h6>
                        <p class="card-text">Our comprehensive Help Guide is the first place to go to find out how to navigate our site. </p> -->




            <!--Section description-->
            <p class="section-description">Use the form below to send an email to our team. You should get a response within 24-48 hours.</p>
            <div class="row">
                <!--Grid column-->
                <div class="col-12">
                    <form class="text-center border border-dark p-2" id ="contact-form" name="contact-form" action="contactus_mail_engine.php" method="POST"  onsubmit="return validateForm()" >
                    <div class="text-center border border-dark p-2" id="contactusform">
                        <!--Grid row-->
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="md-form">
                                    <div class="md-form">
                                        <input type="text" id="name" name="name" class="form-control">
                                        <label for="name" class="">Your name</label>
                                    </div>
                                </div>
                            </div>
                            <!--Grid column-->
                            </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="md-form">
                                    <div class="md-form">
                                        <input type="text" id="email" name="email" class="form-control">
                                        <label for="email" class="">Your email</label>
                                    </div>
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form">
                                    <input type="text" id="subject" name="subject" class="form-control">
                                    <label for="subject" class="">Subject</label>
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form">
                                    <!-- <textarea type="text" id="message" name="message" class="md-textarea"></textarea> -->
                                    <textarea type="text" id="message" name="message" class="form-control"></textarea>
                                    <label for="message" class="">Your message</label>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->
                        </div>

                    </form>

                    <div class="center-on-small-only">
                        <a class="btn btn-primary" onclick="validateForm()">Send</a>
                    </div> <div class="status" id="status"></div>
                </div>
                <!--Grid column-->
            </div>

            </div> <!-- card-body -->
                </div> <!-- card -->
            </div><!--col-xs-6-->
        </div><!-- row -->

        </section>
        <!--Section: Contact Form-->



    </div><!-- Container -->

<!-- Validate Contact Us email submission -->    
<script>
function validateForm() {
    var x =  document.getElementById('name').value;
    if (x == "") {
        document.getElementById('status').innerHTML = "Name cannot be empty";
        return false;
    }
    x =  document.getElementById('email').value;
    if (x == "") {
        document.getElementById('status').innerHTML = "Email cannot be empty";
        return false;
    } else {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(x)){
            document.getElementById('status').innerHTML = "Email format invalid";
            return false;
        }
    }
    x =  document.getElementById('subject').value;
    if (x == "") {
        document.getElementById('status').innerHTML = "Subject cannot be empty";
        return false;
    }
    x =  document.getElementById('message').value;
    if (x == "") {
        document.getElementById('status').innerHTML = "Message cannot be empty";
        return false;
    }
    var jQContactUs = jQuery.noConflict();
 //get input field values data to be sent to server
    document.getElementById('status').innerHTML = "Sending...";
    formData = {
        'name'     : jQContactUs('input[name=name]').val(),
        'email'    : jQContactUs('input[name=email]').val(),
        'subject'  : jQContactUs('input[name=subject]').val(),
        'message'  : jQContactUs('textarea[name=message]').val()
    };

    jQContactUs.ajax({
    url : "contactus_mail_engine.php",
    type: "POST",
    data : formData,
    success: function(data, textStatus, jqXHR)
    {

        jQContactUs('#status').text(data.message);
        if (data.code) //If mail was sent successfully, reset the form.
        jQContactUs('#contact-form').closest('form').find("input[type=text], textarea").val("");
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        jQContactUs('#status').text(jqXHR);
    }
});
}
    </script>


<script> // FAQ Jquery code
jQuery(document).ready(function($)  {

	$('.faq_question').click(function() {

		if ($(this).parent().is('.open')){
			$(this).closest('.faq').find('.faq_answer_container').animate({'height':'0'},500);
			$(this).closest('.faq').removeClass('open');

			}else{
				var newHeight =$(this).closest('.faq').find('.faq_answer').height() +'px';
				$(this).closest('.faq').find('.faq_answer_container').animate({'height':newHeight},500);
				$(this).closest('.faq').addClass('open');
			}

	});
	

});
</script>
    <!-- JS SCRIPTS -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <!-- Datatables JavaScript plugins - Bootstrap-specific -->
    <!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/r-2.2.6/datatables.min.js"></script>
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
    <!-- Call Image Verify jQuery script -->
    <script src="js/image_verify.js"></script>
</body>
</html>

