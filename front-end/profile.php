<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Profile</header>
            <div class="field">
                <label for="username">Username:</label>
                <span id="username"><?php echo $_SESSION['username']; ?></span>
            </div>
            <div class="field">
                <label for="email">Email:</label>
                <span id="email"><?php echo $_SESSION['valid']; ?></span>
            </div>
            <div class="field">
                <label for="age">Age:</label>
                <span id="age"><?php echo $_SESSION['age']; ?></span>
            </div>
        </div>
    </div>
</body>
</html>
