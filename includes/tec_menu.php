<?php
    echo "<script language='javascript'>";
    echo "console.log('activeparam  = " . $activeparam . "');";
    echo "</script>";
    if($activeparam == '1') //   $activeparam sets nav element highlight on Nav bar - originates on all pages to identify (by 'Active' class and bold text) which page is being displayed
    {
        echo "<script language='javascript'>";
        echo "console.log('activeparam  = 1');";
        echo "</script>";
        echo '<li class="nav-item active"><a class="nav-link" href="tec_home.php">Home</a></li>';
        echo '<li class="nav-item active" id="calendar_service"><a class="nav-link" href="ofc_calendar.php">Calendar</a></li>';
        echo '<li class="nav-item active" id="prayer_service"><a class="nav-link" href="ofc_prayer.php">Prayer</a></li>';
        echo '<li class="nav-item active" id="events_service"><a class="nav-link" href="#">Events</a></li>';
    }
    else
    {
        echo '<li class="nav-item"><a class="nav-link" href="tec_home.php">Home</a></li>';
    }
    if($activeparam == '2')
    {
        if($MyView == 'Y')
        {
            echo '<li class="nav-item active"><a class="nav-link" href="ofc_profile.php?id=' . $_SESSION['idDirectory'] . '">My Profile</a></li>';
        }
        else {
            echo '<li class="nav-item"><a class="nav-link" href="ofc_profile.php?id=' . $_SESSION['idDirectory'] . '">My Profile</a></li>';
            }
    }
    else
    {
        echo '<li class="nav-item"><a class="nav-link" href="ofc_profile.php?id=' . $_SESSION['idDirectory'] . '">My Profile</a></li>';
    }
    if($activeparam == '3' || ($activeparam == '2' && $MyView == 'N'))
    {
        echo '<li class="nav-item active" id="directory_service"><a class="nav-link" href="ofc_family.php">Directory</a></li>';
    }
    else
    {
        echo '<li class="nav-item" id="directory_service"><a class="nav-link" href="ofc_family.php">Directory</a></li>';
    }
    if($activeparam == '4')
    {
        echo '<li class="nav-item active" id="calendar_service"><a class="nav-link" href="ofc_calendar.php">Calendar</a></li>';
    }
    else
    {
        echo '<li class="nav-item" id="calendar_service"><a class="nav-link" href="ofc_calendar.php">Calendar</a></li>';
    }
    if($activeparam == '5')
    {
        echo '<li class="nav-item active" id="prayer_service"><a class="nav-link" href="ofc_prayer.php">Prayer</a></li>';
    }
    else
    {
        echo '<li class="nav-item" id="prayer_service"><a class="nav-link" href="ofc_prayer.php">Prayer</a></li>';
    }
    if($activeparam == '6')
    {
        echo '<li class="nav-item active" id="events_service"><a class="nav-link" href="#">Events</a></li>';
    }
    else
    {
        echo '<li class="nav-item" id="events_service"><a class="nav-link" href="#">Events</a></li>';
    }
    if($_SESSION['reg_admin'] == '1') {
        if($activeparam == '9')
        {
            echo '<li class="nav-item active"><a class="nav-link" href="ofc_regadmin.php">Registration Admin</a></li>';
        }
        else {
            echo '<li class="nav-item"><a class="nav-link" href="ofc_regadmin.php">Registration Admin</a></li>';
        }
    }
    if($_SESSION['pray_admin'] == '1') {
        if($activeparam == '8')
        {
            echo '<li class="nav-item active"><a class="nav-link" href="ofc_prayeradmin.php">Prayer Admin</a></li>';
        }
        else {
            echo '<li class="nav-item"><a class="nav-link" href="ofc_prayeradmin.php">Prayer Admin</a></li>';
        }
    }
    //echo '<li class="nav-item"><a class="nav-link" href="../services/ofc_sendmailtest.php">Test Send Email</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="tec_logout.php">Logout</a></li>';

    echo"<script language='javascript'  src='/js/tec_config_ajax_call.js'></script>";
?>


