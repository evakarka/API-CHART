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
    <a href="#" style="font-size: 20px;">DailyNewsChart</a>
  </div>
  <div class="nav-links" id="navLinks">
    <a href="#">Home</a>
    <a href="about.php">About</a>
    <a href="#">Services</a>
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
    <img src="https://via.placeholder.com/100" alt="Logo 1">
    <img src="https://via.placeholder.com/100" alt="Logo 2">
    <img src="https://via.placeholder.com/100" alt="Logo 3">
    <img src="https://via.placeholder.com/100" alt="Logo 4">
  </div>
</div>
<div class="container">
  <h1>Image Slider</h1>
  <div class="slider">
    <div class="slides">
      <div class="slide"><img src="https://via.placeholder.com/800x400" alt="Slide 1"></div>
      <div class="slide"><img src="https://via.placeholder.com/800x400" alt="Slide 2"></div>
      <div class="slide"><img src="https://via.placeholder.com/800x400" alt="Slide 3"></div>
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

// Slider functionality
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

// Hamburger menu functionality
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
