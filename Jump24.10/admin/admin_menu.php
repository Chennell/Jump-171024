<?php
    include("../config.php");
    include("admin_header.php");
?>

 <script src="js/jquery.js"></script>
<header>
        <div id="logo" class="logo"></div>
        <div id="hamburger">
            <div class="line one"></div>
            <div class="line two"></div>
            <div class="line three"></div>
        </div>
        <ul id="dropDown">
            <li><a class="dropDownLink <?php echo($current_page == 'admin_events.php'|| $current_page == "" ) ? 'active' : NULL?>" href="#">Events</a></li>
            <li><a class="dropDownLink <?php echo($current_page == 'admin_user.php') ? 'active' : NULL?>" href="#">Users</a></li>
            <li><a class="dropDownLink <?php echo($current_page == 'logout.php') ? 'active' : NULL?>" href="logout.php">Log Out</a></li>
        </ul>
</header>

   

   <li><a class="dropDownLink" href="#">Home</a></li>
     

<?php
    include("../footer.php");
?>