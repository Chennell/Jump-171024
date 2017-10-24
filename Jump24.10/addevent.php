<?php
include("header.php");
include("menu.php");

?>
    <div class="userInfo">
        <div class="adminImg"></div>
        <div class="userWelcome">Hi <?php
            session_start();
            echo $_SESSION['username'];
            ?>! These are your events</div>
    </div>
    <div class="addEvent">

    <?php
      if (isset($_FILES['upload'])){
                  
         $allowedextensions = array('jpg', 'jpeg', 'gif', 'png');

         $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));

         $error = array ();
         if(in_array($extension, $allowedextensions) === false){

        #add a new array entry
          $error[] = 'This is not an image, upload is allowed only for images.';
        }

        if($_FILES['upload']['size'] > 1000000){
          $error[]='The file exceeded the upload limit';
        }

        if(empty($error)){
            $upload = $_FILES['upload']['name'];
            $uploadQuery = ("INSERT INTO Events (image) VALUES ($upload)");
            $stmt->bind_param('s', $upload);
	        $stmt->execute();
            header("location:user.php");
        }

      }
   ?>

    <form class="addeventForm" action="" method="POST">
        <input type='text' name='title' value='Event Title' class=''>
        <input type='date' name='date' value='Event Date' class=''>
        <input type='time' name='time' value='Event Time' class=''>
        <input type='text' name='location' value='Event Location' class=''>
        <input type='textarea' rows="5" name='title' value='Event Description' class=''>
        <h4>Picture upload<h4>
        <input type="file" name="upload" /><br>
    

        <div class="bContainer">
            <input class="submitEvent" type="submit" value="Add Event"/>
            <a href="#" class="backBtn">Go Back</a>
         </div>
    </form>


    </div>




<?php
include("footer.php");

?>
