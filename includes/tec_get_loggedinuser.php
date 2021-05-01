<script type="text/javascript">
var $loggedusername = 'NA';
var $loggedidDirectory = 'NA';
var $loggedaccesslevel = 'NA';
	var jQ21 = jQuery.noConflict();
	jQ21(document).ready(function () {
		$loggedusername = <?php echo '"' . $_SESSION['username'] . '"'; ?>;
		$loggedidDirectory = <?php echo '"' . $_SESSION['idDirectory'] . '"'; ?>;
		$loggedinLoginID = <?php echo '"' . $_SESSION['user_id'] . '"'; ?>;
		$loggedaccesslevel = <?php echo '"' . $_SESSION['accesslevel'] . '"'; ?>;
		console.log("Logged in User: " + $loggedusername);
		console.log("Logged in Directory ID: " + $loggedidDirectory);
		console.log("Logged in Access Level: " + $loggedaccesslevel);
	});
</script>
