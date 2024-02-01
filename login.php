<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<?php

session_start();
@include 'config.php';

$email = '';
$passErr = '';

if (isset($_POST['login-submit'])) {
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];

    // Validate email and password
    $query = "SELECT * FROM signup WHERE useremail='$useremail'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($userpassword === $row['userpassword']) {
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            echo "Login Successful";
            header("Location: index.php");
            exit();
        } else {
            $passErr = "Incorrect password";
        }
    } else {
        $passErr = "User not found";
    }
}
  ?>

<h2>Login Form</h2>

<form action="" method="post">

  <div class="container">
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="useremail" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="userpassword" required>
    <span style='color:red;'><?php echo "$passErr" ?></span>
        
    <button type="submit" name="login-submit">Login</button>
    <label>
      <input type="checkbox" checked="checked"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>
</html>
