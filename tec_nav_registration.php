<!-- Navbar for Registration cycle only-->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark primary-color">
<a class="navbar-brand" href="tec_welcome.php">
        <img id="nav_logo" width="30" height="30" class="d-inline-block align-top" alt="" />
        <span id="navbar_brand"></span>
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="basicExampleNav">
  <?php
        if(!$_SESSION['logged in'] && !$_SESSION['register_check']) {
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
        if($activeparam == 'REG') //  $activeparam sets nav element highlight on Nav bar - Registration cycle only
        {
          echo '<li class="nav-item active"><a class="nav-link" href="tec_home.php">Home</a></li>';
        }
        else
        {
          echo '<li class="nav-item"><a class="nav-link" href="tec_home.php">Home</a></li>';
        }

  ?>
  </div>
</nav>
<!--/.Navbar for Registration cycle only-->