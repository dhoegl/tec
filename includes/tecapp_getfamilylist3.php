<?php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('../tecapp_dbconnect.php');
//    echo "<script language='javascript'>";
//    echo "console.log('ARRIVED at getfamilylist2');";
//    echo "</script>";

/*Query active directory listing: status = 1  */
   $activefamilyquery = $mysql->query("SELECT * FROM " . $_SESSION['dirtablename'] . " WHERE Status = 1") or die(" SQL query error at active family list. Error:" . $mysql->errno . " : " . $mysql->error);
    $activefamilycount = $activefamilyquery->num_rows;

		$listarray = array();

		if ($activefamilycount == 0)
		{
            $buildjson = array("no data", " ", " ", " ", " ", );
            array_push($listarray, $buildjson);
            $listarray = array('data' => $listarray);
            echo json_encode($listarray);
            exit;
		}

        while($activerow = $activefamilyquery->fetch_assoc())
        {
    //		echo "<tr><td><img src=imageview.php width='25' height='25'>"."</td>";
            if(!$activerow['Internet_Restrict'])
            {
                //echo "<tr><td>" . "<a href='/ofc_profile.php?id=" . $activerow['idDirectory'] . "'>view</a>"."</td>";
                //echo "<tr><td><button type='button' class='btn btn-success'>View</button></td>";
                $familyprofile = $activerow['idDirectory'];

                // echo "<tr><td><a class='btn btn-success' href='/tecapp_profile.php?id=" . $activerow['idDirectory'] . "'>View</a></td>";
            }
            else 
            {
                // echo "<tr><td>" . "view" . "</td>";
            }
            $familyname = $activerow['Surname'] . $activerow['Name_1'] . $activerow['Name_2'];
		    // echo "<td><strong>" . $activerow['Surname'] . "</strong><br>$nbsp" . $activerow['Name_1'] . "<br>$nbsp" . $activerow['Name_2'] . "</td>";
            if(!$activerow['Internet_Restrict'])
            {
                if($activerow['City'] && $activerow['State'])
                {
                    $familyaddress = $activerow['Address'] . $activerow['Address2'] . $activerow['City'] . substr($activerow['State'],0,2) . $activerow['Zip'];
				    // $address = $activerow['Address'] . $activerow['Address2'] . "<br>" . $activerow['City'] . ", " . substr($activerow['State'],0,2) . " " . $activerow['Zip'];
				}
				else {
                    $familyaddress =$activerow['Address'] . $activerow['Address2'] . $activerow['City'] . substr($activerow['State'],0,2) . $activerow['Zip'];
					// $address = $activerow['Address'] . $activerow['Address2'] . "<br>" . $activerow['City'] . substr($activerow['State'],0,2) . " " . $activerow['Zip'];
					}
                $familyphone = $activerow['Phone_Home'] . $activerow['Phone_Cell1'] . $activerow['Phone_Cell2'];
                // $phone_detail = "H " . $activerow['Phone_Home'] . "<br>" . "M " . $activerow['Phone_Cell1'] . "<br>" . "W " . $activerow['Phone_Cell2'];
                $familyemail = $activerow['Email_1'] . $activerow['Email_2'] ;
                // $email_detail = "<br><a href='mailto:" . $activerow['Email_1'] . "'>" . $activerow['Email_1'] . "</a><br>" . "<a href='mailto:" . $activerow['Email_2'] . "'>" . $activerow['Email_2'] . "</a>";
			    }
                else
                {
                    $familyaddress = "";
                    // $address = "";
                    $familyphone = "";
				    // $phone_detail = "H<br>M<br>W";
                    $familyemail = "";
                    // $email_detail = "<br><br>";
				    }
		        // echo "<td>" . $address."</td>";
		        // echo "<td>" . $phone_detail."</td>";
		        // echo "<td>" . $email_detail."</td></tr>";
                $buildjson = array($familyprofile, $familyname, $familyaddress, $familyphone, $familyemail);
                array_push($listarray, $buildjson);
		    }

        $listarray = array('data' => $listarray);

        header('Content-type: application/json');
        echo json_encode($listarray);


?>
