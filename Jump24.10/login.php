<?php
include("header.php");


//start the session and check if session has been created before if so take user to user page if not create a new session with the user email when user logged in 
session_start();

//check if a session– called as the input given– is already set using an if-statement
if (isset($_SESSION['username'])) {
    //if the statement is true = if a session is set, take the user to the user page
    header("location:user.php");  
}


// check if sth. is entered in the input field = it is not empty by using the if statement 
if(isset($_POST) && !empty($_POST)){
    
    //stripslashes removes backslashes that mitgh have been added before using the function "addslashes"
   	$usermail =  stripslashes($_POST['email']);
	$password =  stripslashes($_POST['password']);
    

	//connecting the a new database, which is still Jump defined in config.php
	@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
    
    //check if there is a connection to the database
	if ($db->connect_error) {
		echo "could not connect: " . $db->connect_error;
		exit();
	}

    
    //prepare the database and select the username and userpassword typed into the input fields
    $stmt = $db->prepare("SELECT userID, firstname, email, userpass FROM Users WHERE email = ?");
	
    
	$stmt->bind_param('s', $usermail);
	$stmt->execute();
	
    $stmt->bind_result($userID, $firstname, $usermail, $userpass);

    
    while ($stmt->fetch()) {
        // check if the hashed password is the same as the password in the database
        if (sha1($password) == $userpass)
		{
            // if it is the same, create a new session with the username, which is the email of the user
			$_SESSION['username'] = $firstname;
            $_SESSION['userID'] = $userID;
            $_SESSION['usermail'] = $usermail;
            
            
			//debugging: check if the session works
            echo $_SESSION['username'];
            
            header("location:user.php"); 
            exit();
		} else {echo'<p>Wrong Password</p>';}
    }
 
}

?>
<div class='wrapper'>
    <div class="logoLogin"></div>
    <div class="container">
        <form action='' method="POST" class='loginForm'>

                <input type='email' name='email' value='Email' class='inputField'>
                <br>
                <input type='password' name='password' value='Password' class='inputField'>
                <br>
                <input type='submit' value='Log in' class='submitBtn'>

        </form>
    </div>
</div>

<?php 
include("footer.php");
?>