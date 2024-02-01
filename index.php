<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['username'])) {
        echo "<h1>Welcome, " . $_SESSION['username']."</h1>";
    } else {
        echo "Welcome";
        exit();
    }
    if(isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <button class="logout" type="submit" name="logout" style="width: 100px; height: 30px;background-color: #C9302C;color:white; border-color:transparent">Logout</button>
    </form>
    <div class="cont" style="text-align:center">
        <img src="Hello.png" style="width:80%;" alt="">
    </div>
</body>
</html>