//validates profile image upload during profile edit
//Called from tec_profile
	var jQ200 = jQuery.noConflict();
	jQ200(document).ready(function (e) {
		jQ200("#uploadImage").on('submit',(function(e)
			{
				e.preventDefault();
				jQ200("#message").empty();
				jQ200('#loading').show();
				console.log("Made it to image_verify.js");
				jQ200.ajax({
					url: "image_ajax.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						jQ200('#loading').hide();
						jQ200("#message").html(data);
						location.reload(true);
						}
				});
			}));

// Function to preview image after validation
jQ200(function() {
	jQ200("#file").change(function() {
		jQ200("#message").empty(); // To remove the previous error message
		var file = this.files[0];
		var imagefile = file.type;
		var match= ["image/bmp","image/jpeg","image/png","image/jpg"];
		console.log("Made it to image_verify change function");
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3])))
		{
			jQ200('#profile_pic_edit').attr('src','/profile_img/x.jpg');
			jQ200("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only bmp, jpg and png Images type allowed</span>");
			return false;
			}
			else
			{
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
				}
				});
	});

function imageIsLoaded(e) {
	jQ200("#file").css("color","green");
	console.log("Made it to image_verify imageIsLoaded function");
	jQ200('#image_preview').css("display", "block");
	jQ200('#profile_pic_edit').attr('src', e.target.result);
	jQ200('#profile_pic_edit').attr('width', '200px');
//	jQ200('#profile_pic_edit').attr('height', '133px');
	jQ200('#profile_pic_edit').attr('height', 'auto');
	};
});
