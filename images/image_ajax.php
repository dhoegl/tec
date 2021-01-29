<?php
// Insert profile photo into file system - called from image_verify.js
// NOTE: profile photo files are pre-pended with user's family profile ID ($_SESSION['IDdirectory']) + hyphen (e.g. 157-photo.jpg)

	require_once('tec_dbconnect.php');

	if(isset($_FILES["file"]["type"]))
	{
        echo "<script language='javascript'>";
        echo "console.log('Image file + type sent to image_ajax.php');";
        echo "</script>";
        $validextensions = array("bmp", "BMP", "jpeg", "JPEG", "jpg", "JPG", "png", "PNG");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		if ((($_FILES["file"]["type"] == "image/bmp") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg"))
			&& ($_FILES["file"]["size"] < 2000000)//Approx. 2MB files can be uploaded.
			&& in_array($file_extension, $validextensions))
		{
            echo "<script language='javascript'>";
            echo "console.log('Correct Image file type has been selected - image_ajax.php');";
            echo "</script>";

            if ($_FILES["file"]["error"] > 0)
			{
                echo "<script language='javascript'>";
                echo "console.log('Return Code error: ' . $_FILES . ' - image_ajax.php');";
                echo "</script>";
				echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
			}
				else
				{
					if (file_exists("profile_img/" . $_FILES["file"]["name"])) {
                        echo "<script language='javascript'>";
                        echo "console.log('Image file already exists - image_ajax.php');";
                        echo "</script>";
						echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
						}
						else
						{
							$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
							$targetfile = $_SESSION["Famview_Profile"] . "-" . $_FILES['file']['name'];
							$targetPath = "profile_img/" . $targetfile; // Target path + filename where file is to be stored (e.g. profile_img/157-photoname.png)
							move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
							echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
							echo "<br/><b>File Name:</b> " . $_SESSION["Famview_Profile"] . "-" . $_FILES["file"]["name"] . "<br>";
							echo "Profile address = " . $_SESSION["Famview_Profile"] . "<br />";
							//echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
							//echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
							//echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
							$dirpicupdate = "UPDATE " . $_SESSION['dirtablename'] . " SET ProfilePhoto_New = '" . $targetfile . "' WHERE idDirectory = '" . $_SESSION["Famview_Profile"] . "'";
							//$dirquery = "SELECT ProfilePhoto_New FROM $dir_tbl_name WHERE idDirectory = '" . $_SESSION['Famview_Profile'] . "'";
							$dirresult = $mysql->query($dirpicupdate) or die(" SQL query error on profile image_ajax Directory update. Error:" . mysql_errno() . " " . mysql_error());
							//$count = @mysql_num_rows($dirresult);
							//$dirrow = @mysql_fetch_assoc($dirresult);
							//$profilephoto = $dirrow['ProfilePhoto_New'];
							//echo "profile photo name = " . $profilephoto . "<br />";

						}
				}
		}
							else
							{
								echo "<span id='invalid'>***Invalid file Size or Type***<span>";
							}
	}
?>