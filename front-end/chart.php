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

    <style>
        body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        min-height: 100%;
        overflow-x: hidden;
        font-family: 'Montserrat', sans-serif;
        background: #0D0D2B;
        color: white;
        }

        /* Custom scrollbar styling */
        ::-webkit-scrollbar {
        width: 6px;
        }

        ::-webkit-scrollbar-track {
        background: #0C0C27;
        }

        ::-webkit-scrollbar-thumb {
        background: #ff4081;
        border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
        background: #e00070;
        }

        .navbar {
        position: fixed;
        top: 20px;
        left: 20px;
        right: 20px;
        padding: 10px 20px;
        margin: 0 60px;
        display: flex;
        justify-content: space-between;
        font-size: 16px;
        align-items: center;
        transition: background 0.3s, color 0.1s, top 0.3s, left 0.3s, right 0.3s, padding 0.3s, margin 0.3s, box-shadow 0.3s;
        z-index: 1000;
        }

        .navbar.sticky {
        background: #0C0C27;
        color: #ff4081;
        top: 0;
        left: 0;
        right: 0;
        margin: 0;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar a {
        color: inherit;
        text-decoration: none;
        font-weight: 600;
        margin: 0 15px;
        transition: color 0.3s;
        }

        .nav-links {
        display: flex;
        }

        .hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        }

        .hamburger div {
        width: 25px;
        height: 3px;
        background-color: white;
        margin: 4px;
        transition: all 0.3s ease;
        }

        .sidebar {
        height: 100%;
        width: 0;
        position: fixed;
        top: 0;
        right: 0;
        background-color: #0C0C27;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        z-index: 1000;
        }

        .sidebar a {
        padding: 10px 15px;
        text-decoration: none;
        font-size: 22px;
        color: #ff4081;
        display: block;
        transition: 0.3s;
        }

        .sidebar a:hover {
        color: #e00070;
        }

        .sidebar .closebtn {
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 36px;
        }

        .container {
        height: 100vh;
        text-align: center;
        padding: 50px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 2;
        }

        .container:nth-child(odd) {
        background: rgba(0, 0, 0, 0.253);
        }

        h1 {
        font-size: 3em;
        margin-bottom: 0.5em;
        }

        p {
        font-size: 1.5em;
        margin-bottom: 1em;
        }

        .cta-button {
        background: linear-gradient(135deg, #ff4081, #e00070);
        padding: 1em 2em;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 0 15px rgba(255, 64, 129, 0.5);
        transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        .cta-button:hover {
        background: linear-gradient(135deg, #e00070, #ff4081);
        box-shadow: 0 0 25px rgba(255, 64, 129, 0.7);
        }

        .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
        }

        .particle {
        position: absolute;
        width: 2px;
        height: 2px;
        background: white;
        border-radius: 50%;
        opacity: 0;
        box-shadow: 0 0 5px 1px white;
        animation: float 10s infinite;
        }

        @keyframes float {
        0% {
            transform: translateY(0) translateX(0);
            opacity: 0.7;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(calc(-50vw + 100%));
            opacity: 0;
        }
        }

        .star-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        z-index: 0;
        }

        .star {
        position: absolute;
        width: 1px;
        height: 1px;
        background: white;
        opacity: 0.8;
        }

        .features {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        }

        .feature-item {
        max-width: 300px;
        text-align: center;
        padding: 20px;
        margin: 20px 0;
        }

        .logos {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        padding: 20px;
        }

        .logos img {
        max-width: 100px;
        margin: 20px;
        }

        .slider {
        width: 80%;
        max-width: 800px;
        overflow: hidden;
        position: relative;
        margin: 20px auto;
        }

        .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
        }

        .slide {
        min-width: 100%;
        box-sizing: border-box;
        }

        .slider img {
        width: 100%;
        border-radius: 10px;
        }

        .slider-buttons {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
        }

        .slider-button {
        background: rgba(0, 0, 0, 0.5);
        border: none;
        color: white;
        padding: 10px;
        cursor: pointer;
        }

        .footer {
        background: #0C0C27;
        color: #ff4081;
        text-align: center;
        padding: 20px;
        position: relative;
        }

        .footer a {
        color: #ff4081;
        text-decoration: none;
        margin: 0 10px;
        font-weight: 600;
        }

        .footer a:hover {
        color: #e00070;
        }

        @media (min-width: 768px) {
        .features {
            flex-direction: row;
            justify-content: space-around;
        }
        }

        @media (max-width: 768px) {
        .navbar {
            top: 10px;
            left: 10px;
            right: 10px;
            margin: 0;
        }

        .navbar.sticky {
            padding: 10px;
        }

        .nav-links {
            display: none;
        }

        .hamburger {
            display: flex;
        }

        h1 {
            font-size: 2em;
        }

        p {
            font-size: 1.2em;
        }

        .cta-button {
            padding: 0.8em 1.5em;
        }
        }
    </style>

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
