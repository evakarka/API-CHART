<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM users";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DailyNews - Chart</title>
    <link rel="icon" href="/img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<div id="sidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" id="closebtn">&times;</a>
  <a href="index.php">Home</a>
  <a href="about.php">About</a>
  <a href="#">Services</a>
  <a href="contact.php">Contact</a>
</div>

<br>

    <div class="card text-center m-5">
        <div class="card-header">
            <h2 class="text-center">Daily Minimum Temperatures</h2>
        </div>
        <canvas id="myChart" width="800" height="300"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>
