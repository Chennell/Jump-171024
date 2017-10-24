<?php 
include("header.php");
include("menu.php");

?>
    <div class="userInfo">
        <div class="userImg"></div>
        <div class="userWelcome">Hi <?php
            session_start();
            echo $_SESSION['username'];
            ?>! These are your events</div>
    </div>
    
    <div class="allEvents">
      <?php 
        @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

        if ($db->connect_error) {
            echo "could not connect: " . $db->connect_error;
            exit();
        }
        
        
        $query = "SELECT title, description, startdate, enddate, time, price, location, image, link, host FROM Events";
        $stmt = $db->prepare($query);
        $stmt->bind_result($title, $description, $startdate, $enddate, $time, $price, $location, $image, $link, $host);
        $stmt->execute();
        while($stmt->fetch()){ ?>
            
       <!---------------------------------EVENT ONE-->
       <div class="eventContainerOne">
          <!-----------event img & attend event btn-->
          <div class="imgContainer" style="background-image: url('img/<?php echo "$image"; ?>');"></div>
          <form method="POST" action=''>
                  <input type="submit" value="+" class="plusBtn">
              </form>
          <!---------event information & expand btn-->
          <div class="infoContainer">
              <p class="eventTitle">
                 <?php 
                    echo "$title, $startdate, $enddate, $time";
                
                  ?>
                 
              </p> 
              <a href="#" class="expanderBtn">
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <p class="eventDescription">
                <?php echo "$description";?>
              </p>  
            </div>
       </div>
       
       <?php  } ?>

       </div>
       

       
       
    </div>




<?php 
include("footer.php");

?>