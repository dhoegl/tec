<?php
//tec_getchildlist captures children from selected profile. Called from tec_profile.php and tec_view_childlist.php
// Last Update: 12/24/2020
    session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('../tec_dbconnect.php');

//ProfileID is captured when called from tec_profile.php to identify family's children 

if (isset($_GET['profile_id']) )
{
    $profileID = $_GET['profile_id'];

}

/*Query active directory listing: status = 1 */
$activefamilyquery = $mysql->query("SELECT * FROM " . $_SESSION['childtablename'] . " WHERE idDirectory = " . $profileID) or die(" SQL query error at active family list. Error:" . $mysql->errno . " : " . $mysql->error);
    $activefamilycount = $activefamilyquery->num_rows;

		$listarray = array();

		if ($activefamilycount == 0)
		{
            $buildjson = array("no children", " ", " ", " ", " ", " ", " ", " ", );
            array_push($listarray, $buildjson);
            $listarray = array('data' => $listarray);
            echo json_encode($listarray);
            exit;
		}

        while($activerow = $activefamilyquery->fetch_assoc())
        {
            $childcontrol = "<tr><td></td>";
            // $childcontrol = ' ';
            $childname = "<td>" . $activerow['Name'] . "</td>";
            // $childname = $activerow['Name'];
            $birth = date_create($activerow['Birthdate']);
            $childbirthformat = date_format($birth,"M d, Y");
            $childbirth = "<td>" . $childbirthformat . "</td>";
            // $childbirth = "<td>" . $activerow['Birthdate'] . "</td>";
            // $childbirth = $activerow['Birthdate'];
            // $olddate = str_replace('-"', '/', $childbirth);  
            // $childbirth = date("m/d/Y", strtotime($olddate));  
            $childgender = "<td>" . $activerow['Gender'] . "</td>";
            // $childgender = $activerow['Gender'];
            $childage = "<td>" . floor((time() - strtotime($activerow['Birthdate'])) / 31556926) . "</td>";
            // $childage = floor((time() - strtotime($childbirth)) / 31556926);
            $childemail = "<td>" . $activerow['Email'] . "</td>";
            // $childemail = $activerow['Email'];
            $childschool = "<td>" . $activerow['School'] . "</td>";
            // $childschool = $activerow['School'];
            $childgrade = "<td>" . $activerow['Grade'] . "</td></tr>";
            // $childgrade = $activerow['Grade'];

            $buildjson = array($childcontrol, $childname, $childbirth, $childgender, $childage, $childemail, $childschool, $childgrade);
            array_push($listarray, $buildjson);
		}

        $listarray = array('data' => $listarray);

        header('Content-type: application/json');
        echo json_encode($listarray);


?>


