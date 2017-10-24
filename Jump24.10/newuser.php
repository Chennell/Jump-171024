<?php
include("header.php");
?>

<div class='wrapper'>
    <div class="logoLogin">
    <div class="container">
        
        
<!-- Select user type , Student or Organization window  -->
        <div id='selectUserType'>
            <ul>
                <li>
                    <input type="radio" name="newuserradio" value="student" id='studentRadio' onclick='showUserForm()'> 
                    <label for="student">Student</label>
                </li>
                
                <li>
                    <input type="radio" name="newuserradio" value="org" onclick='showUserForm()'> 
                    <label for="org">Organization</label>
                </li>
            </ul>
                    
        </div>
        
 
 <!--     Form for new student      --> 
        
        <div id='newStudentForm'>
            <form action='' method="POST" class='newUserForm'>
                    
                <input type='text' name='nuFirstname' value='First name' class='inputField'>
                <br>
                <input type='text' name='nuLastname' value='Last name' class='inputField'>
                
                <br>
                <input type='email' name='nuEmail' value='Email' class='inputField'>

                <br>
                <input type='password' name='nuPass' value='Password' class='inputField'>              
                <br>
                <input type='password' name='nuPassConf' value='Password' class='inputField'>
                
                <br>
                <!--                <input type='text' name='nuSchool' value='School' class='inputField'>-->
                <select id='selectSchool'>
                    <option value="School" disabled selected>Select School</option>
                    <option value="JTH">School of Engineering</option>
                    <option value="JIBS">International Business School</option>
                    <option value="HLK">School of Education and Communication</option>
                    <option value="HALSO">School of Health and Welfare</option>
                    <option value="otherSchool">Other</option>
                </select>

                <br>
                <input type='submit' value='Submit!' class='submitBtn'>

            </form>
         </div>
        
 <!--    Form for new organization      -->
        
        <div id='newOrgForm'>
            <form action='' method="POST" class='newUserForm'>
                    
                <input type='text' name='orgname' value='Organization' class='inputField'>


                <br>
                <input type='email' name='nuEmail' value='Email' class='inputField'>

                <br>
                <input type='password' name='nuPassword' value='Password' class='inputField'>
                <br>
                <input type='password' name='nuPassConf' value='Password' class='inputField'>
                
                <br>
                <!--                <input type='text' name='nuSchool' value='School' class='inputField'>-->
                <select id='selectSchool'>
                    <option value="School" disabled selected>Select School</option>
                    <option value="JTH">School of Engineering</option>
                    <option value="JIBS">Jönköping International Business School</option>
                    <option value="HLK">School of Education and Communication</option>
                    <option value="HALSO">School of Health and Welfare</option>
                    <option value="otherSchool">Other</option>
                </select>

                <br>
                <input type='submit' value='Submit!' class='submitBtn'>

            </form>
            
        </div>
    </div>
</div>
    
<script src="js/newuser.js"></script>

<?php 
   
// Add new user 
        //checks if firstname is in input field
        if (isset($_POST['nuEmail']) && ($_POST['nuPass'])){
            
            //gets the input and gets rid of spaces (trim)
            $firstname = trim ($_POST['nuFirstname']);
            $lastname = trim ($_POST['nuLastname']);
            $email = trim ($_POST['nuEmail']);
            //$school= trim ($_POST['']);
            $pass= trim ($_POST['nuPass']);
            //$passConf= trim ($_POST['nuPassConf']);
            
            // if one of the input fields is empty, the user cannot create account
            if(!$firstname || !$lastname || !$email || !$pass){
                printf("You must fill in all the forms.");
                exit();
            }
            
            //returns input as string with backslashes in front of predefined characters
            $firstname = addslashes ($firstname);
            $lastname = addslashes ($lastname);
            $email = addslashes ($email);
            //$school= addslashes ($school);
            $pass= addslashes ($pass);
            $passConf= addslashes ($passConf);
            
            //takes the password and hashes it
            $userpass= sha1($pass);
            
            
            //creates a new connection to the database - connection specified in config.php
            @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

            //if it cannot connect to the database it will send the user back to the index page
            if ($db->connect_error) {
                //returns why db cannot connect
                echo "could not connect: " . $db->connect_error;
                //takes the user back to the index page
                header("Location: index.php");
                exit();
            }

            //Takes the inputed values, which are the ones with a ? and inserts them to the Users table in the db
             $stmt = $db->prepare("INSERT INTO Users values ('', '', ?, ?, '', '', ?, ?, '')");
            
            //binds the parameter
             $stmt->bind_param('ssss', $userpass, $email, $firstname, $lastname);
             $stmt->execute();
            //redirects the user to the login page after data is saved in db
             echo "<script>window.location.href='login.php'</script>";  
             exit;

        }
    
    
    
include("footer.php");
?>