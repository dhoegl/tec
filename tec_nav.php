<!-- Navbar-->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark orange darken-4">
<a class="navbar-brand" href="tec_welcome.php">
        <img id="nav_logo" width="30" height="30" class="d-inline-block align-top" alt="Logo" />
        <span id="navbar_brand"></span>
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="basicExampleNav">
  <?php
        if(!$_SESSION['logged in']) {
            echo "<script language='javascript'>";
            echo "console.log('SESSION NOT LOGGED IN - session destroying in tec_nav');";
            echo "</script>";
            session_destroy();
        }
        else
        {
            echo "<script language='javascript'>";
            echo "console.log('activeparam  = " . $activeparam . "');";
            echo "</script>";
            echo '<ul class="navbar-nav">';
          }
        if($activeparam == '1') //  $activeparam sets nav element highlight on Nav bar - originates on all pages to identify (by 'Active' class and bold text) which page is being displayed
        {
          echo '<li class="nav-item active"><a class="nav-link" href="tec_home.php">Home</a></li>';
        }
        else
        {
          echo '<li class="nav-item"><a class="nav-link" href="tec_home.php">Home</a></li>';
        }
        if($activeparam == '2')
        {
            if($MyView == 'Y')
            {
                echo '<li class="nav-item active"><a class="nav-link" href="tec_profile.php?id=' . $_SESSION['idDirectory'] . '">My Profile</a></li>';
            }
            else {
                echo '<li class="nav-item"><a class="nav-link" href="tec_profile.php?id=' . $_SESSION['idDirectory'] . '">My Profile</a></li>';
                }
        }
        else
        {
            echo '<li class="nav-item"><a class="nav-link" href="tec_profile.php?id=' . $_SESSION['idDirectory'] . '">My Profile</a></li>';
        }
        if($activeparam == '3' || ($activeparam == '2' && $MyView == 'N'))
        {
            echo '<li class="nav-item active" id="directory_service"><a class="nav-link" href="tec_family.php">Directory</a></li>';
        }
        else
        {
            echo '<li class="nav-item" id="directory_service"><a class="nav-link" href="tec_family.php">Directory</a></li>';
        }
        if($activeparam == '4')
        {
            echo '<li class="nav-item active" id="calendar_service"><a class="nav-link" href="tec_calendar.php">Calendar</a></li>';
        }
        else
        {
            echo '<li class="nav-item" id="calendar_service"><a class="nav-link" href="tec_calendar.php">Calendar</a></li>';
        }
        // if($activeparam == '5')
        // {
        //     echo '<li class="nav-item active" id="prayer_service"><a class="nav-link" href="#">Prayer</a></li>';
        // }
        // else
        // {
        //     echo '<li class="nav-item" id="prayer_service"><a class="nav-link" href="#">Prayer</a></li>';
        // }
        // if($activeparam == '6')
        // {
        //     echo '<li class="nav-item active" id="events_service"><a class="nav-link" href="#">Events</a></li>';
        // }
        // else
        // {
        //     echo '<li class="nav-item" id="events_service"><a class="nav-link" href="#">Events</a></li>';
        // }
        if($_SESSION['reg_admin'] == '1')
        {
          if($activeparam == '9')
          {
              echo '<li class="nav-item active"><a class="nav-link" href="tec_regadmin.php">Registration Admin</a></li>';
          }
          else
          {
              echo '<li class="nav-item"><a class="nav-link" href="tec_regadmin.php">Registration Admin</a></li>';
          }
        }
        if($activeparam == '10') //  $activeparam sets nav element highlight on Nav bar - originates on all pages to identify (by 'Active' class and bold text) which page is being displayed
        {
          echo '<li class="nav-item active"><a class="nav-link" href="tec_help.php">Help</a></li>';
        }
        else
        {
          echo '<li class="nav-item"><a class="nav-link" href="tec_help.php">Help</a></li>';
        }
        // if($_SESSION['pray_admin'] == '1')
        // {
        //   if($activeparam == '8')
        //   {
        //       echo '<li class="nav-item active"><a class="nav-link" href="tec_prayeradmin.php">Prayer Admin</a></li>';
        //   }
        //   else {
        //       echo '<li class="nav-item"><a class="nav-link" href="tec_prayeradmin.php">Prayer Admin</a></li>';
        //   }
        // }
        echo '<li class="nav-item"><a class="nav-link" href="tec_logout.php">Logout</a></li>';
        echo '</ul>';
  ?>
  </div>
</nav>
<!--/.Navbar-->