<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyNewsChart - About</title>
    <link rel="icon" href="/img/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
<div class="navbar" id="navbar">
  <div class="logo">
    <a href="index.php" style="font-size: 20px;">DailyNewsChart</a>
  </div>
  <div class="nav-links" id="navLinks">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="service.php">Services</a>
    <a href="contact.php">Contact</a>
  </div>
  <div class="hamburger" id="hamburger">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<div id="sidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" id="closebtn">&times;</a>
  <a href="index.php">Home</a>
  <a href="about.php">About</a>
  <a href="service.php">Services</a>
  <a href="contact.php">Contact</a>
</div>

      <div class="container boxtitle">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
            <h2 class="text-center mb-4">Service</h2>
                <hr class="mb-4 mt-0 mx-auto" style="width: 220px; background-color: #7c4dff; height: 2px">
                <ul class="list-unstyled text-center mb-4">
                    <p class="fs-5">This application is developed for academic assessment.</p>
                    <p class="fs-5">Email: 100675745@unimail.derby.ac.uk</p>
                </div>
            </div>
        </div>
    </div>


    <div class="footer">
  <p class="fs-5">&copy; 2024 DailyNewsChart. All rights reserved.</p>
  <p class="fs-5">
    <a href="#">Privacy Policy</a> | 
    <a href="#">Terms of Service</a> | 
    <a href="contact.php">Contact Us</a>
  </p>
</div>  
        

<script>
document.addEventListener('DOMContentLoaded', function() {
    var hamburger = document.getElementById('hamburger');
    var sidebar = document.getElementById('sidebar');
    var closebtn = document.getElementById('closebtn');

    hamburger.addEventListener('click', function() {
        sidebar.style.width = '250px';  
    });

    closebtn.addEventListener('click', function() {
        sidebar.style.width = '0';  
    });
});
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>