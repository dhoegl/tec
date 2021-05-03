<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
/* Get email address of selected registrant - called from tec_regadmin.php */
    require_once('tec_dbconnect.php');
    
	if ( !isset($_GET['registrantID'])) {
		 echo 'Required data is missing';
		 return;
	}
	else {
		$registrantID = $_GET['registrantID'];
	?>    
		<script language='javascript'>
			console.log('registrantID : ' + '<?php echo $registrantID; ?>')
		</script>
	<?php
		$registrantquery = "SELECT login_ID, email_addr FROM " . $_SESSION['logintablename'] . " login_ID = '" . $registrantID . "'";
		$registrantresult = $mysql->query($registrantquery) or die(" SQL query Get Email Address error. Error:" . $mysql->errno . " " . $mysql->error);
		$registrantcount = $registrantresult->num_rows;
		$registrantarray = array();
		while($registrantrow = $registrantresult->fetch_assoc()) {
			$registrantIDfromSelect = $registrantrow['login_ID'];
			$registrantemail = $registrantrow['email_addr'];
			$buildjson = array('registrantid' => $registrantIDfromSelect, 'registrantemail' => $registrantemail);
			array_push($registrantarray, $buildjson);
			}
			$registrantarray = array('registrantdata' => $registrantarray);
			header('Content-type: application/json');
			echo json_encode($registrantarray); 
		}

?>

