<?php 
include("header.php");
include("menu.php");
?>

    <div class="allEvents">
      <?php 
        session_start();
        @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

        if ($db->connect_error) {
            echo "could not connect: " . $db->connect_error;
            exit();
        }
        
        
        //add attendee
        //check if plus button is clicked
         if (isset($_POST['plus'])){
            
             //set variables, which get data 
             $eventid = $_POST['eventID'];
             $userid = $_SESSION['userID'];
             
             //get the eventID from the input and the userID from the session and insert it into the database
             $insertQuery = "INSERT INTO Attend (eventID, userID) VALUES ($eventid, $userid)";
             
             //this selects the userID and eventID from the attend db to check if the current user already has attended that event > not supposed to be able to click the same event twice
             $stmt = $db->prepare("SELECT `eventID`, `userID` FROM `Attend` WHERE userID = $userid  AND eventID = $eventid");
             $stmt->execute();
             
             //if the event hasnt been clicked/attended before, there will no rows in the db, which means that the fetch will be empty
             if (!$stmt->fetch()){
                // then the userID and eventID will be added in the attend db
                $stmt = $db->prepare($insertQuery);
                $stmt->execute();
                header("location:events.php");
             }
         }
        
        //this selects all event information from the Events db
        $query = "SELECT eventID, title, description, startdate, enddate, time, price, location, image, link, host FROM Events";
        $stmt = $db->prepare($query);
        //binds the db information to the variables
        $stmt->bind_result($eventID, $title, $description, $startdate, $enddate, $time, $price, $location, $image, $link, $host);
        $stmt->execute();
        
        //gets every event in a row and displays the information in the div "eventContainer"
        while($stmt->fetch()){ ?>
            
       <!---------------------------------EVENT ONE-->
       <div class="eventContainerOne">
          <!-----------event img & attend event btn-->
          <div class="imgContainer" style="background-image: url('img/<?php echo "$image"; ?>');"></div>
          <form method="POST" action='events.php'>
                  <input type="submit" value="+" class="plusBtn" name="plus">
                  <input type="hidden" value="<?php echo "$eventID"; ?>" name="eventID">
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



<?php 
include("footer.php");

?>