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
<title>Creative Landing Page</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style/styles.css">
<style>
body, html {
  margin: 0;
  padding: 0;
  width: 100%;
  min-height: 100%;
  overflow-x: hidden;
  font-family: 'Montserrat', sans-serif;
  background: linear-gradient(to bottom, #0d0d2b, #000000);
  color: white;
}
</style>
</head>
<body>
<div class="navbar" id="navbar">
  <div class="logo">
    <a href="#" style="font-size: 20px;">DailyNewsChart</a>
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
  <a href="#">Home</a>
  <a href="about.php">About</a>
  <a href="#">Services</a>
  <a href="contact.php">Contact</a>
</div>

<div class="container">
  <h1>Welcome to DailyNewsChart</h1>
  <p>Analyze News with Chart.</p>
  <a href="signup.html" class="cta-button">Sign Up</a>
</div>
<div class="container">
  <h1>Features</h1>
  <div class="features">
    <div class="feature-item">
      <h2>Easy Data Import</h2>
      <p>Importing .csv files to create charts is a straightforward process that enhances data visualization capabilities.</p>
    </div>
    <div class="feature-item">
      <h2>Variety of Chart Types</h2>
      <p>Offer a variety of chart types for users to choose from, such as line charts, bar charts, pie charts, etc.</p>
    </div>
    <div class="feature-item">
      <h2>Professional Data Analysis</h2>
      <p>Use datasets to manage and analyze data, allowing for filtering, clustering, and other transformations.</p>
    </div>
  </div>
  <div class="logos">
    <img src="img/c_5.jpg" alt="Logo 1">
    <img src="img/c_6.jpg" alt="Logo 2">
    <img src="img/c_12.jpg" alt="Logo 3">
    <img src="img/c_9.jpg" alt="Logo 4">
  </div>
</div>
<div class="container">
  <h1>Image Slider</h1>
  <div class="slider">
    <div class="slides">
      <div class="slide"><img src="img/c_2.jpg" alt="Slide 1"></div>
      <div class="slide"><img src="img/c_1.jpg" alt="Slide 2"></div>
      <div class="slide"><img src="img/c_7.jpg" alt="Slide 3"></div>
      <div class="slide"><img src="img/c_8.jpg" alt="Slide 4"></div>
      <div class="slide"><img src="img/c_11.jpg" alt="Slide 5"></div>
      <div class="slide"><img src="img/c_10.jpg" alt="Slide 6"></div>
    </div>
    <div class="slider-buttons">
      <button class="slider-button" id="prevBtn">&#10094;</button>
      <button class="slider-button" id="nextBtn">&#10095;</button>
    </div>
  </div>
</div>
<div class="particles"></div>
<div class="star-background"></div>

<div class="footer">
  <p>&copy; 2024 DailyNewsChart. All rights reserved.</p>
  <p>
    <a href="#">Privacy Policy</a> | 
    <a href="#">Terms of Service</a> | 
    <a href="contact.php">Contact Us</a>
  </p>
</div>

<script>
window.onscroll = function() {stickNavbar()};

const navbar = document.getElementById("navbar");
const sticky = navbar.offsetTop;

function stickNavbar() {
  if (window.pageYOffset > sticky) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
}

const particleContainer = document.querySelector('.particles');
const starBackground = document.querySelector('.star-background');

for (let i = 0; i < 100; i++) {
  const particle = document.createElement('div');
  particle.classList.add('particle');
  particle.style.top = `${Math.random() * 100}vh`;
  particle.style.left = `${Math.random() * 100}vw`;
  particle.style.animationDelay = `${Math.random() * 10}s`;
  particleContainer.appendChild(particle);
}

for (let i = 0; i < 300; i++) {
  const star = document.createElement('div');
  star.classList.add('star');
  star.style.top = `${Math.random() * 100}vh`;
  star.style.left = `${Math.random() * 100}vw`;
  starBackground.appendChild(star);
}

const slides = document.querySelector('.slides');
const slide = document.querySelectorAll('.slide');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

let index = 0;

function showSlide(n) {
  index += n;
  if (index >= slide.length) {
    index = 0;
  }
  if (index < 0) {
    index = slide.length - 1;
  }
  slides.style.transform = 'translateX(' + (-index * 100) + '%)';
}

prevBtn.addEventListener('click', () => showSlide(-1));
nextBtn.addEventListener('click', () => showSlide(1));

const hamburger = document.getElementById("hamburger");
const sidebar = document.getElementById("sidebar");
const closebtn = document.getElementById("closebtn");

hamburger.addEventListener("click", () => {
  sidebar.style.width = "250px";
});

closebtn.addEventListener("click", () => {
  sidebar.style.width = "0";
});
</script>
</body>
</html>
