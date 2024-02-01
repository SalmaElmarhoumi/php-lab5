<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>
<?php
      @include 'config.php';

      $name = '';
      $email = '';
      $pass = '';      
      $nameErr='';
      $emailErr = '';
      $passErr='';
      $confirmPassErr = '';

      if(isset($_POST['signup-submit'])){
  
          //username validation
          $username = $_POST['username'];
          if(empty($username)){
            $nameErr1 = "Username is required";
          }
          
           // email validation
            $useremail = $_POST['useremail'];
            if (empty($useremail)) {
                $emailErr = "Email is required";
            } else {
                // Check if the email is already used
                $checkEmailQuery = "SELECT * FROM signup WHERE useremail = '$useremail'";
                $checkEmailResult = mysqli_query($connection, $checkEmailQuery);

                if (mysqli_num_rows($checkEmailResult) > 0) {
                    $emailErr = "Email is already in use";
                }
    }
          // password validation
          $userpassword = $_POST['userpassword'];
          if(empty($userpassword)){
            $passErr = "Password is required";
          }
          // Confirm password validation
          $confirmPassword = $_POST['userpass2'];
          if (empty($confirmPassword)) {
              $confirmPassErr = "Please confirm the password";
          } elseif ($userpassword !== $confirmPassword) {
              $confirmPassErr = "Passwords do not match";
          }
            $name = $_POST['username'];
            $email = $_POST['useremail'];
            $pass = $_POST['userpassword'];
     
         if (empty($nameErr) && empty($emailErr) && empty($passErr) && empty($confirmPassErr)) {
              // Hash the password
        // $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);
             // insert data into database
             $query = 'INSERT INTO signup(username, useremail, userpassword) VALUES
             ("'.$_POST['username'].'", "'.$_POST['useremail'].'", "'.$_POST['userpassword'].'")';
     
             $result = mysqli_query($connection, $query);
             if($result) {
               header ("Location: login.php");
               exit();
             }
             else {
               echo "Error";
             }
           
         }
       
        }
      
  ?>
<form style="border:1px solid #ccc" method="post">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="text" class="form-label"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" value="<?php echo "$name" ?>">
              <span style='color:red;'><?php echo "$nameErr" ?></span>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="useremail" value="<?php echo "$email" ?>">
    <span style='color:red;'><?php echo "$emailErr" ?></span>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="userpassword" >
    <span style='color:red;'><?php echo "$passErr" ?></span>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="userpass2">
    
    
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn" name="signup-submit">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>
