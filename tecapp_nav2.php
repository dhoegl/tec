<!-- JQuery -->
    <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script>
<!-- Tenant Configuration JavaScript Call in tec_nav -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
    <a class="navbar-brand" href="tec_welcome.php">
        <!--<img src="/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="" />-->
        <!--<img src="/_tenant/images/raggantssbs_or.png" width="30" height="30" class="d-inline-block align-top" alt="" />-->
        <img id="nav_logo" width="30" height="30" class="d-inline-block align-top" alt="" />
        <!--  OurFamilyConnections test-->
        <span id="navbar_brand"></span>
    </a>
    <!--<a class="navbar-brand" href="tec_welcome.php">OurFamilyConnections</a>-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>



    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
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
            echo "console.log('SESSION YES LOGGED IN - going to tec_menu from tec_nav');";
            echo "</script>";
        }
        ?>
        <ul class='navbar-nav mr-auto mt-md-0'>
            <li class="nav-item active">
                <a class="nav-link" href="tec_home.php">Home</a>
            </li>
            <li class="nav-item active" id="calendar_service">
                <a class="nav-link" href="ofc_calendar.php">Calendar</a>
            </li>
            <li class="nav-item active" id="prayer_service">
                <a class="nav-link" href="ofc_prayer.php">Prayer</a>
            </li>
            <li class="nav-item active" id="events_service">
                <a class="nav-link" href="#">Events</a>
            </li>
        </ul>
    </div>
</nav>
