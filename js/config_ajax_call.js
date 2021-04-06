// JavaScript source code
var navJQ = jQuery.noConflict();
navJQ(document).ready(function () {
    var titletext;
    navJQ.ajax({
        url: '../_tenant/Config.xml',
        type: 'Get',
        //success: function (result) {
        //    console.log(result);
        //}
        success: xmlParser
    });
});
function xmlParser(xml) {
    //Get page title from config.xml
    var titletext;
    titletext = (navJQ(xml).find('title').text());
    document.title = titletext;
    if (document.getElementById("navbar_brand")) {
        var title_element = document.getElementById("navbar_brand");
    title_element.innerHTML = titletext;
    }
    //Get notify return address for registrant notification - NOTE this address is not monitored, but used to fulfill outbound email metadata
    // Store as cookie
    var cookie_name = "reg_notify_from";
    var regnotify;
    regnotify = (navJQ(xml).find('reg_notify_from').text());
    // console.log("Registration Notify From = " + regnotify);
    var d = new Date();
    var days_until_expire = 1; // Cookie lasts one day max
    d.setTime(d.getTime() + (days_until_expire * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cookie_name + "=" + regnotify + ";" + expires + ";path=/";

    //Get logo image name from config.xml
    var logotext;
    logotext = (navJQ(xml).find('logo').text());
    // console.log("logo = " + logotext);
    //Get nav logo image name from config.xml
    var navlogotext;
    navlogotext = (navJQ(xml).find('nav_logo').text());
    // console.log("nav_logo = " + navlogotext);
    if (document.getElementById("nav_logo")) {
        document.getElementById("nav_logo").src = navlogotext;
    }
    //Get name from config.xml
    var nametext;
    var pretrimnametext;
    pretrimnametext = (navJQ(xml).find('name').text());
    nametext = pretrimnametext.trim();
    // $_SESSION['themename'] = nametext;
    //Add name to Pages
    if (document.getElementById("custname")) {
        var name_element = document.getElementById("custname");
        name_element.innerHTML = nametext;
    }
    if (document.getElementById("themename")) {
        var theme_name_element = document.getElementById("themename");
        theme_name_element.innerHTML = nametext;
        document.getElementById("themename").style.visibility = "hidden";
    }
    //Get nickname from config.xml
    var nicknametext;
    nicknametext = (navJQ(xml).find('nickname').text());
    //Add nickname to Pages
    if (document.getElementById("nickname")) {
        var nickname_element = document.getElementById("nickname");
        nickname_element.innerHTML = nicknametext;
    }
    //Get tagline from config.xml
    var taglinetext;
    taglinetext = (navJQ(xml).find('tagline').text());
    //Add tagline to Pages
    if (document.getElementById("TagLine")) {
        var element = document.getElementById("TagLine");
        element.innerHTML = taglinetext;
    }
    //Get domain name from config.xml
    var domaintext;
    var pretrimdomaintext;
    pretrimdomaintext = (navJQ(xml).find('domain').text());
    domaintext = pretrimdomaintext.trim();
    // $_SESSION['themedomain'] = domaintext;
    //Add domain to Pages
    if (document.getElementById("domainname")) {
        var domain_element = document.getElementById("domainname");
        domain_element.innerHTML = domaintext;
        // domain_element.TextContent = domaintext;
    }
    if (document.getElementById("themedomain")) {
        var theme_domain_element = document.getElementById("themedomain");
        theme_domain_element.innerHTML = domaintext;
        document.getElementById("themedomain").style.visibility = "hidden";
    }
    //Add domain to Cookie
    var cookie_name = "domain_value";
    var domainvallink;
    domainvallink = (navJQ(xml).find('domainname').text());
    // console.log("Domain Value = " + domainvallink);
    var d = new Date();
    var days_until_expire = 1; // Cookie lasts one day max
    d.setTime(d.getTime() + (days_until_expire * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cookie_name + "=" + domainvallink + ";" + expires + ";path=/";


    //Get notify email link for new registrant - NOTE this address is not monitored, but used to fulfill outbound email metadata
    // Store as cookie
    var cookie_name = "reg_notify_link";
    var regnotifylink;
    regnotifylink = (navJQ(xml).find('reg_notify_link').text());
    // console.log("Registration Notify Link = " + regnotifylink);
    var d = new Date();
    var days_until_expire = 1; // Cookie lasts one day max
    d.setTime(d.getTime() + (days_until_expire * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cookie_name + "=" + regnotifylink + ";" + expires + ";path=/";

    //Get banner header/footer background color from config.xml
    var bannercolor;
    var pretrimbannercolor;
    pretrimbannercolor = (navJQ(xml).find('banner_color').text());
    bannercolor = pretrimbannercolor.trim();
    // $_SESSION['themecolor'] = bannercolor;
    if (document.getElementById("headercolor")) {
        document.getElementById("headercolor").style.backgroundColor = bannercolor;
    }
// Banner color for outbound email
    if(document.getElementById("headercolorvalue")) {
        var headercolorvalue_element = document.getElementById("headercolorvalue");
        headercolorvalue_element.innerHTML = bannercolor;
    }   

    if (document.getElementById("footercolor")) {
        document.getElementById("footercolor").style.backgroundColor = bannercolor;
    }

    //Get banner header/footer foreground color from config.xml
    var bannerforecolor;
    var pretrimbannerforecolor;
    pretrimbannerforecolor = (navJQ(xml).find('banner_forecolor').text());
    bannerforecolor = pretrimbannerforecolor.trim();
    // $_SESSION['themecolor'] = bannercolor;
    if (document.getElementById("headercolor")) {
        // document.getElementById("headercolor").style.color = bannerforecolor;
        console.log("bannerforecolor = " + bannerforecolor);
        if (bannerforecolor == "Black")
        {
            document.getElementById("headercolor").classList.add("navbar-light");
        }
        else
        {
            document.getElementById("headercolor").classList.add("navbar-dark");
        }
    }
// Banner foreground color for outbound email
    if(document.getElementById("headerforecolorvalue")) {
        var headerforecolorvalue_element = document.getElementById("headerforecolorvalue");
        headerforecolorvalue_element.innerHTML = bannerforecolor;
    }   

    if (document.getElementById("footercolor")) {
        document.getElementById("footercolor").style.color = bannerforecolor;
    }
    
    //Get banner image name from config.xml
    var bannertext;
    bannertext = (navJQ(xml).find('banner').text());
    // console.log("banner = " + bannertext);
    //Get backsplash image (half-screen image on Home page) name from config.xml
    var backsplashtext;
    backsplashtext = (navJQ(xml).find('backsplash').text());
    var backsplashimage;
    backsplashimage = backsplashtext;
    // console.log("backsplash = " + backsplashtext);
    // console.log("backsplashimage = " + backsplashimage);
    if (document.getElementById("backsplash")) {
        document.getElementById("backsplash").style.backgroundImage = backsplashimage;
        document.getElementById("backsplash").style.backgroundPosition = "center center";
        document.getElementById("backsplash").style.backgroundSize = "cover";
        document.getElementById("backsplash").style.backgroundAttachment = "fixed"; // background won't scroll

    }
    //Get Homepage Splash image
    var welcomesplash;
    welcomesplash = (navJQ(xml).find('homesplash').text());
    if (document.getElementById("homesplash")) {
        // document.getElementById("homesplash").style.backgroundImage = welcomesplash;
        document.getElementById("homesplash").src = welcomesplash;
    }
    //Get Home screen Title text
    var hometitletext;
    hometitletext = (navJQ(xml).find('hometitle').text());
    if (document.getElementById("hometitle_text")) {
        // document.getElementById("homesplash").style.backgroundImage = welcomesplash;
        document.getElementById("hometitle_text").innerHTML = hometitletext;
    }
    if (document.getElementById("themetitle")) {
        var theme_title_element = document.getElementById("themetitle");
        theme_title_element.innerHTML = hometitletext;
        document.getElementById("themetitle").style.visibility = "hidden";
    }
    //Get Home screen Sub Title text
    var homesubtitletext;
    homesubtitletext = (navJQ(xml).find('homesubtitle').text());
    if (document.getElementById("homesubtitle_text")) {
        // document.getElementById("homesplash").style.backgroundImage = welcomesplash;
        document.getElementById("homesubtitle_text").innerHTML = homesubtitletext;
    }

    //Get backsplash_Welcome image (half-screen image on Master Splash screen) name from config.xml
    var backsplash_Welcome_text;
    backsplash_Welcome_text = (navJQ(xml).find('backsplash_Welcome').text());
    var backsplash_Welcome_image;
    backsplash_Welcome_image = backsplash_Welcome_text;
    // console.log("backsplash_Welcome = " + backsplash_Welcome_text);
    // console.log("backsplash_Welcome image = " + backsplash_Welcome_image);
    if (document.getElementById("backsplash_Welcome")) {
        document.getElementById("backsplash_Welcome").style.backgroundImage = backsplash_Welcome_image;
        document.getElementById("backsplash_Welcome").style.backgroundPosition = "center";
        document.getElementById("backsplash_Welcome").style.backgroundSize = "cover";
    }
    //Get special1 image (embedded image below backsplashImage) name from config.xml
    var special1text;
    special1text = (navJQ(xml).find('special1').text());
    var special1image;
    special1image = special1text;
    // console.log("special1text = " + special1text);
    // console.log("special1image = " + special1image);

    //Get prayer visibility text content (defines Elder or Board visibility) from config.xml
    var visibility1text;
    visibility1text = (navJQ(xml).find('visibility1').text());
    if (document.getElementById("Visibility1")) {
        var visibility1textcontent = document.getElementById("Visibility1");
        visibility1textcontent.innerHTML = visibility1text;
    }
    //Get prayer visibility text content (defines Elder or Board visibility) from config.xml
    var visibility2text;
    visibility2text = (navJQ(xml).find('visibility2').text());
    if (document.getElementById("Visibility2")) {
        var visibility2textcontent = document.getElementById("Visibility2");
        visibility2textcontent.innerHTML = visibility2text;
    }
//***********************************************************************************************************
//************************* SUBSCRIPTION FEATURE ENABLEMENT *************************************************
//***********************************************************************************************************
    //Check for 'Directory Service' subscription (enables viewing of Directory functionality) from config.xml
    var directoryservicetext;
    directoryservicetext = (navJQ(xml).find('services-directory').text());
    // console.log("directoryservicetext = " + directoryservicetext);
    if (directoryservicetext == 'NO') {
        var testdirectoryservice = document.getElementById("directory_service");
        testdirectoryservice.style.display = "none";
    }
    // Check for 'Calendar Service' subscription (enables viewing of Calendar functionality) from config.xml
    var calendarservicetext;
    calendarservicetext = (navJQ(xml).find('services-calendar').text());
    // console.log("calendarservicetext = " + calendarservicetext);
    if (calendarservicetext == 'NO') {
        var testcalendarservice = document.getElementById("calendar_service");
        testcalendarservice.style.display = "none";
    }

    // Check for 'Prayer Service' subscription (enables prayer request functionality) from config.xml
    var prayerservicetext;
    prayerservicetext = (navJQ(xml).find('services-prayer').text());
    // console.log("prayerservicetext = " + prayerservicetext);
    if (prayerservicetext == 'NO') {
        var testprayerservice = document.getElementById("prayer_service");
        testprayerservice.style.display = "none";
    }
    //Check for 'Events Service' subscription (enables Events management functionality) from config.xml
    var eventsservicetext;
    eventsservicetext = (navJQ(xml).find('services-events').text());
    // console.log("eventsservicetext = " + eventsservicetext);
    if (eventsservicetext == 'NO') {
        var testeventsservice = document.getElementById("events_service");
        testeventsservice.style.display = "none";
        // var testeventsserviceclass0 = document.getElementsByClassName("events_service")[0];
        // testeventsserviceclass0.style.display = "none";
        // var testeventsserviceclass1 = document.getElementsByClassName("events_service")[1];
        // testeventsserviceclass1.style.display = "none";

    }
//***********************************************************************************************************
//***********************************************************************************************************
//***********************************************************************************************************

    //Get prayer approval text content (defines prayer request approval) from config.xml
    var prayerapprovaltext;
    prayerapprovaltext = (navJQ(xml).find('prayerapproval').text());
    if (document.getElementById("newprayernotice")) {
        var prayerapprovaltextcontent = document.getElementById("newprayernotice");
        prayerapprovaltextcontent.innerHTML = prayerapprovaltext;
    }
    //Get contact text (the 'Contact Us' email address embedded at home) from config.xml
    var contacttext;
    contacttext = (navJQ(xml).find('contact').text());
    if (document.getElementById("contactus")) {
        document.getElementById("contactus").href = contacttext;
    }
    //Get homepage text (the 'Go To Home Page' link embedded at home) from config.xml
    var homepagetext;
    homepagetext = (navJQ(xml).find('homepage').text());
    if (document.getElementById("gotosite")) {
        document.getElementById("gotosite").href = homepagetext;
        document.getElementById("gotosite").target = "_blank";
    }
}